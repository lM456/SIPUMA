<?php
session_start();
require "config.php"; // koneksi ke database

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $aktivitas = "Logout (User)";
    
    // Simpan log dengan timestamp otomatis
    $stmt = $conn->prepare("INSERT INTO log_aktivitas (user_id, aktivitas) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $aktivitas);
    if (!$stmt->execute()) {
        error_log("Gagal insert log logout: " . $stmt->error);
    }
    $stmt->close();
}

// Hapus semua session
session_unset();
session_destroy();

// Redirect ke login
header("Location: login.php");
exit;
