<?php
session_start();
include 'koneksi.php';

// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php');
//     exit();
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_trx = $_POST['no_trx'];
    $nik_ktp = $_POST['nik_ktp'];
    $no_plat = $_POST['no_plat'];
    $tgl_rental = $_POST['tgl_rental'];
    $jam_rental = $_POST['jam_rental'];
    $harga = $_POST['harga'];
    $lama = $_POST['lama'];
    $total_bayar = $harga * $lama;

    $query = "INSERT INTO tbl_rental_tryandaasu (
        no_trx_tryandaasu,
        nik_ktp_tryandaasu,
        no_plat_tryandaasu,
        tgl_rental_tryandaasu,
        jam_rental_tryandaasu,
        harga_tryandaasu,
        lama_tryandaasu,
        total_bayar_tryandaasu
    ) VALUES (
        '$no_trx', '$nik_ktp', '$no_plat', '$tgl_rental', 
        '$jam_rental', '$harga', '$lama', '$total_bayar'
    )";

    if ($conn->query($query)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$query_mobil = "SELECT * FROM tbl_mobil_tryandaasu";
$result_mobil = $conn->query($query_mobil);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Rental - Rental Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Tambah Data Rental</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="no_trx" class="form-label">No Transaksi</label>
                        <input type="text" class="form-control" id="no_trx" name="no_trx" required>
                    </div>
                    <div class="mb-3">
                        <label for="nik_ktp" class="form-label">NIK KTP</label>
                        <input type="text" class="form-control" id="nik_ktp" name="nik_ktp" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_plat" class="form-label">Pilih Mobil</label>
                        <select class="form-control" id="no_plat" name="no_plat" required>
                            <option value="">Pilih Mobil</option>
                            <?php while ($row = $result_mobil->fetch_assoc()): ?>
                                <option value="<?= $row['no_plat_tryandaasu'] ?>">
                                    <?= $row['nama_mobil_tryandaasu'] ?> - <?= $row['no_plat_tryandaasu'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_rental" class="form-label">Tanggal Rental</label>
                        <input type="date" class="form-control" id="tgl_rental" name="tgl_rental" required>
                    </div>
                    <div class="mb-3">
                        <label for="jam_rental" class="form-label">Jam Rental</label>
                        <input type="time" class="form-control" id="jam_rental" name="jam_rental" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga per Hari</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="lama" class="form-label">Lama Rental (Hari)</label>
                        <input type="number" class="form-control" id="lama" name="lama" required>
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