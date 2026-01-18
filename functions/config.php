<?php

define("NAMA_WEB", "SIDESA NATAR");
define("NAMA_LENGKAP", "Laila Nurmas Vigih");
define("IG", "lailansvh");
define("EMAIL", "lailanurmasv@gmail.com");
define("NO_WA", "085162642703");
define("MATKUL", "Pemrograman Lanjut");
define("URL_IG", "https://www.instagram.com/lailansvh");
define("URL_WA", "https://api.whatsapp.com/send/?phone=6285173200421");
define("NAMA_KAMPUS", "IIB Darmajaya");
define("MAPS_KAMPUS", "https://maps.app.goo.gl/MDRbHF1mJTq81Ec67");

date_default_timezone_set('Asia/Jakarta');
$pukul = date('H:i A');

// Memeriksa apakah link adalah localhost
$host = $_SERVER['HTTP_HOST'];
if ($host === 'localhost' || strpos($host, '127.0.0.1') !== false) {
    // Untuk penggunaan xampp
    $server     = 'localhost';
    $username   = 'root';
    $password   = '';
    $database   = 'kalianda-beach-trip';
} else {
    // Untuk penggunaan hosting
    $server     = '';
    $username   = '';
    $password   = '';
    $database   = '';
}

$koneksi    = mysqli_connect($server, $username, $password, $database);

if (!$koneksi) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

if (!function_exists('formatTanggalIndonesia')) {
    function formatTanggalIndonesia($tanggalInggris)
    {
        $namaHari = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu'
        ];

        $namaBulan = [
            'January'   => 'Januari',
            'February'  => 'Februari',
            'March'     => 'Maret',
            'April'     => 'April',
            'May'       => 'Mei',
            'June'      => 'Juni',
            'July'      => 'Juli',
            'August'    => 'Agustus',
            'September' => 'September',
            'October'   => 'Oktober',
            'November'  => 'November',
            'December'  => 'Desember'
        ];

        $date = new DateTime($tanggalInggris);
        $hariInggris = $date->format('l');
        $bulanInggris = $date->format('F');

        $hariIndonesia = $namaHari[$hariInggris];
        $bulanIndonesia = $namaBulan[$bulanInggris];

        return $hariIndonesia . ', ' . $date->format('d') . ' ' . $bulanIndonesia . ' ' . $date->format('Y');
    }
}
