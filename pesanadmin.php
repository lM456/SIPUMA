<?php
session_start();
require "config.php";

// ✅ Pastikan hanya admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: loginadmin.php");
    exit;
}

// === Hapus Pesan ===
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    $conn->query("DELETE FROM messages WHERE id=$id");
    header("Location: pesanadmin.php?msg=deleted");
    exit;
}

// === Ambil Data Pesan ===
$messages = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pesan Masuk - SIPUMA Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body { margin: 0; font-family: 'Poppins', sans-serif; background-color: #f8fafc; }

    /* Sidebar */
    .sidebar { width: 250px; height: 100vh; position: fixed; left: 0; top: 0;
      background: linear-gradient(180deg, #1d3557, #457b9d); color: white; padding: 1rem;
      box-shadow: 2px 0 8px rgba(0,0,0,0.1); }
    .sidebar .logo-box { display: flex; align-items: center; justify-content: center; margin-bottom: 2rem; }
    .sidebar .logo-box img { width: 40px; margin-right: 10px; }
    .sidebar .logo-box h2 { font-size: 1.3rem; font-weight: 600; margin: 0; }
    .sidebar a { display: block; color: white; text-decoration: none; margin-bottom: 1rem;
      padding: 0.75rem 1rem; border-radius: 8px; transition: background 0.3s ease; font-weight: 500; }
    .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.15); }

    /* Main */
    .main { margin-left: 270px; padding: 2rem; }
    .header { display: flex; justify-content: space-between; align-items: center;
      background: white; padding: 1rem 2rem; border-radius: 12px; 
      box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 2rem; }
    .header h1 { font-size: 1.8rem; color: #1d3557; margin: 0; }
    .header .right { font-size: 1rem; color: #457b9d; font-weight: 600; }

    /* Table */
    table { width: 100%; border-collapse: collapse; background: white;
      border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    th, td { padding: 1rem; border-bottom: 1px solid #eee; text-align: left; }
    th { background-color: #e9f0f8; color: #1d3557; font-weight: 600; }
    tr:nth-child(even) td { background-color: #f9fbfd; }
    td { color: #333; }

    /* Tombol aksi */
    .btn { padding: 6px 12px; border-radius: 6px; font-size: 0.85rem; text-decoration: none; margin-right: 5px; cursor: pointer; }
    .btn-delete { background: #e63946; color: white; border: none; }
    .btn-delete:hover { background: #b72c36; }

    @media(max-width:768px){
      .main{margin-left:0;padding:1rem;}
      .sidebar{position:relative;width:100%;height:auto;}
    }
  </style>
</head>
<body>
<div class="sidebar">
  <div class="logo-box">
    <img src="img/logo.png" alt="Logo SIPUMA">
    <h2>SIPUMA ADMIN</h2>
  </div>
  <a href="adminberanda.php">Dashboard</a>
  <a href="pengguna.php">Pengguna</a>
  <a href="datausaha.php">Data Usaha</a>
  <a href="pesanadmin.php" class="active">Pesan Masuk</a>
  <a href="logaktifitas.php">Log Aktivitas</a>
  <a href="logoutadmin.php">Logout</a>
</div>

<div class="main">
  <div class="header">
    <h1>Pesan Masuk</h1>
    <div class="right">Tanggal: <?= date("d F Y") ?></div>
  </div>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Lengkap</th>
        <th>Email</th>
        <th>Subjek</th>
        <th>Pesan</th>
        <th>Dikirim Pada</th>
        <th>Aksi</th>
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
            <td><?= nl2br(htmlspecialchars($msg['pesan'])) ?></td>
            <td><?= date("d-m-Y H:i", strtotime($msg['created_at'])) ?></td>
            <td>
              <button class="btn btn-delete" onclick="confirmDelete(<?= $msg['id'] ?>)">Delete</button>
            </td>
          </tr>
          <?php $no++; endwhile; ?>
      <?php else: ?>
        <tr><td colspan="7" style="text-align:center;">Belum ada pesan masuk.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<script>
function confirmDelete(id) {
  Swal.fire({
    title: 'Yakin hapus pesan ini?',
    text: "Data tidak bisa dikembalikan setelah dihapus.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#e63946',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "pesanadmin.php?hapus=" + id;
    }
  });
}
</script>

</body>
</html>
