<?php

include 'koneksi.php';
$tanggal_sekarang   = date('Y-m-d');
$waktu_sekarang     = date('H:i');
$bulan_sekarang     = date('m');
$tahun_sekarang     = date('Y');


// Menghitung Waktu Donor Darah Terdekat
$query = "SELECT tanggal_kegiatan, waktu_mulai FROM kegiatan_donor 
          WHERE CONCAT(tanggal_kegiatan, ' ', waktu_mulai) > NOW() 
          ORDER BY tanggal_kegiatan, waktu_mulai 
          LIMIT 1";

$result = $koneksi->query($query);
$row = $result->fetch_assoc();

if ($row) {
    // Format ke "YYYY/MM/DD HH:MM:SS"
    $waktuGabung = $row['tanggal_kegiatan'] . ' ' . $row['waktu_mulai'];
    $timestamp = date('Y/m/d H:i:s', strtotime($waktuGabung));
} else {
    // Fallback tanggal jauh di masa lalu
    $timestamp = "0101/01/01 01:01:01";
}


// echo $waktuKegiatanTerdekat;


// Menghitung total pengguna
$sql_totalPendonor = mysqli_query($koneksi, "SELECT COUNT(*) AS total_pendonor FROM users");
$totalPendonor = mysqli_fetch_assoc($sql_totalPendonor)['total_pendonor'];

// Menghitung total kegiatan donor
$sql_kegiatanDonor = mysqli_query($koneksi, "SELECT COUNT(*) AS kegiatan_donor FROM kegiatan_donor");
$kegiatanDonor = mysqli_fetch_assoc($sql_kegiatanDonor)['kegiatan_donor'];

// Menghitung pendonor berhasil
$sql_pendonorBerhasil = mysqli_query($koneksi, "SELECT COUNT(*) AS pendonor_berhasil FROM riwayat_donor");
$pendonorBerhasil = mysqli_fetch_assoc($sql_pendonorBerhasil)['pendonor_berhasil'];

// Menghitung total pendonor berhasil
$sql_totalPendonorBerhasil = mysqli_query($koneksi, "SELECT COUNT(*) AS totalPendonorBerhasil FROM riwayat_donor WHERE status = 'berhasil'");
$totalPendonorBerhasil = mysqli_fetch_assoc($sql_totalPendonorBerhasil)['totalPendonorBerhasil'];

// Menghitung total pendonor layak
$sql_totalPendonorLayak = mysqli_query($koneksi, "SELECT COUNT(*) AS totalPendonorLayak FROM riwayat_donor WHERE status = 'layak'");
$totalPendonorLayak = mysqli_fetch_assoc($sql_totalPendonorLayak)['totalPendonorLayak'];

// Menghitung total pendonor gagal
$sql_totalPendonorGagal = mysqli_query($koneksi, "SELECT COUNT(*) AS totalPendonorGagal FROM riwayat_donor WHERE status = 'gagal'");
$totalPendonorGagal = mysqli_fetch_assoc($sql_totalPendonorGagal)['totalPendonorGagal'];

// Menghitung jumlah pengunjung hari ini
$sql_PengunjungHariIni = mysqli_query($koneksi, "SELECT COUNT(*) AS pengunjung_hariIni FROM web_view WHERE tgl = '$tanggal_sekarang'");
$totalPengunjungHariIni = mysqli_fetch_assoc($sql_PengunjungHariIni)['pengunjung_hariIni'];

// Menghitung jumlah seluruh pengunjung
$sql_Pengunjung = mysqli_query($koneksi, "SELECT COUNT(*) AS total_pengunjung FROM web_view");
$totalPengunjung = mysqli_fetch_assoc($sql_Pengunjung)['total_pengunjung'];

// Menghitung jumlah pengguna baru bulan ini
$sql_PenggunaBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS pengguna_baru FROM users WHERE MONTH(created_at) = '$bulan_sekarang'");
$totalPenggunaBaru = mysqli_fetch_assoc($sql_PenggunaBaru)['pengguna_baru'];

// Menghitung jumlah seluruh kegiatan donor
$sql_TotalKegiatan = mysqli_query($koneksi, "SELECT COUNT(*) AS total_kegiatan FROM kegiatan_donor");
$totalKegiatan = mysqli_fetch_assoc($sql_TotalKegiatan)['total_kegiatan'];

// Query untuk menghitung jumlah pengguna perempuan
$sql_totalPendonorLakiLaki = mysqli_query($koneksi, "SELECT COUNT(*) AS totalPendonorLakiLaki FROM users WHERE jenis_kelamin = 'Laki-laki' AND role = 'pendonor'");
$totalPendonorLakiLaki = mysqli_fetch_assoc($sql_totalPendonorLakiLaki)['totalPendonorLakiLaki'];

// Query untuk menghitung jumlah pengguna perempuan
$sql_totalPendonorPerempuan = mysqli_query($koneksi, "SELECT COUNT(*) AS totalPendonorPerempuan FROM users WHERE jenis_kelamin = 'Perempuan' AND role = 'pendonor'");
$totalPendonorPerempuan = mysqli_fetch_assoc($sql_totalPendonorPerempuan)['totalPendonorPerempuan'];

// Query untuk menghitung jumlah kegiatan yang akan datang (segera)
$sql_totalKegiatanSegera = mysqli_query($koneksi, "SELECT COUNT(*) AS totalKegiatanSegera FROM kegiatan_donor WHERE tanggal_kegiatan > '$tanggal_sekarang'");
$totalKegiatanSegera = mysqli_fetch_assoc($sql_totalKegiatanSegera)['totalKegiatanSegera'];

// Query untuk menghitung jumlah kegiatan yang berlangsung hari ini
$sql_totalKegiatanBerlangsung = mysqli_query($koneksi, "SELECT COUNT(*) AS totalKegiatanBerlangsung FROM kegiatan_donor WHERE tanggal_kegiatan = '$tanggal_sekarang'");
$totalKegiatanBerlangsung = mysqli_fetch_assoc($sql_totalKegiatanBerlangsung)['totalKegiatanBerlangsung'];

// Query untuk menghitung jumlah kegiatan yang sudah selesai
$sql_totalKegiatanSelesai = mysqli_query($koneksi, "SELECT COUNT(*) AS totalKegiatanSelesai FROM kegiatan_donor WHERE tanggal_kegiatan < '$tanggal_sekarang'");
$totalKegiatanSelesai = mysqli_fetch_assoc($sql_totalKegiatanSelesai)['totalKegiatanSelesai'];


// Query untuk menghitung jumlah donor berdasarkan status dan nama kegiatan
// $sql = "
//     SELECT kd.nama_kegiatan, rd.status, COUNT(*) AS total 
//     FROM riwayat_donor rd
//     JOIN kegiatan_donor kd ON rd.id_kegiatan = kd.id_kegiatan
//     WHERE rd.status IN ('tidak berhasil', 'berhasil', 'layak') 
//     GROUP BY kd.nama_kegiatan, rd.status
// ";
// $result = mysqli_query($koneksi, $sql);

// // Inisialisasi array untuk menyimpan data
// $kegiatanLabels = [];
// $statusCounts = [
//     'tidak berhasil' => [],
//     'berhasil' => [],
//     'layak' => []
// ];

// // Mengambil data dari query
// while ($row = mysqli_fetch_assoc($result)) {
//     $kegiatanLabels[] = $row['nama_kegiatan'];
//     $statusCounts[$row['status']][] = $row['total'];
// }


// // Menghitung total untuk setiap kegiatan
// $finalCounts = [
//     'tidak berhasil' => array_fill(0, count($kegiatanLabels), 0),
//     'berhasil' => array_fill(0, count($kegiatanLabels), 0),
//     'layak' => array_fill(0, count($kegiatanLabels), 0),
// ];

// // Mengisi total berdasarkan kegiatan
// foreach ($statusCounts as $status => $counts) {
//     foreach ($counts as $index => $count) {
//         $finalCounts[$status][$index] += $count;
//     }
// }
