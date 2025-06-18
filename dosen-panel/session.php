<?php 

session_start();
// Cek apakah user sudah login
if (!isset($_SESSION['login']) || $_SESSION['login'] == false) {
    header('Location: login.php'); // Redirect ke halaman login jika belum login
    exit();
}

// Cek apakah user adalah dosen
if (!isset($_SESSION['kd_dosen']) || $_SESSION['kd_dosen'] == false) {
    echo "Anda tidak memiliki akses ke halaman ini.";
    exit(); // Hentikan eksekusi script jika bukan dosen
}
?>