<?php
include "config.php";

// Ambil semua data UMKM level 4 (Ekspor)
$sql = "SELECT * FROM umkm WHERE level_umkm = 4 ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

// Header untuk download sebagai Excel
$filename = "umkm_ekspor_" . date('Y-m-d') . ".xls";
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

// Helper escape HTML
function h($str){
    return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}

// Cetak tabel HTML (dibaca Excel)
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr>
        <th>No</th>
        <th>ID</th>
        <th>Nama Lengkap</th>
        <th>NIK</th>
        <th>Gender</th>
        <th>Tanggal Lahir</th>
        <th>Status Perkawinan</th>
        <th>Pendidikan</th>
        <th>Alamat</th>
        <th>No HP</th>
        <th>Disabilitas</th>
        <th>Perempuan TPK</th>
        <th>Kepala Keluarga</th>
        <th>Jumlah Anggota</th>
        <th>Jumlah Tanggungan</th>
        <th>Tulang Punggung</th>
        <th>Nama Usaha</th>
        <th>Tahun Mulai</th>
        <th>Jenis Usaha</th>
        <th>Bidang Usaha</th>
        <th>Jumlah Pegawai</th>
        <th>Kapasitas Produksi</th>
        <th>Omzet</th>
        <th>Modal Awal</th>
        <th>Target Pasar</th>
        <th>Legalitas</th>
        <th>NIB</th>
        <th>HAKI</th>
        <th>Pencatatan</th>
        <th>Saluran Digital</th>
        <th>Pembayaran</th>
        <th>Status Produksi</th>
        <th>Tempat Usaha</th>
        <th>Sumber Modal</th>
        <th>Ikut Pelatihan</th>
        <th>Butuh Pelatihan</th>
        <th>Jenis Pelatihan</th>
        <th>Hambatan Usaha</th>
        <th>Foto Usaha (URL/Path)</th>
        <th>Level UMKM</th>
        <th>Tanggal Input</th>
      </tr>";

$no = 1;
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        // Format angka jadi Rupiah
        $omzet = "Rp " . number_format((float)$row['omzet'], 0, ',', '.');
        $modal = "Rp " . number_format((float)$row['modal_awal'], 0, ',', '.');

        echo "<tr>
                <td>".h($no)."</td>
                <td>".h($row['id'])."</td>
                <td>".h($row['nama_lengkap'])."</td>
                <td style='mso-number-format:\"\\@\";'>".h($row['nik'])."</td>
                <td>".h($row['gender'])."</td>
                <td>".h($row['tanggal_lahir'])."</td>
                <td>".h($row['status_perkawinan'])."</td>
                <td>".h($row['pendidikan'])."</td>
                <td>".h($row['alamat_domisili'])."</td>
                <td style='mso-number-format:\"\\@\";'>".h($row['no_hp'])."</td>
                <td>".h($row['disabilitas'])."</td>
                <td>".h($row['perempuan_tpk'])."</td>
                <td>".h($row['kepala_keluarga'])."</td>
                <td>".h($row['jumlah_anggota_keluarga'])."</td>
                <td>".h($row['jumlah_tanggungan'])."</td>
                <td>".h($row['tulang_punggung'])."</td>
                <td>".h($row['nama_usaha'])."</td>
                <td>".h($row['tahun_mulai'])."</td>
                <td>".h($row['jenis_usaha'])."</td>
                <td>".h($row['bidang_usaha'])."</td>
                <td>".h($row['jumlah_pegawai'])."</td>
                <td>".h($row['kapasitas_produksi'])."</td>
                <td>".h($omzet)."</td>
                <td>".h($modal)."</td>
                <td>".h($row['target_pasar'])."</td>
                <td>".h($row['legalitas'])."</td>
                <td style='mso-number-format:\"\\@\";'>".h($row['nib'])."</td>
                <td>".h($row['haki'])."</td>
                <td>".h($row['pencatatan'])."</td>
                <td>".h($row['saluran_digital'])."</td>
                <td>".h($row['pembayaran'])."</td>
                <td>".h($row['status_produksi'])."</td>
                <td>".h($row['tempat_usaha'])."</td>
                <td>".h($row['sumber_modal'])."</td>
                <td>".h($row['ikut_pelatihan'])."</td>
                <td>".h($row['butuh_pelatihan'])."</td>
                <td>".h($row['jenis_pelatihan'])."</td>
                <td>".h($row['hambatan_usaha'])."</td>
                <td>".h($row['foto_usaha'])."</td>
                <td>".h($row['level_umkm'])."</td>
                <td>".h($row['created_at'])."</td>
              </tr>";
        $no++;
    }
} else {
    echo "<tr><td colspan='40'>Tidak ada data</td></tr>";
}

echo "</table>";
exit;
