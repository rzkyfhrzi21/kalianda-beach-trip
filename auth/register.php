<?php
session_start();

$usernameLogin  =  isset($_GET['username']) ? $_GET['username'] : '';
$nama_userLogin =  isset($_GET['nama_user']) ? $_GET['nama_user'] : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="robots" content="noindex, nofollow">

    <title>Registrasi - Donorku</title>
    <link rel="shortcut icon" href="../assets/pmi-bg.jpg" type="image/x-icon">


    <link rel="shortcut icon" href="../dashboard/assets/pmi.png" type="image/x-icon">
    <link rel="stylesheet" href="../dashboard/assets/compiled/css/app.css">
    <link rel="stylesheet" href="../dashboard/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../dashboard/assets/compiled/css/auth.css">
    <link rel="stylesheet" href="../dashboard/assets/extensions/sweetalert2/sweetalert2.min.css">

    <style>
        body {
            /* background-image: url('../dashboard/assets/pmi-bg.jpg'); */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
            margin: 0;
        }

        #auth {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 400px;
            width: 100%;
        }

        p {
            font-size: 16px;
        }

        label {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <script src="../dashboard/assets/static/js/initTheme.js"></script>

    <div id="app">
        <div class="content-wrapper container">
            <div class="row h-100">
                <div class="card mt-5">
                    <div class="card-header">
                        <a href="../index" class="text-decoration-none">
                            <p class="auth-subtitle text-s"><i class="bi bi-arrow-left"></i> <b>Beranda</b></p>
                        </a>
                        <h2 class="auth-title text-danger">Registrasi</h2>
                        <p class="auth-subtitle mb-2">Hi, Ayo bergabung menjadi #PahlawanDarah</p>
                    </div>
                    <div class="card-body">
                        <form class="form" data-parsley-validate action="../functions/cek_login.php" method="post" autocomplete="off">
                            <div class="form-group position-relative has-icon-left mb-3 has-icon-left">
                                <label for="Nama Lengkap" class="form-label">Nama Lengkap</label>
                                <div class="position-relative">
                                    <input type="text" name="nama_user" class="form-control form-control-xl"
                                        placeholder="Nama lengkap anda" value="<?= $nama_userLogin; ?>" id="Nama Lengkap" data-parsley-required="true" minlength="5">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-3 has-icon-left">
                                <label for="username" class="form-label">Username</label>
                                <div class="position-relative">
                                    <input type="text" name="username" class="form-control form-control-xl"
                                        placeholder="Username baru" value="<?= $usernameLogin; ?>" id="username" data-parsley-required="true" minlength="5">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-3 has-icon-left">
                                <label for="password" class="form-label">Password <label class="text-danger">*</label></label>
                                <div class="position-relative">
                                    <input type="password" name="password" class="form-control form-control-xl" placeholder="*****" id="password" data-parsley-required="true" minlength="5">
                                    <div class="form-control-icon">
                                        <i class="bi bi-shield-lock"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-3 has-icon-left">
                                <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                                <div class="position-relative">
                                    <input type="password" name="konfirmasi_password" class="form-control form-control-xl"
                                        placeholder="Konfirmasi password baru" id="konfirmasi_password" data-parsley-required="true" minlength="5">
                                    <div class="form-control-icon">
                                        <i class="bi bi-shield-lock"></i>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="role" value="pendonor">
                            <button type="submit" name="btn_register" class="btn btn-danger btn-block btn-lg shadow-lg mt-2">Registrasi</button>
                        </form>
                        <div class="text-center mt-3 text-lg fs-4">
                            <p class='text-gray-600'>Sudah mempunyai akun? <a href="login" class="font-bold text-danger">Masuk</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../dashboard/assets/extensions/jquery/jquery.min.js"></script>
    <script src="../dashboard/assets/extensions/parsleyjs/parsley.min.js"></script>
    <script src="../dashboard/assets/static/js/pages/parsley.js"></script>
    <script src="../dashboard/assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get("status");
        const action = urlParams.get("action");

        if (status === "success") {
            if (action === "registered") {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: "Akun berhasil terdaftar. Silakan login 😁",
                    timer: 3000,
                    showConfirmButton: false,
                });
            } else if (action === "deleteuser") {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: "Akun anda telah berhasil dihapus 😁",
                    timer: 3000,
                    showConfirmButton: false,
                });
            }
        } else if (status === "error") {
            if (action === "login") {
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "Username atau password salah 🤬",
                    timer: 3000,
                    showConfirmButton: false,
                });
            }
        }
    </script>
</body>

</html>