<?php
include_once("../config/conn.php"); // Koneksi ke database

if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = mysqli_real_escape_string($koneksi, $_POST['role']);

    // Proses Upload Gambar
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $folderUpload = "uploads/";
        $namaFile = time() . "_" . basename($_FILES['gambar']['name']);
        $pathFile = $folderUpload . $namaFile;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $pathFile)) {
            $gambar = $pathFile;
        } else {
            $gambar = "assets/avatar/default.png"; // Gunakan avatar default jika gagal upload
        }
    } else {
        $gambar = "assets/avatar/default.png"; // Default avatar jika tidak ada gambar
    }

    // Simpan ke database
    $query = "INSERT INTO users (nama, email, password, role, gambar) VALUES ('$nama', '$email', '$password', '$role', '$gambar')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Registrasi berhasil!";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>