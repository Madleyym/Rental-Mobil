<?php
session_start();
include 'koneksi.php';

// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php');
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nik_ktp = $_POST['nik_ktp'];
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO tbl_pelanggan_tryandaasu (
        nik_ktp_tryandaasu,
        nama_tryandaasu,
        no_hp_tryandaasu,
        alamat_tryandaasu
    ) VALUES ('$nik_ktp', '$nama', '$no_hp', '$alamat')";

    if ($conn->query($query)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan - Rental Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include './views/header.php'; ?>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Tambah Data Pelanggan</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="nik_ktp" class="form-label">NIK KTP</label>
                        <input type="text" class="form-control" id="nik_ktp" name="nik_ktp" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
                <!-- https://github.com/Madleyym/Rental-Mobil/blob/main/tambah_pelanggan.php -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>