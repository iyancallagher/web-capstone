<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Capstone Monitoring</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
  <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.min.css"/>

  <style>
    * {
      font-family: 'Times New Roman', Times, serif;
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
    }

    /* Header */
    .header {
      background: linear-gradient(135deg, #d641bf, #6519c3);
      padding: 10px 15px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      color: #fff;
      position: sticky;
      top: 0;
      z-index: 1001;
    }

    .header .left {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .header .logo img {
      height: 40px;
    }

    .navigation a {
      color: #fff;
      margin-left: 15px;
      text-decoration: none;
      transition: color 0.3s;
    }

    .navigation a:hover {
      color: #ddd;
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      height: 100vh;
      background: linear-gradient(to bottom, #d641bf 0%, #6519c3 100%);
      padding-top: 20px;
      position: fixed;
      top: 0;
      left: 0;
      color: white;
      transition: transform 0.3s ease;
      z-index: 1000;
    }

    .sidebar.closed {
      transform: translateX(-100%);
    }

    .sidebar .logo {
      text-align: center;
      margin-bottom: 30px;
    }

    .sidebar .logo img {
      width: 150px;
      height: auto;
    }

    .sidebar ul {
      list-style-type: none;
      padding: 0;
    }

    .sidebar ul li {
      padding: 15px 20px;
    }

    .sidebar ul li a {
      color: white;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: 0.3s;
    }

    .sidebar ul li a:hover {
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 8px;
      padding: 10px;
    }

    .toggle-btn {
      background-color: transparent;
      border: none;
      color: white;
      font-size: 24px;
      cursor: pointer;
    }

    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
      }

      .sidebar.open {
        transform: translateX(0);
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div class="left">
      <button class="toggle-btn" id="toggleSidebar">
        <i class="fas fa-bars"></i>
      </button>
      <div class="logo">
        <img src="img/logo/logofont-putih-revisi.png" alt="Logo" />
      </div>
    </div>
  </header>

  <!-- Sidebar -->
  <div class="sidebar closed mt-5" id="sidebar">
    <ul>
      <li><a href="index.php"><i class="fa-solid fa-home"></i> home</a></li>
      <li><a href="dashboard.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
      <li><a href="cluster.php"><i class="fa-solid fa-users"></i> Cluster</a></li>
      <li><a href="informasi.php"><i class="fa-solid fa-file-lines"></i> Informasi</a></li>
      <li><a href="pengaturan.php"><i class="fa-solid fa-gear"></i> Contact</a></li>
      <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
    </ul>
  </div>

  <script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('closed');
    });
  </script>

  <script src="libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
