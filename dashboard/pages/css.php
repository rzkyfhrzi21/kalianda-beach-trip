<link rel="stylesheet" href="assets/compiled/css/app.css">
<link rel="stylesheet" href="assets/compiled/css/app-dark.css">
<link rel="stylesheet" href="assets/compiled/css/iconly.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="assets/extensions/@fortawesome/fontawesome-free/css/all.min.css">
<!-- Sweetalert -->
<link rel="stylesheet" href="assets/extensions/sweetalert2/sweetalert2.min.css">
<!-- Choices -->
<link rel="stylesheet" href="assets/extensions/choices.js/public/assets/styles/choices.css">
<!-- DataTables -->
<link rel="stylesheet" href="assets/extensions/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/extensions/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="assets/extensions/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Image Upload -->
<link rel="stylesheet" href="assets/extensions/filepond/filepond.css">
<link rel="stylesheet" href="assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
<link rel="stylesheet" href="assets/extensions/toastify-js/src/toastify.css">
<!-- Datetime Picker -->
<link rel="stylesheet" href="assets/extensions/flatpickr/flatpickr.min.css">
<style>
    /* =========================================================
   KALIANDA ADMIN THEME (PRIMARY2)
   Tempel SETELAH app.css / app-dark.css
========================================================= */

    /* 1) Pilih 1–2 warna utama (ubah sesuai selera) */
    :root {
        --primary: #0b3b4a;
        /* warna utama */
        --bg1: #f6fbfb;
        --bg2: #edf6f6;
        --text: #0f172a;
        --muted: #64748b;
        --border: #e2e8f0;
    }


    /* 2) Paksa semua komponen "primary" mengikuti primary */
    /* ===== BASE ===== */
    body {
        background: linear-gradient(135deg, var(--bg1), var(--bg2));
        color: var(--text);
        font-family: "Inter", system-ui, sans-serif;
    }

    /* ===== CARD / WRAPPER ===== */
    .card {
        border-radius: 14px;
        border: 1px solid var(--border);
        box-shadow: 0 6px 20px rgba(11, 59, 74, 0.08);
    }

    .card-header {
        background: transparent;
        border-bottom: 1px solid var(--border);
        font-weight: 600;
        color: var(--primary);
    }

    /* ===== TEXT ===== */
    .text-muted {
        color: var(--muted) !important;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color: var(--primary);
    }

    /* ===== BUTTONS ===== */
    .btn-primary {
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
        color: #fff !important;
    }

    .btn-primary:hover {
        background-color: #092f3b !important;
        border-color: #092f3b !important;
    }

    .btn-outline-primary {
        color: var(--primary);
        border-color: var(--primary);
    }

    .btn-outline-primary:hover {
        background-color: var(--primary);
        color: #fff;
    }

    /* danger tetap netral */
    .btn-danger {
        background-color: #dc2626;
        border-color: #dc2626;
    }

    /* ===== INPUT / FORM ===== */
    .form-control,
    .form-select {
        border-radius: 10px;
        border: 1px solid var(--border);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.15rem rgba(11, 59, 74, 0.2);
    }

    /* ===== NAVBAR & MENU ===== */
    .main-navbar {
        background: #ffffff;
        border-bottom: 1px solid var(--border);
    }

    .menu-link {
        color: var(--text);
    }

    .menu-link:hover,
    .menu-item.active>.menu-link {
        color: var(--primary);
    }

    /* submenu */
    .submenu {
        background: #ffffff;
        border: 1px solid var(--border);
    }

    /* ===== HEADER ===== */
    .header-top {
        background: #ffffff;
        border-bottom: 1px solid var(--border);
    }

    /* ===== BADGE ===== */
    .badge {
        border-radius: 999px;
        padding: 6px 10px;
    }

    .badge.bg-primary {
        background-color: var(--primary) !important;
    }

    /* ===== TABLE ===== */
    .table {
        color: var(--text);
    }

    .table thead th {
        background: var(--bg2);
        border-bottom: 1px solid var(--border);
        font-weight: 600;
    }

    .table-hover tbody tr:hover {
        background-color: #eef7f7;
    }

    /* ===== FOOTER ===== */
    footer {
        background: #ffffff;
        border-top: 1px solid var(--border);
    }

    footer a {
        color: var(--primary);
        text-decoration: none;
    }

    footer a:hover {
        text-decoration: underline;
    }

    /* ===== AUTH / LOGIN CARD ===== */
    #auth {
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(11, 59, 74, 0.12);
    }

    .auth-title {
        color: var(--primary);
        font-weight: 700;
    }

    .auth-subtitle {
        color: var(--muted);
    }

    /* ===== ICON COLOR ===== */
    .text-primary {
        color: var(--primary) !important;
    }

    /* ===== LINK ===== */
    a {
        color: var(--primary);
    }

    a:hover {
        color: #092f3b;
    }

    /* ===== SMALL IMPROVEMENTS ===== */
    .dropdown-menu {
        border-radius: 12px;
        border: 1px solid var(--border);
    }

    .avatar img {
        border: 2px solid var(--primary);
    }

    /* MOBILE */
    @media (max-width: 768px) {
        .pukul {
            display: none;
        }
    }
</style>