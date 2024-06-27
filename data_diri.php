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

// Tutup koneksi
$koneksi->close();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="icon" href="img/logo-alirsyad.png" type="image/png" />
    <title>Data Diri</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/flaticon.css" />
    <link rel="stylesheet" href="css/themify-icons.css" />
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css" />
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css" />
    <style>
    .data_diri_area {
        padding: 50px 0;
        background-color: #f8f9fa;
    }
    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }
    .card-header {
        background-color: gregoriantojd;
        color: #002347;
        padding: 20px;
    }
    .card-title {
        font-size: 24px;
        font-weight: bold;
    }
    .table th {
        width: 30%;
        font-weight: 600;
    }
    .table td {
        width: 70%;
    }
    .table-hover tbody tr:hover {
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
              <input
                type="text"
                class="form-control"
                id="search_input"
                placeholder="Search Here"
              />
              <button type="submit" class="btn"></button>
              <span
                class="ti-close"
                id="close_search"
                title="Close Search"
              ></span>
            </form>
          </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand" href="home.php">
              <img class="logo-2" src="img/logo-alirsyad.png" alt="" />
            </a>
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon-bar"></span> <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div
              class="collapse navbar-collapse offset"
              id="navbarSupportedContent"
            >
              <ul class="nav navbar-nav menu_nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about-sudah-login.html">About</a>
                </li>
                <li class="nav-item submenu dropdown active">
                  <a
                    href="#"
                    class="nav-link dropdown-toggle"
                    data-toggle="dropdown"
                    role="button"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >Akademik</a
                  >
                  <ul class="dropdown-menu">
                    <li class="nav-item">
                      <a class="nav-link" href="data_diri.php">Data Diri</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="jadwal_pelajaran.php"
                        >Jadwal Pelajaran</a
                      >
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
                <h2>Data Diri</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================ Data diri Area =================-->
    <section class="data_diri_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white">
                            <h2 class="card-title text-center mb-0">Data Diri Siswa</h2>
                        </div>
                        <div class="card-body">
                            <?php if ($siswa): ?>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <th scope="row">ID Siswa</th>
                                                <td><?= htmlspecialchars($siswa['id_siswa']) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nama</th>
                                                <td><?= htmlspecialchars($siswa['nama']) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">NISN</th>
                                                <td><?= htmlspecialchars($siswa['NISN']) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ID Kelas</th>
                                                <td><?= htmlspecialchars($siswa['id_kelas']) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tanggal Lahir</th>
                                                <td><?= htmlspecialchars($siswa['tanggal_lahir']) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Jenis Kelamin</th>
                                                <td><?= htmlspecialchars($siswa['jenis_kelamin']) ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Alamat</th>
                                                <td><?= htmlspecialchars($siswa['alamat']) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-warning" role="alert">
                                    Data siswa tidak ditemukan.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--================ Data diri Area =================-->

    

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
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="js/gmaps.min.js"></script>
    <script src="js/theme.js"></script>
  </body>
</html>
