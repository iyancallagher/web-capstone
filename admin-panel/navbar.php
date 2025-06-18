<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Capstone Monitoring</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * {
      font-family: 'Times New Roman', Times, serif;
    }

    .navbar {
      background: linear-gradient(to right, #d641bf 0%, #6519c3 100%);
    }

    .navbar-nav .nav-link h5 {
      color: white;
    }

    .logouts {
      text-decoration: none;
      color: white;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="../img/logo/logofont-putih-revisi.png" width="120px" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">&#9776;</span> <!-- Custom icon if needed -->
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="dosen.php"><h5>Dosen</h5></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mahasiswa.php"><h5>Mahasiswa</h5></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cluster.php"><h5>Cluster</h5></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="capstone.php"><h5>Capstone</h5></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto"> <!-- Ensure logout is on the right -->
        <li class="nav-item">
          <a class="logouts nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
