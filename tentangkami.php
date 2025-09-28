<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit;
}

$foto_user = 'img/avatardefault_92824.png';
if (isset($_SESSION['foto']) && file_exists($_SESSION['foto'])) {
    $foto_user = $_SESSION['foto'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tentang Kami - SIPUMA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0a2b63;
            background-image: linear-gradient(rgba(10, 43, 99, 0.7), rgba(10, 43, 99, 0.7)), url("img/Desain tanpa judul.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            color: #fff;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-weight: 700;
            font-size: 1.5rem;
            color: #0a2b63;
        }

        nav a {
            margin: 0 1rem;
            text-decoration: none;
            color: #0a2b63;
            font-weight: 600;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .hero {
            text-align: center;
            padding: 4rem 2rem 2rem;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #fff;
        }

        .hero p {
            font-size: 1rem;
            color: #dbeafe;
        }

        .about, .kategori, .sipuma-info {
            background-color: #ffffff;
            color: #0a2b63;
            padding: 3rem 2rem;
            text-align: center;
            border-radius: 10px;
            margin: 2rem auto;
            max-width: 900px;
        }


   .photo-gallery {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 2rem;
}

.photo-gallery img {
    width: 180px;     /* lebih besar */
    height: 120px;    /* tinggi menyesuaikan */
    object-fit: cover;
    border-radius: 10px;
}


        .about-content {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 2rem;
        }

        .about-text {
            max-width: 500px;
            text-align: justify;
            line-height: 1.7;
            font-size: 0.9rem;
        }

        .about-image img {
            max-width: 250px;
            border-radius: 8px;
        }

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
  <div>
    <a href="profil.php">
    <img src="<?= htmlspecialchars($foto_user) ?>" alt="User Icon" style="width:40px; height:40px; border-radius:50%; object-fit:cover; cursor:pointer;">
    </a>
  </div>
</header>

    
    <section class="hero">
        <h1>Tentang Kami</h1>
        <p>Sistem Informasi Pendataan Usaha Masyarakat (UMKM)</p>
    </section>

    <section class="about">
        <div class="photo-gallery">
            <img src="img/WhatsApp-Image-2023-09-01-at-14.26.45.jpeg" alt="Foto UMKM 1">
            <img src="img/WhatsApp Image 2025-08-26 at 09.12.28_753a6ba3.jpg" alt="Foto UMKM 2">
            <img src="img/WhatsApp Image 2025-08-26 at 09.12.28_aafca52d.jpg" alt="Foto UMKM 3">
        </div>
        <h2>Profil DINAS UMKM</h2>
        <div class="about-content">
            <div class="about-image">
                <img src="img/WhatsApp Image 2025-05-25 at 08.40.54_7aaca1bd.jpg" alt="Dinas UMKM">
            </div>
            <div class="about-text">
                Dinas Usaha Mikro Kecil dan Menengah (UMKM) Tanjungpinang Bintan merupakan lembaga pemerintah daerah yang memiliki tanggung jawab dalam pembinaan dan pemberdayaan usaha mikro, kecil, dan menengah. Dinas ini memiliki peran penting dalam mengembangkan potensi pelaku usaha lokal agar dapat berkontribusi terhadap perekonomian daerah.
            </div>
        </div>
    </section>

    <section class="sipuma-info">
        <h2>Informasi SIPUMA</h2>
        <p>
            SIPUMA merupakan singkatan dari Sistem Informasi Pendataan Usaha Masyarakat. Sistem ini dikembangkan oleh Dinas UMKM Kota Tanjungpinang sebagai upaya untuk mendigitalisasi proses pendataan dan monitoring pelaku usaha mikro dan kecil di daerah tersebut. Dengan adanya SIPUMA, diharapkan seluruh pelaku UMKM dapat terdata secara menyeluruh, serta mendapatkan akses terhadap berbagai program pemberdayaan yang lebih tepat sasaran dan berbasis data. SIPUMA juga menjadi jembatan antara pemerintah dan pelaku UMKM dalam mewujudkan ekosistem usaha yang lebih transparan, efisien, dan berkelanjutan.
        </p>
    </section>

    <section class="kategori">
        <h2>Komitmen Kami</h2>
        <p>
            SIPUMA hadir sebagai solusi digital untuk mendukung pelaku UMKM naik kelas. Kami berkomitmen untuk memberikan layanan yang mudah diakses, transparan, serta menjangkau seluruh pelaku usaha mikro dan kecil, agar mereka dapat berkembang dan bersaing secara berkelanjutan.
        </p>
    </section>

    <footer>
        <div class="footer-top">
            <div>SIPUMA</div>
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
</body>
</html>