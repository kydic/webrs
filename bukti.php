<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ambil data sesuai id
    $sql = "SELECT * FROM pendaftaran_online WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        ?>
        <!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Bukti Pendaftaran Online</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body class="p-5">
            <div class="container">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center text-primary mb-4">Bukti Pendaftaran Online</h3>
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">ID Pendaftaran</th>
                                <td><?php echo $row['id']; ?></td>
                            </tr>
                            <tr>
                                <th>Poli Klinik</th>
                                <td><?php echo $row['poli_klinik']; ?></td>
                            </tr>
                            <tr>
                                <th>Cara Bayar</th>
                                <td><?php echo $row['cara_bayar']; ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Kunjungan</th>
                                <td><?php echo $row['tgl_kunjungan']; ?></td>
                            </tr>
                            <tr>
                                <th>Spesialis</th>
                                <td><?php echo $row['spesialis']; ?></td>
                            </tr>
                            <tr>
                                <th>Sub Spesialis</th>
                                <td><?php echo $row['sub_spesialis']; ?></td>
                            </tr>
                            <tr>
                                <th>Dokter</th>
                                <td><?php echo $row['dokter']; ?></td>
                            </tr>
                        </table>
                        <div class="text-center mt-4">
                            <button onclick="window.print()" class="btn btn-success">Cetak Bukti</button>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Data tidak ditemukan!";
    }
} else {
    echo "ID tidak ditemukan di URL!";
}
?>
