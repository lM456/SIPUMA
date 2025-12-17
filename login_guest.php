<?php
session_start();
require 'config.php'; // Jika butuh koneksi DB

// Set Session Tamu
session_regenerate_id(true);
$_SESSION['user_id'] = 0; // ID dummy
$_SESSION['nama'] = 'Pengunjung Tamu';
$_SESSION['role'] = 'guest';
$_SESSION['login_time'] = time();

// (Opsional) Catat Log
// $stmt = $conn->prepare("INSERT INTO log_aktivitas ...");
// $stmt->execute();

// Redirect ke dashboard tamu (yang nanti dibuat)
header("Location: index.php");
exit;
?>