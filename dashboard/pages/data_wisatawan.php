<?php
// Proteksi role
if (!isset($_SESSION['sesi_role']) || $_SESSION['sesi_role'] !== 'admin') {
    return;
}
?>

<section class="section table">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Data Wisatawan
            </h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="example1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID User</th>
                            <th>Nama Lengkap</th>
                            <th>No HP</th>
                            <th>Jenis Kelamin</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        $query  = "SELECT id_user, nama_lengkap, no_hp, jenis_kelamin, role, dibuat_pada
                                   FROM users
                                   WHERE role = 'wisatawan'
                                   ORDER BY dibuat_pada DESC";
                        $result = mysqli_query($koneksi, $query);

                        if (!$result) {
                            echo '<tr><td colspan="7" class="text-center text-danger">Query gagal: ' . htmlspecialchars(mysqli_error($koneksi)) . '</td></tr>';
                        } else if (mysqli_num_rows($result) === 0) {
                            echo '<tr><td colspan="7" class="text-center text-muted">Belum ada data wisatawan.</td></tr>';
                        } else {
                            while ($users = mysqli_fetch_assoc($result)) :
                        ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($users['id_user']); ?></td>
                                    <td><?= htmlspecialchars($users['nama_lengkap']); ?></td>
                                    <td><?= htmlspecialchars($users['no_hp']); ?></td>
                                    <td><?= htmlspecialchars($users['jenis_kelamin']); ?></td>
                                    <td>
                                        <span class="badge bg-primary">
                                            <?= ucfirst(htmlspecialchars($users['role'])); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="admin?page=profil&id=<?= htmlspecialchars($users['id_user']); ?>"
                                            class="btn btn-sm btn-secondary">
                                            Kelola
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            endwhile;
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</section>