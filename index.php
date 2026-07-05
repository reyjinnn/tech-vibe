<?php
require  'function/home.php';
$judul = home()['judul'];
$produk = home()['produk'];

//keranjang
if (isset($_POST['cart'])) {
    if (cekLogin() === true) {
        tambahCart($_POST);
    } else {
        $_SESSION['pesan'] = "Anda belum masuk!! Silahkan masuk terlebih dahulu!";
    }
}


require './user/templates/header.php';
?>
<link rel="stylesheet" href="<?= url ?>.assets/css/bg.css">
<br>
<div id="carouselExampleIndicators" class="carousel slide mt-5" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= url ?>assets/images/pages/banner-1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?= url ?>assets/images/pages/banner-2.jpg" class="d-block w-100" alt="...">
        </div>
    </div>
</div>

<!-- Produk Baru -->
<div class="mt-5">
    <h5 class="text-uppercase">Produk Baru</h5>
    <div class="bg-white produk-front border-top ">
        <?php foreach ($produk as $value) : ?>
            <div class="bg-white col-md-2 card-produk shadow-sm m-1">
                <div class="card-img" style=" height:50%;">
                    <img src="<?= url ?>assets/images/produk/<?= $value->gambar ?>" class="img-fluid " style="width: 100%;" alt="...">
                </div>
                <div class="card-body" style="height: 25%;">
                    <h6 class=""><?= $value->nama ?></h6>
                    <p>Rp<?= number_format($value->harga, 0) ?></p>
                </div>
                <div class="d-flex justify-content-around p-2 w-75 border-top m-auto">
                    <a href="<?= url ?>user/detail.php/?id=<?= $value->id_produk ?>" class="btn btn-sm btn-info mr-1 ">Detail</a>
                    <form method="POST" action="">
                        <input type="hidden" name="id_produk" value="<?= $value->id_produk ?>">
                        <input type="hidden" name="nama" value="<?= $value->nama ?>">
                        <input type="hidden" name="harga" value="<?= $value->harga ?>">
                        <input type="hidden" name="kuantiti" value="1">
                        <input type="hidden" name="gambar" value="<?= $value->gambar ?>">
                        <input type="hidden" name="kategori" value="<?= $value->kategori ?>">
                        <button name="cart" class="btn btn-sm btn-success">Beli</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="bg-white row my-5 p-3" style="margin: 0 20px">
    <div class="coi">
        <div class="row">

        </div>
        <div class="d-flex w-100">
            <img class="w-100" src="<?= url ?>/assets/images/pages/ban1.jpg" alt="">
            <img class="w-100" src="<?= url ?>/assets/images/pages/ban3.png" alt="">
            <img class="w-100" src="<?= url ?>/assets/images/pages/ban2.jpg" alt="">
            <img class="w-100" src="<?= url ?>assets/images/pages/ban4.png" alt="">
        </div>
    </div>
</div>

<!-- Produk Baru -->
<div class="mt-5">
    <h5 class="text-uppercase">Produk Paling Diminati</h5>
    <div class="bg-white produk-front border-top">
        <?php foreach ($produk as $value) : ?>
            <div class="bg-white col-md-2 card-produk shadow-sm m-1">
                <div class="card-img" style="height:50%;">
                    <img src="<?= url ?>assets/images/produk/<?= $value->gambar ?>" class="img-fluid" style="width: 100%;" alt="...">
                </div>
                <div class="card-body" style="height: 25%;">
                    <h6 class=""><?= $value->nama ?></h6>
                    <p>Rp<?= number_format($value->harga, 0) ?></p>
                </div>
                <div class="d-flex justify-content-around p-2 w-75 border-top m-auto">
                    <a href="<?= url ?>user/detail.php/?id=<?= $value->id_produk ?>" class="btn btn-sm btn-info mr-1">Detail</a>
                    <form method="POST" action="">
                        <input type="hidden" name="id_produk" value="<?= $value->id_produk ?>">
                        <input type="hidden" name="nama" value="<?= $value->nama ?>">
                        <input type="hidden" name="harga" value="<?= $value->harga ?>">
                        <input type="hidden" name="gambar" value="<?= $value->gambar ?>">
                        <input type="hidden" name="kategori" value="<?= $value->kategori ?>">
                        <input type="hidden" name="kuantiti" value="1"> <!-- Tetap menyertakan kuantiti -->
                        <button name="cart" class="btn btn-sm btn-success">Beli</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?= require 'user/templates/footer.php'; ?>