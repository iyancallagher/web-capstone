<?php 
require 'session.php'; 
require '../koneksi.php'; 

// Ambil ID dari URL
$id_mahasiswa = $_GET['q'];

// Query untuk mendapatkan detail mahasiswa berdasarkan ID
$query = "SELECT pendaftar_mahasiswa.*, mahasiswa.nama 
          FROM pendaftar_mahasiswa 
          INNER JOIN mahasiswa ON pendaftar_mahasiswa.nim = mahasiswa.nim 
          WHERE pendaftar_mahasiswa.id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param('i', $id_mahasiswa);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.min.css">
    <title>Tanggapan Capstone</title>
    <style>
        .btn {
            background: linear-gradient(to right, #d641bf 0%, #6519c3 100%);
            border-radius: 20px;
            border: none;
        }
    </style>
</head>
<body>
    <?php require 'navbar.php'; ?>

    <div class="container mt-5 p-4" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h2 class="text-center mb-4" style="color: #6519c3;">Tanggapan Untuk <?php echo $data['nama']; ?></h2>
        <div class="mt-3">
            <p><strong>NIM:</strong> <?php echo $data['nim']; ?></p>
            <p><strong>Topik Riset:</strong> <?php echo $data['topik_riset']; ?></p>
        </div>
        
        <?php if (!empty($success_message)) : ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php elseif (!empty($error_message)) : ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-4">
                <label for="tanggapan" class="form-label">Tanggapan Dosen:</label>
                <textarea name="tanggapan_laporan" id="tanggapan" rows="4" class="form-control" required><?php echo $data['tanggapan_laporan']; ?></textarea>
            </div>
            <div class="mb-4">
                <label for="status" class="form-label">Status Topik Riset:</label>
                <select name="status_laporan" id="status" class="form-select" required>
                    <option value="Belum disetujui" <?php if ($data['status'] == 'Belum disetujui') echo 'selected'; ?>>Belum disetujui</option>
                    <option value="Disetujui" <?php if ($data['status'] == 'Disetujui') echo 'selected'; ?>>Disetujui</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-lg w-100" name="simpan">Simpan Tanggapan</button>
        </form>
    </div>

    <?php
    // Periksa apakah form sudah di-submit
    if (isset($_POST['simpan'])) {
        $tanggapan = $_POST['tanggapan_laporan']; // Ambil tanggapan dosen
        $status = $_POST['status_laporan']; // Ambil status baru
        
        // Query untuk menyimpan tanggapan dan status
        $querySimpan = mysqli_query($con, "UPDATE pendaftar_mahasiswa SET tanggapan_laporan='$tanggapan', status_laporan='$status' WHERE nim='$data[nim]'");

        if ($querySimpan) {
            // Jika query berhasil, tampilkan notifikasi SweetAlert
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            Swal.fire({
                title: 'Tanggapan Diberikan!',
                text: 'Anda telah memberikan tanggapan.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'capstone.php';  // Redirect setelah user menekan OK
                }
            });
            </script>";
        } else {
            // Jika query gagal, tampilkan notifikasi SweetAlert dengan pesan error
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            Swal.fire({
                title: 'Pendaftaran Gagal!',
                text: 'Terjadi kesalahan saat mendaftar: " . mysqli_error($con) . "',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            </script>";
        }
    }
    ?>

    <script src="../libraries/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
