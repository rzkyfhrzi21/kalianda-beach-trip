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
                    Kegiatan Donor Darah Hari Ini
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Penyelenggara</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Target</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
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
                                    <td><?= $kegiatan['tanggal_kegiatan']; ?></td>
                                    <td><?= $kegiatan['waktu_mulai']; ?> - <?= $kegiatan['waktu_selesai']; ?> WIB</td>
                                    <td><?= $kegiatan['target_pendonor']; ?></td>
                                    <td><?= $kegiatan['alamat']; ?></td>
                                    <td class="text-capitalize"><?= $status_kegiatan; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group dropup  me-1 mb-1">
                                            <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                data-reference="parent">Pilih
                                            </button>
                                            <div class="dropdown-menu">
                                                <h6 class="dropdown-header text-capitalize">Kegiatan <?= $status_kegiatan; ?></h6>
                                                <a class="dropdown-item" href="admin?page=riwayat donor&id=<?= htmlspecialchars($kegiatan['id_kegiatan']); ?>">Riwayat</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item <?= $kode_kegiatan == 1 ? '' : 'disabled' ?>" href="admin?page=cek kesehatan&id=<?= htmlspecialchars($kegiatan['id_kegiatan']); ?>">Mulai Donor</a>
                                            </div>
                                        </div>
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