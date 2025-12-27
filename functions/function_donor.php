<?php

include 'koneksi.php';
session_start();

ob_start();

function uploadImg()
{
    $nama_img     = $_FILES['img_donor']['name'];
    $size_img     = $_FILES['img_donor']['size'];
    $tmp_name     = $_FILES['img_donor']['tmp_name'];

    $valid_img    = ['jpg', 'jpeg', 'png'];
    $extensi_img  = strtolower(pathinfo($nama_img, PATHINFO_EXTENSION));

    if (!in_array($extensi_img, $valid_img)) {
        echo "<script>alert('Ekstensi gambar tidak valid!');location.replace('../dashboard/admin?page=profile');</script>";
    } else if ($size_img > 1000000) {
        echo "<script>alert('Ukuran gambar terlalu besar (maks 1MB)!');location.replace('../dashboard/admin?page=profile');</script>";
    } else {
        $img_baru = uniqid() . '.' . $extensi_img;
        move_uploaded_file($tmp_name, '../dashboard/assets/donor/' . $img_baru);
        return $img_baru;
    }
}

// =====================================================
// 🧍‍♂️ FORM PENDAFTARAN DONOR
// =====================================================
if (isset($_POST['btn_daftardonor'])) {

    $nama_user        = htmlspecialchars(trim($_POST['nama_user']));
    $id_kegiatan      = htmlspecialchars(trim($_POST['id_kegiatan']));
    $tanggal_kegiatan = htmlspecialchars(trim($_POST['tanggal_kegiatan']));
    $email_user       = htmlspecialchars(trim($_POST['email_user'] ?? ''));

    $keadaan_sehat      = $_POST['keadaan_sehat'] ?? '';
    $gejala             = $_POST['gejala'] ?? '';
    $hamil              = $_POST['hamil'] ?? '';
    $vaksin             = $_POST['vaksin'] ?? '';
    $transfusi          = $_POST['transfusi'] ?? '';
    $tindik             = $_POST['tindik'] ?? '';
    $obat               = $_POST['obat'] ?? '';
    $usia               = $_POST['usia'] ?? '';
    $haid               = $_POST['haid'] ?? '';
    $terakhir_donor     = $_POST['terakhir_donor'] ?? '';
    $riwayat_penyakit   = $_POST['riwayat_penyakit'] ?? '';

    // ===============================
    // 💉 Validasi kelayakan pendonor
    // ===============================
    if (
        $keadaan_sehat === 'Tidak' || $gejala === 'Ya' || $hamil === 'Ya' ||
        $vaksin === 'Ya' || $riwayat_penyakit === 'Ya' || $transfusi === 'Ya' || $tindik === 'Ya' ||
        $obat === 'Ya' || $haid === 'Ya' || $terakhir_donor === '<2 bulan lalu' || $usia < 17 || $usia > 65
    ) {
        $status = 'tidak berhasil';
        $ket = 'gagal';
        $keterangan = 'Anda belum memenuhi syarat donor darah.';
    } else {
        $status = 'layak';
        $keterangan = 'Anda memenuhi semua syarat untuk mendonorkan darah.';
    }

    // Simpan ke database
    $query_daftar = "INSERT INTO riwayat_donor 
                        SET 
                            nama_user='$nama_user', 
                            id_kegiatan='$id_kegiatan',
                            tanggal_kegiatan='$tanggal_kegiatan',
                            usia='$usia',
                            sesi_donor=1,
                            status='$status',
                            keterangan='$keterangan'";
    $sql_daftar = mysqli_query($koneksi, $query_daftar);

    // =====================================
    // 📩 Kirim Email jika status = gagal
    // =====================================
    if ($sql_daftar && $status === 'tidak berhasil') {
        $data_notif = [
            'email_user' => $email_user,
            'kode_pesan' => 0,
            'nama_user' => $nama_user,
            'tanggal_kegiatan' => $tanggal_kegiatan
        ];

        // Gunakan CURL agar function_notif.php dijalankan terpisah
        $ch = curl_init("http://localhost/app-donor/functions/function_notif.php");
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data_notif,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 5
        ]);
        curl_exec($ch);
        curl_close($ch);
    }


    // =====================================
    // 🔁 Redirect setelah submit
    // =====================================
    if ($sql_daftar && $status === 'layak') {
        header('Location: ../dashboard/pendonor?page=riwayat donor&action=daftardonor&status=success');
    } else if ($sql_daftar && $status === 'tidak berhasil') {
        header('Location: ../dashboard/pendonor?page=riwayat donor&action=daftardonor&status=warning&ket=' . $ket);
    } else {
        $error = mysqli_error($koneksi);
        header('Location: ../dashboard/pendonor?page=mulai donor&action=daftardonor&status=error&message=' . urlencode($error));
    }
    exit();
}

// =====================================================
// 💉 FORM MULAI DONOR (dengan notifikasi email otomatis)
// =====================================================
if (isset($_POST['btn_mulaidonor'])) {
    $id_riwayat        = htmlspecialchars(trim($_POST['id_riwayat']));
    $id_kegiatan       = htmlspecialchars(trim($_POST['id_kegiatan']));
    $nama_user         = htmlspecialchars(trim($_POST['nama_user']));
    $tanggal_kegiatan  = htmlspecialchars(trim($_POST['tanggal_kegiatan']));
    $email_user        = htmlspecialchars(trim($_POST['email_user'] ?? ''));

    $gol_darah         = htmlspecialchars(trim($_POST['gol_darah']));
    $usia              = htmlspecialchars(trim($_POST['usia']));
    $berat_badan       = htmlspecialchars(trim($_POST['berat_badan']));
    $nilai_hb          = htmlspecialchars(trim($_POST['nilai_hb']));
    $sistolik          = htmlspecialchars(trim($_POST['sistolik']));
    $diastolik         = htmlspecialchars(trim($_POST['diastolik']));
    $data_sesuai       = htmlspecialchars(trim($_POST['data_sesuai']));
    $tekanan_darah     = $sistolik . '/' . $diastolik;

    // Ambil batas kriteria donor terbaru
    $sql_donor = "SELECT * FROM kriteria_donor ORDER BY id_kriteria DESC LIMIT 1";
    $query_donor = mysqli_query($koneksi, $sql_donor);
    $kriteria = mysqli_fetch_array($query_donor);

    // ===========================
    // 🔍 Validasi kesehatan donor
    // ===========================
    if (
        $berat_badan < $kriteria['bb_minimal'] ||
        $nilai_hb < $kriteria['hb_minimal'] || $nilai_hb > $kriteria['hb_maksimal'] ||
        $sistolik < $kriteria['sistolik_minimal'] || $sistolik > $kriteria['sistolik_maksimal'] ||
        $diastolik < $kriteria['diastolik_minimal'] || $diastolik > $kriteria['diastolik_maksimal'] ||
        $data_sesuai == 'tidak'
    ) {
        $status = 'tidak berhasil';
        $ket = 'gagal';
        $keterangan = 'Donor gagal karena tidak memenuhi syarat kesehatan.';
    } else {
        $status = 'berhasil';
        $keterangan = 'Donor darah berhasil dilakukan. Terima kasih atas partisipasi Anda!';
    }

    // Simpan hasil pemeriksaan ke database
    $query_update = "UPDATE riwayat_donor 
                        SET 
                            nama_user='$nama_user', 
                            id_kegiatan='$id_kegiatan', 
                            gol_darah='$gol_darah', 
                            tanggal_kegiatan='$tanggal_kegiatan', 
                            berat_badan='$berat_badan', 
                            nilai_hb='$nilai_hb', 
                            tekanan_darah='$tekanan_darah',
                            status='$status', 
                            keterangan='$keterangan' 
                        WHERE id_riwayat='$id_riwayat'";
    $update = mysqli_query($koneksi, $query_update);

    // ===================================================
    // 📧 Kirim Email: berhasil (1) atau gagal pemeriksaan (2)
    // ===================================================
    if ($update) {
        $kode_pesan = ($status == 'berhasil') ? '1' : '2'; // ✅ sesuai aturan baru

        $data_notif = [
            'email_user' => $email_user,
            'kode_pesan' => $kode_pesan,
            'nama_user' => $nama_user,
            'tanggal_kegiatan' => $tanggal_kegiatan
        ];

        // Gunakan CURL agar tidak mengganggu redirect
        $ch = curl_init("http://localhost/app-donor/functions/function_notif.php");
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data_notif,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 5
        ]);
        curl_exec($ch);
        curl_close($ch);
    }

    // ===================================================
    // 🔁 Redirect ke halaman hasil
    // ===================================================
    if ($update && $status == 'berhasil') {
        header('Location: ../dashboard/admin?page=cek kesehatan&id=' . $id_kegiatan . '&action=mulaidonor&status=success');
    } else if ($update && $status == 'tidak berhasil') {
        header('Location: ../dashboard/admin?page=cek kesehatan&id=' . $id_kegiatan . '&action=mulaidonor&status=warning&ket=' . $ket);
    } else {
        $error = mysqli_error($koneksi);
        header('Location: ../dashboard/admin?page=cek kesehatan&id=' . $id_kegiatan . '&action=mulaidonor&status=error&message=' . urlencode($error));
    }
    exit();
}


// =====================================================
// 🗑️ HAPUS RIWAYAT DONOR
// =====================================================
if (isset($_POST['btn_hapusriwayat'])) {
    $id_riwayat = htmlspecialchars($_POST['id_riwayat']);
    $query = "DELETE FROM riwayat_donor WHERE id_riwayat = '$id_riwayat'";
    $hapus = mysqli_query($koneksi, $query);

    if ($hapus) {
        header('Location: ../dashboard/admin?page=riwayat donor&action=deleteriwayat&status=success');
    } else {
        $error = mysqli_error($koneksi);
        header('Location: ../dashboard/admin?page=riwayat donor&action=deleteriwayat&status=error&message=' . urlencode($error));
    }
}

ob_end_flush();
