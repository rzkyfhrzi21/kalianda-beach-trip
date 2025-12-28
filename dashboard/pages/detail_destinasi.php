<?php
if ($_SESSION['sesi_role'] !== 'admin') return;

$id_destinasi = intval($_GET['id'] ?? 0);

$query = mysqli_query($koneksi, "SELECT * FROM destinasi_wisata WHERE id_destinasi='$id_destinasi'");
$data = mysqli_fetch_assoc($query);

if (!$data) die("Data tidak ditemukan");
?>


<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>Detail Destinasi Wisata</h4>

            <form action="../functions/function_destinasi.php" method="post"
                onsubmit="return confirm('Yakin hapus destinasi ini?')">
                <input type="hidden" name="id_destinasi" value="<?= $id_destinasi ?>">
                <button class="btn btn-danger" name="btn_delete_destinasi">Hapus</button>
            </form>
        </div>

        <form action="../functions/function_destinasi.php" method="post" enctype="multipart/form-data">
            <div class="card-body">

                <input type="hidden" name="id_destinasi" value="<?= $id_destinasi ?>">
                <input type="hidden" name="gambar_lama" value="<?= $data['gambar']; ?>">

                <div class="row">
                    <div class="col-md-6 mt-3">
                        <div class="form-group mandatory">
                            <label>Nama Destinasi</label>
                            <input type="text" name="nama_destinasi" class="form-control"
                                value="<?= $data['nama_destinasi']; ?>" data-parsley-required="true">
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group mandatory">
                            <label>Lokasi</label>
                            <input type="text" name="lokasi" class="form-control"
                                value="<?= $data['lokasi']; ?>" data-parsley-required="true">
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group mandatory">
                            <label>Harga per Orang</label>
                            <input type="number" name="harga_per_orang" class="form-control"
                                value="<?= $data['harga_per_orang']; ?>" data-parsley-required="true">
                        </div>
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="form-group mandatory">
                            <label>Tagline / Aktivitas</label>
                            <textarea name="tagline_aktivitas" class="form-control" rows="2" data-parsley-required="true"><?= $data['tagline_aktivitas']; ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="form-group mandatory">
                            <label for="jam_buka" class="form-label">Jam Buka</label>
                            <input
                                type="time"
                                id="jam_buka"
                                class="form-control flatpickr-no-config flatpickr-time-picker-24h"
                                name="jam_buka"
                                placeholder="Jam Buka"
                                value="<?= $data['jam_buka']; ?>"
                                data-parsley-required="true" />
                        </div>
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="form-group mandatory">
                            <label for="jam_tutup" class="form-label">Jam Tutup</label>
                            <input
                                type="time"
                                id="jam_tutup"
                                class="form-control flatpickr-no-config flatpickr-time-picker-24h"
                                name="jam_tutup"
                                placeholder="Jam Tutup"
                                value="<?= $data['jam_tutup']; ?>"
                                data-parsley-required="true" />
                        </div>
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="form-group mandatory">
                            <label>No HP Pengelola</label>
                            <input type="text" name="no_hp" class="form-control"
                                value="<?= $data['no_hp']; ?>" data-parsley-required="true">
                        </div>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="aktif" <?= $data['status'] === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="nonaktif" <?= $data['status'] === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>

                    </div>


                    <div class="col-md-6 mt-3">
                        <label>Gambar Destinasi</label>
                        <input type="file" name="gambar" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
                    </div>


                    <div class="col-md-6 mt-3">
                        <label>Preview</label><br>
                        <img src="../dashboard/assets/img/destinasi_wisata/<?= $data['gambar']; ?>"
                            class="img-fluid rounded"
                            style="max-height:200px">
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button class="btn btn-primary" name="btn_update_destinasi">
                        Simpan Perubahan
                    </button>
                </div>

            </div>
        </form>
    </div>
</section>