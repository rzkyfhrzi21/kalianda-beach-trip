<?php

if ($_SESSION['sesi_role'] !== 'admin') {
    return;
}

$nama_kegiatan      = isset($_SESSION['form_kegiatan']['nama_kegiatan']) ? $_SESSION['form_kegiatan']['nama_kegiatan'] : '';
$penyelenggara      = isset($_SESSION['form_kegiatan']['penyelenggara']) ? $_SESSION['form_kegiatan']['penyelenggara'] : 'KSR PMI Unit Darmajaya';
$alamat             = isset($_SESSION['form_kegiatan']['alamat']) ? $_SESSION['form_kegiatan']['alamat'] : 'Kampus IIB Darmajaya';
$target_pendonor    = isset($_SESSION['form_kegiatan']['target_pendonor']) ? $_SESSION['form_kegiatan']['target_pendonor'] : '';
$tanggal_kegiatan   = isset($_SESSION['form_kegiatan']['tanggal_kegiatan']) ? $_SESSION['form_kegiatan']['tanggal_kegiatan'] : '';
$waktu_mulai        = isset($_SESSION['form_kegiatan']['waktu_mulai']) ? $_SESSION['form_kegiatan']['waktu_mulai'] : '';
$waktu_selesai      = isset($_SESSION['form_kegiatan']['waktu_selesai']) ? $_SESSION['form_kegiatan']['waktu_selesai'] : '';
$kota               = isset($_SESSION['form_kegiatan']['kota']) ? $_SESSION['form_kegiatan']['kota'] : 'Bandar Lampung';

// Setelah mengambil data, Anda bisa menghapus session jika tidak diperlukan lagi
unset($_SESSION['form_kegiatan']);

?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Kegiatan</h3>
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

    <!--  Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informasi Kegiatan</h4>
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
                                                type="date"
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
                                                type="date"
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
                                <!-- Submit -->
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" name="btn_tambahkegiatan" class="btn btn-primary me-1 mb-1">
                                            Tambah
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