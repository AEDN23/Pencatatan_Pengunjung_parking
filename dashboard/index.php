<?php
$title = "DATA TAMU";
require "BackEnd/config.php";
include "layout/header.php";
session_start();


if (!isset($_SESSION['id']) || !isset($_SESSION['role'])) {
    header("Location: login");
    exit();
}

// if ($row['role'] == 'petugas') {
//     header("Location: index"); 
//     exit();
// }
?>

<main>
    <div class="container-fluid" style="margin-top: 50px;">

        <h5>Masukkan QR Code</h5>
        <form onsubmit="submitQR(event)">
            <input type="text" id="qr_input" placeholder="Scan QR dengan barcode scanner" required>
            <button type="submit">Update Status</button>
        </form>
        <div id="status_message"></div>

        <script>
            function submitQR(event) {
                event.preventDefault(); // Mencegah reload halaman default

                // Ambil nilai input QR Code
                const qrData = document.getElementById('qr_input').value;

                // Kirim data QR Code ke server
                fetch('backend/change_status.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `qr_data=${qrData}`,
                    })
                    .then(response => response.json()) // Mengambil respon dalam format JSON
                    .then(data => {
                        if (data.status === 'success') {
                            // Menampilkan status yang berhasil diperbarui
                            document.getElementById('status_message').innerText = `Status berhasil diperbarui ke ${data.new_status}`;

                            // Menunggu 1 detik sebelum melakukan refresh halaman
                            setTimeout(() => {
                                location.reload(); // Refresh halaman setelah delay
                            }, 1000);
                        } else {
                            // Menampilkan pesan error jika gagal
                            document.getElementById('status_message').innerText = `Error: ${data.message}`;
                        }

                        // Mengosongkan input setelah submit
                        document.getElementById('qr_input').value = '';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        </script>

        <div class="card mb-4 mt-2">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered" width="100%" cellspacing="0" style="font-size: 0.8rem;">
                        <!-- <table class="table table-hover table-striped table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 0.8rem;"> -->
                        <thead class="text-center">
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>TANGGAL BERTEMU</th>
                                <th>JAM BERTEMU</th>
                                <th>NO.ID</th>
                                <th>PERUSAHAAN</th>
                                <th>NO KENDARAAN</th>
                                <th>JENIS KENDARAAN</th>
                                <th>JUMLAH</th>
                                <th>BERTEMU DENGAN</th>
                                <th>SUDAH BUAT JANJI</th>
                                <th>TANGGAL MASUK</th>
                                <th>TANGGAL KELUAR</th>
                                <th>STATUS</th>
                                <th>DETAIL</th>

                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            // $sql = "SELECT * FROM tamu ORDER BY LEFT(no_id, 8) DESC, RIGHT(no_id, 3) DESC";
                            $sql = "SELECT * FROM tamu ORDER BY created_at DESC";

                            $result = $conn->query($sql);

                            $i = 1;

                            while ($data = mysqli_fetch_array($result)) {
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
                                $tanggal_keluar = $data['tanggal_keluar'];
                                $status = $data['status'];

                            ?>
                                <tr class="text-center">
                                    <td><?= $no; ?></td>
                                    <td><?= $nama; ?></td>
                                    <td><?= date('Y-m-d', strtotime($data['tanggal_bertemu'])); ?></td>
                                    <td><?= date('H : i', strtotime($data['jam_bertemu'])); ?></td>
                                    <td><?= $no_id; ?></td>
                                    <td><?= $perusahaan; ?></td>
                                    <td><?= $nomor_kendaraan; ?></td>
                                    <td><?= $jenis_kendaraan; ?></td>
                                    <td><?= $jumlah; ?></td>
                                    <td><?= $bertemu_dengan; ?></td>
                                    <td><?= $sudah_buat_janji; ?></td>
                                    <td><?= $tanggal_masuk ? date('Y-m-d H:i', strtotime($tanggal_masuk)) : 'Belum Masuk'; ?></td>
                                    <td><?= $tanggal_keluar ? date('Y-m-d H:i', strtotime($tanggal_keluar)) : 'Belum Keluar'; ?></td>
                                    <td>
                                        <?php if (strtolower($data['status']) === 'in') { ?>
                                            <form method="POST" action="backend/change_status.php" style="display: inline;">
                                                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                                                <button type="submit" name="action" value="out" class="btn btn-primary">IN</button>
                                            </form>
                                        <?php } elseif (strtolower($data['status']) === 'wait') { ?>
                                            <span class="badge bg-warning">WAIT</span>
                                        <?php } else { ?>
                                            <span class="badge bg-danger">SELESAI</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="backend/detail.php?id=<?= $data['id']; ?>" class="btn btn-primary">Detail</a>
                                </tr>
                            <?php
                            };
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include "layout/footer.php";
?>