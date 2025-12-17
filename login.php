<?php
session_start();
require 'config.php'; // Pastikan file ini ada

$msg = "";
$error_type = ""; // Untuk styling pesan error

// --- 1. ZERO TRUST: Rate Limiting (Anti Brute Force) ---
// Membatasi percobaan login maksimal 3 kali dalam 30 detik
if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 3) {
    $lockout_time = 30; 
    $time_passed = time() - $_SESSION['last_attempt_time'];
    
    if ($time_passed < $lockout_time) {
        $sisa = $lockout_time - $time_passed;
        $msg = "Terlalu banyak percobaan gagal. Tunggu $sisa detik.";
        $error_type = "blocked";
    } else {
        // Reset jika waktu hukuman habis
        $_SESSION['login_attempts'] = 0;
    }
}

// --- PROSES LOGIN ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && $error_type != "blocked") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // --- 2. ZERO TRUST: Input Validation ---
    // Cek database (Mencari user berdasarkan username saja dulu)
    $stmt = $conn->prepare("SELECT id, nama_lengkap, username, password, role, email FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // --- 3. ZERO TRUST: Verify Hash ---
        if (password_verify($password, $user['password'])) {
            
            // LOGIN BERHASIL: Reset counter gagal
            $_SESSION['login_attempts'] = 0;

            // --- 4. ZERO TRUST: Session Security ---
            // Regenerasi ID Sesi (Mencegah Session Fixation)
            session_regenerate_id(true);

            // Set Session Variables
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['nama']      = $user['nama_lengkap']; // Menyesuaikan var di login user lama
            $_SESSION['username']  = $user['username'];
            $_SESSION['role']      = $user['role'];
            $_SESSION['email']     = $user['email'];
            $_SESSION['login_time']= time(); // Untuk timeout

            // --- 5. ZERO TRUST: Logging (Auditing) ---
            // Catat siapa yang masuk, role apa, kapan.
            $aktivitas = "Login Berhasil: " . $user['role'];
            $log = $conn->prepare("INSERT INTO log_aktivitas (user_id, aktivitas, waktu) VALUES (?, ?, NOW())");
            // Pastikan tabel log_aktivitas punya kolom 'waktu', jika tidak hapus NOW() dan kolomnya
            $log->bind_param("is", $user['id'], $aktivitas); 
            $log->execute();

            // --- 6. RBAC REDIRECTION (Pengarahan Sesuai Role) ---
            if ($user['role'] == 'admin') {
                header("Location: adminberanda.php");
            } elseif ($user['role'] == 'user') {
                header("Location: index.php");
            } else {
                // Jika ada role lain/guest
                header("Location: guest_dashboard.php");
            }
            exit;

        } else {
            // Password Salah
            handle_failed_login();
            $msg = "Kredensial tidak valid.";
        }
    } else {
        // Username Tidak Ditemukan
        handle_failed_login();
        $msg = "Kredensial tidak valid."; 
    }
}

function handle_failed_login() {
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
    }
    $_SESSION['login_attempts']++;
    $_SESSION['last_attempt_time'] = time();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SIPUMA Secure</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    /* MENGGUNAKAN STYLE DARI FILE LOGIN USER ANDA YANG BAGUS */
    body {
      font-family: 'Poppins', sans-serif;
      /* Background Gradient + Gambar */
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
      padding: 2.5rem;
      border-radius: 12px;
      max-width: 400px;
      width: 100%;
      box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }
    h2 { text-align: center; margin-bottom: 0.5rem; color: #0a2b63; }
    p.subtitle { text-align: center; font-size: 0.9rem; color: #666; margin-bottom: 1.5rem; }
    
    label { display: block; margin-top: 1rem; font-weight: 600; font-size: 0.9rem; }
    input {
      width: 100%; padding: 0.8rem; border-radius: 6px;
      border: 1px solid #ccc; margin-top: 0.3rem;
      box-sizing: border-box; /* Agar padding tidak melebar */
    }
    input:focus { border-color: #0a2b63; outline: none; }

    button {
      margin-top: 1.5rem; width: 100%; background: #fdf300;
      color: #0a2b63; border: none; padding: 0.8rem; font-weight: bold;
      border-radius: 6px; cursor: pointer; transition: 0.3s;
      font-size: 1rem;
    }
    button:hover { background: #e0d800; }

    .msg { 
        background-color: #ffebee; color: #c62828; 
        padding: 10px; border-radius: 4px; margin-top: 1rem; 
        text-align: center; font-size: 0.9rem; display: none; 
    }
    /* Tampilkan pesan error jika ada isinya */
    .msg:not(:empty) { display: block; }

    .links { text-align: center; margin-top: 1.5rem; font-size: 0.9rem; }
    .links a { color: #0a2b63; text-decoration: none; font-weight: 600; }
    .links a:hover { text-decoration: underline; }
    
    .guest-btn {
        display: block; text-align: center; margin-top: 10px;
        font-size: 0.85rem; color: #666; text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="form-box">
    <h2>SIPUMA</h2>
    <p class="subtitle">Sistem Pendataan Usaha Masyarakat</p>
    
    <form method="POST">
      <label>Username</label>
      <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
      
      <label>Password</label>
      <input type="password" name="password" placeholder="Masukkan password" required>
      
      <button type="submit">MASUK</button>
      
      <div class="msg"><?= $msg ?></div>

      <div class="links">
        Belum punya akun? <a href="register.php">Daftar Sekarang</a>
      </div>
      
      <a href="login_guest.php" class="guest-btn">Masuk sebagai Tamu (Read Only)</a>
    </form>
  </div>
</body>
</html>
