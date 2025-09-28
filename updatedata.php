<?php
include "config.php";

$id       = $_POST['id'] ?? 0;
$redirect = $_POST['redirect'] ?? "datausaha.php";

$nama_lengkap   = $_POST['nama_lengkap'] ?? '';
$nik            = $_POST['nik'] ?? '';
$alamat_domisili= $_POST['alamat_domisili'] ?? '';
$no_hp          = $_POST['no_hp'] ?? '';
$nama_usaha     = $_POST['nama_usaha'] ?? '';
$omzet          = $_POST['omzet'] ?? 0;
$modal_awal     = $_POST['modal_awal'] ?? 0;

// Cek upload foto
$foto_usaha = '';
if (isset($_FILES['foto_usaha']) && $_FILES['foto_usaha']['error'] == 0) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $fileName = time() . "_" . basename($_FILES["foto_usaha"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["foto_usaha"]["tmp_name"], $targetFilePath)) {
        $foto_usaha = $targetFilePath;
    }
}

if ($id > 0 && $nama_lengkap && $nik) {
    if ($foto_usaha) {
        $stmt = $conn->prepare("UPDATE umkm SET nama_lengkap=?, nik=?, alamat_domisili=?, no_hp=?, nama_usaha=?, omzet=?, modal_awal=?, foto_usaha=? WHERE id=?");
        $stmt->bind_param("sssssiisi", $nama_lengkap, $nik, $alamat_domisili, $no_hp, $nama_usaha, $omzet, $modal_awal, $foto_usaha, $id);
    } else {
        $stmt = $conn->prepare("UPDATE umkm SET nama_lengkap=?, nik=?, alamat_domisili=?, no_hp=?, nama_usaha=?, omzet=?, modal_awal=? WHERE id=?");
        $stmt->bind_param("sssssiii", $nama_lengkap, $nik, $alamat_domisili, $no_hp, $nama_usaha, $omzet, $modal_awal, $id);
    }

    if ($stmt->execute()) {
        header("Location: $redirect?msg=updated");
    } else {
        header("Location: $redirect?msg=error");
    }
    $stmt->close();
} else {
    header("Location: $redirect?msg=invalid");
}
exit;
