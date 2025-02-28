<?php
include '../config/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];
    $gambar = "assets/avatar/default.png"; // Default avatar

    // Validasi email unik
    $cekEmail = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($cekEmail) > 0) {
        echo "<script>alert('Email sudah digunakan!');</script>";
    } else {
        // Upload gambar jika ada
        if (!empty($_FILES['gambar']['name'])) {
            $folderUpload = "uploads/";
            $namaFile = time() . "_" . basename($_FILES['gambar']['name']);
            $pathFile = $folderUpload . $namaFile;
            move_uploaded_file($_FILES['gambar']['tmp_name'], $pathFile);
            $gambar = $pathFile;
        }

        $query = "INSERT INTO users (nama, email, password, role, gambar) VALUES ('$nama', '$email', '$password', '$role', '$gambar')";
        if (mysqli_query($koneksi, $query)) {
            header("Location: users.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
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

        .btn-success {
            background-color: #28a745;
            border: none;
            transition: transform 0.2s ease-in-out;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .img-preview {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ddd;
            display: none;
            margin-top: 10px;
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
            <h2 class="text-center mb-4">➕ Tambah User</h2>

            <div class="form-container">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required minlength="6">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="karyawan">Karyawan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Profil</label>
                        <input type="file" name="gambar" class="form-control" id="gambarInput">
                        <img id="previewImg" class="img-preview">
                    </div>

                    <button type="submit" class="btn btn-success w-100">➕ Tambah</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("gambarInput").addEventListener("change", function (event) {
            let reader = new FileReader();
            reader.onload = function () {
                let preview = document.getElementById("previewImg");
                preview.src = reader.result;
                preview.style.display = "block";
            }
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>

</body>

</html>