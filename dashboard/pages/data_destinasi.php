<?php
if ($_SESSION['sesi_role'] !== 'admin') return;
?>

<section class="section table">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Destinasi Wisata</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="example1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Destinasi</th>
                            <th>Lokasi</th>
                            <th>Kontak Pengelola</th>
                            <th>Harga</th>
                            <th>Jam Operasional </th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        $query = "SELECT * FROM destinasi_wisata ORDER BY id_destinasi DESC";
                        $sql = mysqli_query($koneksi, $query);

                        while ($row = mysqli_fetch_assoc($sql)) :
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row['nama_destinasi']); ?></td>
                                <td><?= htmlspecialchars($row['lokasi']); ?></td>
                                <td><?= htmlspecialchars($row['kontak_pengelola']); ?></td>
                                <td>Rp <?= number_format($row['harga_per_orang']); ?></td>
                                <td><?= htmlspecialchars($row['jam_buka']) . " - " . htmlspecialchars($row['jam_tutup']); ?></td>
                                <td class="text-center">
                                    <a href="admin?page=detail destinasi&id=<?= $row['id_destinasi']; ?>"
                                        class="btn btn-sm btn-primary">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</section>