<?php
require_once 'config.php';
session_start();
ob_start();

// proteksi admin
if (!isset($_SESSION['sesi_role']) || $_SESSION['sesi_role'] !== 'admin') {
	header("Location: ../auth/login");
	exit;
}

/* =========================================================
   UPLOAD GAMBAR DESTINASI
========================================================= */
function uploadGambarDestinasi()
{
	if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] === 4) {
		return null;
	}

	$nama = $_FILES['gambar']['name'];
	$tmp  = $_FILES['gambar']['tmp_name'];
	$size = $_FILES['gambar']['size'];

	$ext = strtolower(pathinfo($nama, PATHINFO_EXTENSION));
	$allow = ['jpg', 'jpeg', 'png', 'webp'];

	if (!in_array($ext, $allow)) {
		echo "<script>alert('Format gambar harus JPG / PNG / WEBP');history.back();</script>";
		exit;
	}

	if ($size > 2 * 1024 * 1024) {
		echo "<script>alert('Ukuran gambar maksimal 2MB');history.back();</script>";
		exit;
	}

	$nama_baru = 'destinasi_' . uniqid() . '.' . $ext;
	move_uploaded_file($tmp, "../dashboard/assets/img/destinasi_wisata/" . $nama_baru);

	return $nama_baru;
}

/* =========================================================
   TAMBAH DESTINASI
========================================================= */
if (isset($_POST['btn_tambah_destinasi'])) {

	$nama_destinasi     = htmlspecialchars(trim($_POST['nama_destinasi']));
	$lokasi             = htmlspecialchars(trim($_POST['lokasi']));
	$kontak_pengelola   = htmlspecialchars(trim($_POST['kontak_pengelola']));
	$harga_per_orang    = htmlspecialchars(trim($_POST['harga_per_orang']));
	$jam_buka           = htmlspecialchars(trim($_POST['jam_buka']));
	$jam_tutup          = htmlspecialchars(trim($_POST['jam_tutup']));
	$tagline_aktivitas  = htmlspecialchars(trim($_POST['tagline_aktivitas']));

	$gambar = uploadGambarDestinasi();

	$query = "
        INSERT INTO destinasi_wisata
        (nama_destinasi, lokasi, kontak_pengelola, harga_per_orang, jam_buka, jam_tutup, tagline_aktivitas, gambar)
        VALUES (
            '$nama_destinasi',
            '$lokasi',
            '$kontak_pengelola',
            '$harga_per_orang',
            '$jam_buka',
            '$jam_tutup',
            '$tagline_aktivitas',
            '$gambar'
        )
    ";

	if (mysqli_query($koneksi, $query)) {
		header("Location: ../dashboard/admin?page=data destinasi&status=success");
	} else {
		header("Location: ../dashboard/admin?page=tambah destinasi&status=error&msg=" . urlencode(mysqli_error($koneksi)));
	}
	exit;
}

/* =========================================================
   EDIT DESTINASI
========================================================= */
if (isset($_POST['btn_update_destinasi'])) {

	$id_destinasi      = htmlspecialchars($_POST['id_destinasi']);
	$nama_destinasi    = htmlspecialchars(trim($_POST['nama_destinasi']));
	$lokasi            = htmlspecialchars(trim($_POST['lokasi']));
	$kontak_pengelola  = htmlspecialchars(trim($_POST['kontak_pengelola']));
	$harga_per_orang   = htmlspecialchars(trim($_POST['harga_per_orang']));
	$jam_buka          = htmlspecialchars(trim($_POST['jam_buka']));
	$jam_tutup         = htmlspecialchars(trim($_POST['jam_tutup']));
	$tagline_aktivitas = htmlspecialchars(trim($_POST['tagline_aktivitas']));

	// gambar lama dari hidden input
	$gambar_lama = $_POST['gambar_lama'] ?? '';

	// default → tetap pakai gambar lama
	$gambar_final = $gambar_lama;

	// CEK JIKA USER UPLOAD GAMBAR BARU
	if (!empty($_FILES['gambar']['name'])) {

		$gambar_baru = uploadGambarDestinasi();

		if (!empty($gambar_baru)) {

			// hapus gambar lama jika ada
			if (!empty($gambar_lama) && file_exists("../dashboard/assets/img/destinasi_wisata/" . $gambar_lama)) {
				unlink("../dashboard/assets/img/destinasi_wisata/" . $gambar_lama);
			}

			// pakai gambar baru
			$gambar_final = $gambar_baru;
		}
	}

	$query = "
        UPDATE destinasi_wisata SET
            nama_destinasi = '$nama_destinasi',
            lokasi = '$lokasi',
            kontak_pengelola = '$kontak_pengelola',
            harga_per_orang = '$harga_per_orang',
            jam_buka = '$jam_buka',
            jam_tutup = '$jam_tutup',
            tagline_aktivitas = '$tagline_aktivitas',
            gambar = '$gambar_final'
        WHERE id_destinasi = '$id_destinasi'
    ";

	if (mysqli_query($koneksi, $query)) {
		header("Location: ../dashboard/admin?page=detail destinasi&id=$id_destinasi&status=success");
	} else {
		header("Location: ../dashboard/admin?page=detail destinasi&id=$id_destinasi&status=error&msg=" . urlencode(mysqli_error($koneksi)));
	}
	exit;
}


/* =========================================================
   HAPUS DESTINASI
========================================================= */
if (isset($_POST['btn_delete_destinasi'])) {

	$id_destinasi = htmlspecialchars($_POST['id_destinasi']);
	$gambar       = htmlspecialchars($_POST['gambar']);

	if (!empty($gambar) && file_exists("../dashboard/assets/img/destinasi_wisata/" . $gambar)) {
		unlink("../dashboard/assets/img/destinasi_wisata/" . $gambar);
	}

	$query = "DELETE FROM destinasi_wisata WHERE id_destinasi = '$id_destinasi'";

	if (mysqli_query($koneksi, $query)) {
		header("Location: ../dashboard/admin?page=data destinasi&status=deleted");
	} else {
		header("Location: ../dashboard/admin?page=data destinasi&status=error&msg=" . urlencode(mysqli_error($koneksi)));
	}
	exit;
}

ob_end_flush();
