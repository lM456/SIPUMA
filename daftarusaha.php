<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Gunakan default avatar jika tidak ada foto profil
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
  <title>Formulir Usaha - SIPUMA</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #0a2b63;
      background-image: linear-gradient(rgba(10,43,99,0.7), rgba(10,43,99,0.7)), url("img/Desain tanpa judul.png");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }
    header { display: flex; justify-content: space-between; align-items: center; padding: 1rem 2rem; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 100; }
    header .logo { font-weight: 700; font-size: 1.5rem; color: #0a2b63; }
    nav a { margin: 0 1rem; text-decoration: none; color: #0a2b63; font-weight: 600; }
    nav a:hover { text-decoration: underline; }
    header img { width: 1.8rem; height: 1.8rem; cursor: pointer; }
    .container { max-width: 900px; margin: 2rem auto; background: #fff; padding: 2rem; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    h2 { text-align: center; margin: 1.5rem 0; font-size: 1.5rem; color: #0a2b63; }
    form { display: flex; flex-direction: column; }
    label { margin-bottom: 0.25rem; font-weight: 500; font-size: 0.9rem; }
    input, select, textarea { padding: 0.6rem; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 5px; font-family: inherit; font-size: 0.95rem; }
    textarea { resize: vertical; min-height: 80px; }
    button { padding: 0.7rem; background: #007bff; color: #fff; border: none; font-size: 1rem; border-radius: 5px; cursor: pointer; transition: background 0.3s ease; }
    button:hover { background: #0056b3; }
    footer { background: #0a2b63; color: white; padding: 2rem 1rem; text-align: center; }
    .footer-top { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
    .footer-top img { width: 2.5em; height: 2.5em; object-fit: contain; }
    .footer-bottom { margin-top: 1rem; display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap; }
    .btn-footer { background: white; color: #0a2b63; border: none; padding: 0.5rem 1rem; border-radius: 5px; font-weight: bold; cursor: pointer; }
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

<div class="container">
  <form method="POST" action="sukses.php" enctype="multipart/form-data" id="formUsaha">
    <h1 style="text-align: center; color: #000; font-size: 2rem; margin-bottom: 1rem;">Formulir Pendataan Usaha</h1>

    <!-- I. Data Pribadi -->
    <h2>I. Data Pribadi</h2>
    <label>Nama Lengkap:</label><input type="text" name="nama_lengkap" required>
    <label>NIK:</label><input type="text" name="nik">
    <label>Jenis Kelamin:</label>
    <label><input type="radio" name="gender" value="Laki-laki"> Laki-laki</label>
    <label><input type="radio" name="gender" value="Perempuan"> Perempuan</label>
    <label>Tanggal Lahir:</label><input type="date" name="tanggal_lahir">
    <label>Status Perkawinan:</label>
    <select name="status_perkawinan">
      <option value="Belum Menikah">Belum Menikah</option>
      <option value="Menikah">Menikah</option>
      <option value="Cerai Hidup">Cerai Hidup</option>
      <option value="Cerai Mati">Cerai Mati</option>
    </select>
    <label>Pendidikan Terakhir:</label>
    <select name="pendidikan">
      <option>SD</option>
      <option>SMP</option>
      <option>SMA</option>
      <option>D3</option>
      <option>S1</option>
      <option>S2</option>
    </select>
    <label>Alamat Domisili:</label><textarea name="alamat_domisili"></textarea>
    <label>No HP / WhatsApp:</label><input type="text" name="no_hp">
    <label>Apakah Anda Disabilitas?</label>
    <label><input type="radio" name="disabilitas" value="Ya"> Ya</label>
    <label><input type="radio" name="disabilitas" value="Tidak"> Tidak</label>
    <label>Apakah Anda Perempuan Tulang Punggung Keluarga?</label>
    <label><input type="radio" name="perempuan_tpk" value="Ya"> Ya</label>
    <label><input type="radio" name="perempuan_tpk" value="Tidak"> Tidak</label>
    <label>Apakah Anda Kepala Keluarga?</label>
    <label><input type="radio" name="kepala_keluarga" value="Ya"> Ya</label>
    <label><input type="radio" name="kepala_keluarga" value="Tidak"> Tidak</label>

    <!-- II. Data Keluarga -->
    <h2>II. Data Keluarga</h2>
    <label>Jumlah Anggota Keluarga:</label><input type="number" name="jumlah_anggota_keluarga">
    <label>Jumlah Tanggungan:</label><input type="number" name="jumlah_tanggungan">
    <label>Pelaku Usaha Adalah Tulang Punggung Keluarga?</label>
    <label><input type="radio" name="tulang_punggung" value="Ya"> Ya</label>
    <label><input type="radio" name="tulang_punggung" value="Tidak"> Tidak</label>

    <!-- III. Data Usaha -->
    <h2>III. Data Usaha</h2>
    <label>Nama Usaha:</label><input type="text" name="nama_usaha" required>
    <label>Tahun Mulai Usaha:</label><input type="number" name="tahun_mulai" required>
    <label>Jenis Usaha:</label><input type="text" name="jenis_usaha" required>
    <label>Bidang Usaha:</label><input type="text" name="bidang_usaha" required>
    <label>Jumlah Pegawai:</label><input type="number" name="jumlah_pegawai" required>
    <label>Kapasitas Produksi per Bulan:</label><input type="number" name="kapasitas_produksi" required>
    <label>Omzet Rata-Rata per Bulan (Rp):</label><input type="number" name="omzet" required>
    <label>Modal Awal (Rp):</label><input type="number" name="modal_awal" required>
    <label>Target Pasar:</label>
    <label><input type="radio" name="target_pasar" value="Lokal" required> Lokal</label>
    <label><input type="radio" name="target_pasar" value="Nasional"> Nasional</label>
    <label><input type="radio" name="target_pasar" value="Internasional"> Internasional (Ekspor)</label>

    <label>Legalitas Usaha (boleh pilih lebih dari satu):</label><br>
    <input type="checkbox" name="legalitas[]" value="Tidak Ada" id="legalitas_tidak_ada"> Tidak Ada<br>
    <input type="checkbox" name="legalitas[]" value="NIB" class="legalitas_opsi"> NIB<br>
    <input type="checkbox" name="legalitas[]" value="SIUP" class="legalitas_opsi"> SIUP<br>
    <input type="checkbox" name="legalitas[]" value="NPWP" class="legalitas_opsi"> NPWP<br>
    <input type="checkbox" name="legalitas[]" value="PIRT" class="legalitas_opsi"> PIRT<br>
    <input type="checkbox" name="legalitas[]" value="BPOM" class="legalitas_opsi"> BPOM<br>
    <input type="checkbox" name="legalitas[]" value="Sertifikat Halal" class="legalitas_opsi"> Sertifikat Halal<br><br>

    <label>NIB (jika ada):</label><input type="text" name="nib" placeholder="Nomor Induk Berusaha (opsional)">
    <label>Apakah Usaha Anda Memiliki HAKI?</label>
    <label><input type="radio" name="haki" value="Ya" required> Ya</label>
    <label><input type="radio" name="haki" value="Tidak"> Tidak</label>

    <label>Sistem Pencatatan Keuangan:</label>
    <label><input type="radio" name="pencatatan" value="Tidak Ada" required> Tidak Ada</label>
    <label><input type="radio" name="pencatatan" value="Manual"> Manual</label>
    <label><input type="radio" name="pencatatan" value="Excel"> Excel</label>
    <label><input type="radio" name="pencatatan" value="Aplikasi"> Aplikasi Akuntansi</label>

    <label>Saluran Digital Usaha:</label>
    <label><input type="radio" name="saluran_digital" value="Tidak Ada" required> Tidak Ada</label>
    <label><input type="radio" name="saluran_digital" value="Instagram"> Instagram</label>
    <label><input type="radio" name="saluran_digital" value="Marketplace"> Marketplace</label>
    <label><input type="radio" name="saluran_digital" value="Website"> Website</label>

    <label>Metode Pembayaran yang Diterima:</label><br>
    <input type="checkbox" name="pembayaran[]" value="Tunai"> Tunai<br>
    <input type="checkbox" name="pembayaran[]" value="Transfer Bank"> Transfer Bank<br>
    <input type="checkbox" name="pembayaran[]" value="QRIS"> QRIS<br>
    <input type="checkbox" name="pembayaran[]" value="E-wallet"> E-wallet<br><br>

    <label>Status Produksi:</label>
    <label><input type="radio" name="status_produksi" value="Produksi Sendiri" required> Produksi Sendiri</label>
    <label><input type="radio" name="status_produksi" value="Reseller"> Reseller / Dropship</label>

    <label>Kepemilikan Tempat Usaha:</label>
    <label><input type="radio" name="tempat_usaha" value="Milik Sendiri" required> Milik Sendiri</label>
    <label><input type="radio" name="tempat_usaha" value="Sewa"> Sewa</label>

    <label>Sumber Modal Saat Ini:</label>
    <label><input type="radio" name="sumber_modal" value="Pribadi" required> Pribadi</label>
    <label><input type="radio" name="sumber_modal" value="Pinjaman"> Pinjaman</label>

    <label>Pernah Mengikuti Pelatihan UMKM?</label>
    <label><input type="radio" name="ikut_pelatihan" value="Ya" required> Ya</label>
    <label><input type="radio" name="ikut_pelatihan" value="Tidak"> Tidak</label>

    <label>Membutuhkan Pelatihan Tambahan?</label>
    <label><input type="radio" name="butuh_pelatihan" value="Ya" required> Ya</label>
    <label><input type="radio" name="butuh_pelatihan" value="Tidak"> Tidak</label>

    <label>Jenis Pelatihan yang Diinginkan:</label><input type="text" name="jenis_pelatihan">
    <label>Hambatan atau Tantangan Usaha Saat Ini:</label><textarea name="hambatan_usaha"></textarea>
    <label>Unggah Foto Produk atau Tempat Usaha:</label><input type="file" name="foto_usaha" accept="image/*">

    <button type="submit">Kirim Data Usaha</button>
  </form>
</div>

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

<style>
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
    .footer-top, .footer-bottom {
      flex-direction: column;
      text-align: center;
      gap: 1rem;
    }
  }
</style>


<script>
  // Validasi Form
  document.getElementById("formUsaha").addEventListener("submit", function(e) {
    if (!document.querySelector('input[name="target_pasar"]:checked')) { alert("Silakan pilih Target Pasar."); e.preventDefault(); return; }
    if (!document.querySelector('input[name="legalitas[]"]:checked')) { alert("Silakan pilih minimal satu Legalitas Usaha."); e.preventDefault(); return; }
    if (!document.querySelector('input[name="pencatatan"]:checked')) { alert("Silakan pilih Sistem Pencatatan Keuangan."); e.preventDefault(); return; }
    if (!document.querySelector('input[name="saluran_digital"]:checked')) { alert("Silakan pilih Saluran Digital Usaha."); e.preventDefault(); return; }
    if (!document.querySelector('input[name="pembayaran[]"]:checked')) { alert("Silakan pilih minimal satu Metode Pembayaran."); e.preventDefault(); return; }
  });

  // Logika Legalitas Usaha: "Tidak Ada" vs lainnya
  const tidakAda = document.getElementById('legalitas_tidak_ada');
  const opsi = document.querySelectorAll('.legalitas_opsi');

  tidakAda.addEventListener('change', function() {
    if (this.checked) opsi.forEach(cb => cb.checked = false);
  });

  opsi.forEach(cb => {
    cb.addEventListener('change', function() {
      if (this.checked) tidakAda.checked = false;
    });
  });
</script>

</body>
</html>
