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
                    Daftar Kegiatan Donor Darah
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

                            // Query dengan prepared statement
                            $query      = "SELECT * FROM kegiatan_donor ORDER BY tanggal_kegiatan DESC";
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
                                    <td><?= htmlspecialchars($kegiatan['target_pendonor']); ?> Pendonor</td>
                                    <td><?= htmlspecialchars($kegiatan['alamat']); ?></td>
                                    <td class="text-capitalize"><?= $status_kegiatan; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group dropdown me-1 mb-1">
                                            <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                data-reference="parent">Pilih
                                            </button>
                                            <div class="dropdown-menu">
                                                <h6 class="dropdown-header text-capitalize">Kegiatan <?= $status_kegiatan; ?></h6>
                                                <a class="dropdown-item" href="admin?page=detail kegiatan&id=<?= htmlspecialchars($kegiatan['id_kegiatan']); ?>">Details</a>
                                                <a class="dropdown-item" href="admin?page=riwayat donor&id=<?= htmlspecialchars($kegiatan['id_kegiatan']); ?>">Riwayat</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item <?= $kode_kegiatan == 1 ? '' : 'disabled' ?>" href="admin?page=mulai donor&id=<?= htmlspecialchars($kegiatan['id_kegiatan']); ?>">Mulai Donor</a>
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
    <!-- GALERI KEGIATAN -->
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="card-title">Galeri Kegiatan Donorku</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row gallery">
                            <?php
                            // Ambil data user berdasarkan id
                            $query = "SELECT * FROM galeri_kegiatan ORDER BY id_galeri ASC";
                            $sql = mysqli_query($koneksi, $query);

                            while ($galeri = mysqli_fetch_array($sql)) :
                                $id_galeri    = isset($galeri['id_galeri']) ? $galeri['id_galeri'] : '';
                                $img_kegiatan = isset($galeri['img_kegiatan']) ? $galeri['img_kegiatan'] : '';
                            ?>
                                <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal" data-img_kegiatan="<?= $img_kegiatan; ?>" data-img_id="<?= $id_galeri; ?>" data-img_src="assets/<?= empty($img_kegiatan) ? '' : 'kegiatan/' . htmlspecialchars($img_kegiatan) ?>">
                                        <img class="w-100" src="assets/<?= empty($img_kegiatan) ? '' : 'kegiatan/' . htmlspecialchars($img_kegiatan) ?>">
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="../functions/function_kegiatan.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="galleryModalTitle">Galeri Kegiatan Donorku</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="modalImage" class="d-block w-100" src="" alt="Gambar Galeri">
                    </div>
                    <input type="hidden" name="id_kegiatanhapus" value="<?= $id_kegiatan; ?>">
                    <input type="hidden" name="id_galerihapus" id="id_galerihapus" value="">
                    <input type="hidden" name="img_kegiatanhapus" id="img_kegiatanhapus" value="">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // JavaScript untuk mengisi modal dengan gambar yang diklik
        document.addEventListener('DOMContentLoaded', function() {
            const galleryImages = document.querySelectorAll('.gallery a');
            const modalImage = document.getElementById('modalImage');
            const idImageInput = document.getElementById('id_galerihapus');
            const imgKegiatanInput = document.getElementById('img_kegiatanhapus');

            galleryImages.forEach(image => {
                image.addEventListener('click', function() {
                    const imgSrc = this.getAttribute('data-img_src');
                    const imgId = this.getAttribute('data-img_id');
                    const imgKegiatan = this.getAttribute('data-img_kegiatan');
                    modalImage.src = imgSrc; // Set src gambar modal
                    idImageInput.value = imgId; // Set src gambar modal
                    imgKegiatanInput.value = imgKegiatan; // Set src gambar modal
                });
            });
        });
    </script>
    <!-- GALERI KEGIATAN -->
    <!-- Basic Tables end -->