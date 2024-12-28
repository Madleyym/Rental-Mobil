<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM tbl_mobil_tryandaasu WHERE no_plat_tryandaasu = '$id'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_plat = $_POST['no_plat'];
    $nama_mobil = $_POST['nama_mobil'];
    $brand_mobil = $_POST['brand_mobil'];
    $tipe_transmisi = $_POST['tipe_transmisi'];

    $query_update = "UPDATE tbl_mobil_tryandaasu SET nama_mobil_tryandaasu = '$nama_mobil', brand_mobil_tryandaasu = '$brand_mobil', tipe_transmisi_tryandaasu = '$tipe_transmisi' WHERE no_plat_tryandaasu = '$no_plat'";

    if ($conn->query($query_update)) {
        header('Location: mobil.php');
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
    <title>Edit Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Data Mobil</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="no_plat" class="form-label">No Plat</label>
                <input type="text" class="form-control" id="no_plat" name="no_plat" value="<?php echo $row['no_plat_tryandaasu']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nama_mobil" class="form-label">Nama Mobil</label>
                <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" value="<?php echo $row['nama_mobil_tryandaasu']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="brand_mobil" class="form-label">Brand Mobil</label>
                <input type="text" class="form-control" id="brand_mobil" name="brand_mobil" value="<?php echo $row['brand_mobil_tryandaasu']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tipe_transmisi" class="form-label">Tipe Transmisi</label>
                <select class="form-control" id="tipe_transmisi" name="tipe_transmisi" required>
                    <option value="Manual" <?php echo ($row['tipe_transmisi_tryandaasu'] == 'Manual') ? 'selected' : ''; ?>>Manual</option>
                    <option value="Matic" <?php echo ($row['tipe_transmisi_tryandaasu'] == 'Matic') ? 'selected' : ''; ?>>Matic</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
