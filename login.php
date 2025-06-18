<?php
session_start();
require "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.min.css">
    <title>Capstone Monitoring</title>
</head>
<body>
<style>
.main {
    height: 100vh;
    padding: 20px; /* Menambahkan padding untuk memastikan jarak di layar kecil */
}

.login-box {
    width: 100%; /* Atur lebar penuh agar responsif */
    max-width: 500px; /* Batas maksimum untuk layar besar */
    height: auto; /* Ubah agar tinggi menyesuaikan konten */
    box-sizing: border-box;
    border-radius: 10px;
    padding: 20px; /* Tambahkan padding untuk kenyamanan */
}

.btn {
    background: linear-gradient(to right, #d641bf 0%, #6519c3 100%);
    border-radius: 20px;
    border: none;
}

.btns {
    background: linear-gradient(to right, #d641bf 0%, #6519c3 100%);
    border-radius: 10px;
    border: none;
    margin: 20px;
}

.btn h5 {
    color: white;
    font-family: 'Times New Roman', Times, serif;
}

.judul {
    font-family: 'Times New Roman', Times, serif;
    text-align: center; /* Pastikan teks judul selalu di tengah */
}

@media (max-width: 768px) {
    .login-box {
        width: 90%; /* Kurangi lebar untuk memastikan ruang di layar kecil */
        padding: 15px; /* Kurangi padding pada layar kecil */
    }
    
    .btns {
        margin: 10px; /* Kurangi margin pada layar kecil */
    }

    .main {
        padding: 10px; /* Kurangi padding agar lebih pas */
    }
}
</style>

<body>
<div class="back">
    <a href="index.php">
        <button type="button" class="btns btn-primary btn-lg">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
    </a>
</div>
<div class="main d-flex flex-column justify-content-center align-items-center">
    <div class="judul">
        <h1>Login Mahasiswa</h1>
    </div>
    <div class="login-box p-5 shadow">
        <form action="" method="post">
            <div>
                <label for="nim">Nim</label>
                <input type="text" class="form-control" name="nim" id="nim" placeholder="Masukkan NIM">
            </div>
            <div>
                <label for="password" class="mt-2">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" required>
                    <span class="input-group-text" style="cursor: pointer;">
                        <i class="fa fa-eye" id="togglePasswordIcon"></i>
                    </span>
                </div>
            </div>
            <div>
                <button class="btn form-control mt-3" type="submit" name="loginbtn"><h5>login</h5></button>
            </div>
            <a class="d-flex justify-content-center mt-2" href="register.php">Anda belum punya akun???</a>
        </form>
    </div>
    <div class="mt-3">
        <?php 
        if (isset($_POST['loginbtn'])) {
            $nim = htmlspecialchars($_POST['nim']);
            $password = htmlspecialchars($_POST['password']);

            // Query to check the user in the database
            $query = mysqli_query($con, "SELECT * FROM mahasiswa WHERE nim='$nim'");
            $countdata = mysqli_num_rows($query);
            $data = mysqli_fetch_array($query);

            if ($countdata > 0) {
                if ($password == $data['password']) {
                    $_SESSION['nim'] = $data['nim'];
                    $_SESSION['login'] = true;
                    header('Location: dashboard.php');
                    exit();
                } else {
                    ?>
                    <div class="alert alert-warning" role="alert">Password anda salah</div>
                    <?php
                }
            } else {
                ?>
                <div class="alert alert-warning" role="alert">Nim anda tidak ditemukan</div>
                <?php
            }
        }
        ?>
    </div>
</div>
<script>
const togglePasswordIcon = document.querySelector('#togglePasswordIcon');
const password = document.querySelector('#password');

togglePasswordIcon.addEventListener('click', function () {
    // Toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    // Toggle the icon class
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});
</script>
</body>
</html>
