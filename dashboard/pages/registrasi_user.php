<?php

if ($_SESSION['sesi_role'] !== 'admin') {
    return;
}

$nama_user      = isset($_SESSION['form_data']['nama_user']) ? $_SESSION['form_data']['nama_user'] : '';
$no_telp        = isset($_SESSION['form_data']['no_telp']) ? $_SESSION['form_data']['no_telp'] : '';
$gol_darah      = isset($_SESSION['form_data']['gol_darah']) ? $_SESSION['form_data']['gol_darah'] : '';
$jenis_kelamin  = isset($_SESSION['form_data']['jenis_kelamin']) ? $_SESSION['form_data']['jenis_kelamin'] : '';
$tempat_lahir   = isset($_SESSION['form_data']['tempat_lahir']) ? $_SESSION['form_data']['tempat_lahir'] : '';
$tanggal_lahir  = isset($_SESSION['form_data']['tanggal_lahir']) ? $_SESSION['form_data']['tanggal_lahir'] : '';
$alamat         = isset($_SESSION['form_data']['alamat']) ? $_SESSION['form_data']['alamat'] : '';
$email          = isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : '';
$username       = isset($_SESSION['form_data']['username']) ? $_SESSION['form_data']['username'] : '';
$role           = isset($_SESSION['form_data']['role']) ? $_SESSION['form_data']['role'] : '';

// Setelah mengambil data, Anda bisa menghapus session jika tidak diperlukan lagi
unset($_SESSION['form_data']);

?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Registrasi User</h3>
                <p class="text-subtitle text-muted">
                    Hi, Ayo bergabung menjadi #PahlawanDarah

                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav
                    aria-label="breadcrumb"
                    class="breadcrumb-header float-start float-lg-end">
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

    <!--  Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informasi Pribadi</h4>
                    </div>
                    <form action="../functions/function_admin.php" method="post" enctype="multipart/form-data" class="form" data-parsley-validate>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="formFileFoto" class="form-label">Foto Profil</label>
                                            <p><small class="text-bold"><code>*Abaikan jika tidak ingin mengganti foto profil</code></small></p>
                                            <input name="img_user" class="image-crop-filepond"
                                                image-crop-aspect-ratio="1:1" type="file" id="formFileFoto" data-max-file-size="1MB" data-max-files="1" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                            <input
                                                type="text"
                                                id="nama_lengkap"
                                                class="form-control"
                                                name="nama_user"
                                                placeholder="Nama Lengkap"
                                                minlength="3"
                                                value="<?= $nama_user; ?>"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="nama_lengkap" class="form-label">Email</label>
                                            <input
                                                type="email"
                                                id="nama_lengkap"
                                                class="form-control"
                                                name="email"
                                                placeholder="Email"
                                                minlength="3"
                                                value="<?= $email; ?>"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="no_telp" class="form-label">No Telpon</label>
                                            <input
                                                type="tel"
                                                id="no_telp"
                                                class="form-control"
                                                name="no_telp"
                                                placeholder="08***"
                                                pattern="^\d{10,15}$"
                                                data-parsley-required="true"
                                                data-parsley-pattern="^\d{10,15}$"
                                                value="<?= $no_telp; ?>"
                                                title="Nomor telepon harus terdiri dari 10 hingga 15 digit." />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="gol_darah" class="form-label mandatory">Golongan Darah</label>
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
                                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                            <input
                                                type="text"
                                                id="tempat_lahir"
                                                class="form-control"
                                                name="tempat_lahir"
                                                placeholder="Tempat Lahir"
                                                minlength="3"
                                                value="<?= $tempat_lahir; ?>"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="formFileFotoIdentitas" class="form-label">Foto Identitas (KTP/SIM)</label>
                                            <p><small class="text-bold"><code>*Foto KTP/SIM harus jelas dan tidak buram.
                                                        Pastikan semua informasi pada identitas terlihat dengan jelas.
                                                        Hindari penggunaan filter atau efek yang dapat mengubah penampilan asli.</code></small></p>
                                            <input name="foto_identitas" class="image-preview-filepond"
                                                image-crop-aspect-ratio="1:1" type="file" id="formFileFotoIdentitas" data-max-file-size="1MB" data-max-files="1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                            <input
                                                type="date"
                                                id="tanggal_lahir"
                                                class="form-control"
                                                name="tanggal_lahir"
                                                value="<?= $tanggal_lahir; ?>"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea
                                                rows="2"
                                                id="alamat"
                                                class="form-control"
                                                name="alamat"
                                                minlength="5"
                                                placeholder="Alamat"
                                                data-parsley-required="true"><?= $alamat; ?></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <h4 class="card-title">Informasi Akun</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="username" class="form-label">Username</label>
                                            <input
                                                type="text"
                                                id="username"
                                                name="username"
                                                class="form-control"
                                                placeholder="Username"
                                                minlength="5"
                                                value="<?= $username; ?>"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="role" class="form-label">Role</label>
                                            <select name="role" id="role" required class="form-select">
                                                <option value="pendonor" <?= $role === 'pendonor' ? 'selected' : ''; ?>>Pendonor</option>
                                                <option value="admin" <?= $role === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="password" class="form-label">Password</label>
                                            <input
                                                type="password"
                                                id="password"
                                                class="form-control"
                                                name="password"
                                                minlength="5"
                                                placeholder="Password Baru"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                                            <input
                                                type="password"
                                                id="konfirmasi_password"
                                                class="form-control"
                                                name="konfirmasi_password"
                                                minlength="5"
                                                placeholder="Konfirmasi Password Baru"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                                <!-- </form> -->

                                <!-- S&K -->
                                <div class="col-16">
                                    <div class="form-group">
                                        <div class="form-check mandatory">
                                            <input
                                                type="checkbox"
                                                id="checkbox5"
                                                class="form-check-input"
                                                amhecked
                                                name="snk"
                                                data-parsley-required="true"
                                                data-parsley-error-message="Kamu harus menyetujui Syarat dan Ketentuan kami yang berlaku untuk segera diproses." />
                                            <label
                                                for="checkbox5"
                                                class="form-check-label form-label">Saya setuju dengan Syarat dan Ketentuan yang berlaku</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- S&K -->

                                <!-- Submit -->
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" name="btn_adminregister" class="btn btn-primary me-1 mb-1">
                                            Registrasi
                                        </button>
                                        <button
                                            type="reset"
                                            class="btn btn-light-secondary me-1 mb-1">
                                            Reset
                                        </button>
                                    </div>
                                </div>
                                <!-- Submit -->
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>