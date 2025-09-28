<?php
session_start();

// Hapus semua variabel sesi
$_SESSION = [];

// Hancurkan sesi
session_destroy();

// Arahkan kembali ke halaman login
header("Location: login.php");
exit;
?>
