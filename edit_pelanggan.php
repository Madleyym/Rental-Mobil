<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM tbl_pelanggan_tryandaasu WHERE nik_ktp_tryandaasu = '$id'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nik_ktp = $_POST['nik_ktp'];
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    $query_update = "UPDATE tbl_pelanggan_tryandaasu SET 
                    nama_tryandaasu = '$nama', 
                    no_hp_tryandaasu = '$no_hp', 
                    alamat_tryandaasu = '$alamat' 
                    WHERE nik_ktp_tryandaasu = '$nik_ktp'";

    if ($conn->query($query_update)) {
        header('Location: index.php');
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
    <title>Edit Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Data Pelanggan</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nik_ktp" class="form-label">NIK KTP</label>
                <input type="text" class="form-control" id="nik_ktp" name="nik_ktp" value="<?php echo $row['nik_ktp_tryandaasu']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama_tryandaasu']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">Nomor HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $row['no_hp_tryandaasu']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" required><?php echo $row['alamat_tryandaasu']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>