<?php
// (Opsional) Kalau ingin cek login admin, aktifkan session & guard di sini.
// session_start();
// if (!isset($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Data Usaha - SIPUMA Admin</title>
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
      display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;
      background: white; padding: 1rem 2rem; border-radius: 12px; 
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .header h1 { font-size: 1.8rem; color: #1d3557; margin: 0; }

    /* === Cards Kategori === */
    .kategori-container { 
      margin-top: 2rem; display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; 
    }
    .card { 
      padding: 2rem 1.5rem; border-radius: 12px; color: #1d3557; font-weight: 600;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1); 
      text-align: center; cursor: pointer; user-select: none;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .card:hover { transform: translateY(-5px); box-shadow: 0 6px 16px rgba(0,0,0,0.15); }
    .card h3 { font-size: 1.2rem; margin: 0; }

    /* Warna khusus tiap kategori */
    .substensi { background: #ffe066; }   /* kuning */
    .sukses { background: #a8e6cf; }      /* hijau muda */
    .digital { background: #74c0fc; }     /* biru terang */
    .ekspor { background: #ffb347; }      /* oranye */

    /* Responsif */
    @media (max-width: 1024px) {
      .kategori-container { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 600px) {
      .kategori-container { grid-template-columns: 1fr; }
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
  <a href="pengguna.php"> Pengguna</a>
  <a href="datausaha.php"> Data Usaha</a>
  <a href="pesanadmin.php"> Pesan Masuk</a>
  <a href="logaktifitas.php"> Log Aktivitas</a>
  <a href="logoutadmin.php"> Logout</a>
</div>

<div class="main">
  <div class="header">
    <h1>Data Usaha</h1>
  </div>

  <!-- Kartu Kategori -->
  <div class="kategori-container">
    <div class="card substensi" onclick="location.href='umkm_substensi.php'">
      <h3>UMKM Substensi</h3>
    </div>
    <div class="card sukses" onclick="location.href='umkm_sukses.php'">
      <h3>UMKM Naik Kelas</h3>
    </div>
    <div class="card digital" onclick="location.href='umkm_digital.php'">
      <h3>UMKM Digital</h3>
    </div>
    <div class="card ekspor" onclick="location.href='umkm_ekspor.php'">
      <h3>UMKM Ekspor</h3>
    </div>
  </div>
</div>

</body>
</html>
