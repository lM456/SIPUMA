<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit;
}

require_once 'config.php';

$foto_user = 'img/avatardefault_92824.png';
if (isset($_SESSION['foto']) && file_exists($_SESSION['foto'])) {
    $foto_user = $_SESSION['foto'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $subjek = $_POST['subjek'];
    $pesan = $_POST['pesan'];

    $stmt = $conn->prepare("INSERT INTO messages (nama_lengkap, email, subjek, pesan) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $email, $subjek, $pesan);

    if ($stmt->execute()) {
        header("Location: pesansukses.php");
        exit;
    } else {
        echo "Terjadi kesalahan, silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kontak Kami - SIPUMA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0a2b63;
            background-image: linear-gradient(rgba(10, 43, 99, 0.7), rgba(10, 43, 99, 0.7)), url("img/Desain tanpa judul.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
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
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 40px;
            width: 40px;
            margin-right: 8px;
        }

        nav a {
            margin: 0 1rem;
            text-decoration: none;
            color: #0a2b63;
            font-weight: 600;
        }

        nav a:hover { text-decoration: underline; }

        .container {
            max-width: 800px;
            margin: 3rem auto;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #0a2b63;
            margin-bottom: 1.5rem;
        }

        form { display: flex; flex-direction: column; }

        label { margin-bottom: 0.5rem; font-weight: 500; }

        input, textarea {
            padding: 0.75rem;
            margin-bottom: 1.2rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: inherit;
        }

        textarea { resize: vertical; min-height: 120px; }

        button {
            padding: 0.75rem;
            background: #007bff;
            color: #fff;
            border: none;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover { background: #0056b3; }

        footer {
            background: #0a2b63;
            color: white;
            padding: 2rem 1rem;
            text-align: center;
            margin-top: 3rem;
        }

        .footer-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-top div { flex: 1; min-width: 100px; font-size: 1.2rem; font-weight: bold; }

        .social-icons { display: flex; gap: 1rem; justify-content: center; }

        .social-icons img { width: 2.2em; height: 2.2em; object-fit: contain; }

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
            header, .footer-top, .footer-bottom { flex-direction: column; text-align: center; gap: 1rem; }
        }
    </style>
</head>
<body>
    <header>
      <div class="logo">
        <img src="img/logo.png" alt="Logo SIPUMA">
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

    <div class="container">
        <h2>Hubungi Kami</h2>
        <form action="kontakkami.php" method="POST">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="subjek">Subjek:</label>
            <input type="text" id="subjek" name="subjek">

            <label for="pesan">Pesan Anda:</label>
            <textarea id="pesan" name="pesan" required></textarea>

            <button type="submit">Kirim Pesan</button>
        </form>
    </div>

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
