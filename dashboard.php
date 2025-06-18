<?php 

require 'session.php';
require 'koneksi.php';

// Menonaktifkan semua pelaporan error
error_reporting(0);
ini_set('display_errors', '0');

// Cek apakah user sudah login
if (!isset($_SESSION['nim'])) {
    // Jika belum login, redirect ke halaman login
    header('Location: login.php');
    exit();
}

// Ambil ID mahasiswa dari sesi
$nim= $_SESSION['nim'];

// Query untuk mengambil data mahasiswa yang sedang login
$query = mysqli_query($con, "SELECT * FROM mahasiswa WHERE nim = '$nim'");
// Jika data ditemukan
$data = mysqli_fetch_assoc($query);


// Query untuk mengambil data cluster
$queryCluster = mysqli_query($con, "SELECT * FROM cluster");

// Query untuk mengambil data dosen
$queryDosen = mysqli_query($con, "SELECT * FROM dosen");

// Query untuk mengecek apakah mahasiswa sudah mendaftar
$queryDaftar = mysqli_query($con, "SELECT * FROM pendaftar_mahasiswa WHERE nim = '$nim'");
$dataDaftar = mysqli_fetch_assoc($queryDaftar);

$kd_cluster = $dataDaftar['kd_cluster'];
$kd_dosen = $dataDaftar['kd_dosen'];
$tanggal = $dataDaftar['tanggal_daftar'];
$formattedDate = date('d F Y', strtotime($tanggal));

// Query untuk mendapatkan nama cluster berdasarkan kd_cluster
$queryClusters = mysqli_query($con, "SELECT nama_cluster FROM cluster WHERE kd_cluster = '$kd_cluster'");
$dataClusters = mysqli_fetch_assoc($queryClusters);
$nama_clusters = $dataClusters['nama_cluster'];

// Query untuk mendapatkan nama dosen berdasarkan kd_dosen
$queryDosens = mysqli_query($con, "SELECT nama FROM dosen WHERE kd_dosen = '$kd_dosen'");
$dataDosens = mysqli_fetch_assoc($queryDosens);
$nama_dosens = $dataDosens['nama'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="libraries/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/47e774fc5c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <title>Capstone Monitoring</title>
</head>
<style>
    
    *{
    margin: 0px;
    padding: 0px;
}   
.btns{
    background: linear-gradient(to right, #d641bf 0%, #6519c3 100%);
    border-radius: 10px;
    border: none;
    margin-top: 4%;
    margin-bottom: 4%;
}
.bg-baris{
    background-color: rgb(153, 153, 153, 0.25);
}
.card-header{
    border-radius: 100px;
    background: linear-gradient(to right, #d641bf 0%, #6519c3 100%);
    height: 50px;   
}
.cardtop{
    color: white;
    border-radius: 10px;
}
.baris{
    background: linear-gradient(to right, #d641bf 0%, #6519c3 100%);
}
.card{
    border-radius: 10px;
}
input[type="file"]::file-selector-button {
        padding: 5px 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
    }

    /* Menyembunyikan teks di sebelah input file */
    input[type="file"]::after {
        content: "";
        display: none;
    }
</style>
<body>
<?php require "navbar.php"; ?>

<div class="container mt-4">
    <div class="container">
    <div class="card shadow mb-5 bg-white">
        <div class="card-header ">
            <h5 class="cardtop mt-1">PROFIL</h5>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-2 text-center">
                        <?php if ($data['foto_formal'] != null && $data['foto_formal'] != ''): ?>
                            <!-- Menampilkan foto jika sudah ada -->
                            <img src="img/fotoFormal/<?php echo $data['foto_formal']; ?>" alt="Profile Picture" class="img-fluid" style="max-width: 150px; height: auto; margin-bottom:20px; border-radius: 10px;">

                        <?php else: ?>
                            <!-- Menampilkan tombol tambah foto jika belum ada foto -->
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="file" name="fotoFormal" class="form-control mb-3">
                                <button type="submit" class="btn btn-primary mb-3" name="foto_formal">Tambah Foto</button>
                            </form>
                        <?php endif; ?>
                    </div>
                    <div class="col-12 col-md-10">
                        <div class="container">
                            <div class="row mb-2 py-2 bg-baris rounded-2">
                                <div class="col-4 col-sm-3">Nama</div>
                                <div class="col-1">:</div>
                                <div class="col"><?= $data['nama'] ?></div>
                            </div>
                            <div class="row mb-2 py-2 bg-baris rounded-2">
                                <div class="col-4 col-sm-3">NIM</div>
                                <div class="col-1">:</div>
                                <div class="col"><?= $data['nim'] ?></div>
                            </div>
                            <div class="row mb-2 py-2 bg-baris rounded-2">
                                <div class="col-4 col-sm-3">No.Hp</div>
                                <div class="col-1">:</div>
                                <div class="col"><?= $data['nomor_hp'] ?></div>
                            </div>
                            <div class="row mb-2 py-2 bg-baris rounded-2">
                                <div class="col-4 col-sm-3">Jurusan</div>
                                <div class="col-1">:</div>
                                <div class="col"><?= $data['jurusan'] ?></div>
                            </div>
                            <div class="row mb-2 py-2 bg-baris rounded-2">
                                <div class="col-4 col-sm-3">Prodi</div>
                                <div class="col-1">:</div>
                                <div class="col"><?= $data['prodi'] ?></div>
                            </div>
                            <div class="row mb-2 py-2 bg-baris rounded-2">
                                <div class="col-4 col-sm-3">Kelas</div>
                                <div class="col-1">:</div>
                                <div class="col"><?= $data['kelas'] ?></div>
                            </div>
                        </div>            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// Misalkan $data adalah variabel yang berisi informasi pendaftaran
if (isset($dataDaftar['nim'])) {
    // Jika mahasiswa sudah mendaftar
?>

    <div class="card shadow mb-5 bg-white">
        <div class="card-header">
            <h5 class="cardtop mt-1">Capstone</h5>
        </div>
        <div class="card-body">
     <div class="container">
        <div class="row flex-column">  
            <div class="col-md d-flex align-items-start justify-content-start text-start mb-3">
                <i class="fa-solid fa-book me-2"></i>
                <span>Capstone</span>
                <span class="ms-2">:</span>
                <span class="ms-2"><?= $kd_cluster . " - " . $nama_clusters ?></span>
            </div>
            <div class="col-md d-flex align-items-center justify-content-start text-start mb-3">
                <i class="fa-solid fa-user-tie me-2"></i>
                <span> Dosen Pembimbing</span>
                <span class="ms-2">:</span>
                <span class="ms-2"><?= $kd_dosen . " - " . $nama_dosens ?></span>
            </div>
            <div class="col-md d-flex align-items-center justify-content-start text-start mb-3">
                <i class="fa-solid fa-book me-2"></i>
                <span>Tanggal Daftar</span>
                <span class="ms-2">:</span>
                <span class="ms-2"><?= $formattedDate ?></span>
            </div>
            <div class="col-md d-flex align-items-center justify-content-start text-start mb-3">
                <i class="fa-solid fa-chart-simple me-2"></i>
                <span>Topik Riset</span>
                <span class="ms-2">:</span>
                <?php if (empty($dataDaftar['topik_riset'])): ?>
                    <span class="ms-2 fw-bold">Belum mengajukan</span>
                   <!-- Button trigger modal -->
                    <a href="#" class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#topikRisetModal"><i class="fa-solid fa-upload"></i></a>
                    <!-- Modal -->
                            <div class="modal fade" id="topikRisetModal" tabindex="-1" aria-labelledby="topikRisetModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="topikRisetModalLabel">Ajukan Topik Riset</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="formTopikRiset" method="POST" action="">
                                                <div class="mb-3">
                                                    <label for="topikRiset" class="form-label">Topik Riset</label>
                                                    <input type="text" class="form-control" id="topikRiset" name="topik_riset" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="simpan_topik">Ajukan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php else: ?>
                    <h5 class="mt-2">
                    <span class="ms-2 mt-2 fw-bold"><?= $dataDaftar['topik_riset']; ?> 
                    </h5>
                    <!-- Button trigger modal -->
                <a href="#" class="btn btn-warning ms-3" data-bs-toggle="modal" data-bs-target="#edittopikRisetModal"><i class="fa-solid fa-pen-to-square"></i></a>
                    <!-- Modal -->
                            <div class="modal fade" id="edittopikRisetModal" tabindex="-1" aria-labelledby="edittopikRisetModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="edittopikRisetModalLabel">Ajukan Topik Riset</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editformTopikRiset" method="POST" action="">
                                                <div class="mb-3">
                                                    <label for="edittopikRiset" class="form-label">Topik Riset</label>
                                                    <input type="text" class="form-control" id="edittopikRiset" name="topik_riset" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="edit_topik">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php endif; ?>
        </div>
            <div class="col-md d-flex align-items-center justify-content-start text-start mb-3">
                <i class="fa-solid fa-chart-simple me-2"></i>
                <span>Status</span>
                <span class="ms-2">:</span>
                <?php 
                $statusClass = '';
                if ($dataDaftar['status'] == 'Belum Diperiksa') {
                    $statusClass = 'bg-warning text-dark';  // Yellow background with dark text
                } elseif ($dataDaftar['status'] == 'Belum disetujui') {
                    $statusClass = 'bg-danger text-white';   // Red background with white text
                } elseif ($dataDaftar['status'] == 'Disetujui') {
                    $statusClass = 'bg-success text-white';  // Green background with white text
                }?>
                <span class="stat ms-2  <?=$statusClass;?> p-2 rounded"> <?=$dataDaftar['status'];?></span>
            </div>
            <div class="col-md d-flex justify-content-start text-start mb-3">
            <i class="fa-solid fa-comment-dots me-1"></i>
                <span>Tanggapan </span>
                <span class="ms-2">:</span>
                <span class="ms-2"><?php echo nl2br(htmlspecialchars($dataDaftar['tanggapan_topik_riset'], ENT_QUOTES, 'UTF-8')); ?></span>
            </div>
        </div>
    </div>
</div>
    </div>
    <?php if ($dataDaftar['status'] == 'Disetujui'): ?>
<div class="card shadow mb-5 bg-white">
    <div class="card-header">
        <h5 class="cardtop mt-1">Laporan Capstone</h5>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row flex-column">  
                <div class="col-md d-flex align-items-start justify-content-start text-start mb-2">
                <?php if ($dataDaftar['project_capstone'] != null && $dataDaftar['project_capstone'] != ''): ?>
                    <!-- Menampilkan file jika sudah ada -->
                    <p><i class="fa-solid fa-file"></i> File Laporan : 
                    <a href="img/laporan/<?php echo $dataDaftar['project_capstone']; ?>" target="_blank" class="btn btn-info">
                        <i class="fa-solid fa-file-pdf me-2"></i> 
                        Laporan Capstone Anda
                    </a>
                    <!-- Button untuk membuka modal Edit Laporan -->
                    <button type="button" class="btn btn-warning ms-1" data-bs-toggle="modal" data-bs-target="#editLaporanModal">
                        <i class="fas fa-edit"></i>
                    </button>

                    <!-- Modal Edit Laporan -->
                    <div class="modal fade" id="editLaporanModal" tabindex="-1" aria-labelledby="editLaporanModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editLaporanModalLabel">Edit Laporan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form untuk upload file -->
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="file_laporan" class="form-label">Pilih File Laporan (.pdf, .doc, .docx)</label>
                                            <div class="custom-file">
                                                <input type="file" name="file_laporan" class="custom-file-input" id="file_laporan" accept=".pdf,.doc,.docx" onchange="updateFileName()">
                                                <label class="custom-file-label" for="file_laporan"></label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" name="simpan_laporan">
                                                <i class="fas fa-upload"></i>
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tombol Hapus Laporan -->
                    <button type="button" class="btn btn-danger ms-2 mb-3" id="hapusLaporan">
                        <i class="fas fa-trash"></i>
                    </button>
                    <!-- Form tersembunyi untuk submit penghapusan laporan -->
                    <form id="formHapusLaporan" action="" method="POST">
                        <input type="hidden" name="hapus_laporan" value="true">
                    </form>
                    </p>
                <?php else: ?>
                    <!-- Menampilkan tombol tambah file laporan jika belum ada file -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="file" name="file_laporan" class="form-control mb-3" accept=".pdf,.doc,.docx">
                        <button type="submit" class="btn btn-primary mb-3" name="simpan_laporan">Kirim</button>
                    </form>
                <?php endif; ?>
                </div>
                <div class="col-md d-flex align-items-center justify-content-start text-start mb-3">
                    <i class="fa-solid fa-chart-simple me-2"></i>
                    <span>Status</span>
                    <span class="ms-2">:</span>
                    <?php 
                    $statusLaporan = '';
                    if ($dataDaftar['status_laporan'] == 'Belum Diperiksa') {
                        $statusLaporan = 'bg-warning text-dark';  // Yellow background with dark text
                    } elseif ($dataDaftar['status_laporan'] == 'Belum disetujui') {
                        $statusLaporan = 'bg-danger text-white';   // Red background with white text
                    } elseif ($dataDaftar['status_laporan'] == 'Disetujui') {
                        $statusLaporan = 'bg-success text-white';  // Green background with white text
                    }?>
                    <span class="stat ms-2 <?=$statusLaporan;?> p-2 rounded"> <?=$dataDaftar['status_laporan'];?></span>
                </div>
            <div class="col-md d-flex justify-content-start text-start mb-3">
                 <i class="fa-solid fa-comment-dots me-1 mt-1"></i>
                <span>Tanggapan </span>
                <span class="ms-2">:</span>
                <span class="ms-2"><?php echo nl2br(htmlspecialchars($dataDaftar['tanggapan_laporan'], ENT_QUOTES, 'UTF-8')); ?></span>
            </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

    </div>
<?php
} else {
    // Jika mahasiswa belum mendaftar, tampilkan form pendaftaran
?>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="nim" class="form-label">Nim</label>
            <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $_SESSION['nim']; ?>" required disabled> 
        </div>

        <div>
    <label for="cluster" class="mt-3">Cluster</label><br>
    <select id="cluster" class="form-control mb-3" name="cluster" required onchange="getDosen(this.value)">
        <option value="">Pilih Cluster</option>
        <?php
        while ($rowCluster = mysqli_fetch_assoc($queryCluster)) {
            echo "<option value='" . $rowCluster['kd_cluster'] . "'>" . $rowCluster['nama_cluster'] . "</option>";
        }
        ?>
    </select>
</div>
<div class="mb-3">
    <label for="dospem" class="mt-3">Dosen Pembimbing</label><br>
    <select id="dospem" class="form-control mb-3" name="dospem" required>
        <option value="">Pilih Dosen</option>
    </select>
</div>
        <button type="submit" class="btn btn-primary form-control mb-5" name="simpan">Daftar</button>
    </form>
<?php
}
?>
</div>
<?php
if (isset($_POST['simpan'])) {
    $nim = $_SESSION['nim'];  // Nim mahasiswa
    $kd_cluster = $_POST['cluster'];  
    $kd_dosen = $_POST['dospem'];
    // Query untuk menyimpan data pendaftaran
    $queryTambah = mysqli_query($con, "INSERT INTO pendaftar_mahasiswa (nim, kd_cluster, kd_dosen) VALUES ('$nim', '$kd_cluster', '$kd_dosen')");
    if ($queryTambah) {
        // Jika query berhasil, tampilkan notifikasi SweetAlert
        echo "
        <script>
        Swal.fire({
            title: 'Pendaftaran Berhasil!',
            text: 'Anda telah berhasil mendaftar.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = 'dashboard.php';  // Redirect setelah user menekan OK
            }
        });
        </script>";
    } else {
        // Jika query gagal, tampilkan notifikasi SweetAlert dengan pesan error
        echo "
        <script>
        Swal.fire({
            title: 'Pendaftaran Gagal!',
            text: 'Terjadi kesalahan saat mendaftar: " . mysqli_error($con) . "',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
    }
}
if (isset($_POST['topik_riset'])) {
    $nim = $_SESSION['nim'];  // Nim mahasiswa
    $topikRiset = $_POST['topik_riset'];
    // Query untuk menyimpan data pendaftaran
    $queryUpdate = mysqli_query($con, "UPDATE pendaftar_mahasiswa SET topik_riset='$topikRiset', status='Belum Diperiksa' WHERE nim='$nim'");
    if ($queryUpdate) {
        // Jika query berhasil, tampilkan notifikasi SweetAlert
        echo "
        <script>
        Swal.fire({
            title: 'Pengajuan Berhasil!',
            text: 'Anda telah berhasil mengajukan.',
            text: 'Tunggu Pemeriksaan dari dosen',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = 'dashboard.php';  // Redirect setelah user menekan OK
            }
        });
        </script>";
    } else {
        // Jika query gagal, tampilkan notifikasi SweetAlert dengan pesan error
        echo "
        <script>
        Swal.fire({
            title: 'Pendaftaran Gagal!',
            text: 'Terjadi kesalahan saat mendaftar: " . mysqli_error($con) . "',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
    }
}
if (isset($_POST['simpan_laporan'])) {
    $nim = $_SESSION['nim'];  // Nim mahasiswa
    $fileLaporan = $_FILES['file_laporan'];
    $status = $_POST['status'];

    // Tentukan direktori tujuan
    $target_dir = __DIR__ . "/img/laporan/";

    // Pastikan direktori tujuan ada
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Membuat direktori jika belum ada
    }

    // Ambil ekstensi file
    $fileExtension = pathinfo($fileLaporan["name"], PATHINFO_EXTENSION);

    // Fungsi untuk menghasilkan random string (contoh 12 karakter)
    function generateRandomString($length = 12) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    // Buat nama file baru dengan random string
    $randomFileName = generateRandomString() . '.' . $fileExtension;

    // Tentukan jalur lengkap file yang akan disimpan
    $target_file = $target_dir . $randomFileName;

    // Ambil nama file lama dari database
    $queryGetOldFile = mysqli_query($con, "SELECT project_capstone FROM pendaftar_mahasiswa WHERE nim='$nim'");
    $data = mysqli_fetch_assoc($queryGetOldFile);
    $oldFileName = $data['project_capstone'];

    // Tentukan jalur lengkap file lama
    $oldFilePath = $target_dir . $oldFileName;

    // Debugging: Tampilkan informasi file lama
    echo "Old File Name: " . $oldFileName . "<br>";
    echo "Old File Path: " . $oldFilePath . "<br>";

    // Pindahkan file yang diunggah ke direktori tujuan
    if (move_uploaded_file($fileLaporan["tmp_name"], $target_file)) {
        // Hapus file lama jika ada dan berhasil diunggah
        if (!empty($oldFileName) && file_exists($oldFilePath)) {
            echo "File exists, attempting to delete...<br>";
            if (unlink($oldFilePath)) {
                echo "File deleted successfully.<br>";
            } else {
                echo "Failed to delete the file.<br>";
            }
        } else {
            echo "File does not exist.<br>";
        }

        // Simpan nama file baru ke dalam database
        $queryTambah = mysqli_query($con, "UPDATE pendaftar_mahasiswa SET project_capstone='" . $randomFileName . "' WHERE nim='$nim'");
        if ($queryTambah) {
            echo "
            <script>
            Swal.fire({
                title: 'Laporan Berhasil Disimpan!',
                text: 'File laporan telah berhasil diunggah.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'dashboard.php';
                }
            });
            </script>";
        }
    } else {
        echo "
        <script>
        Swal.fire({
            title: 'Gagal Mengunggah!',
            text: 'Terjadi kesalahan saat mengunggah file.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
    }
}

if (isset($_POST['hapus_laporan'])) {
    $nim = $_SESSION['nim'];  // Nim mahasiswa

    // Ambil nama file dari database berdasarkan NIM
    $queryGetFile = mysqli_query($con, "SELECT project_capstone FROM pendaftar_mahasiswa WHERE nim='$nim'");
    $data = mysqli_fetch_assoc($queryGetFile);
    $fileName = $data['project_capstone'];

    // Tentukan jalur file yang akan dihapus
    $filePath = __DIR__ . "/img/laporan/" . $fileName;

    // Cek apakah file benar-benar ada di server
    if (file_exists($filePath)) {
        // Hapus file fisik
        if (unlink($filePath)) {
            // Hapus nama file dari database
            $queryHapus = mysqli_query($con, "UPDATE pendaftar_mahasiswa SET project_capstone=NULL WHERE nim='$nim'");
            
            if ($queryHapus) {
                echo "
                <script>
                Swal.fire({
                    title: 'File Berhasil Dihapus!',
                    text: 'File laporan berhasil dihapus dari server.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = 'dashboard.php';
                    }
                });
                </script>";
            }
        } else {
            echo "
            <script>
            Swal.fire({
                title: 'Gagal Menghapus File!',
                text: 'Terjadi kesalahan saat menghapus file.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            </script>";
        }
    } else {
        echo "
        <script>
        Swal.fire({
            title: 'File Tidak Ditemukan!',
            text: 'File tidak ditemukan di server.',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
        </script>";
    }
}
// Cek apakah form di-submit untuk unggah foto
if (isset($_POST['foto_formal'])) {
    $target_dir = "img/fotoFormal/";
    // Ambil nama file asli
    $original_file_name = basename($_FILES['fotoFormal']['name']);
    // Tentukan ekstensi file
    $imageFileType = strtolower(pathinfo($original_file_name, PATHINFO_EXTENSION));

    // Menghasilkan nama file yang aman menggunakan hash dengan panjang pendek
    $hashed_file_name = substr(hash('sha256', $original_file_name . uniqid()), 0, 16) . '.' . $imageFileType;

    // Tentukan path lengkap dari file yang akan disimpan
    $target_file = $target_dir . $hashed_file_name;
    $uploadOk = 1;

    // Validasi apakah file yang diunggah adalah gambar
    $check = getimagesize($_FILES['fotoFormal']['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<script>alert('File bukan gambar.');</script>";
        $uploadOk = 0;
    }

    // Cek ukuran file (maksimum 5MB)
    if ($_FILES['fotoFormal']['size'] > 5000000) { // 5MB
        echo "<script>alert('Ukuran file terlalu besar.');</script>";
        $uploadOk = 0;
    }

    // Hanya izinkan jenis file gambar tertentu
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
        echo "<script>alert('Hanya file JPG, JPEG, PNG yang diizinkan.');</script>";
        $uploadOk = 0;
    }

    // Cek apakah $uploadOk bernilai 0 karena error
    if ($uploadOk == 0) {
        echo "<script>alert('Maaf, file tidak dapat diunggah.');</script>";
    } else {
        // Jika semua validasi lolos, coba unggah file
        if (move_uploaded_file($_FILES['fotoFormal']['tmp_name'], $target_file)) {
            // Update nama file di database
            $stmt = $con->prepare("UPDATE mahasiswa SET foto_formal=? WHERE nim=?");
            $stmt->bind_param("ss", $hashed_file_name, $nim);

            if ($stmt->execute()) {
                echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Foto berhasil diunggah!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = 'dashboard.php';
                });
                </script>";
            } else {
                echo "<script>alert('Terjadi kesalahan saat menyimpan file ke database.');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengunggah file.');</script>";
        }
    }
}

?>
<script>
    function getDosen(kd_cluster) {
    if (kd_cluster == "") {
        document.getElementById("dospem").innerHTML = "<option value=''>Pilih Dosen</option>";
        return;
    }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("dospem").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "get_dosen.php?kd_cluster=" + kd_cluster, true);
    xhttp.send();
}
document.getElementById('hapusLaporan').addEventListener('click', function () {
    Swal.fire({
        title: 'Apakah kamu yakin?',
        text: "Laporan ini akan dihapus dan tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika dikonfirmasi, submit form untuk hapus file
            document.getElementById('formHapusLaporan').submit();
        }
    });
});

</script>
<!-- JS Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
