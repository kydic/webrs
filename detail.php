<?php
include 'koneksi.php'; // koneksi database

$poli = isset($_GET['poli']) ? $_GET['poli'] : '';

if ($poli) {
    $sql = "SELECT * FROM jadwal_dokter WHERE poli = ? ORDER BY nama_dokter";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $poli);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM jadwal_dokter ORDER BY poli, nama_dokter";
    $result = $conn->query($sql);
}

// Array hari
$days = ['senin','selasa','rabu','kamis','jumat','sabtu','minggu'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Dokter - <?= htmlspecialchars($poli) ?></title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('assets/img/rssurabaya.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
        .page-title {
            color: black;
            background-color: #50EBEC;
            padding: 10px;
            display: inline-block;
            border-radius: 5px;
        }
        .doctor-name {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2c3e50;
            background-color: aliceblue;
            padding: 5px;
            border-radius: 5px;
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
    <h2 class="page-title">Jadwal Dokter Poli <?= ucfirst(htmlspecialchars($poli)) ?></h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="doctor-name"><?= htmlspecialchars($row['nama_dokter']) ?></div>
                    <div class="poli-name"><?= strtoupper(htmlspecialchars($row['poli'])) ?></div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <?php foreach ($days as $day): ?>
                                        <th><?= ucfirst($day) ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                               <tr>
    <?php foreach ($days as $day): 
        $mulai = $row[$day.'_mulai'];
        $selesai = $row[$day.'_selesai'];
        if ($mulai && $mulai !== '00:00:00' && $selesai && $selesai !== '00:00:00') {
            $jadwal = htmlspecialchars($mulai) . '<br>&nbsp;-&nbsp;<br>' . htmlspecialchars($selesai);
        } else {
            $jadwal = '-';
        }
    ?>
        <td style="line-height: 1.2;"><?= $jadwal ?></td>
    <?php endforeach; ?>
</tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="last-update">Last Update: <?= $row['last_update'] ?></div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="alert alert-warning">Jadwal tidak ditemukan untuk poli ini.</div>
    <?php endif; ?>

</div>
</body>
</html>

<?php $conn->close(); ?>
