<?php
// profil.php

// Mulai sesi
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit;
}

// Ambil data dari sesi
$nama_pengguna = $_SESSION['nama'] ?? 'John Doe';
$email_pengguna = $_SESSION['email'] ?? 'johndoe@email.com';
$foto_profil = $_SESSION['foto'] ?? "img/avatardefault_92824.png";

// Jika ada upload foto profil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Buat folder jika belum ada
    }

    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        $_SESSION['foto'] = $target_file;
        $foto_profil = $target_file;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Saya - SIPUMA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0a2b63;
            background-image: linear-gradient(rgba(10, 43, 99, 0.7), rgba(10, 43, 99, 0.7)), url("img/Desain tanpa judul.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .container {
            max-width: 380px;
            margin: 3rem auto;
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            color: #0a2b63;
            margin-bottom: 20px;
        }

        .profile-pic {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #0a2b63;
            margin-bottom: 10px;
            transition: 0.3s;
        }

        .profile-pic:hover { opacity: 0.8; }

        .info-user {
            text-align: left;
            margin-bottom: 20px;
        }

        .info-user p {
            color: #0a2b63;
            margin: 6px 0;
            font-size: 0.95rem;
        }

        button {
            background: #007bff;
            color: #fff;
            border: none;
            width: 100%;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background .3s;
            margin-bottom: 10px;
        }

        button:hover { background: #0056b3; }

        .btn-kembali {
            background: #fff;
            color: #0a2b63;
            border: 2px solid #0a2b63;
        }

        .btn-logout {
            background: #dc3545;
        }

        .btn-logout:hover {
            background: #c82333;
        }

        footer {
            background: #0a2b63;
            color: #fff;
            padding: 2rem 1rem;
            text-align: center;
            margin-top: 3rem;
        }

        .footer-top,
        .footer-bottom {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-top div {
            font-size: 1.2rem;
            font-weight: 700;
        }

        .social-icons {
            display: flex;
            gap: 1rem;
        }

        .social-icons img {
            width: 2.2em;
            height: 2.2em;
            object-fit: contain;
        }

        .btn-footer {
            background: #fff;
            color: #0a2b63;
            padding: 4px 12px;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
        }

        @media (max-width:768px) {
            .container {
                margin: 2rem 1rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Profil Saya</h2>

    <!-- FOTO PROFIL -->
    <label for="foto" style="cursor:pointer; display:inline-block;">
        <img src="<?= htmlspecialchars($foto_profil) ?>" alt="Foto Profil" class="profile-pic" id="preview">
    </label>
    <p style="color:#0a2b63; font-size:0.9rem; margin-top:-0.5rem;">Klik foto untuk mengubah</p>

    <!-- INFO USER -->
    <div class="info-user">
        <p><strong>Nama:</strong> <?= htmlspecialchars($nama_pengguna) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($email_pengguna) ?></p>
    </div>

    <!-- FORM UPLOAD FOTO -->
    <form action="profil.php" method="POST" enctype="multipart/form-data">
        <input type="file" id="foto" name="foto" accept="image/*" style="display:none;" onchange="previewImage(event)">
        <button type="submit">Simpan Foto</button>
        <a href="index.php"><button type="button" class="btn-kembali">Kembali ke Beranda</button></a>
        <a href="logout.php"><button type="button" class="btn-logout">Logout</button></a>
    </form>
</div>

<!-- FOOTER -->
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

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

</body>
</html>
