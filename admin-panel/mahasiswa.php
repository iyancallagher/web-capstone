<?php 

require 'session.php';
require '../koneksi.php';

$query = mysqli_query($con, "SELECT * FROM mahasiswa");
$jumlahDataDosen = mysqli_num_rows($query);

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
    <title>Dosen</title>
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
    .create{
        display: flex;
        justify-content: end;
        text-decoration: none;
        outline:none;
    }

    .add{
        display: flex;
        justify-content: space-between;
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
            <a href="dosen.php"> /Mahasiswa</a> 
            </li>
        </ol>
    </nav>
    </div>
    <div class="mt-3">
    <div class="add">
        <h3>List Mahasiswa</h3>
        </div>
        </div>
        <div class="table-responsive mt-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Prodi</th>
                                <th>NIM</th>
                                <th>Nomor HP</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <th>Foto KTM</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($jumlahDataDosen==0){
                                ?>
                                    <tr>
                                        <td colspan=5 class="text-center"> Data mahasiswa tidak tersedia</td>
                                    </tr>
                                <?php
                            }else{
                                $jumlah = 1;
                                while($data=mysqli_fetch_array($query)){
                                    ?>
                                        <tr>
                                            <td><?php echo $jumlah; ?></td>
                                            <td><?php echo $data['nama']; ?></td>
                                            <td><?php echo $data['prodi']; ?></td>
                                            <td><?php echo $data['nim']; ?></td>
                                            <td><?php echo $data['nomor_hp']; ?></td>
                                            <td><?php echo $data['jurusan']; ?></td>
                                            <td><?php echo $data['kelas']; ?></td>
                                            <td><?php echo $data['foto_ktm']; ?></td>
                                            <td><?php echo $data['password']; ?></td>
                                            <td>


                                            <a href="#" class="btn btn-danger" onclick="
                                                Swal.fire({
                                                    title: 'Apakah Anda Yakin ?',
                                                    text: 'Anda mungkin tidak bisa mengembalikan datanya',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Hapus Mahasiswa',
                                                    cancelButtonText: 'Batal Hapus'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        fetch('dosen.php?hapus=<?php echo $data['id']?>', { method: 'GET' })
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
                        <?php
                    if (isset($_GET['hapus'])) {
                        $id = $_GET['hapus'];
                        $id = (int)$id; 

                        $queryHapus = mysqli_query($con, "DELETE FROM dosen WHERE id='$id'");

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
                </table>
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