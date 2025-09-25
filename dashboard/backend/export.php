<?php
$conn = mysqli_connect("localhost", "root", "", "pendataan_tamu");

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>

<html>

<head>
    <title></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>
    <style>
        @media print {
            

             

            #dataTable {
                position: absolute;
                /* Buat tabel tampil penuh halaman */
                left: 0;
                top: 0;
            }

            /* Hilangkan teks tambahan "Exported Data" */
            .dt-buttons {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Data Barang</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="../">Halaman awal</a></li>
            <li class="breadcrumb-item active">Import Dokumen</li>
        </ol>

        <div class="data-tables datatable-dark">

            <table class="table  table-bordered " id="dataTable" width="30%" cellspacing="3">
                <thead>
                    <tr>
                        <th class="text-center">PT ELASTOMIX INDONESIA</th>
                    </tr>
                    <tr>
                        <th>Informasi Data Pengunjung</th>
                        <hr>
                    </tr>
                </thead>
                <tr>
                    <td>Nama Pengunjung</td>
                </tr>
                <tr>
                    <td>NO id pengunjung</td>
                </tr>
                <tr>
                    <td>2 orang</td>
                </tr>
                <tr>
                    <td>PT ELASTOMIX</td>
                </tr>
                <tr>
                    <td>HRD</td>
                </tr>
                <tr>
                    <td>Sudah Membuat janji</td>
                </tr>
                <tr>
                    <td>Meeting HRD</td>
                </tr>
            </table>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excel',
                        title: ''
                    },
                    {
                        extend: 'pdf',
                        title: '.',
                        customize: function(doc) {
                            doc.content[1].table.body.forEach(function(row) {
                                row.forEach(function(cell) {
                                    cell.alignment = 'center';
                                });
                            });
                            doc.pageOrientation = 'landscape';
                            doc.content[1].table.widths = ['*', '*', '*', '*', '*', '*', '*', '*', '*'];
                            doc.content[1].layout = {
                                hLineWidth: function(i) {
                                    return 0.5;
                                },
                                vLineWidth: function(i) {
                                    return 0.5;
                                },
                                hLineColor: function(i) {
                                    return '#000';
                                },
                                vLineColor: function(i) {
                                    return '#000';
                                },
                                fillColor: function(i) {
                                    return (i === 0 || i === doc.content[1].table.body.length) ? '#ccc' : null;
                                }
                            };
                            // Tambahkan pengaturan agar tabel berada di tengah halaman
                            doc.content[1].margin = [0, 0, 0, 0]; // Hapus margin bawaan tabel
                            doc.content[1].alignment = 'center'; // Rata tengah seluruh tabel
                        }
                    },
                    'print'
                ]
            });
        });
    </script>

    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/buttons.flash.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>


</body>

</html>