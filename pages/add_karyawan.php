<?php
include('../config/conn.php');

if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $gaji = mysqli_real_escape_string($koneksi, $_POST['gaji']);
    $user_id = mysqli_real_escape_string($koneksi, $_POST['user_id']);

    $query = "INSERT INTO karyawan (nama, jabatan, gaji, user_id) VALUES ('$nama', '$jabatan', '$gaji', '$user_id')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data karyawan berhasil ditambahkan!'); window.location.href='karyawan.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

$queryUsers = "SELECT id, nama FROM users WHERE role = 'karyawan'";
$resultUsers = mysqli_query($koneksi, $queryUsers);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>
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
            <h2 class="text-center mb-4">➕ Tambah Karyawan</h2>

            <div class="form-container">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Karyawan</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="gaji" class="form-label">Gaji</label>
                        <input type="number" name="gaji" id="gaji" class="form-control" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Akun Karyawan</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">Pilih Akun Karyawan</option>
                            <?php while ($row = mysqli_fetch_assoc($resultUsers)) { ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['nama']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100">➕ Tambah</button>
                    <a href="karyawan.php" class="btn btn-secondary w-100 mt-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>