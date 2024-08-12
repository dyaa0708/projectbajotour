<?php
// Memulai session
session_start();

// Cek apakah form login telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dapatkan data dari form login
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Lakukan koneksi ke database
    $servername = "localhost"; // Ganti dengan nama server Anda
    $username = "root"; // Ganti dengan username MySQL Anda
    $password_db = ""; // Ganti dengan password MySQL Anda
    $dbname = "bajotour"; // Ganti dengan nama database Anda

    // Buat koneksi
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Buat query untuk memeriksa kredensial pengguna
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Jika kredensial valid, set sesi login dan redirect ke halaman beranda
        $_SESSION['logged_in'] = true;
        $_SESSION['user_email'] = $email;
        $_SESSION['success_message_login'] = "Berhasil login.";
        header("Location: index.php"); // Ganti halaman_beranda.php dengan halaman yang diinginkan setelah login
    } else {
        // Jika kredensial tidak valid, tampilkan pesan error
        $_SESSION['error_message_login'] = "Email atau password salah.";
        header("Location: index.php"); // Ganti halaman_login.php dengan halaman login
    }

    // Tutup koneksi
    $conn->close();
}
?>
