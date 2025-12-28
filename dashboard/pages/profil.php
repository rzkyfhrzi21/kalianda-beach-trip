<?php
// Memeriksa level user (halaman ini khusus admin)
if (!isset($_SESSION['sesi_role']) || $_SESSION['sesi_role'] !== 'admin') {
    return;
}

$id_profil = $_SESSION['sesi_id'] ?? null;

// Ambil id target (admin bisa lihat user lain lewat ?id= )
$id_user = !empty($_GET['id']) ? $_GET['id'] : $id_profil;
if (empty($id_user)) return;

// Ambil data user berdasarkan id
$query = "SELECT id_user, nama_lengkap, username, email, no_hp, password, foto_profil, jenis_kelamin, role, dibuat_pada, diubah_pada
          FROM users
          WHERE id_user = '$id_user'";

$sql = mysqli_query($koneksi, $query);
if (!$sql) return;

$users = mysqli_fetch_assoc($sql);
if (!$users) return;

// Mapping sesuai rancangan tabel users final
$id_user        = $users['id_user'] ?? '';
$nama_lengkap   = $users['nama_lengkap'] ?? '';
$username       = $users['username'] ?? '';
$email          = $users['email'] ?? '';
$no_hp          = $users['no_hp'] ?? '';
$foto_profil    = $users['foto_profil'] ?? '';
$jenis_kelamin  = $users['jenis_kelamin'] ?? '';
$role           = $users['role'] ?? '';
?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Profile</h3>
                <p class="text-subtitle text-muted">
                    Hi, Perbarui data anda dengan hati-hati.
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                        <li class="breadcrumb-item active text-capitalize" aria-current="page">
                            <?= $page; ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- KIRI: PROFIL + FOTO -->
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div class="avatar avatar-xl">
                            <img src="assets/<?= empty($foto_profil) ? 'static/images/faces/1.jpg' : 'img/foto_profil/' . htmlspecialchars($foto_profil) ?>"
                                alt="Foto Profil"
                                onerror="this.src='assets/static/images/faces/1.jpg'">
                        </div>
                        <h3 class="mt-3"><?= htmlspecialchars($nama_lengkap); ?></h3>
                        <p class="text-small text-capitalize text-bold"><?= htmlspecialchars($role); ?></p>
                    </div>
                </div>
            </div>

            <!-- Update Foto Profil -->
            <div class="card">
                <div class="card-body">
                    <form action="../functions/function_admin.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="formFileFoto" class="form-label">Foto Profil</label>
                            <p><small class="text-bold"><code>*Abaikan jika tidak ingin mengganti foto profil</code></small></p>
                            <input type="file" name="foto_profil" class="image-crop-filepond"
                                image-crop-aspect-ratio="1:1" id="formFileFoto" data-max-file-size="1MB" data-max-files="1">
                        </div>
                        <input type="hidden" name="id_user" value="<?= htmlspecialchars($id_user); ?>">
                        <input type="hidden" name="foto_profil_lama" value="<?= htmlspecialchars($foto_profil); ?>">
                        <div class="form-group">
                            <button type="submit" id="btn-update-foto" name="btn_editfotoakun" class="btn btn-primary">Update Foto</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Hapus Akun -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Hapus Akun</h5>
                </div>
                <div class="card-body">
                    <form action="../functions/function_admin.php" method="post">
                        <p>Akun akan dihapus permanen, centang "Proses" untuk melanjutkan.</p>
                        <div class="form-check">
                            <div class="checkbox">
                                <input type="checkbox" id="iaggree" class="form-check-input">
                                <label for="iaggree">Proses! Saya setuju hapus permanen</label>
                            </div>
                        </div>

                        <input type="hidden" name="id_user" value="<?= htmlspecialchars($id_user); ?>">
                        <input type="hidden" name="foto_profil" value="<?= htmlspecialchars($foto_profil); ?>">

                        <div class="form-group my-2 d-flex justify-content-end">
                            <button type="submit" name="btn_deleteakun" class="btn btn-danger" id="btn-delete-account" disabled>Hapus Akun</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- KANAN: DATA PRIBADI (versi ringkas sesuai tabel users) -->
        <div class="col-12 col-lg-8">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Informasi Pribadi</h5>
                </div>
                <div class="card-body">
                    <form action="../functions/function_admin.php" method="post" data-parsley-validate>

                        <div class="row form-group mandatory has-icon-left">
                            <div class="col-md-6 col-12">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <div class="position-relative">
                                    <input type="text" id="nama_lengkap" class="form-control"
                                        name="nama_lengkap" placeholder="Nama Lengkap"
                                        minlength="3" value="<?= htmlspecialchars($nama_lengkap); ?>"
                                        data-parsley-required="true" />
                                    <div class="form-control-icon"><i class="bi bi-person"></i></div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-2">
                                <label class="form-label">ID User</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" disabled
                                        value="<?= htmlspecialchars($id_user); ?>" />
                                    <div class="form-control-icon"><i class="bi bi-person-badge"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group mandatory has-icon-left">
                            <div class="col-md-6 col-12">
                                <label for="no_hp" class="form-label">No HP</label>
                                <div class="position-relative">
                                    <input type="tel" id="no_hp" class="form-control"
                                        name="no_hp" placeholder="08***"
                                        pattern="^\d{10,15}$"
                                        data-parsley-required="true"
                                        data-parsley-pattern="^\d{10,15}$"
                                        value="<?= htmlspecialchars($no_hp); ?>" />
                                    <div class="form-control-icon"><i class="bi bi-phone"></i></div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-2">
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="form-group">
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="" disabled <?= empty($jenis_kelamin) ? 'selected' : ''; ?>>Pilih</option>
                                        <option value="Laki-laki" <?= $jenis_kelamin === 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                                        <option value="Perempuan" <?= $jenis_kelamin === 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group mandatory has-icon-left">
                            <div class="col-md-6 col-12">
                                <label for="email" class="form-label">Email</label>
                                <div class="position-relative">
                                    <input type="email" id="email" class="form-control"
                                        name="email" placeholder="Email"
                                        value="<?= htmlspecialchars($email); ?>"
                                        data-parsley-required="true" />
                                    <div class="form-control-icon"><i class="bi bi-envelope"></i></div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="id_user" value="<?= htmlspecialchars($id_user); ?>">
                        <div class="form-group">
                            <button type="submit" name="btn_editdatapribadi" class="btn btn-primary">Simpan Data Pribadi</button>
                            <a href="../dashboard/" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- INFORMASI AKUN -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Informasi Akun</h5>
                </div>
                <div class="card-body">
                    <form action="../functions/function_admin.php" method="post" data-parsley-validate>

                        <div class="form-group mandatory">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control"
                                placeholder="Username" minlength="5"
                                value="<?= htmlspecialchars($username); ?>"
                                data-parsley-required="true" />
                        </div>

                        <div class="form-group mandatory">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" required class="form-select">
                                <option value="wisatawan" <?= $role === 'wisatawan' ? 'selected' : ''; ?>>Wisatawan</option>
                                <option value="admin" <?= $role === 'admin' ? 'selected' : ''; ?>>Admin</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Password Baru</label>
                            <p><small class="text-bold"><code>*Abaikan jika tidak ingin mengganti password</code></small></p>
                            <input type="password" id="password" class="form-control" name="password" minlength="5" placeholder="Password Baru" />
                        </div>

                        <div class="form-group">
                            <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                            <input type="password" id="konfirmasi_password" class="form-control" name="konfirmasi_password" minlength="5" placeholder="Konfirmasi Password" />
                        </div>

                        <input type="hidden" name="id_user" value="<?= htmlspecialchars($id_user); ?>">
                        <input type="hidden" name="username_lama" value="<?= htmlspecialchars($username); ?>">
                        <input type="hidden" name="sesi_username" value="<?= htmlspecialchars($sesi_username ?? ''); ?>">

                        <div class="form-group">
                            <button type="submit" name="btn_editdataakun" class="btn btn-primary">Simpan Data Akun</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>