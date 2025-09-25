<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tamu WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data) {
        $no_id = $data['no_id'];
        $nama = $data['nama'];
        $no = $data['no'];
        $jumlah = $data['jumlah'];
        $perusahaan = $data['perusahaan'];
        $nomor_kendaraan = $data['nomor_kendaraan'];
        $jenis_kendaraan = $data['jenis_kendaraan'];
        $bertemu_dengan = $data['bertemu_dengan'];
        $sudah_buat_janji = $data['sudah_buat_janji'];
        $tanggal_masuk = $data['tanggal_masuk'];
        $qr_code = $data['qr_code'];
        if (empty($qr_code)) {
            echo "QR code data is empty.";
        }
    } else {
        echo "Data not found.";
        exit;
    }
} else {
    echo "ID not provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tamu</title>
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
        <p style="text-align:left;"><?php echo htmlspecialchars($no); ?></p>
        <p style="text-align:left;"><?php echo htmlspecialchars($nama); ?></p>
        <p style="text-align:left;"><?php echo htmlspecialchars($no_id); ?></p>
        <p style="text-align:left;"><?php echo htmlspecialchars($jumlah); ?> Orang</p>
        <p style="text-align:left;"><?php echo htmlspecialchars($perusahaan); ?></p>
        <p style="text-align:left;"><?php echo htmlspecialchars($nomor_kendaraan); ?></p>
        <p style="text-align:left;"><?php echo htmlspecialchars($jenis_kendaraan); ?></p>
        <p style="text-align:left;"><?php echo htmlspecialchars($bertemu_dengan); ?></p>
        <p style="text-align:left;"><?php echo htmlspecialchars($sudah_buat_janji); ?> Membuat Janji</p>
        <p style="text-align:left;"><?php echo htmlspecialchars($tanggal_masuk); ?></p>

        <div class="qr-code">
            <img src="<?php echo htmlspecialchars($data['qr_code']); ?>" alt="QR Code" />
        </div>

        <div class="tanda-tangan">
            <!-- <div class="kotak-ttd"></div> -->
            <p>
                <!-- <pre>Barcode parkir</pre> -->
            </p>
        </div>
    </div>

    <button class="btn-cetak" onclick="window.print();">Cetak</button>
    <a href="../index.php" style="text-decoration: none;"><button class="btn-cetak">Kembali</button></a>
</body>

</html>