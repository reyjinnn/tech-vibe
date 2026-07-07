<?php
if (isset($_POST['masuk'])) {
    masuk($_POST);
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= url ?>assets/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= url ?>assets/css/bg.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= url ?>assets/font-awesome/css/font-awesome.min.css" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= url ?>assets/css/custom.css" crossorigin="anonymous">
   
    <title><?= $judul ?></title>
</head>

<div class="topbar fixed-top bg-baru">
    <div class="d-flex justify-content-between align-items-center py-2 px-3">
        <!-- Logo TECHVIBE -->
        <div class="navbar-nav">
            <a href="<?= url ?>">
                <h2 style="font-family: 'Zen Dots', cursive; color: blueviolet; margin: 0;">TECHVIBE</h2>
            </a>
        </div>

        <!-- Menu Masuk/Daftar -->
        <?php if (isset($_SESSION['nama'])) : ?>
            <div class="text-right">
                <a href="<?= url ?>user/profil.php" class="text-secondary"><?= $_SESSION['nama'] ?></a> |
                <a href="<?= url ?>user/keluar.php">Keluar</a>
            </div>
        <?php else : ?>
            <div class="text-right">
                <a class="text-secondary" style="cursor: pointer" data-toggle="modal" data-target="#masuk">Masuk</a> |
                <a href="<?= url ?>user/daftar.php">Daftar</a>
            </div>
        <?php endif; ?>
    </div>

    <?php if (isset($_SESSION['pesan'])) : ?>
        <div id="pesan" data-pesan="<?= $_SESSION['pesan'] ?>"></div>
        <?php unset($_SESSION['pesan']) ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['sukses'])) : ?>
        <div id="cart-sukses" data-sukses="<?= $_SESSION['sukses'] ?>"></div>
        <?php unset($_SESSION['sukses']) ?>
    <?php endif; ?>

    <nav class="navbar navbar-expand-lg shadow-sm">
        <div id="nav-btn" class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
                <i id="icon" class="fa fa-bars"></i>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav col-6">
                <li class="nav-baru">
                    <a class="nav-link" href="<?= url ?>index.php">Beranda </a>
                </li>
                <li class="nav-baru">
                    <a class="nav-link" href="<?= url ?>user/produk.php">Produk</a>
                </li>
                <li class="nav-baru" id="nav-baru">
                    <a class="nav-link" href="<?= url ?>user/tentang.php">Tentang</a>
                </li>
                <li class="nav-baru">
                    <div class="dropdown">
                        <a class="nav-link dropbtn" onclick="toggleDropdown()">Kategori</a>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="<?= url ?>user/produk.php?kategori=ponsel">Ponsel</a><br>
                            <a href="<?= url ?>user/produk.php?kategori=laptop">Laptop</a><br>
                            <a href="<?= url ?>user/produk.php?kategori=komputer">Komputer</a>
                        </div>
                    </div>
                </li>
                <li class="nav-baru">
                    <a class="nav-link" href="<?= url ?>user/kontak.php">Komentar</a>
                </li>
            </ul>
            <div class="cari col-6">
                <form class="form-inline float-right" action="<?= url ?>user/produk.php/?cari=">
                    <input name="cari" class="form-control mr-sm-2 " type="search" placeholder="Cari" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </nav>
</div>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById("myDropdown");
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }

    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            const dropdown = document.getElementById("myDropdown");
            dropdown.style.display = "none";
        }
    }
</script>

<body class="bg-white">
    <div class="container  bg-white p-5">