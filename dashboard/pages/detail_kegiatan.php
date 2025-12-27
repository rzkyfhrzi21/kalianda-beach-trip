<?php

if ($_SESSION['sesi_role'] !== 'admin') {
    return;
}

$id_kegiatan        = htmlspecialchars(trim($_GET['id']));

// Ambil data user berdasarkan id
$query = "SELECT * FROM kegiatan_donor WHERE id_kegiatan = '$id_kegiatan'";

if ($sql = mysqli_query($koneksi, $query)) {

    $kegiatan = mysqli_fetch_array($sql);

    $id_kegiatan        = isset($kegiatan['id_kegiatan']) ? $kegiatan['id_kegiatan'] : '';
    $nama_kegiatan      = isset($kegiatan['nama_kegiatan']) ? $kegiatan['nama_kegiatan'] : '';
    $penyelenggara      = isset($kegiatan['penyelenggara']) ? $kegiatan['penyelenggara'] : 'KSR PMI Unit Darmajaya';
    $alamat             = isset($kegiatan['alamat']) ? $kegiatan['alamat'] : 'Kampus IIB Darmajaya';
    $target_pendonor    = isset($kegiatan['target_pendonor']) ? $kegiatan['target_pendonor'] : '';
    $tanggal_kegiatan   = isset($kegiatan['tanggal_kegiatan']) ? $kegiatan['tanggal_kegiatan'] : '';
    $waktu_mulai        = isset($kegiatan['waktu_mulai']) ? $kegiatan['waktu_mulai'] : '';
    $waktu_selesai      = isset($kegiatan['waktu_selesai']) ? $kegiatan['waktu_selesai'] : '';
    $kota               = isset($kegiatan['kota']) ? $kegiatan['kota'] : 'Bandar Lampung';

    if ($id_kegiatan == '') {
        die();
    }
}

?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Kegiatan</h3>
                <p class="text-subtitle text-muted">
                    Ayo, Selenggarakan donor darah #AksiNyataKemanusiaan
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

    <!--  INFORMASI KEGIATAN -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="card-title">Informasi Kegiatan</h4>
                            <button type="button" class="btn btn-outline-danger block" data-bs-toggle="modal"
                                data-bs-target="#modal-delete<?= $id_kegiatan; ?>">
                                Hapus Kegiatan
                            </button>

                            <!-- Modal Hapus -->
                            <div class="modal fade text-left" id="modal-delete<?= $id_kegiatan; ?>" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <form action="../functions/function_kegiatan.php" method="post">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel1">Hapus Kegiatan</h5>
                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-bold">
                                                    Yakin ingin menghapus <b>Donor Darah : <?= $nama_kegiatan; ?></b> ini ?<br>
                                                </p>
                                            </div>
                                            <input type="hidden" name="id_kegiatan" value="<?= $id_kegiatan; ?>">
                                            <div class="modal-footer">
                                                <button type="button" class="btn" data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Batal</span>
                                                </button>
                                                <button type="submit" name="btn_deletekegiatan" class="btn btn-danger ms-1" data-bs-dismiss="modal">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Hapus Kegiatan</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Modal Hapus -->
                        </div>
                    </div>
                    <form action="../functions/function_kegiatan.php" method="post" enctype="multipart/form-data" class="form" data-parsley-validate>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                            <input
                                                type="text"
                                                id="nama_kegiatan"
                                                class="form-control"
                                                name="nama_kegiatan"
                                                placeholder="Ex. Donor Darah Sukarela"
                                                minlength="5"
                                                value="<?= $nama_kegiatan; ?>"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="penyelenggara" class="form-label">Penyelenggara</label>
                                            <input
                                                type="text"
                                                id="penyelenggara"
                                                class="form-control"
                                                name="penyelenggara"
                                                placeholder="Ex. KSR PMI Unit Darmajaya"
                                                minlength="5"
                                                value="<?= $penyelenggara; ?>"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                                            <input
                                                type="date"
                                                id="tanggal_kegiatan"
                                                class="form-control"
                                                name="tanggal_kegiatan"
                                                value="<?= $tanggal_kegiatan; ?>"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="kota" class="form-label">Kota</label>
                                            <input
                                                type="text"
                                                id="kota"
                                                class="form-control"
                                                name="kota"
                                                placeholder="Ex. Bandar Lampung"
                                                minlength="5"
                                                value="<?= $kota; ?>"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                                            <input
                                                type="time"
                                                id="waktu_mulai"
                                                class="form-control flatpickr-no-config flatpickr-time-picker-24h"
                                                name="waktu_mulai"
                                                placeholder="Waktu Mulai"
                                                value="<?= $waktu_mulai; ?>"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                                            <input
                                                type="time"
                                                id="waktu_selesai"
                                                class="form-control flatpickr-no-config flatpickr-time-picker-24h"
                                                name="waktu_selesai"
                                                placeholder="Waktu Selesai"
                                                value="<?= $waktu_selesai; ?>"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="target_pendonor" class="form-label">Target Pendonor</label>
                                            <input
                                                type="number"
                                                id="target_pendonor"
                                                class="form-control"
                                                name="target_pendonor"
                                                placeholder="Ex. 50 Pendonor"
                                                data-parsley-required="true"
                                                value="<?= $target_pendonor; ?>" />
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
                                <input type="hidden" name="id_kegiatan" value="<?= $id_kegiatan; ?>">
                                <input type="hidden" name="id_riwayat" value="<?= $id_kegiatan; ?>">
                                <!-- Submit -->
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" name="btn_editkegiatan" class="btn btn-primary me-1 mb-1">
                                            Simpan Kegiatan
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
    <!-- INFORMASI KEGIATAN -->

    <!-- GALERI KEGIATAN -->
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="card-title">Galeri <?= $nama_kegiatan; ?></h4>
                            <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
                                data-bs-target="#modal-upload<?= $id_kegiatan; ?>">
                                Upload Gambar
                            </button>

                            <!-- Modal Upload -->
                            <div class="modal fade text-left" id="modal-upload<?= $id_kegiatan; ?>" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <form action="../functions/function_kegiatan.php" method="post" enctype="multipart/form-data" class="form" data-parsley-validate>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" for="img_kegiatan">Upload Gambar</h5>
                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group mandatory">
                                                    <p><small class="text-bold"><code>* Ukuran file melebihi 1 MB & bukan format gambar tidak akan disimpan</code></small></p>
                                                    <input type="file" id="img_kegiatan" name="img_kegiatan[]" data-max-file-size="1MB" image-crop-aspect-ratio="1:1" class="image-resize-filepond" multiple required>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id_kegiatan" value="<?= $id_kegiatan; ?>">
                                            <!-- Submit -->
                                            <div class="modal-footer">
                                                <button type="reset" class="btn" data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Reset</span>
                                                </button>
                                                <button type="submit" name="upload_imgkegiatan" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Upload Gambar</span>
                                                </button>
                                            </div>
                                            <!-- Submit -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Modal Upload -->
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row gallery">
                            <?php
                            // Ambil data user berdasarkan id
                            $query = "SELECT * FROM galeri_kegiatan WHERE id_kegiatan = '$id_kegiatan' ORDER BY id_galeri ASC";
                            $sql = mysqli_query($koneksi, $query);

                            while ($galeri = mysqli_fetch_array($sql)) :
                                $id_galeri    = isset($galeri['id_galeri']) ? $galeri['id_galeri'] : '';
                                $img_kegiatan = isset($galeri['img_kegiatan']) ? $galeri['img_kegiatan'] : '';
                            ?>
                                <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal" data-img_kegiatan="<?= $img_kegiatan; ?>" data-img_id="<?= $id_galeri; ?>" data-img_src="assets/<?= empty($img_kegiatan) ? '' : 'kegiatan/' . htmlspecialchars($img_kegiatan) ?>">
                                        <img class="w-100" src="assets/<?= empty($img_kegiatan) ? '' : 'kegiatan/' . htmlspecialchars($img_kegiatan) ?>">
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="../functions/function_kegiatan.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="galleryModalTitle">Galeri <?= $nama_kegiatan; ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="modalImage" class="d-block w-100" src="" alt="Gambar Galeri">
                    </div>
                    <input type="hidden" name="id_kegiatanhapus" value="<?= $id_kegiatan; ?>">
                    <input type="hidden" name="id_galerihapus" id="id_galerihapus" value="">
                    <input type="hidden" name="img_kegiatanhapus" id="img_kegiatanhapus" value="">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="btn_deleteimgkegiatan" class="btn btn-danger" data-bs-dismiss="modal">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // JavaScript untuk mengisi modal dengan gambar yang diklik
        document.addEventListener('DOMContentLoaded', function() {
            const galleryImages = document.querySelectorAll('.gallery a');
            const modalImage = document.getElementById('modalImage');
            const idImageInput = document.getElementById('id_galerihapus');
            const imgKegiatanInput = document.getElementById('img_kegiatanhapus');

            galleryImages.forEach(image => {
                image.addEventListener('click', function() {
                    const imgSrc = this.getAttribute('data-img_src');
                    const imgId = this.getAttribute('data-img_id');
                    const imgKegiatan = this.getAttribute('data-img_kegiatan');
                    modalImage.src = imgSrc; // Set src gambar modal
                    idImageInput.value = imgId; // Set src gambar modal
                    imgKegiatanInput.value = imgKegiatan; // Set src gambar modal
                });
            });
        });
    </script>
    <!-- GALERI KEGIATAN -->
</div>