<?php 

require 'session.php';
require '../koneksi.php';

$query = mysqli_query($con, "SELECT * FROM cluster");
$jumlahCluster = mysqli_num_rows($query);


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
    <title>Cluster</title>
</head>
<style>
    *{
        font-family: 'Times New Roman', Times, serif;
    }

    .breadcrumb a{
        text-decoration: none;
        color: black;
        }
        .popup {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 9; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Popup content */
        .popup-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            border-radius: 10px;
            width: 80%; /* Could be more or less, depending on screen size */
        }
        /* Close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    .table thead{
        background: linear-gradient(to right, #d641bf 0%, #6519c3 100%);
        color: white;
    }
    .table-responsive{
        border-radius: 10px;
    }
    .add{
        display: flex;
        justify-content: space-between;
    }
    .create{
        display: flex;
        justify-content: end;
        margin-right: 20px;
        text-decoration: none;
        outline:none;
    }
    .create button{
        color: white;
    }
</style>
<body>
    <?php require 'navbar.php'; ?>
    <div class="container">
    <div class="container mt-4 ml-5">
    <h2>Halo <?php echo $_SESSION['username']; ?></h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ms-2">
            <li class="breadcrumb-item active" aria-current="page">
            <a href="index.php">Dashboard</a> 
            <a href="dosen.php"> / Table Cluster</a> 
            </li>
        </ol>
    </nav>
    </div>
<div class="mt-3">
    <div class="add">
        <h3>List Cluster atau Kompetensi Keahlian</h3>
        <button type="button" class="btn btn-secondary btn-lg" onclick="openPopup()">Tambah Cluster</button>
            <div id="popupForm" class="popup">
                <div class="popup-content">
                    <span class="close" onclick="closePopup()">&times;</span>
                    <h2>Tambah Cluster</h2>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="nama_cluster">Nama Cluster:</label>
                            <input type="text" class="form-control mt-2 mb-2" id="nama_cluster" name="nama_cluster">
                        </div>
                        <div class="form-group">
                            <label for="kd_cluster">Kode Cluster:</label>
                            <input type="text" class="form-control mt-2" id="kd_cluster" name="kd_cluster" >
                        </div>
                        <button type="submit" class="btn btn-primary mt-3" name="simpan">Submit</button>
                    </form>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $nama_cluster = isset($_POST['nama_cluster']) ? $_POST['nama_cluster'] : '';
                        $kd_cluster = isset($_POST['kd_cluster']) ? $_POST['kd_cluster'] : '';
                        if (empty( $nama_cluster )) {
                            ?>
                            <script>
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Nama Tidak Boleh Kosong',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            </script>
                            <?php
                        }
                        elseif (strlen($kd_cluster) > 3) {
                            ?>
                            <script>
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Kode Harus Terdiri Dari 3 Angka',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            </script>
                            <?php
                        }

                        else {
                            $queryTambah = mysqli_query($con, "INSERT INTO cluster (nama_cluster, kd_cluster) VALUES ('$nama_cluster','$kd_cluster')");
                            if ($queryTambah) {
                                ?>
                                <script>
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Data berhasil ditambahkan',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = "cluster.php";  
                                        }
                                    });
                                </script>
                                <?php
                            } else {
                                ?>
                                <script>
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Gagal menambahkan data: <?php echo mysqli_error($con); ?>',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                </script>
                                <?php
                            }
                            
                        }   
                    }
                    ?>
                </div>
            </div>
        </div>
        </div>
        <div class="table-responsive mt-3">
                    <table class="table">
                        <form action="" method="POST">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Cluster</th>
                                <th>kd_cluster</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($jumlahCluster==0){
                                ?>
                                    <tr>
                                        <td colspan=5 class="text-center"> Data cluster tidak tersedia</td>
                                    </tr>
                                <?php
                            }else{
                                $jumlah = 1;
                                while($data=mysqli_fetch_array($query)){
                                    ?>
                                        <tr>
                                            <td><?php echo $jumlah; ?></td>
                                            <td><?php echo $data['nama_cluster']; ?></td>
                                            <td><?php echo $data['kd_cluster']; ?></td>
                                            <td>
                                                <!-- ini untuk edit -->
                                                <a href="edit_cluster.php?q=<?php echo $data['id']?>" class="btn btn-info me-2" >
                                                <i class="fa-regular fa-pen-to-square"></i>
                                                    <!-- ini untuk hapus -->
                                                <a href="#" class="btn btn-danger" onclick="
                                                Swal.fire({
                                                    title: 'Apakah Anda Yakin ?',
                                                    text: 'Anda mungkin tidak bisa mengembalikan datanya',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Hapus Cluster',
                                                    cancelButtonText: 'Batal Hapus'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        fetch('cluster.php?hapus=<?php echo $data['id']?>', { method: 'GET' })
                                                            .then(response => response.text())
                                                            .then(data => {
                                                                if (data.includes('success')) {
                                                                    Swal.fire('Deleted!', 'Your item has been deleted.', 'success')
                                                                        .then(() => location.reload());
                                                                } else {
                                                                    Swal.fire('Error!', 'There was an issue deleting your item.', 'error');
                                                                }
                                                            })
                                                            .catch(error => Swal.fire('Error!', 'There was an error processing your request.', 'error'));
                                                    }
                                                });
                                                return false;
                                            ">
                                                <i class="fa-solid fa-trash"></i> 
                                            </a>


                                            </td>
                                        </tr>
                                    <?php
                                    $jumlah++;
                                }
                                
                            }
                        ?>
                        </tbody>
                </table>
                <?php
                    if (isset($_GET['hapus'])) {
                        $id = $_GET['hapus'];
                        $id = (int)$id; 

                        $queryHapus = mysqli_query($con, "DELETE FROM cluster WHERE id='$id'");

                        if ($queryHapus) {
                            ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Data berhasil dihapus
                            </div>
                        <meta http-equiv="refresh" content="0.1; url=cluster.php">
                            <?php
                        } else {
                            echo "Gagal menghapus data: " . mysqli_error($con);
                        }
                    }
                    ?>
                </form>

</div>
</div>
</div>

<script>
    function openPopup() {
        document.getElementById("popupForm").style.display = "block";
    }

    function closePopup() {
        document.getElementById("popupForm").style.display = "none";
    }
</script>

<script src="../libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>