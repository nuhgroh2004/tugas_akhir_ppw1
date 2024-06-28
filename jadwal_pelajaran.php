<?php
session_start();
include 'koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
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

// Dapatkan ID kelas
$id_kelas = $siswa['id_kelas'];

// Query untuk mendapatkan nama kelas berdasarkan ID kelas
$query_kelas = "SELECT nama_kelas FROM kelas WHERE id_kelas = ?";
if ($stmt_kelas = $koneksi->prepare($query_kelas)) {
    $stmt_kelas->bind_param("i", $id_kelas);
    $stmt_kelas->execute();
    $result_kelas = $stmt_kelas->get_result();
    $kelas = $result_kelas->fetch_assoc();
    $nama_kelas = $kelas['nama_kelas'];
    $stmt_kelas->close();
} else {
    die('Query error: ' . $koneksi->error);
}

// Query untuk mendapatkan jadwal pelajaran berdasarkan ID kelas
$sql = "
    SELECT jp.hari, jp.jam_mulai, jp.jam_selesai, mp.nama_pelajaran
    FROM jadwal_pelajaran jp
    JOIN pelajaran mp ON jp.id_mata_pelajaran = mp.id_mata_pelajaran
    WHERE jp.id_kelas = ?
    ORDER BY FIELD(jp.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'), jp.jam_mulai
";

if ($stmt = $koneksi->prepare($sql)) {
    $stmt->bind_param("i", $id_kelas);
    $stmt->execute();
    $result = $stmt->get_result();
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
    <title>Jadwal Pelajaran Kelas <?php echo htmlspecialchars($nama_kelas); ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/flaticon.css" />
    <link rel="stylesheet" href="css/themify-icons.css" />
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css" />
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css" />
    
    <style>
        /* Styles for the schedule table */
        .schedule-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .schedule-table th, .schedule-table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .schedule-table th {
            background-color:#52942e;
            text-align: center;
            color: #002347;
        }
        .schedule-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .schedule-container {
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;  /* Adjust as needed */
            margin-bottom: 100px;  /* Adjust as needed */
        }
        .schedule-container h2 {
            text-align: center;
            color: #002347;
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
                  <a class="nav-link" href="index.php">Home</a>
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
                      <a class="nav-link" href="data_diri.php">Data diri</a>
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
                <h2>Jadwal Pelajaran</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Jadwal area =================-->
    <div class="container schedule-container">
      <h2>KELAS <?php echo htmlspecialchars($nama_kelas); ?></h2>

      <table class="schedule-table">
        <tr>
            <th>Hari</th>
            <th>Jam</th>
            <th>Mata Pelajaran</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["hari"]) . "</td>
                        <td>" . htmlspecialchars($row["jam_mulai"]) . " - " . htmlspecialchars($row["jam_selesai"]) . "</td>
                        <td>" . htmlspecialchars($row["nama_pelajaran"]) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
        }
        $stmt->close();
        $koneksi->close();
        ?>
      </table>
    </div>
    <!--================Jadwal area =================-->

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
