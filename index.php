<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_SESSION['user_id'])) {
    // Jika sesi ada, arahkan ke halaman index
    header("Location: pages/index.php");
    exit();
} else {
    // Jika sesi tidak ada, arahkan ke halaman login
    header("Location: auth/login.php");
    exit();
}

?>