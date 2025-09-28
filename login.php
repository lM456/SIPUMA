<?php
session_start();
require 'config.php';
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; 
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, nama_lengkap, username, password, role, email 
                            FROM users 
                            WHERE username = ? AND role = 'user'");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $nama, $username_result, $hashed_password, $role, $email_result);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id']  = $id;
            $_SESSION['nama']     = $nama;
            $_SESSION['username'] = $username_result;
            $_SESSION['role']     = $role;
            $_SESSION['email']    = $email_result;

            // log aktivitas
            $aktivitas = "User login ke sistem";
            $log = $conn->prepare("INSERT INTO log_aktivitas (user_id, aktivitas) VALUES (?, ?)");
            $log->bind_param("is", $id, $aktivitas);
            $log->execute();

            header("Location: index.php");
            exit;
        } else {
            $msg = "Password salah.";
        }
    } else {
        $msg = "Username tidak ditemukan atau bukan user.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Login User - SIPUMA</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
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
      padding: 2rem;
      border-radius: 12px;
      max-width: 400px;
      width: 100%;
      box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    }
    h2 { text-align: center; margin-bottom: 1rem; }
    label { display: block; margin-top: 1rem; font-weight: 600; }
    input {
      width: 100%; padding: 0.6rem; border-radius: 6px;
      border: 1px solid #ccc; margin-top: 0.3rem;
    }
    button {
      margin-top: 1.5rem; width: 100%; background: #fdf300;
      border: none; padding: 0.7rem; font-weight: bold;
      border-radius: 6px; cursor: pointer;
    }
    .msg { color: red; text-align: center; margin-top: 1rem; }
    .login-link { text-align: center; margin-top: 1rem; }
    .login-link a { color: #0a2b63; text-decoration: underline; }
  </style>
</head>
<body>
  <div class="form-box">
    <h2>Login SIPUMA</h2>
    <form method="POST">
      <label>Username</label>
      <input type="text" name="username" required>
      <label>Password</label>
      <input type="password" name="password" required>
      <button type="submit">Login</button>
      <div class="login-link">Belum punya akun? <a href="register.php">Daftar</a></div>
      <div class="msg"><?= $msg ?></div>
    </form>
  </div>
</body>
</html>
