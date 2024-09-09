<?php


require 'session.php';
require '../koneksi.php';


    $id = $_GET['q'];

    $query = mysqli_query($con, "SELECT * FROM cluster WHERE id='$id'");
    $data = mysqli_fetch_array($query);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <title>Detail kategori</title>
</head>
<style>
    .note{
        margin-top: 20px;
        display: flex;
        border-radius: 20px;
        justify-content: center;
    }
    .note h4{
        margin-top: 5px;
        margin-left: 10px
    }
    .note p{
        margin-top: 10px;
        margin-left: 5px;
    }
</style>
<body>
<?php require "navbar.php"; ?>
<div class="container">
    <div class="note btn-primary col-12 col-md-6">
        <h4>NOTE :</h4>
        <p>Untuk Kode Cluster Hanya 3 Huruf Dan KAPITAL !!!!!</p>
    </div>
<div class="tambah my-5 col-12 col-md-6">
    <h3>Tambah Cluster</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="nama_cluster">Nama Cluster</label>
            <input type="text" id="nama_cluster" name="nama_cluster" class="form-control" autocomplete="off" value="<?php echo $data['nama_cluster']?>" placeholder ="Masukan Nama Cluster">
        </div>
        <div>
            <label for="kd_cluster">Kode Cluster</label>
            <input type="text" id="kd_cluster" name="kd_cluster" class="form-control" autocomplete="off" value="<?php echo $data['kd_cluster']?>" placeholder ="Kode Cluster Hanya 3 Huruf dan Huruf Besar Semua">
        </div>
        
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary mt-3" name="simpan">Update</button>
            <button type="submit" class="btn btn-danger mt-3" name="hapus">Hapus</button>
        </div>
    </form>
                    <?php
                    if(isset($_POST['simpan'])){
                        $nama_cluster = isset($_POST['nama_cluster']) ? $_POST['nama_cluster'] : '';
                        $kd_cluster = isset($_POST['kd_cluster']) ? $_POST['kd_cluster'] : '';

                        // Check if required fields are empty
                        if($nama_cluster == '' ) {
                            ?>
                            <div class="alert alert-warning mt-3" role="alert">
                            nama Wajib Diisi !!!!
                            </div>
                            <?php
                        } 
                        elseif( $kd_cluster == '') {
                            ?>
                            <div class="alert alert-warning mt-3" role="alert">
                            kode Wajib Diisi !!!!
                            </div>
                            <?php
                        } 
                        // Check if kd_cluster is more than 3 characters or not fully capitalized
                        elseif(strlen($kd_cluster) > 3 || preg_match('/[a-z]/', $kd_cluster)) {
                            ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                Kode cluster harus terdiri dari 3 huruf dan huruf kapital saja!!!
                            </div>
                            <?php
                        } 
                        else {
                            $queryUpdate = mysqli_query($con, "UPDATE cluster SET nama_cluster='$nama_cluster', kd_cluster='$kd_cluster' WHERE id=$id");
                            if ($queryUpdate){
                                ?>
                                <div class="alert alert-success mt-3" role="alert">
                                    Data berhasil diupdate
                                </div>

                                <meta http-equiv="refresh" content="0.1; url=cluster.php">
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-danger mt-3" role="alert">
                                    Terjadi kesalahan saat mengupdate data!
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>

</div>
</div>


<script src="../libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
