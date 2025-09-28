<?php
session_start();

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Terkirim</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f9ff;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        color: #1e3a8a;
    }
    .card {
        background: #fff;
        padding: 40px 50px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        text-align: center;
        position: relative;
    }
    h2 { margin-bottom: 15px; }
    p { margin-bottom: 25px; font-size: 16px; }
    a.button {
        text-decoration: none;
        background: #1e3a8a;
        color: #fff;
        padding: 12px 28px;
        border-radius: 8px;
        font-size: 14px;
        transition: 0.3s;
    }
    a.button:hover { background: #3b82f6; }

    /* Animasi ceklis */
    .checkmark {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: inline-block;
        border: 4px solid #1e3a8a;
        position: relative;
        margin-bottom: 20px;
        animation: pop 0.5s ease forwards;
    }

    .checkmark::after {
        content: '';
        position: absolute;
        left: 22px;
        top: 40px;
        width: 18px;
        height: 8px;
        border-left: 4px solid #1e3a8a;
        border-bottom: 4px solid #1e3a8a;
        transform: rotate(-45deg) scale(0);
        transform-origin: bottom left;
        animation: check 0.5s 0.5s forwards;
    }

    @keyframes pop {
        0% { transform: scale(0); }
        100% { transform: scale(1); }
    }

    @keyframes check {
        0% { transform: rotate(-45deg) scale(0); }
        100% { transform: rotate(-45deg) scale(1); }
    }
</style>
</head>
<body>
<div class="card">
    <div class="checkmark"></div>
    <h2>Selamat!</h2>
    <p>Data Anda berhasil terkirim.</p>
    <a href="index.php" class="button">Kembali ke Beranda</a>
</div>
</body>
</html>
