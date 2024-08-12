<?php
// Memulai session (jika belum dimulai)
session_start();

// Lakukan validasi untuk memastikan bahwa form telah dikirimkan dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah pengguna telah login (dalam contoh ini, kami mengasumsikan adanya sesi 'logged_in')
    if (!isset($_SESSION['logged_in'])) {
        $_SESSION['ulasan_login_error'] = "Anda harus login untuk memberikan ulasan.";
        header("Location: index.php"); // Ganti halaman_login.php dengan halaman login
        exit(); // Menghentikan eksekusi script
    }

    // Ambil data ulasan dari form
    $namaWisata = $_POST['nama_wisata'];
    $ulasan = $_POST['ulasan'];

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

    // Buat query untuk memasukkan ulasan ke dalam tabel 'ulasan' (sesuaikan dengan struktur tabel Anda)
    $sql = "INSERT INTO ulasan (nama_wisata, ulasan) VALUES ('$namaWisata', '$ulasan')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['ulasan_success_message'] = "Ulasan berhasil ditambahkan!";
    } else {
        $_SESSION['ulasan_error_message'] = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi
    $conn->close();

    // Redirect kembali ke halaman sebelumnya
    header("Location: index.php");
    exit();
} else {
    // Jika form tidak dikirimkan dengan metode POST, redirect ke halaman index.php
    header("Location: index.php");
    exit();
}
?>
