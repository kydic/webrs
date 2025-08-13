<?php
include 'koneksi.php'; // koneksi database

// Ambil parameter poli dari URL
$poli = isset($_GET['poli']) ? $_GET['poli'] : '';

if ($poli) {
    // Query hanya untuk poli yang dipilih
    $sql = "SELECT * FROM jadwal_dokter WHERE poli = ? ORDER BY nama_dokter";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $poli);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Kalau tidak ada poli di URL, tampilkan semua
    $sql = "SELECT * FROM jadwal_dokter ORDER BY poli, nama_dokter";
    $result = $conn->query($sql);
}
// ambil poli dari URL, misal detail.php?poli=Anak
$poli = isset($_GET['poli']) ? $_GET['poli'] : '';

$sql = "SELECT * FROM jadwal_dokter WHERE poli = '$poli'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Jadwal Dokter - <?php echo $poli; ?></title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .page-title {
            color: black;
            background-color: white;
            padding: 10px;
            display: inline-block;
            /* biar background hanya di sekitar teks */
            border-radius: 5px;
            /* opsional, agar agak membulat */
        }

        body {
            background-image: url('assets/img/rssurabaya.jpg');
            /* ganti dengan lokasi file gambar kamu */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;

        }

        .doctor-name {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2c3e50;
            background-color: aliceblue;
        }

        .poli-name {
            font-size: 1rem;
            font-weight: 500;
            color: #16a085;
            margin-bottom: 10px;
        }

        .last-update {
            font-size: 0.9rem;
            color: gray;
            font-style: italic;
        }

        table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }


        th {
            background-color: #3498db;
            color: white;
            text-align: center;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-4">
        <h2 class="mb-4" style="color: black; background-color: #50EBEC; display: inline-block; padding: 5px 10px;">
            Jadwal Dokter Poli <?php echo ucfirst($poli); ?>
        </h2>

        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card shadow-sm mb-4">';
                echo '<div class="card-body">';
                echo '<div class="doctor-name">' . $row['nama_dokter'] . '</div>';
                echo '<div class="poli-name">' . strtoupper($row['poli']) . '</div>';

                echo '<div class="table-responsive">';
                echo '<table class="table table-bordered">';
                echo '<tr>
                    <th>Senin</th>
                    <th>Selasa</th>
                    <th>Rabu</th>
                    <th>Kamis</th>
                    <th>Jumat</th>
                    <th>Sabtu</th>
                    <th>Minggu</th>
                  </tr>';
                echo '<tr>
                    <td>' . $row['senin'] . '</td>
                    <td>' . $row['selasa'] . '</td>
                    <td>' . $row['rabu'] . '</td>
                    <td>' . $row['kamis'] . '</td>
                    <td>' . $row['jumat'] . '</td>
                    <td>' . $row['sabtu'] . '</td>
                    <td>' . $row['minggu'] . '</td>
                  </tr>';
                echo '</table>';
                echo '</div>';

                echo '<div class="last-update">Last Update : ' . $row['last_update'] . '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="alert alert-warning">Jadwal tidak ditemukan untuk poli ini.</div>';
        }

        $conn->close();
        ?>
    </div>
</body>

</html>