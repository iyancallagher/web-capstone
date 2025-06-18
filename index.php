<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <title>Monitoring Capstone</title>
    <style>
        /* Pengaturan Global */
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #d641bf, #6519c3);
            padding: 10px 15px; /* Mengurangi padding atas dan bawah */
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header .logo img {
            height: 40px; /* Sesuaikan tinggi logo agar proporsional dengan navbar */
        }

        .navigation a {
            color: #fff;
            font-size: 1rem; /* Sesuaikan ukuran font */
            margin-left: 10px;
            text-decoration: none;
            transition: color 0.3s;
        }

        /* Banner */
        .banner {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7)), url('img/banner/banner.png') center/cover no-repeat;
            height: 60vh; /* Use vh units for responsive height */
            display: flex;
            border-radius: 30px;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
            position: relative;
            overflow: hidden;
            animation: zoomIn 1.5s ease;
            padding: 20px; /* Padding for smaller screens */
        }
        .banner-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
        }

        .banner h1 {
            font-size: 2.5rem; /* Adjusted for mobile */
            font-weight: bold;
            margin-bottom: 15px;
            animation: fadeIn 2s ease forwards;
            background:#f9f9f9;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .banner p {
            font-size: 1rem; /* Adjusted for mobile */
            margin-top: 10px;
            color: #ffebcd;
            animation: fadeIn 2.5s ease forwards;
        }

        .cta-button {
            margin-top: 20px;
            padding: 10px 20px; /* Adjusted for mobile */
            font-size: 1rem;
            color: #fff;
            background-color: #ff6b6b;
            border-radius: 25px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0px 4px 15px rgba(255, 107, 107, 0.4);
        }

        .cta-button:hover {
            background-color: #ff3b3b;
            text-decoration: none;
            transform: translateY(-5px);
        }

        /* Animasi Zoom */
        @keyframes zoomIn {
            from { transform: scale(1.2); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        /* Cards Section */
        .container-cards {
            padding: 60px 20px;
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .card {
            background: linear-gradient(to right, #d641bf, #6519c3);
            color: #fff;
            width: 300px;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            transition: transform 0.4s, box-shadow 0.4s, background-color 0.4s;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transform: translateY(0);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
            background-color: #a834b2; /* Warna saat hover */
        }

        .card h3 {
            font-size: 1.8rem;
            margin: 15px 0;
        }

        .card i {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        /* Features Section Styling */
        .features {
            padding: 60px 20px;
            background-color: #ffffff;
            text-align: center;
        }

        .features h2 {
            font-size: 2.5rem;
            margin-bottom: 40px;
            color: #333;
            font-weight: 600;
        }

        .feature-list {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 20px;
            max-width: 600px;
            text-align: left;
        }

        .feature-item i {
            color: #6519c3;
        }

        .feature-item h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .feature-item p {
            font-size: 1rem;
            color: #666;
        }

        /* FAQ Section Styling */
        .faq {
            padding: 60px 20px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .faq h2 {
            font-size: 2.5rem;
            margin-bottom: 40px;
            color: #333;
            font-weight: 600;
        }

        .faq-list {
            max-width: 800px;
            margin: 0 auto;
            text-align: left;
        }

        .faq-item {
            margin-bottom: 20px;
            cursor: pointer;
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
            transition: color 0.3s;
        }

        .faq-item h3 {
            font-size: 1.5rem;
            margin: 0;
            color: #333;
        }

        .faq-answer {
            display: none;
            font-size: 1rem;
            color: #555;
            margin-top: 10px;
        }

        /* Contact Us Section Styling */
        .contact-us {
            padding: 60px 20px;
            background-color: #ffffff;
            text-align: center;
        }

        .contact-us h2 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: #333;
            font-weight: 600;
        }

        .contact-us p {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 30px;
        }

        .contact-details {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .contact-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            color: #555;
            font-size: 1rem;
        }

        .contact-item i {
            font-size: 2rem;
            color: #6519c3;
            margin-bottom: 10px;
        }

        /* Footer */
        .footer {
            background: #333;
            color: #fff;
            padding: 40px;
            text-align: center;
            font-size: 1rem;
        }

        .footer .social-icons a {
            color: #fff;
            margin: 0 15px;
            font-size: 1.5rem;
            transition: color 0.3s;
        }

        .footer .social-icons a:hover {
            color: #ff6b6b;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .banner {
                height: 40vh; /* Adjust height for smaller screens */
            }

            .banner h1 {
                font-size: 2rem; /* Adjusted font size for mobile */
            }

            .banner p {
                font-size: 0.9rem; /* Adjusted font size for mobile */
            }

            .card {
                width: 90%; /* Make cards full width on mobile */
            }

            .features h2 {
                font-size: 2rem;
            }

            .feature-item h3 {
                font-size: 1.2rem;
            }

            .faq h2 {
                font-size: 2rem;
            }

            .contact-us h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include "navbar.php"?>
    <!-- Banner -->
    <div class="container mt-3">
        <section class="banner">
            <div class="banner-content">
                <h1>Monitoring Capstone</h1>
                <p>Your journey towards a successful capstone project starts here!</p>
                <a class="cta-button" href="#features">Get Started</a>
            </div>
        </section>
    </div>

    <!-- Cards Section -->
    <div class="container-cards">
        <div class="card" onclick="window.location.href='cluster.php'">
            <i class="fas fa-briefcase"></i>
            <h3>Cluster</h3>
            <p>Jelajahi minat dan bakat anda dan bergabunglah dengan komunitas terbaik untuk proyek Anda.</p>
        </div>
        <div class="card" onclick="window.location.href='informasi.php'">
            <i class="fas fa-info-circle"></i>
            <h3>Informasi</h3>
            <p>pengalaman penyelesaian masalah nyata dalam Konteks Pembelajaran yang sudah dipelajari</p>
        </div>
        <div class="card" onclick="window.location.href='pengumuman.php'">
            <i class="fas fa-bullhorn"></i>
            <h3>Pengumuman</h3>
            <p>Pengumuman Terkait Capstone Project</p>
        </div>
    </div>
<!-- Fitur Utama Section -->
<section class="features" data-aos="fade-up">
    <h2>Fitur Utama Kami</h2>
    <div class="feature-list">
        <div class="feature-item">
            <i class="fas fa-chart-line fa-2x"></i>
            <h3>Monitoring Real-Time</h3>
            <p>Ikuti perkembangan proyek Anda dengan pembaruan data secara real-time.</p>
        </div>
        <div class="feature-item">
            <i class="fas fa-users fa-2x"></i>
            <h3>Kolaborasi</h3>
            <p>Berkolaborasi dengan tim dan mentor Anda dengan mudah dalam satu platform.</p>
        </div>
        <div class="feature-item">
            <i class="fas fa-tasks fa-2x"></i>
            <h3>Manajemen Tugas</h3>
            <p>Atur tugas dan tonggak sejarah Anda untuk produktivitas yang lebih baik.</p>
        </div>
        <div class="feature-item">
            <i class="fas fa-comments fa-2x"></i>
            <h3>Sistem Umpan Balik</h3>
            <p>Terima umpan balik konstruktif langsung dari mentor Anda.</p>
        </div>
    </div>
</section>
    <!-- FAQ Section -->
    <section class="faq" id="faq">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-list">
            <div class="faq-item">
                <h3>What is Capstone Monitoring?</h3>
                <div class="faq-answer">
                    <p>Capstone project atau proyek capstone adalah sebuah kulminasi proses Pembelajaran dengan Menerapkan apa yang sudah dipelajari dalam proses Pembelajaran. 
                        Mahasiswa secara independen melakukan pengembangan solusi berdasar masalah yang diutarakan. Tujuan utama dalam proyek capstone adalah memberikan pengalaman penyelesaian masalah nyata dalam Konteks Pembelajaran yang sudah dipelajari. 
                        Sehingga mahasiswa dapat mendemonstrasikan pengetahuan dan keterampilan yang sudah dipelajari. Penyelesaian masalah yang diusulkan tentunya dikemas dalam solusi yang dirancang dalam proses desain keteknikan yang benar.</p>
                </div>
            </div>
            <div class="faq-item">
                <h3>Tujuan Capstone</h3>
                <div class="faq-answer">
                    <p>Tujuan capstone project<br>
                    1. Melatih mahasiswa untuk menyelesaikan masalah riil dan kompleks<br>
                    2. Meningkatkan kemampuan mahasiswa dalam berpikir kritis, kreatif, dan inovatif<br>
                    3. Mengembangkan kemampuan mahasiswa dalam berkomunikasi, bekerja sama, dan memimpin tim<br>
                    4. Mempersiapkan mahasiswa untuk memasuki dunia kerja<br>
                </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section class="contact-us" id="contact">
        <h2>Contact Us</h2>
        <p>If you have any questions, feel free to reach out!</p>
        <div class="contact-details">
            <div class="contact-item">
                <i class="fas fa-phone"></i>
                <p>Phone: +1 234 567 890</p>
            </div>
            <div class="contact-item">
                <i class="fas fa-envelope"></i>
                <p>Email: info@example.com</p>
            </div>
            <div class="contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <p>Address: 123 Capstone St, City, Country</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Monitoring Capstone. By Kelompok 4 kelas 3C Teknik Informatika </p>
        <div class="social-icons">
            <a href="https://www.instagram.com/callmeryaann_"><i class="fab fa-instagram"></i></a>
            <a href="https://www.instagram.com/gustialtapra"><i class="fab fa-instagram"></i></a>
            <a href="https://www.instagram.com/iannnnnto"><i class="fab fa-instagram"></i></a>
            <a href="https://www.instagram.com/julpaaaaa_"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize AOS
            AOS.init();

            // FAQ toggle
            $('.faq-item').click(function() {
                $(this).find('.faq-answer').slideToggle();
                $(this).siblings().find('.faq-answer').slideUp();
            });
        });
    </script>
</body>
</html>
