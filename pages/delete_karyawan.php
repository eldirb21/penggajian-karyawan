<?php
include('../config/conn.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Cek apakah karyawan dengan ID ini ada
    $checkQuery = "SELECT * FROM karyawan WHERE id = '$id'";
    $checkResult = mysqli_query($koneksi, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Hapus karyawan
        $deleteQuery = "DELETE FROM karyawan WHERE id = '$id'";
        if (mysqli_query($koneksi, $deleteQuery)) {
            echo "<script>
                    alert('Karyawan berhasil dihapus.');
                    window.location.href = 'karyawan.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal menghapus karyawan.');
                    window.location.href = 'karyawan.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Karyawan tidak ditemukan.');
                window.location.href = 'karyawan.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID karyawan tidak valid.');
            window.location.href = 'karyawan.php';
          </script>";
}
?>