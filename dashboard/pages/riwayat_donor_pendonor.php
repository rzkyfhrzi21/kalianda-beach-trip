    <?php

    // Memeriksa level user
    if ($_SESSION['sesi_role'] !== 'pendonor') {
        return;
    }

    ?>

    <!-- Basic Tables start -->
    <section class="section table">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Riwayat Donor Saya
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="example3">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Kegiatan</th>
                                <th>Tgl Donor</th>
                                <th>Gol Darah</th>
                                <th>Berat Badan</th>
                                <th>Nilai HB</th>
                                <th>Tekanan Darah</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../functions/koneksi.php';

                            $no     = 1;
                            $query_riwayat  = "SELECT * FROM riwayat_donor WHERE nama_user = '$sesi_nama' ORDER BY id_riwayat DESC";

                            $sql_riwayat    = mysqli_query($koneksi, $query_riwayat);

                            while ($riwayat_donor = mysqli_fetch_array($sql_riwayat)) :
                                // // Tentukan badge berdasarkan hasil
                                if ($riwayat_donor['status'] == 'tidak berhasil') {
                                    $badgeDonor = 'bg-danger';
                                } else if ($riwayat_donor['status'] == 'layak') {
                                    $badgeDonor = 'bg-warning';
                                } else {
                                    $badgeDonor = 'bg-success';
                                }
                                $riwayat_nama   = $riwayat_donor['id_kegiatan'];

                                $sql_kegiatan   = mysqli_query($koneksi, "SELECT nama_kegiatan, penyelenggara, alamat, waktu_mulai, waktu_selesai FROM kegiatan_donor where id_kegiatan = '$riwayat_nama'");
                                $kegiatan       = mysqli_fetch_array($sql_kegiatan);

                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($kegiatan['nama_kegiatan']); ?></td>
                                    <td><?= htmlspecialchars($riwayat_donor['tanggal_kegiatan']); ?></td>
                                    <td><?= htmlspecialchars($riwayat_donor['gol_darah']); ?></td>
                                    <td><?= htmlspecialchars($riwayat_donor['berat_badan']); ?></td>
                                    <td><?= htmlspecialchars($riwayat_donor['nilai_hb']); ?></td>
                                    <td><?= htmlspecialchars($riwayat_donor['tekanan_darah']); ?></td>
                                    <td>
                                        <span class="badge <?= $badgeDonor; ?> text-capitalize"><?= htmlspecialchars($riwayat_donor['status']); ?></span>
                                    </td>
                                    <td><?= htmlspecialchars($riwayat_donor['keterangan']); ?></td>
                                </tr>
                            <?php
                            endwhile
                            ?>
                            <?php include 'status_layak.php'; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
    <!-- Basic Tables end -->