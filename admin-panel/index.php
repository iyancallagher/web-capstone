<?php 

require 'session.php';
require '../koneksi.php';

$queryDataDosen = mysqli_query($con, "SELECT * FROM dosen");
$jumlahDataDosen = mysqli_num_rows($queryDataDosen);

$queryCluster = mysqli_query($con, "SELECT * FROM cluster");
$jumlahCluster = mysqli_num_rows($queryCluster);
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.min.css">
    <title>Document</title>
</head>
<style>
    *{
        font-family: 'Times New Roman', Times, serif;
    }
        .breadcrumb a{
        text-decoration: none;
        color: black;
        }
        .containerto {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        .containerto a{
            text-decoration: none;
            color: white;
        }
        .statistic-box {
            width: 23%;
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

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h2 {
            color: #6a0dad;
            margin: 0;
        }

        .header a {
            color: #6a0dad;
            text-decoration: none;
            font-weight: bold;
        }
</style>
<body>
<?php require "navbar.php"; ?>
<div class="container">
<div class="container mt-4 ml-5">
    <h2>Halo <?php echo $_SESSION['username']; ?></h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ms-2">
            <li class="breadcrumb-item active" aria-current="page">
            <a href="index.php">Dashboard</a> 
            </li>
        </ol>
    </nav>
    </div>
    <div class="container">
        <h2>Statistik Data</h2>
    </div>
    <div class="containerto">
    <a href="mahasiswa.php" class="statistic-box mahasiswa">
        <h3>Mahasiswa <i><i class="fa-solid fa-graduation-cap"></i>

</i></h3>
        <p>34.000</p>
    </a>
    <a href="dosen.php" class="statistic-box dosen">
        <h3>Dosen <i><i class="fa-regular fa-address-card"></i>
</i>
</i></h3>
         <p><?php echo $jumlahDataDosen?></p>
    </a>
    <a href="cluster.php" class="statistic-box perguruan-tinggi">
        <h3>Cluster <i><i class="fa-solid fa-book"></i>
</i></h3>
        <p><p><?php echo $jumlahCluster?></p></p>
    </a>
    <a href="topik_riset.php" class="statistic-box program-studi">
        <h3>Topik riset <i><i class="fa-solid fa-book-open-reader"></i></i></h3>
        <p>33.961</p>
    </a>
</div>
    </div>
<script src="../libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>