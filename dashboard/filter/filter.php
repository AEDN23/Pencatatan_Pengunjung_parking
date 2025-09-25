<?php
require "../backend/config.php";

// Ambil parameter filter dari URL
$start_date = isset($_GET['start']) ? $_GET['start'] : null;
$end_date = isset($_GET['end']) ? $_GET['end'] : null;
$month = isset($_GET['month']) ? $_GET['month'] : null;
$year = isset($_GET['year']) ? $_GET['year'] : null;

// Query dasar
$query = "SELECT * FROM tamu";

// Filter kondisi berdasarkan parameter
$conditions = [];

if ($start_date && $end_date) {
    $conditions[] = "tanggal_masuk BETWEEN '$start_date' AND '$end_date'";
}
if ($month && $year) {
    $conditions[] = "YEAR(tanggal_masuk) = '$year' AND MONTH(tanggal_masuk) = '$month'";
}

// Gabungkan kondisi jika ada
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

// Tambahkan urutan berdasarkan tanggal
$query .= " ORDER BY tanggal_masuk DESC";

// Jalankan query
$result = mysqli_query($conn, $query);
?>

<html>

<head>
    <title>Laporan Tamu</title>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../css/buttons.dataTables.min.css">
    <script src="../../../js/jquery.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <script src="../../../js/jquery.dataTables.min.js"></script>
    <script src="../../../js/dataTables.buttons.min.js"></script>
    <script src="../../../js/jszip.min.js"></script>
    <script src="../../../js/pdfmake.min.js"></script>
    <script src="../../../js/buttons.html5.min.js"></script>
    <script src="../../../js/buttons.print.min.js"></script>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Laporan Pengunjung</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="../laporan">Halaman awal</a></li>
            <li class="breadcrumb-item active">Import Dokumen</li>
        </ol>
        <?php
        // Pastikan $start_date dan $end_date memiliki nilai default
        $start_date = isset($_GET['start']) && !empty($_GET['start']) ? $_GET['start'] : date('Y-m-d', strtotime('-7 days')); // Default: 7 hari sebelumnya
        $end_date = isset($_GET['end']) && !empty($_GET['end']) ? $_GET['end'] : date('Y-m-d'); // Default: Hari ini

        // Menampilkan laporan dengan pengecekan null
        if (!empty($start_date) && !empty($end_date)) {
            echo "<p>Laporan pengunjung dari tanggal <b>" . date('d F Y', strtotime($start_date)) . "</b> sampai <b>" . date('d F Y', strtotime($end_date)) . ".</b></p>";
        } else {
            echo "<p>Data laporan tidak tersedia.</p>";
        }
        ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>NO.ID</th>
                        <th>PERUSAHAAN</th>
                        <th>NO KENDARAAN</th>
                        <th>JENIS KENDARAAN</th>
                        <th>JUMLAH</th>
                        <th>TANGGAL MASUK</th>
                        <th>TANGGAL KELUAR</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['no_id']; ?></td>
                            <td><?= $data['perusahaan']; ?></td>
                            <td><?= $data['nomor_kendaraan']; ?></td>
                            <td><?= $data['jenis_kendaraan']; ?></td>
                            <td><?= $data['jumlah']; ?></td>
                            <td><?= $data['tanggal_masuk']; ?></td>
                            <td><?= $data['tanggal_keluar'] ?: 'Belum Keluar'; ?></td>
                            <td><?= ucfirst($data['status']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excel',
                        title: 'Laporan Barang Masuk'
                    },
                    {
                        extend: 'pdf',
                        title: 'Laporan Barang Masuk',
                        orientation: 'landscape'
                    },
                    'print'
                ]
            });
        });
    </script>
</body>

</html>