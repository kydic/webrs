<?php
include 'koneksi.php';

// koneksi ke database rssurabaya (untuk ambil data poli & spesialis)
$conn2 = new mysqli($host, $user, $pass, "rssurabaya");
if ($conn2->connect_error) {
    die("Koneksi ke rssurabaya gagal: " . $conn2->connect_error);
}

// Hapus Data
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus']; // casting ke int untuk keamanan
    $conn->query("DELETE FROM jadwal_dokter WHERE id = $id");
    header("Location: admin_jadwal.php"); // redirect agar halaman reload tanpa parameter hapus
    exit;
}

// Ambil data poli dari database rssurabaya
$poliResult = $conn2->query("SELECT id, nama_poli FROM poli ORDER BY nama_poli ASC");

// Ambil data spesialis
$spesialisResult = $conn2->query("SELECT id, nama_spesialis FROM spesialis ORDER BY nama_spesialis ASC");

// Tambah Data
if (isset($_POST['tambah'])) {
    $poli        = $_POST['poli'];
    $nama_dokter = $_POST['nama_dokter'];
    $spesialis   = $_POST['spesialis'];
    $senin_mulai       = $_POST['senin_mulai'];
    $senin_selesai       = $_POST['senin_selesai'];
    $selasa_mulai       = $_POST['selasa_mulai'];
    $selasa_selesai       = $_POST['selasa_selesai'];
    $rabu_mulai       = $_POST['rabu_mulai'];
    $rabu_selesai       = $_POST['rabu_selesai'];
    $kamis_mulai       = $_POST['kamis_mulai'];
    $kamis_selesai       = $_POST['kamis_selesai'];
    $jumat_mulai       = $_POST['jumat_mulai'];
    $jumat_selesai       = $_POST['jumat_selesai'];
    $sabtu_mulai       = $_POST['sabtu_mulai'];
    $sabtu_selesai       = $_POST['sabtu_selesai'];
    $minggu_mulai       = $_POST['minggu_mulai'];
    $minggu_selesai       = $_POST['minggu_selesai'];
   
    

    $conn->query("INSERT INTO jadwal_dokter 
        (poli, nama_dokter, spesialis, senin_mulai,senin_selesai, selasa_mulai,selasa_selesai,rabu_mulai,rabu_selesai, kamis_mulai,kamis_selesai, jumat_mulai,jumat_selesai, sabtu_mulai,sabtu_selesai,minggu_mulai, minggu_selesai, last_update) 
        VALUES ('$poli','$nama_dokter','$spesialis','$senin_mulai', '$senin_selesai',
'$selasa_mulai', '$selasa_selesai',
'$rabu_mulai', '$rabu_selesai',
'$kamis_mulai', '$kamis_selesai',
'$jumat_mulai', '$jumat_selesai',
'$sabtu_mulai', '$sabtu_selesai',
'$minggu_mulai', '$minggu_selesai', NOW())");
    header("Location: admin_jadwal.php");
    exit;
}

// Edit Data
if (isset($_POST['edit'])) {
    $id = (int)$_POST['id'];
    $poli = $_POST['poli'];
    $nama_dokter = $_POST['nama_dokter'];
    $spesialis = $_POST['spesialis'];
    $senin_mulai = $_POST['senin_mulai'];
    $senin_selesai = $_POST['senin_selesai'];
    $selasa_mulai = $_POST['selasa_mulai'];
    $selasa_selesai = $_POST['selasa_selesai'];
    $rabu_mulai = $_POST['rabu_mulai'];
    $rabu_selesai = $_POST['rabu_selesai'];
    $kamis_mulai = $_POST['kamis_mulai'];
    $kamis_selesai = $_POST['kamis_selesai'];
    $jumat_mulai = $_POST['jumat_mulai'];
    $jumat_selesai = $_POST['jumat_selesai'];
    $sabtu_mulai = $_POST['sabtu_mulai'];
    $sabtu_selesai = $_POST['sabtu_selesai'];
    $minggu_mulai = $_POST['minggu_mulai'];
    $minggu_selesai = $_POST['minggu_selesai'];

    $conn->query("UPDATE jadwal_dokter SET
        poli = '$poli',
        nama_dokter = '$nama_dokter',
        spesialis = '$spesialis',
        senin_mulai = '$senin_mulai',
        senin_selesai = '$senin_selesai',
        selasa_mulai = '$selasa_mulai',
        selasa_selesai = '$selasa_selesai',
        rabu_mulai = '$rabu_mulai',
        rabu_selesai = '$rabu_selesai',
        kamis_mulai = '$kamis_mulai',
        kamis_selesai = '$kamis_selesai',
        jumat_mulai = '$jumat_mulai',
        jumat_selesai = '$jumat_selesai',
        sabtu_mulai = '$sabtu_mulai',
        sabtu_selesai = '$sabtu_selesai',
        minggu_mulai = '$minggu_mulai',
        minggu_selesai = '$minggu_selesai',
        last_update = NOW()
        WHERE id = $id
    ");
    header("Location: admin_jadwal.php");
    exit;
}



// Ambil data jadwal untuk edit jika ada parameter edit di URL
$editData = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $result = $conn->query("SELECT * FROM jadwal_dokter WHERE id = $id");
    if ($result->num_rows > 0) {
        $editData = $result->fetch_assoc();
    }
}

// Ambil Data jadwal
$data = $conn->query("SELECT * FROM jadwal_dokter ORDER BY poli, nama_dokter ASC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin - Jadwal Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f7f9fc;
        }

        .card {
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background: #3498db;
            color: white;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
        }
    </style>
</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <div class="container py-4">
        <h2 class="mb-4 text-center">Jadwal Dokter</h2>

        <!-- Form Tambah Data -->
       <!-- Tombol Tambah Data -->
<div class="d-flex justify-content-between mb-3">
    <h2>Jadwal Dokter</h2>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">
        + Tambah Data
    </button>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <form method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Jadwal Dokter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-3">
              <label for="poli" class="form-label">Pilih Poli</label>
              <select name="poli" id="poli" class="form-select" required>
                <option value="">-- Pilih Poli --</option>
                <?php
                $poliResult->data_seek(0);
                while ($row = $poliResult->fetch_assoc()) : ?>
                  <option value="<?= htmlspecialchars($row['nama_poli']); ?>"><?= htmlspecialchars($row['nama_poli']); ?></option>
                <?php endwhile; ?>
              </select>
            </div>

            <div class="col-md-3">
              <label for="nama_dokter" class="form-label">Nama Dokter</label>
              <input type="text" name="nama_dokter" id="nama_dokter" class="form-control" required>
            </div>

            <div class="col-md-3">
              <label for="spesialis" class="form-label">Pilih Spesialis</label>
              <select name="spesialis" id="spesialis" class="form-select" required>
                <option value="">-- Pilih Spesialis --</option>
                <?php
                if ($spesialisResult && $spesialisResult->num_rows > 0) {
                  $spesialisResult->data_seek(0);
                  while ($row = $spesialisResult->fetch_assoc()) {
                    echo '<option value="' . htmlspecialchars($row['nama_spesialis']) . '">' . htmlspecialchars($row['nama_spesialis']) . '</option>';
                  }
                } else {
                  $listSpesialis = ['Anak','Jantung','Bedah','Kebidanan','Paru','Anestesi','Kulit','Gigi'];
                  foreach ($listSpesialis as $sp) {
                    echo '<option value="' . htmlspecialchars($sp) . '">' . htmlspecialchars($sp) . '</option>';
                  }
                }
                ?>
              </select>
            </div>
          </div>

          <!-- Tabel Input Jadwal -->
          <table class="table table-bordered mt-3">
            <thead>
              <tr>
                <th>Hari</th>
                <th>Mulai</th>
                <th>Selesai</th>
              </tr>
            </thead>
            <tbody>
                            <?php
                            $days = ['senin', 'selasa','rabu','kamis','jumat','sabtu','minggu'];
                            foreach ($days as $day):
                                $mulai = isset($editData[$day.'_mulai']) ? $editData[$day.'_mulai'] : '';
                                $selesai = isset($editData[$day.'_selesai']) ? $editData[$day.'_selesai'] : '';
                            ?>
                            <tr>
                                <td><strong><?= ucfirst($day) ?></strong></td>
                                <td><input type="time" name="<?= $day ?>_mulai" class="form-control" value="<?= htmlspecialchars($mulai) ?>"></td>
                                <td><input type="time" name="<?= $day ?>_selesai" class="form-control" value="<?= htmlspecialchars($selesai) ?>"></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
          
        </div>
      </form>
    </div>
  </div>
</div>

      <!-- Tabel Data -->
<div class="card shadow-sm">
    <div class="card-header bg-info text-white">Daftar Jadwal Dokter</div>
    <div class="card-body table-responsive">
        <table id="jadwalTable" class="table table-bordered table-hover align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>Poli</th>
                    <th>Nama Dokter</th>
                    <th>Spesialis</th>
                    <th>Senin</th>
                    <th>Selasa</th>
                    <th>Rabu</th>
                    <th>Kamis</th>
                    <th>Jumat</th>
                    <th>Sabtu</th>
                    <th>Minggu</th>
                    <th>Last Update</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $data->fetch_assoc()) : ?>
                    <tr>
                       
      <td><?= htmlspecialchars($row['poli']) ?></td>
      <td><?= htmlspecialchars($row['nama_dokter']) ?></td>
      <td><?= htmlspecialchars($row['spesialis']) ?></td>
      <?php foreach($days as $day): ?>
<td style="text-align: center;">
<?php
$mulai = $row[$day.'_mulai'];
$selesai = $row[$day.'_selesai'];
if ($mulai && $mulai !== '00:00:00' && $selesai && $selesai !== '00:00:00') {
    echo htmlspecialchars($mulai) . ' - ' . htmlspecialchars($selesai);
} else {
    echo '-';
}
?>
</td>
<?php endforeach; ?>


                        <td><?= htmlspecialchars($row['last_update']) ?></td>
                        <td class="text-center">
                            <a href="?hapus=<?= $row['id'] ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Hapus data ini?')">Hapus</a>
                            <a href="?edit=<?= $row['id'] ?>" 
                               class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Tambahkan DataTables -->
<link rel="stylesheet" 
      href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#jadwalTable').DataTable({
        "pageLength": 10, // default 10 data per halaman
        "lengthMenu": [5, 10, 25, 50, 100], // opsi jumlah data per halaman
        "ordering": true, // enable sorting
        "searching": true, // enable search
        "language": {
            "search": "Cari:",
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ada data ditemukan",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "infoEmpty": "Tidak ada data tersedia",
            "infoFiltered": "(difilter dari total _MAX_ data)",
            "paginate": {
                "first": "Awal",
                "last": "Akhir",
                "next": "→",
                "previous": "←"
            }
        }
    });
});
</script>


        <!-- Modal Edit Jadwal -->
        <?php if ($editData) : ?>
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-">
                    <div class="modal-content">
                        <form method="POST" id="editForm">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Jadwal Dokter</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($editData['id']) ?>">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="poli_edit" class="form-label">Pilih Poli</label>
                                        <select name="poli" id="poli_edit" class="form-select" required>
                                            <option value="">-- Pilih Poli --</option>
                                            <?php
                                            $poliResult2 = $conn2->query("SELECT id, nama_poli FROM poli ORDER BY nama_poli ASC");
                                            while ($row = $poliResult2->fetch_assoc()) {
                                                $selected = ($editData['poli'] === $row['nama_poli']) ? 'selected' : '';
                                                echo '<option value="' . htmlspecialchars($row['nama_poli']) . '" ' . $selected . '>' . htmlspecialchars($row['nama_poli']) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nama_dokter_edit" class="form-label">Nama Dokter</label>
                                        <input type="text" name="nama_dokter" id="nama_dokter_edit" class="form-control" value="<?= htmlspecialchars($editData['nama_dokter']) ?>" required />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="spesialis_edit" class="form-label">Pilih Spesialis</label>
                                        <select name="spesialis" id="spesialis_edit" class="form-select" required>
                                            <option value="">-- Pilih Spesialis --</option>
                                            <?php
                                            $spesialisResult2 = $conn2->query("SELECT id, nama_spesialis FROM spesialis ORDER BY nama_spesialis ASC");
                                            if ($spesialisResult2 && $spesialisResult2->num_rows > 0) {
                                                while ($row = $spesialisResult2->fetch_assoc()) {
                                                    $selected = ($editData['spesialis'] === $row['nama_spesialis']) ? 'selected' : '';
                                                    echo '<option value="' . htmlspecialchars($row['nama_spesialis']) . '" ' . $selected . '>' . htmlspecialchars($row['nama_spesialis']) . '</option>';
                                                }
                                            } else {
                                                $listSpesialis = ['Anak', 'Jantung', 'Bedah', 'Kebidanan', 'Paru', 'Anestesi', 'Kulit', 'Gigi'];
                                                foreach ($listSpesialis as $sp) {
                                                    $selected = ($editData['spesialis'] === $sp) ? 'selected' : '';
                                                    echo '<option value="' . htmlspecialchars($sp) . '" ' . $selected . '>' . htmlspecialchars($sp) . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
<!-- tabel edit data -->
    <table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Hari</th>
            <th>Mulai</th>
            <th>Selesai</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $days = ['senin', 'selasa','rabu','kamis','jumat','sabtu','minggu'];
        foreach ($days as $day):
            $mulai = isset($editData[$day.'_mulai']) ? $editData[$day.'_mulai'] : '';
            $selesai = isset($editData[$day.'_selesai']) ? $editData[$day.'_selesai'] : '';
        ?>
        <tr>
            <td><strong><?= ucfirst($day) ?></strong></td>
            <td style="text-align: center;">
                <?php if ($mulai && $mulai !== '00:00:00'): ?>
                    <input type="time" name="<?= $day ?>_mulai" class="form-control" value="<?= htmlspecialchars($mulai) ?>">
                <?php else: ?>
                    -
                    <input type="time" name="<?= $day ?>_mulai" class="form-control mt-1">
                <?php endif; ?>
            </td>
            <td style="text-align: center;">
                <?php if ($selesai && $selesai !== '00:00:00'): ?>
                    <input type="time" name="<?= $day ?>_selesai" class="form-control" value="<?= htmlspecialchars($selesai) ?>">
                <?php else: ?>
                    -
                    <input type="time" name="<?= $day ?>_selesai" class="form-control mt-1">
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" name="edit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                const editModalEl = document.getElementById('editModal');
                const editModal = new bootstrap.Modal(editModalEl);
                editModal.show();

                editModalEl.addEventListener('hidden.bs.modal', function() {
                    // Redirect ke halaman tanpa parameter edit supaya modal tidak muncul lagi
                    window.location.href = 'admin_jadwal.php';
                });
            </script>
        <?php endif; ?>
    </div>

</body>

</html>