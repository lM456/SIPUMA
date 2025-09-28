<?php
session_start();
require "config.php"; // koneksi database

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Simpan log aktivitas logout admin
    $aktivitas = "Admin logout";
    $stmt = $conn->prepare("INSERT INTO log_aktivitas (user_id, aktivitas) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $aktivitas);
    $stmt->execute();
    $stmt->close();
}

// Hapus semua session admin
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['nama']);
unset($_SESSION['role']);
unset($_SESSION['email']);

// Redirect ke halaman login khusus admin
header("Location: loginadmin.php");
exit;
