<?php

include 'config.php';

if (isset($_POST['kirim_pertanyaan'])) {
	// Mengambil data dari form
	$nama   = htmlspecialchars($_POST['nama']);
	$pesan  = htmlspecialchars($_POST['pesan']);
	$tujuan = htmlspecialchars($_POST['tujuan']);

	// Validasi agar data tidak kosong
	if (!empty($nama) && !empty($tujuan) && !empty($pesan)) {
		// Meng-encode pesan untuk URL
		$pesan_terkode = urlencode("Halo kak Fauziah, saya " . $nama . " ingin bertanya tentang " . $tujuan . ". " . $pesan);

		// Membuat URL WhatsApp
		$kirim_pesan = "https://api.whatsapp.com/send?phone=6287869026613&text=" . $pesan_terkode;

		// Redirect ke WhatsApp dengan pesan yang sudah terisi
		header('Location: ' . $kirim_pesan);
		exit();  // Pastikan tidak ada kode yang berjalan setelah redirect
	} else {
		// Ganti dengan halaman form Anda
		echo "<script>
                alert('Harap lengkapi semua data!');
                location.replace('../contact'); 
              </script>";
	}
}
