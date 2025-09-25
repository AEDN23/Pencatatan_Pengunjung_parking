<?php
require "config.php";
date_default_timezone_set('Asia/Jakarta');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['qr_data'])) {
        // Proses perubahan status dari "wait" ke "in"
        $qr_data = $_POST['qr_data'];

        $sql = "SELECT id, status FROM tamu WHERE no = '$qr_data'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (strtolower($row['status']) === 'wait') {
                $update_query = "UPDATE tamu SET status = 'in', tanggal_masuk = NOW() WHERE id = {$row['id']}";
                if ($conn->query($update_query)) {
                    echo json_encode(['status' => 'success', 'new_status' => 'In']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui status']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Status bukan "wait"']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'QR tidak valid']);
        }
    } elseif (isset($_POST['id']) && isset($_POST['action']) && $_POST['action'] === 'out') {
        // Proses perubahan status dari "in" ke "out"
        $id = $_POST['id'];

        $update_query = "UPDATE tamu SET status = 'out', tanggal_keluar = NOW() WHERE id = '$id'";
        if ($conn->query($update_query)) {
            header("Location: ../index.php");
        } else {
            echo "Gagal memperbarui status";
        }
    }
}
?>
