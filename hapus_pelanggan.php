<?php
include 'koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Hapus data pelanggan
    $query = "DELETE FROM tbl_pelanggan_tryandaasu WHERE nik_ktp_tryandaasu = '$id'";
    
    if ($conn->query($query)) {
        header('Location: pelanggan.php');
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan";
}
?>