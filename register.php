<?php 

require 'koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.min.css">
    <title>Capstone Monitoring</title>
</head>
<style>
    *{
        font-family: 'Times New Roman', Times, serif;
    }
    
    input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    .register-box{
        width: 700px;
        height: 700px;
        box-sizing: border-box;
        border-radius: 10px;
    }
    .btn{
        background: linear-gradient(to right, #d641bf 0%, #6519c3 100%);
        border: none;
        margin: 20px;
    }
    .btns{
        background: linear-gradient(to right, #d641bf 0%, #6519c3 100%);
        border: none;
    }
</style>
<body>
    <div class="back">
        <a href="index.php">
            <button type="button" class="btn btn-primary btn-lg">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
        </a>
    </div>

    <div class="container my-5 col-12 col-md-6">
        <h2>Register Akun</h2>
        <div class="register-box p-5 shadow">
            <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" autocomplete="off">
                </div>
                <div>
                    <label for="nim" class="mt-3">NIM</label>
                    <input type="number" id="nim" name="nim" class="form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="nomor_hp" class="mt-3">Nomor HP</label>
                    <input type="number" id="nomor_hp" name="nomor_hp" class="form-control" autocomplete="off">
                </div>
                <div>
                    <label for="jurusan" class="mt-3">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan" name="jurusan" value="TEKNOLOGI INFORMASI" readonly>
                </div>
                <div>
                    <label for="kelas" class="mt-3">Kelas</label><br>
                    <select id="kelas" class="form-control mb-3" name="kelas" required>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option> 
                        <option value="D">D</option> 
                        <option value="E">E</option> 
                    </select>
                </div>
                <div>
                    <label for="foto" class="mt-3">Foto Kartu Tanda Mahasiswa</label>
                    <input type="file" id="foto" name="foto" class="form-control" autocomplete="off">
                </div>
                <div>
                    <label for="password" class="mt-3">Password</label>
                    <input type="password" id="password" name="password" class="form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="confirm_password" class="mt-3">Konfirmasi Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" autocomplete="off" required>
                    <button type="submit" class="btns btn-primary mt-3 form-control" name="simpan">Simpan</button>
                </div>
            </form>
        </div>

        <?php
        if (isset($_POST['simpan'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $nim = htmlspecialchars($_POST['nim']);
            $nomor_hp = htmlspecialchars($_POST['nomor_hp']);
            $jurusan = htmlspecialchars($_POST['jurusan']);
            $kelas = htmlspecialchars($_POST['kelas']);
            $password = htmlspecialchars($_POST['password']); 
            $target_dir = "img/foto_ktm/";
            $nama_file = basename($_FILES["foto"]["name"]);
            $imageFileType = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
            $image_size = $_FILES["foto"]["size"];
        
            // Hash nama file menggunakan bcrypt dan ambil substr untuk menghindari nama terlalu panjang
            $new_name = password_hash($nama_file, PASSWORD_BCRYPT);
            $new_name = substr($new_name, 7, 20) . '.' . $imageFileType;  // Ambil sebagian dari hasil hash untuk nama file
            
            $target_file = $target_dir . $new_name;
        
            if (substr($nim, 0, 2) != '23') {
                ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Anda bukan mahasiswa semester 5',
                    });
                </script>
                <?php
            } else {
                 // Memastikan direktori tujuan ada
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true); // Buat direktori jika belum ada
                }

                // Gunakan $target_file tanpa subdirektori
                $target_file = $target_dir . $new_name; // Gunakan nama file yang telah dihash

                if ($nama_file != '') {
                    // Lanjutkan dengan validasi dan unggah file
                    if ($image_size > 500000) {
                        echo '<div class="alert alert-warning mt-3" role="alert">Ukuran foto lebih dari 500 KB</div>';
                    } else {
                        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
                        if (!in_array($imageFileType, $allowed_types)) {
                            echo '<div class="alert alert-warning mt-3" role="alert">Format foto tidak didukung</div>';
                        } else {
                            // Coba untuk mengunggah file
                            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                                // Insert data into the database
                                $queryTambah = mysqli_query($con, "INSERT INTO mahasiswa (nama, nim, nomor_hp, jurusan, kelas, password, foto_ktm) VALUES ('$nama', '$nim', '$nomor_hp', '$jurusan', '$kelas', '$password', '$new_name')");
                                
                                if ($queryTambah) {
                                    echo "<script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Registrasi Berhasil',
                                            text: 'Akun berhasil didaftarkan!',
                                        });
                                    </script>";
                                    ?>
                                    <meta http-equiv="refresh" content="1"; url="login.php">
                                    <?php
                                }
                            } else {
                                echo '<div class="alert alert-danger mt-3" role="alert">Gagal mengunggah foto</div>';
                            }
                        }
                    }
                }

                // Tidak ada else untuk menangani ketika tidak ada file yang diunggah

        }
    }
        ?>

<script>
function validateForm() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm_password").value;

    if (password != confirmPassword) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Password dan Konfirmasi Password tidak cocok!',
        });
        return false;
    }
    return true;
}
</script>
</body>
</html>
