<?php
$conn = mysqli_connect("localhost", "root", "", "pendataan_tamu");
require_once('phpqrcode/qrlib.php');

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Path folder untuk menyimpan gambar QR
$qr_folder = '../assets/qr';

// Cek jika form di-submit
if (isset($_POST['addpengunjung'])) {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $nomor_id = $_POST['nomor_id'];
    $jumlah_kendaraan = $_POST['jumlah_kendaraan'];
    $perusahaan = $_POST['perusahaan'];
    $nomor_kendaraan = $_POST['nomor_kendaraan'];
    $jenis_kendaraan = $_POST['jenis_kendaraan'];
    $bertemu = $_POST['bertemu'];
    $janji = $_POST['janji'];
    $keperluan = $_POST['keperluan'];
    $tanggal_bertemu = $_POST['tanggal_bertemu'];
    $jam_bertemu = $_POST['jam_bertemu'];

    // Generate nomor otomatis (YYYYMMDD-XXX)
    $tanggal = date('Ymd'); // Format tanggal hari ini (YYYYMMDD)

    // Hitung jumlah tamu untuk hari ini
    $sql_count = "SELECT COUNT(*) AS jumlah FROM tamu";
    $result = $conn->query($sql_count);
    $row = $result->fetch_assoc();
    $urutan = str_pad($row['jumlah'] + 1, 3, '0', STR_PAD_LEFT);

    $nomor = $tanggal . '-' . $urutan; // Definisi variabel $nomor

    // Generate QR Code
    $qr_data = $nomor; // Gunakan data unik, misalnya nomor tamu
    $qr_filename = $qr_folder . '/' . $nomor . '.png'; // Nama file QR Code
    QRcode::png($qr_data, $qr_filename); // Membuat file QR Code

    // Masukkan data ke database
    $sql_insert = "INSERT INTO tamu 
    (no, nama, no_id, jumlah, perusahaan, nomor_kendaraan, jenis_kendaraan, bertemu_dengan, sudah_buat_janji, keperluan, status, qr_code, tanggal_bertemu, jam_bertemu, tanggal_keluar) 
    VALUES 
    ('$nomor', '$nama', '$nomor_id', '$jumlah_kendaraan', '$perusahaan', '$nomor_kendaraan', '$jenis_kendaraan', '$bertemu', '$janji', '$keperluan', 'wait', '$qr_filename', '$tanggal_bertemu', '$jam_bertemu', NULL)";

    if ($conn->query($sql_insert) === TRUE) {
        // Ambil data yang baru saja dimasukkan
        $id_terakhir = $conn->insert_id;
        $sql_get = "SELECT * FROM tamu WHERE id = $id_terakhir";
        $result_get = $conn->query($sql_get);
        $data = $result_get->fetch_assoc();

        // Simpan data ke session untuk ditampilkan di halaman berikutnya
        session_start();
        $_SESSION['data_tamu'] = $data;

        // Redirect ke halaman cetak
        header("Location: cetak.php");
        exit();
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}
