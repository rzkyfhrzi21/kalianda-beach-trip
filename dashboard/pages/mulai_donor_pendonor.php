    <?php

    // Memeriksa level user
    if ($_SESSION['sesi_role'] !== 'pendonor') {
        return;
    }

    $id_user = htmlspecialchars(trim($sesi_id));

    // Ambil data user berdasarkan id
    $query = "SELECT foto_identitas FROM users WHERE id_user = '$id_user'";

    if ($sql = mysqli_query($koneksi, $query)) {

        $users = mysqli_fetch_array($sql);

        // Ambil data pengguna
        $foto_identitas = $users['foto_identitas'];

        if ($id_user == '') {
            die();
        }
    }

    ?>

    <!-- Basic Tables start -->
    <section class="section table">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Kegiatan Donor Darah Hari Ini
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="example3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Penyelenggara</th>
                                <th>Waktu Penerimaan</th>
                                <th>Target</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            <?php include 'status_layak.php'; ?>
                        </thead>
                        <tbody>
                            <?php
                            include '../functions/koneksi.php';
                            $no = 1;

                            $tanggal_sekarang = date('Y-m-d');
                            // Query dengan prepared statement
                            $query      = "SELECT * FROM kegiatan_donor WHERE tanggal_kegiatan = '$tanggal_sekarang' ORDER BY tanggal_kegiatan DESC";
                            $sql_query  = mysqli_query($koneksi, $query);

                            while ($kegiatan = mysqli_fetch_array($sql_query)) :
                                // Pembuatan Variabel Status
                                if ($kegiatan['tanggal_kegiatan'] == $tanggal_sekarang) {
                                    if ($waktu_sekarang <= $kegiatan['waktu_mulai']) {
                                        $status_kegiatan = "Belum dimulai";
                                        $kode_kegiatan   = 0;
                                    } else if ($waktu_sekarang >= $kegiatan['waktu_selesai']) {
                                        $status_kegiatan = "Selesai";
                                        $kode_kegiatan   = 2;
                                    } else {
                                        $status_kegiatan = "Sedang berlangsung";
                                        $kode_kegiatan   = 1;
                                    }
                                }
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $kegiatan['nama_kegiatan']; ?></td>
                                    <td><?= $kegiatan['penyelenggara']; ?></td>
                                    <td><?= $kegiatan['waktu_mulai']; ?> - <?= $kegiatan['waktu_selesai']; ?> WIB</td>
                                    <td><?= $kegiatan['target_pendonor']; ?> Pendonor</td>
                                    <td><?= $kegiatan['alamat']; ?></td>
                                    <td class="text-capitalize"><?= $status_kegiatan; ?></td>
                                    <td class="text-center">
                                        <?php if (empty($foto_identitas)) { ?>

                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#danger<?= htmlspecialchars($sesi_id); ?>">
                                                Daftar Donor
                                            </button>

                                        <?php } else { ?>

                                            <a class="btn btn-danger btn-sm" href="pendonor?page=daftar donor&id=<?= htmlspecialchars($kegiatan['id_kegiatan']); ?>" <?= ($sesi_donor == 1) ? 'onclick="return false;"' : ''; ?>><?= ($sesi_donor == 1) ? 'Sudah Terdaftar Di Salah Satu Kegiatan' : 'Daftar Donor'; ?></a>

                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php
                            endwhile;
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Basic Tables end -->
    <div class="modal fade text-left" id="danger<?= htmlspecialchars($sesi_id); ?>" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel120" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title white" id="myModalLabel120">Foto Identitas Tidak Ditemukan!
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    Silakan lengkapi data diri anda terlebih dahulu, termasuk upload foto identitas KTP/SIM di menu profile sebelum anda bisa mulai daftar donor 🙏
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tutup</span>
                    </button>
                    <button type="button" class="btn btn-danger ms-1"
                        data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block text-white">
                            <a href="?page=profile" class="text-white" style="text-decoration: none;">Upload Sekarang</a>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>