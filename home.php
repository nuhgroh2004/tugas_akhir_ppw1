<?php
session_start(); // Pastikan session dimulai
include 'koneksi.php';

$email = "";
$password = "";
$err = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == "" || $password == "") {
        echo "<script>alert('Email atau Password Tidak Boleh Kosong')</script>";
    } else {
        $stmt = $koneksi->prepare("SELECT * FROM usser WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && md5($password) === $row['password']) {
            $_SESSION['email'] = $email;
            header('location: home.php');
            exit();
        } else {
            $err .= "<li>Akun tidak ditemukan atau password salah</li>";
            echo "<script>alert('Akun tidak ditemukan atau password salah')</script>";
        }

        $stmt->close();
    }
}
?>

<!DOCTPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="icon" href="img/logo-alirsyad.png" type="image/png" />
    <title>Tugas Akhir Nuhgroh</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/flaticon.css" />
    <link rel="stylesheet" href="css/themify-icons.css" />
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css" />
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css" />
  </head>

  <body>
    <!--================ Start Header Menu Area =================-->
    <header class="header_area">
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
            <a class="navbar-brand logo_h" href="home.php"
              ><img src="img/logo-alirsyad.png" alt=""
            /></a>
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
                <li class="nav-item active">
                  <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about-sudah-login.html">About</a>
                </li>
                <li class="nav-item submenu dropdown">
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


    <!--================ Start Home Banner Area =================-->
    <section class="home_banner_area">
      <div class="banner_inner">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="banner_content text-center">
                <p class="text-uppercase">
                  Assalamualaikum 
                </p>
                <h2 class="text-uppercase mt-4 mb-5">
                  SMA AL-IRSYAD KOTA TEGAL
                </h2>
                <!-- <div>
                  <a href="#" class="primary-btn2 mb-3 mb-sm-0">learn more</a>
                  <a href="#" class="primary-btn ml-sm-3 ml-0">see course</a>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ End Home Banner Area =================-->

    <!--================ Start Feature Area =================-->
    <section class="feature_area section_gap_top">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3">Keunggulan</h2>
              <p>
                “Menuntut ilmu di masa muda bagai mengukir di atas batu” (Hasan al-Bashri)
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="single_feature">
              <div class="icon"><span class="flaticon-student"></span></div>
              <div class="desc">
                <h4 class="mt-3 mb-2">Beasiswa</h4>
                <p>
                  AL-irsyad beasiswa bagi siswa yang berprestasi dan para penghafal Al-Qur'an
                </p>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4 col-md-6">
            <div class="single_feature">
              <div class="icon"><span class="flaticon-book"></span></div>
              <div class="desc">
                <h4 class="mt-3 mb-2">Program Tahfidz Quran</h4>
                <p>
                  AL-irsyad menyediakan program kelas unggulan bagi para penghafal Al-Qur'an
                </p>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4 col-md-6">
            <div class="single_feature">
              <div class="icon"><span class="flaticon-earth"></span></div>
              <div class="desc">
                <h4 class="mt-3 mb-2">Akreditasi A</h4>
                <p>
                  AL-irsyad telah mendapatkan akreditasi A dari Kementrian Pendidikan dan Kebudayaan
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ End Feature Area =================-->

    <!--================ Start Popular Courses Area =================-->
    <div class="popular_courses">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3">Berita dan Prestasi</h2>
              <p>
                “Allah akan mengangkat derajat orang-orang yang beriman dan orang-orang yang berilmu di antara kamu sekalian.” <br>(Q.S Al-Mujadilah: 11)
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- single course -->
          <div class="col-lg-12">
            <div class="owl-carousel active_course">
              <div class="single_course">
                <div class="course_head">
                  <img class="img-fluid" src="img/courses/c1.jpg" alt="" />
                </div>
                <div class="course_content">
                  <h4 class="mb-3">
                    <a>Sosialisasi Polsek Tegal Barat Mengenai Knalpot Brong</a>
                  </h4>
                  <p>
                    Assalamualaikum Sobat SMALIR, Kali ini kita bahas kegiatan sosialisasi bermanfaat dari Bapak - bapak Polisi dari Tegal Barat. 
                    Kegiatan Sosialisasi tersebut adalah "Sosialisasi Polsek Tegal Barat soal Knalpot Brong" di Masjid Jami,
                     setelah kita semua tadarusan Al Quran bersama. Kegiatan Sosialisasi Alhamdulillah Berjalan Dengan Lancar
                  </p>
                </div>
              </div>

              <div class="single_course">
                <div class="course_head">
                  <img class="img-fluid" src="img/courses/c2.png" alt="" />
                </div>
                <div class="course_content">
                  <h4 class="mb-3">
                    <a>Kegiatan Dzikir Pagi Dilanjutkan Sholat Dhuha </a>
                  </h4>
                  <p>
                    Setiap pagi siswa-siswi SMA Al Irsyad berkumpul di Masjid Jami' Al Irsyad kota Tegal untuk melaksanakan
                     dzikir pagi dan shalat Dhuha secara rutin. Di dalam atmosfer yang penuh dengan ketenangan dan kekhusyukan, 
                     para siswa-siswi memulai hari mereka dengan mengingat Allah dalam dzikir pagi, mengawali kegiatan belajar dengan mengkondisikan kesadaran spiritual.
                  </p>
                </div>
              </div>

              <div class="single_course">
                <div class="course_head">
                  <img class="img-fluid" src="img/courses/c3.jpg" alt="" />
                </div>
                <div class="course_content">
                  <h4 class="mb-3">
                    <a>Sosialisasi Sukses SNPMB <br> ( SNBP & SNBT )</a>
                  </h4>
                  <p>
                    Assalamualaikum Sahabat SMA Al Irsyad Kota Tegal! Kami dengan gembira mengundang kalian untuk turut serta dalam kegiatan
                     istimewa kami: Sosialisasi Seleksi Berbasis Prestasi Akademik! Acara ini akan berlangsung pada tanggal 6 Januari 2024 di lantai 3 ruang serbaguna SMA Al Irsyad.
                     Bersama-sama, kita akan menjelajahi dunia seleksi akademik dari berbagai perguruan tinggi.
                  </p>
                </div>
              </div>

              <div class="single_course">
                <div class="course_head">
                  <img class="img-fluid" src="img/courses/c4.jpg" alt="" />
                </div>
                <div class="course_content">
                  <h4 class="mb-3">
                    <a>Pemberian Simbolis Piagam dan Hadiah </a>
                  </h4>
                  <p>
                    kepala sekolah Bapak Sakuri, S.Pd secara langsung menyerahkan piagam dan hadiah kepada dua siswa peserta lomba.
                    Dua siswa tersebut adalah;<br>
                    MANGGALA SATRIO WIJOYO, kelas XI.1, sebagai juara ke-2 lomba olimpiade bahasa arab tahun 2023. <br>
                    RAYA NUR MAULIDA, kelas XI.4, sebagai juara ke-2 pada lomba MTQ Universitas Pancasakti Tegal tahun 2023.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================ End Popular Courses Area =================-->

    <!--================ Start Registration Area =================-->
    <div class="section_gap registration_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="row clock_sec clockdiv" id="clockdiv">
                        <div class="col-lg-12">
                            <h1 class="mb-3">Login Now</h1>
                            <p>
                                Login dengan email dan password yang sudah didaftarkan sebelumnya. Jika terjadi kendala hubungin nomor berikut -> 08123456789
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="register_form">
                      <?php
                      if($err) {
                        echo "<ul>$err</ul>";

                      }
                      ?>
                      <h3>LOGIN</h3>
                        <form action="" method="post">
                          <div class="mt-10">
                            <input type="email" name="email" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required class="single-input">
                          </div>
                          <div class="mt-10">
                              <input type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required class="single-input">
                          </div>
                          <div class="mt-10">
                              <button type="submit" name="login" class="genric-btn primary circle">Login</button>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================ End Registration Area =================-->

    <!--================ Start Trainers Area =================-->
    <section class="trainer_area section_gap_top">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3">Petinggi Sekolah</h2>
              <p>
                "Berdedikasi mengajar, menginspirasi masa depan cerah"
              </p>
            </div>
          </div>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
          <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
            <div class="thumb d-flex justify-content-sm-center">
              <img class="img-fluid" src="img/trainer/t2.png" alt="" />
            </div>
            <div class="meta-text text-sm-center">
              <h4>Lina Soimatu, S.Pd.</h4>
              <p class="designation">Kepala kesiswaan</p>
              <div class="mb-4">
                <p>
                  Beliau menjabat sebagai kepala kesiswaan SMA AL-irsyad Kota Tegal sejak tahun 2020.
                </p>
              </div>
              <!-- <div class="align-items-center justify-content-center d-flex">
                <a href="#"><i class="ti-facebook"></i></a>
                <a href="#"><i class="ti-twitter"></i></a>
                <a href="#"><i class="ti-linkedin"></i></a>
                <a href="#"><i class="ti-pinterest"></i></a>
              </div> -->
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
            <div class="thumb d-flex justify-content-sm-center">
              <img class="img-fluid" src="img/trainer/t3.png" alt="" />
            </div>
            <div class="meta-text text-sm-center">
              <h4>Desi Arief S, S.Pd.</h4>
              <p class="designation">Wakil Kepala Sekolah</p>
              <div class="mb-4">
                <p>
                  Beliau menjabat sebagai wakil kepala kesiswaan SMA AL-irsyad Kota Tegal sejak tahun 2023.
                </p>
              </div>
              <!-- <div class="align-items-center justify-content-center d-flex">
                <a href="#"><i class="ti-facebook"></i></a>
                <a href="#"><i class="ti-twitter"></i></a>
                <a href="#"><i class="ti-linkedin"></i></a>
                <a href="#"><i class="ti-pinterest"></i></a>
              </div> -->
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
            <div class="thumb d-flex justify-content-sm-center">
              <img class="img-fluid" src="img/trainer/t1.png" alt="" />
            </div>
            <div class="meta-text text-sm-center">
              <h4>Sakuri, S.Pd.</h4>
              <p class="designation">Kepala Sekolah</p>
              <div class="mb-4">
                <p>
                  Beliau menjabat sebagai kepala sekolah SMA AL-irsyad Kota Tegal sejak tahun 2023.
                </p>
              </div>
              <!-- <div class="align-items-center justify-content-center d-flex">
                <a href="#"><i class="ti-facebook"></i></a>
                <a href="#"><i class="ti-twitter"></i></a>
                <a href="#"><i class="ti-linkedin"></i></a>
                <a href="#"><i class="ti-pinterest"></i></a>
              </div> -->
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
            <div class="thumb d-flex justify-content-sm-center">
              <img class="img-fluid" src="img/trainer/t4.png" alt="" />
            </div>
            <div class="meta-text text-sm-center">
              <h4>Dicky A, S.Pd.</h4>
              <p class="designation">Kepala IT</p>
              <div class="mb-4">
                <p>
                  Beliau menjabat sebagai kepala IT SMA AL-irsyad Kota Tegal sejak tahun 2014.
                </p>
              </div>
              <!-- <div class="align-items-center justify-content-center d-flex">
                <a href="#"><i class="ti-facebook"></i></a>
                <a href="#"><i class="ti-twitter"></i></a>
                <a href="#"><i class="ti-linkedin"></i></a>
                <a href="#"><i class="ti-pinterest"></i></a>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ End Trainers Area =================-->

    <!--================ Start Events Area =================-->
    <div class="events_area">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3 text-white">Acara Mendatang</h2>
              <p class="mb-3 text-white">
                Tunggu keseruan acara mendatang dari SMA AL-irsyad 
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <div class="single_event position-relative">
              <div class="event_thumb">
                <img src="img/event/e1.jpg" alt="" />
              </div>
              <div class="event_details">
                <div class="d-flex mb-4">
                  <div class="date"><span>15</span> Jun</div>

                  <div class="time-location">
                    <p>
                      <span class="ti-time mr-2"></span> 12:00 AM - 12:30 AM
                    </p>
                    <p>
                      <span class="ti-location-pin mr-2"></span> Hilton Quebec
                    </p>
                  </div>
                </div>
                <p>
                  One make creepeth man for so bearing their firmament won't
                  fowl meat over seas great
                </p>
                <a href="#" class="primary-btn rounded-0 mt-3">View Details</a>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="single_event position-relative">
              <div class="event_thumb">
                <img src="img/event/e2.jpg" alt="" />
              </div>
              <div class="event_details">
                <div class="d-flex mb-4">
                  <div class="date"><span>15</span> Jun</div>

                  <div class="time-location">
                    <p>
                      <span class="ti-time mr-2"></span> 12:00 AM - 12:30 AM
                    </p>
                    <p>
                      <span class="ti-location-pin mr-2"></span> Hilton Quebec
                    </p>
                  </div>
                </div>
                <p>
                  One make creepeth man for so bearing their firmament won't
                  fowl meat over seas great
                </p>
                <a href="#" class="primary-btn rounded-0 mt-3">View Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================ End Events Area =================-->

    <!--================ Start Testimonial Area =================-->
    <div class="testimonial_area section_gap">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3">Guru dan Staf</h2>
              <p>
                Guru adalah pahlawan tanpa tanda jasa
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="testi_slider owl-carousel">
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="img/testimonials/g1.png" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Nurjanah, S.Pd</h4>
                    <p>
                      Beliau adalah guru di SMA AL-irsyad Kota Tegal yang mengajar mata pelajaran 
                      matematika untuk kelas 11 dan 12.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="img/testimonials/g2.png" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Mulyati, S.Pd</h4>
                    <p>
                      Beliau adalah guru di SMA AL-irsyad Kota Tegal yang mengajar mata pelajaran 
                      bahasa indonesia untuk kelas 11 dan 12. 
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="img/testimonials/g3.png" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Drs. Zamroni</h4>
                    <p>
                      Beliau adalah guru di SMA AL-irsyad Kota Tegal yang mengajar mata pelajaran 
                      biologi untuk kelas 11 dan 12.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="img/testimonials/g4.png" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>A Aan Setianto, S.Pd</h4>
                    <p>
                      Beliau adalah guru di SMA AL-irsyad Kota Tegal yang mengajar mata pelajaran
                      bahasa indonesia untuk kelas 10 dan 11.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="img/testimonials/g4.png" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Drs. Tri Setiadi</h4>
                    <p>
                      Beliau adalah guru di SMA AL-irsyad Kota Tegal yang mengajar mata pelajaran 
                      Bimbingan dan Konseling untuk kelas 11 dan 12.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="img/testimonials/g6.png" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Mustoviyah, S.Ag</h4>
                    <p>
                      Beliau adalah guru di SMA AL-irsyad Kota Tegal yang mengajar mata pelajaran 
                      Agama islam untuk kelas 10, 11 dan 12.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="img/testimonials/g7.png" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>Adnan Alkah, S.Pd</h4>
                    <p>
                      Beliau adalah guru di SMA AL-irsyad Kota Tegal yang mengajar mata pelajaran 
                      penjas untuk kelas 11 dan 12. 
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi_item">
              <div class="row">
                <div class="col-lg-4 col-md-6">
                  <img src="img/testimonials/g8.png" alt="" />
                </div>
                <div class="col-lg-8">
                  <div class="testi_text">
                    <h4>A Nur Afandi, S.Pd</h4>
                    <p>
                      Beliau adalah guru di SMA AL-irsyad Kota Tegal yang mengajar mata pelajaran 
                      fisika untuk kelas 11 dan 12. 
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================ End Testimonial Area =================-->

    <!--================ Start footer Area  =================-->
    <footer class="footer-area section_gap">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-md-6 single-footer-widget">
            <h4>Top Products</h4>
            <ul>
              <li><a href="#">Managed Website</a></li>
              <li><a href="#">Manage Reputation</a></li>
              <li><a href="#">Power Tools</a></li>
              <li><a href="#">Marketing Service</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-6 single-footer-widget">
            <h4>Quick Links</h4>
            <ul>
              <li><a href="#">Jobs</a></li>
              <li><a href="#">Brand Assets</a></li>
              <li><a href="#">Investor Relations</a></li>
              <li><a href="#">Terms of Service</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-6 single-footer-widget">
            <h4>Features</h4>
            <ul>
              <li><a href="#">Jobs</a></li>
              <li><a href="#">Brand Assets</a></li>
              <li><a href="#">Investor Relations</a></li>
              <li><a href="#">Terms of Service</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-6 single-footer-widget">
            <h4>Resources</h4>
            <ul>
              <li><a href="#">Guides</a></li>
              <li><a href="#">Research</a></li>
              <li><a href="#">Experts</a></li>
              <li><a href="#">Agencies</a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-6 single-footer-widget">
            <h4>Newsletter</h4>
            <div class="form-wrap" id="mc_embed_signup">
              <form
                target="_blank"
                action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                method="get"
                class="form-inline"
              >
                <input
                  class="form-control"
                  name="EMAIL"
                  placeholder="Your Email Address"
                  onfocus="this.placeholder = ''"
                  onblur="this.placeholder = 'Your Email Address'"
                  required=""
                  type="email"
                />
                <button class="click-btn btn btn-default">
                  <span>subscribe</span>
                </button>
                <div style="position: absolute; left: -5000px;">
                  <input
                    name="b_36c4fd991d266f23781ded980_aefe40901a"
                    tabindex="-1"
                    value=""
                    type="text"
                  />
                </div>

                <div class="info"></div>
              </form>
            </div>
          </div>
        </div>
        <div class="row footer-bottom d-flex justify-content-between">
          <p class="col-lg-8 col-sm-12 footer-text m-0 text-white">
           Nuhgroh Ramadani 2024</script> <i class="ti-heart" aria-hidden="true"></i> by <a href="https://www.instagram.com/nugroh_ramadan/" target="_blank">nugroh_ramadan</a>
          </p>
          <div class="col-lg-4 col-sm-12 footer-social">
            <a href="#"><i class="ti-facebook"></i></a>
            <a href="#"><i class="ti-twitter"></i></a>
            <a href="#"><i class="ti-dribbble"></i></a>
            <a href="#"><i class="ti-linkedin"></i></a>
          </div>
        </div>
      </div>
    </footer>
    <!--================ End footer Area  =================-->

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
