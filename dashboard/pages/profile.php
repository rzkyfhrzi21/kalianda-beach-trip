<?php
// Memeriksa level user
if ($_SESSION['sesi_role'] !== 'admin') {
    return;
}

$id_profile = $_SESSION['sesi_id'];

include '../functions/koneksi.php';

if (!empty($_GET['id'])) {
    $id_user = $_GET['id'];
} else {
    $id_user = $id_profile;
}

// Ambil data user berdasarkan id
$query = "SELECT * FROM users WHERE id_user = '$id_user'";

if ($sql = mysqli_query($koneksi, $query)) {

    $users = mysqli_fetch_array($sql);

    // Ambil data pengguna
    $nama_user      = isset($users['nama_user']) ? $users['nama_user'] : '';
    $id_user        = isset($users['id_user']) ? $users['id_user'] : '';
    $img_user       = isset($users['img_user']) ? $users['img_user'] : '';
    $no_telp        = isset($users['no_telp']) ? $users['no_telp'] : '';
    $email        = isset($users['email']) ? $users['email'] : '';
    $gol_darah      = isset($users['gol_darah']) ? $users['gol_darah'] : '';
    $jenis_kelamin  = isset($users['jenis_kelamin']) ? $users['jenis_kelamin'] : '';
    $tempat_lahir   = isset($users['tempat_lahir']) ? $users['tempat_lahir'] : '';
    $tanggal_lahir  = isset($users['tanggal_lahir']) ? $users['tanggal_lahir'] : '';
    $alamat         = isset($users['alamat']) ? $users['alamat'] : '';
    $username       = isset($users['username']) ? $users['username'] : '';
    $role           = isset($users['role']) ? $users['role'] : '';
    $foto_identitas = isset($users['foto_identitas']) ? $users['foto_identitas'] : '';

    if ($id_user == '') {
        return;
    }
}

?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Profile</h3>
                <p class="text-subtitle text-muted">
                    Hi, Perbarui data anda dengan hati-hati #PahlawanDarah
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
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div class="avatar avatar-xl">
                            <img src="assets/<?= empty($img_user) ? 'static/images/faces/1.jpg' : 'profile/' . htmlspecialchars($img_user) ?>"
                                alt="Foto Profil"
                                onerror="this.src='assets/static/images/faces/1.jpg'">
                        </div>
                        <h3 class="mt-3"><?= htmlspecialchars($nama_user); ?></h3>
                        <p class="text-small text-capitalize text-bold"><?= htmlspecialchars($role); ?></p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="../functions/function_admin.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="formFileFoto" class="form-label">Foto Profil</label>
                            <p><small class="text-bold"><code>*Abaikan jika tidak ingin mengganti foto profil</code></small></p>
                            <input type="file" name="img_user" class="image-crop-filepond"
                                image-crop-aspect-ratio="1:1" id="formFileFoto" data-max-file-size="1MB" data-max-files="1">
                        </div>
                        <input type="hidden" name="id_user" value="<?= htmlspecialchars($id_user); ?>">
                        <input type="hidden" name="img_lama" value="<?= htmlspecialchars($img_user); ?>">
                        <div class="form-group">
                            <button type="submit" id="btn-update-foto" name="btn_editfotoakun" class="btn btn-primary">Update Foto</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Hapus Akun Section -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Hapus Akun</h5>
                </div>
                <div class="card-body">
                    <form action="../functions/function_admin.php" method="post" enctype="multipart/form-data">
                        <p>Akun anda akan dihapus secara permanen dan tidak dapat dikembalikan, centang "Proses" untuk melanjutkan</p>
                        <div class="form-check">
                            <div class="checkbox">
                                <input type="checkbox" id="iaggree" class="form-check-input">
                                <label for="iaggree">Proses! Jika kamu setuju untuk menghapus permanen</label>
                            </div>
                        </div>
                        <input type="hidden" name="id_user" value="<?= htmlspecialchars($id_user); ?>">
                        <input type="hidden" name="img_user" value="<?= htmlspecialchars($img_user); ?>">
                        <input type="hidden" name="identitas_lama" value="<?= htmlspecialchars($foto_identitas); ?>">
                        <div class="form-group my-2 d-flex justify-content-end">
                            <button type="submit" name="btn_deleteakun" class="btn btn-danger" id="btn-delete-account" disabled>Hapus Akun</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Informasi Pribadi</h5>
                </div>
                <div class="card-body">
                    <form action="../functions/function_admin.php" method="post" data-parsley-validate enctype="multipart/form-data">
                        <div class="row form-group mandatory has-icon-left">
                            <div class="col-md-6 col-12">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <div class="position-relative">
                                    <input
                                        type="text"
                                        id="nama_lengkap"
                                        class="form-control"
                                        name="nama_user"
                                        placeholder="Nama Lengkap"
                                        minlength="3"
                                        value="<?= htmlspecialchars($nama_user); ?>"
                                        data-parsley-required="true" />
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mt-2">
                                <label for="nama_lengkap" class="form-label">ID User</label>
                                <div class="position-relative">
                                    <input
                                        type="text"
                                        id="nama_lengkap"
                                        class="form-control"
                                        name="id_user"
                                        placeholder="Kode User"
                                        minlength="3"
                                        disabled
                                        value="<?= htmlspecialchars($id_user); ?>"
                                        data-parsley-required="true" />
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group mandatory has-icon-left">
                            <div class="col-md-6 col-12">
                                <label for="no_telp" class="form-label">No Telepon</label>
                                <div class="position-relative">
                                    <input
                                        type="tel"
                                        id="no_telp"
                                        class="form-control"
                                        name="no_telp"
                                        placeholder="08***"
                                        pattern="^\d{10,15}$"
                                        data-parsley-required="true"
                                        data-parsley-pattern="^\d{10,15}$"
                                        value="<?= htmlspecialchars($no_telp); ?>" />
                                    <div class="form-control-icon">
                                        <i class="bi bi-phone"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mt-2">
                                <label for="gol_darah" class="form-label">Golongan Darah</label>
                                <div class="form-group">
                                    <select id="gol_darah" name="gol_darah" class="choices form-select">
                                        <optgroup label="Rhesus Positif">
                                            <option value="A+" <?= $gol_darah === 'A+' ? 'selected' : ''; ?>>A+</option>
                                            <option value="B+" <?= $gol_darah === 'B+' ? 'selected' : ''; ?>>B+</option>
                                            <option value="AB+" <?= $gol_darah === 'AB+' ? 'selected' : ''; ?>>AB+</option>
                                            <option value="O+" <?= $gol_darah === 'O+' ? 'selected' : ''; ?>>O+</option>
                                        </optgroup>
                                        <optgroup label="Rhesus Negatif">
                                            <option value="A-" <?= $gol_darah === 'A-' ? 'selected' : ''; ?>>A-</option>
                                            <option value="B-" <?= $gol_darah === 'B-' ? 'selected' : ''; ?>>B-</option>
                                            <option value="AB-" <?= $gol_darah === 'AB-' ? 'selected' : ''; ?>>AB-</option>
                                            <option value="O-" <?= $gol_darah === 'O-' ? 'selected' : ''; ?>>O-</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group mandatory">
                            <div class="col-md-6 col-12">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input
                                    type="date"
                                    id="tanggal_lahir"
                                    class="form-control"
                                    name="tanggal_lahir"
                                    value="<?= htmlspecialchars($tanggal_lahir); ?>"
                                    data-parsley-required="true" />
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mandatory">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input
                                        type="text"
                                        id="tempat_lahir"
                                        class="form-control"
                                        name="tempat_lahir"
                                        placeholder="Tempat Lahir"
                                        minlength="3"
                                        value="<?= htmlspecialchars($tempat_lahir); ?>"
                                        data-parsley-required="true" />
                                </div>
                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col-md-6 col-12">
                                <div class="form-group mandatory">
                                    <fieldset>
                                        <label class="form-label">Jenis Kelamin</label>
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="jenis_kelamin"
                                                id="Laki-laki"
                                                value="Laki-laki"
                                                <?= $jenis_kelamin === 'Laki-laki' ? 'checked' : ''; ?>
                                                data-parsley-required="true" />
                                            <label
                                                class="form-check-label form-label"
                                                for="Laki-laki">
                                                Laki-Laki
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="jenis_kelamin"
                                                value="Perempuan"
                                                <?= $jenis_kelamin === 'Perempuan' ? 'checked' : ''; ?>
                                                id="Perempuan" />
                                            <label
                                                class="form-check-label form-label"
                                                for="Perempuan">
                                                Perempuan
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mandatory">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea
                                        rows="1"
                                        id="alamat"
                                        class="form-control"
                                        name="alamat"
                                        minlength="5"
                                        placeholder="Alamat"
                                        data-parsley-required="true"><?= htmlspecialchars($alamat); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group mandatory has-icon-left">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="tanggal_lahir" class="form-label">Foto Identitas (KTP/SIM)</label>
                                    <p>
                                        <small class="text-bold">
                                            <code>*Abaikan jika foto identitas sudah sesuai ketentuan.</code>
                                        </small>
                                    </p>
                                    <div class="row gallery" data-bs-toggle="modal" data-bs-target="#galleryModal<?= htmlspecialchars($id_user); ?>">
                                        <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                            <a href="#">
                                                <img style="width: 200px;" src="assets/<?= empty($foto_identitas) ? 'static/images/faces/1.jpg' : 'foto_identitas/' . htmlspecialchars($foto_identitas) ?>" data-bs-target="#Gallerycarousel" data-bs-slide-to="0" alt="Foto Identitas" onerror="this.src='assets/static/images/faces/1.jpg'">
                                            </a>
                                        </div>
                                    </div>
                                    <input name="foto_identitas" class="mt-3 image-preview-filepond" image-crop-aspect-ratio="1:1" type="file" id="formFileFotoIdentitas" data-max-file-size="1MB" data-max-files="1">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="email" class="form-label">Email</label>
                                <div class="position-relative">
                                    <input
                                        type="text"
                                        id="email"
                                        class="form-control"
                                        name="email"
                                        placeholder="Email"
                                        minlength="3"
                                        value="<?= htmlspecialchars($email); ?>"
                                        data-parsley-required="true" />
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="identitas_lama" value="<?= htmlspecialchars($foto_identitas); ?>">
                        <input type="hidden" name="id_user" value="<?= htmlspecialchars(string: $id_user); ?>">
                        <div class="form-group">
                            <button type="submit" name="btn_editdatapribadi" class="btn btn-primary">Simpan Data Pribadi</button>
                            <a href="../dashboard/" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Informasi Akun</h5>
                </div>
                <div class="card-body">
                    <form action="../functions/function_admin.php" method="post" data-parsley-validate>
                        <div class="row form-group">
                            <div class="form-group mandatory">
                                <label for="username" class="form-label">Username</label>
                                <input
                                    type="text"
                                    id="username"
                                    name="username"
                                    class="form-control"
                                    placeholder="Username"
                                    minlength="5"
                                    value="<?= htmlspecialchars($username); ?>"
                                    data-parsley-required="true" />
                            </div>
                            <div class="form-group mandatory">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" required class="form-select">
                                    <option value="pendonor" <?= $role === 'pendonor' ? 'selected' : ''; ?>>Pendonor</option>
                                    <option value="admin" <?= $role === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <h9 class="text-bold"><code>*Abaikan jika tidak ingin mengganti password</code></h9>
                                <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    name="password"
                                    minlength="5"
                                    placeholder="Password Baru" />
                            </div>
                            <div class="form-group">
                                <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                                <h9 class="text-bold"><code>*Abaikan jika tidak ingin mengganti password</code></h9>
                                <input
                                    type="password"
                                    id="konfirmasi_password"
                                    class="form-control"
                                    name="konfirmasi_password"
                                    minlength="5"
                                    placeholder="Konfirmasi Password" />
                            </div>
                        </div>
                        <input type="hidden" name="username_lama" value="<?= htmlspecialchars($username); ?>">
                        <input type="hidden" name="id_user" value="<?= htmlspecialchars($id_user); ?>">
                        <input type="hidden" name="sesi_username" value="<?= htmlspecialchars($sesi_username); ?>">
                        <div class="form-group">
                            <button type="submit" name="btn_editdataakun" class="btn btn-primary">Simpan Data Akun</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="galleryModal<?= htmlspecialchars($id_user); ?>" tabindex="-1" role="dialog"
    aria-labelledby="galleryModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galleryModalTitle">Foto Identitas (KTP/SIM) <?= $sesi_nama; ?></h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">

                <div id="Gallerycarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="assets/<?= empty($foto_identitas) ? 'static/images/faces/1.jpg' : 'foto_identitas/' . htmlspecialchars($foto_identitas) ?>" data-bs-target="#Gallerycarousel" data-bs-slide-to="0" alt="Foto Identitas" onerror="this.src='assets/static/images/faces/1.jpg'">
                        </div>
                    </div>
                    <!-- <a class="carousel-control-prev" href="#Gallerycarousel" role="button" type="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next" href="#Gallerycarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a> -->
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>