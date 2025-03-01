<!-- header.php -->
<?php
session_start();
$avatar = $_SESSION['user']['gambar'] ?? "https://cdn-icons-png.flaticon.com/512/219/219983.png";

if (isset($headerData['currentUser'])) {
    $currentUser = json_decode($headerData['currentUser'], true);
}

echo "<script>console.log('Debug currentUser: " . ($headerData['currentUser']['nama'] ?? 'Guest') . "' );</script>";

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <span class="navbar-brand">Penggajian Karyawan</span>
        <div class="d-flex align-items-center">
            <img src="<?php echo $avatar; ?>" alt="Avatar" class="rounded-circle" width="40" height="40">
            <span class="ms-2"><?php echo $_SESSION['user']['nama']; ?></span>
            <a href="/penggajian/auth/logout.php" class="btn btn-danger ms-3">Logout</a>
        </div>
    </div>
</nav>