<?php
require 'config.php';

// Default filter
$where = "1=1";

// Cari
if (!empty($_GET['cari'])) {
    $cari = $conn->real_escape_string($_GET['cari']);
    $where .= " AND (user_id LIKE '%$cari%' OR aktivitas LIKE '%$cari%')";
}

// Filter tanggal
if (!empty($_GET['dari']) && !empty($_GET['sampai'])) {
    $dari = $conn->real_escape_string($_GET['dari']);
    $sampai = $conn->real_escape_string($_GET['sampai']);
    $where .= " AND DATE(created_at) BETWEEN '$dari' AND '$sampai'";
}

// Ambil data
$result = $conn->query("SELECT created_at, user_id, aktivitas FROM log_aktivitas WHERE $where ORDER BY created_at DESC");

// Set header untuk download file CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=log_aktivitas.csv');

// Output ke file
$output = fopen('php://output', 'w');

// Header kolom
fputcsv($output, ['Waktu', 'User ID', 'Aktivitas']);

// Data isi
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [
            date('d-m-Y H:i', strtotime($row['created_at'])),
            $row['user_id'],
            $row['aktivitas']
        ]);
    }
}
fclose($output);
exit;
?>
