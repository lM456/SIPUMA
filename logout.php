<?php
session_start();
require "config.php"; 

// 1. Catat Log Aktivitas Sebelum Sesi Dihapus
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Tentukan role untuk detail log
    $role_label = isset($_SESSION['role']) ? ucfirst($_SESSION['role']) : 'User';
    $aktivitas = "Logout ($role_label)";

    // Simpan ke log
    $stmt = $conn->prepare("INSERT INTO log_aktivitas (user_id, aktivitas, waktu) VALUES (?, ?, NOW())");
    // Pastikan tabel Anda punya kolom 'waktu', kalau tidak hapus NOW() dan kolomnya
    $stmt->bind_param("is", $user_id, $aktivitas);
    $stmt->execute();
    $stmt->close();
}

// 2. Bersihkan Variabel Session
$_SESSION = array();

// 3. Hapus Cookie Sesi (Penting untuk Keamanan Penuh)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. Hancurkan Sesi di Server
session_destroy();

// 5. Redirect ke Halaman Login Utama
header("Location: login.php");
exit;
?>
