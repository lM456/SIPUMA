<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit;
}
require_once 'config.php';

$user_id = $_SESSION['user_id'];
$query = $conn->prepare("SELECT username FROM users WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Akun Saya - SIPUMA</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f7f9fb;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 500px;
      margin: 100px auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      text-align: center;
    }

    h2 {
      margin-bottom: 20px;
      color: #333;
    }

    .avatar {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-bottom: 20px;
      object-fit: cover;
      border: 4px solid #16a085;
    }

    .username {
      font-size: 22px;
      font-weight: 600;
      color: #16a085;
      margin-bottom: 10px;
    }

    .btn-logout {
      background-color: #e74c3c;
      color: #fff;
      padding: 10px 25px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      text-decoration: none;
    }

    .btn-logout:hover {
      background-color: #c0392b;
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="img/avatardefault_92824.png" alt="Avatar" class="avatar">
    <div class="username">@<?= htmlspecialchars($user['username']); ?></div>
    <p>Selamat datang di halaman akun Anda.</p>
    <a href="logout.php" class="btn-logout">Logout</a>
  </div>
</body>
</html>
