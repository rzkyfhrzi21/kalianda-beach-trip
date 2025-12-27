<?php

$tanggal_kegiatan = date('Y-m-d');

$id_kegiatan    = htmlspecialchars(trim($_GET['id']));
$query_kegiatan = mysqli_query($koneksi, "SELECT * from kegiatan_donor where id_kegiatan = '$id_kegiatan'");
$kegiatan       = mysqli_fetch_array($query_kegiatan);

?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Donor</h3>
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

    <form action="../functions/function_donor.php" method="post" class="form" enctype="multipart/form-data">
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-md-4 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Pribadi & Informasi Kegiatan</h4>
                        </div>

                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mandatory">
                                            <label for="id_user" class="form-label">ID User</label>
                                            <input
                                                type="text"
                                                id="id_user"
                                                class="form-control"
                                                name="id_user"
                                                placeholder="DONORKU001"
                                                readonly
                                                value="<?= $sesi_id; ?>"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mandatory">
                                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                            <input
                                                type="text"
                                                id="nama_user"
                                                class="form-control"
                                                name="nama_user"
                                                placeholder=""
                                                required
                                                readonly
                                                value="<?= $sesi_nama; ?>"
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
                                            <label for="waktu_kegiatan" class="form-label">Waktu Kegiatan</label>
                                            <input
                                                type="text"
                                                id="waktu_kegiatan"
                                                class="form-control"
                                                name="waktu_kegiatan"
                                                value="<?= $kegiatan['waktu_mulai']; ?> - <?= $kegiatan['waktu_selesai']; ?> WIB"
                                                readonly
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
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
                                    <input type="hidden" name="id_kegiatan" value="<?= $kegiatan['id_kegiatan']; ?>">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pertanyaan Kesehatan & Kelayakan Donor</h4>
                            <p>(berbasis pedoman PMI dan UDD)</p>
                        </div>
                        <div class="card-body">
                            <form action="../functions/function_donor.php" method="POST">
                                <!-- SOAL 1 START -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <p>1. Apakah Anda dalam keadaan sehat hari ini?</p>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="keadaan_sehat" id="ya1" value="Ya" required>
                                        <label class="form-check-label" for="ya1">Ya</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="keadaan_sehat" id="tidak1" value="Tidak">
                                        <label class="form-check-label" for="tidak1">Tidak</label>
                                    </div>
                                </div>
                                <!-- SOAL 1 END -->

                                <!-- SOAL 2 START -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <p>2. Apakah Anda sedang mengalami demam, batuk, flu, atau sakit kepala?</p>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="gejala" id="ya2" value="Ya" required>
                                        <label class="form-check-label" for="ya2">Ya</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="gejala" id="tidak2" value="Tidak">
                                        <label class="form-check-label" for="tidak2">Tidak</label>
                                    </div>
                                </div>
                                <!-- SOAL 2 END -->

                                <!-- SOAL 4 START -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <p>3. Apakah Anda sedang hamil, menyusui, atau baru melahirkan dalam 6 bulan terakhir?</p>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="hamil" id="ya4" value="Ya" required>
                                        <label class="form-check-label" for="ya4">Ya</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="hamil" id="tidak4" value="Tidak">
                                        <label class="form-check-label" for="tidak4">Tidak</label>
                                    </div>
                                </div>
                                <!-- SOAL 4 END -->

                                <!-- SOAL 5 START -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <p>4. Apakah Anda baru menerima vaksin dalam 14 hari terakhir?</p>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="vaksin" id="ya5" value="Ya" required>
                                        <label class="form-check-label" for="ya5">Ya</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="vaksin" id="tidak5" value="Tidak">
                                        <label class="form-check-label" for="tidak5">Tidak</label>
                                    </div>
                                </div>
                                <!-- SOAL 5 END -->

                                <!-- SOAL 6 START -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <p>5. Apakah Anda memiliki riwayat penyakit berat (jantung, paru-paru, ginjal, diabetes, epilepsi)?</p>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="riwayat_penyakit" id="ya6" value="Ya" required>
                                        <label class="form-check-label" for="ya6">Ya</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="riwayat_penyakit" id="tidak6" value="Tidak">
                                        <label class="form-check-label" for="tidak6">Tidak</label>
                                    </div>
                                </div>
                                <!-- SOAL 6 END -->

                                <!-- SOAL 7 START -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <p>6. Apakah Anda pernah menerima transfusi darah dalam 1 tahun terakhir?</p>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="transfusi" id="ya7" value="Ya" required>
                                        <label class="form-check-label" for="ya7">Ya</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="transfusi" id="tidak7" value="Tidak">
                                        <label class="form-check-label" for="tidak7">Tidak</label>
                                    </div>
                                </div>
                                <!-- SOAL 7 END -->

                                <!-- SOAL 8 START -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <p>7. Apakah Anda pernah melakukan tindik, tato, atau akupuntur dalam 1 tahun terakhir?</p>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="tindik" id="ya8" value="Ya" required>
                                        <label class="form-check-label" for="ya8">Ya</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="tindik" id="tidak8" value="Tidak">
                                        <label class="form-check-label" for="tidak8">Tidak</label>
                                    </div>
                                </div>
                                <!-- SOAL 8 END -->

                                <!-- SOAL 9 START -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <p>8. Apakah Anda sedang mengonsumsi obat-obatan tertentu saat ini?</p>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="obat" id="ya9" value="Ya" required>
                                        <label class="form-check-label" for="ya9">Ya</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="obat" id="tidak9" value="Tidak">
                                        <label class="form-check-label" for="tidak9">Tidak</label>
                                    </div>
                                </div>
                                <!-- SOAL 9 END -->

                                <!-- SOAL 10 START -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <p>9. Apakah Anda sedang haid (untuk perempuan)?</p>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="haid" id="ya10" value="Ya" required>
                                        <label class="form-check-label" for="ya10">Ya</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="haid" id="tidak10" value="Tidak">
                                        <label class="form-check-label" for="tidak10">Tidak</label>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" class="form-check-input" name="haid" id="tidak_berlaku10" value="Tidak Berlaku">
                                        <label class="form-check-label" for="tidak_berlaku10">Tidak Berlaku</label>
                                    </div>
                                </div>
                                <!-- SOAL 10 END -->

                                <!-- SOAL 11 START -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <p>10. Berapa usia anda sekarang?</p>
                                    </div>
                                    <div class="col-8">
                                        <input
                                            type="number"
                                            id="usia"
                                            class="form-control"
                                            name="usia"
                                            placeholder="Ketikkan usia anda "
                                            minlength="1"
                                            maxlength="2"
                                            required />
                                    </div>
                                </div>
                                <!-- SOAL 11 END -->

                                <!-- SOAL 12 START -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <p>11. Sudah berapa kali Anda mendonorkan darah sebelumnya?</p>
                                    </div>
                                    <div class="col-8">
                                        <select class="form-select" name="jumlah_donor" required>
                                            <option value="0">0</option>
                                            <option value="1-3">1-3</option>
                                            <option value=">3">>3</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- SOAL 12 END -->

                                <!-- SOAL 13 START -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <p>12. Kapan terakhir kali Anda melakukan donor darah?</p>
                                    </div>
                                    <div class="col-8">
                                        <select class="form-select" name="terakhir_donor" required>
                                            <option value="<2 bulan lalu">
                                                <2 bulan lalu</option>
                                            <option value=">2 bulan lalu">>2 bulan lalu</option>
                                            <option value="Belum Pernah">Belum Pernah</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- SOAL 13 END -->
                                <input type="hidden" name="email_user" value="<?= $sesi_email; ?>">
                                <input type="submit" name="btn_daftardonor" class="btn btn-primary" value="Daftar Donor">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>