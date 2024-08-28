<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dosen</title>
</head>
<style>
    .breadcrumb a{
        text-decoration: none;
        color: black;
     }
     .containerto {
            display: flex;
            margin-right: 10px;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        .containerto a{
            text-decoration: none;
            color: white;
            margin-right: 10px;
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

        .cluster {
            background: linear-gradient(to right, #00b09b, #96c93d);
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
        <div class="mt-3">
            <h2>Halo Dosen</h2>
        </div>
        <div class="mt-3">
     <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
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
    <a href="topik_riset.php" class="statistic-box mahasiswa">
        <h3>Topik Riset <i>ℹ️</i></h3>
        <p>14</p>
    </a>
    <a href="dosen.php" class="statistic-box dosen">
        <h3>Cluster <i>ℹ️</i></h3>
        <p>15</p>
    </a>
    <a href="pendaftar.php" class="statistic-box cluster">
        <h3>Mahasiswa yang mendaftar <i>ℹ️</i></h3>
        <p>50</p>
    </a>
</div>
    </div>
</body>
</html>