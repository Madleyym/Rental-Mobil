<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "DELETE FROM tbl_mobil_tryandaasu WHERE no_plat_tryandaasu = '$id'";

if ($conn->query($query)) {
    header('Location: mobil.php');
} else {
    echo "Error: " . $conn->error;
}
?>