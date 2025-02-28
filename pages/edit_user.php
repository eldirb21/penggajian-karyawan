<?php
include '../config/conn.php';
$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Jika ada update gambar
    $gambar = $user['gambar'];
    if ($_FILES['gambar']['name']) {
        $folderUpload = "uploads/";
        $namaFile = time() . "_" . basename($_FILES['gambar']['name']);
        $pathFile = $folderUpload . $namaFile;
        move_uploaded_file($_FILES['gambar']['tmp_name'], $pathFile);
        $gambar = $pathFile;
    }

    $query = "UPDATE users SET nama='$nama', email='$email', role='$role', gambar='$gambar' WHERE id=$id";
    if (mysqli_query($koneksi, $query)) {
        header("Location: users.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Edit User</title>
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

            <h2 class="text-center mb-4"><i class="fas fa-edit"></i>Edit User</h2>
            <div class="form-container">

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= $user['nama']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $user['email']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Role</label>
                        <select name="role" class="form-control">
                            <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                            <option value="karyawan" <?= ($user['role'] == 'karyawan') ? 'selected' : ''; ?>>Karyawan
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Profil</label>
                        <input type="file" name="gambar" class="form-control" id="gambarInput">
                        <img id="previewImg" class="img-preview">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Update</button>
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