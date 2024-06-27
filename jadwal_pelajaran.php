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
    <title>Jadwal Pelajaran</title>
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
                      <a class="nav-link" href="data_diri.php">Data diiri</a>
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
    <section class="schedule_area section_gap">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="main_title">
              <h2>KELAS 10 A</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Hari</th>
                    <th scope="col">Jam</th>
                    <th scope="col">Mata Pelajaran</th>
                    <th scope="col">Guru</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Senin</td>
                    <td>08:00 - 09:30</td>
                    <td>Matematika</td>
                    <td>Mr. John Doe</td>
                  </tr>
                  <tr>
                    <td>Selasa</td>
                    <td>10:00 - 11:30</td>
                    <td>Bahasa Inggris</td>
                    <td>Ms. Jane Smith</td>
                  </tr>
                  <tr>
                    <td>Rabu</td>
                    <td>13:00 - 14:30</td>
                    <td>Fisika</td>
                    <td>Mr. Michael Johnson</td>
                  </tr>
                  <tr>
                    <td>Kamis</td>
                    <td>15:00 - 16:30</td>
                    <td>Biologi</td>
                    <td>Ms. Emily Davis</td>
                  </tr>
                  <tr>
                    <td>Jumat</td>
                    <td>09:00 - 10:30</td>
                    <td>Sejarah</td>
                    <td>Mr. David Wilson</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

  
      
          <!-- Optional JavaScr</section>ipt -->
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