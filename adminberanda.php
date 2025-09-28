<?php
session_start();
require "config.php"; // koneksi database

// ✅ Cek apakah admin sudah login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: loginadmin.php");
    exit;
}

// --- Ambil data untuk dashboard ---
$total_usaha = $conn->query("SELECT COUNT(*) AS jml FROM umkm")->fetch_assoc()['jml'] ?? 0;
$total_pengguna = $conn->query("SELECT COUNT(*) AS jml FROM users WHERE role='user'")->fetch_assoc()['jml'] ?? 0;
$total_log = $conn->query("SELECT COUNT(*) AS jml FROM log_aktivitas")->fetch_assoc()['jml'] ?? 0;

// Ambil log aktivitas terbaru + join ke tabel user untuk ambil username
$logs = $conn->query("
    SELECT l.waktu, u.username, l.aktivitas 
    FROM log_aktivitas l
    LEFT JOIN users u ON l.user_id = u.id
    ORDER BY l.waktu DESC 
    LIMIT 5
");

// Ambil pesan masuk
$messages = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin SIPUMA</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    body { margin: 0; font-family: 'Poppins', sans-serif; background-color: #f8fafc; }

    /* === Sidebar === */
    .sidebar { 
      width: 250px; height: 100vh; position: fixed; 
      left: 0; top: 0; background: linear-gradient(180deg, #1d3557, #457b9d); 
      color: white; padding: 1rem; box-shadow: 2px 0 8px rgba(0,0,0,0.1); 
    }
    .sidebar .logo-box { display: flex; align-items: center; justify-content: center; margin-bottom: 2rem; }
    .sidebar .logo { width: 40px; margin-right: 10px; }
    .sidebar h2 { font-size: 1.3rem; font-weight: 600; margin: 0; }

    .sidebar a { 
      display: block; color: white; text-decoration: none; 
      margin-bottom: 1rem; padding: 0.75rem 1rem; border-radius: 8px; 
      transition: background 0.3s ease; font-weight: 500; 
    }
    .sidebar a:hover { background: rgba(255,255,255,0.15); }

    /* === Main Content === */
    .main { margin-left: 270px; padding: 2rem; }
    .header { 
      display: flex; justify-content: space-between; align-items: center; 
      background: white; padding: 1rem 2rem; border-radius: 12px; 
      box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
    }
    .header h1 { font-size: 1.8rem; color: #1d3557; margin: 0; }
    .welcome { font-size: 1rem; color: #457b9d; font-weight: 600; }

    /* === Cards Statistik === */
    .cards { margin-top: 2rem; display: flex; gap: 1.5rem; flex-wrap: wrap; }
    .card { 
      flex: 1; min-width: 220px; background: white; padding: 1.5rem; 
      border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
      text-align: center; transition: transform 0.2s, box-shadow 0.2s;
    }
    .card:hover { transform: translateY(-5px); box-shadow: 0 6px 16px rgba(0,0,0,0.1); }
    .card h3 { font-size: 2rem; margin: 0; color: #1d3557; }
    .card p { margin-top: 0.5rem; color: #6c757d; }

    /* === Section === */
    .section { margin-top: 3rem; }
    .section h2 { color: #1d3557; margin-bottom: 1rem; font-size: 1.3rem; }

    /* === Table === */
    table { 
      width: 100%; border-collapse: collapse; background: white; 
      border-radius: 12px; overflow: hidden; 
      box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
    }
    th, td { padding: 1rem; text-align: left; border-bottom: 1px solid #eee; }
    th { background-color: #e9f0f8; color: #1d3557; font-weight: 600; }
    tr:nth-child(even) td { background-color: #f9fbfd; }
    td { color: #333; }

    @media (max-width: 768px) {
      .main { margin-left: 0; padding: 1rem; }
      .sidebar { position: relative; width: 100%; height: auto; }
      .cards { flex-direction: column; }
    }
  </style>
</head>
<body>

<div class="sidebar">
  <div class="logo-box">
    <img src="img/logo.png" alt="Logo SIPUMA" class="logo">
    <h2>SIPUMA ADMIN</h2>
  </div>
  <a href="adminberanda.php"> Dashboard</a>
  <a href="pengguna.php"> Pengguna</a>
  <a href="datausaha.php"> Data Usaha</a>
  <a href="pesanadmin.php">Pesan Masuk</a>
  <a href="logaktifitas.php"> Log Aktivitas</a>
  <a href="logoutadmin.php"> Logout</a>
</div>

<div class="main">
  <div class="header">
    <h1>Dashboard Admin</h1>
    <div class="welcome">Halo, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></div>
  </div>

  <div class="cards">
    <div class="card"><h3><?= $total_usaha ?></h3><p>Total Usaha</p></div>
    <div class="card"><h3><?= $total_pengguna ?></h3><p>Total Pengguna</p></div>
    <div class="card"><h3><?= $total_log ?></h3><p>Log Aktivitas</p></div>
  </div>

  <div class="section">
    <h2>Log Aktivitas Terbaru</h2>
    <table>
      <thead>
        <tr><th>Waktu</th><th>User</th><th>Aktivitas</th></tr>
      </thead>
      <tbody>
        <?php if ($logs->num_rows > 0): ?>
          <?php while ($row = $logs->fetch_assoc()): ?>
            <tr>
              <td><?= date('d-m-Y H:i', strtotime($row['waktu'])) ?></td>
              <td><?= $row['username'] ?? 'Unknown' ?></td>
              <td><?= htmlspecialchars($row['aktivitas']) ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="3">Belum ada log aktivitas.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div class="section">
    <h2>Pesan Masuk</h2>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Lengkap</th>
          <th>Email</th>
          <th>Subjek</th>
          <th>Pesan</th>
          <th>Dikirim Pada</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; if($messages->num_rows > 0): ?>
          <?php while($msg = $messages->fetch_assoc()): ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= htmlspecialchars($msg['nama_lengkap']) ?></td>
              <td><?= htmlspecialchars($msg['email']) ?></td>
              <td><?= htmlspecialchars($msg['subjek']) ?></td>
              <td><?= htmlspecialchars($msg['pesan']) ?></td>
              <td><?= date('d-m-Y H:i', strtotime($msg['created_at'])) ?></td>
            </tr>
            <?php $no++; endwhile; ?>
        <?php else: ?>
          <tr><td colspan="6">Belum ada pesan masuk.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
