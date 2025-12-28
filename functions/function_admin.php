<?php
require_once 'config.php';
session_start();
ob_start();

$sesi_role = $_SESSION['sesi_role'] ?? null;
$sesi_id   = $_SESSION['sesi_id'] ?? null;

/* ======================================================
   FUNGSI UPLOAD FOTO PROFIL
====================================================== */
function uploadFotoProfil()
{
	if (!isset($_FILES['foto_profil']) || $_FILES['foto_profil']['error'] !== 0) {
		return null;
	}

	$allowed = ['jpg', 'jpeg', 'png', 'webp'];
	$ext = strtolower(pathinfo($_FILES['foto_profil']['name'], PATHINFO_EXTENSION));

	if (!in_array($ext, $allowed)) {
		return false;
	}

	if ($_FILES['foto_profil']['size'] > 1024 * 1024) {
		return false;
	}

	$filename = uniqid('user_') . '.' . $ext;
	$path = '../dashboard/assets/img/foto_profil/' . $filename;

	move_uploaded_file($_FILES['foto_profil']['tmp_name'], $path);

	return $filename;
}

/* ======================================================
   UPDATE FOTO PROFIL
====================================================== */
if (isset($_POST['btn_editfotoakun'])) {

	$id_user   = $_POST['id_user'];
	$foto_lama = $_POST['foto_profil_lama'];

	$foto_baru = uploadFotoProfil();

	if ($foto_baru === false) {
		header("Location: ../dashboard/admin?page=profil&status=invalid_image");
		exit;
	}

	if ($foto_baru !== null) {
		if (!empty($foto_lama)) {
			@unlink('../dashboard/assets/img/foto_profil/' . $foto_lama);
		}

		mysqli_query($koneksi, "
            UPDATE users 
            SET foto_profil = '$foto_baru', diubah_pada = NOW()
            WHERE id_user = '$id_user'
        ");
	}

	header("Location: ../dashboard/{$sesi_role}?page=profil&status=success");
	exit;
}

/* ======================================================
   UPDATE DATA PROFIL (DATA UMUM)
====================================================== */
if (isset($_POST['btn_editdatapribadi'])) {

	$id_user       = $_POST['id_user'];
	$nama_lengkap  = trim($_POST['nama_lengkap']);
	$email         = trim($_POST['email']);
	$no_hp         = trim($_POST['no_hp']);
	$jenis_kelamin = trim($_POST['jenis_kelamin']);

	mysqli_query($koneksi, "
        UPDATE users SET
            nama_lengkap = '$nama_lengkap',
            email = '$email',
            no_hp = '$no_hp',
            jenis_kelamin = '$jenis_kelamin',
            diubah_pada = NOW()
        WHERE id_user = '$id_user'
    ");

	header("Location: ../dashboard/{$sesi_role}?page=profil&status=success");
	exit;
}

/* ======================================================
   UPDATE DATA AKUN (USERNAME / PASSWORD / ROLE)
====================================================== */
if (isset($_POST['btn_editdataakun'])) {

	$id_user   = $_POST['id_user'];
	$username  = trim($_POST['username']);
	$role      = trim($_POST['role']);
	$password  = trim($_POST['password']);
	$confirm   = trim($_POST['konfirmasi_password']);

	// Cek username duplikat
	$cek = mysqli_query($koneksi, "SELECT id_user FROM users WHERE username='$username' AND id_user != '$id_user'");
	if (mysqli_num_rows($cek) > 0) {
		header("Location: ../dashboard/admin?page=profil&status=username_exist");
		exit;
	}

	if (!empty($password)) {
		if ($password !== $confirm) {
			header("Location: ../dashboard/admin?page=profil&status=password_mismatch");
			exit;
		}

		$query = "
            UPDATE users SET 
                username = '$username',
                password = '$password',
                role = '$role',
                diubah_pada = NOW()
            WHERE id_user = '$id_user'
        ";
	} else {
		$query = "
            UPDATE users SET 
                username = '$username',
                role = '$role',
                diubah_pada = NOW()
            WHERE id_user = '$id_user'
        ";
	}

	mysqli_query($koneksi, $query);

	header("Location: ../dashboard/{$sesi_role}?page=profil&status=success");
	exit;
}

/* ======================================================
   HAPUS AKUN
====================================================== */
if (isset($_POST['btn_deleteakun'])) {

	$id_user  = $_POST['id_user'];
	$foto     = $_POST['foto_profil'];

	mysqli_query($koneksi, "DELETE FROM users WHERE id_user='$id_user'");

	if (!empty($foto)) {
		@unlink('../dashboard/assets/img/foto_profil/' . $foto);
	}

	if ($id_user === $sesi_id) {
		header("Location: ../auth/logout.php");
	} else {
		header("Location: ../dashboard/admin?page=data-wisatawan&status=deleted");
	}
	exit;
}

if (isset($_POST['btn_adminregister'])) {

	// Ambil input sesuai tabel users (VERSI WISATA)
	$id_user        = mysqli_real_escape_string($koneksi, trim($_POST['id_user'] ?? '')); // jika form mengirim id_user
	$nama_lengkap   = mysqli_real_escape_string($koneksi, trim($_POST['nama_lengkap'] ?? ''));
	$username       = mysqli_real_escape_string($koneksi, trim($_POST['username'] ?? ''));
	$email          = mysqli_real_escape_string($koneksi, trim($_POST['email'] ?? ''));
	$no_hp          = mysqli_real_escape_string($koneksi, trim($_POST['no_hp'] ?? ''));
	$jenis_kelamin  = mysqli_real_escape_string($koneksi, trim($_POST['jenis_kelamin'] ?? ''));
	$role           = mysqli_real_escape_string($koneksi, trim($_POST['role'] ?? 'wisatawan'));

	$password       = trim($_POST['password'] ?? '');
	$konfirmasi     = trim($_POST['konfirmasi_password'] ?? '');

	// =========================
	// VALIDASI WAJIB
	// =========================
	if ($nama_lengkap === '' || $username === '' || $no_hp === '' || $jenis_kelamin === '' || $role === '' || $password === '' || $konfirmasi === '') {
		header("Location: ../dashboard/admin?page=registrasi&action=emptyfield&status=warning");
		exit();
	}

	if ($password !== $konfirmasi) {
		header("Location: ../dashboard/admin?page=registrasi&action=passwordnotsame&status=warning");
		exit();
	}

	// =========================
	// VALIDASI UNIK: username
	// =========================
	$cek_username = mysqli_query($koneksi, "SELECT id_user FROM users WHERE username = '$username' LIMIT 1");
	if ($cek_username && mysqli_num_rows($cek_username) > 0) {
		header("Location: ../dashboard/admin?page=registrasi&action=userexist&status=warning");
		exit();
	}

	// =========================
	// VALIDASI UNIK: email (opsional)
	// Kalau email boleh kosong, tetap aman.
	// =========================
	if ($email !== '') {
		$cek_email = mysqli_query($koneksi, "SELECT id_user FROM users WHERE email = '$email' LIMIT 1");
		if ($cek_email && mysqli_num_rows($cek_email) > 0) {
			header("Location: ../dashboard/admin?page=registrasi&action=emailexist&status=warning");
			exit();
		}
	}

	// =========================
	// UPLOAD FOTO PROFIL (pakai fungsi uploadImg() existing)
	// Jika form kamu mewajibkan upload, maka uploadImg() dipanggil.
	// Jika upload opsional, aman juga.
	// =========================
	$foto_profil = '';
	if (isset($_FILES['img_user']) && $_FILES['img_user']['error'] != 4) {
		$foto_profil = uploadImg(); // output: nama file baru
	}

	// =========================
	// INSERT SESUAI TABEL USERS
	// (tanpa hash, tanpa generate id)
	// =========================
	$query_tambah = "INSERT INTO users (
            id_user,
            nama_lengkap,
            username,
            email,
            no_hp,
            password,
            foto_profil,
            jenis_kelamin,
            role,
            dibuat_pada
        ) VALUES (
            '$id_user',
            '$nama_lengkap',
            '$username',
            '$email',
            '$no_hp',
            '$password',
            '$foto_profil',
            '$jenis_kelamin',
            '$role',
            NOW()
        )";

	$insert = mysqli_query($koneksi, $query_tambah);

	if ($insert) {
		header('Location: ../dashboard/admin?page=registrasi&action=adduser&status=success');
		exit();
	} else {
		$error = mysqli_error($koneksi);
		header('Location: ../dashboard/admin?page=registrasi&action=adduser&status=error&message=' . urlencode($error));
		exit();
	}
}

ob_end_flush();
