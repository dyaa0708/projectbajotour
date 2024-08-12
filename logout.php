<?php
// Mulai session
session_start();

// Hapus semua variabel sesi
session_unset();

// Hapus sesi
session_destroy();

// Redirect kembali ke halaman utama atau halaman lain yang diinginkan setelah logout
header("Location: index.php"); // Ganti index.php dengan halaman yang diinginkan setelah logout
exit();
?>
