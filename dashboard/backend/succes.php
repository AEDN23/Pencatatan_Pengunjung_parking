<?php
if (isset($_GET['no'])) {
    $no = $_GET['no'];
    $sql_last_data = "SELECT * FROM tamu WHERE no = '$no'";
    $result_last_data = $conn->query($sql_last_data);

    if ($result_last_data->num_rows > 0) {
        $data = $result_last_data->fetch_assoc();
        include "link.php";
        echo ' 
        <table class="table table-bordered" id="dataTable" width="30%" cellspacing="3">
            <tr><td>' . $data['no'] . '</td></tr>
            <tr><td>' . $data['nama'] . '</td></tr>
            <tr><td>' . $data['no_id'] . '</td></tr>
            <tr><td>' . $data['jumlah'] . '</td></tr>
            <tr><td>' . $data['perusahaan'] . '</td></tr>
            <tr><td>' . $data['nomor_kendaraan'] . '</td></tr>
            <tr><td>' . $data['jenis_kendaraan'] . '</td></tr>
            <tr><td>' . $data['bertemu_dengan'] . '</td></tr>
            <tr><td>' . $data['sudah_buat_janji'] . '</td></tr>
            <tr><td>' . $data['keperluan'] . '</td></tr>
        </table>
        <br>
        <form method="post" action="print.php">
            <input type="hidden" name="no" value="' . $data['no'] . '">
            <button type="submit" class="btn btn-primary">Cetak PDF / Print</button>
        </form>';
    } else {
        echo "Data tidak ditemukan!";
    }
} else {
    echo "No data provided!";
}
