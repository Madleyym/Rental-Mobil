<?php
session_start();

// Debugging: Pastikan sesi dimulai
error_log("Session before destroy: " . session_id());

// Hapus semua variabel sesi
session_unset();
session_destroy();  // Hancurkan sesi

// Debugging: Cek apakah sesi sudah dihancurkan
error_log("Session after destroy: " . session_id());

header('Location: login.php');  // Arahkan ke halaman login
exit;
