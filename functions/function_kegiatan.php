<?php

include 'koneksi.php';
session_start();

// Pastikan tidak ada output sebelum ini
ob_start();

// Simpan semua data form ke session
$_SESSION['form_kegiatan'] = [
	'nama_kegiatan'     => isset($_POST['nama_kegiatan']) ? htmlspecialchars(trim($_POST['nama_kegiatan'])) : '',
	'penyelenggara'     => isset($_POST['penyelenggara']) ? htmlspecialchars(trim($_POST['penyelenggara'])) : '',
	'tanggal_kegiatan'  => isset($_POST['tanggal_kegiatan']) ? htmlspecialchars(trim($_POST['tanggal_kegiatan'])) : '',
	'kota'       		=> isset($_POST['kota']) ? htmlspecialchars(trim($_POST['kota'])) : '',
	'waktu_mulai'   	=> isset($_POST['waktu_mulai']) ? htmlspecialchars(trim($_POST['waktu_mulai'])) : '',
	'waktu_selesai'  	=> isset($_POST['waktu_selesai']) ? htmlspecialchars(trim($_POST['waktu_selesai'])) : '',
	'target_pendonor'  	=> isset($_POST['target_pendonor']) ? htmlspecialchars(trim($_POST['target_pendonor'])) : '',
	'alamat'        	=> isset($_POST['alamat']) ? htmlspecialchars(trim($_POST['alamat'])) : '',
];

function uploadImg()
{
	$nama_img 	= $_FILES['img_kegiatan']['name'];
	$size_img 	= $_FILES['img_kegiatan']['size'];
	$tmp_name 	= $_FILES['img_kegiatan']['tmp_name'];

	$valid_img		= ['jpg', 'jpeg', 'png'];
	$extensi_img	= explode('.', $nama_img);
	$extensi_img	= strtolower(end($extensi_img));

	if (!in_array($extensi_img, $valid_img)) {
		echo "<script>
				alert('Exstensi img tidak valid!');
				location.replace('../dashboard/admin?page=profile');
			</script>";
	} else if ($size_img > 1000000) {
		echo "<script>
				alert('Ukuran img terlalu besar melebihi 1MB!');
				location.replace('../dashboard/admin?page=profile);
			</script>";
	} else {
		$img_baru 	= uniqid();
		$img_baru 	.= '.' . $extensi_img;

		move_uploaded_file($tmp_name, '../dashboard/assets/profile/' . $img_baru);

		return $img_baru;
	}
}

function uploadImgKegiatan()
{
	// Pastikan $_FILES['img_kegiatan'] adalah array
	if (!isset($_FILES['img_kegiatan']) || !is_array($_FILES['img_kegiatan']['name'])) {
		echo "<script>
                alert('Tidak ada file yang diupload!');
                location.replace('../dashboard/admin?page=detail kegiatan');
            </script>";
		return []; // Kembalikan array kosong jika tidak ada file
	}

	$files = $_FILES['img_kegiatan']; // Mengambil array dari file yang diupload
	// $valid_img = ['jpg', 'jpeg', 'png'];
	$uploadedImages = []; // Array untuk menyimpan nama file yang berhasil diupload
	$invalidFiles = []; // Array untuk menyimpan nama file yang tidak valid

	for ($i = 0; $i < count($files['name']); $i++) {
		$nama_img = $files['name'][$i];
		$size_img = $files['size'][$i];
		$tmp_name = $files['tmp_name'][$i];

		$extensi_img = explode('.', $nama_img);
		$extensi_img = strtolower(end($extensi_img));

		// Validasi ekstensi
		// if (!in_array($extensi_img, $valid_img)) {
		//     $invalidFiles[] = $nama_img; // Simpan nama file yang tidak valid
		//     continue; // Lewati file ini dan lanjut ke file berikutnya
		// }

		// Validasi ukuran
		if ($size_img > 1000000) {
			$invalidFiles[] = $nama_img; // Simpan nama file yang tidak valid
			continue; // Lewati file ini dan lanjut ke file berikutnya
		}

		// Jika valid, upload file
		$img_baru = uniqid() . '.' . $extensi_img;

		if (move_uploaded_file($tmp_name, '../dashboard/assets/kegiatan/' . $img_baru)) {
			$uploadedImages[] = $img_baru; // Simpan nama file yang berhasil diupload
		}
	}

	// Jika ada file yang tidak valid, tampilkan pesan
	if (!empty($invalidFiles)) {
		$invalidFilesList = implode(', ', $invalidFiles);
		echo "<script>
                alert('File berikut tidak valid: $invalidFilesList');
                location.replace('../dashboard/admin?page=detail kegiatan');
            </script>";
	}

	return $uploadedImages; // Kembalikan array dari nama file yang berhasil diupload
}

if (isset($_POST['upload_imgkegiatan'])) {
	$id_kegiatan 	= htmlspecialchars(trim($_POST['id_kegiatan']));

	$img_kegiatan 	= uploadImgKegiatan();

	// Pastikan ada gambar yang berhasil diupload sebelum menyimpan ke database
	if (!empty($img_kegiatan)) {
		// Loop untuk menyimpan setiap gambar ke database
		foreach ($img_kegiatan as $img) {
			$query_tambah = "INSERT INTO galeri_kegiatan(id_kegiatan, img_kegiatan) 
                             VALUES ('$id_kegiatan', '$img')";

			if (!mysqli_query($koneksi, $query_tambah)) {
				// Gagal
				header('Location: ../dashboard/admin?page=detail kegiatan&id=' . $id_kegiatan . '&action=uploadimgkegiatan&status=error');
				exit();
			}
		}

		// Berhasil
		header('Location: ../dashboard/admin?page=detail kegiatan&id=' . $id_kegiatan . '&action=uploadimgkegiatan&status=success');
		exit();
	} else {
		// Jika tidak ada gambar yang berhasil diupload
		header('Location: ../dashboard/admin?page=detail kegiatan&id=' . $id_kegiatan . '&action=uploadimgkegiatan&status=error');
		exit();
	}
}


if (isset($_POST['btn_tambahkegiatan'])) {
	$id_kegiatan 		= htmlspecialchars(trim($_POST['id_kegiatan']));

	// Sanitize input	
	$nama_kegiatan 		= htmlspecialchars(trim($_POST['nama_kegiatan']));
	$penyelenggara 		= htmlspecialchars(trim($_POST['penyelenggara']));
	$tanggal_kegiatan 	= htmlspecialchars(trim($_POST['tanggal_kegiatan']));
	$kota 				= htmlspecialchars(trim($_POST['kota']));
	$waktu_mulai 		= htmlspecialchars(trim($_POST['waktu_mulai']));
	$waktu_selesai 		= htmlspecialchars(trim($_POST['waktu_selesai']));
	$target_pendonor 	= htmlspecialchars(trim($_POST['target_pendonor']));
	$alamat 			= htmlspecialchars(trim($_POST['alamat']));

	// Proses tambah kegiatan ke database
	$query_tambah = "INSERT into kegiatan_donor SET nama_kegiatan = '$nama_kegiatan', 
											penyelenggara = '$penyelenggara',
											tanggal_kegiatan = '$tanggal_kegiatan',
											kota = '$kota',
											waktu_mulai = '$waktu_mulai',
											waktu_selesai = '$waktu_selesai',
											target_pendonor = '$target_pendonor',
											alamat = '$alamat'";
	// Jika validasi berhasil, hapus session form sebelumnya
	unset($_SESSION['form_kegiatan']);

	// Eksekusi query
	if (mysqli_query($koneksi, $query_tambah)) {
		header('Location: ../dashboard/admin?page=data kegiatan&action=tambahkegiatan&status=success');
	} else {
		// Ambil pesan kesalahan dari database
		$error = mysqli_error($koneksi);
		header('Location: ../dashboard/admin?page=tambah kegiatan&action=tambahkegiatan&status=error&message=' . urlencode($error));
	}
	exit();
}
if (isset($_POST['btn_editkegiatan'])) {
	$id_kegiatan 		= htmlspecialchars(trim($_POST['id_kegiatan']));

	// Sanitize input	
	$nama_kegiatan 		= htmlspecialchars(trim($_POST['nama_kegiatan']));
	$penyelenggara 		= htmlspecialchars(trim($_POST['penyelenggara']));
	$tanggal_kegiatan 	= htmlspecialchars(trim($_POST['tanggal_kegiatan']));
	$kota 				= htmlspecialchars(trim($_POST['kota']));
	$waktu_mulai 		= htmlspecialchars(trim($_POST['waktu_mulai']));
	$waktu_selesai 		= htmlspecialchars(trim($_POST['waktu_selesai']));
	$target_pendonor 	= htmlspecialchars(trim($_POST['target_pendonor']));
	$alamat 			= htmlspecialchars(trim($_POST['alamat']));

	// Proses tambah kegiatan ke database
	$query_edit = "UPDATE kegiatan_donor SET nama_kegiatan = '$nama_kegiatan', 
											penyelenggara = '$penyelenggara',
											tanggal_kegiatan = '$tanggal_kegiatan',
											kota = '$kota',
											waktu_mulai = '$waktu_mulai',
											waktu_selesai = '$waktu_selesai',
											target_pendonor = '$target_pendonor',
											alamat = '$alamat'
											WHERE id_kegiatan = '$id_kegiatan'";

	// Eksekusi query
	if (mysqli_query($koneksi, $query_edit)) {
		header('Location: ../dashboard/admin?page=detail kegiatan&id=' . $id_kegiatan . '&action=editkegiatan&status=success');
	} else {
		// Ambil pesan kesalahan dari database
		$error = mysqli_error($koneksi);
		header('Location: ../dashboard/admin?page=detail kegiatan&id=' . $id_kegiatan . '&&action=editkegiatan&status=error&message=' . urlencode($error));
	}
	exit();
}

if (isset($_POST['btn_deletekegiatan'])) {
	$id_kegiatan    = htmlspecialchars($_POST['id_kegiatan']);

	$query 			= "DELETE FROM kegiatan_donor WHERE id_kegiatan = '$id_kegiatan'";
	$query_hapus	= mysqli_query($koneksi, $query);

	// Eksekusi hapus
	if ($query_hapus) {
		header('Location: ../dashboard/admin?page=data kegiatan&action=deletekegiatan&status=success');
	} else {
		$error = mysqli_error($koneksi);
		header('Location: ../dashboard/admin?page=data kegiatan&action=deletekegiatan&status=error&message=' . urlencode($error));
	}
}

if (isset($_POST['btn_deleteimgkegiatan'])) {
	$id_kegiatan   	= htmlspecialchars($_POST['id_kegiatanhapus']);
	$id_galeri    	= htmlspecialchars($_POST['id_galerihapus']);
	$img_kegiatan 	= htmlspecialchars($_POST['img_kegiatanhapus']);

	$query 			= "DELETE FROM galeri_kegiatan WHERE id_galeri = '$id_galeri'";
	$query_hapus	= mysqli_query($koneksi, $query);

	// Eksekusi hapus
	if ($query_hapus) {
		unlink('../dashboard/assets/kegiatan/' . $img_kegiatan);
		header('Location: ../dashboard/admin?page=detail kegiatan&id=' . $id_kegiatan . '&action=deleteimgkegiatan&status=success');
	} else {
		$error = mysqli_error($koneksi);
		header('Location: ../dashboard/admin?page=detail kegiatan&id=' . $id_kegiatan . '&action=deleteimgkegiatan&status=error&message=' . urlencode($error));
	}
}


// Pastikan tidak ada output setelah ini
ob_end_flush();
