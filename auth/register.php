<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: url('assets/background/background-1.png') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            text-align: center;
            position: relative;
            z-index: 2;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-container h2 {
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-register {
            background: #4facfe;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            transition: 0.3s;
            width: 100%;
            color: white;
        }

        .btn-register:hover {
            background: #00c6ff;
        }

        .text-center a {
            color: #4facfe;
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .avatar-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h2>Registrasi</h2>
        <form action="prosesRegist.php" method="post" enctype="multipart/form-data">
            <div class="mb-3 text-center">
                <img id="avatarPreview" src="assets/avatar/default.png" alt="Avatar" class="avatar-preview">
            </div>
            <input type="file" name="gambar" accept="image/*" class="form-control" onchange="previewImage(event)"
                required>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="nama" class="form-control" placeholder="Nama lengkap" required>
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user-tag"></i></span>
                    <select name="role" class="form-control" required>
                        <option value="karyawan" selected>Karyawan</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-register"><i class="fa-solid fa-user-check"></i> Daftar</button>
        </form>
        <p class="text-center mt-3">Sudah punya akun? <a href="login.php">Login</a></p>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                document.getElementById('avatarPreview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>