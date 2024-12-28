<?php
include 'koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Hapus data rental berdasarkan nomor transaksi
    $query = "DELETE FROM tbl_rental_tryandaasu WHERE no_trx_tryandaasu = '$id'";
    
    if ($conn->query($query)) {
        header('Location: rental.php');
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan";
}
?>