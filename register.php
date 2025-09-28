<?php
require 'config.php';
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama_lengkap']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // cek apakah email atau username sudah ada
    $check = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $check->bind_param("ss", $email, $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $msg = "Email atau Username sudah digunakan.";
    } else {
        // insert ke database
        $stmt = $conn->prepare("INSERT INTO users (nama_lengkap, email, username, password, role) VALUES (?, ?, ?, ?, 'user')");
        $stmt->bind_param("ssss", $nama, $email, $username, $password);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            $msg = "Terjadi kesalahan, coba lagi.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Registrasi SIPUMA</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(rgba(10, 43, 99, 0.85), rgba(10, 43, 99, 0.85)), url('img/Desain tanpa judul.png') center/cover no-repeat;
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
      padding: 2rem;
      border-radius: 12px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    }
    .form-box h2 {text-align:center;margin-bottom:1rem;}
    label {display:block;margin-top:1rem;font-weight:600;}
    input {
      width: 100%;
      padding: 0.6rem;
      border-radius: 6px;
      border: 1px solid #ccc;
      margin-top: 0.3rem;
    }
    button {
      margin-top: 1.5rem;
      width: 100%;
      background: #fdf300;
      border: none;
      padding: 0.7rem;
      font-weight: bold;
      border-radius: 6px;
      cursor: pointer;
    }
    .msg {color:red;text-align:center;margin-top:1rem;}
    .login-link {text-align:center;margin-top:1rem;}
    .login-link a {color:#0a2b63;text-decoration:underline;}
  </style>
</head>
<body>
  <div class="form-box">
    <h2>Registrasi SIPUMA</h2>
    <form method="POST">
      <label>Nama Lengkap</label>
      <input type="text" name="nama_lengkap" required>

      <label>Email</label>
      <input type="email" name="email" required>

      <label>Username</label>
      <input type="text" name="username" required>

      <label>Password</label>
      <input type="password" name="password" required>

      <button type="submit">Daftar</button>
      <div class="login-link">Sudah punya akun? <a href="login.php">Login di sini</a></div>
      <div class="msg"><?= $msg ?></div>
    </form>
  </div>
</body>
</html>
