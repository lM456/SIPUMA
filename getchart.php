<?php
session_start();
if (!isset($_SESSION['user_id'])) { http_response_code(403); exit; }
include "config.php";

$query = "SELECT level_umkm, COUNT(*) as total FROM umkm GROUP BY level_umkm";
$result = $conn->query($query);

$jumlah_level = [1=>0,2=>0,3=>0,4=>0];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $level = (int)$row['level_umkm'];
        $jumlah_level[$level] = (int)$row['total'];
    }
}
$conn->close();
header('Content-Type: application/json');
echo json_encode($jumlah_level);
