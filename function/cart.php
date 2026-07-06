<?php
function tambahCart($post)
{

    global $konek;

    $id_user = $_SESSION['iduser'];
    $id_produk = $post['id_produk'];
    $nama = $post['nama'];
    $harga = $post['harga'];
    $kuantiti = $post['kuantiti'];
    $gambar = $post['gambar'];
    $kategori = $post['kategori'];
    $total = $harga * $kuantiti;

    $cek = mysqli_query($konek, "SELECT * FROM cart WHERE id_produk='$id_produk' AND id_user='$id_user'");
    $cekKuantiti = mysqli_fetch_assoc($cek);
    $kuantitiBaru = ($cekKuantiti['kuantiti'] ?? 0) + $kuantiti;

    if (mysqli_num_rows($cek) === 0) {
        mysqli_query($konek, "INSERT INTO cart (id_user, id_produk, nama, harga, kuantiti, gambar, kategori, total)  VALUES(
            '$id_user', '$id_produk', '$nama', '$harga', '$kuantiti', '$gambar', '$kategori', '$total'
            )");
    } else if (mysqli_num_rows($cek) > 0) {
        $totalBaru = $harga * $kuantitiBaru;
        mysqli_query($konek, "UPDATE cart SET kuantiti='$kuantitiBaru', total='$totalBaru' WHERE id_produk='$id_produk' AND id_user='$id_user'");
    }
    $_SESSION['sukses'] = "Barang berhasil ditambahkan keranjang";
    return;
}

function ambilCart()
{
    global $konek;

    $id = $_SESSION['iduser'];
    $carts = [];
    $produk = mysqli_query($konek, "SELECT * FROM cart WHERE id_user='$id'");
    $subtotal = mysqli_query($konek, "SELECT COALESCE(SUM(total), 0) as subtotal FROM cart WHERE id_user='$id'");
    $kuantiti = mysqli_query($konek, "SELECT COALESCE(SUM(kuantiti), 0) as kuantiti FROM cart WHERE id_user='$id'");

    while ($hasil = mysqli_fetch_object($produk)) {
        $carts[] = $hasil;
    }
    $data = [
        'carts' => $carts,
        'subtotal' => mysqli_fetch_object($subtotal),
        'kuantiti' => mysqli_fetch_object($kuantiti),
    ];
    return $data;
}

function ubahCart($post)
{
    global $konek;

    $id_cart = $post['idCart'];
    $kuantiti = $post['kuantiti'];
    $total = $post['harga'] * $kuantiti;

    mysqli_query($konek, "UPDATE cart SET kuantiti='$kuantiti', total='$total' WHERE id_cart='$id_cart'");

    $_SESSION['sukses'] = "Barang berhasil diubah";
    return;
}

function hapusCart($post)
{
    global $konek;

    $id_cart = $post['idCart'];

    mysqli_query($konek, "DELETE FROM cart WHERE id_cart='$id_cart'");

    $_SESSION['sukses'] = "Barang berhasil dihapus dari keranjang";
    return;
}

function bersihkanCart()
{
    global $konek;

    $id_user = $_SESSION['iduser'];

    mysqli_query($konek, "DELETE FROM cart WHERE id_user='$id_user'");

    $_SESSION['sukses'] = "Keranjang berhasil dibersihkan";
    return;
}