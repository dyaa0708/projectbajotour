<?php
// Ambil data dari form
$namaLengkap = $_POST['nama_lengkap'];
$email = $_POST['email'];
$password = $_POST['password'];

// Lakukan validasi dan sanitasi data jika diperlukan

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

// Buat dan jalankan query untuk memasukkan data ke dalam tabel
$sql = "INSERT INTO users (nama_lengkap, email, password) VALUES ('$namaLengkap', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    session_start();
    $_SESSION['success_message'] = "Berhasil membuat akun, Silahkan login";
    header("Location: index.php"); // Ganti dengan halaman form registrasi Anda
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
