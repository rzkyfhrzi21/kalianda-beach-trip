<?php
if ($_SESSION['sesi_role'] !== 'admin') {
    return;
}

$nama_lengkap = $_SESSION['form_data']['nama_lengkap'] ?? '';
$username     = $_SESSION['form_data']['username'] ?? '';
$email        = $_SESSION['form_data']['email'] ?? '';
$no_hp        = $_SESSION['form_data']['no_hp'] ?? '';
$jenis_kelamin = $_SESSION['form_data']['jenis_kelamin'] ?? '';
$role         = $_SESSION['form_data']['role'] ?? 'wisatawan';

unset($_SESSION['form_data']);
?>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Registrasi Pengguna</h4>
        </div>

        <form action="../functions/function_admin.php" method="post" enctype="multipart/form-data" data-parsley-validate>
            <div class="card-body">

                <!-- FOTO -->
                <div class="mb-3">
                    <label class="form-label">Foto Profil</label>
                    <input type="file"
                        name="img_user"
                        class="image-crop-filepond"
                        data-max-file-size="1MB"
                        data-max-files="1"
                        required>
                </div>

                <div class="row">
                    <!-- NAMA -->
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text"
                            name="nama_lengkap"
                            class="form-control"
                            value="<?= htmlspecialchars($nama_lengkap); ?>"
                            required>
                    </div>

                    <!-- USERNAME -->
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text"
                            name="username"
                            class="form-control"
                            value="<?= htmlspecialchars($username); ?>"
                            minlength="5"
                            required>
                    </div>

                    <!-- EMAIL -->
                    <div class="col-md-6 mt-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                            name="email"
                            class="form-control"
                            value="<?= htmlspecialchars($email); ?>"
                            required>
                    </div>

                    <!-- NO HP -->
                    <div class="col-md-6 mt-3">
                        <label class="form-label">No HP</label>
                        <input type="tel"
                            name="no_hp"
                            class="form-control"
                            pattern="^\d{10,15}$"
                            value="<?= htmlspecialchars($no_hp); ?>"
                            required>
                    </div>

                    <!-- JENIS KELAMIN -->
                    <div class="col-md-6 mt-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input"
                                type="radio"
                                name="jenis_kelamin"
                                value="Laki-laki"
                                <?= $jenis_kelamin === 'Laki-laki' ? 'checked' : '' ?>
                                required>
                            <label class="form-check-label">Laki-laki</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input"
                                type="radio"
                                name="jenis_kelamin"
                                value="Perempuan"
                                <?= $jenis_kelamin === 'Perempuan' ? 'checked' : '' ?>>
                            <label class="form-check-label">Perempuan</label>
                        </div>
                    </div>

                    <!-- ROLE -->
                    <div class="col-md-6 mt-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="wisatawan" <?= $role === 'wisatawan' ? 'selected' : '' ?>>Wisatawan</option>
                            <option value="admin" <?= $role === 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>

                    <!-- PASSWORD -->
                    <div class="col-md-6 mt-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                            name="password"
                            class="form-control"
                            minlength="5"
                            required>
                    </div>

                    <!-- KONFIRMASI -->
                    <div class="col-md-6 mt-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password"
                            name="konfirmasi_password"
                            class="form-control"
                            minlength="5"
                            required>
                    </div>
                </div>

                <!-- SYARAT -->
                <div class="form-check mt-4">
                    <input class="form-check-input"
                        type="checkbox"
                        required>
                    <label class="form-check-label">
                        Saya menyetujui syarat dan ketentuan yang berlaku
                    </label>
                </div>

                <!-- BUTTON -->
                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" name="btn_adminregister" class="btn btn-primary">
                        Simpan Data
                    </button>
                </div>

            </div>
        </form>
    </div>
</section>