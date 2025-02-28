<?php

    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "penggajian_karyawan";

    $koneksi = mysqli_connect($server, $user, $password, $database) OR DIE ("koneksi Gagal");

    if (!$koneksi) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }
    