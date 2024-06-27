<?php
session_start();
include 'koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

// Dapatkan email pengguna dari session
$email = $_SESSION['email'];

// Query untuk mendapatkan data siswa berdasarkan email
$query = "
    SELECT S.id_siswa, S.id_user, S.NISN, S.id_kelas, S.tanggal_lahir, S.jenis_kelamin, S.alamat, S.nama
    FROM siswa S
    JOIN usser U ON S.id_user = U.id_user
    WHERE U.email = ?
";

// Siapkan statement
if ($stmt = $koneksi->prepare($query)) {
    // Bind parameter
    $stmt->bind_param("s", $email);
    
    // Jalankan statement
    $stmt->execute();
    
    // Dapatkan hasil
    $result = $stmt->get_result();
    $siswa = $result->fetch_assoc();
    
    // Tutup statement
    $stmt->close();
} else {
    die('Query error: ' . $koneksi->error);
}

// Dapatkan ID siswa
$id_siswa = $siswa['id_siswa'];

// Query untuk mendapatkan nilai berdasarkan ID siswa
$query_nilai = "
    SELECT mp.nama_pelajaran, n.nilai
    FROM nilai n
    JOIN pelajaran mp ON n.id_mata_pelajaran = mp.id_mata_pelajaran
    WHERE n.id_siswa = ?
";

if ($stmt_nilai = $koneksi->prepare($query_nilai)) {
    $stmt_nilai->bind_param("i", $id_siswa);
    $stmt_nilai->execute();
    $result_nilai = $stmt_nilai->get_result();
} else {
    die('Query error: ' . $koneksi->error);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="img/logo-alirsyad.png" type="image/png" />
    <title>Nilai</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/flaticon.css" />
    <link rel="stylesheet" href="css/themify-icons.css" />
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css" />
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css" />
    <style>
        .custom-nilai-container {
            padding: 50px 0;
            background-color: #f8f9fa;
        }
        .custom-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        .custom-bg-primary  {
            background-color: #52942e;
            color: #ffffff;
            padding: 20px;
        }
        .custom-card-title {
            font-size: 24px;
            font-weight: bold;
        }
        .custom-table th {
            width: 50%;
            font-weight: 600;
        }
        .custom-table td {
            width: 50%;
        }
        .custom-table-hover tbody tr:hover {
            background-color: rgba(0,123,255,.1);
        }
    </style>
  </head>

  <body>
    <!--================ Start Header Menu Area =================-->
    <header class="header_area white-header">
      <div class="main_menu">
        <div class="search_input" id="search_input_box">
          <div class="container">
            <form class="d-flex justify-content-between" method="" action="">
              <input type="text" class="form-control" id="search_input" placeholder="Search Here" />
              <button type="submit" class="btn"></button>
              <span class="ti-close" id="close_search" title="Close Search"></span>
            </form>
          </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand" href="home.php">
              <img class="logo-2" src="img/logo-alirsyad.png" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
              <ul class="nav navbar-nav menu_nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about-sudah-login.html">About</a>
                </li>
                <li class="nav-item submenu dropdown active">
                  <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Akademik</a>
                  <ul class="dropdown-menu">
                    <li class="nav-item">
                      <a class="nav-link" href="data_diri.php">Data Diri</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="jadwal_pelajaran.php">Jadwal Pelajaran</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="nilai.php">Nilai</a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact-login.html">Contact</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link search" id="search">
                    <i class="ti-search"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!--================ End Header Menu Area =================-->

    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="overlay"></div>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <div class="banner_content text-center">
                <h2>Nilai</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Nilai Area =================-->
    <section class="custom-nilai-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card custom-card shadow-lg">
                        <div class="card-header custom-bg-primary text-white">
                            <h2 class="custom-card-title text-center mb-0">Nilai Siswa</h2>
                        </div>
                        <div class="card-body">
                            <?php if ($result_nilai->num_rows > 0): ?>
                                <div class="table-responsive">
                                    <table class="table custom-table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Mata Pelajaran</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $result_nilai->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($row['nama_pelajaran']) ?></td>
                                                    <td><?= htmlspecialchars($row['nilai']) ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-warning" role="alert">
                                    Tidak ada nilai yang ditemukan.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Nilai Area =================-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/owl-carousel-thumb.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/mail-script.js"></script>
    <!-- gmaps Js -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="js/gmaps.min.js"></script>
    <script src="js/theme.js"></script>
</body>
</html>
