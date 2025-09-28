<?php
session_start();

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Koneksi database
include "config.php";

// =======================
// FUNGSI TENTUKAN LEVEL UMKM
// =======================
function tentukanLevelUMKM($data) {
    $omzet = floatval($data['omzet']);
    $target_pasar = strtolower($data['target_pasar']);
    $legalitas = isset($data['legalitas']) ? $data['legalitas'] : [];
    $legalitas_lower = array_map('strtolower', $legalitas);
    $legalitas_count = count($legalitas);
    $pencatatan = strtolower($data['pencatatan']);
    $saluran_digital = strtolower($data['saluran_digital']);
    $haki = strtolower($data['haki']);

    // Level 4: UMKM Ekspor
    if (
        $target_pasar == 'internasional' &&
        $omzet > 500000000 &&
        in_array('nib', $legalitas_lower) &&
        in_array('siup', $legalitas_lower) &&
        in_array('bpom', $legalitas_lower) &&
        $pencatatan != 'tidak ada' &&
        in_array($saluran_digital, ['instagram','marketplace','website']) &&
        $haki == 'ya'
    ) return 4;

    // Level 3: UMKM Digital
    if (
        in_array($target_pasar, ['nasional','internasional']) &&
        $omzet >= 100000000 && $omzet <= 500000000 &&
        $legalitas_count >= 2 &&
        in_array($pencatatan, ['excel','aplikasi akuntansi']) &&
        in_array($saluran_digital, ['instagram','marketplace','website'])
    ) return 3;

    // Level 2: UMKM Sukses
    if (
        in_array($target_pasar, ['lokal','nasional']) &&
        $omzet >= 50000000 && $omzet <= 100000000 &&
        $legalitas_count >= 1 &&
        in_array($pencatatan, ['manual','excel','aplikasi akuntansi'])
    ) return 2;

    // Level 1: UMKM Substensi
    return 1;
}

// =======================
// UPLOAD FOTO USAHA
// =======================
$foto_usaha = NULL;
if (isset($_FILES['foto_usaha']) && $_FILES['foto_usaha']['error'] == 0) {
    $ext = pathinfo($_FILES['foto_usaha']['name'], PATHINFO_EXTENSION);
    $newName = 'uploads/' . time() . '_' . rand(1000,9999) . '.' . $ext;
    if (!is_dir('uploads')) mkdir('uploads', 0777, true);
    move_uploaded_file($_FILES['foto_usaha']['tmp_name'], $newName);
    $foto_usaha = $newName;
}

// =======================
// AMBIL DATA FORM
// =======================
$fields = [
    'nama_lengkap','nik','gender','tanggal_lahir','status_perkawinan','pendidikan','alamat_domisili','no_hp',
    'disabilitas','perempuan_tpk','kepala_keluarga','jumlah_anggota_keluarga','jumlah_tanggungan','tulang_punggung',
    'nama_usaha','tahun_mulai','jenis_usaha','bidang_usaha','jumlah_pegawai','kapasitas_produksi','omzet','modal_awal',
    'target_pasar','nib','haki','pencatatan','saluran_digital','status_produksi','tempat_usaha','sumber_modal',
    'ikut_pelatihan','butuh_pelatihan','jenis_pelatihan','hambatan_usaha'
];

$data = [];
foreach($fields as $f) {
    $data[$f] = isset($_POST[$f]) ? $_POST[$f] : null;
}

// Checkbox menjadi string
$legalitas_str = isset($_POST['legalitas']) ? implode(',', $_POST['legalitas']) : '';
$pembayaran_str = isset($_POST['pembayaran']) ? implode(',', $_POST['pembayaran']) : '';
$data['foto_usaha'] = $foto_usaha;

// Tentukan level UMKM (tetap disimpan untuk admin)
$data['level_umkm'] = tentukanLevelUMKM([
    'omzet'=>$data['omzet'],
    'target_pasar'=>$data['target_pasar'],
    'legalitas'=>isset($_POST['legalitas']) ? $_POST['legalitas'] : [],
    'pencatatan'=>$data['pencatatan'],
    'saluran_digital'=>$data['saluran_digital'],
    'haki'=>$data['haki']
]);

// =======================
// INSERT KE DATABASE
// =======================
$stmt = $conn->prepare("INSERT INTO umkm
(nama_lengkap, nik, gender, tanggal_lahir, status_perkawinan, pendidikan, alamat_domisili, no_hp, disabilitas,
perempuan_tpk, kepala_keluarga, jumlah_anggota_keluarga, jumlah_tanggungan, tulang_punggung,
nama_usaha, tahun_mulai, jenis_usaha, bidang_usaha, jumlah_pegawai, kapasitas_produksi, omzet, modal_awal,
target_pasar, legalitas, nib, haki, pencatatan, saluran_digital, pembayaran, status_produksi,
tempat_usaha, sumber_modal, ikut_pelatihan, butuh_pelatihan, jenis_pelatihan, hambatan_usaha,
foto_usaha, level_umkm)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

$stmt->bind_param(
    str_repeat('s', 38),
    $data['nama_lengkap'],$data['nik'],$data['gender'],$data['tanggal_lahir'],$data['status_perkawinan'],$data['pendidikan'],
    $data['alamat_domisili'],$data['no_hp'],$data['disabilitas'],$data['perempuan_tpk'],$data['kepala_keluarga'],
    $data['jumlah_anggota_keluarga'],$data['jumlah_tanggungan'],$data['tulang_punggung'],$data['nama_usaha'],
    $data['tahun_mulai'],$data['jenis_usaha'],$data['bidang_usaha'],$data['jumlah_pegawai'],$data['kapasitas_produksi'],
    $data['omzet'],$data['modal_awal'],$data['target_pasar'],$legalitas_str,$data['nib'],$data['haki'],
    $data['pencatatan'],$data['saluran_digital'],$pembayaran_str,$data['status_produksi'],
    $data['tempat_usaha'],$data['sumber_modal'],$data['ikut_pelatihan'],$data['butuh_pelatihan'],
    $data['jenis_pelatihan'],$data['hambatan_usaha'],$data['foto_usaha'],$data['level_umkm']
);

if($stmt->execute()) {
    // Redirect ke halaman berhasil.php
    header("Location: berhasil.php");
    exit;
} else {
    echo "Error: ".$stmt->error;
}

$stmt->close();
$conn->close();
?>
