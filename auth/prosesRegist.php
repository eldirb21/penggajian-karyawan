<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../config/conn.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Debugging: Cek apakah data dikirim
    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
    echo "</pre>";

    // Ambil data dari form
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = mysqli_real_escape_string($koneksi, $_POST['role']);

    // Proses Upload Gambar
    $gambar = "assets/avatar/default.png";
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $folderUpload = "uploads/";
        $namaFile = time() . "_" . basename($_FILES['gambar']['name']);
        $pathFile = $folderUpload . $namaFile;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $pathFile)) {
            $gambar = $pathFile;
        }
    }

    // Simpan ke database
    $query = "INSERT INTO users (nama, email, password, role, gambar) VALUES ('$nama', '$email', '$password', '$role', '$gambar')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Registrasi berhasil!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>
