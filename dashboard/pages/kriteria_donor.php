<?php

if ($_SESSION['sesi_role'] !== 'admin') {
    return;
}

// Ambil data user berdasarkan id
$query = "SELECT * FROM kriteria_donor";

if ($sql = mysqli_query($koneksi, $query)) {

    $kegiatan = mysqli_fetch_array($sql);

    $id_kriteria        = isset($kegiatan['id_kriteria']) ? $kegiatan['id_kriteria'] : '';

    $usia_minimal       = isset($kegiatan['usia_minimal']) ? $kegiatan['usia_minimal'] : '17';
    $usia_maksimal      = isset($kegiatan['usia_maksimal']) ? $kegiatan['usia_maksimal'] : '65';
    $bb_minimal         = isset($kegiatan['bb_minimal']) ? $kegiatan['bb_minimal'] : '45';
    $hb_minimal         = isset($kegiatan['hb_minimal']) ? $kegiatan['hb_minimal'] : '13';
    $hb_maksimal        = isset($kegiatan['hb_maksimal']) ? $kegiatan['hb_maksimal'] : '18';
    $sistolik_minimal   = isset($kegiatan['sistolik_minimal']) ? $kegiatan['sistolik_minimal'] : '100';
    $sistolik_maksimal  = isset($kegiatan['sistolik_maksimal']) ? $kegiatan['sistolik_maksimal'] : '170';
    $diastolik_minimal  = isset($kegiatan['diastolik_minimal']) ? $kegiatan['diastolik_minimal'] : '70';
    $diastolik_maksimal = isset($kegiatan['diastolik_maksimal']) ? $kegiatan['diastolik_maksimal'] : '100';
}

?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kriteria Cek Kesehatan Berhasil Donor</h3>
                <p class="text-subtitle text-muted">
                    Ayo, Selenggarakan donor darah #AksiNyataKemanusiaan
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

    <!-- Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="card-title">Informasi Kriteria</h4>
                        </div>
                    </div>
                    <form action="../functions/function_donor.php" method="post" class="form" data-parsley-validate>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="usia_minimal" class="form-label">Usia Minimal</label>
                                            <input
                                                type="number"
                                                id="usia_minimal"
                                                class="form-control"
                                                name="usia_minimal"
                                                placeholder="Usia Minimal"
                                                data-parsley-required="true"
                                                value="<?= $usia_minimal; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="usia_maksimal" class="form-label">Usia Maksimal</label>
                                            <input
                                                type="number"
                                                id="usia_maksimal"
                                                class="form-control"
                                                name="usia_maksimal"
                                                placeholder="Usia Maksimal"
                                                data-parsley-required="true"
                                                value="<?= $usia_maksimal; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="bb_minimal" class="form-label">Berat Badan Minimal</label>
                                            <input
                                                type="number"
                                                id="bb_minimal"
                                                class="form-control"
                                                name="bb_minimal"
                                                placeholder="Berat Badan Minimal"
                                                data-parsley-required="true"
                                                value="<?= $bb_minimal; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="hb_minimal" class="form-label">Nilai HB Minimal</label>
                                            <input
                                                type="number"
                                                id="hb_minimal"
                                                class="form-control"
                                                name="hb_minimal"
                                                placeholder="Nilai HB Minimal"
                                                data-parsley-required="true"
                                                value="<?= $hb_minimal; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="hb_maksimal" class="form-label">Nilai HB Maksimal</label>
                                            <input
                                                type="number"
                                                id="hb_maksimal"
                                                class="form-control"
                                                name="hb_maksimal"
                                                placeholder="Nilai HB Maksimal"
                                                data-parsley-required="true"
                                                value="<?= $hb_maksimal; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="sistolik_minimal" class="form-label">Sistolik Minimal</label>
                                            <input
                                                type="number"
                                                id="sistolik_minimal"
                                                class="form-control"
                                                name="sistolik_minimal"
                                                placeholder="Sistolik Minimal"
                                                data-parsley-required="true"
                                                value="<?= $sistolik_minimal; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="sistolik_maksimal" class="form-label">Sistolik Maksimal</label>
                                            <input
                                                type="number"
                                                id="sistolik_maksimal"
                                                class="form-control"
                                                name="sistolik_maksimal"
                                                placeholder="Sistolik Maksimal"
                                                data-parsley-required="true"
                                                value="<?= $sistolik_maksimal; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="diastolik_minimal" class="form-label">Diastolik Minimal</label>
                                            <input
                                                type="number"
                                                id="diastolik_minimal"
                                                class="form-control"
                                                name="diastolik_minimal"
                                                placeholder="Diastolik Minimal"
                                                data-parsley-required="true"
                                                value="<?= $diastolik_minimal; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="diastolik_maksimal" class="form-label">Diastolik Maksimal</label>
                                            <input
                                                type="number"
                                                id="diastolik_maksimal"
                                                class="form-control"
                                                name="diastolik_maksimal"
                                                placeholder="Diastolik Maksimal"
                                                data-parsley-required="true"
                                                value="<?= $diastolik_maksimal; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id_kriteria" value="<?= $id_kriteria; ?>">
                                <!-- Submit -->
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" name="btn_editkriteria" class="btn btn-primary me-1 mb-1">
                                            Simpan
                                        </button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">
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