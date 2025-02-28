<?php
session_start();
include_once('../config/conn.php');

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($koneksi, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($password === $user['password']) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['level'] = $user['role'];

            // Cek apakah session berhasil dibuat
            // var_dump($_SESSION);
            // exit();

            header("Location: /penggajian/pages/dashboard.php");
            exit();
        } else {
            header("Location: login.php?error=Email atau Password salah!");
            exit();
        }
    } else {
        header("Location: login.php?error=Email atau Password salah!");
        exit();
    }
} else {
    header("Location: login.php?error=Harap isi semua kolom!");
    exit();
}
?>