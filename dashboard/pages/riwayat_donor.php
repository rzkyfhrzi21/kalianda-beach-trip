    <?php

    // Memeriksa level user
    if ($_SESSION['sesi_role'] !== 'admin') {
        return;
    }

    ?>

    <!-- Basic Tables start -->
    <section class="section table">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Database Riwayat Donor
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="example1">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>wisatawan</th>
                                <th width="100px">Kegiatan</th>
                                <th>Tgl Donor</th>
                                <th>Gol Darah</th>
                                <th>Berat Badan</th>
                                <th>Nilai HB</th>
                                <th>Tekanan Darah</th>
                                <th>Status</th>
                                <?php if (!empty($_GET['id'])) { ?>
                                    <th>Keterangan</th>
                                <?php } ?>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../functions/config.php';
                            $no     = 1;
                            $id     = htmlspecialchars(trim(@$_GET['id']));

                            // Query dengan prepared statement
                            if (empty($_GET['id'])) {
                                $query_riwayat  = "SELECT * FROM riwayat_donor ORDER BY id_riwayat DESC";
                            } else {
                                $query_riwayat  = "SELECT * FROM riwayat_donor WHERE id_kegiatan = '$id' ORDER BY id_riwayat DESC";
                            }
                            $sql_riwayat    = mysqli_query($koneksi, $query_riwayat);

                            while ($riwayat_donor = mysqli_fetch_array($sql_riwayat)) :

                                $id_kegiatan    = $riwayat_donor['id_kegiatan'];

                                $sql_kegiatan   = mysqli_query($koneksi, "SELECT nama_kegiatan FROM kegiatan_donor where id_kegiatan = '$id_kegiatan'");
                                $kegiatan       = mysqli_fetch_array($sql_kegiatan);

                                // // Tentukan badge berdasarkan hasil
                                if ($riwayat_donor['status'] == 'tidak berhasil') {
                                    $badgeDonor = 'bg-danger';
                                } else if ($riwayat_donor['status'] == 'layak') {
                                    $badgeDonor = 'bg-warning';
                                } else {
                                    $badgeDonor = 'bg-success';
                                }


                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($riwayat_donor['nama_user']); ?></td>
                                    <td><?= htmlspecialchars($kegiatan['nama_kegiatan']); ?></td>
                                    <td><?= htmlspecialchars($riwayat_donor['tanggal_kegiatan']); ?></td>
                                    <td><?= htmlspecialchars($riwayat_donor['gol_darah']); ?></td>
                                    <td><?= htmlspecialchars($riwayat_donor['berat_badan']); ?></td>
                                    <td><?= htmlspecialchars($riwayat_donor['nilai_hb']); ?></td>
                                    <td><?= htmlspecialchars($riwayat_donor['tekanan_darah']); ?></td>
                                    <td>
                                        <span class="badge <?= $badgeDonor; ?> text-capitalize"><?= htmlspecialchars($riwayat_donor['status']); ?></span>
                                    </td>
                                    <?php if (!empty($_GET['id'])) { ?>
                                        <td><?= htmlspecialchars($riwayat_donor['keterangan']); ?></td>
                                    <?php } ?>
                                    <td>
                                        <!-- Button trigger for BorderLess Modal -->
                                        <button type="button" class="btn btn-sm btn-danger block" data-bs-toggle="modal"
                                            data-bs-target="#modalhapus<?= htmlspecialchars($riwayat_donor['id_riwayat']); ?>">
                                            Hapus
                                        </button>
                                    </td>

                                    <!-- START MODAL HAPUS -->
                                    <div class="modal fade" id="modalhapus<?= htmlspecialchars($riwayat_donor['id_riwayat']); ?>" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                            role="document">
                                            <form action="../functions/function_donor.php" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Riwayat Donor
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>
                                                            Hapus riwayat donor #<?= htmlspecialchars($riwayat_donor['id_riwayat']); ?> ?
                                                        </p>
                                                    </div>
                                                    <input type="hidden" name="id_riwayat" value="<?= htmlspecialchars($riwayat_donor['id_riwayat']); ?>">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary"
                                                            data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Batal</span>
                                                        </button>
                                                        <button type="submit" name="btn_hapusriwayat" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                                                            <i class="bx bx-check d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Hapus</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- END MODAL HAPUS -->
                                </tr>
                            <?php
                            endwhile
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Tables end -->