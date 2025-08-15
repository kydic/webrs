<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $poli        = $_POST['poli'];
    $caraBayar   = $_POST['caraBayar'];
    $tglKunjungan= $_POST['tglKunjungan'];
    $spesialis   = $_POST['spesialis'];
    $subSpesialis= $_POST['subSpesialis'];
    $dokter      = $_POST['dokter'];

    $sql = "INSERT INTO pendaftaran_online 
            (poli_klinik, cara_bayar, tgl_kunjungan, spesialis, sub_spesialis, dokter) 
            VALUES 
            ('$poli', '$caraBayar', '$tglKunjungan', '$spesialis', '$subSpesialis', '$dokter')";

    if (mysqli_query($conn, $sql)) {
    $last_id = mysqli_insert_id($conn); // ambil ID terakhir
    echo "<script>
            alert('Pendaftaran berhasil!');
            window.location.href='bukti.php?id=$last_id';
          </script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
}

?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Pendaftaran Online</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="container my-5">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <!-- Judul -->
          <h4 class="text-center text-primary mb-4">Form Pendaftaran Online</h4>

          <form method="POST" action="">
            <!-- Poli Klinik -->
            <div class="mb-3 row">
              <label for="poli" class="col-sm-3 col-form-label">Pilih Poli Klinik</label>
              <div class="col-sm-9">
                <select class="form-select" id="poli" name="poli" required>
                  <option value="">-- Pilih Poli --</option>
                  <option value="regular">Regular</option>
                  <option value="eksekutif">Eksekutif</option>
                </select>
              </div>
            </div>

            <!-- Cara Bayar -->
            <div class="mb-3 row">
              <label for="caraBayar" class="col-sm-3 col-form-label">Cara Bayar</label>
              <div class="col-sm-9">
                <select class="form-select" id="caraBayar" name="caraBayar" required>
                  <option value="">-- Pilih Cara Bayar --</option>
                  <option value="nonjkn">Non JKN</option>
                  <option value="jkn">JKN</option>
                </select>
              </div>
            </div>

            <!-- Tanggal Kunjungan -->
            <div class="mb-3 row">
              <label for="tglKunjungan" class="col-sm-3 col-form-label">Tanggal Kunjungan</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" id="tglKunjungan" name="tglKunjungan" required />
              </div>
            </div>

            <!-- Spesialis -->
            <div class="mb-3 row">
              <label for="spesialis" class="col-sm-3 col-form-label">Spesialis</label>
              <div class="col-sm-9">
                <select class="form-select" id="spesialis" name="spesialis" required>
                  <option value="">-- Pilih Spesialis --</option>
                  <option value="penyakitdalam">Penyakit Dalam</option>
                  <option value="bedah">Bedah</option>
                  <option value="anak">Anak</option>
                  <option value="obgyn">Obgyn</option>
                </select>
              </div>
            </div>

            <!-- Sub Spesialis -->
            <div class="mb-3 row">
              <label for="subSpesialis" class="col-sm-3 col-form-label">Sub Spesialis</label>
              <div class="col-sm-9">
                <select class="form-select" id="subSpesialis" name="subSpesialis" required>
                  <option value="">-- Pilih Sub Spesialis --</option>
                  <option value="jantung">Kardiologi (Jantung)</option>
                  <option value="ginjal">Nefrologi (Ginjal)</option>
                  <option value="paru">Pulmonologi (Paru)</option>
                  <option value="saraf">Neurologi (Saraf)</option>
                </select>
              </div>
            </div>

            <!-- Pilih Dokter -->
            <div class="mb-3 row">
              <label for="dokter" class="col-sm-3 col-form-label">Pilih Dokter</label>
              <div class="col-sm-9">
                <select class="form-select" id="dokter" name="dokter" required>
                  <option value="">-- Pilih Dokter --</option>
                  <option value="drA">dr. Ahmad, Sp.PD</option>
                  <option value="drB">dr. Budi, Sp.B</option>
                  <option value="drC">dr. Citra, Sp.A</option>
                  <option value="drD">dr. Dewi, Sp.OG</option>
                </select>
              </div>
            </div>

            <!-- Tombol Submit -->
            <div class="text-center mt-4">
              <button type="submit" class="btn btn-success px-4">Daftar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
