<?php
session_start();
include 'koneksi.php';

// Check if the user is logged in and is a 'guru'
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'guru') {
    header('Location: index.php');
    exit();
}

// Functionality to handle form submissions and database interactions

$message = "";

if (isset($_POST['create_user'])) {
    $id_user = $_POST['id_user'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

    // Check if the email or id_user already exists
    $stmt = $koneksi->prepare("SELECT * FROM usser WHERE email = ? OR id_user = ?");
    $stmt->bind_param("si", $email, $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $message = "User with this email or ID already exists.";
    } else {
        $stmt->close(); // Close the previous statement
        $stmt = $koneksi->prepare("INSERT INTO usser (id_user, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id_user, $email, $password, $role);
        $stmt->execute();
        $stmt->close();
        $message = "User created successfully.";
    }
}

if (isset($_POST['add_student'])) {
    $id_user = $_POST['id_user'];
    $NISN = $_POST['NISN'];
    $id_kelas = $_POST['id_kelas'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $nama = $_POST['nama'];

    $stmt = $koneksi->prepare("INSERT INTO siswa (id_user, NISN, id_kelas, tanggal_lahir, jenis_kelamin, alamat, nama) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $id_user, $NISN, $id_kelas, $tanggal_lahir, $jenis_kelamin, $alamat, $nama);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST['search_student'])) {
    $search_name = trim($_POST['search_name']);
    if (!empty($search_name)) {
        $stmt = $koneksi->prepare("SELECT * FROM siswa WHERE nama LIKE ?");
        $like_search_name = "%" . $search_name . "%";
        $stmt->bind_param("s", $like_search_name);
        $stmt->execute();
        $result_students = $stmt->get_result();
    } else {
        $result_students = null;
    }
}

if (isset($_POST['assign_grade'])) {
    $id_siswa = $_POST['id_siswa'];
    $id_mata_pelajaran = $_POST['id_mata_pelajaran'];
    $nilai = $_POST['nilai'];

    $stmt = $koneksi->prepare("INSERT INTO nilai (id_siswa, id_mata_pelajaran, nilai) VALUES (?, ?, ?)");
    $stmt->bind_param("iid", $id_siswa, $id_mata_pelajaran, $nilai);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="img/logo-alirsyad.png" type="image/png" />
    <title>Admin Panel</title>
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
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand" href="index.html">
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
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin.php">Admin</a>
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
                            <h2>Admin Panel</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <section class="admin-panel container mt-5">
        <?php if ($message): ?>
            <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-6">
                <h3>Create New User</h3>
                <form action="admin.php" method="POST">
                    <div class="form-group">
                        <label for="id_user">User ID:</label>
                        <input type="text" class="form-control" name="id_user" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <br>
                        <select class="form-control" name="role" required>
                            <option value="siswa">Siswa</option>
                            <option value="guru">Guru</option>
                        </select>
                    </div>
                    <br>
                    <br>
                    <button type="submit" class="btn btn-primary" name="create_user">Create User</button>
                </form>
            </div>
            <div class="col-lg-6">
                <h3>Add New Student</h3>
                <form action="admin.php" method="POST">
                    <div class="form-group">
                        <label for="id_user">User ID:</label>
                        <input type="text" class="form-control" name="id_user" required>
                    </div>
                    <div class="form-group">
                        <label for="NISN">NISN:</label>
                        <input type="text" class="form-control" name="NISN" required>
                    </div>
                    <div class="form-group">
                        <label for="id_kelas">Class ID:</label>
                        <input type="text" class="form-control" name="id_kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Date of Birth:</label>
                        <input type="date" class="form-control" name="tanggal_lahir" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Gender:</label>
                        <br>
                        <select class="form-control" name="jenis_kelamin" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="alamat">Address:</label>
                        <input type="text" class="form-control" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Name:</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="add_student">Add Student</button>
                </form>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-12">
                <h3>Search Student</h3>
                <form action="admin.php" method="POST">
                    <div class="form-group">
                        <label for="search_name">Student Name:</label>
                        <input type="text" class="form-control" name="search_name">
                    </div>
                    <button type="submit" class="btn btn-primary" name="search_student">Search</button>
                </form>
                <?php if (isset($result_students) && $result_students !== null && $result_students->num_rows > 0): ?>
                    <h4 class="mt-3">Search Results:</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>NISN</th>
                                <th>Class ID</th>
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result_students->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id_siswa']) ?></td>
                                    <td><?= htmlspecialchars($row['nama']) ?></td>
                                    <td><?= htmlspecialchars($row['NISN']) ?></td>
                                    <td><?= htmlspecialchars($row['id_kelas']) ?></td>
                                    <td><?= htmlspecialchars($row['tanggal_lahir']) ?></td>
                                    <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                                    <td><?= htmlspecialchars($row['alamat']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-12">
                <h3>Beri Nilai</h3>
                <form action="admin.php" method="POST">
                    <div class="form-group">
                        <label for="id_siswa">Student ID:</label>
                        <input type="text" class="form-control" name="id_siswa" required>
                    </div>
                    <div class="form-group">
                        <label for="id_mata_pelajaran">Mata Pelajaran ID:</label>
                        <input type="text" class="form-control" name="id_mata_pelajaran" required>
                    </div>
                    <div class="form-group">
                        <label for="nilai">Grade:</label>
                        <input type="number" class="form-control" name="nilai" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="assign_grade">Assign Grade</button>
                </form>
            </div>
        </div>
    </section>
    <br>
    <br>
    <br>
    <br>

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
