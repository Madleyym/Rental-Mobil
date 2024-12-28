<?php
function checkLogin()
{
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        // Jika belum login, arahkan ke halaman login
        header('Location: login.php');
        exit;
    }
}

function redirectIfNotLoggedIn() {
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        header('Location: login.php');
        exit;
    }
}

function formatRupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}
?>