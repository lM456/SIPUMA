<?php
$host = "localhost";
$user = "root";     // sesuaikan
$pass = "";         // sesuaikan
$db   = "sipuma";   // nama database kamu

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
