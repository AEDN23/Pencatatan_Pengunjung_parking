<?php
require_once("dashboard/backend/config.php");
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Pengunjung - PT. Elastomix Indonesia</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/img/images.jpg" rel="icon">
  <link href="../css/bootstrap@5.3.3.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="../css/styles.css" rel="stylesheet" />
  <link href="../css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
  <script src="../js/jquery-3.6.0.min.js"></script>
  <script src="../js/bundle.js"></script>
  <script src="../js/all.min.js" crossorigin="anonymous"></script>
  <style>
    body {
      background-image: url(../assets/img/WhatsApp\ Image\ 2024-12-04\ at\ 08.39.56_4fb37ef0.jpg);
      background-size: cover;
      background-position: center;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      background-color: rgba(255, 255, 255, 0.8);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1), 0 0 5px rgba(0, 0, 0, 0.2);
      border: 1px solid black;
    }

    @media (max-width: 576px) {
      .container {
        padding: 10px;
        width: 100%;
        margin: 10px;
      }
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <form action="dashboard/backend/config.php" method="POST">
      <h2 class="text-center mb-4">Form Data Pengunjung</h2>
      <div class="mb-3">
        <label for="tanggal_bertemu">Tanggal Bertemu:</label>
        <input type="date" class="form-control" id="tanggal_bertemu" name="tanggal_bertemu" placeholder="Tanggal Bertemu" required onclick="this.showPicker()" />
      </div>
      <div class="mb-3">
        <label for="jam_bertemu">Jam Bertemu:</label>
        <input type="time" class="form-control" id="jam_bertemu" name="jam_bertemu" placeholder="Jam Bertemu" required />
      </div>
      <div class="mb-3">
        <input type="hidden" class="form-control" id="nomor" name="nomor" readonly />
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama:" required />
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" id="nomor_id" name="nomor_id" placeholder="Nomor Id:" required />
      </div>
      <div class="mb-3">
        <input type="number" class="form-control" id="jumlah_kendaraan" name="jumlah_kendaraan" placeholder="Jumlah Kendaraan" required />
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" id="perusahaan" name="perusahaan" placeholder="Perusahaan" required />
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" id="nomor_kendaraan" name="nomor_kendaraan" placeholder="No Kendaraan" required />
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" id="jenis_kendaraan" name="jenis_kendaraan" placeholder="Jenis Kendaraan" required />
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" id="bertemu" name="bertemu" placeholder="Bertemu Dengan" required />
      </div>
      <div class="mb-3">
        <select name="janji" id="janji" class="form-control" required>
          <option value="" hidden selected>Sudah Membuat Janji?</option>
          <option value="Sudah">Sudah</option>
          <option value="Belum">Belum</option>
        </select>
      </div>
      <div class="mb-3">
        <textarea class="form-control" id="keperluan" name="keperluan" placeholder="Keperluan" required style="resize: none;"></textarea>
      </div>
      <button type="submit" class="btn btn-primary w-100" name="addpengunjung">Kirim Data</button>
    </form>
  </div>

  <script src="../js/all.min2.js" crossorigin="anonymous"></script>
  <script src="../js/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="../js/scripts.js"></script>
  <script src="../js/Chart.min.js" crossorigin="anonymous"></script>
  <script src="../assets/demo/chart-area-demo.js"></script>
  <script src="../assets/demo/chart-bar-demo.js"></script>
  <script src="../js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="../js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
  <script src="../assets/demo/datatables-demo.js"></script>
  <script src="../js/bootstrap.bundle2.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>