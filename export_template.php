<?php
require_once __DIR__ . '/vendor/autoload.php'; // untuk Dompdf

use Dompdf\Dompdf;

// === Header kolom (biar gampang diatur) ===
$headers = [
    'No','ID','Nama Lengkap','NIK','Gender','Tanggal Lahir','Status Perkawinan','Pendidikan','Alamat Domisili','No HP',
    'Disabilitas','Perempuan TPK','Kepala Keluarga','Jumlah Anggota Keluarga','Jumlah Tanggungan','Tulang Punggung',
    'Nama Usaha','Tahun Mulai','Jenis Usaha','Bidang Usaha','Jumlah Pegawai','Kapasitas Produksi','Omzet','Modal Awal',
    'Target Pasar','Legalitas','NIB','HAKI','Pencatatan','Saluran Digital','Pembayaran','Status Produksi','Tempat Usaha',
    'Sumber Modal','Ikut Pelatihan','Butuh Pelatihan','Jenis Pelatihan','Hambatan Usaha','Kategori','Tanggal Input'
];

// === Ambil data dari DB ===
$result = mysqli_query($conn, "SELECT * FROM your_table");

// === Bangun tabel HTML ===
$table = "<table border='1'><thead><tr>";
foreach ($headers as $h) {
    $table .= "<th>" . htmlspecialchars($h) . "</th>";
}
$table .= "</tr></thead><tbody>";

$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $table .= "<tr>";
    $table .= "<td>{$no}</td>";
    $table .= "<td>" . htmlspecialchars($row['id']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['nik']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['gender']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['tanggal_lahir']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['status_perkawinan']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['pendidikan']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['alamat_domisili']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['no_hp']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['disabilitas']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['perempuan_tpk']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['kepala_keluarga']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['jumlah_anggota_keluarga']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['jumlah_tanggungan']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['tulang_punggung']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['nama_usaha']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['tahun_mulai']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['jenis_usaha']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['bidang_usaha']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['jumlah_pegawai']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['kapasitas_produksi']) . "</td>";
    $table .= "<td>Rp " . number_format((int)$row['omzet'], 0, ',', '.') . "</td>";
    $table .= "<td>Rp " . number_format((int)$row['modal_awal'], 0, ',', '.') . "</td>";
    $table .= "<td>" . htmlspecialchars($row['target_pasar']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['legalitas']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['nib']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['haki']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['pencatatan']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['saluran_digital']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['pembayaran']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['status_produksi']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['tempat_usaha']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['sumber_modal']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['ikut_pelatihan']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['butuh_pelatihan']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['jenis_pelatihan']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['hambatan_usaha']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['kategori']) . "</td>";
    $table .= "<td>" . htmlspecialchars($row['created_at']) . "</td>";
    $table .= "</tr>";
    $no++;
}
$table .= "</tbody></table>";

// === Cek type export ===
$type = $_GET['type'] ?? 'html';

if ($type === 'excel') {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=export.xls");
    echo $table;
    exit;
} elseif ($type === 'pdf') {
    $dompdf = new Dompdf();
    $dompdf->loadHtml($table);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream("export.pdf", ["Attachment" => true]);
    exit;
} else {
    echo $table;
}
?>
