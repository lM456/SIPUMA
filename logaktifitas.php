<?php
session_start();
require "config.php";

// ✅ Pastikan hanya admin yang bisa akses
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// 🔎 Filter data log
$where = [];
if (!empty($_GET['cari'])) {
    $cari = $conn->real_escape_string($_GET['cari']);
    $where[] = "(u.username LIKE '%$cari%' OR l.aktivitas LIKE '%$cari%')";
}
if (!empty($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $where[] = "DATE(l.waktu) = '$tgl'";
}
$sqlWhere = $where ? "WHERE ".implode(" AND ", $where) : "";

// 🔎 Ambil data log
$log = $conn->query("
    SELECT l.*, u.username 
    FROM log_aktivitas l 
    LEFT JOIN users u ON l.user_id = u.id 
    $sqlWhere 
    ORDER BY l.waktu DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Log Aktivitas - SIPUMA admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    body {margin:0;font-family:'Poppins',sans-serif;background-color:#f8fafc;}
    /* Sidebar */
    .sidebar {width:250px;height:100vh;position:fixed;left:0;top:0;
      background:linear-gradient(180deg,#1d3557,#457b9d);
      color:white;padding:1rem;box-shadow:2px 0 8px rgba(0,0,0,0.1);}
    .sidebar .logo-box {display:flex;align-items:center;justify-content:center;margin-bottom:2rem;}
    .sidebar .logo {width:40px;margin-right:10px;}
    .sidebar h2 {font-size:1.3rem;font-weight:600;margin:0;}
    .sidebar a {display:block;color:white;text-decoration:none;margin-bottom:1rem;
      padding:0.75rem 1rem;border-radius:8px;transition:background 0.3s ease;font-weight:500;}
    .sidebar a:hover, .sidebar a.active {background:rgba(255,255,255,0.15);}

    /* Main */
    .main {margin-left:270px;padding:2rem;}
    .header {display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;
      background:white;padding:1rem 2rem;border-radius:12px;
      box-shadow:0 4px 12px rgba(0,0,0,0.05);}
    .header h1 {font-size:1.8rem;color:#1d3557;margin:0;}

    /* Filter */
    .filter-box {background:white;padding:1rem 1.5rem;border-radius:12px;
      box-shadow:0 4px 12px rgba(0,0,0,0.05);margin:1.5rem 0;}
    .filter-box form {display:flex;flex-wrap:wrap;gap:1rem;align-items:center;}
    .filter-box input, .filter-box button {
      padding:0.6rem 0.8rem;border:1px solid #ccc;border-radius:8px;font-family:'Poppins';}
    .filter-box input[type="text"], .filter-box input[type="date"] {flex:1;min-width:160px;}
    .filter-box button {background:#1d3557;color:white;cursor:pointer;font-weight:600;}
    .filter-box button:hover {background:#2e4a7d;}

    /* Table */
    table {width:100%;border-collapse:collapse;background:white;border-radius:12px;overflow:hidden;
      box-shadow:0 4px 12px rgba(0,0,0,0.05);}
    th,td {padding:1rem;text-align:left;border-bottom:1px solid #eee;}
    th {background-color:#e9f0f8;color:#1d3557;font-weight:600;}
    tr:nth-child(even) td {background-color:#f9fbfd;}
    td {color:#333;}
    @media(max-width:768px){
      .main{margin-left:0;padding:1rem;}
      .sidebar{position:relative;width:100%;height:auto;}
      .filter-box form{flex-direction:column;align-items:stretch;}
    }
  </style>
</head>
<body>

<div class="sidebar">
  <div class="logo-box">
    <img src="img/logo.png" alt="Logo SIPUMA" class="logo">
    <h2>SIPUMA ADMIN</h2>
  </div>
  <a href="adminberanda.php">Dashboard</a>
  <a href="pengguna.php">Pengguna</a>
  <a href="datausaha.php">Data Usaha</a>
  <a href="pesanadmin.php">Pesan Masuk</a>
  <a href="logaktivitas.php" class="active">Log Aktivitas</a>
  <a href="logoutadmin.php">Logout</a>
</div>

<div class="main">
  <div class="header">
    <h1>Log Aktivitas</h1>
    <p><?= date('d F Y') ?></p>
  </div>

  <!-- Filter -->
  <div class="filter-box">
    <form method="GET">
      <input type="text" name="cari" placeholder="Cari user / aktivitas..." 
             value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
      <input type="date" name="tanggal" value="<?= isset($_GET['tanggal']) ? $_GET['tanggal'] : '' ?>">
      <button type="submit">Filter</button>
    </form>
  </div>

  <!-- Tabel Log Aktivitas -->
  <table>
    <thead>
      <tr>
        <th>Waktu</th>
        <th>Username</th>
        <th>Aktivitas</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($log->num_rows > 0): ?>
          <?php while ($l = $log->fetch_assoc()): ?>
              <tr>
                <td><?= date('d-m-Y H:i', strtotime($l['waktu'])) ?></td>
                <td><?= htmlspecialchars($l['username'] ?? 'Tidak diketahui') ?></td>
                <td><?= htmlspecialchars($l['aktivitas']) ?></td>
              </tr>
          <?php endwhile; ?>
      <?php else: ?>
          <tr><td colspan="3" style="text-align:center;">Tidak ada aktivitas</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>
