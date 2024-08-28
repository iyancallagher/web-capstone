<?php
// session_start();
// require "../koneksi.php";


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
<style>
.main{
    height: 100vh;
}
.login-box{
    width: 500px;
    height: 300px;
    box-sizing: border-box;
    border-radius: 10px;
}
.btn{
    background: linear-gradient(to right, #d641bf 0%, #6519c3 100%);
    border-radius: 20px;
}
.btn h5{
    color: white;
    font-family: 'Times New Roman', Times, serif;
    margin-top: 5px;
}
</style>
<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-5 shadow">
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div>
                    <label for="password" class="mt-2">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div>
                    <button class="btn form-control mt-3" type="submit" name="loginbtn"><h5>login</h5></button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>