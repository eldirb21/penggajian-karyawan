<?php
include '../config/conn.php';
$id = $_GET['id'];

$query = "DELETE FROM users WHERE id = $id";
if (mysqli_query($koneksi, $query)) {
    header("Location: users.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
