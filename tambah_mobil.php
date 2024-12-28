<?php
session_start();
include 'koneksi.php';

// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php');
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_plat = $_POST['no_plat'];
    $nama_mobil = $_POST['nama_mobil'];
    $brand_mobil = $_POST['brand_mobil'];
    $tipe_transmisi = $_POST['tipe_transmisi'];

    $query = "INSERT INTO tbl_mobil_tryandaasu (no_plat_tryandaasu, nama_mobil_tryandaasu, brand_mobil_tryandaasu, tipe_transmisi_tryandaasu) 
              VALUES ('$no_plat', '$nama_mobil', '$brand_mobil', '$tipe_transmisi')";

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
    <title>Tambah Mobil - Rental Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include './views/header.php'; ?>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Tambah Data Mobil</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="no_plat" class="form-label">No Plat</label>
                        <input type="text" class="form-control" id="no_plat" name="no_plat" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_mobil" class="form-label">Nama Mobil</label>
                        <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" required>
                    </div>
                    <div class="mb-3">
                        <label for="brand_mobil" class="form-label">Brand Mobil</label>
                        <input type="text" class="form-control" id="brand_mobil" name="brand_mobil" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipe_transmisi" class="form-label">Tipe Transmisi</label>
                        <select class="form-control" id="tipe_transmisi" name="tipe_transmisi" required>
                            <option value="">Pilih Tipe Transmisi</option>
                            <option value="Manual">Manual</option>
                            <option value="Matic">Matic</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>