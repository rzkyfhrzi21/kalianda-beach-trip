<script src="assets/extensions/jquery/jquery.min.js"></script>
<script src="assets/static/js/components/dark.js"></script>
<script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/static/js/pages/horizontal-layout.js"></script>
<script src="assets/compiled/js/app.js"></script>

<!-- Need: Apexcharts -->
<script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="assets/extensions/dayjs/dayjs.min.js"></script>
<script src="assets/static/js/pages/ui-apexchart.js"></script>
<script src="assets/static/js/pages/dashboard.js"></script>
<script>
    // Mengambil data dari PHP
    let totalLakiLaki = <?= $totalPendonorLakiLaki; ?>; // Menggunakan data dari PHP
    let totalPerempuan = <?= $totalPendonorPerempuan; ?>; // Menggunakan data dari PHP

    let optionsPendonorJK = {
        series: [totalLakiLaki, totalPerempuan], // Menggunakan variabel yang diambil dari PHP
        labels: ["Laki-laki", "Perempuan"],
        colors: ["#435ebe", "#55c6e8"],
        chart: {
            type: "donut",
            width: "100%",
            height: "350px",
        },
        legend: {
            position: "bottom",
        },
        plotOptions: {
            pie: {
                donut: {
                    size: "30%",
                },
            },
        },
    };

    var chartPendonorJK = new ApexCharts(
        document.getElementById("chart-pendonor-jk"),
        optionsPendonorJK
    );
    chartPendonorJK.render();
</script>
<script>
    // Mengambil data dari PHP
    let totalBerhasil = <?= $totalPendonorBerhasil; ?>; // Menggunakan data dari PHP
    let totalLayak = <?= $totalPendonorLayak; ?>; // Menggunakan data dari PHP
    let totalGagal = <?= $totalPendonorGagal; ?>; // Menggunakan data dari PHP

    let optionsRiwayatDonor = {
        series: [totalBerhasil, totalLayak, totalGagal], // Menggunakan variabel yang diambil dari PHP
        labels: ["Berhasil Donor", "Layak Tidak Donor", "Gagal Donor"],
        colors: ["#C82232", "#FEDA6F", "#000000"],
        chart: {
            type: "donut",
            width: "100%",
            height: "350px",
        },
        legend: {
            position: "bottom",
        },
        plotOptions: {
            pie: {
                donut: {
                    size: "30%",
                },
            },
        },
    };

    var chartRiwayatDonor = new ApexCharts(
        document.getElementById("chart-riwayat-donor"),
        optionsRiwayatDonor
    );
    chartRiwayatDonor.render();
</script>
<script>
    // Mengambil data dari PHP
    let totalSelesai = <?= $totalKegiatanSelesai; ?>; // Menggunakan data dari PHP
    let totalBerlangsung = <?= $totalKegiatanBerlangsung; ?>; // Menggunakan data dari PHP
    let totalSegera = <?= $totalKegiatanSegera; ?>; // Menggunakan data dari PHP

    let optionsRiwayatKegiatan = {
        series: [totalSelesai, totalBerlangsung, totalSegera], // Menggunakan variabel yang diambil dari PHP
        labels: ["Kegiatan Selesai", "Sedang Berlangsung", "Segera"],
        colors: ["#F44336", "#FFC107", "#4CAF50"],
        chart: {
            type: "donut",
            width: "100%",
            height: "350px",
        },
        legend: {
            position: "bottom",
        },
        plotOptions: {
            pie: {
                donut: {
                    size: "30%",
                },
            },
        },
    };

    var chartRiwayatKegiatan = new ApexCharts(
        document.getElementById("chart-riwayat-kegiatan"),
        optionsRiwayatKegiatan
    );
    chartRiwayatKegiatan.render();
</script>

<!-- Custom Sweet Alert 2 -->
<script src="assets/extensions/sweetalert2/sweetalert2.min.js"></script>
<?php include 'sweetalert.php'; ?>

<!-- Choices -->
<script src="assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
<script src="assets/static/js/pages/form-element-select.js"></script>

<!-- Form Parsley -->
<script src="assets/extensions/parsleyjs/parsley.min.js"></script>
<script src="assets/static/js/pages/parsley.js"></script>

<!-- Datetime Picker -->
<script src="assets/extensions/flatpickr/flatpickr.min.js"></script>
<script src="assets/static/js/pages/date-picker.js"></script>

<!-- Image Upload -->
<script src="assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
<script src="assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js"></script>
<script src="assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
<script src="assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js"></script>
<script src="assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js"></script>
<script src="assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
<script src="assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js"></script>
<script src="assets/extensions/filepond/filepond.js"></script>
<script src="assets/extensions/toastify-js/src/toastify.js"></script>
<script src="assets/static/js/pages/filepond.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const checkbox = document.getElementById("iaggree");
        const buttonDeleteAccount = document.getElementById("btn-delete-account");

        if (checkbox && buttonDeleteAccount) { // Pastikan elemen ada
            checkbox.addEventListener("change", function() {
                const checked = checkbox.checked;
                if (checked) {
                    buttonDeleteAccount.removeAttribute("disabled");
                } else {
                    buttonDeleteAccount.setAttribute("disabled", true);
                }
            });
        }
    });
</script>



<!-- Datatables -->
<script src="assets/extensions/datatables/jquery.dataTables.min.js"></script>
<script src="assets/extensions/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/extensions/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/extensions/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/extensions/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/extensions/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets/extensions/jszip/jszip.min.js"></script>
<script src="assets/extensions/pdfmake/pdfmake.min.js"></script>
<script src="assets/extensions/pdfmake/vfs_fonts.js"></script>
<script src="assets/extensions/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets/extensions/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets/extensions/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>