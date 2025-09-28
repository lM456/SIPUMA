<?php
require "config.php"; // koneksi database

function catatLog($user_id, $aktivitas, $conn) {
    $stmt = $conn->prepare("INSERT INTO log_aktivitas (user_id, aktivitas) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $aktivitas);
    $stmt->execute();
    $stmt->close();
}
?>
