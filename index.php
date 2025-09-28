<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIPUMA - Sistem Informasi Pendataan UMKM</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <style>
    /* Semua CSS dari versi sebelumnya, tetap sama */
    * { margin:0; padding:0; box-sizing:border-box; }
    body { font-family:'Poppins',sans-serif; background-size:cover; color:#111; }
    header{ display:flex; justify-content:space-between; align-items:center; padding:1rem 2rem; background:#fff; box-shadow:0 2px 4px rgba(0,0,0,0.1); position:sticky; top:0; z-index:100; }
    header .logo{ font-weight:700; font-size:1.5rem; color:#0a2b63; }
    nav a{ margin:0 1rem; text-decoration:none; color:#0a2b63; font-weight:600; }
    nav a:hover{ text-decoration:underline; }
    header img{ width:1.8rem; height:1.8rem; cursor:pointer; }
    .hero{ background: linear-gradient(rgba(10, 43, 99, 0.8), rgba(10, 43, 99, 0.8)), url(img/Desain\ tanpa\ judul.png) center/cover no-repeat; padding:5rem 2rem 3rem; color:white; position:relative; text-align:center; border-bottom-left-radius:60px; border-bottom-right-radius:60px; z-index:0;}
    .hero h1{ font-size:2.5rem; }
    .hero p{ font-size:1.2rem; margin-top:0.5rem; }
    .cta-button{ margin-top:2rem; display:inline-block; background:#fdf300; color:black; padding:0.75rem 1.5rem; border-radius:6px; font-weight:600; text-decoration:none; }
    .gallery{ display:flex; justify-content:center; gap:1.5rem; margin-top:2rem; flex-wrap:wrap; }
    .gallery img{ width:220px; height:160px; object-fit:cover; border-radius:15px; border:5px solid white; box-shadow:0 4px 8px rgba(0,0,0,0.1); }
    .about{text-align:center; padding:4rem 2rem;}
    .about h2{ font-size:1.5rem; font-weight:700; color:#0a2b63; margin-bottom:1rem; }
    .about-content{ display:flex; justify-content:center; align-items:center; gap:2rem; max-width:900px; margin:0 auto; flex-wrap:wrap;}
    .about-content img{ width:150px; height:150px; border-radius:100%; background:#eaeaea;}
    .about-content p{ max-width:500px; text-align:justify; line-height:1.6;}
    .kategori{ background: linear-gradient(rgba(10, 43, 99, 0.85), rgba(10, 43, 99, 0.85)), url(img/WhatsApp\ Image\ 2025-05-25\ at\ 08.40.54_7aaca1bd.jpg) center/cover no-repeat; padding:4rem 2rem; color:rgb(255,230,38); text-align:center; position:relative;}
    .kategori h2{ font-size:1.8rem; margin-bottom:2rem; }
    .kategori-container{ display:flex; justify-content:center; flex-wrap:wrap; gap:1.5rem; color:#000; position:relative; z-index:3;}
    .kategori-box{ background:white; border-radius:10px; width:250px; padding:1rem; box-shadow:0 4px 6px rgba(0,0,0,0.1); transition: transform 0.3s ease, box-shadow 0.3s ease;}
    .kategori-box:hover{ transform:translateY(-5px); box-shadow:0 8px 16px rgba(0,0,0,0.2);}
    .kategori-box h3{ background:#0a2b63; color:white; padding:0.5rem; border-radius:5px; font-size:1rem;}
    .kategori-box ul{ margin-top:0.5rem; text-align:left; font-size:0.9rem; padding-left:1rem;}
    .grafik{ background:#f8f9fa; padding:3rem 2rem; text-align:center; }
    .sipuma-info p {
            text-align: justify;
            font-size: 0.9rem;
            line-height: 1.7;
        }

        footer {
            background: #0a2b63;
            color: white;
            padding: 2rem 1rem;
            text-align: center;
        }

        .footer-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-top div {
            flex: 1;
            min-width: 100px;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .social-icons {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .social-icons img {
            width: 2.2em;
            height: 2.2em;
            object-fit: contain;
        }

        .footer-bottom {
            margin-top: 1rem;
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .btn-footer {
            background: white;
            color: #0a2b63;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            header, .footer-top, .footer-bottom, .about-content, .photo-gallery {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
<header>
  <div class="logo" style="display:flex; align-items:center;">
    <img src="img/logo.png" alt="Logo SIPUMA" style="height:40px; width:40px; margin-right:8px;">
    <span>SIPUMA</span>
  </div>
  <nav>
    <a href="index.php">Beranda</a>
    <a href="daftarusaha.php">Mendaftar Usaha</a>
    <a href="tentangkami.php">Tentang Kami</a>
    <a href="kontakkami.php">Kontak Kami</a>
  </nav>
  <a href="profil.php">
    <img src="img/avatardefault_92824.png" alt="User Icon" style="width:40px; height:40px; border-radius:50%; object-fit:cover; cursor:pointer;">
  </a>
</header>

<section class="hero">
  <h1>Selamat Datang di <span style="color: #ffffff;">SIPUMA</span></h1>
  <p>Sistem Informasi Pendataan Usaha Masyarakat (UMKM)</p>
  <a href="daftarusaha.php" class="cta-button">Daftar Sekarang</a>
  <div class="gallery">
    <img src="img/Screenshot 2025-07-29 111211.png" alt="Gambar 1">
    <img src="img/WhatsApp Image 2025-07-29 at 10.56.56_a910f743.jpg" alt="Gambar 2">
    <img src="img/Screenshot 2025-07-29 110936.png" alt="Gambar 3">
  </div>
</section>

<section class="about">
  <h2>Tentang Kami</h2>
  <div class="about-content">
    <img src="img/WhatsApp Image 2025-05-25 at 08.40.54_7aaca1bd.jpg" alt="Logo" />
    <p>
      SIPUMA adalah sistem digital Dinas Usaha Kecil dan Menengah (UMKM) Tanjungpinang yang digunakan untuk mendata dan mengelola informasi UMKM guna mempermudah penyaluran bantuan, pembinaan, dan kebijakan berbasis data.
    </p>
  </div>
</section>

<section class="kategori">
  <h2>Empat <strong>Kategori Utama</strong> UMKM</h2>
  <div class="kategori-container">
    <div class="kategori-box">
      <h3><strong>Level 1</strong><br>UMKM Substensi</h3>
      <ul>
        <li>Usaha masih sangat sederhana atau baru dirintis</li>
        <li>Belum berbadan hukum</li>
        <li>Pencatatan keuangan minim</li>
        <li>Produksi kecil dan kualitas rendah</li>
        <li>Jualan hanya offline lokal</li>
        <li>Sebagian masih bergantung pada bantuan sosial</li>
      </ul>
    </div>
    <div class="kategori-box">
      <h3><strong>Level 2</strong><br>UMKM Sukses</h3>
      <ul>
        <li>Usaha mulai berkembang dan lebih profesional</li>
        <li>Sudah memiliki izin usaha</li>
        <li>Mencatat transaksi keuangan dengan baik</li>
        <li>Produksi meningkat dan mampu menjangkau pasar regional</li>
        <li>Layak mendapatkan pembiayaan dari lembaga keuangan</li>
      </ul>
    </div>
    <div class="kategori-box">
      <h3><strong>Level 3</strong><br>UMKM Digital</h3>
      <ul>
        <li>Usaha memanfaatkan teknologi digital untuk berkembang</li>
        <li>Menggunakan platform digital untuk pemasaran dan penjualan</li>
        <li>Laporan keuangan sudah lengkap</li>
        <li>Skala usaha kecil hingga menengah</li>
        <li>Produk sudah tersertifikasi dan berizin</li>
        <li>Menjangkau pasar nasional</li>
      </ul>
    </div>
    <div class="kategori-box">
      <h3><strong>Level 4</strong><br>UMKM Ekspor</h3>
      <ul>
        <li>Usaha sudah berorientasi pasar global dan berkelanjutan</li>
        <li>Produktivitas dan kualitas produk terjaga secara berkelanjutan</li>
        <li>Lolos kurasi dan bisa menembus pasar global</li>
        <li>Dokumen ekspor lengkap</li>
        <li>Proses produksi ramah lingkungan</li>
      </ul>
    </div>
  </div>
</section>

<section class="grafik">
  <h2>Grafik Usaha</h2>
  <canvas id="umkmChart" width="600" height="300"></canvas>
</section>

<footer>
  <div class="footer-top">
    <div><strong>SIPUMA</strong></div>
    <div class="social-icons">
      <img src="img/—Pngtree—white whatsapp icon png_3562063 (1).png" alt="WA">
      <img src="img/toppng.com-facebook-button-circle-fb-icon-white-983x983.png" alt="FB">
      <img src="img/—Pngtree—instagram white icon free logo_3570433.png" alt="IG">
    </div>
  </div>
  <div class="footer-bottom">
    <div>Email<br><small>copyright2025</small></div>
    <div>Telepon<br><small>copyright2025</small></div>
    <button class="btn-footer">Hubungi Kami</button>
  </div>
</footer>

<script>
let ctx = document.getElementById('umkmChart').getContext('2d');
let umkmChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Substensi','Naik Kelas','Digital','Ekspor'],
    datasets: [{
      label: 'Jumlah Usaha',
      data: [0,0,0,0],
      backgroundColor: ['#fd7e14','#20c997','#ff6f61','#343a40']
    }]
  },
  options: {
    responsive: true,
    scales: { y: { beginAtZero:true, stepSize:1 } }
  }
});

function updateChart() {
    $.getJSON('getchart.php', function(data){
        umkmChart.data.datasets[0].data = [
            data[1] || 0,
            data[2] || 0,
            data[3] || 0,
            data[4] || 0
        ];
        umkmChart.update();
    });
}

// Update chart langsung saat load & polling setiap 5 detik
updateChart();
setInterval(updateChart, 5000);
</script>
</body>
</html>
