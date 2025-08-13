<?php
// koneksi database webrs (untuk simpan jadwal)
$host = "localhost";
$user = "root";
$pass = "";
$db   = "rssurabaya";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

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
    $senin       = $_POST['senin'];
    $selasa      = $_POST['selasa'];
    $rabu        = $_POST['rabu'];
    $kamis       = $_POST['kamis'];
    $jumat       = $_POST['jumat'];
    $sabtu       = $_POST['sabtu'];
    $minggu      = $_POST['minggu'];

    $conn->query("INSERT INTO jadwal_dokter 
        (poli, nama_dokter, spesialis, senin, selasa, rabu, kamis, jumat, sabtu, minggu, last_update) 
        VALUES ('$poli','$nama_dokter','$spesialis','$senin','$selasa','$rabu','$kamis','$jumat','$sabtu','$minggu', NOW())");
    header("Location: admin_jadwal.php");
    exit;
}

// Edit Data
if (isset($_POST['edit'])) {
    $id          = (int)$_POST['id'];
    $poli        = $_POST['poli'];
    $nama_dokter = $_POST['nama_dokter'];
    $spesialis   = $_POST['spesialis'];
    $senin       = $_POST['senin'];
    $selasa      = $_POST['selasa'];
    $rabu        = $_POST['rabu'];
    $kamis       = $_POST['kamis'];
    $jumat       = $_POST['jumat'];
    $sabtu       = $_POST['sabtu'];
    $minggu      = $_POST['minggu'];

    $conn->query("UPDATE jadwal_dokter SET
        poli = '$poli',
        nama_dokter = '$nama_dokter',
        spesialis = '$spesialis',
        senin = '$senin',
        selasa = '$selasa',
        rabu = '$rabu',
        kamis = '$kamis',
        jumat = '$jumat',
        sabtu = '$sabtu',
        minggu = '$minggu',
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

    <div class="container py-4">
        <h2 class="mb-4 text-center">Admin - CRUD Jadwal Dokter</h2>

        <!-- Form Tambah Data -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">Tambah Jadwal Dokter</div>
            <div class="card-body">
                <form method="POST">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="poli" class="form-label">Pilih Poli</label>
                            <select name="poli" id="poli" class="form-select" required>
                                <option value="">-- Pilih Poli --</option>
                                <?php
                                // Reset poliResult pointer jika sudah dipakai sebelumnya
                                $poliResult->data_seek(0);
                                while ($row = $poliResult->fetch_assoc()) : ?>
                                    <option value="<?= htmlspecialchars($row['nama_poli']); ?>"><?= htmlspecialchars($row['nama_poli']); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="nama_dokter" class="form-label">Nama Dokter</label>
                            <input type="text" name="nama_dokter" id="nama_dokter" class="form-control" placeholder="Nama Dokter" required />
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
                                    $listSpesialis = ['Anak', 'Jantung', 'Bedah', 'Kebidanan', 'Paru', 'Anestesi', 'Kulit', 'Gigi'];
                                    foreach ($listSpesialis as $sp) {
                                        echo '<option value="' . htmlspecialchars($sp) . '">' . htmlspecialchars($sp) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <?php
                        $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
                        foreach ($days as $day) : ?>
                            <div class="col-md-2">
                                <label for="<?= $day ?>" class="form-label"><?= ucfirst($day) ?></label>
                                <input type="text" name="<?= $day ?>" id="<?= $day ?>" class="form-control" placeholder="Jadwal <?= ucfirst($day) ?>" />
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="mt-3">
                        <button type="submit" name="tambah" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">Daftar Jadwal Dokter</div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
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
                                <td><?= htmlspecialchars($row['senin']) ?></td>
                                <td><?= htmlspecialchars($row['selasa']) ?></td>
                                <td><?= htmlspecialchars($row['rabu']) ?></td>
                                <td><?= htmlspecialchars($row['kamis']) ?></td>
                                <td><?= htmlspecialchars($row['jumat']) ?></td>
                                <td><?= htmlspecialchars($row['sabtu']) ?></td>
                                <td><?= htmlspecialchars($row['minggu']) ?></td>
                                <td><?= htmlspecialchars($row['last_update']) ?></td>
                                <td>
                                    <a href="?hapus=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                                    <a href="?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Edit Jadwal -->
        <?php if ($editData) : ?>
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
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

                                    <?php foreach ($days as $day) : ?>
                                        <div class="col-md-4 mt-3">
                                            <label for="<?= $day ?>_edit" class="form-label"><?= ucfirst($day) ?></label>
                                            <input type="text" name="<?= $day ?>" id="<?= $day ?>_edit" class="form-control" value="<?= htmlspecialchars($editData[$day]) ?>" />
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
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