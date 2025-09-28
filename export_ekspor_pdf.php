<?php
require('fpdf.php');

include "config.php";

// Ambil data UMKM level 4 (Ekspor)
$sql = "SELECT * FROM umkm WHERE level_umkm = 4 ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',14);
        $this->Cell(0,10,'Data UMKM Ekspor',0,1,'C');
        $this->Ln(5);

        // Header tabel
        $this->SetFont('Arial','B',7);
        $this->Cell(7,10,'No',1,0,'C');
        $this->Cell(15,10,'ID',1,0,'C');
        $this->Cell(30,10,'Nama Lengkap',1,0,'C');
        $this->Cell(22,10,'NIK',1,0,'C');
        $this->Cell(12,10,'Gender',1,0,'C');
        $this->Cell(20,10,'Tgl Lahir',1,0,'C');
        $this->Cell(20,10,'Perkawinan',1,0,'C');
        $this->Cell(20,10,'Pendidikan',1,0,'C');
        $this->Cell(30,10,'Alamat',1,0,'C');
        $this->Cell(20,10,'No HP',1,0,'C');
        $this->Cell(18,10,'Disabilitas',1,0,'C');
        $this->Cell(18,10,'TPK',1,0,'C');
        $this->Cell(18,10,'KK',1,0,'C');
        $this->Cell(15,10,'Anggota',1,0,'C');
        $this->Cell(15,10,'Tanggungan',1,0,'C');
        $this->Cell(20,10,'Tulang P.',1,0,'C');
        $this->Cell(30,10,'Nama Usaha',1,0,'C');
        $this->Cell(18,10,'Thn Mulai',1,0,'C');
        $this->Cell(25,10,'Jenis Usaha',1,0,'C');
        $this->Cell(25,10,'Bidang Usaha',1,0,'C');
        $this->Cell(18,10,'Pegawai',1,0,'C');
        $this->Cell(25,10,'Produksi',1,0,'C');
        $this->Cell(25,10,'Omzet',1,0,'C');
        $this->Cell(25,10,'Modal Awal',1,0,'C');
        $this->Cell(25,10,'Target Pasar',1,0,'C');
        $this->Cell(20,10,'Legalitas',1,0,'C');
        $this->Cell(20,10,'NIB',1,0,'C');
        $this->Cell(18,10,'HAKI',1,0,'C');
        $this->Cell(22,10,'Pencatatan',1,0,'C');
        $this->Cell(25,10,'Saluran Digital',1,0,'C');
        $this->Cell(25,10,'Pembayaran',1,0,'C');
        $this->Cell(22,10,'Produksi',1,0,'C');
        $this->Cell(25,10,'Tempat Usaha',1,0,'C');
        $this->Cell(25,10,'Sumber Modal',1,0,'C');
        $this->Cell(20,10,'Ikut Pel.',1,0,'C');
        $this->Cell(20,10,'Butuh Pel.',1,0,'C');
        $this->Cell(25,10,'Jenis Pelatihan',1,0,'C');
        $this->Cell(25,10,'Hambatan Usaha',1,0,'C');
        $this->Cell(30,10,'Foto Usaha',1,0,'C');
        $this->Cell(15,10,'Level',1,0,'C');
        $this->Cell(25,10,'Tgl Input',1,1,'C');
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Halaman '.$this->PageNo(),0,0,'C');
    }
}

$pdf = new PDF('L','mm','A3'); // A3 supaya muat semua kolom
$pdf->AddPage();
$pdf->SetFont('Arial','',7);

$no = 1;
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $omzet = "Rp " . number_format((float)$row['omzet'], 0, ',', '.');
        $modal = "Rp " . number_format((float)$row['modal_awal'], 0, ',', '.');

        $pdf->Cell(7,10,$no++,1);
        $pdf->Cell(15,10,$row['id'],1);
        $pdf->Cell(30,10,substr($row['nama_lengkap'],0,20),1);
        $pdf->Cell(22,10,$row['nik'],1);
        $pdf->Cell(12,10,$row['gender'],1);
        $pdf->Cell(20,10,$row['tanggal_lahir'],1);
        $pdf->Cell(20,10,$row['status_perkawinan'],1);
        $pdf->Cell(20,10,$row['pendidikan'],1);
        $pdf->Cell(30,10,substr($row['alamat_domisili'],0,25),1);
        $pdf->Cell(20,10,$row['no_hp'],1);
        $pdf->Cell(18,10,$row['disabilitas'],1);
        $pdf->Cell(18,10,$row['perempuan_tpk'],1);
        $pdf->Cell(18,10,$row['kepala_keluarga'],1);
        $pdf->Cell(15,10,$row['jumlah_anggota_keluarga'],1);
        $pdf->Cell(15,10,$row['jumlah_tanggungan'],1);
        $pdf->Cell(20,10,$row['tulang_punggung'],1);
        $pdf->Cell(30,10,substr($row['nama_usaha'],0,20),1);
        $pdf->Cell(18,10,$row['tahun_mulai'],1);
        $pdf->Cell(25,10,$row['jenis_usaha'],1);
        $pdf->Cell(25,10,$row['bidang_usaha'],1);
        $pdf->Cell(18,10,$row['jumlah_pegawai'],1);
        $pdf->Cell(25,10,$row['kapasitas_produksi'],1);
        $pdf->Cell(25,10,$omzet,1);
        $pdf->Cell(25,10,$modal,1);
        $pdf->Cell(25,10,$row['target_pasar'],1);
        $pdf->Cell(20,10,$row['legalitas'],1);
        $pdf->Cell(20,10,$row['nib'],1);
        $pdf->Cell(18,10,$row['haki'],1);
        $pdf->Cell(22,10,$row['pencatatan'],1);
        $pdf->Cell(25,10,$row['saluran_digital'],1);
        $pdf->Cell(25,10,$row['pembayaran'],1);
        $pdf->Cell(22,10,$row['status_produksi'],1);
        $pdf->Cell(25,10,$row['tempat_usaha'],1);
        $pdf->Cell(25,10,$row['sumber_modal'],1);
        $pdf->Cell(20,10,$row['ikut_pelatihan'],1);
        $pdf->Cell(20,10,$row['butuh_pelatihan'],1);
        $pdf->Cell(25,10,$row['jenis_pelatihan'],1);
        $pdf->Cell(25,10,$row['hambatan_usaha'],1);
        $pdf->Cell(30,10,substr($row['foto_usaha'],0,25),1);
        $pdf->Cell(15,10,$row['level_umkm'],1);
        $pdf->Cell(25,10,$row['created_at'],1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0,10,'Tidak ada data',1,1,'C');
}

$pdf->Output('D','umkm_ekspor_'.date('Y-m-d').'.pdf');
exit;
?>
