<?php
include('../config/conn.php');

// Pastikan ID karyawan dikirim melalui GET
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Ambil data karyawan berdasarkan ID
    $query = "SELECT * FROM karyawan WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    // Jika karyawan tidak ditemukan, tampilkan pesan error
    if (!$result || mysqli_num_rows($result) == 0) {
        die("Karyawan tidak ditemukan.");
    }

    $karyawan = mysqli_fetch_assoc($result);
} else {
    die("ID karyawan tidak valid.");
}

// Jika tombol "Update" diklik
if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $gaji = mysqli_real_escape_string($koneksi, $_POST['gaji']);

    // Update data di database
    $updateQuery = "UPDATE karyawan SET nama = '$nama', jabatan = '$jabatan', gaji = '$gaji' WHERE id = '$id'";
    $updateResult = mysqli_query($koneksi, $updateQuery);

    if ($updateResult) {
        echo "<script>
                alert('Karyawan berhasil diperbarui.');
                window.location.href = 'karyawan.php';
              </script>";
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karyawan</title>
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
            background-color: #007bff;
            border: none;
            transition: transform 0.2s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
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
            <h2 class="text-center mb-4"><i class="fa fa-edit text-primary"></i>Edit Karyawan</h2>
            <div class="form-container">

                <form method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Karyawan</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $karyawan['nama'] ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan"
                            value="<?= $karyawan['jabatan'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="gaji" class="form-label">Gaji</label>
                        <input type="number" class="form-control" id="gaji" name="gaji" value="<?= $karyawan['gaji'] ?>"
                            required>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary w-100">Update</button>
                    <a href="karyawan.php" class="btn btn-secondary w-100 mt-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>