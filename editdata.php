<?php
include "config.php";

if (!isset($_GET['id'])) {
    header("Location: umkm_digital.php?msg=invalid");
    exit;
}
$id = (int) $_GET['id'];
$sql = "SELECT * FROM umkm WHERE id = $id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) === 0) {
    header("Location: umkm_digital.php?msg=invalid");
    exit;
}
$data = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // =============== Upload Foto Usaha ===============
    if (isset($_FILES['foto_usaha']) && $_FILES['foto_usaha']['error'] == 0) {
        $ext = pathinfo($_FILES['foto_usaha']['name'], PATHINFO_EXTENSION);
        $newName = 'uploads/' . time() . '_' . rand(1000,9999) . '.' . $ext;
        if (!is_dir('uploads')) mkdir('uploads', 0777, true);
        move_uploaded_file($_FILES['foto_usaha']['tmp_name'], $newName);

        $_POST['foto_usaha'] = $newName;
    } else {
        // kalau tidak upload, pakai foto lama
        $_POST['foto_usaha'] = $data['foto_usaha'];
    }

    // =============== Update Data ===============
    $fields = [];
    foreach ($_POST as $key => $value) {
        if ($key == 'redirect') continue;
        $fields[] = "$key='" . mysqli_real_escape_string($conn, $value) . "'";
    }
    $updateSql = "UPDATE umkm SET " . implode(", ", $fields) . " WHERE id=$id";

    if (mysqli_query($conn, $updateSql)) {
        $redirect = $_POST['redirect'] ?? 'umkm_digital.php';
        header("Location: " . $redirect . "?msg=updated");
        exit;
    } else {
        $redirect = $_POST['redirect'] ?? 'umkm_digital.php';
        header("Location: " . $redirect . "?msg=update_error");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Data UMKM</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Poppins', sans-serif; background: #f1f5f9; padding: 20px; }
    .container { max-width: 800px; margin: auto; background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    h2 { text-align: center; color: #1d3557; margin-bottom: 20px; }
    h3 { margin-top: 25px; color: #2563eb; border-bottom: 2px solid #e2e8f0; padding-bottom: 5px; }
    label { display: block; margin-top: 15px; font-weight: 600; font-size: 14px; color: #374151; }
    input, textarea, select { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; }
    textarea { resize: vertical; }
    button { padding: 12px; width: 100%; background: #1d3557; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 600; }
    button:hover { background: #2563eb; }
    .btn-back { width: auto; margin-bottom: 20px; background: #6b7280; }
    .btn-back:hover { background: #4b5563; }
    img.preview { margin-top:10px; border-radius:8px; max-width:200px; }
</style>
</head>
<body>
<div class="container">
    <div style="display:flex; justify-content:flex-start;">
        <button type="button" onclick="history.back()" class="btn-back">⬅ Kembali</button>
    </div>
    <h2>Edit Data UMKM</h2>
    <form method="post" enctype="multipart/form-data">

        <h3>Data Pribadi</h3>
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($data['nama_lengkap']); ?>" required>

        <label>NIK</label>
        <input type="text" name="nik" value="<?= htmlspecialchars($data['nik']); ?>" required>

        <label>Gender</label>
        <input type="text" name="gender" value="<?= htmlspecialchars($data['gender']); ?>">

        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="<?= htmlspecialchars($data['tanggal_lahir']); ?>">

        <label>Status Perkawinan</label>
        <input type="text" name="status_perkawinan" value="<?= htmlspecialchars($data['status_perkawinan']); ?>">

        <label>Pendidikan</label>
        <input type="text" name="pendidikan" value="<?= htmlspecialchars($data['pendidikan']); ?>">

        <label>No HP</label>
        <input type="text" name="no_hp" value="<?= htmlspecialchars($data['no_hp']); ?>" required>

        <label>Alamat Domisili</label>
        <textarea name="alamat_domisili"><?= htmlspecialchars($data['alamat_domisili']); ?></textarea>

        <h3>Data Keluarga</h3>
        <label>Disabilitas</label>
        <input type="text" name="disabilitas" value="<?= htmlspecialchars($data['disabilitas']); ?>">

        <label>Perempuan TPK</label>
        <input type="text" name="perempuan_tpk" value="<?= htmlspecialchars($data['perempuan_tpk']); ?>">

        <label>Kepala Keluarga</label>
        <input type="text" name="kepala_keluarga" value="<?= htmlspecialchars($data['kepala_keluarga']); ?>">

        <label>Jumlah Anggota</label>
        <input type="number" name="jumlah_anggota_keluarga" value="<?= htmlspecialchars($data['jumlah_anggota_keluarga']); ?>">

        <label>Jumlah Tanggungan</label>
        <input type="number" name="jumlah_tanggungan" value="<?= htmlspecialchars($data['jumlah_tanggungan']); ?>">

        <label>Tulang Punggung</label>
        <input type="text" name="tulang_punggung" value="<?= htmlspecialchars($data['tulang_punggung']); ?>">

        <h3>Data Usaha</h3>
        <label>Nama Usaha</label>
        <input type="text" name="nama_usaha" value="<?= htmlspecialchars($data['nama_usaha']); ?>" required>

        <label>Tahun Mulai</label>
        <input type="text" name="tahun_mulai" value="<?= htmlspecialchars($data['tahun_mulai']); ?>">

        <label>Jenis Usaha</label>
        <input type="text" name="jenis_usaha" value="<?= htmlspecialchars($data['jenis_usaha']); ?>" required>

        <label>Bidang Usaha</label>
        <input type="text" name="bidang_usaha" value="<?= htmlspecialchars($data['bidang_usaha']); ?>">

        <label>Jumlah Pegawai</label>
        <input type="number" name="jumlah_pegawai" value="<?= htmlspecialchars($data['jumlah_pegawai']); ?>">

        <label>Kapasitas Produksi</label>
        <input type="text" name="kapasitas_produksi" value="<?= htmlspecialchars($data['kapasitas_produksi']); ?>">

        <label>Omzet</label>
        <input type="number" name="omzet" value="<?= htmlspecialchars($data['omzet']); ?>" required>

        <label>Modal Awal</label>
        <input type="number" name="modal_awal" value="<?= htmlspecialchars($data['modal_awal']); ?>" required>

        <label>Target Pasar</label>
        <input type="text" name="target_pasar" value="<?= htmlspecialchars($data['target_pasar']); ?>">

        <h3>Legalitas</h3>
        <label>Legalitas</label>
        <input type="text" name="legalitas" value="<?= htmlspecialchars($data['legalitas']); ?>">

        <label>NIB</label>
        <input type="text" name="nib" value="<?= htmlspecialchars($data['nib']); ?>">

        <label>HAKI</label>
        <input type="text" name="haki" value="<?= htmlspecialchars($data['haki']); ?>">

        <label>Pencatatan</label>
        <input type="text" name="pencatatan" value="<?= htmlspecialchars($data['pencatatan']); ?>">

        <h3>Digitalisasi & Pembayaran</h3>
        <label>Saluran Digital</label>
        <input type="text" name="saluran_digital" value="<?= htmlspecialchars($data['saluran_digital']); ?>">

        <label>Pembayaran</label>
        <input type="text" name="pembayaran" value="<?= htmlspecialchars($data['pembayaran']); ?>">

        <h3>Produksi & Modal</h3>
        <label>Status Produksi</label>
        <input type="text" name="status_produksi" value="<?= htmlspecialchars($data['status_produksi']); ?>">

        <label>Tempat Usaha</label>
        <input type="text" name="tempat_usaha" value="<?= htmlspecialchars($data['tempat_usaha']); ?>">

        <label>Sumber Modal</label>
        <input type="text" name="sumber_modal" value="<?= htmlspecialchars($data['sumber_modal']); ?>">

        <h3>Pelatihan & Hambatan</h3>
        <label>Ikut Pelatihan</label>
        <input type="text" name="ikut_pelatihan" value="<?= htmlspecialchars($data['ikut_pelatihan']); ?>">

        <label>Butuh Pelatihan</label>
        <input type="text" name="butuh_pelatihan" value="<?= htmlspecialchars($data['butuh_pelatihan']); ?>">

        <label>Jenis Pelatihan</label>
        <input type="text" name="jenis_pelatihan" value="<?= htmlspecialchars($data['jenis_pelatihan']); ?>">

        <label>Hambatan Usaha</label>
        <textarea name="hambatan_usaha"><?= htmlspecialchars($data['hambatan_usaha']); ?></textarea>

        <h3>Foto Usaha</h3>
        <?php if ($data['foto_usaha']) : ?>
            <img src="<?= $data['foto_usaha'] ?>" class="preview">
        <?php endif; ?>
        <input type="file" name="foto_usaha">

        <h3>Lain-lain</h3>
        <label>Level UMKM</label>
        <input type="number" name="level_umkm" value="<?= htmlspecialchars($data['level_umkm']); ?>">

        <input type="hidden" name="redirect" value="<?= htmlspecialchars($_GET['redirect'] ?? 'umkm_digital.php'); ?>">
        <button type="submit">Simpan Perubahan</button>
    </form>
</div>
</body>
</html>
