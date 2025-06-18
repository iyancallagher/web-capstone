<?php 
require 'session.php';
require '../koneksi.php';

// Menangani penghapusan data
if (isset($_GET['hapus'])) {
    $id_to_delete = $_GET['hapus'];
    $delete_query = mysqli_query($con, "DELETE FROM pendaftar_mahasiswa WHERE id = '$id_to_delete'");

    if ($delete_query) {
        echo "<script>alert('Data berhasil dihapus.');</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data: " . mysqli_error($con) . "');</script>";
    }
}

// Ambil kd_dosen dari session
$kd_dosen_login = $_SESSION['kd_dosen'];

// Ambil status dari parameter GET atau set ke 'Belum Diperiksa' sebagai default
$status = isset($_GET['status']) ? $_GET['status'] : 'Belum Diperiksa';

// Query untuk mendapatkan data mahasiswa dengan kd_dosen yang sama dan status yang dipilih
$query = mysqli_query($con, "SELECT pendaftar_mahasiswa.*, mahasiswa.nama 
                             FROM pendaftar_mahasiswa 
                             INNER JOIN mahasiswa ON pendaftar_mahasiswa.nim = mahasiswa.nim
                             WHERE pendaftar_mahasiswa.kd_dosen = '$kd_dosen_login' 
                             AND pendaftar_mahasiswa.status = '$status'");

// Periksa apakah query berhasil
if (!$query) {
    die("Query Error: " . mysqli_error($con));
}

$jumlahDataCapstone = mysqli_num_rows($query);
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
    <style>
        /* Styles yang sudah ada sebelumnya */
        .breadcrumb a { text-decoration: none; color: black; }
        .table-responsive { border-radius: 10px; }
        .table thead { background: linear-gradient(to right, #d641bf 0%, #6519c3 100%); color: white; }
        .stat { padding: 5px; border-radius: 5px; }
        .list-group-item { border: none; transition: border-color 0.3s; }
        .list-group-item:focus, .list-group-item:active { border: none; outline: none; }
        .bg-warning { background-color: yellow; color: darkslategray; }
        .bg-danger { background-color: red; color: white; }
        .bg-success { background-color: green; color: white; }
        .table-bordered { border: 1px solid #ddd; }
        .table-bordered th, .table-bordered td {border: 1px solid #ddd; }
    </style>
</head>
<body>
    <?php require 'navbar.php'; ?>
    <div class="container">
        <div class="mt-3">
            <h2>Halo <?php echo $_SESSION['username']; ?></h2>
        </div>
        <div class="mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="index.php">Dashboard</a> 
                        <a href="capstone.php"> /Capstone</a> 
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Form untuk memilih status -->
        <form method="GET" action="capstone.php">
            <div class="list-group list-group-horizontal mb-3">
                <button type="submit" name="status" value="Belum Diperiksa" class="list-group-item list-group-item-action <?php echo $status == 'Belum Diperiksa' ? 'active bg-warning' : ''; ?>">Belum Diperiksa</button>
                <button type="submit" name="status" value="Belum disetujui" class="list-group-item list-group-item-action <?php echo $status == 'Belum disetujui' ? 'active bg-danger' : ''; ?>">Belum Disetujui</button>
                <button type="submit" name="status" value="Disetujui" class="list-group-item list-group-item-action <?php echo $status == 'Disetujui' ? 'active bg-success' : ''; ?>">Disetujui</button>
            </div>
        </form>

        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Topik Riset</th>
                        <?php if ($status == 'Disetujui') { ?>
                            <th>Laporan Capstone</th>
                            <th>Status Laporan</th>
                            <th>Tanggapan</th>
                        <?php } else { ?>
                            <th>Tanggal daftar</th>
                            <th>Status topik riset</th>
                            <th>Tanggapan</th>
                        <?php } ?>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($jumlahDataCapstone == 0) {
                        echo "<tr><td colspan=7 class='text-center'>Data Mahasiswa tidak tersedia</td></tr>";
                    } else {
                        $jumlah = 1;
                        while ($data = mysqli_fetch_array($query)) {
                            $tanggal = $data['tanggal_daftar'];
                            $formattedDate = date('d F Y', strtotime($tanggal));
                            ?>
                            <tr>
                                <td><?php echo $jumlah; ?></td>
                                <td><?php echo $data['nim']; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><b><?php echo $data['topik_riset']; ?></b></td>
                                <?php if ($status == 'Disetujui') { ?>
                                    <td>
                                        <?php if (!empty($data['project_capstone'])) { ?>
                                            <a href="../img/laporan/<?php echo $data['project_capstone']; ?>" target="_blank" class="btn btn-info">
                                                <i class="fa-solid fa-file-pdf me-2"></i>
                                                <b>Laporan</b>
                                            </a>
                                        <?php } else { ?>
                                            <span class="text-danger text-truncate d-inline-block" style="max-width: 150px;"><b>Belum Mengumpulkan</b></span>
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <?php 
                                        $statusLaporan = '';
                                        if ($data['status_laporan'] == 'Belum Diperiksa') {
                                            $statusLaporan = 'bg-warning text-dark';  // Yellow background with dark text
                                        } elseif ($data['status_laporan'] == 'Belum disetujui') {
                                            $statusLaporan = 'bg-danger text-white';   // Red background with white text
                                        } elseif ($data['status_laporan'] == 'Disetujui') {
                                            $statusLaporan = 'bg-success text-white';  // Green background with white text
                                        } ?>
                                        <span class="stat ms-2 <?=$statusLaporan;?> p-2 rounded"> <?=$data['status_laporan'];?></span>
                                    </td>
                                    <td>  
                                        <div class="margin ">
                                            <a href="tanggapan.php?q=<?php echo $data['id']?>" class="btn btn-primary">
                                            <i class="fa-solid fa-comment-dots"></i>
                                            </a>
                                        </div></td>
                                        <?php } else { ?>
                                    <td><?php echo $formattedDate; ?></td>
                                    <td>
                                        <?php 
                                        $statusClass = '';
                                        if ($data['status'] == 'Belum Diperiksa') {
                                            $statusClass = 'bg-warning text-dark';  // Latar belakang kuning dengan teks gelap
                                        } elseif ($data['status'] == 'Belum disetujui') {
                                            $statusClass = 'bg-danger text-white';   // Latar belakang merah dengan teks putih
                                        } elseif ($data['status'] == 'Disetujui') {
                                            $statusClass = 'bg-success text-white';  // Latar belakang hijau dengan teks putih
                                        }
                                        ?>
                                        <span class="stat ms-2 <?=$statusClass;?> p-2 rounded"><?=$data['status'];?></span>
                                    </td>
                                    <td>
                                        <div class="margin">
                                            <a href="tanggapan_topik_riset.php?q=<?php echo $data['id']; ?>" class="btn btn-primary">
                                                <i class="fa-solid fa-comment-dots"></i>
                                            </a>
                                        </div>
                                    </td>
                                <?php } ?>

                                <td>
                                    <div class="action d-flex me-4">
                                        <div class="margin ">
                                            <a href="#" class="btn btn-danger" onclick="handleDelete(<?php echo $data['id']; ?>)">
                                                <i class="fa-solid fa-trash"></i> 
                                            </a>
                                        </div>
                                    </div>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function handleDelete(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: 'Anda mungkin tidak dapat mengembalikan data ini setelah dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Mengirim permintaan hapus menggunakan GET
                window.location.href = 'capstone.php?hapus=' + id;
            }
        });
    }
    </script>
</body>
</html>
