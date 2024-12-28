<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'koneksi.php';
require_once 'functions.php';

session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: login.php'); 
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil - Tryandaasu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Rental Mobil Tryandaasu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="mobil.php">Data Mobil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pelanggan.php">Data Pelanggan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rental.php">Data Rental</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Mobil</h5>
                        <?php
                        $result = $conn->query("SELECT COUNT(*) as total FROM tbl_mobil_tryandaasu");
                        $total_mobil = $result->fetch_assoc()['total'];
                        ?>
                        <h2><?php echo $total_mobil; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Total Pelanggan</h5>
                        <?php
                        $result = $conn->query("SELECT COUNT(*) as total FROM tbl_pelanggan_tryandaasu");
                        $total_pelanggan = $result->fetch_assoc()['total'];
                        ?>
                        <h2><?php echo $total_pelanggan; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Total Rental Aktif</h5>
                        <?php
                        $result = $conn->query("SELECT COUNT(*) as total FROM tbl_rental_tryandaasu WHERE tgl_rental_tryandaasu = CURDATE()");
                        $total_rental = $result->fetch_assoc()['total'];
                        ?>
                        <h2><?php echo $total_rental; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Pendapatan Hari Ini</h5>
                        <?php
                        $result = $conn->query("SELECT SUM(total_bayar_tryandaasu) as total FROM tbl_rental_tryandaasu WHERE tgl_rental_tryandaasu = CURDATE()");
                        $total_pendapatan = $result->fetch_assoc()['total'] ?? 0;
                        ?>
                        <h2>Rp <?php echo number_format($total_pendapatan, 0, ',', '.'); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
</body>

</html>