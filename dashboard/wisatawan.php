<?php
require_once '../functions/config.php';

session_start();
include '../functions/config.php';
include '../functions/data.php';
include '../functions/insight.php';

// Ambil data wisatawan
$sesi_id    = htmlspecialchars($_SESSION['sesi_id']);

$query          = "SELECT * FROM users WHERE id_user = '$sesi_id'";

if ($sql = mysqli_query($koneksi, $query)) {
    $users = mysqli_fetch_array($sql);
    // Ambil data pengguna
    $sesi_nama      = isset($users['nama_user']) ? $users['nama_user'] : '';
    $sesi_email      = isset($users['email']) ? $users['email'] : '';
    $sesi_username  = isset($users['username']) ? $users['username'] : '';
    $sesi_role      = isset($users['role']) ? $users['role'] : '';
    $sesi_img       = isset($users['img_user']) ? $users['img_user'] : '';
}



// Pastikan pengguna sudah login dan memiliki role admin
if (!isset($sesi_role) || $sesi_role !== 'wisatawan') {
    header('Location: ../auth/login');
    exit();
}

$page = $_GET['page'] ?? 'dashboard'; // Default ke 'dashboard' jika tidak ada page

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="robots" content="noindex, nofollow">

    <title><?= ucfirst($page); ?> - Dashboard <?php echo NAMA_WEB ?></title>

    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">

    <?php include 'pages/css.php'; ?>
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top ">
                    <div class="container">
                        <div class="logo">
                            <a href="index"><img src="../assets/logopmi.png" width="100" alt="Logo"></a>
                        </div>
                        <div class="logo pukul">
                            <div class="sidebar-hide align-items-left">
                                <b><label>Pukul : <?= $pukul; ?></label></b>
                            </div>
                        </div>
                        <div class="header-top-left">
                            <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                    role="img" class="iconify iconify--system-uicons" width="20" height="20"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                    <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                            opacity=".3"></path>
                                        <g transform="translate(-210 -1)">
                                            <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                            <circle cx="220.5" cy="11.5" r="4"></circle>
                                            <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                                        </g>
                                    </g>
                                </svg>
                                <div class="form-check form-switch fs-6">
                                    <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                                    <label class="form-check-label"></label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                    role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <div class="header-top-right">
                            <div class="dropdown">
                                <a href="#" id="topbarUser Dropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2">
                                        <img src="assets/<?= empty($sesi_img) ? 'static/images/faces/1.jpg' : 'profile/' . htmlspecialchars($sesi_img) ?>"
                                            alt="Foto Profil"
                                            onerror="this.src='assets/static/images/faces/2.jpg'">

                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name"><?= $sesi_nama; ?></h6>
                                        <p class="user-dropdown-status text-sm text-muted text-capitalize"><?= $sesi_role; ?></p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUser Dropdown">
                                    <li><a class="dropdown-item" href="?page=profile">Profile</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <!-- Button trigger for Logout Modal -->
                                        <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modal-logout" data-bs-backdrop="false">
                                            Logout
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container">
                        <ul>
                            <li class="menu-item">
                                <a href="../index" class='menu-link'>
                                    <span><i class="bi bi-house-door-fill"></i> Beranda</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="admin" class='menu-link'>
                                    <span><i class="bi bi-grid-fill"></i> Dashboard</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="?page=profile" class='menu-link'>
                                    <span><i class="select-all fas"></i> Profile</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="?page=informasi kegiatan" class='menu-link'>
                                    <span><i class="bi bi-map-fill"></i> Informasi Kegiatan</span>
                                </a>
                            </li>
                            <li class="menu-item  ">
                                <a href="?page=galeri kegiatan" class='menu-link'>
                                    <span><i class="bi bi-image-fill"></i> Galeri Donor</span>
                                </a>
                            </li>
                            <li class="menu-item has-sub">
                                <a href="#" class='menu-link'>
                                    <span class="fa-fw select-all fas"></span> Donor Darah
                                </a>
                                <div class="submenu">
                                    <div class="submenu-group-wrapper">
                                        <ul class="submenu-group">
                                            <li class="submenu-item">
                                                <a href="?page=mulai donor" class='submenu-link'>Daftar Donor</a>
                                            </li>
                                            <li class="submenu-item">
                                                <a href="?page=riwayat donor" class='submenu-link'>Riwayat Donor</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--Logout Modal -->
            <div class="modal fade text-left" id="modal-logout" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel1" data-bs-backdrop="false" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Yakin Ingin Logout ?</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                Keluar dari halaman dashboard.
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Batal</span>
                            </button>
                            <a href="../auth/logout" class="btn btn-danger ms-1">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-wrapper container">
                <?php
                // Menampilkan konten berdasarkan page
                switch ($page) {
                    case 'riwayat donor':
                        include 'pages/riwayat_donor_wisatawan.php';
                        break;
                    case 'daftar donor':
                        include 'pages/daftar_donor.php';
                        break;
                    case 'profile':
                        include 'pages/profile_wisatawan.php';
                        break;
                    case 'informasi kegiatan':
                        include 'pages/informasi_kegiatan_wisatawan.php';
                        break;
                    case 'mulai donor':
                        include 'pages/mulai_donor_wisatawan.php';
                        break;
                    case 'galeri kegiatan':
                        include 'pages/galeri_kegiatan.php';
                        break;
                    default:
                        include 'pages/dashboard_wisatawan.php';
                        break;
                }
                ?>

            </div>
            <footer>
                <div class="container">
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> &copy; Donorku
                            </p>
                        </div>
                        <div class="float-end">
                            <p>Dibuat dengan <span class="text-danger"><i class="bi bi-heart"></i></span>
                                oleh <a href="https://www.instagram.com/fauziahzhraaa__/" target="_blank">Fauziah Zahra</a></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- JS -->
    <?php include 'pages/js.php'; ?>
    <!-- JS -->

</body>

</html>