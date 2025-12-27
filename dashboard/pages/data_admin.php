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
                    Database Admin Donorku
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>No Telp</th>
                                <th>Gol Darah</th>
                                <th>JK</th>
                                <th>Jumlah Donor</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../functions/koneksi.php';
                            $no = 1;

                            // Query dengan users
                            $query      = "SELECT * FROM users WHERE role = 'admin' ORDER BY id_user ASC";
                            $sql_query  = mysqli_query($koneksi, $query);

                            while ($users = mysqli_fetch_array($sql_query)) :
                                $id     = $users['id_user'];
                                $nama   = $users['nama_user'];
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($users['id_user']); ?></td>
                                    <td><?= htmlspecialchars($users['nama_user']); ?></td>
                                    <td><?= htmlspecialchars($users['no_telp']); ?></td>
                                    <td><?= htmlspecialchars($users['gol_darah']); ?></td>
                                    <td><?= htmlspecialchars($users['jenis_kelamin']); ?></td>
                                    <?php
                                    include '../functions/koneksi.php';
                                    // Query jumlah donor
                                    $sql_jumlahDonor = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_donor FROM riwayat_donor WHERE nama_user = '$nama' && status = 'berhasil' ");
                                    $jumlahDonor = mysqli_fetch_assoc($sql_jumlahDonor)['jumlah_donor'];
                                    ?>
                                    <td><?= $jumlahDonor; ?></td>
                                    <td>
                                        <a href="admin?page=profile&id=<?= htmlspecialchars($users['id_user']); ?>" class="btn btn-secondary">Edit/Delete</a>
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