<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<style>
  *{
    font-family: 'Times New Roman', Times, serif;
  }
  .navbar{
    background: linear-gradient(to right, #d641bf 0%, #6519c3 100%);
}
.logouts{
    text-decoration: none;
    color: white;
    margin-left: 500px;
}
.nav-link h5{
  color: white;
  font-family: 'Times New Roman', Times, serif;
}
</style>
<body>
<nav class="navbar navbar-expand-lg ">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link me-2 " href="index.php">
            <img src="../img/logo/logofont-putih-revisi.png" width="120px" alt="">
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2 mt-2" href="dosen.php"><h5>Dosen</h5></a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2 mt-2" href="mahasiswa.php"><h5>Mahasiswa</h5></a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2 mt-2" href="cluster.php"><h5>Cluster</h5></a>
        </li>
    </ul>
    <li class="nav-item d-flex justify-content-end">
      <a class="logouts nav-link me-2" href="logout.php">logout</a>
    </li>
    </div>
  </div>
</nav>
</body>
</html>