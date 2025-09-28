<?php
session_start();
require "config.php"; // koneksi database

// ✅ Pastikan admin login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: loginadmin.php");
    exit;
}

// Hitung jumlah user (role user)
$total_user = $conn->query("SELECT COUNT(*) AS jml FROM users WHERE role='user'")
                  ->fetch_assoc()['jml'] ?? 0;

// Hitung jumlah usaha (tabel umkm)
$total_usaha = $conn->query("SELECT COUNT(*) AS jml FROM umkm")
                   ->fetch_assoc()['jml'] ?? 0;

// Ambil daftar pengguna
$daftar_pengguna = $conn->query("
    SELECT id, nama_lengkap, email, tanggal_daftar 
    FROM users 
    WHERE role='user' 
    ORDER BY tanggal_daftar DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Pengguna - SIPUMA Admin</title>
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
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.15); }

        /* === Main Content === */
        .main { margin-left: 270px; padding: 2rem; }
        .header { 
          display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;
          background: white; padding: 1rem 2rem; border-radius: 12px; 
          box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .header h1 { font-size: 1.8rem; color: #1d3557; margin: 0; }

        /* === Cards Statistik === */
        .cards { margin-top: 2rem; display: flex; gap: 1.5rem; flex-wrap: wrap; }
        .card { 
          flex: 1; min-width: 220px; background: white; padding: 1.5rem; 
          border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
          text-align: center; transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover { transform: translateY(-5px); box-shadow: 0 6px 16px rgba(0,0,0,0.1); }
        .card h3 { font-size: 2.5rem; margin: 0; color: #1d3557; }
        .card p { margin-top: 0.5rem; color: #6c757d; }

        /* === Table === */
        table { 
          width: 100%; border-collapse: collapse; margin-top: 2rem; background: white; 
          border-radius: 12px; overflow: hidden; 
          box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
        }
        th, td { padding: 1rem; border-bottom: 1px solid #eee; text-align: left; }
        th { background-color: #e9f0f8; color: #1d3557; font-weight: 600; }
        tr:nth-child(even) td { background-color: #f9fbfd; }
        td { color: #333; }

        @media (max-width: 768px) {
            .main { margin-left: 0; padding: 1rem; }
            .sidebar { position: relative; width: 100%; height: auto; }
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
        <a href="pengguna.php" class="active"> Pengguna</a>
        <a href="datausaha.php"> Data Usaha</a>
        <a href="pesanadmin.php"> Pesan Masuk</a>
        <a href="logaktifitas.php"> Log Aktivitas</a>
        <a href="logoutadmin.php"> Logout</a>
    </div>

    <div class="main">
        <div class="header">
            <h1>Data Pengguna & Usaha</h1>
            <p><?= date("d F Y") ?></p>
        </div>

        <!-- Statistik -->
        <div class="cards">
            <div class="card">
                <h3><?= $total_user ?></h3>
                <p>Total Pengguna</p>
            </div>
            <div class="card">
                <h3><?= $total_usaha ?></h3>
                <p>Total Usaha</p>
            </div>
        </div>

        <!-- Tabel daftar pengguna -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($daftar_pengguna->num_rows > 0): ?>
                    <?php while ($row = $daftar_pengguna->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tanggal_daftar'])) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">Belum ada pengguna terdaftar.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
