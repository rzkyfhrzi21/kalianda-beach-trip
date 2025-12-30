<?php
require_once '../functions/config.php';

session_start();
if (@$_SESSION['sesi_role']) {
    switch ($_SESSION['sesi_role']) {
        case 'admin':
            header('Location: ../dashboard/admin');
            break;
        case 'wisatawan':
            header(header: 'Location: ../dashboard/wisatawan');
            break;
        default:
            header(header: 'Location: ../logout.php');
            break;
    }
}

$usernameLogin = isset($_GET['username']) ? $_GET['username'] : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="robots" content="noindex, nofollow">
    <link rel="shortcut icon" href="../assets/pmi-bg.jpg" type="image/x-icon">

    <title>Login - <?php echo NAMA_WEB ?></title>

    <link rel="shortcut icon" href="../dashboard/assets/pmi.png" type="image/x-icon">
    <link rel="stylesheet" href="../dashboard/assets/compiled/css/app.css">
    <link rel="stylesheet" href="../dashboard/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../dashboard/assets/compiled/css/auth.css">
    <link rel="stylesheet" href="../dashboard/assets/extensions/sweetalert2/sweetalert2.min.css">
    <style>
        :root {
            --primary2: #0b3b4a;
            /* navy teal */
            --bg1: #f6fbfb;
            --bg2: #edf6f6;
            --text: #0f172a;
            --muted: #64748b;
            --border: #e2e8f0;
        }

        body {
            background: linear-gradient(135deg, var(--bg1), var(--bg2));
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: var(--text);
        }

        #auth {
            background: rgba(255, 255, 255, .97);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
            padding: 2rem;
            max-width: 420px;
            width: 100%;
        }

        .auth-title {
            color: var(--primary2) !important;
            font-weight: 800;
            letter-spacing: .2px;
        }

        .auth-subtitle {
            color: var(--muted) !important;
        }

        .form-label,
        label {
            font-size: 14px;
            color: var(--text);
        }

        .form-control {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: .9rem 1rem;
            transition: .15s ease;
        }

        .form-control:focus {
            border-color: rgba(14, 165, 164, .55);
            box-shadow: 0 0 0 .25rem rgba(14, 165, 164, .18);
        }

        /* Tombol utama (kamu pakai class btn-danger) */
        .btn-danger,
        .btn-primary {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
            border-radius: 12px;
            font-weight: 700;
            padding: .85rem 1rem;
            box-shadow: 0 10px 18px rgba(14, 165, 164, .22);
        }

        .btn-danger:hover,
        .btn-primary:hover {
            background-color: #0b8c8b !important;
            border-color: #0b8c8b !important;
            transform: translateY(-1px);
        }

        .text-danger {
            color: var(--primary2) !important;
            /* ganti "merah" jadi navy */
        }

        a {
            color: var(--primary2);
            text-decoration: none;
            font-weight: 700;
        }

        a:hover {
            text-decoration: underline;
        }

        p {
            font-size: 15px;
            color: var(--muted);
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
                            <p class="auth-subtitle"><i class="bi bi-arrow-left"></i> <b>Beranda</b></p>
                        </a>
                        <h2 class="auth-title text-danger">Log In Akun</h2>
                        <p class="auth-subtitle mb-2"> Silakan masuk untuk melanjutkan</p>
                    </div>
                    <div class="card-body">
                        <form class="form" data-parsley-validate action="../functions/function_auth.php" method="post" autocomplete="off">
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
                            <input type="hidden" name="role" value="wisatawan">

                            <button name="btn_login" type="submit" class="btn btn-danger btn-block btn-lg shadow-lg mt-2">Log In</button>
                        </form>
                        <div class="text-center mt-3 text-lg fs-4">
                            <p class="text-gray-600">Tidak mempunyai akun? <a href="register" class="font-bold text-danger">Daftar</a>.</p>
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