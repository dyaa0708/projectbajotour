<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasi Wisata</title>
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
        /* Pastikan semua kartu memiliki tinggi yang sama */
        .card {
            height: 100%;
        }

        /* Tentukan ketinggian gambar agar proporsional */
        .card-img-top {
            height: 200px; /* Atur ketinggian gambar sesuai kebutuhan */
            object-fit: cover; /* Untuk memastikan gambar tetap proporsional */
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
                    <a class="nav-link" href="index.php" id="berandaText">Beranda <span class="sr-only">(current)</span></a>
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

    <div class="container mt-4">
    <h1 id="rdw">Ragam Destinasi Wisata</h1><br>
        <div class="row">
            <!-- Card 1 -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="assets/pulau-padar.jpeg" class="card-img-top" alt="Destination 1">
                    <div class="card-body">
                        <h5 class="card-title" id="p1">Pulau Padar</h5>
                        <div class="rating">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.7001 4.62701L20.9471 8.93701C21.1142 9.25428 21.3541 9.52744 21.6472 9.73412C21.9403 9.94079 22.2781 10.0751 22.6331 10.126L27.3791 10.776C29.9171 11.126 30.9011 14.255 29.0241 15.995L25.7741 18.994C25.4971 19.2486 25.2891 19.5692 25.1696 19.926C25.0502 20.2827 25.0232 20.664 25.0911 21.034L25.8841 25.432C26.3251 27.882 23.7761 29.792 21.5391 28.672L17.0031 26.422C16.6908 26.2692 16.3477 26.1898 16.0001 26.1898C15.6524 26.1898 15.3094 26.2692 14.9971 26.422L10.4611 28.672C8.22308 29.782 5.67508 27.882 6.11608 25.432L6.90908 21.033C7.04908 20.283 6.78908 19.513 6.22708 18.993L2.97608 15.995C1.09908 14.265 2.08308 11.125 4.62108 10.775L9.36708 10.125C9.7231 10.0773 10.0623 9.94422 10.3559 9.73721C10.6494 9.53019 10.8886 9.25533 11.0531 8.93601L13.3011 4.62701C14.4451 2.45701 17.5651 2.45701 18.6991 4.62701H18.7001Z" fill="#E76F3B"/></svg>
                                <span style="color: #E76F3B; font-"><strong>4,5(20)</strong></span>
                        </div>
                        <p class="card-text" id="d1">Pulau Padar adalah pulau ketiga terbesar di kawasan Taman Nasional Komodo,Daya tarik Pulau Padar sendiri tidak kalah dengan beberapa pulau lainnya. Wisata trekking atau pendakian yang menawarkan pemandangan yang indah ke laut dari kejauhan, menjelajah fauna setempat (bird watching), serta berenang di sepanjang pantai Padar barat yang terkenal dengan pasir yang berwarna merah muda (pink beach).</p>
                        
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="assets/pulau-koaba.jpg" class="card-img-top" alt="Destination 2">
                    <div class="card-body">
                        <h5 class="card-title" id="p2">Pulau Koaba</h5>
                        <div class="rating">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.7001 4.62701L20.9471 8.93701C21.1142 9.25428 21.3541 9.52744 21.6472 9.73412C21.9403 9.94079 22.2781 10.0751 22.6331 10.126L27.3791 10.776C29.9171 11.126 30.9011 14.255 29.0241 15.995L25.7741 18.994C25.4971 19.2486 25.2891 19.5692 25.1696 19.926C25.0502 20.2827 25.0232 20.664 25.0911 21.034L25.8841 25.432C26.3251 27.882 23.7761 29.792 21.5391 28.672L17.0031 26.422C16.6908 26.2692 16.3477 26.1898 16.0001 26.1898C15.6524 26.1898 15.3094 26.2692 14.9971 26.422L10.4611 28.672C8.22308 29.782 5.67508 27.882 6.11608 25.432L6.90908 21.033C7.04908 20.283 6.78908 19.513 6.22708 18.993L2.97608 15.995C1.09908 14.265 2.08308 11.125 4.62108 10.775L9.36708 10.125C9.7231 10.0773 10.0623 9.94422 10.3559 9.73721C10.6494 9.53019 10.8886 9.25533 11.0531 8.93601L13.3011 4.62701C14.4451 2.45701 17.5651 2.45701 18.6991 4.62701H18.7001Z" fill="#E76F3B"/></svg>
                                <span style="color: #E76F3B; font-"><strong>4,3(15)</strong></span>
                        </div>
                        <p class="card-text" id="d2">Pulau Koaba Adalah Pulau kecil dengan rimbunan hutan lebat dan dikelilingi air biru laut yang berisikan jutaan satwa dan tumbuhan laut ini merupakan rumah bagi ribuan kelelawar besar atau kalong yang pada siang hari bertengger di pepohonan dan berkeliaran pada petang hingga malam hari untuk berburu.</p>
                        
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="assets/pulau-kelor.jpeg" class="card-img-top" alt="Destination 3">
                    <div class="card-body">
                        <h5 class="card-title" id="p3">Pulau Kelor</h5>
                        <div class="rating">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.7001 4.62701L20.9471 8.93701C21.1142 9.25428 21.3541 9.52744 21.6472 9.73412C21.9403 9.94079 22.2781 10.0751 22.6331 10.126L27.3791 10.776C29.9171 11.126 30.9011 14.255 29.0241 15.995L25.7741 18.994C25.4971 19.2486 25.2891 19.5692 25.1696 19.926C25.0502 20.2827 25.0232 20.664 25.0911 21.034L25.8841 25.432C26.3251 27.882 23.7761 29.792 21.5391 28.672L17.0031 26.422C16.6908 26.2692 16.3477 26.1898 16.0001 26.1898C15.6524 26.1898 15.3094 26.2692 14.9971 26.422L10.4611 28.672C8.22308 29.782 5.67508 27.882 6.11608 25.432L6.90908 21.033C7.04908 20.283 6.78908 19.513 6.22708 18.993L2.97608 15.995C1.09908 14.265 2.08308 11.125 4.62108 10.775L9.36708 10.125C9.7231 10.0773 10.0623 9.94422 10.3559 9.73721C10.6494 9.53019 10.8886 9.25533 11.0531 8.93601L13.3011 4.62701C14.4451 2.45701 17.5651 2.45701 18.6991 4.62701H18.7001Z" fill="#E76F3B"/></svg>
                                <span style="color: #E76F3B; font-"><strong>4,7(35)</strong></span>
                        </div>
                        <p class="card-text" id="d3">Pulau Kelor adalah pulau kecil tidak berpenghuni di lepas pantai Labuan Bajo.  Pulau Kelor memiliki area perbukitan di tengahnya, cocok sebagai tempat berfoto atau menikmati pemandangan. Pulau Kelor memiliki pasir putih serta air biru jernih. Garis pantai yang cukup panjang serta ombak lembut membuat Pulau Kelor cocok untuk berenang atau snorkeling.</p>
                        
                    </div>
                </div>
            </div>
            <!-- Tambahkan lebih banyak kartu destinasi di sini sesuai kebutuhan -->
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <!-- Card 4 -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="assets/air-terjun-cunca.jpg" class="card-img-top" alt="Destination 4">
                    <div class="card-body">
                        <h5 class="card-title" id="p4">Air Terjun Cunca</h5>
                        <div class="rating">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.7001 4.62701L20.9471 8.93701C21.1142 9.25428 21.3541 9.52744 21.6472 9.73412C21.9403 9.94079 22.2781 10.0751 22.6331 10.126L27.3791 10.776C29.9171 11.126 30.9011 14.255 29.0241 15.995L25.7741 18.994C25.4971 19.2486 25.2891 19.5692 25.1696 19.926C25.0502 20.2827 25.0232 20.664 25.0911 21.034L25.8841 25.432C26.3251 27.882 23.7761 29.792 21.5391 28.672L17.0031 26.422C16.6908 26.2692 16.3477 26.1898 16.0001 26.1898C15.6524 26.1898 15.3094 26.2692 14.9971 26.422L10.4611 28.672C8.22308 29.782 5.67508 27.882 6.11608 25.432L6.90908 21.033C7.04908 20.283 6.78908 19.513 6.22708 18.993L2.97608 15.995C1.09908 14.265 2.08308 11.125 4.62108 10.775L9.36708 10.125C9.7231 10.0773 10.0623 9.94422 10.3559 9.73721C10.6494 9.53019 10.8886 9.25533 11.0531 8.93601L13.3011 4.62701C14.4451 2.45701 17.5651 2.45701 18.6991 4.62701H18.7001Z" fill="#E76F3B"/></svg>
                                <span style="color: #E76F3B; font-"><strong>4,0(35)</strong></span>
                        </div>
                        <p class="card-text" id="d4">Air Terjun Cunca Wulang merupakan objek wisata alam yang terkenal mirip seperti Green Canyon namun dalam versi kecilnya. Kemiripannya terletak pada aliran sungainya yang berada diantara tebing bebatuan besar dan air terjunnya berada di atas batu-batu dan keluar melalui celah bebatuan. Nama Air Terjun Cunca Wulang memiliki makna tersendiri. Bila diartikan dalam bahasa Indonesia, Cunca dan Wulang sendiri berarti air terjun dan Bulan.</p>
                        
                    </div>
                </div>
            </div>
            <!-- Card 5 -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="assets/taman-nasional-komodo.jpg" class="card-img-top" alt="Destination 5">
                    <div class="card-body">
                        <h5 class="card-title" id="p5">Taman Nasional Komodo</h5>
                        <div class="rating">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.7001 4.62701L20.9471 8.93701C21.1142 9.25428 21.3541 9.52744 21.6472 9.73412C21.9403 9.94079 22.2781 10.0751 22.6331 10.126L27.3791 10.776C29.9171 11.126 30.9011 14.255 29.0241 15.995L25.7741 18.994C25.4971 19.2486 25.2891 19.5692 25.1696 19.926C25.0502 20.2827 25.0232 20.664 25.0911 21.034L25.8841 25.432C26.3251 27.882 23.7761 29.792 21.5391 28.672L17.0031 26.422C16.6908 26.2692 16.3477 26.1898 16.0001 26.1898C15.6524 26.1898 15.3094 26.2692 14.9971 26.422L10.4611 28.672C8.22308 29.782 5.67508 27.882 6.11608 25.432L6.90908 21.033C7.04908 20.283 6.78908 19.513 6.22708 18.993L2.97608 15.995C1.09908 14.265 2.08308 11.125 4.62108 10.775L9.36708 10.125C9.7231 10.0773 10.0623 9.94422 10.3559 9.73721C10.6494 9.53019 10.8886 9.25533 11.0531 8.93601L13.3011 4.62701C14.4451 2.45701 17.5651 2.45701 18.6991 4.62701H18.7001Z" fill="#E76F3B"/></svg>
                                <span style="color: #E76F3B; font-"><strong>4,5(50)</strong></span>
                        </div>
                        <p class="card-text" id="d5">Taman Nasional Komodo ditunjuk sebagai Taman Nasional Pertama Indonesia bersama dengan Taman Nasional Gunung Leuseur, Taman Nasional Ujung Kulon, Taman Nasional Komodo Gunung Gede Pangrango, dan Taman Nasional Baluran pada tanggal 06 Maret 1980. Bentang alamnya menyediakan habitat bagi berbagai satwa liar luar biasa di bumi Indonesia.</p>
                        
                    </div>
                </div>
            </div>
            <!-- Card 6 -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img src="assets/pulau-kanawa.jpeg" class="card-img-top" alt="Destination 6">
                    <div class="card-body">
                        <h5 class="card-title" id="p6">Pulau Kanawa</h5>
                        <div class="rating">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.7001 4.62701L20.9471 8.93701C21.1142 9.25428 21.3541 9.52744 21.6472 9.73412C21.9403 9.94079 22.2781 10.0751 22.6331 10.126L27.3791 10.776C29.9171 11.126 30.9011 14.255 29.0241 15.995L25.7741 18.994C25.4971 19.2486 25.2891 19.5692 25.1696 19.926C25.0502 20.2827 25.0232 20.664 25.0911 21.034L25.8841 25.432C26.3251 27.882 23.7761 29.792 21.5391 28.672L17.0031 26.422C16.6908 26.2692 16.3477 26.1898 16.0001 26.1898C15.6524 26.1898 15.3094 26.2692 14.9971 26.422L10.4611 28.672C8.22308 29.782 5.67508 27.882 6.11608 25.432L6.90908 21.033C7.04908 20.283 6.78908 19.513 6.22708 18.993L2.97608 15.995C1.09908 14.265 2.08308 11.125 4.62108 10.775L9.36708 10.125C9.7231 10.0773 10.0623 9.94422 10.3559 9.73721C10.6494 9.53019 10.8886 9.25533 11.0531 8.93601L13.3011 4.62701C14.4451 2.45701 17.5651 2.45701 18.6991 4.62701H18.7001Z" fill="#E76F3B"/></svg>
                                <span style="color: #E76F3B; font-"><strong>4,2(30)</strong></span>
                        </div>
                        <p class="card-text" id="d6">Pulau Kanawa merupakan sebuah pulau kecil yang memiliki air laut sebening kristal dengan pasir putih dan terumbu karang yang sangat indah. Pulau ini memiliki warna gradasi air laut yang berwarna biru dan cocok sekali dijadikan sebagai tempat wisata untuk menghilangkan penat karena kesibukan pekerjaan.</p>
                        
                    </div>
                </div>
            </div>
            <!-- Tambahkan lebih banyak kartu destinasi di sini sesuai kebutuhan -->
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer" id="footer">
        <div class="container"><br>
        <h1 id="hk">Hubungi Kami</h1><br>
            <div class="footer-content">
                <div class="left-section">
                    <p>
                        <a href="#">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.2498 4.16663H33.7498C40.4165 4.16663 45.8332 9.58329 45.8332 16.25V33.75C45.8332 36.9547 44.5601 40.0281 42.294 42.2942C40.028 44.5602 36.9545 45.8333 33.7498 45.8333H16.2498C9.58317 45.8333 4.1665 40.4166 4.1665 33.75V16.25C4.1665 13.0453 5.43957 9.97182 7.70563 7.70575C9.9717 5.43969 13.0451 4.16663 16.2498 4.16663ZM15.8332 8.33329C13.844 8.33329 11.9364 9.12347 10.5299 10.53C9.12335 11.9365 8.33317 13.8442 8.33317 15.8333V34.1666C8.33317 38.3125 11.6873 41.6666 15.8332 41.6666H34.1665C36.1556 41.6666 38.0633 40.8765 39.4698 39.4699C40.8763 38.0634 41.6665 36.1558 41.6665 34.1666V15.8333C41.6665 11.6875 38.3123 8.33329 34.1665 8.33329H15.8332ZM35.9373 11.4583C36.628 11.4583 37.2904 11.7327 37.7788 12.221C38.2671 12.7094 38.5415 13.3718 38.5415 14.0625C38.5415 14.7531 38.2671 15.4155 37.7788 15.9039C37.2904 16.3923 36.628 16.6666 35.9373 16.6666C35.2467 16.6666 34.5843 16.3923 34.0959 15.9039C33.6075 15.4155 33.3332 14.7531 33.3332 14.0625C33.3332 13.3718 33.6075 12.7094 34.0959 12.221C34.5843 11.7327 35.2467 11.4583 35.9373 11.4583ZM24.9998 14.5833C27.7625 14.5833 30.412 15.6808 32.3655 17.6343C34.319 19.5878 35.4165 22.2373 35.4165 25C35.4165 27.7626 34.319 30.4122 32.3655 32.3657C30.412 34.3192 27.7625 35.4166 24.9998 35.4166C22.2372 35.4166 19.5876 34.3192 17.6341 32.3657C15.6806 30.4122 14.5832 27.7626 14.5832 25C14.5832 22.2373 15.6806 19.5878 17.6341 17.6343C19.5876 15.6808 22.2372 14.5833 24.9998 14.5833ZM24.9998 18.75C23.3422 18.75 21.7525 19.4084 20.5804 20.5805C19.4083 21.7526 18.7498 23.3424 18.7498 25C18.7498 26.6576 19.4083 28.2473 20.5804 29.4194C21.7525 30.5915 23.3422 31.25 24.9998 31.25C26.6574 31.25 28.2472 30.5915 29.4193 29.4194C30.5914 28.2473 31.2498 26.6576 31.2498 25C31.2498 23.3424 30.5914 21.7526 29.4193 20.5805C28.2472 19.4084 26.6574 18.75 24.9998 18.75Z" fill="white"/></svg>
                            <span style="margin-left: 10px;">@bajo.tour</span>
                        </a>
                    </p>
                    <p>
                        <a href="#">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M45.8332 12.5C45.8332 10.2084 43.9582 8.33337 41.6665 8.33337H8.33317C6.0415 8.33337 4.1665 10.2084 4.1665 12.5V37.5C4.1665 39.7917 6.0415 41.6667 8.33317 41.6667H41.6665C43.9582 41.6667 45.8332 39.7917 45.8332 37.5V12.5ZM41.6665 12.5L24.9998 22.9167L8.33317 12.5H41.6665ZM41.6665 37.5H8.33317V16.6667L24.9998 27.0834L41.6665 16.6667V37.5Z" fill="#F8F8F8"/></svg>
                            <span style="margin-left: 10px;">bajotourr@gmail.com</span>
                        </a>
                    </p>
                    <p>
                        <a href="#">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M39.6877 10.2291C37.7777 8.29981 35.5026 6.7701 32.9952 5.72923C30.4879 4.68837 27.7983 4.15717 25.0835 4.16663C13.7085 4.16663 4.43766 13.4375 4.43766 24.8125C4.43766 28.4583 5.396 32 7.18766 35.125L4.271 45.8333L15.2085 42.9583C18.2293 44.6041 21.6252 45.4791 25.0835 45.4791C36.4585 45.4791 45.7293 36.2083 45.7293 24.8333C45.7293 19.3125 43.5835 14.125 39.6877 10.2291ZM25.0835 41.9791C22.0002 41.9791 18.9793 41.1458 16.3335 39.5833L15.7085 39.2083L9.2085 40.9166L10.9377 34.5833L10.521 33.9375C8.80797 31.202 7.89837 28.04 7.896 24.8125C7.896 15.3541 15.6043 7.64579 25.0627 7.64579C29.646 7.64579 33.9585 9.43746 37.1877 12.6875C38.7866 14.2791 40.0537 16.1722 40.9156 18.2571C41.7774 20.342 42.2169 22.5773 42.2085 24.8333C42.2502 34.2916 34.5418 41.9791 25.0835 41.9791ZM34.5002 29.1458C33.9793 28.8958 31.4377 27.6458 30.9793 27.4583C30.5002 27.2916 30.1668 27.2083 29.8127 27.7083C29.4585 28.2291 28.4793 29.3958 28.1877 29.7291C27.896 30.0833 27.5835 30.125 27.0627 29.8541C26.5418 29.6041 24.8752 29.0416 22.9168 27.2916C21.3752 25.9166 20.3543 24.2291 20.0418 23.7083C19.7502 23.1875 20.0002 22.9166 20.271 22.6458C20.5002 22.4166 20.7918 22.0416 21.0418 21.75C21.2918 21.4583 21.396 21.2291 21.5627 20.8958C21.7293 20.5416 21.646 20.25 21.521 20C21.396 19.75 20.3543 17.2083 19.9377 16.1666C19.521 15.1666 19.0835 15.2916 18.771 15.2708H17.771C17.4168 15.2708 16.8752 15.3958 16.396 15.9166C15.9377 16.4375 14.6043 17.6875 14.6043 20.2291C14.6043 22.7708 16.4585 25.2291 16.7085 25.5625C16.9585 25.9166 20.3543 31.125 25.521 33.3541C26.7502 33.8958 27.7085 34.2083 28.4585 34.4375C29.6877 34.8333 30.8127 34.7708 31.7085 34.6458C32.7085 34.5 34.771 33.3958 35.1877 32.1875C35.6252 30.9791 35.6252 29.9583 35.4793 29.7291C35.3335 29.5 35.021 29.3958 34.5002 29.1458Z" fill="#F8F8F8"/></svg>
                            <span style="margin-left: 10px;">0812-3204-0567</span>
                        </a>
                    </p>
                </div>
                <div class="right-section">
                    <p>
                        <a href="#">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M24.9998 13.5416C26.3812 13.5416 27.7059 14.0904 28.6827 15.0671C29.6594 16.0439 30.2082 17.3686 30.2082 18.75C30.2082 19.4339 30.0735 20.1112 29.8117 20.7431C29.55 21.375 29.1663 21.9492 28.6827 22.4328C28.199 22.9164 27.6249 23.3001 26.993 23.5618C26.3611 23.8236 25.6838 23.9583 24.9998 23.9583C23.6185 23.9583 22.2937 23.4096 21.317 22.4328C20.3402 21.4561 19.7915 20.1313 19.7915 18.75C19.7915 17.3686 20.3402 16.0439 21.317 15.0671C22.2937 14.0904 23.6185 13.5416 24.9998 13.5416ZM24.9998 4.16663C28.8676 4.16663 32.5769 5.70308 35.3118 8.43799C38.0467 11.1729 39.5832 14.8822 39.5832 18.75C39.5832 29.6875 24.9998 45.8333 24.9998 45.8333C24.9998 45.8333 10.4165 29.6875 10.4165 18.75C10.4165 14.8822 11.953 11.1729 14.6879 8.43799C17.4228 5.70308 21.1321 4.16663 24.9998 4.16663ZM24.9998 8.33329C22.2372 8.33329 19.5876 9.43076 17.6341 11.3843C15.6806 13.3378 14.5832 15.9873 14.5832 18.75C14.5832 20.8333 14.5832 25 24.9998 38.9791C35.4165 25 35.4165 20.8333 35.4165 18.75C35.4165 15.9873 34.319 13.3378 32.3655 11.3843C30.412 9.43076 27.7625 8.33329 24.9998 8.33329Z" fill="#F8F8F8"/></svg>
                            <span style="margin-left: 10px;">Jalan Dieng Atas No. 8, Ds. Sumberjo, Kalisongo, Malang, Jawa Timur, 65151</span>
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
    <script>
        function changeLanguage(langCode) {
            if (langCode === 'id') {
                document.getElementById('berandaText').innerText = 'Beranda';
                document.getElementById('destinasiText').innerText = 'Destinasi';
                document.getElementById('kontakText').innerText = 'Kontak';
                document.getElementById('rdw').innerText = 'Ragam Destinasi Wisata';
                document.getElementById('hk').innerText = 'Hubungi Kami';
                document.getElementById('p1').innerText = 'Pulau Padar';
                document.getElementById('d1').innerText = 'Pulau Padar adalah pulau ketiga terbesar di kawasan Taman Nasional Komodo,Daya tarik Pulau Padar sendiri tidak kalah dengan beberapa pulau lainnya. Wisata trekking atau pendakian yang menawarkan pemandangan yang indah ke laut dari kejauhan, menjelajah fauna setempat (bird watching), serta berenang di sepanjang pantai Padar barat yang terkenal dengan pasir yang berwarna merah muda (pink beach).';
                document.getElementById('p2').innerText = 'Pulau Koaba';
                document.getElementById('d2').innerText = 'Pulau Koaba Adalah Pulau kecil dengan rimbunan hutan lebat dan dikelilingi air biru laut yang berisikan jutaan satwa dan tumbuhan laut ini merupakan rumah bagi ribuan kelelawar besar atau kalong yang pada siang hari bertengger di pepohonan dan berkeliaran pada petang hingga malam hari untuk berburu.';
                document.getElementById('p3').innerText = 'Pulau Kelor';
                document.getElementById('d3').innerText = 'Pulau Kelor adalah pulau kecil tidak berpenghuni di lepas pantai Labuan Bajo. Pulau Kelor memiliki area perbukitan di tengahnya, cocok sebagai tempat berfoto atau menikmati pemandangan. Pulau Kelor memiliki pasir putih serta air biru jernih. Garis pantai yang cukup panjang serta ombak lembut membuat Pulau Kelor cocok untuk berenang atau snorkeling.';
                document.getElementById('p4').innerText = 'Air Terjun Cunca';
                document.getElementById('d4').innerText = 'Air Terjun Cunca Wulang merupakan objek wisata alam yang terkenal mirip seperti Green Canyon namun dalam versi kecilnya. Kemiripannya terletak pada aliran sungainya yang berada diantara tebing bebatuan besar dan air terjunnya berada di atas batu-batu dan keluar melalui celah bebatuan. Nama Air Terjun Cunca Wulang memiliki makna tersendiri. Bila diartikan dalam bahasa Indonesia, Cunca dan Wulang sendiri berarti air terjun dan Bulan.';
                document.getElementById('p5').innerText = 'Taman Nasional Komodo';
                document.getElementById('d5').innerText = 'Taman Nasional Komodo ditunjuk sebagai Taman Nasional Pertama Indonesia bersama dengan Taman Nasional Gunung Leuseur, Taman Nasional Ujung Kulon, Taman Nasional Komodo Gunung Gede Pangrango, dan Taman Nasional Baluran pada tanggal 06 Maret 1980. Bentang alamnya menyediakan habitat bagi berbagai satwa liar luar biasa di bumi Indonesia.';
                document.getElementById('p6').innerText = 'Pulau Kanawa';
                document.getElementById('d6').innerText = 'Pulau Kanawa merupakan sebuah pulau kecil yang memiliki air laut sebening kristal dengan pasir putih dan terumbu karang yang sangat indah. Pulau ini memiliki warna gradasi air laut yang berwarna biru dan cocok sekali dijadikan sebagai tempat wisata untuk menghilangkan penat karena kesibukan pekerjaan.';
                // Add more elements to change text accordingly for Bahasa Indonesia...
            } else if (langCode === 'en') {
                document.getElementById('berandaText').innerText = 'Home';
                document.getElementById('destinasiText').innerText = 'Destinations';
                document.getElementById('kontakText').innerText = 'Contact';
                document.getElementById('rdw').innerText = 'Various Tourist Destinations';
                document.getElementById('hk').innerText = 'Contact Us';
                document.getElementById('p1').innerText = 'Padar Island';
                document.getElementById('d1').innerText = 'Padar Island is the third largest island in the Komodo National Park area. The attraction of Padar Island itself is no less than several other islands. Trekking or climbing tourism that offers beautiful views of the sea from a distance, exploring local fauna (bird watching), and swimming along West Padar beach which is famous for its pink sand (pink beach).';
                document.getElementById('p2').innerText = 'Koaba Island';
                document.getElementById('d2').innerText = 'Koaba Island is a small island with dense forest cover and surrounded by aquamarine water containing millions of marine animals and plants. It is home to thousands of large bats or bats which perch in the trees during the day and roam around from dusk to night to hunt.';
                document.getElementById('p3').innerText = 'Kelor Island';
                document.getElementById('d3').innerText = 'Kelor Island is a small, uninhabited island off the coast of Labuan Bajo. Kelor Island has a hilly area in the middle, suitable as a place to take photos or enjoy the view. Kelor Island has white sand and clear blue water. The long coastline and gentle waves make Kelor Island suitable for swimming or snorkeling.';
                document.getElementById('p4').innerText = 'Cunca Waterfall';
                document.getElementById('d4').innerText = 'Cunca Wulang Waterfall is a famous natural tourist attraction, similar to Green Canyon but in a small version. The similarity lies in the river flowing between large rocky cliffs and the waterfall being on top of the rocks and coming out through a gap in the rocks. The name Cunca Wulang Waterfall has its own meaning. When interpreted in Indonesian, Cunca and Wulang themselves mean waterfall and moon.';
                document.getElementById('p5').innerText = 'Komodo National Park';
                document.getElementById('d5').innerText = 'Komodo National Park was designated as Indonesias First National Park along with Gunung Leuseur National Park, Ujung Kulon National Park, Gunung Gede Pangrango Komodo National Park, and Baluran National Park on March 6, 1980. Its natural landscape provides habitat for a variety of extraordinary wildlife on earth. Indonesia.';
                document.getElementById('p6').innerText = 'Kanawa Island';
                document.getElementById('d6').innerText = 'Kanawa Island is a small island that has crystal clear sea water with white sand and very beautiful coral reefs. This island has gradations of blue sea water and is very suitable as a tourist spot to relieve fatigue due to busy work.';
                // Add more elements to change text accordingly for English...
            }
        }
    </script>
</body>

</html>
