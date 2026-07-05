<?php

function masuk($post)
{
    global $konek;
    $email = htmlspecialchars($post['email']);
    $sandi = $post['sandi'];

    // Validasi input login
    if (empty($email)) {
        $_SESSION['pesan'] = 'Email harus diisi!';
        return;
    }
    if (empty($sandi)) {
        $_SESSION['pesan'] = 'Password harus diisi!';
        return;
    }

    // Validasi format email (sama seperti di fungsi daftar)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['pesan'] = 'Format email tidak valid! Contoh: user@example.com atau user@localhost';
        return;
    }

    $kueri = mysqli_query($konek, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($kueri) > 0) {
        $data = mysqli_fetch_object($kueri);
        $verifikasi = password_verify($sandi, $data->sandi);
        if ($verifikasi === true) {
            $_SESSION['iduser'] = $data->id_user;
            $_SESSION['nama'] = $data->nama;
            $_SESSION['email'] = $data->email;
            $_SESSION['role'] = $data->role;
            $_SESSION['tglMasuk'] = date('y-m-d h:i:s');
            if ($data->role == 1) {
                header('location:' . url . 'admin');
            } else {
                header('location:' . url . 'user');
            }
            exit; // Tambahkan exit setelah header redirect
        } else {
            $_SESSION['pesan'] = "Password yang anda masukkan tidak sesuai!";
        }
    } else {
        $_SESSION['pesan'] = "Email yang anda masukkan tidak terdaftar!";
    }
    return;
}

function daftar($post)
{
    global $konek;

    $nama = htmlspecialchars($post['nama']);
    $email = htmlspecialchars($post['email']);
    $password1 = htmlspecialchars($post['sandi1']);
    $password2 = htmlspecialchars($post['sandi2']);
    $image = "default.png";
    $createat = date('y-m-d h:i:s');

    // Validasi input
    if (empty($nama)) {
        $_SESSION['pesan'] = 'Nama harus diisi!';
        return;
    }
    if (empty($email)) {
        $_SESSION['pesan'] = 'Email harus diisi!';
        return;
    }
    
    // Validasi format email (lebih longgar, boleh tanpa .com)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['pesan'] = 'Format email tidak valid!';
        return;
    }

    if (empty($password1)) {
        $_SESSION['pesan'] = 'Password harus diisi!';
        return;
    }
    
    // Validasi panjang password
    if (strlen($password1) < 6) {
        $_SESSION['pesan'] = 'Password minimal 6 karakter!';
        return;
    }
    
    if ($password2 != $password1) {
        $_SESSION['pesan'] = 'Konfirmasi password harus sama!';
        return;
    }

    // Cek apakah email sudah terdaftar
    $cek_email = mysqli_query($konek, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_num_rows($cek_email) > 0) {
        $_SESSION['pesan'] = 'Email sudah terdaftar!';
        return;
    }

    $sandi = password_hash($password2, PASSWORD_DEFAULT);

    // PERBAIKAN: Hapus id_user dari query INSERT karena AUTO_INCREMENT
    mysqli_query($konek, "INSERT INTO users (nama, email, sandi, image, role, createat, updateat) 
                         VALUES ('$nama','$email','$sandi','$image', '2', '$createat', NULL)");

    if (mysqli_affected_rows($konek)) {
        $_SESSION['sukses'] = 'Akun berhasil dibuat';
        return header('location:' . url . 'user');
    } else {
        $_SESSION['pesan'] = 'Gagal membuat akun: ' . mysqli_error($konek);
    }
}