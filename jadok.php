<?php
require_once 'koneksi.php';

$sql = "SELECT * FROM jadwal_dokter";
$result = $conn->query($sql);
// Ambil poli dari URL (kalau ada)
$poli = isset($_GET['poli']) ? $_GET['poli'] : '';

// Query data
if (!empty($poli)) {
  // Tampilkan hanya sesuai poli
  $stmt = $conn->prepare("SELECT * FROM jadwal_dokter WHERE spesialisasi = ?");
  $stmt->bind_param("s", $poli);
  $stmt->execute();
  $result = $stmt->get_result();
} else {
  // Tampilkan semua poli
  $result = $conn->query("SELECT * FROM jadwal_dokter");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - Rs Kemenkes Surabaya</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medicio
  * Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style>
    #featured-services {
      display: flex;
      justify-content: center;
      /* horizontal center */
      align-items: center;
      /* vertical center */
      min-height: 100vh;
      /* tinggi minimal 100% viewport */
      background-image: url('assets/img/rssurabaya.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }



    /* Opsional supaya tulisan tetap terbaca */
    #featured-services .service-item {
      background-color: rgba(255, 255, 255, 0.8);
      /* background putih transparan */
      border-radius: 8px;
      padding: 10px;
    }
  </style>

</head>



</header>

<main class="main">


  <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
  </a>

  <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
  </a>

  <ol class="carousel-indicators"></ol>

  </div>







  <!-- Jadwal Dokter -->
  <section id="featured-services" class="featured-services section">
    <div class="container">
      <div class="row gy-3 justify-content-center">

        <!-- Item 1 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-heartbeat"></i></div>
            <h5><a href="detail.php?poli=bedah" class="stretched-link text-dark">Bedah</a></h5>
          </div>
        </div>

        <!-- Item 2 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-pills"></i></div>
            <h5><a href="detail.php?poli=jantung" class="stretched-link text-dark">Jantung</a></h5>
          </div>
        </div>

        <!-- Item 3 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="detail.php?poli=penyakit_dalam" class="stretched-link text-dark">Penyakit Dalam</a></h5>
          </div>
        </div>

        <!-- Item 4 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-dna"></i></div>
            <h5><a href="detail.php?poli=kebidanan" class="stretched-link text-dark">Kebidanan</a></h5>
          </div>
        </div>

        <!-- Item 5 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-dna"></i></div>
            <h5><a href="detail.php?poli=anak" class="stretched-link text-dark">Anak</a></h5>

          </div>
        </div>

        <!-- Item 6 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-heartbeat"></i></div>
            <h5><a href="detail.php?poli=paru" class="stretched-link text-dark">Paru</a></h5>
          </div>
        </div>

        <!-- Item 7 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-pills"></i></div>
            <h5><a href="detail.php?poli=anastesi" class="stretched-link text-dark">Anastesi</a></h5>
          </div>
        </div>

        <!-- Item 8 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="detail.php?poli=kulit" class="stretched-link text-dark">Kulit</a></h5>
          </div>
        </div>

        <!-- Item 9 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="detail.php?poli=gigi" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>

        <!-- Item 10 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="#" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>

        <!-- Item 11 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="#" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>

        <!-- Item 12 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="#" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>

        <!-- Item 13 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="#" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>

        <!-- Item 14 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="#" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>

        <!-- Item 15 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="#" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>

        <!-- Item 16 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="#" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>

        <!-- Item 17 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="#" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>

        <!-- Item 18 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="#" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>

        <!-- Item 19-->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="#" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>

        <!-- Item 20 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="#" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>

        <!-- Item 21 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="#" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>

        <!-- Item 22 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="#" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>

        <!-- Item 23 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="#" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>

        <!-- Item 24 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="#" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>

        <!-- Item 25-->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="#" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>

        <!-- Item 26 -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 d-flex">
          <div class="service-item text-center w-100">
            <div class="icon"><i class="fas fa-thermometer"></i></div>
            <h5><a href="#" class="stretched-link text-dark">Gigi</a></h5>
          </div>
        </div>