<div class="page-heading">
    <h3>Selamat datang <?= $sesi_nama; ?> #PahlawanDarah</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">

            <?php include 'status_layak.php'; ?>

            <!-- <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Pengunjung</h6>
                                    <h6 class="font-extrabold mb-0"><?= $totalPengunjung; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Pendonor</h6>
                                    <h6 class="font-extrabold mb-0"><?= $totalPendonor; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Pengguna Baru</h6>
                                    <h6 class="font-extrabold mb-0"><?= $totalPenggunaBaru; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <span class="fa-fw select-all fas text-white"></span>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Kegiatan Donor</h6>
                                    <h6 class="font-extrabold mb-0"><?= $totalKegiatan; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Agenda Donor Darah KSR PMI Unit Darmajaya Terakhir</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Nama Kegiatan</th>
                                            <th>Tanggal</th>
                                            <th>Lokasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include '../functions/koneksi.php';
                                        $no = 1;

                                        // Query dengan users
                                        $query      = "SELECT * FROM kegiatan_donor ORDER BY id_kegiatan DESC LIMIT 3";
                                        $sql_query  = mysqli_query($koneksi, $query);

                                        while ($donor = mysqli_fetch_array($sql_query)) :

                                        ?>
                                            <tr>
                                                <td class="col-4">
                                                    <div class="d-flex align-items-center">
                                                        <p class="font-bold ms-3 mb-0"><?= $donor['nama_kegiatan']; ?></p>
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0"><?= $donor['tanggal_kegiatan']; ?></p>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0"><?= $donor['alamat']; ?></p>
                                                </td>
                                            </tr>
                                        <?php endwhile ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-3 px-4 pb-4">
                    <div class="d-flex">
                        <div class="avatar avatar-lg">
                            <img src="assets/<?= empty($sesi_img) ? 'static/images/faces/1.jpg' : 'profile/' . htmlspecialchars($sesi_img) ?>">
                        </div>
                        <div class="ms-4 name">
                            <h5 class="font-bold mb-1"><?= $sesi_nama; ?></h5>
                            <h6 class="text-muted mb-0">@<?= $sesi_id; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Pengguna Baru Terakhir</h4>
                </div>
                <div class="card-content pb-4">
                    <?php
                    include '../functions/koneksi.php';
                    $no = 1;

                    // Query dengan users
                    $query      = "SELECT * FROM users WHERE role = 'pendonor' ORDER BY id_user DESC LIMIT 3";
                    $sql_query  = mysqli_query($koneksi, $query);

                    while ($users = mysqli_fetch_array($sql_query)) :

                    ?>
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="avatar avatar-lg">
                                <img src="assets/<?= empty($users['img_user']) ? 'static/images/faces/1.jpg' : 'profile/' . htmlspecialchars($users['img_user']) ?>"
                                    onerror="this.src='assets/static/images/faces/1.jpg'">
                            </div>
                            <div class=" name ms-4">
                                <h5 class="mb-1"><?= $users['nama_user']; ?></h5>
                                <h6 class="text-muted mb-0">@<?= $users['id_user']; ?></h6>
                            </div>
                        </div>
                    <?php endwhile ?>
                    <div class="px-4">
                        <a href="?page=data pendonor" class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>