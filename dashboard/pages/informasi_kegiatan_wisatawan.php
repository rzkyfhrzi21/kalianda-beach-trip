    <?php

    // Memeriksa level user
    if ($_SESSION['sesi_role'] !== 'wisatawan') {
        return;
    }
    ?>

    <!-- Basic Tables start -->
    <section class="section table">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Database Kegiatan Donorku
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
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Target</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <!-- <th class="text-center">Aksi</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../functions/config.php';
                            $no = 1;

                            // Query dengan prepared statement
                            $query      = "SELECT * FROM kegiatan_donor WHERE tanggal_kegiatan >= '$tanggal_sekarang'  ORDER BY tanggal_kegiatan DESC";
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
                                } else if ($tanggal_sekarang > $kegiatan['tanggal_kegiatan']) {
                                    $status_kegiatan = "Selesai";
                                    $kode_kegiatan   = 2;
                                } else if ($tanggal_sekarang < $kegiatan['tanggal_kegiatan']) {
                                    // Calculate the number of days remaining
                                    $tanggal1   = new DateTime($tanggal_sekarang);
                                    $tanggal2   = new DateTime($kegiatan['tanggal_kegiatan']);
                                    $jarak          = $tanggal1->diff($tanggal2);
                                    $hari_tersisa   = $jarak->days; // Get the number of days
                                    $status_kegiatan = $hari_tersisa . " hari lagi";
                                    $kode_kegiatan   = 0;
                                }
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($kegiatan['nama_kegiatan']); ?></td>
                                    <td><?= htmlspecialchars($kegiatan['penyelenggara']); ?></td>
                                    <td><?= htmlspecialchars($kegiatan['tanggal_kegiatan']); ?></td>
                                    <td><?= htmlspecialchars($kegiatan['waktu_mulai']); ?> - <?= htmlspecialchars($kegiatan['waktu_selesai']); ?> WIB</td>
                                    <td><?= htmlspecialchars($kegiatan['target_wisatawan']); ?> wisatawan</td>
                                    <td><?= htmlspecialchars($kegiatan['alamat']); ?></td>
                                    <td class="text-capitalize"><?= $status_kegiatan; ?></td>
                                    <!-- <td class="text-center">
                                        <a href="?page=daftar donor" class="btn btn-sm btn-danger">Daftar Donor</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item <?= $kode_kegiatan == 1 ? '' : 'disabled' ?>" href="admin?page=mulai donor&id=<?= htmlspecialchars($kegiatan['id_kegiatan']); ?>">Mulai Donor</a>
                                        </div>
                                    </td> -->
                                </tr>
                            <?php
                            endwhile;
                            ?>
                            <?php include 'status_layak.php'; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Tables end -->