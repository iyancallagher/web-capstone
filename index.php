
<?php 

// require 'session.php';


?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.min.css">
    <title>Document</title>
</head>
<style>
.main{
    height: 100vh;
}
.login-box{
    width: 500px;
    height: 300px;
    box-sizing: border-box;
    border-radius: 10px;
    background: linear-gradient(to right, #d641bf 0%, #6519c3 100%);
}
.btn{
    background: linear-gradient(to right, #d641bf 0%, #6519c3 100%);
    border-radius: 20px;
}
.btn h4{
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    color: white;
}
.btn a{
text-decoration: none;
}
</style>
<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-4 shadow">
            <form action="" method="post">
                <div class="button mt-4">
                <div>
                    <button class="btn p-3 shadow form-control mt-3" name="loginbtndosen" href="/dosen-panel/login.php"> 
                        <a href="/dosen-panel/login.php"><h4>Login Sebagai Dosen</h4></a>
                    </button>
                </div>
                <div>
                    <button class="btn p-3 shadow form-control mt-3" type="submit" name="loginbtnmahasiswa"><h4>Login Sebagai Mahasiswa</h4></button>
                </div>        
                </div>
            </form>
        </div>
        <script src="libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>