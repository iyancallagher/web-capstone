<?php 

require 'koneksi.php';

// Query untuk mengambil data mahasiswa dan mengurutkan berdasarkan kelas (dari A hingga E)
$query = mysqli_query($con, "SELECT pendaftar_mahasiswa.*, mahasiswa.nama 
                             FROM pendaftar_mahasiswa 
                             INNER JOIN mahasiswa ON pendaftar_mahasiswa.nim = mahasiswa.nim");

$jumlahDataMahasiswa = mysqli_num_rows($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
<style>
        .breadcrumb {
    background-color: transparent;
    padding: 0;
    margin-bottom: 1rem;
    margin-top:20px;
    }
    .breadcrumb-item a {
    color: #6c757d;
    text-decoration: none;
    }
    .breadcrumb-item.active {
    color: #000;
    }
    .header {
    background: linear-gradient(90deg, #ff66cc 0%, #6600cc 100%);
    color: white;
    padding:2rem;
    text-align: start;
    border-radius:10px;
    }
</style>
</head>
<body>
    <div class="container">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
     <li class="breadcrumb-item">
      <a href="index.php">
       Beranda
      </a>
     </li>
     <li class="breadcrumb-item active" aria-current="page">
          <b>Pengumuman</b>
        </li>
    </ol>
   </nav>
    </div>

  <div class="container">
      <div class="header">
        <h1 class="fw-normal fs-5">Yuk cari tau tentang</h1>
        <h1 class="fw-bold fs-2">Pengumuman Terkait Capstone Project</h1>
      </div>
  </div>

  <div class="container">
  <div class="table-responsive mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Topik Riset</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($jumlahDataMahasiswa ==0){
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
                                    <td><?php echo $data['nim']; ?></td>
                                    <td><?php echo $data['topik_riset']; ?></td>
                                    <td>  <?php 
                                        $statusClass = '';
                                        if ($data['status'] == 'Belum Diperiksa') {
                                            $statusClass = 'bg-warning text-dark';  // Latar belakang kuning dengan teks gelap
                                        } elseif ($data['status'] == 'Belum disetujui') {
                                            $statusClass = 'bg-danger text-white';   // Latar belakang merah dengan teks putih
                                        } elseif ($data['status'] == 'Disetujui') {
                                            $statusClass = 'bg-success text-white';  // Latar belakang hijau dengan teks putih
                                        }
                                        ?>
                                        <span class="stat <?=$statusClass;?> p-2 rounded">Selesai</span>
                                    </td>
                                </tr>
                            <?php
                            $jumlah++;
                        }
                    }
                    ?>
                </tbody>
            </table>
      
    </div>
    <div class="mt-5">
      <?php require 'foother.php'?>
    </div>
</body>
</html>