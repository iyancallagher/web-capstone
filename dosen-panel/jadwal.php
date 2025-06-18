<?php 

require 'session.php';
require '../koneksi.php';


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.min.css">
    <title>Capstone Monitoring</title>
</head>
<style>
    *{
        font-family: 'Times New Roman', Times, serif;
    }

    .breadcrumb a{
        text-decoration: none;
        color: black;
        }
    .table thead{
        background: linear-gradient(to right, #d641bf 0%, #6519c3 100%);
        color: white;
    }
    .table-responsive{
        border-radius: 10px;
    }
    .list-group{
        display: flex;
    }

</style>
<body>
    <?php require 'navbar.php'; ?>
    <div class="container">
    <div class="container mt-4">
    <h2>Halo <?php echo $_SESSION['username']; ?></h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ms-2">
            <li class="breadcrumb-item active" aria-current="page">
            <a href="index.php">Dashboard</a> 
            <a href="jadwal.php"> /bimbingan</a> 
            </li>
        </ol>
    </nav>
    </div>
    <div class="mt-3">
    <div class="add">
        <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                    <thead>
    <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Bimbingan</th>
        <th>Status</th>
    </tr>
</thead>
<tbody>
    <tr>
        <td>1</td>
        <td>Adriansyah</td>
        <td>NIM12345</td>
        <td>
            <!-- Flex container for checkboxes -->
            <div class="d-flex flex-wrap">
                <label class="d-flex align-items-center mr-4">
                    <input type="checkbox" class="form-check-input ml-2">
                </label>
                <label class="d-flex align-items-center mr-4">
                    <input type="checkbox" class="form-check-input ml-2">
                </label>
                <label class="d-flex align-items-center mr-4">
                    <input type="checkbox" class="form-check-input ml-2">
                </label>
                <label class="d-flex align-items-center mr-4">
                    <input type="checkbox" class="form-check-input ml-2">
                </label>
                <label class="d-flex align-items-center mr-4">
                    <input type="checkbox" class="form-check-input ml-2">
                </label>
                <label class="d-flex align-items-center mr-4">
                    <input type="checkbox" class="form-check-input ml-2">
                </label>
                <!-- Continue for other sessions as needed -->
            </div>
            <td>selesai</td>
        </td>
    </tr>
</tbody>

                                



        <script src="../libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>