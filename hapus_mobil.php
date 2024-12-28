<?php
include 'koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query_rental = "DELETE FROM tbl_rental_tryandaasu WHERE no_plat_tryandaasu = '$id'";
    $conn->query($query_rental);
    
    $query_mobil = "DELETE FROM tbl_mobil_tryandaasu WHERE no_plat_tryandaasu = '$id'";
    
    if ($conn->query($query_mobil)) {
        header('Location: mobil.php');
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan";
}
?>