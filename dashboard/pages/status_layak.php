 <?php
    include '../functions/koneksi.php';

    $query      = "SELECT a.nama_kegiatan, a.alamat, a.id_kegiatan, a.waktu_mulai, a.waktu_selesai, b.nama_user, b.status, b.id_kegiatan, b.tanggal_kegiatan, b.sesi_donor FROM kegiatan_donor a, riwayat_donor b WHERE a.id_kegiatan = b.id_kegiatan AND b.tanggal_kegiatan = '$tanggal_sekarang' AND b.nama_user = '$sesi_nama'";

    $sql_alert  = mysqli_query($koneksi, $query);
    $alert      = mysqli_fetch_array($sql_alert);
    $sesi_donor = @$alert['sesi_donor'];
    ?>

 <?php if (!empty($alert) && $alert['status'] == 'layak') {

    ?>
     <tr>
         <div class="card">
             <div class="card-body">
                 <div class="alert alert-danger">
                     <h4 class="alert-heading">Pemberitahuan!</h4>
                     <p>Anda telah terdaftar sebagai Pendonor Layak pada <b><?= htmlspecialchars($alert['nama_kegiatan']); ?></b>. Silahkan datang ke lokasi donor pada :<br><br>
                     <div class="mr-1">Tempat :</div> <?= htmlspecialchars($alert['alamat']); ?> <br>
                     <div class="mr-1">Waktu : </div><?= htmlspecialchars($alert['waktu_mulai']); ?> - <?= htmlspecialchars($alert['waktu_selesai']); ?> WIB</p><br>
                     Contact Person : <a href="https://wa.me/6287869026613?text=Halo%20kak%20Fauziah,%20saya%20ingin%20mulai%20donor%20darah." target="_blank">
                         KSR PMI Unit Darmajaya
                     </a>
                     </b>
                 </div>
             </div>
         </div>
     </tr>
 <?php
    } else {
        return;
    }
