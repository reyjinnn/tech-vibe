<?php
session_start();
require '../function/cart.php';
require '../function/transaksi.php';

$judul = transaksi()['judul'];

$subtotal = ambilCart()['subtotal']->subtotal;
$kuantiti = ambilCart()['kuantiti']->kuantiti;
$carts = ambilCart()['carts'];

if (isset($_POST['submit'])) {
    // Validasi input form
    $errors = [];
    $penerima = $_POST['penerima'] ?? '';
    $email = $_POST['email'] ?? '';
    $telp = $_POST['telepon'] ?? '';
    $alamat = $_POST['alamat'] ?? '';

    if (empty($penerima)) {
        $errors[] = 'Nama penerima harus diisi!';
    }
    if (empty($email)) {
        $errors[] = 'Email harus diisi!';
    }
    if (empty($telp)) {
        $errors[] = 'No. Telp harus diisi!';
    }
    if (empty($alamat)) {
        $errors[] = 'Alamat harus diisi!';
    }
    if (empty($carts)) {
        $errors[] = 'Keranjang kamu kosong!';
    }

    // Jika tidak ada kesalahan, proses transaksi
    if (empty($errors)) {
        $berhasil = tambahTransaksi($_POST);
        if ($berhasil) {
            // Redirect supaya form tidak ke-submit ulang saat refresh
            header('Location: ' . url . 'user/profil.php');
            exit;
        }
        // Kalau gagal, tambahTransaksi() sudah mengisi $_SESSION['error']
    } else {
        $_SESSION['pesan'] = implode(', ', $errors);
    }
}

require 'templates/header.php';
?>

<div class="row mt-5">
    <h5 class="w-100">Pembelian</h5>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <h6>Total Kuantiti</h6><span><?= $kuantiti ?></span>
        </li>
        <li class="list-group-item">
            <h6>Total Harga</h6><span>Rp<?= number_format($subtotal ?? 0, 0) ?></span>
        </li>
    </ul>
</div>
<div class="row mt-2">
    <h5 class="w-100">Form CekOut</h5>
    <div class="col-md-8">

        <?php
        // Tampilkan pesan kesalahan validasi form
        if (isset($_SESSION['pesan'])) {
            echo '<div class="alert alert-danger mt-3">' . htmlspecialchars($_SESSION['pesan']) . '</div>';
            unset($_SESSION['pesan']);
        }
        // Tampilkan pesan kesalahan dari proses transaksi (tambahTransaksi)
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger mt-3">' . htmlspecialchars($_SESSION['error']) . '</div>';
            unset($_SESSION['error']);
        }
        // Tampilkan pesan sukses (jaga-jaga kalau tidak sempat redirect)
        if (isset($_SESSION['sukses'])) {
            echo '<div class="alert alert-success mt-3">' . htmlspecialchars($_SESSION['sukses']) . '</div>';
            unset($_SESSION['sukses']);
        }
        ?>

        <form action="" method="POST">
            <input type="hidden" name="kuantiti_total" value="<?= $kuantiti ?>">
            <input type="hidden" name="subtotal" value="<?= $subtotal ?>">

            <?php foreach ($carts as $value) : ?>
                <input type="hidden" name="kuantiti_<?= $value->id_produk ?>" value="<?= $value->kuantiti ?>">
                <input type="hidden" name="id_produk[]" value="<?= $value->id_produk ?>">
            <?php endforeach; ?>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="penerima">Penerima</label>
                    <input type="text" class="form-control" id="penerima" name="penerima" value="<?= htmlspecialchars($_POST['penerima'] ?? '') ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="telp">Telepon penerima</label>
                    <input type="number" class="form-control" id="telp" name="telepon" value="<?= htmlspecialchars($_POST['telepon'] ?? '') ?>">
                </div>
                <div class="col-md-6 form-group">
                    <label for="email">Email penerima</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= htmlspecialchars($_POST['alamat'] ?? '') ?>">
            </div>

            <button type="submit" name="submit" class="btn btn-primary" <?= empty($carts) ? 'disabled' : '' ?>>Submit</button>
        </form>

    </div>
</div>

<?php
require 'templates/footer.php';
?>