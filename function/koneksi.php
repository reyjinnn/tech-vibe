<?php


/*----- Kofigurasi Database -----*/
define('hostname', 'localhost');
define('username', 'root');
define('password', '');
define('database', 'tekno');

/*----- Url -----*/
define('url', 'http://localhost/techvibe/');

/*----- Author -----*/
define('author', 'TECHVIBE');

//require '../config/config.php';
$konek = mysqli_connect(hostname, username, password, database);

if (mysqli_errno($konek)) {
    echo "Gagal koneksi ke database";
    exit;
}
