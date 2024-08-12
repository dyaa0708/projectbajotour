<?php
session_start();
// Memeriksa apakah form lupa password telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari form
    $email = $_POST['forgotPasswordEmail'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

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

    // Query untuk memeriksa apakah email ada dalam database
    $checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        // Jika email ada dalam database
        if ($newPassword === $confirmPassword) {
            // Jika password dan konfirmasi password cocok
            

            // Update password dalam database
            $updatePasswordQuery = "UPDATE users SET password='$newPassword' WHERE email='$email'";
            if ($conn->query($updatePasswordQuery) === TRUE) {
                // Password berhasil diubah
                $_SESSION['success_lupa_password'] = "Password berhasil diubah.";
            } else {
                // Error saat mengubah password
                $_SESSION['error_lupa_password'] = "Error: " . $conn->error;
            }
        } else {
            // Jika password dan konfirmasi password tidak cocok
            $_SESSION['error_lupa_password'] = "Password dan konfirmasi password tidak sama.";
        }
    } else {
        // Jika email tidak ada dalam database
        $_SESSION['error_lupa_password'] = "Email tidak ditemukan.";
    }

    // Tutup koneksi
    $conn->close();

    // Redirect ke halaman lain setelah proses
    header("Location: index.php");
    exit();
}
?>
