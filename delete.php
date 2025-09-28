<?php
include "config.php";

$id    = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$level = isset($_GET['level']) ? (int) $_GET['level'] : 0;

// mapping redirect berdasarkan level
$redirects = [
    1 => "umkm_substensi.php",
    2 => "umkm_sukses.php",
    3 => "umkm_digital.php",
    4 => "umkm_ekspor.php"
];

$redirect = $redirects[$level] ?? "adminberanda.php";

if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM umkm WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: $redirect?msg=deleted");
    } else {
        header("Location: $redirect?msg=error");
    }
    $stmt->close();
} else {
    header("Location: $redirect?msg=invalid");
}
exit;
