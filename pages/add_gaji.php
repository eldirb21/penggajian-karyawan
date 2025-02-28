<?php
include("../config/conn.php");

// Ambil daftar karyawan
$karyawanQuery = "SELECT * FROM karyawan";
$karyawanResult = mysqli_query($koneksi, $karyawanQuery);

if (isset($_POST['submit'])) {
    $karyawan_id = $_POST['karyawan_id'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $jumlah = $_POST['jumlah'];

    $query = "INSERT INTO gaji (karyawan_id, bulan, tahun, jumlah) VALUES ('$karyawan_id', '$bulan', '$tahun', '$jumlah')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Gaji berhasil ditambahkan!'); window.location='gaji.php';</script>";
    } else {
        echo "Gagal menambah gaji: " . mysqli_error($koneksi);
    }
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Gaji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        .form-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            transition: transform 0.2s ease-in-out;
        }

        .btn-primary:hover {
            transform: scale(1.05);
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
            <h2 class="text-center mb-4">➕ Tambah Gaji</h2>
            <div class="form-container">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Karyawan</label>
                        <select class="form-control" name="karyawan_id" required>
                            <option value="">Pilih Karyawan</option>
                            <?php while ($row = mysqli_fetch_assoc($karyawanResult)) { ?>
                                <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bulan</label>
                        <input type="text" name="bulan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" name="tahun" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Gaji</label>
                        <input type="number" name="jumlah" class="form-control" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100">➕ Simpan</button>
                    <a href="gaji.php" class="btn btn-secondary w-100 mt-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>


</html>