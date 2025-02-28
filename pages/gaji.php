<?php
include("../config/conn.php");

// Ambil data gaji dan nama karyawan
$query = "SELECT gaji.id, karyawan.nama, gaji.bulan, gaji.tahun, gaji.jumlah 
          FROM gaji 
          JOIN karyawan ON gaji.karyawan_id = karyawan.id";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Gaji</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
            transition: margin-left 0.3s ease-in-out;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
            transition: background 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: transform 0.2s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .btn-sm {
            transition: transform 0.2s ease-in-out;
        }

        .btn-sm:hover {
            transform: scale(1.1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <?php include('../components/sidebar.php'); ?>

    <div class="main-content">
        <?php include('../components/header.php'); ?>

        <div class="container mt-4">
            <h2 class="text-center mb-4">📄 Daftar Gaji Karyawan</h2>

            <div class="d-flex justify-content-end mb-3">
                <a href="add_gaji.php" class="btn btn-primary">+ Tambah Gaji</a>
            </div>

            <div class="table-container">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>Nama Karyawan</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['bulan'] ?></td>
                                <td><?= $row['tahun'] ?></td>
                                <td>Rp <?= number_format($row['jumlah'], 2, ',', '.') ?></td>
                                <td>
                                    <a href="edit_gaji.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">✏ Edit</a>
                                    <a href="delete_gaji.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus?')">🗑 Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>

</html>