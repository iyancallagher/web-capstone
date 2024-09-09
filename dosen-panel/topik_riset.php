<?php 

require 'session.php';
require '../koneksi.php';

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
        .breadcrumb a{
        text-decoration: none;
        color: black;
     }
</style>
<body>
    <?php require "navbar.php";?>
    <div class="container mt-3">
    <h2>Halo <?php echo $_SESSION['username']; ?></h2>
    </div>
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                <a href="index.php">Dashboard</a> 
                <a href="topik_riset.php">/ Topik Riset</a> 
                </li>
            </ol>
        </nav>
    </div>
</body>
</html>