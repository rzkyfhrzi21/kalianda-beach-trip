<?php
if ($_SESSION['sesi_role'] !== 'admin') {
    return;
}
?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Destinasi Wisata</h3>
                <p class="text-subtitle text-muted">
                    Tambahkan destinasi wisata baru untuk ditampilkan di website Kalianda Beach Trip.
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tambah Destinasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">Form Destinasi Wisata</h4>
                    </div>

                    <form action="../functions/function_destinasi.php"
                        method="post"
                        enctype="multipart/form-data"
                        data-parsley-validate>

                        <div class="card-body">
                            <div class="row">

                                <!-- Nama Destinasi -->
                                <div class="col-md-6 mt-3">
                                    <div class="form-group mandatory">
                                        <label class="form-label">Nama Destinasi</label>
                                        <input type="text"
                                            name="nama_destinasi"
                                            class="form-control"
                                            placeholder="Contoh: Pantai Kalianda"
                                            minlength="3"
                                            required>
                                    </div>
                                </div>

                                <!-- Lokasi -->
                                <div class="col-md-6 mt-3">
                                    <div class="form-group mandatory">
                                        <label class="form-label">Lokasi</label>
                                        <input type="text"
                                            name="lokasi"
                                            class="form-control"
                                            placeholder="Contoh: Kalianda, Lampung Selatan"
                                            required>
                                    </div>
                                </div>

                                <!-- Harga -->
                                <div class="col-md-6 mt-3">
                                    <div class="form-group mandatory">
                                        <label class="form-label">Harga per Orang</label>
                                        <input type="number"
                                            name="harga_per_orang"
                                            class="form-control"
                                            placeholder="Contoh: 50000"
                                            min="0"
                                            required>
                                    </div>
                                </div>

                                <!-- Tagline -->
                                <div class="col-md-6 mt-3">
                                    <div class="form-group mandatory">
                                        <label class="form-label">Tagline / Aktivitas</label>
                                        <textarea name="tagline_aktivitas" class="form-control" rows="2" data-parsley-required="true" placeholder="Contoh: Family Beach • Picnic • Gathering"></textarea>
                                    </div>
                                </div>

                                <!-- Jam Buka -->
                                <div class="col-md-6 mt-3">
                                    <div class="form-group mandatory">
                                        <label for="jam_buka" class="form-label">Jam Buka</label>
                                        <input
                                            type="time"
                                            id="jam_buka"
                                            class="form-control flatpickr-no-config flatpickr-time-picker-24h"
                                            name="jam_buka"
                                            data-parsley-required="true" />
                                    </div>
                                </div>

                                <!-- Jam Tutup -->
                                <div class="col-md-6 mt-3">
                                    <div class="form-group mandatory">
                                        <label for="jam_tutup" class="form-label">Jam Tutup</label>
                                        <input
                                            type="time"
                                            id="jam_tutup"
                                            class="form-control flatpickr-no-config flatpickr-time-picker-24h"
                                            name="jam_tutup"
                                            data-parsley-required="true" />
                                    </div>
                                </div>

                                <!-- Nomor HP -->
                                <div class="col-md-6 mt-3">
                                    <div class="form-group mandatory">
                                        <label class="form-label">Nomor HP Pengelola</label>
                                        <input type="text"
                                            name="no_hp"
                                            class="form-control"
                                            placeholder="08xxxxxxxxxx"
                                            pattern="^[0-9]{10,15}$"
                                            required>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 mt-3">
                                    <div class="form-group mandatory">
                                        <label class="form-label">Status Destinasi</label>
                                        <select name="status" class="form-select" required>
                                            <option value="aktif">Aktif</option>
                                            <option value="nonaktif">Nonaktif</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Gambar -->
                                <div class="col-md-12 col-12 mt-3">
                                    <div class="form-group mandatory">
                                        <label class="form-label">Gambar Destinasi</label>
                                        <input type="file"
                                            name="gambar"
                                            class="image-preview-filepond"
                                            data-max-file-size="2MB"
                                            data-max-files="1"
                                            accept="image/*"
                                            required>
                                        <small class="text-muted">
                                            Format JPG / PNG, maksimal 2MB
                                        </small>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- ACTION -->
                        <div class="card-footer d-flex justify-content-end gap-2">
                            <button type="submit" name="btn_tambah_destinasi" class="btn btn-primary">
                                Simpan Destinasi
                            </button>
                            <button type="reset" class="btn btn-light-secondary">
                                Reset
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>