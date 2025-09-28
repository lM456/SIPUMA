<?php 
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}
require_once 'config.php';

$user_id = $_SESSION['user_id'];
$query = $conn->prepare("SELECT username, nama_lengkap, email FROM users WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

$foto = 'img/avatardefault_92824.png';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil Saya - SIPUMA</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(rgba(10, 43, 99, 0.85), rgba(10, 43, 99, 0.85)), 
              url('img/Desain tanpa judul.png') center/cover no-repeat;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
  color: white;
}

.form-box {
  background: white;
  color: #0a2b63;
  padding: 1.2rem 1.5rem;
  border-radius: 12px;
  max-width: 300px;
  width: 90%;
  box-shadow: 0 4px 15px rgba(0,0,0,0.2);
  text-align: left;
}

h2 {
  text-align: center;
  margin-bottom: 0.8rem;
  font-size: 1.2rem;
}

label {
  display: block;
  margin-top: 0.6rem;
  font-weight: 600;
  color: #16a085;
  font-size: 0.85rem;
}

input {
  width: 100%;
  padding: 0.45rem;
  border-radius: 5px;
  border: 1px solid #ccc;
  margin-top: 0.25rem;
  background: #f0f0f0;
  color: #333;
  font-size: 0.85rem;
}

.avatar {
  display: block;
  margin: 0 auto 12px auto;
  width: 70px;
  height: 70px;
  border-radius: 50%;
  border: 3px solid #16a085;
}

.btn {
  padding: 0.55rem 1.5rem;
  border-radius: 6px;
  cursor: pointer;
  text-decoration: none;
  display: inline-block;
  font-weight: 600;
  font-size: 0.85rem;
  color: white;
  text-align: center;
}

.button-group {
  text-align: center;
  margin-top: 0.6rem;
}

.btn-back {
  background-color: #3498db;
}

.btn-back:hover {
  background-color: #2980b9;
}

.btn-logout {
  background-color: #e74c3c;
  margin-left: 8px;
}

.btn-logout:hover {
  background-color: #c0392b;
}
</style>
</head>
<body>
<div class="form-box">
  <h2>Profil Saya</h2>
  <img src="<?= htmlspecialchars($foto) ?>" alt="Avatar" class="avatar">
  
  <label>Username</label>
  <input type="text" value="<?= htmlspecialchars($user['username']); ?>" readonly>
  
  <label>Nama Lengkap</label>
  <input type="text" value="<?= htmlspecialchars($user['nama_lengkap']); ?>" readonly>
  
  <label>Email</label>
  <input type="email" value="<?= htmlspecialchars($user['email']); ?>" readonly>

  <div class="button-group">
    <a href="index.php" class="btn btn-back">Kembali</a>
    <a href="logout.php" class="btn btn-logout">Logout</a>
  </div>
</div>
</body>
</html>
