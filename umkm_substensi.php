<?php
include "config.php";

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Ambil data level UMKM 1 (Substensi)
$sql = "SELECT * FROM umkm WHERE level_umkm = 1 ORDER BY created_at DESC LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);

// Hitung total data untuk pagination
$countSql = "SELECT COUNT(*) AS total FROM umkm WHERE level_umkm = 1";
$countResult = mysqli_query($conn, $countSql);
$total = mysqli_fetch_assoc($countResult)['total'];
$total_pages = ceil($total / $limit);

$kategori = "UMKM Substensi";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data <?= htmlspecialchars($kategori); ?></title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
/* CSS sama persis dengan UMKM Digital */
body { font-family: 'Poppins', sans-serif; background-color: #f8fafc; margin: 0; padding: 20px; color: #333; }
h2 { color: #1d3557; text-align: center; margin-bottom: 20px; }
.card { background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin: auto; max-width: 98%; overflow-x: auto; }
table { border-collapse: collapse; width: 100%; font-size: 13px; border-radius: 10px; overflow: hidden; }
th { background-color: #1d3557; color: white; text-align: center; padding: 10px; }
td { border-bottom: 1px solid #eee; padding: 8px; text-align: center; }
tr:nth-child(even) { background-color: #f9fbfd; }
tr:hover { background-color: #eef2ff; transition: 0.2s; }
img { border-radius: 6px; }
.btn { padding: 6px 12px; border-radius: 6px; font-size: 0.8rem; text-decoration: none; cursor: pointer; margin: 2px; display: inline-block; }
.btn-edit { background: #fca311; color: white; }
.btn-edit:hover { background: #e59400; }
.btn-delete { background: #e63946; color: white; border: none; }
.btn-delete:hover { background: #b72c36; }
.export-btn { display: inline-block; margin-bottom: 10px; background: #1d3557; color: #fff; padding: 8px 14px; border-radius: 6px; text-decoration: none; font-size: 13px; }
.export-btn:hover { background: #3b82f6; }
.back-btn { background: #6b7280 !important; }
.pagination { margin-top: 15px; text-align: center; }
.pagination a, .pagination strong { margin: 0 3px; padding: 6px 12px; text-decoration: none; border-radius: 6px; font-size: 13px; }
.pagination a { background: #1d3557; color: white; }
.pagination a:hover { background: #3b82f6; }
.pagination strong { background: #3b82f6; color: white; }
</style>
</head>
<body>

<h2>Data <?= htmlspecialchars($kategori); ?></h2>

<div class="card">
    <a href="export_umkm_substensi.php" class="export-btn">Export ke Excel</a>
    <a href="datausaha.php" class="export-btn back-btn">Kembali</a>


    <table>
        <thead>
            <tr>
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
                <th>Foto Usaha</th>
                <th>Level UMKM</th>
                <th>Tanggal Input</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($result) > 0){
            $no = $start + 1;
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>
                    <td>{$no}</td>
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
                    <td>Rp ".number_format($row['omzet'],0,',','.')."</td>
                    <td>Rp ".number_format($row['modal_awal'],0,',','.')."</td>
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
                    <td><img src='{$row['foto_usaha']}' width='60' alt='foto usaha'></td>
                    <td>{$row['level_umkm']}</td>
                    <td>{$row['created_at']}</td>
                    <td>
                        <a href='editdata.php?id={$row['id']}&redirect=umkm_substensi.php' class='btn btn-edit'>Edit</a>
                        <button class='btn btn-delete' onclick='confirmDelete({$row['id']}, {$row['level_umkm']})'>Delete</button>
                    </td>
                </tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='43' align='center'>Tidak ada data</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <div class="pagination">
    <?php
    if($total_pages > 1){
        for($i=1;$i<=$total_pages;$i++){
            if($i == $page){
                echo "<strong>$i</strong>";
            } else {
                echo "<a href='{$_SERVER['PHP_SELF']}?page=$i'>$i</a>";
            }
        }
    }
    ?>
    </div>
</div>

<script>
function confirmDelete(id, level){
    Swal.fire({
        title: 'Yakin hapus data ini?',
        text: "Data tidak bisa dikembalikan setelah dihapus.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e63946',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result)=>{
        if(result.isConfirmed){
            window.location.href = "delete.php?id=" + id + "&level=" + level + "&redirect=umkm_substensi.php";
        }
    });
}
</script>

<?php
// notifikasi
if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
    echo "<script>
    document.addEventListener('DOMContentLoaded', function(){
        let icon = '', title = '', text = '';
        if('$msg' === 'deleted'){ icon='success'; title='Berhasil'; text='Data berhasil dihapus'; }
        else if('$msg' === 'error'){ icon='error'; title='Gagal'; text='Terjadi kesalahan saat menghapus data'; }
        else if('$msg' === 'invalid'){ icon='warning'; title='Tidak valid'; text='ID tidak valid'; }
        else if('$msg' === 'updated'){ icon='success'; title='Berhasil'; text='Data berhasil diperbarui'; }
        else if('$msg' === 'update_error'){ icon='error'; title='Gagal'; text='Terjadi kesalahan saat memperbarui data'; }
        Swal.fire({icon: icon, title: title, text: text, timer:2000, showConfirmButton:false});
    });
    </script>";
}
?>

</body>
</html>
