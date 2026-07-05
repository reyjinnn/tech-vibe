<?php
require 'koneksi.php';

function transaksi()
{
    $data = [
        'judul' => 'CekOut keranjangmu sekarang',
    ];
    return $data;
}

function tambahTransaksi($post)
{
    global $konek;

    // Validasi session
    if (!isset($_SESSION['iduser'])) {
        $_SESSION['error'] = "User tidak terautentikasi";
        return false;
    }

    // Generate ID pesan yang lebih unik
    $id_pesan = uniqid('TRX_', true) . '_' . rand(1000, 9999);

    $id_user = $_SESSION['iduser'];
    
    // Validasi dan sanitasi input
    $pengirim = "Techvibe";
    $penerima = mysqli_real_escape_string($konek, trim($post['penerima']));
    $alamat = mysqli_real_escape_string($konek, trim($post['alamat']));
    $telepon = mysqli_real_escape_string($konek, trim($post['telepon']));
    $email = mysqli_real_escape_string($konek, trim($post['email']));
    $kuantiti_total = intval($post['kuantiti_total']);
    $total_akhir = floatval($post['subtotal']);
    $pembayaran = 0;
    $id_status = 0;
    $pesan = date('Y-m-d H:i:s');

    // Validasi data wajib
    if (empty($penerima) || empty($alamat) || empty($telepon) || empty($email)) {
        $_SESSION['error'] = "Semua field wajib diisi";
        return false;
    }

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Format email tidak valid";
        return false;
    }

    // Mulai transaction
    mysqli_begin_transaction($konek);

    try {
        // Insert transaksi utama
        $queryTransaksi = "INSERT INTO transaksi (id_pesan, id_user, pengirim, penerima, alamat, telepon, email, kuantiti_total, total_akhir, pembayaran, id_status, pesan_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($konek, $queryTransaksi);
        mysqli_stmt_bind_param($stmt, 'sisssssidiss', $id_pesan, $id_user, $pengirim, $penerima, $alamat, $telepon, $email, $kuantiti_total, $total_akhir, $pembayaran, $id_status, $pesan);
        
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Gagal menyimpan transaksi: " . mysqli_error($konek));
        }
        mysqli_stmt_close($stmt);

        // Proses detail transaksi, penjualan, dan update stok dalam satu loop
        $carts = ambilCart()['carts'];
        $i = 1;
        
        foreach ($carts as $value) {
            $kuantiti = intval($post['kuantiti' . $i]);
            $id_produk = intval($post['id_produk' . $i]);
            $total = floatval($value->total);
            $i++;

            // Validasi data produk
            if ($kuantiti <= 0 || $id_produk <= 0) {
                throw new Exception("Data produk tidak valid");
            }

            // Insert detail transaksi
            $queryDetail = "INSERT INTO transaksi_detail (id_pesan, id_produk, kuantiti, total) VALUES (?, ?, ?, ?)";
            $stmtDetail = mysqli_prepare($konek, $queryDetail);
            mysqli_stmt_bind_param($stmtDetail, 'siid', $id_pesan, $id_produk, $kuantiti, $total);
            
            if (!mysqli_stmt_execute($stmtDetail)) {
                throw new Exception("Gagal menyimpan detail transaksi: " . mysqli_error($konek));
            }
            mysqli_stmt_close($stmtDetail);

            // Update penjualan
            $queryJual = "INSERT INTO penjualan (id_produk, jual) VALUES (?, ?) ON DUPLICATE KEY UPDATE jual = jual + ?";
            $stmtJual = mysqli_prepare($konek, $queryJual);
            mysqli_stmt_bind_param($stmtJual, 'iii', $id_produk, $kuantiti, $kuantiti);
            
            if (!mysqli_stmt_execute($stmtJual)) {
                throw new Exception("Gagal update penjualan: " . mysqli_error($konek));
            }
            mysqli_stmt_close($stmtJual);

            // Update stok produk
            $queryStok = "UPDATE produk SET stok = stok - ? WHERE id_produk = ? AND stok >= ?";
            $stmtStok = mysqli_prepare($konek, $queryStok);
            mysqli_stmt_bind_param($stmtStok, 'iii', $kuantiti, $id_produk, $kuantiti);
            
            if (!mysqli_stmt_execute($stmtStok)) {
                throw new Exception("Stok produk tidak mencukupi atau produk tidak ditemukan");
            }
            
            if (mysqli_affected_rows($konek) === 0) {
                throw new Exception("Stok produk tidak mencukupi untuk ID produk: " . $id_produk);
            }
            mysqli_stmt_close($stmtStok);
        }

        // Commit transaction
        mysqli_commit($konek);
        
        // Bersihkan cart setelah transaksi berhasil
        bersihkanCart();
        
        $_SESSION['sukses'] = "Transaksi berhasil. Silahkan melakukan Pembayaran";
        return true;

    } catch (Exception $e) {
        // Rollback transaction jika ada error
        mysqli_rollback($konek);
        $_SESSION['error'] = $e->getMessage();
        return false;
    }
}

function ambilTransaksi()
{
    global $konek;

    if (!isset($_SESSION['iduser'])) {
        return ['trans' => []];
    }

    $id_user = intval($_SESSION['iduser']);
    $query = "SELECT * FROM transaksi JOIN status ON status.id_status = transaksi.id_status WHERE id_user = ? ORDER BY pesan_at DESC";
    $stmt = mysqli_prepare($konek, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id_user);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    $trans = [];
    
    while ($tran = mysqli_fetch_object($result)) {
        $trans[] = $tran;
    }
    
    mysqli_stmt_close($stmt);

    return ['trans' => $trans];
}

function transaksiDetail($id)
{
    global $konek;
    
    if (!isset($id) || empty($id)) {
        return ['detail' => []];
    }

    $id_pesan = mysqli_real_escape_string($konek, $id);
    $query = "SELECT * FROM transaksi_detail JOIN produk ON produk.id_produk = transaksi_detail.id_produk WHERE id_pesan = ?";
    $stmt = mysqli_prepare($konek, $query);
    mysqli_stmt_bind_param($stmt, 's', $id_pesan);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    $detail = [];
    
    while ($tran = mysqli_fetch_object($result)) {
        $detail[] = $tran;
    }
    
    mysqli_stmt_close($stmt);

    return ['detail' => $detail];
}

function bayar($post)
{
    global $konek;

    // Validasi input
    if (empty($post['nama']) || empty($post['idpesan']) || empty($post['nominal'])) {
        $_SESSION['pesan'] = 'Semua field wajib diisi';
        return false;
    }

    // Validasi file upload
    if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] == 4) {
        $_SESSION['pesan'] = 'Anda belum memasukkan bukti pembayaran';
        return false;
    }

    $img = $_FILES['gambar'];
    $allowed_types = ['image/jpg', 'image/jpeg', 'image/png'];
    
    if (!in_array($img['type'], $allowed_types)) {
        $_SESSION['pesan'] = 'Pilih gambar dengan ekstensi JPG, JPEG, PNG!!';
        return false;
    }

    // Validasi size file (max 2MB)
    if ($img['size'] > 2097152) {
        $_SESSION['pesan'] = 'Ukuran file terlalu besar. Maksimal 2MB';
        return false;
    }

    // Generate nama file
    $imgname = uniqid('PAY_', true) . '_' . date('Y-m-d-H-i-s') . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $img['name']);

    // Upload file
    $upload_dir = '../assets/images/bayar/';
    if (!move_uploaded_file($img['tmp_name'], $upload_dir . $imgname)) {
        $_SESSION['pesan'] = 'Gagal mengupload bukti pembayaran';
        return false;
    }

    // Sanitasi input
    $nama = mysqli_real_escape_string($konek, trim($post['nama']));
    $id_pesan = mysqli_real_escape_string($konek, trim($post['idpesan']));
    $nominal = floatval($post['nominal']);

    // Insert pembayaran
    $queryPembayaran = "INSERT INTO pembayaran (id_pesan, nama, nominal, gambar) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($konek, $queryPembayaran);
    mysqli_stmt_bind_param($stmt, 'ssds', $id_pesan, $nama, $nominal, $imgname);
    
    if (!mysqli_stmt_execute($stmt)) {
        unlink($upload_dir . $imgname); // Hapus file jika gagal
        $_SESSION['pesan'] = 'Gagal menyimpan data pembayaran';
        return false;
    }
    mysqli_stmt_close($stmt);

    // Update status pembayaran
    $queryUpdate = "UPDATE transaksi SET pembayaran = 1 WHERE id_pesan = ?";
    $stmtUpdate = mysqli_prepare($konek, $queryUpdate);
    mysqli_stmt_bind_param($stmtUpdate, 's', $id_pesan);
    
    if (!mysqli_stmt_execute($stmtUpdate)) {
        $_SESSION['pesan'] = 'Gagal update status pembayaran';
        return false;
    }
    mysqli_stmt_close($stmtUpdate);

    $_SESSION['sukses'] = 'Bukti pembayaran berhasil diupload';
    return true;
}

function terimaTransaksi($id)
{
    global $konek;
    
    if (!isset($id['idpesan']) || empty($id['idpesan'])) {
        $_SESSION['error'] = 'ID transaksi tidak valid';
        return false;
    }

    $id_pesan = mysqli_real_escape_string($konek, $id['idpesan']);
    
    $query = "UPDATE transaksi SET id_status = 3 WHERE id_pesan = ?";
    $stmt = mysqli_prepare($konek, $query);
    mysqli_stmt_bind_param($stmt, 's', $id_pesan);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['sukses'] = 'Transaksi berhasil diterima';
        mysqli_stmt_close($stmt);
        return true;
    } else {
        $_SESSION['error'] = 'Gagal update status transaksi';
        mysqli_stmt_close($stmt);
        return false;
    }
}