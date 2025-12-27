<?php

if ($_SESSION['sesi_role'] !== 'admin') {
    return;
}

$tanggal_kegiatan = date('Y-m-d');

$id_kegiatan    = htmlspecialchars(trim($_GET['id']));
$query_kegiatan = mysqli_query($koneksi, "SELECT * from kegiatan_donor where id_kegiatan = '$id_kegiatan'");
$kegiatan       = mysqli_fetch_array($query_kegiatan);

$sql_riwayat    = "SELECT  b.id_riwayat, b.usia FROM users a, riwayat_donor b WHERE a.nama_user = b.nama_user AND b.status = 'layak' AND b.id_kegiatan = '$id_kegiatan'";
$query_riwayat = mysqli_query($koneksi, $sql_riwayat);
$riwayat       = mysqli_fetch_array($query_riwayat);

?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Mulai Donor</h3>
                <p class="text-subtitle text-muted">
                    Saatnya menjadi #PahlawanDarah

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

    <!-- // Basic multiple Column Form section start -->
    <form action="../functions/function_donor.php" method="post" class="form" enctype="multipart/form-data">
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Informasi Kegiatan</h4>
                        </div>

                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mandatory">
                                            <label for="penyelenggara" class="form-label">Penyelenggara</label>
                                            <input
                                                type="text"
                                                id="penyelenggara"
                                                class="form-control"
                                                name="penyelenggara"
                                                placeholder="KSR PMI Unit Darmajaya"
                                                required
                                                readonly
                                                value="<?= $kegiatan['penyelenggara']; ?>"
                                                minlength="5" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mandatory">
                                            <label for="penyelenggara" class="form-label">Nama Kegiatan</label>
                                            <input
                                                type="text"
                                                id="penyelenggara"
                                                class="form-control"
                                                name="penyelenggara"
                                                placeholder=""
                                                required
                                                readonly
                                                value="<?= $kegiatan['nama_kegiatan']; ?>"
                                                minlength="5" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mandatory">
                                            <label for="tanggal_kegiatan" class="form-label">Tanggal Donor</label>
                                            <input
                                                type="date"
                                                id="tanggal_kegiatan"
                                                class="form-control"
                                                name="tanggal_kegiatan"
                                                value="<?= $kegiatan['tanggal_kegiatan']; ?>"
                                                readonly
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mandatory">
                                            <label for="tanggal_kegiatan" class="form-label">Waktu Donor</label>
                                            <input
                                                type="text"
                                                id="tanggal_kegiatan"
                                                class="form-control"
                                                name="tanggal_kegiatan"
                                                value="<?= $kegiatan['waktu_mulai']; ?> - <?= $kegiatan['waktu_selesai']; ?> WIB"
                                                readonly
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Cek Kesehatan</h4>
                        </div>

                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="id_user" class="form-label">ID User</label>
                                            <input
                                                type="text"
                                                id="id_user"
                                                class="form-control"
                                                name="id_user"
                                                placeholder="DONORKU001"
                                                readonly
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                            <select class="form-select" required id="nama_user" name="nama_user" onchange="updateDataUser()">
                                                <option value="">Pilih pendonor</option>
                                                <?php
                                                include '../functions/koneksi.php';

                                                $query = "SELECT a.nama_user, a.gol_darah, a.id_user, a.foto_identitas, a.tanggal_lahir, a.email, b.id_riwayat, b.usia FROM users a, riwayat_donor b WHERE a.nama_user = b.nama_user AND b.status = 'layak' AND b.id_kegiatan = '$id_kegiatan'";

                                                $result = mysqli_query($koneksi, $query);

                                                while ($users = mysqli_fetch_array($result)) :

                                                ?>
                                                    <option value="<?= $users['nama_user']; ?>" data-nama="<?= $users['nama_user']; ?>" data-id="<?= $users['id_user']; ?>" data-nama="<?= $users['nama_user']; ?>" data-email="<?= $users['email']; ?>" data-foto_identitas="<?= $users['foto_identitas']; ?>" data-usia="<?= $users['usia']; ?>" data-gol_darah="<?= $users['gol_darah']; ?>">

                                                        <?= $users['nama_user']; ?>

                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="gol_darah" class="form-label">Golongan Darah</label>
                                            <select id="gol_darah" name="gol_darah" class="form-select">
                                                <optgroup label="Rhesus Positif">
                                                    <option value="A+" <?= @$gol_darah === 'A+' ? 'selected' : ''; ?>>A+</option>
                                                    <option value="B+" <?= @$gol_darah === 'B+' ? 'selected' : ''; ?>>B+</option>
                                                    <option value="AB+" <?= @$gol_darah === 'AB+' ? 'selected' : ''; ?>>AB+</option>
                                                    <option value="O+" <?= @$gol_darah === 'O+' ? 'selected' : ''; ?>>O+</option>
                                                </optgroup>
                                                <optgroup label="Rhesus Negatif">
                                                    <option value="A-" <?= @$gol_darah === 'A-' ? 'selected' : ''; ?>>A-</option>
                                                    <option value="B-" <?= @$gol_darah === 'B-' ? 'selected' : ''; ?>>B-</option>
                                                    <option value="AB-" <?= @$gol_darah === 'AB-' ? 'selected' : ''; ?>>AB-</option>
                                                    <option value="O-" <?= @$gol_darah === 'O-' ? 'selected' : ''; ?>>O-</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="usia" class="form-label">Usia</label>
                                            <input
                                                type="number"
                                                id="usia"
                                                class="form-control"
                                                name="usia"
                                                placeholder="Usia"
                                                minlength="1"
                                                maxlength="2"
                                                readonly
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="berat_badan" class="form-label">Berat Badan</label>
                                            <div class="input-group">
                                                <input
                                                    type="number"
                                                    id="berat_badan"
                                                    class="form-control"
                                                    name="berat_badan"
                                                    placeholder="Berat badan"
                                                    minlength="2"
                                                    maxlength="3"
                                                    required />
                                                <span class="input-group-text" id="basic-addon2">Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="nilai_hb" class="form-label">Nilai HB</label>
                                            <div class="input-group">
                                                <input
                                                    type="number"
                                                    id="nilai_hb"
                                                    class="form-control"
                                                    name="nilai_hb"
                                                    placeholder="Nilai hemoglobin"
                                                    minlength="2"
                                                    required>
                                                <span class="input-group-text" id="basic-addon2">g/dL</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="foto_identitas" id="nama_identitas" class="form-label">Foto Identitas (KTP/SIM)</label>
                                            <div class="row gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
                                                <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                                    <a href="#">
                                                        <img style="width: 200px;" id="foto_identitas" src="assets/<?= empty($foto_identitas) ? 'static/images/faces/1.jpg' : 'foto_identitas/' . htmlspecialchars($foto_identitas) ?>" data-bs-target="#Gallerycarousel" data-bs-slide-to="0" alt="Foto Identitas" onerror="this.src='assets/static/images/faces/1.jpg'">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="nilai_hb" class="form-label">Tekanan Darah</label>
                                            <div class="input-group">
                                                <div class="col-12">
                                                    <fieldset>
                                                        <div class="input-group">
                                                            <input type="number" name="sistolik" data-parsley-required="true" aria-label="Sistolik" class="form-control"
                                                                placeholder="Tekanan sistolik" required minlength="2" maxlength="3">
                                                            <input type="number" name="diastolik" data-parsley-required="true" aria-label="Diastolik" class="form-control"
                                                                placeholder="Tekanan diastolik" required minlength="2" maxlength="3">
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="data_sesuai" class="form-label">Hasil Foto Identitas</label>
                                            <select id="data_sesuai" name="data_sesuai" class="form-select">
                                                <optgroup label="Data Sesuai">
                                                    <option value="ya">Ya</option>
                                                    <option value="tidak">Tidak</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <input type="hidden" name="email_user" id="email_user">
                                    <input type="hidden" name="tanggal_kegiatan" value="<?= $tanggal_kegiatan; ?>">
                                    <input type="hidden" name="id_kegiatan" value="<?= $id_kegiatan; ?>">
                                    <input type="hidden" name="id_riwayat" value="<?= $riwayat['id_riwayat']; ?>">

                                    <!-- Submit -->
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" name="btn_mulaidonor" class="btn btn-primary me-1 mb-1">
                                                Mulai Donor
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
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </form>
</div>

<div class="modal fade" id="galleryModal" tabindex="-1" role="dialog"
    aria-labelledby="galleryModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nama_identitasPreview">Foto Identitas (KTP/SIM)
                </h5>
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
                            <img class="d-block w-100" id="foto_identitasPreview" src="assets/<?= empty($foto_identitas) ? 'static/images/faces/1.jpg' : 'foto_identitas/' . htmlspecialchars($foto_identitas) ?>" data-bs-target="#Gallerycarousel" data-bs-slide-to="0" alt="Foto Identitas" onerror="this.src='assets/static/images/faces/1.jpg'">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
    function updateDataUser() {
        const namaUserSelect = document.getElementById("nama_user");
        const idUserInput = document.getElementById("id_user");
        const golDarahSelect = document.getElementById("gol_darah");
        const usiaInput = document.getElementById("usia");
        const fotoIdentitas = document.getElementById("foto_identitas");
        const emailInput = document.getElementById("email_user");
        const namaIdentitas = document.getElementById("nama_identitas");
        const nama_identitasPreview = document.getElementById("nama_identitasPreview");

        // Ambil data dari <option> yang dipilih
        const selectedOption = namaUserSelect.options[namaUserSelect.selectedIndex];
        const id_user = selectedOption.getAttribute("data-id");
        const nama_user = selectedOption.getAttribute("data-nama");
        const gol_darah = selectedOption.getAttribute("data-gol_darah");
        const email = selectedOption.getAttribute("data-email");
        const usia = selectedOption.getAttribute("data-usia");
        const foto_identitas = selectedOption.getAttribute("data-foto_identitas");

        // Set nilai input dari data attribute
        idUserInput.value = id_user;
        golDarahSelect.value = gol_darah;
        usiaInput.value = usia;
        emailInput.value = email;
        fotoIdentitas.value = foto_identitas;
        namaIdentitas.textContent = "Foto Identitas (KTP/SIM) " + nama_user;
        nama_identitasPreview.textContent = "Foto Identitas (KTP/SIM) " + nama_user;

        // Update src of the image
        const imgElement = document.getElementById("foto_identitas");
        const imgElementPreview = document.getElementById("foto_identitasPreview");
        imgElement.src = 'assets/foto_identitas/' + foto_identitas;
        imgElementPreview.src = 'assets/foto_identitas/' + foto_identitas;
    };

    window.onload = function() {
        updateDataUser(); // Set initial values based on the first item
    };
</script>