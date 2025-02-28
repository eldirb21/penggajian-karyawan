<?php
include_once('../koneksi.php'); 

// session_start();
// include_once('../koneksi.php');

// // Pastikan pengguna sudah login
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php"); // Redirect ke login jika belum login
//     exit;
// }

// // Ambil data user dari database
// $user_id = $_SESSION['user_id'];
// $query_user = mysqli_query($koneksi, "SELECT * FROM users WHERE id = '$user_id'");
// $user = mysqli_fetch_assoc($query_user);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Penyewaan Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Penyewaan Buku</a>
            <div class="d-flex align-items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="Profile" class="rounded-circle"
                    width="40" height="40">
                <span class="text-white ms-2">Mogican</span>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="mb-4">Data Sewa Buku</h2>
            <a href="formSewa.php" class="btn btn-primary mb-3">Penyewa Baru</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Nama Penyewa</th>
                    <th>Tanggal Sewa</th>
                    <th>Durasi (hari)</th>
                    <th>Tanggal Selesai</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, 'SELECT * FROM sewa');
                $no = 1;
                while ($row = mysqli_fetch_array($query)) {
                    $tanggal_selesai = date('Y-m-d', strtotime($row['tanggal_sewa'] . "+ $row[durasi] days"));
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['judul']); ?></td>
                        <td><?= htmlspecialchars($row['penyewa']); ?></td>
                        <td><?= htmlspecialchars($row['tanggal_sewa']); ?></td>
                        <td><?= htmlspecialchars($row['durasi']); ?></td>
                        <td><?= $tanggal_selesai; ?></td>
                        <td>
                            <a href="formEditSewa.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="prosesDeleteSewa.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>