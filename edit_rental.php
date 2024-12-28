<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM tbl_rental_tryandaasu WHERE no_trx_tryandaasu = '$id'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_trx = $_POST['no_trx'];
    $nik_ktp = $_POST['nik_ktp'];
    $no_plat = $_POST['no_plat'];
    $tgl_rental = $_POST['tgl_rental'];
    $jam_rental = $_POST['jam_rental'];
    $harga = $_POST['harga'];
    $lama = $_POST['lama'];
    $total_bayar = $_POST['total_bayar'];

    $query_update = "UPDATE tbl_rental_tryandaasu SET 
                    nik_ktp_tryandaasu = '$nik_ktp',
                    no_plat_tryandaasu = '$no_plat',
                    tgl_rental_tryandaasu = '$tgl_rental',
                    jam_rental_tryandaasu = '$jam_rental',
                    harga_tryandaasu = '$harga',
                    lama_tryandaasu = '$lama',
                    total_bayar_tryandaasu = '$total_bayar'
                    WHERE no_trx_tryandaasu = '$no_trx'";

    if ($conn->query($query_update)) {
        header('Location: rental.php');
    } else {
        echo "Error: " . $conn->error;
    }
}

// Query untuk dropdown pelanggan dan mobil
$query_pelanggan = "SELECT * FROM tbl_pelanggan_tryandaasu";
$result_pelanggan = $conn->query($query_pelanggan);

$query_mobil = "SELECT * FROM tbl_mobil_tryandaasu";
$result_mobil = $conn->query($query_mobil);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Data Rental</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="no_trx" class="form-label">No Transaksi</label>
                <input type="text" class="form-control" id="no_trx" name="no_trx" value="<?php echo $row['no_trx_tryandaasu']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nik_ktp" class="form-label">Pelanggan</label>
                <select class="form-control" id="nik_ktp" name="nik_ktp" required>
                    <?php while($pelanggan = $result_pelanggan->fetch_assoc()): ?>
                        <option value="<?php echo $pelanggan['nik_ktp_tryandaasu']; ?>" <?php echo ($pelanggan['nik_ktp_tryandaasu'] == $row['nik_ktp_tryandaasu']) ? 'selected' : ''; ?>>
                            <?php echo $pelanggan['nama_tryandaasu']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="no_plat" class="form-label">Mobil</label>
                <select class="form-control" id="no_plat" name="no_plat" required>
                    <?php while($mobil = $result_mobil->fetch_assoc()): ?>
                        <option value="<?php echo $mobil['no_plat_tryandaasu']; ?>" <?php echo ($mobil['no_plat_tryandaasu'] == $row['no_plat_tryandaasu']) ? 'selected' : ''; ?>>
                            <?php echo $mobil['nama_mobil_tryandaasu']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tgl_rental" class="form-label">Tanggal Rental</label>
                <input type="date" class="form-control" id="tgl_rental" name="tgl_rental" value="<?php echo $row['tgl_rental_tryandaasu']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jam_rental" class="form-label">Jam Rental</label>
                <input type="time" class="form-control" id="jam_rental" name="jam_rental" value="<?php echo $row['jam_rental_tryandaasu']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $row['harga_tryandaasu']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="lama" class="form-label">Lama Rental (hari)</label>
                <input type="number" class="form-control" id="lama" name="lama" value="<?php echo $row['lama_tryandaasu']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="total_bayar" class="form-label">Total Bayar</label>
                <input type="number" class="form-control" id="total_bayar" name="total_bayar" value="<?php echo $row['total_bayar_tryandaasu']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    
    <script>
    // Hitung total bayar otomatis
    document.getElementById('harga').addEventListener('input', hitungTotal);
    document.getElementById('lama').addEventListener('input', hitungTotal);

    function hitungTotal() {
        const harga = document.getElementById('harga').value;
        const lama = document.getElementById('lama').value;
        const total = harga * lama;
        document.getElementById('total_bayar').value = total;
    }
    </script>
</body>
</html>