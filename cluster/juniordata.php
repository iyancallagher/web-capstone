<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Junior Data Sains</title>
    <link rel="stylesheet" href="cluster.css">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body>
    <div class="container">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
     <li class="breadcrumb-item">
      <a href="landingpage.php">
       Beranda
      </a>
     </li>
     <li class="breadcrumb-item">
      <a href="../cluster.php">
       Cluster
      </a>
     </li>
     <li aria-current="page" class="breadcrumb-item active">
      <b>Junior Data Sains</b> 
     </li>
    </ol>
   </nav>
    </div>

    <div class="container">
    <div class="header">
        <h1 class="fw-normal fs-5">Yuk cari tau tentang</h1>
        <h1 class="fw-bold fs-2">Topik Riset Dari Cluster Junior Data Sains</h1>
    </div>
    </div>

    <div class="container">
      <div class="card">
        <div class="card-body">
        <p style="text-align:justify;">
        Junior Data Scientist adalah posisi entry-level dalam bidang data science. 
        Orang yang bekerja di posisi ini biasanya baru memulai karir mereka dalam 
        analisis data dan pengolahan data. Biasanya tugas junior data sain diantaranya 
        adalah mengumpulkan data dari berbagai sumber, baik itu database, API, atau file
        yang disediakan. Adapun beberapa topik riset yang relevan diantaranya adalah:
        </p>
        <h5>Optimalisasi Algoritma Pembelajaran Mesin untuk Dataset Kecil</h5>
        <p style="text-align:justify;">Optimalisasi Algoritma Pembelajaran Mesin untuk Dataset Kecil adalah sebuah 
          topik penelitian yang berfokus pada peningkatan kinerja model machine learning
          saat berhadapan dengan dataset yang terbatas. Dalam banyak kasus, data yang 
          tersedia untuk pelatihan model tidak selalu berjumlah besar, dan ini bisa menjadi 
          tantangan karena sebagian besar algoritma machine learning cenderung bekerja lebih 
          baik dengan dataset yang besar. Namun, ada berbagai teknik yang dapat digunakan 
          untuk memaksimalkan kinerja model meskipun jumlah data terbatas.
        </p>
        <h5>Analisis Pengaruh Preprocessing Data terhadap Kinerja Model</h5>
        <p style="text-align:justify;">
          Analisis Pengaruh Preprocessing Data terhadap Kinerja Model adalah studi tentang bagaimana
          langkah-langkah yang dilakukan sebelum melatih model pembelajaran mesin (preprocessing)
          dapat mempengaruhi akurasi, performa, dan generalisasi model tersebut. Preprocessing 
          adalah proses persiapan dan transformasi data mentah agar lebih cocok untuk digunakan 
          dalam algoritma machine learning. Dalam banyak kasus, kualitas preprocessing sangat 
          menentukan hasil akhir model.<br>Analisis pengaruh preprocessing terhadap kinerja model
          sangat penting untuk memahami bagaimana keputusan di awal (misalnya, teknik imputasi 
          atau normalisasi) dapat meningkatkan atau menurunkan performa prediktif, serta seberapa
          baik model mampu melakukan generalisasi terhadap data baru.
        </p>
        <h5>Implementasi Feature Engineering Otomatis dengan AutoML</h5>
        <p style="text-align:justify;">
        Implementasi Feature Engineering Otomatis dengan AutoML adalah salah satu pendekatan yang 
        berkembang dalam bidang pembelajaran mesin (machine learning) untuk mengotomatisasi proses 
        pembuatan fitur (feature engineering). Feature engineering adalah proses menciptakan atau 
        memodifikasi fitur dari data mentah agar model machine learning dapat menangkap pola lebih 
        baik. AutoML (Automated Machine Learning) memungkinkan otomatisasi langkah-langkah ini, 
        sehingga mempermudah pipeline machine learning tanpa perlu campur tangan manusia yang signifikan.<br>
        Implementasi otomatisnya dengan AutoML bisa sangat membantu dalam mempercepat dan meningkatkan hasil. 
        Dengan alat-alat seperti TPOT, H2O.ai, dan Auto-sklearn, kita dapat mengotomatisasi sebagian besar 
        proses ini, memungkinkan para praktisi untuk lebih fokus pada interpretasi hasil dan penerapan model. 
        Namun, pemahaman domain yang baik dan intervensi manusia masih diperlukan dalam beberapa kasus untuk 
        memastikan hasil yang optimal.
        </p>
        </div>
      </div>
    </div>
    <footer class="mt-5">
    <?php require "../foother.php"; ?>
    </footer>
</body>
</html>