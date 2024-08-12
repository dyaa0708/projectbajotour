<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Website</title>
    <!-- Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Gaya untuk teks 'Bajo' */
        .brand-part1 {
            color: black;
            font-family: 'Poppins', sans-serif; 
        }

        /* Gaya untuk teks 'Tour' */
        .brand-part2 {
            font-family: 'Poppins', sans-serif;
            color: #00A7C7; 
        }
        .footer {
            background-color: #00A7C7;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .footer a {
            color: #fff;
            margin: 0 10px;
        }
        .testimonial-card {
            border: 1px solid #E76F3B;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            min-height: 250px; 
        }

        .testimonial-card .testimonial-text {
            font-style: italic;
            margin-bottom: 10px;
        }

        .testimonial-card .testimonial-author {
            font-weight: bold;
        }
        .carousel-inner {
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4); /* Warna hitam dengan opasitas 40% */
        }

        .carousel-caption {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }

        .carousel-caption h1,
        .carousel-caption h2 {
            margin: 0;
        }

        .carousel-caption h1 {
            font-size: 3em; /* Sesuaikan ukuran teks sesuai kebutuhan */
        }
        .footer-content {
            display: flex;
            justify-content: space-between;
        }

        .left-section,
        .right-section {
            flex-basis: 45%;
        }

        /* Style untuk gambar dan teks pada footer */
        .footer a {
            display: flex;
            align-items: center;
            color: white;
            margin-bottom: 5px;
            font-size: 16pt;
        }

        .footer a img {
            margin-right: 10px;
            height: 25px; /* Sesuaikan tinggi gambar ikon */
        }


    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <a class="navbar-brand" href="#">
            <span class="brand-part1">Bajo</span><span class="brand-part2">Tour</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#" id="berandaText">Beranda <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="destinasi.php" id="destinasiText">Destinasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#footer" id="kontakText">Kontak</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Bahasa
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#" onclick="changeLanguage('id')">Bahasa Indonesia</a>
                        <a class="dropdown-item" href="#" onclick="changeLanguage('en')">English</a>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <?php

                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                    // Jika pengguna telah login, tampilkan logo pengguna dan nama emailnya
                    $userEmail = $_SESSION['user_email'];
                    echo '<li class="nav-item dropdown">';
                    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> ' . $userEmail . '
                        </a>';
                    echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                    echo '<a class="dropdown-item" href="logout.php">Logout</a>';
                    echo '</div>';
                    echo '</li>';
                } else {
                    // Jika belum login, tampilkan menu login
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Login</a>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </nav>

    <?php

    // Cek jika ada pesan sukses dalam session
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                ' . $_SESSION['success_message'] . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        
        // Hapus pesan sukses dari session agar tidak ditampilkan lagi setelah refresh
        unset($_SESSION['success_message']);
    }
    // Tampilkan pesan sukses jika ada
    if (isset($_SESSION['success_message_login'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                ' . $_SESSION['success_message_login'] . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        
        // Hapus pesan sukses dari session agar tidak ditampilkan lagi setelah refresh
        unset($_SESSION['success_message_login']);
    }

    // Tampilkan pesan error jika ada
    if (isset($_SESSION['error_message_login'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                ' . $_SESSION['error_message_login'] . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        
        // Hapus pesan error dari session agar tidak ditampilkan lagi setelah refresh
        unset($_SESSION['error_message_login']);
    }

    // Tampilkan pesan error jika ada
    if (isset($_SESSION['ulasan_login_error'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                ' . $_SESSION['ulasan_login_error'] . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        
        // Hapus pesan error dari session agar tidak ditampilkan lagi setelah refresh
        unset($_SESSION['ulasan_login_error']);
    }

    // Tampilkan pesan error jika ada
    if (isset($_SESSION['ulasan_success_message'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                ' . $_SESSION['ulasan_success_message'] . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        
        // Hapus pesan error dari session agar tidak ditampilkan lagi setelah refresh
        unset($_SESSION['ulasan_success_message']);
    }

    // Tampilkan pesan error jika ada
    if (isset($_SESSION['success_lupa_password'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                ' . $_SESSION['ulasan_success_message'] . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        
        // Hapus pesan error dari session agar tidak ditampilkan lagi setelah refresh
        unset($_SESSION['ulasan_success_message']);
    }

    // Tampilkan pesan error jika ada
    if (isset($_SESSION['error_lupa_password'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                ' . $_SESSION['error_lupa_password'] . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        
        // Hapus pesan error dari session agar tidak ditampilkan lagi setelah refresh
        unset($_SESSION['error_lupa_password']);
    }
    ?>


    <!-- Carousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="overlay"></div>
                <img src="assets/background-1.jpg" class="d-block w-100" alt="Slide 1">
                <div class="carousel-caption">
                    <h1 class="font-weight-bold" id="mau">Mau Liburan?</h1>
                    <h1 class="font-weight-bold" id="ke">Ke Labuan Bajo Aja!</h1>
                </div>
            </div>
            <div class="carousel-item">
                <div class="overlay"></div>
                <img src="assets/background-2.png" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption">
                    <h1 class="font-weight-bold" id="mau2">Mau Liburan?</h1>
                    <h1 class="font-weight-bold" id="ke2">Ke Labuan Bajo Aja!</h1>
                </div>
            </div>
            <div class="carousel-item">
                <div class="overlay"></div>
                <img src="assets/background-3.jpeg" class="d-block w-100" alt="Slide 3">
                <div class="carousel-caption">
                    <h1 class="font-weight-bold" id="mau3">Mau Liburan?</h1>
                    <h1 class="font-weight-bold" id="ke3">Ke Labuan Bajo Aja!</h1>
                </div>
            </div>
            <!-- Tambahkan item carousel lainnya di sini -->
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <br>

    <!-- Modal Login -->
    <div class="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form login -->
                <form action="proses_login.php" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukkan alamat email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan password" required>
                    </div>
                    <!-- Hyperlinks -->
                    <div class="form-group d-flex justify-content-between align-items-center">
                        <div>
                            <a href="#" class="mr-3" data-toggle="modal" data-target="#registerModal">Belum Punya Akun?</a>
                            <a href="#" data-toggle="modal" data-target="#forgotPasswordModal">Lupa Password?</a>
                        </div>
                        <button type="submit" class="btn btn-primary">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Akhir Modal Login -->

    <!-- Modal Register -->
    <div class="modal" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Daftar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form pendaftaran -->
                <form action="proses_register.php" method="post">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control"  placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan alamat email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Akhir Modal Register -->

    <!-- Modal Lupa Password -->
    <div class="modal" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">Lupa Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form lupa password -->
                <form action="proses_lupa_password.php" method="post">
                    <div class="form-group">
                        <label for="forgotPasswordEmail">Alamat Email</label>
                        <input type="email" class="form-control" name="forgotPasswordEmail" name="forgotPasswordEmail"
                            placeholder="Masukkan alamat email" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">Password Baru</label>
                        <input type="password" class="form-control" name="newPassword" placeholder="Masukkan password baru" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" name="confirmPassword"
                            placeholder="Konfirmasi password baru" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Akhir Modal Lupa Password -->


    <!-- Deskripsi Labuan Bajo -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text mb-4" id="selamat">Selamat datang di Labuan Bajo, Surga Tersembunyi Indonesia!</h1>
                <p id="dengan">
                    Dengan keindahan alamnya yang memukau, Labuan Bajo adalah destinasi impian bagi para pencinta petualangan dan keindahan alam. Terletak di ujung barat Pulau Flores, Labuan Bajo menawarkan pesona alam yang memikat, mulai dari perairan biru jernih hingga bukit-bukit hijau yang menakjubkan.
                </p>
                <p id="nikmati">
                    Nikmati keindahan bawah laut Labuan Bajo dengan snorkeling atau diving di Taman Nasional Komodo, tempat tinggal bagi hewan purba, Komodo. Jelajahi keindahan Pulau Padar yang menawarkan pemandangan panorama alam yang spektakuler, atau kunjungi Gua Batu Cermin yang menakjubkan dengan formasi batu dan stalaktitnya yang menakjubkan.
                </p>
                <p id="dengan2">
                    Dengan beragam kegiatan dan keindahan alamnya yang menakjubkan, Labuan Bajo adalah destinasi yang sempurna untuk liburan tak terlupakan. Jadi, jadikan Labuan Bajo sebagai tujuan wisata berikutnya dan buat kenangan indah yang tak terlupakan di sana!
                </p>
            </div>
        </div>
    </div>
    <br>

    <!-- Ulasan tentang Labuan Bajo -->
    <div class="container mt-4">
        <h2 class="mb-4" id="apa">Apa kata orang tentang Labuan Bajo?</h2>
        <!-- Formulir untuk membuat ulasan -->
        <form action="proses_ulasan.php" method="post">
            <div class="form-group">
                <label for="namaWisata" id="nw">Nama Wisata:</label>
                <input type="text" class="form-control" id="namaWisata" name="nama_wisata" placeholder="Masukkan nama wisata">
            </div>
            <div class="form-group">
                <label for="ulasan" id="u">Ulasan:</label>
                <textarea class="form-control" id="ulasan" name="ulasan" rows="3" placeholder="Tulis ulasan Anda"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" id="ku">Kirim Ulasan</button>
        </form>
        <br>
        <div class="container">
            <div class="row">
                <!-- Card 1 -->
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">Ulasan mengenai Labuan Bajo adalah destinasi yang luar biasa!</p>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex align-items-center">
                                <img src="assets/hansohee.jpg" alt="Foto Penulis 1" class="mr-3 rounded-circle" width="50" height="50">
                                <div>
                                    <h5 class="card-title mb-0">Han So Hee</h5>
                                    <p class="card-text text-muted">Traveler</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">Labuan Bajo adalah surga bagi para petualang!</p>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex align-items-center">
                                <img src="assets/mark-zuck.jpeg" alt="Foto Penulis 2" class="mr-3 rounded-circle" width="50" height="50">
                                <div>
                                    <h5 class="card-title mb-0">Mark Zuckerberg</h5>
                                    <p class="card-text text-muted">Travel Blogger</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">Labuan Bajo memiliki keindahan alam yang luar biasa!</p>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex align-items-center">
                                <img src="assets/elon.jpeg" alt="Foto Penulis 3" class="mr-3 rounded-circle" width="50" height="50">
                                <div>
                                    <h5 class="card-title mb-0">Elon Musk</h5>
                                    <p class="card-text text-muted">Penggiat Alam</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lakukan koneksi ke database -->
        <?php
        $servername = "localhost"; // Sesuaikan dengan nama server Anda
        $username = "root"; // Sesuaikan dengan username MySQL Anda
        $password_db = ""; // Sesuaikan dengan password MySQL Anda
        $dbname = "bajotour"; // Sesuaikan dengan nama database Anda

        // Buat koneksi
        $conn = new mysqli($servername, $username, $password_db, $dbname);

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query untuk mengambil data ulasan
        $query = "SELECT * FROM ulasan"; // Sesuaikan dengan nama tabel Anda
        $result = $conn->query($query);
        ?>

        <!-- Tampilkan data ulasan dalam kartu ulasan -->
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['nama_wisata']; ?></h5>
                                <p class="card-text"><?php echo $row['ulasan']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "";
            }
            ?>
        </div>

        <!-- Tutup koneksi -->
        <?php
        $conn->close();
        ?>

    </div>
    <br>

    <!-- Footer -->
    <footer class="footer" id="footer">
        <div class="container"><br>
        <h1 id="hk">Hubungi Kami</h1><br>
            <div class="footer-content">
                <div class="left-section">
                    <p>
                        <a href="#">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.2498 4.16663H33.7498C40.4165 4.16663 45.8332 9.58329 45.8332 16.25V33.75C45.8332 36.9547 44.5601 40.0281 42.294 42.2942C40.028 44.5602 36.9545 45.8333 33.7498 45.8333H16.2498C9.58317 45.8333 4.1665 40.4166 4.1665 33.75V16.25C4.1665 13.0453 5.43957 9.97182 7.70563 7.70575C9.9717 5.43969 13.0451 4.16663 16.2498 4.16663ZM15.8332 8.33329C13.844 8.33329 11.9364 9.12347 10.5299 10.53C9.12335 11.9365 8.33317 13.8442 8.33317 15.8333V34.1666C8.33317 38.3125 11.6873 41.6666 15.8332 41.6666H34.1665C36.1556 41.6666 38.0633 40.8765 39.4698 39.4699C40.8763 38.0634 41.6665 36.1558 41.6665 34.1666V15.8333C41.6665 11.6875 38.3123 8.33329 34.1665 8.33329H15.8332ZM35.9373 11.4583C36.628 11.4583 37.2904 11.7327 37.7788 12.221C38.2671 12.7094 38.5415 13.3718 38.5415 14.0625C38.5415 14.7531 38.2671 15.4155 37.7788 15.9039C37.2904 16.3923 36.628 16.6666 35.9373 16.6666C35.2467 16.6666 34.5843 16.3923 34.0959 15.9039C33.6075 15.4155 33.3332 14.7531 33.3332 14.0625C33.3332 13.3718 33.6075 12.7094 34.0959 12.221C34.5843 11.7327 35.2467 11.4583 35.9373 11.4583ZM24.9998 14.5833C27.7625 14.5833 30.412 15.6808 32.3655 17.6343C34.319 19.5878 35.4165 22.2373 35.4165 25C35.4165 27.7626 34.319 30.4122 32.3655 32.3657C30.412 34.3192 27.7625 35.4166 24.9998 35.4166C22.2372 35.4166 19.5876 34.3192 17.6341 32.3657C15.6806 30.4122 14.5832 27.7626 14.5832 25C14.5832 22.2373 15.6806 19.5878 17.6341 17.6343C19.5876 15.6808 22.2372 14.5833 24.9998 14.5833ZM24.9998 18.75C23.3422 18.75 21.7525 19.4084 20.5804 20.5805C19.4083 21.7526 18.7498 23.3424 18.7498 25C18.7498 26.6576 19.4083 28.2473 20.5804 29.4194C21.7525 30.5915 23.3422 31.25 24.9998 31.25C26.6574 31.25 28.2472 30.5915 29.4193 29.4194C30.5914 28.2473 31.2498 26.6576 31.2498 25C31.2498 23.3424 30.5914 21.7526 29.4193 20.5805C28.2472 19.4084 26.6574 18.75 24.9998 18.75Z" fill="white"/></svg>
                            <span style="margin-left: 30px;">@bajo.tour</span>
                        </a>
                    </p>
                    <p>
                        <a href="#">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M45.8332 12.5C45.8332 10.2084 43.9582 8.33337 41.6665 8.33337H8.33317C6.0415 8.33337 4.1665 10.2084 4.1665 12.5V37.5C4.1665 39.7917 6.0415 41.6667 8.33317 41.6667H41.6665C43.9582 41.6667 45.8332 39.7917 45.8332 37.5V12.5ZM41.6665 12.5L24.9998 22.9167L8.33317 12.5H41.6665ZM41.6665 37.5H8.33317V16.6667L24.9998 27.0834L41.6665 16.6667V37.5Z" fill="#F8F8F8"/></svg>
                            <span style="margin-left: 30px;">bajotourr@gmail.com</span>
                        </a>
                    </p>
                    <p>
                        <a href="#">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M39.6877 10.2291C37.7777 8.29981 35.5026 6.7701 32.9952 5.72923C30.4879 4.68837 27.7983 4.15717 25.0835 4.16663C13.7085 4.16663 4.43766 13.4375 4.43766 24.8125C4.43766 28.4583 5.396 32 7.18766 35.125L4.271 45.8333L15.2085 42.9583C18.2293 44.6041 21.6252 45.4791 25.0835 45.4791C36.4585 45.4791 45.7293 36.2083 45.7293 24.8333C45.7293 19.3125 43.5835 14.125 39.6877 10.2291ZM25.0835 41.9791C22.0002 41.9791 18.9793 41.1458 16.3335 39.5833L15.7085 39.2083L9.2085 40.9166L10.9377 34.5833L10.521 33.9375C8.80797 31.202 7.89837 28.04 7.896 24.8125C7.896 15.3541 15.6043 7.64579 25.0627 7.64579C29.646 7.64579 33.9585 9.43746 37.1877 12.6875C38.7866 14.2791 40.0537 16.1722 40.9156 18.2571C41.7774 20.342 42.2169 22.5773 42.2085 24.8333C42.2502 34.2916 34.5418 41.9791 25.0835 41.9791ZM34.5002 29.1458C33.9793 28.8958 31.4377 27.6458 30.9793 27.4583C30.5002 27.2916 30.1668 27.2083 29.8127 27.7083C29.4585 28.2291 28.4793 29.3958 28.1877 29.7291C27.896 30.0833 27.5835 30.125 27.0627 29.8541C26.5418 29.6041 24.8752 29.0416 22.9168 27.2916C21.3752 25.9166 20.3543 24.2291 20.0418 23.7083C19.7502 23.1875 20.0002 22.9166 20.271 22.6458C20.5002 22.4166 20.7918 22.0416 21.0418 21.75C21.2918 21.4583 21.396 21.2291 21.5627 20.8958C21.7293 20.5416 21.646 20.25 21.521 20C21.396 19.75 20.3543 17.2083 19.9377 16.1666C19.521 15.1666 19.0835 15.2916 18.771 15.2708H17.771C17.4168 15.2708 16.8752 15.3958 16.396 15.9166C15.9377 16.4375 14.6043 17.6875 14.6043 20.2291C14.6043 22.7708 16.4585 25.2291 16.7085 25.5625C16.9585 25.9166 20.3543 31.125 25.521 33.3541C26.7502 33.8958 27.7085 34.2083 28.4585 34.4375C29.6877 34.8333 30.8127 34.7708 31.7085 34.6458C32.7085 34.5 34.771 33.3958 35.1877 32.1875C35.6252 30.9791 35.6252 29.9583 35.4793 29.7291C35.3335 29.5 35.021 29.3958 34.5002 29.1458Z" fill="#F8F8F8"/></svg>
                            <span style="margin-left: 30px;">0812-3204-0567</span>
                        </a>
                    </p>
                </div>
                <div class="right-section">
                    <p>
                        <a href="#">
                        <svg width="50" height="50" viewBox="10 10 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M24.9998 13.5416C26.3812 13.5416 27.7059 14.0904 28.6827 15.0671C29.6594 16.0439 30.2082 17.3686 30.2082 18.75C30.2082 19.4339 30.0735 20.1112 29.8117 20.7431C29.55 21.375 29.1663 21.9492 28.6827 22.4328C28.199 22.9164 27.6249 23.3001 26.993 23.5618C26.3611 23.8236 25.6838 23.9583 24.9998 23.9583C23.6185 23.9583 22.2937 23.4096 21.317 22.4328C20.3402 21.4561 19.7915 20.1313 19.7915 18.75C19.7915 17.3686 20.3402 16.0439 21.317 15.0671C22.2937 14.0904 23.6185 13.5416 24.9998 13.5416ZM24.9998 4.16663C28.8676 4.16663 32.5769 5.70308 35.3118 8.43799C38.0467 11.1729 39.5832 14.8822 39.5832 18.75C39.5832 29.6875 24.9998 45.8333 24.9998 45.8333C24.9998 45.8333 10.4165 29.6875 10.4165 18.75C10.4165 14.8822 11.953 11.1729 14.6879 8.43799C17.4228 5.70308 21.1321 4.16663 24.9998 4.16663ZM24.9998 8.33329C22.2372 8.33329 19.5876 9.43076 17.6341 11.3843C15.6806 13.3378 14.5832 15.9873 14.5832 18.75C14.5832 20.8333 14.5832 25 24.9998 38.9791C35.4165 25 35.4165 20.8333 35.4165 18.75C35.4165 15.9873 34.319 13.3378 32.3655 11.3843C30.412 9.43076 27.7625 8.33329 24.9998 8.33329Z" fill="#F8F8F8"/></svg>
                            <span>Jalan Dieng Atas No. 8, Ds. Sumberjo, Kalisongo, Malang, Jawa Timur, 65151</span>
                        </a>
                    </p>
                </div>
            </div>
            <h5 class="text-center">&copy; 2023 Labuan Bajo Tour</h5>
        </div>
    </footer>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Initialize Carousel -->
    <script>
        $(document).ready(function () {
            $('.carousel').carousel();
        });
        // Tangani peristiwa ketika modal lupa password ditampilkan
        $('#forgotPasswordModal').on('shown.bs.modal', function (e) {
            // Sembunyikan modal register jika ditampilkan
            $('#loginModal').modal('hide');
        });
        // Tangani peristiwa ketika modal pendaftaran ditampilkan
        $('#registerModal').on('shown.bs.modal', function (e) {
            // Sembunyikan modal login
            $('#loginModal').modal('hide');
        });
    </script>
    <script>
        function changeLanguage(langCode) {
            if (langCode === 'id') {
                document.getElementById('berandaText').innerText = 'Beranda';
                document.getElementById('destinasiText').innerText = 'Destinasi';
                document.getElementById('kontakText').innerText = 'Kontak';
                document.getElementById('mau').innerText = 'Mau Liburan?';
                document.getElementById('ke').innerText = 'Ke Labuan Bajo Aja!';
                document.getElementById('mau2').innerText = 'Mau Liburan?';
                document.getElementById('ke2').innerText = 'Ke Labuan Bajo Aja!';
                document.getElementById('mau3').innerText = 'Mau Liburan?';
                document.getElementById('ke3').innerText = 'Ke Labuan Bajo Aja!';
                document.getElementById('selamat').innerText = 'Selamat datang di Labuan Bajo, Surga Tersembunyi Indonesia!';
                document.getElementById('dengan').innerText = 'Dengan keindahan alamnya yang memukau, Labuan Bajo adalah destinasi impian bagi para pencinta petualangan dan keindahan alam. Terletak di ujung barat Pulau Flores, Labuan Bajo menawarkan pesona alam yang memikat, mulai dari perairan biru jernih hingga bukit-bukit hijau yang menakjubkan.';
                document.getElementById('nikmati').innerText = 'Nikmati keindahan bawah laut Labuan Bajo dengan snorkeling atau diving di Taman Nasional Komodo, tempat tinggal bagi hewan purba, Komodo. Jelajahi keindahan Pulau Padar yang menawarkan pemandangan panorama alam yang spektakuler, atau kunjungi Gua Batu Cermin yang menakjubkan dengan formasi batu dan stalaktitnya yang menakjubkan.';
                document.getElementById('dengan2').innerText = 'Dengan beragam kegiatan dan keindahan alamnya yang menakjubkan, Labuan Bajo adalah destinasi yang sempurna untuk liburan tak terlupakan. Jadi, jadikan Labuan Bajo sebagai tujuan wisata berikutnya dan buat kenangan indah yang tak terlupakan di sana!';
                document.getElementById('apa').innerText = 'Apa kata orang tentang Labuan Bajo?';
                document.getElementById('nw').innerText = 'Nama Wisata';
                document.getElementById('u').innerText = 'Ulasan';
                document.getElementById('ku').innerText = 'Kirim Ulasan';
                document.getElementById('hk').innerText = 'Hubungi Kami';
                // Add more elements to change text accordingly for Bahasa Indonesia...
            } else if (langCode === 'en') {
                document.getElementById('berandaText').innerText = 'Home';
                document.getElementById('destinasiText').innerText = 'Destinations';
                document.getElementById('kontakText').innerText = 'Contact';
                document.getElementById('mau').innerText = 'Want To Go On Holiday?';
                document.getElementById('ke').innerText = 'Just Go To Labuan Bajo!';
                document.getElementById('mau2').innerText = 'Want To Go On Holiday?';
                document.getElementById('ke2').innerText = 'Just Go To Labuan Bajo!';
                document.getElementById('mau3').innerText = 'Want To Go On Holiday?';
                document.getElementById('ke3').innerText = 'Just Go To Labuan Bajo!';
                document.getElementById('selamat').innerText = 'Welcome to Labuan Bajo, Indonesia Hidden Paradise!';
                document.getElementById('dengan').innerText = 'With its stunning natural beauty, Labuan Bajo is a dream destination for lovers of adventure and natural beauty. Located on the western tip of Flores Island, Labuan Bajo offers enchanting natural charm, from clear blue waters to stunning green hills.';
                document.getElementById('nikmati').innerText = 'Enjoy the underwater beauty of Labuan Bajo by snorkeling or diving in Komodo National Park, home to the ancient animal, the Komodo dragon. Explore the beauty of Padar Island which offers spectacular natural panoramic views, or visit the amazing Batu Cermin Cave with its amazing rock formations and stalactites.';
                document.getElementById('dengan2').innerText = 'With a variety of activities and stunning natural beauty, Labuan Bajo is the perfect destination for an unforgettable holiday. So, make Labuan Bajo your next tourist destination and make unforgettable beautiful memories there!';
                document.getElementById('apa').innerText = 'What are people saying about Labuan Bajo?';
                document.getElementById('nw').innerText = 'Place Name';
                document.getElementById('u').innerText = 'Review';
                document.getElementById('ku').innerText = 'Send a Review';
                document.getElementById('hk').innerText = 'Contact Us';
                // Add more elements to change text accordingly for English...
            }
        }
    </script>
</html>
