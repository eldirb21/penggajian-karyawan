<?php
include("../config/conn.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM gaji WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);
    if (mysqli_num_rows($result) == 0) {
        die("Data tidak ditemukan.");
    }
    $gaji = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $jumlah = $_POST['jumlah'];

    $updateQuery = "UPDATE gaji SET bulan='$bulan', tahun='$tahun', jumlah='$jumlah' WHERE id='$id'";
    if (mysqli_query($koneksi, $updateQuery)) {
        echo "<script>alert('Gaji berhasil diperbarui!'); window.location='gaji.php';</script>";
    } else {
        echo "Gagal memperbarui gaji: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Gaji</title>
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
        <h2 class="text-center mb-4"><i class="fas fa-edit"></i> Edit Gaji</h2>
        <div class="form-container">

                <form method="post">
                    <div class="mb-3">
                        <label for="bulan" class="form-label">Bulan</label>
                        <input type="text" class="form-control" id="bulan" name="bulan" value="<?= $gaji['bulan'] ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" class="form-control" id="tahun" name="tahun" value="<?= $gaji['tahun'] ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah Gaji</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah"
                            value="<?= $gaji['jumlah'] ?>" required>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary w-100">Update</button>
                    <a href="gaji.php" class="btn btn-secondary w-100 mt-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>