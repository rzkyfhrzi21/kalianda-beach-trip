<?php

session_start();

include 'config.php';

if (isset($_POST['btn_login'])) {
	$username 	= htmlspecialchars($_POST['username']);
	$password 	= htmlspecialchars($_POST['password']);

	$sql_login 		= mysqli_query($koneksi, "SELECT * from users where username = '$username' and password = '$password'");
	$jumlah_user 	= mysqli_num_rows($sql_login);
	$data_user		= mysqli_fetch_array($sql_login);

	if ($jumlah_user > 0) {
		$_SESSION['sesi_id']		= $data_user['id_user'];
		$_SESSION['sesi_role']		= $data_user['role'];
		$_SESSION['sesi_username']	= $data_user['username'];
		$_SESSION['sesi_nama']		= $data_user['nama_lengkap'];

		if ($data_user['img_user'] == '') {
			if ($data_user['role'] == 'admin') {
				header('Location: ../dashboard/admin?page=profil&id=' . $data_user['id_user']);
			} else if ($data_user['role'] == 'wisatawan') {
				header('Location: ../dashboard/wisatawan?page=profil&id=' . $data_user['id_user']);
			}
		} else {
			if ($data_user['role'] == 'admin') {
				header('Location: ../dashboard/admin');
			} else if ($data_user['role'] == 'wisatawan') {
				header('Location: ../dashboard/wisatawan');
			}
		}
	} else {
		header("Location: ../auth/login?action=login&status=error");
	}
}

if (isset($_POST['btn_register'])) {
	$nama_lengkap          	= htmlspecialchars($_POST['nama_lengkap']);
	$username          		= htmlspecialchars($_POST['username']);
	$password               = htmlspecialchars($_POST['password']);
	$konfirmasi_password    = htmlspecialchars($_POST['konfirmasi_password']);
	$role 					= 'wisatawan';

	$sql_login          	= mysqli_query($koneksi, "SELECT * from users where username = '$username'");
	$jumlah_users       	= mysqli_num_rows($sql_login);
	$data_users         	= mysqli_fetch_array($sql_login);

	if ($password !== $konfirmasi_password) {
		header("Location: ../auth/register?action=passwordnotsame&status=warning&username=" . $username . '&nama_lengkap=' . $nama_lengkap);
	} else {
		if ($jumlah_users > 0) {
			header("Location: ../auth/register?action=userexist&status=warning&nama_lengkap=" . $nama_lengkap);
		} else {

			$query_daftar    = "INSERT into users 
                                    set username    = '$username',
                                        nama_lengkap   = '$nama_lengkap', 
                                        role       	= '$role', 
                                        password    = '$password'";
			$daftar         = mysqli_query($koneksi, $query_daftar);

			if ($daftar) {
				header("Location: ../auth/login?action=registered&status=success");
			} else {
				header("Location: ../auth/register");
			}
		}
	}
}
