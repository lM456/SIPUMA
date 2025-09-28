<?php
include "config.php";

// Ambil semua data level 3 (Digital)
$sql = "SELECT * FROM umkm WHERE level_umkm = 3 ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=umkm_digital.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
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
        <th>Foto Usaha</th>
        <th>Level UMKM</th>
        <th>Tanggal Input</th>
      </tr>";

while($row = mysqli_fetch_assoc($result)){
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nama_lengkap']}</td>
            <td>{$row['nik']}</td>
            <td>{$row['gender']}</td>
            <td>{$row['tanggal_lahir']}</td>
            <td>{$row['status_perkawinan']}</td>
            <td>{$row['pendidikan']}</td>
            <td>{$row['alamat_domisili']}</td>
            <td>{$row['no_hp']}</td>
            <td>{$row['disabilitas']}</td>
            <td>{$row['perempuan_tpk']}</td>
            <td>{$row['kepala_keluarga']}</td>
            <td>{$row['jumlah_anggota_keluarga']}</td>
            <td>{$row['jumlah_tanggungan']}</td>
            <td>{$row['tulang_punggung']}</td>
            <td>{$row['nama_usaha']}</td>
            <td>{$row['tahun_mulai']}</td>
            <td>{$row['jenis_usaha']}</td>
            <td>{$row['bidang_usaha']}</td>
            <td>{$row['jumlah_pegawai']}</td>
            <td>{$row['kapasitas_produksi']}</td>
            <td>{$row['omzet']}</td>
            <td>{$row['modal_awal']}</td>
            <td>{$row['target_pasar']}</td>
            <td>{$row['legalitas']}</td>
            <td>{$row['nib']}</td>
            <td>{$row['haki']}</td>
            <td>{$row['pencatatan']}</td>
            <td>{$row['saluran_digital']}</td>
            <td>{$row['pembayaran']}</td>
            <td>{$row['status_produksi']}</td>
            <td>{$row['tempat_usaha']}</td>
            <td>{$row['sumber_modal']}</td>
            <td>{$row['ikut_pelatihan']}</td>
            <td>{$row['butuh_pelatihan']}</td>
            <td>{$row['jenis_pelatihan']}</td>
            <td>{$row['hambatan_usaha']}</td>
            <td>{$row['foto_usaha']}</td>
            <td>{$row['level_umkm']}</td>
            <td>{$row['created_at']}</td>
          </tr>";
}

echo "</table>";
