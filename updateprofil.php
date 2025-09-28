<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $folder = 'uploads/';
    $filename = basename($_FILES['foto']['name']);
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($ext, $allowed)) {
        echo "Format file tidak didukung.";
        exit;
    }

    $newName = uniqid() . '.' . $ext;
    $targetPath = $folder . $newName;

    if (!is_dir($folder)) {
        mkdir($folder, 0755, true);
    }

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetPath)) {
        // Simpan path ke database
        $stmt = $conn->prepare("UPDATE users SET foto = ? WHERE id = ?");
        $stmt->bind_param("si", $targetPath, $userId);
        $stmt->execute();
        $stmt->close();

        header("Location: profil.php");
        exit;
    } else {
        echo "Gagal upload file.";
    }
} else {
    echo "Tidak ada file yang diunggah.";
}
?>
