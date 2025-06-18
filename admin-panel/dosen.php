<?php 
require 'session.php';
require '../koneksi.php';

$query = mysqli_query($con, "SELECT * FROM dosen");
$jumlahDataDosen = mysqli_num_rows($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['simpan'])) {
        // Handle adding a new lecturer
        $nama_dosen = isset($_POST['nama_dosen']) ? $_POST['nama_dosen'] : '';
        $prodi = isset($_POST['prodi']) ? $_POST['prodi'] : '';
        $kd_dosen = isset($_POST['kd_dosen']) ? $_POST['kd_dosen'] : '';
        $kd_cluster = isset($_POST['kd_cluster']) ? $_POST['kd_cluster'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        if (empty($nama_dosen) || empty($kd_cluster) || strlen($kd_cluster) !== 3 || strlen($kd_dosen) !== 3 || !preg_match('/^[A-Z]{3}$/', $kd_dosen)) {
            echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Input tidak valid',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        } else {
            $queryCheckCluster = mysqli_query($con, "SELECT kd_cluster FROM cluster WHERE kd_cluster = '$kd_cluster'");
            if (mysqli_num_rows($queryCheckCluster) > 0) {
                $queryTambah = mysqli_query($con, "INSERT INTO dosen (nama, prodi, kd_dosen, username, password, kd_cluster) VALUES ('$nama_dosen','$prodi','$kd_dosen','$username','$password','$kd_cluster')");
                if ($queryTambah) {
                    echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'Data berhasil ditambahkan',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'dosen.php';  
                            }
                        });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'Gagal menambahkan data: " . mysqli_error($con) . "',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    </script>";
                }
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Kode Cluster tidak ditemukan',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                </script>";
            }
        }
    } elseif (isset($_POST['update'])) {
        // Handle updating a lecturer
        $id = $_POST['id'];
        $edit_nama_dosen = $_POST['edit_nama_dosen'];
        $edit_kd_dosen = $_POST['edit_kd_dosen'];
        $edit_kd_cluster = $_POST['edit_kd_cluster'];

        $queryUpdate = mysqli_query($con, "UPDATE dosen SET nama='$edit_nama_dosen', kd_dosen='$edit_kd_dosen', kd_cluster='$edit_kd_cluster' WHERE id='$id'");
        if ($queryUpdate) {
            echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Data berhasil diperbarui',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();  
                    }
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Gagal memperbarui data: " . mysqli_error($con) . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    }
}

if (isset($_GET['hapus'])) {
    // Handle deleting a lecturer
    $id = (int)$_GET['hapus']; 
    $queryHapus = mysqli_query($con, "DELETE FROM dosen WHERE id='$id'");
    if ($queryHapus) {
        echo "<script>
            Swal.fire({
                title: 'Deleted!',
                text: 'Data berhasil dihapus',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        </script>";
    } else {
        echo "Gagal menghapus data: " . mysqli_error($con);
    }
}
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
    <style>
        * {
            font-family: 'Times New Roman', Times, serif;
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
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
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
        .table thead {
            background: linear-gradient(to right, #d641bf 0%, #6519c3 100%);
            color: white;
        }
        .table-responsive {
            border-radius: 10px;
        }
        .create {
            display: flex;
            justify-content: end;
            text-decoration: none;
            outline: none;
        }
        .add {
            display: flex;
            justify-content: space-between;
        }
        .create button {
            color: white;
        }
    </style>
</head>
<body>
    <?php require 'navbar.php'; ?>
    <div class="container">
        <div class="container mt-4 ml-5">
            <h2>Halo <?php echo $_SESSION['username']; ?></h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ms-2">
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="index.php">Dashboard</a> 
                        <a href="dosen.php"> /Table Dosen</a> 
                    </li>
                </ol>
            </nav>
        </div>
        <div class="mt-3">
            <div class="add">
                <h3>List Cluster atau Kompetensi Keahlian</h3>
                <button type="button" class="btn btn-secondary btn-lg" onclick="openPopup()">Tambah Dosen</button>
                <!-- Add New Lecturer Popup -->
                <div id="popupForm" class="popup">
                    <div class="popup-content">
                        <span class="close" onclick="closePopup()">&times;</span>
                        <h2>Tambah Dosen</h2>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="nama_dosen">Nama dosen</label>
                                <input type="text" class="form-control mt-2 mb-2" id="nama_dosen" name="nama_dosen" required>
                            </div>
                            <div class="form-group">
                                <label for="prodi">Prodi</label>
                                <input type="text" class="form-control mt-2 mb-2" id="prodi" name="prodi" value="TEKNOLOGI INFORMASI" readonly>
                            </div>
                            <div class="form-group">
                                <label for="kd_dosen">Kode Dosen</label>
                                <input type="text" class="form-control mt-2 mb-2" id="kd_dosen" name="kd_dosen" required>
                            </div>
                            <div class="form-group">
                                <label for="kd_cluster">Kode Cluster</label>
                                <select class="form-control mt-2" id="kd_cluster" name="kd_cluster" required>
                                    <option value="">Pilih Kode Cluster</option>
                                    <?php
                                    $queryClusters = mysqli_query($con, "SELECT kd_cluster, nama_cluster FROM cluster");
                                    while ($row = mysqli_fetch_assoc($queryClusters)) {
                                        echo '<option value="'.$row['kd_cluster'].'">'.$row['kd_cluster'].' - '.$row['nama_cluster'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control mt-2 mb-2" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control mt-2 mb-2" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3" name="simpan">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive mt-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dosen</th>
                            <th>Prodi</th>
                            <th>Kode Dosen</th>
                            <th>Kode Cluster</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($query)) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$data['nama']}</td>
                                <td>{$data['prodi']}</td>
                                <td>{$data['kd_dosen']}</td>
                                <td>{$data['kd_cluster']}</td>
                                <td>
                                    <a href='#' class='btn btn-info me-2' onclick=\"openEditPopup('{$data['id']}', '{$data['nama']}', '{$data['kd_dosen']}', '{$data['kd_cluster']}')\">
                                        <i class='fa-regular fa-pen-to-square'></i>
                                    </a>
                                    <a href='?hapus={$data['id']}' class='btn btn-danger' onclick=\"return confirm('Anda yakin ingin menghapus data ini?')\">
                                        <i class='fa-solid fa-trash'></i>
                                    </a>
                                </td>
                            </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Lecturer Popup -->
    <div id="editPopup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closeEditPopup()">&times;</span>
            <h2>Edit Dosen</h2>
            <form action="" method="POST" id="editForm">
                <input type="hidden" name="id" id="edit_id"> <!-- Hidden field to hold the ID -->
                <div class="form-group">
                    <label for="edit_nama_dosen">Nama Dosen</label>
                    <input type="text" class="form-control mt-2 mb-2" id="edit_nama_dosen" name="edit_nama_dosen">
                </div>
                <div class="form-group">
                    <label for="edit_prodi">Prodi</label>
                    <input type="text" class="form-control mt-2 mb-2" id="edit_prodi" name="edit_prodi" value="TEKNOLOGI INFORMASI" readonly>
                </div>
                <div class="form-group">
                    <label for="edit_kd_dosen">Kode Dosen</label>
                    <input type="text" class="form-control mt-2 mb-2" id="edit_kd_dosen" name="edit_kd_dosen">
                </div>
                <div class="form-group">
                    <label for="edit_kd_cluster">Kode Cluster</label>
                    <select class="form-control mt-2" id="edit_kd_cluster" name="edit_kd_cluster">
                        <option value="">Pilih Kode Cluster</option>
                        <?php
                        // Fetch the clusters from the database
                        $queryClusters = mysqli_query($con, "SELECT kd_cluster, nama_cluster FROM cluster");
                        while ($row = mysqli_fetch_assoc($queryClusters)) {
                            echo '<option value="'.$row['kd_cluster'].'">'.$row['kd_cluster'].' - '.$row['nama_cluster'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3" name="update">Update</button>
            </form>
        </div>
    </div>

    <script>
        function openPopup() {
            document.getElementById("popupForm").style.display = "block";
        }
        function closePopup() {
            document.getElementById("popupForm").style.display = "none";
        }
        function openEditPopup(id, nama, kd_dosen, kd_cluster) {
            document.getElementById("edit_id").value = id;
            document.getElementById("edit_nama_dosen").value = nama;
            document.getElementById("edit_kd_dosen").value = kd_dosen;
            document.getElementById("edit_kd_cluster").value = kd_cluster;
            document.getElementById("editPopup").style.display = "block";
        }
        function closeEditPopup() {
            document.getElementById("editPopup").style.display = "none";
        }
    </script>

    <script src="../libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
