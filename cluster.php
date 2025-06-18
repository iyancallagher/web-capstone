<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Program Studi</title>

  <!-- Bootstrap & FontAwesome -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

  <style>
    body {
      background-color: #f5f5ff;
      font-family: 'Segoe UI', sans-serif;
    }

    .breadcrumb {
      background-color: transparent;
      padding: 0;
      margin-top: 20px;
    }

    .breadcrumb-item a {
      color: #6c757d;
      text-decoration: none;
    }

    .breadcrumb-item.active {
      color: #000;
    }

    .judul {
      background: linear-gradient(90deg, #ff66cc 0%, #6600cc 100%);
      margin-top: 20px;
      color: white;
      padding: 2rem;
      border-radius: 12px;
      text-align: start;
      margin-bottom: 2rem;
    }

    .judul h1:first-child {
      font-size: 1.25rem;
      margin-bottom: 0.5rem;
    }

    .judul h1:last-child {
      font-size: 2rem;
      font-weight: bold;
    }

    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: all 0.4s ease;
      background: #fff;
    }

    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .card-body {
      padding: 2rem;
      text-align: center;
    }

    .card-body h5 {
      font-weight: 600;
      margin-bottom: 0.75rem;
    }

    .card-body p {
      color: #6c757d;
      font-size: 0.95rem;
      min-height: 60px;
    }

    .card-body a.btn {
      margin-top: 1rem;
      border: 1px solid #6600cc;
      color: #6600cc;
      padding: 0.5rem 1.2rem;
      border-radius: 30px;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .card-body a.btn:hover {
      background: linear-gradient(90deg, #6600cc 0%, #ff66cc 100%);
      color: #fff;
      border-color: transparent;
    }
  </style>
</head>
<body>
    <?php include "navbar.php"?>
  <div class="container">
    <!-- Header Section -->
    <div class="judul">
      <h1>Yuk cari tahu tentang</h1>
      <h1>Cluster Capstone Teknik Informatika</h1>
    </div>

    <!-- Program Studi Cards -->
    <div class="row g-4">
      <!-- Card 1 -->
      <div class="col-md-4 col-sm-6">
        <div class="card h-100">
          <div class="card-body">
            <h5>Junior Programer</h5>
            <p>Pengembang perangkat lunak pemula yang baru memulai kariernya dalam dunia pemrograman.</p>
            <a href="cluster/juniorprogramer.php" class="btn">Lihat Cluster</a>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-4 col-sm-6">
        <div class="card h-100">
          <div class="card-body">
            <h5>Junior Mobile Programer</h5>
            <p>Pengembang pemula dalam bidang pengembangan aplikasi mobile.</p>
            <a href="cluster/juniormobile.php" class="btn">Lihat Cluster</a>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-4 col-sm-6">
        <div class="card h-100">
          <div class="card-body">
            <h5>Junior Data Sains</h5>
            <p>Posisi entry-level yang fokus menganalisis dan mengolah data.</p>
            <a href="cluster/juniordata.php" class="btn">Lihat Cluster</a>
          </div>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="col-md-4 col-sm-6">
        <div class="card h-100">
          <div class="card-body">
            <h5>System Analysis</h5>
            <p>Peneliti dan penguji sistem seperti website, aplikasi, hingga perangkat lunak.</p>
            <a href="cluster/systemanalis.php" class="btn">Lihat Cluster</a>
          </div>
        </div>
      </div>

      <!-- Card 5 -->
      <div class="col-md-4 col-sm-6">
        <div class="card h-100">
          <div class="card-body">
            <h5>Programmer</h5>
            <p>Seseorang yang menulis, menguji, dan memelihara kode komputer untuk membuat aplikasi.</p>
            <a href="cluster/programer.php" class="btn">Lihat Cluster</a>
          </div>
        </div>
      </div>

      <!-- Card 6 -->
      <div class="col-md-4 col-sm-6">
        <div class="card h-100">
          <div class="card-body">
            <h5>Data Manajemen Supervisor</h5>
            <p>Mengelola dan mengawasi data yang berkaitan dengan kinerja tim dan proyek.</p>
            <a href="cluster/datamanajemen.php" class="btn">Lihat Cluster</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
