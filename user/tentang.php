<?php
session_start();
require '../function/produk.php';
$judul = produk()['judul'];
require 'templates/header.php';
?>

<div class="row bg-white border p-2 mt-5">
    <div class="col-md ml-3"><br>
        <h1>Tentang Kami</h1>
        <p class="lead">TECHVIBE adalah toko online terpercaya yang menyediakan berbagai produk teknologi dan elektronik terkini. Kami menghadirkan solusi modern untuk kebutuhan gadget, perangkat elektronik, dan aksesori Anda, dengan fokus pada kualitas, inovasi, dan kepuasan pelanggan.
        </p>
        <hr>
        <div class="row ml-1">
            <div class="w-100">
                <h3><i class="fa fa-map-marker"></i>Alamat</h3>
                <p>Jatiuwung<br>Tangerang<br>Banten<br>Indonesia</p>
            </div>
            <!-- /.col-sm-4-->
            <div class="">
                <h3><i class="fa fa-phone"></i> Hubungi Kami</h3>
                <p class="text-muted">Anda dapat menghubungi kami pada nomor dibawah ini</p>
                <p><strong>+621 252 945 333</strong></p>
            </div>
        </div>
    </div>
</div>
<?php require 'templates/footer.php' ?>