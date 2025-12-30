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
                Data Admin
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
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        $query  = "SELECT * FROM users WHERE role = 'admin' ORDER BY id_user DESC";
                        $result = mysqli_query($koneksi, $query);

                        if (!$result) {
                            echo '<tr><td colspan="7" class="text-center text-danger">Query gagal: ' . htmlspecialchars(mysqli_error($koneksi)) . '</td></tr>';
                        } else if (mysqli_num_rows($result) === 0) {
                            echo '<tr><td colspan="7" class="text-center text-muted">Belum ada data admin.</td></tr>';
                        } else {
                            while ($users = mysqli_fetch_assoc($result)) :
                        ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($users['id_user']); ?></td>
                                    <td><?= htmlspecialchars($users['nama_lengkap']); ?></td>
                                    <td><?= htmlspecialchars($users['username']); ?></td>
                                    <td>
                                        <span class="badge bg-danger">
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