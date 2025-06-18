<?php 
session_start();
// Cek apakah user sudah login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: login.php'); // Redirect ke login jika belum login
    exit();
}

// Cek apakah user adalah dosen atau admin
if (!isset($_SESSION['kd_admin']) || empty($_SESSION['kd_admin'])) {
    echo "Anda tidak memiliki akses ke halaman ini.";
    exit(); // Hentikan eksekusi script jika bukan dosen atau admin
}

// Kode halaman di bawah sini
?>
