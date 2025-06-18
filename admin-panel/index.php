<?php 
require 'session.php';
require '../koneksi.php';

$queryDataDosen = mysqli_query($con, "SELECT * FROM dosen");
$jumlahDataDosen = mysqli_num_rows($queryDataDosen);

$queryCluster = mysqli_query($con, "SELECT * FROM cluster");
$jumlahCluster = mysqli_num_rows($queryCluster);

$queryMahasiswa = mysqli_query($con, "SELECT * FROM mahasiswa");
$jumlahMahasiswa = mysqli_num_rows($queryMahasiswa);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.min.css">
    <title>Capstone Monitoring</title>
</head>
<style>
    * {
        font-family: 'Times New Roman', Times, serif;
    }
    
    .breadcrumb a {
        text-decoration: none;
        color: black;
    }
    .row {
            display: flex;
            flex-direction: flex; /* Membuat semua elemen dalam satu kolom */
            align-items: center; /* Pusatkan elemen di kolom */
            max-width: 1200px;
            margin: 0 auto;
        }

        .row a {
            text-decoration: none;
            color: white;
            margin-bottom: 20px;
            width: 100%; /* Memastikan elemen selebar 100% di desktop */
            text-align: center;
        }

        .row a:hover {
            color: white;
        }

        /* Media query untuk layar kecil */
        @media (max-width: 768px) {
            .row a {
                flex-basis: 100%; /* Membuat elemen selebar 100% di layar medium */
            }
        }

        /* Media query untuk layar lebih kecil lagi */
        @media (max-width: 576px) {
            .row a {
                flex-basis: 100%; /* Membuat elemen selebar 100% di layar kecil */
            }
        }
    .statistic-box {
        padding: 20px;
        border-radius: 15px;
        text-align: center;
        color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .statistic-box h3 {
        margin: 0;
        font-size: 18px;
        margin-bottom: 10px;
    }

    .statistic-box p {
        font-size: 24px;
        margin: 0;
    }

    .mahasiswa {
        background: linear-gradient(to right, #00c6ff, #0072ff);
    }

    .dosen {
        background: linear-gradient(to right, #f2994a, #f2c94c);
    }

    .perguruan-tinggi {
        background: linear-gradient(to right, #00b09b, #96c93d);
    }

    .program-studi {
        background: linear-gradient(to right, #ee0979, #ff6a00);
    }

    .header h2 {
        color: #6a0dad;
        margin: 0;
    }
</style>
<body>
<?php require "navbar.php"; ?>

<div class="container">
    <div class="container mt-4 ml-5">
        <h2>Halo <?php echo $_SESSION['username']; ?></h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb ms-2">
                <li class="breadcrumb-item active">
                    <a href="index.php">Dashboard</a> 
                </li>
            </ol>
        </nav>
    </div>

    <div class="container">
        <h2>Statistik Data</h2>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="mahasiswa.php" class="statistic-box mahasiswa d-block">
                <h3>Mahasiswa <i class="fa-solid fa-graduation-cap"></i></h3>
                <p><?php echo $jumlahMahasiswa ?></p>
            </a>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="dosen.php" class="statistic-box dosen d-block">
                <h3>Dosen <i class="fa-regular fa-address-card"></i></h3>
                <p><?php echo $jumlahDataDosen ?></p>
            </a>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="cluster.php" class="statistic-box perguruan-tinggi d-block">
                <h3>Cluster <i class="fa-solid fa-book"></i></h3>
                <p><?php echo $jumlahCluster ?></p>
            </a>
        </div>
    </div>
</div>

<script src="../libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
