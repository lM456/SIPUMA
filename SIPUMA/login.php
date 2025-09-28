<?php
session_start();
require 'config.php';
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, nama_lengkap, email, password, foto FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $nama, $email_result, $hashed_password, $foto);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['nama'] = $nama;
            $_SESSION['email'] = $email_result;
            $_SESSION['foto'] = $foto ?: 'img/avatardefault_92824.png';
            header("Location: index.php");
            exit;
        } else {
            $msg = "Password salah.";
        }
    } else {
        $msg = "Email tidak terdaftar.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Login SIPUMA</title>
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

    .form-box h2 {
      text-align: center;
      margin-bottom: 1rem;
    }

    label {
      display: block;
      margin-top: 1rem;
      font-weight: 600;
    }

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

    .msg {
      color: red;
      text-align: center;
      margin-top: 1rem;
    }

    .login-link {
      text-align: center;
      margin-top: 1rem;
    }

    .login-link a {
      color: #0a2b63;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="form-box">
    <h2>Login SIPUMA</h2>
    <form method="POST">
      <label>Email</label>
      <input type="email" name="email" required>
      <label>Password</label>
      <input type="password" name="password" required>
      <button type="submit">Login</button>
      <div class="login-link">Belum punya akun? <a href="register.php">Daftar di sini</a></div>
      <div class="msg"><?= $msg ?></div>
    </form>
  </div>
</body>
</html>
