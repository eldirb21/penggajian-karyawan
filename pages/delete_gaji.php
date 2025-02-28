<?php
include("../config/conn.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM gaji WHERE id = '$id'";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Gaji berhasil dihapus!'); window.location='gaji.php';</script>";
    } else {
        echo "Gagal menghapus gaji: " . mysqli_error($koneksi);
    }
}
?>
