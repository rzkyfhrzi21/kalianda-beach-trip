<?php

if (empty($_SESSION['sesi_role'])) {
    return;
}


?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Galeri Kegiatan Donor Darah</h3>
                <p class="text-subtitle text-muted">
                    Dokumentasi Kegiatan #AksiNyataKemanusiaan
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav
                    aria-label="breadcrumb"
                    class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
                        <li class="breadcrumb-item active text-capitalize" aria-current="page">
                            <?= $page; ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- GALERI KEGIATAN -->
    <section class="section">
        <div class="row">
            <div class="col-12">
                <?php
                // Ambil galery donor
                $query = "SELECT a.id_galeri, a.id_kegiatan, a.img_kegiatan, b.nama_kegiatan 
                        FROM galeri_kegiatan a
                        JOIN kegiatan_donor b ON a.id_kegiatan = b.id_kegiatan ORDER BY b.id_kegiatan DESC";

                $result = mysqli_query($koneksi, $query);

                if (!$result) {
                    die("Query Failed: " . mysqli_error($koneksi));
                }

                // Initialize an array to store the results
                $kegiatan_array = [];

                // Fetch results and organize them by kegiatan
                while ($kegiatan = mysqli_fetch_assoc($result)) {
                    $id_kegiatan = $kegiatan['id_kegiatan'];
                    $nama_kegiatan = $kegiatan['nama_kegiatan'];

                    // Skip if id_kegiatan is empty
                    if (empty($id_kegiatan)) {
                        continue;
                    }

                    // Store images in an array under the kegiatan ID
                    if (!isset($kegiatan_array[$id_kegiatan])) {
                        $kegiatan_array[$id_kegiatan] = [
                            'nama_kegiatan' => $nama_kegiatan,
                            'images' => []
                        ];
                    }
                    $kegiatan_array[$id_kegiatan]['images'][] = $kegiatan['img_kegiatan'];
                }

                // Loop through each kegiatan and display the gallery
                foreach ($kegiatan_array as $id_kegiatan => $data) {
                    $nama_kegiatan = $data['nama_kegiatan'];
                ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h4 class="card-title"><?= htmlspecialchars($nama_kegiatan); ?></h4>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row gallery">
                                <?php
                                foreach ($data['images'] as $img_kegiatan) {
                                    if (!empty($img_kegiatan)) {
                                        $img_src = "assets/kegiatan/" . htmlspecialchars($img_kegiatan);
                                ?>
                                        <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal"
                                                data-img_kegiatan="<?= htmlspecialchars($img_kegiatan); ?>"
                                                data-img_src="<?= $img_src; ?>">
                                                <img class="w-100" src="<?= $img_src; ?>" alt="<?= htmlspecialchars($nama_kegiatan); ?>">
                                            </a>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="../functions/function_kegiatan.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="galleryModalTitle">Galeri <?= $nama_kegiatan; ?></h5>
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
</div>