<?php
session_start();
// if (!isset($_SESSION['user'])) {
//     header("Location: login.php");
//     exit();
// }
include('../config/conn.php');



$user_id = $_SESSION['id'];
$query_user = mysqli_query($koneksi, "SELECT * FROM users WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($query_user);
$user_json = json_encode($user);

echo "<script>console.log('Debug Objects: " . $user_json . "' );</script>";

// Ambil data total user
$totalUserQuery = "SELECT COUNT(*) as total_user FROM users";
$totalUserResult = mysqli_query($koneksi, $totalUserQuery);
$totalUser = mysqli_fetch_assoc($totalUserResult)['total_user'];

// Ambil data total karyawan
$totalKaryawanQuery = "SELECT COUNT(*) as total_karyawan FROM karyawan";
$totalKaryawanResult = mysqli_query($koneksi, $totalKaryawanQuery);
$totalKaryawan = mysqli_fetch_assoc($totalKaryawanResult)['total_karyawan'];

// Ambil total gaji keseluruhan
$totalGajiQuery = "SELECT SUM(jumlah) as total_gaji FROM gaji";
$totalGajiResult = mysqli_query($koneksi, $totalGajiQuery);
$totalGaji = mysqli_fetch_assoc($totalGajiResult)['total_gaji'];

// Ambil data total gaji per bulan untuk grafik
$query = "SELECT bulan, tahun, SUM(jumlah) as total_gaji FROM gaji GROUP BY bulan, tahun ORDER BY tahun, bulan";
$result = mysqli_query($koneksi, $query);

$bulan = [];
$total_gaji = [];

while ($row = mysqli_fetch_assoc($result)) {
    $bulan[] = $row['bulan'] . " " . $row['tahun'];
    $total_gaji[] = $row['total_gaji'];
}

// Encode data ke JSON
$bulan_json = json_encode($bulan);
$total_gaji_json = json_encode($total_gaji);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
        }

        .chart-container {
            width: 80%;
            max-width: 800px;
            margin: auto;
        }

        .stat-box {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            color: white;
            font-size: 20px;
            font-weight: bold;
        }

        .bg-blue {
            background-color: #3498db;
        }

        .bg-green {
            background-color: #2ecc71;
        }

        .bg-orange {
            background-color: #f39c12;
        }
    </style>
</head>

<body>

    <?php include('../components/sidebar.php'); ?>

    <div class="main-content">
        <?php
        $headerData = [
            "currentUser" => $user_json,
        ];
        include('../components/header.php'); ?>

        <div class="container">
            <h2 class="mt-4 text-center">📊 Dashboard Statistik</h2>

            <!-- Kotak Statistik -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="stat-box bg-blue">
                        <h4>Total User</h4>
                        <p><?php echo $totalUser; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-box bg-green">
                        <h4>Total Karyawan</h4>
                        <p><?php echo $totalKaryawan; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-box bg-orange">
                        <h4>Total Gaji</h4>
                        <p>Rp <?php echo number_format($totalGaji, 0, ',', '.'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Grafik -->
            <div class="chart-container mt-4">
                <canvas id="gajiChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Data dari PHP (JSON)
        const bulan = <?php echo $bulan_json; ?>;
        const totalGaji = <?php echo $total_gaji_json; ?>;

        // Konfigurasi Chart.js
        const ctx = document.getElementById('gajiChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: bulan,
                datasets: [{
                    label: 'Total Gaji (Rp)',
                    data: totalGaji,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'Total Gaji per Bulan',
                        font: { size: 16 }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { callback: value => 'Rp ' + value.toLocaleString('id-ID') }
                    }
                }
            }
        });
    </script>

</body>

</html>