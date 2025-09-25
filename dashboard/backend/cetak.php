<?php
session_start();
if (!isset($_SESSION['data_tamu'])) {
    echo "Data tidak ditemukan!";
    exit();
}

$data = $_SESSION['data_tamu'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Struk</title>
    <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode-generator/qrcode.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }




        .struk {
            width: 300px;
            margin: auto;
            text-align: center;
            border: 1px solid #000;
            padding: 10px;

        }

        .struk h2 {
            margin-bottom: 10px;
        }

        .struk p {
            margin: 5px 0;
        }

        .tanda-tangan {
            text-align: center;
            margin-top: 10px;
            position: relative;
        }

        .kotak-ttd {
            align-items: center;
            margin-left: 25%;
            width: 150px;
            height: 70px;
            border: 1px solid #000;
            margin-top: 10px;
        }

        .btn-cetak {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        @media print {
            @page {
                margin: 0;
                margin-left: 60px;
            }

            body {
                align-items: center;
                text-align: center;
            }

            .tanda-tangan {
                text-align: center;
                margin-top: 10px;
                position: relative;
            }


            .kotak-ttd {
                text-align: right;
                width: 150px;
                height: 70px;
                border: 1px solid #000;
                margin-top: 10px;
            }

            body {
                width: 58mm;
            }

            .struk {
                border: none;
                /* Hilangkan border saat dicetak */
            }

            .btn-cetak {
                display: none;
                /* Sembunyikan tombol cetak */
            }

            a {
                display: none;
                /* Sembunyikan tombol cetak */
            }

            head {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="struk">
        <h2 style="margin-top: 0px;">PT Elastomix Indonesia</h2>
        <p style="text-align:left;">Informasi Data Pengunjung</p>
        <hr>
        <p style="text-align:left;"><?= $data['no']; ?></p>
        <p style="text-align:left;"><?= $data['nama']; ?></p>
        <p style="text-align:left;"><?= $data['no_id']; ?></p>
        <p style="text-align:left;"><?= $data['jumlah']; ?> Orang</p>
        <p style="text-align:left;"><?= $data['perusahaan']; ?></p>
        <p style="text-align:left;"><?= $data['nomor_kendaraan']; ?></p>
        <p style="text-align:left;"><?= $data['jenis_kendaraan']; ?></p>
        <p style="text-align:left;"><?= $data['bertemu_dengan']; ?></p>
        <p style="text-align:left;">Jam Bertemu: <?= date('H.i', strtotime($data['jam_bertemu'])); ?></p>
        <p style="text-align:left;">Tanggal bertemu: <?= $data['tanggal_bertemu']; ?></p>
        <p style="text-align:left;"><?= $data['sudah_buat_janji']; ?> Membuat Janji</p>
        <div class="qr-code">
            <img src="<?= $data['qr_code']; ?>" alt="QR Code" />
        </div>
        <div class="tanda-tangan">
            <!-- <div class="kotak-ttd"></div> -->
            <p>
            <pre>Barcode penggunjung</pre>
            </p>
        </div>
    </div>
    <button class="btn-cetak" onclick="window.print();">download</button>
    <a href="../../" style="text-decoration: none;"><button class="btn-cetak">Kembali</button></a>

</body>

</html>