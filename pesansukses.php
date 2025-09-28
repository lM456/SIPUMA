<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pesan Terkirim</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f0f4f8;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}
.card {
    background: #fff;
    padding: 40px 50px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    text-align: center;
}
h2 {
    color: #1e3a8a;
    margin-bottom: 20px;
}
p {
    font-size: 16px;
    margin-bottom: 30px;
    color: #333;
}
a.button {
    display: inline-block;
    text-decoration: none;
    background: #1e3a8a;
    color: #fff;
    padding: 12px 28px;
    border-radius: 8px;
    font-size: 16px;
    transition: background 0.3s;
}
a.button:hover {
    background: #3b82f6;
}
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
    height: 9px;
    border-left: 4px solid #1e3a8a;
    border-bottom: 4px solid #1e3a8a;
    transform: rotate(-45deg);
    opacity: 0;
    animation: check 0.5s 0.5s forwards;
}
@keyframes pop {
    0% { transform: scale(0); }
    100% { transform: scale(1); }
}
@keyframes check {
    0% { opacity: 0; }
    100% { opacity: 1; }
}
</style>
</head>
<body>
<div class="card">
    <div class="checkmark"></div>
    <h2>Terima Kasih!</h2>
    <p>Pesan Anda telah berhasil terkirim. Kami akan menindaklanjuti secepatnya.</p>
    <a href="index.php" class="button">Kembali ke Beranda</a>
</div>
</body>
</html>
