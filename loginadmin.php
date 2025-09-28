<?php
session_start();
require "config.php"; // koneksi database

// === Pastikan admin ada dan password sesuai ===
$username = "admin";
$email = "admin@example.com";
$passwordDefault = "admin123"; 
$nama = "Administrator";

// cek apakah admin sudah ada
$checkAdmin = $conn->query("SELECT * FROM users WHERE role='admin' LIMIT 1");

if ($checkAdmin->num_rows === 0) {
    // kalau belum ada → buat baru
    $hash = password_hash($passwordDefault, PASSWORD_BCRYPT);
    $insert = $conn->prepare("INSERT INTO users (username, email, password, nama_lengkap, role, tanggal_daftar) VALUES (?, ?, ?, ?, 'admin', NOW())");
    $insert->bind_param("ssss", $username, $email, $hash, $nama);
    $insert->execute();

    echo "✅ Akun admin baru berhasil dibuat.<br>";
    echo "Username: {$username} | Password: {$passwordDefault}<br>";
    echo "Silakan login kembali.";
    exit;
} else {
    // kalau sudah ada → pastikan password = admin123
    $admin = $checkAdmin->fetch_assoc();
    if (!password_verify($passwordDefault, $admin['password'])) {
        $newHash = password_hash($passwordDefault, PASSWORD_BCRYPT);
        $update = $conn->prepare("UPDATE users SET password=? WHERE id=?");
        $update->bind_param("si", $newHash, $admin['id']);
        $update->execute();
    }
}

// === Proses login ===
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM users WHERE username = ? AND role = 'admin' LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];

            header("Location: adminberanda.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username admin tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; display: flex; height: 100vh; align-items: center; justify-content: center; }
        .login-box { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); width: 300px; }
        h2 { text-align: center; margin-bottom: 20px; color: #1e3a8a; }
        input { width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #ddd; border-radius: 6px; }
        button { width: 100%; padding: 10px; background: #1e3a8a; color: white; border: none; border-radius: 6px; cursor: pointer; }
        button:hover { background: #3b82f6; }
        .error { color: red; font-size: 14px; text-align: center; margin-top: 10px; }
        .note { font-size: 13px; color: #444; background: #f0f0f0; padding: 8px; border-radius: 6px; margin-top: 15px; text-align: center; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login Admin</h2>
        <form method="post" autocomplete="off">
            <input type="text" name="username" placeholder="Username Admin" required autocomplete="off">
            <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
            <button type="submit">Login</button>
            <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        </form>
        <div class="note">
            <strong>Catatan:</strong><br>
            Username: <code>admin</code><br>
            Password: <code>admin123</code>
        </div>
    </div>
</body>
</html>
