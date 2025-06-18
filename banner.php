<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slideshow</title>
    <style>
        * { box-sizing: border-box; }

        .slideshow-container {
            max-width: 100%px;
            position: relative;
            margin: auto;
        }

        .mySlides {
            display: none;
        }

        .mySlides img {
            width: 100%;
            border-radius: 0px;
        }

        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            border-radius: 0 3px 3px 0;
            user-select: none;
            background-color: rgba(0, 0, 0, 0.8);
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev:hover, .next:hover {
            background-color: rgba(0, 0, 0, 1);
        }
    </style>
</head>
<body>

<div class="slideshow-container">

    <div class="mySlides">
        <img src="img/banner/banner-1.png" alt="Slide 1">
    </div>

    <div class="mySlides">
        <img src="img/banner/banner-2.jpg" alt="Slide 2">
    </div>

    <div class="mySlides">
        <img src="img/banner/banner-1.png" alt="Slide 3">
    </div>

    <!-- Tombol prev dan next -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>

<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    // Fungsi untuk mengganti slide
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Fungsi untuk menampilkan slide
    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        if (n > slides.length) { slideIndex = 1 }
        if (n < 1) { slideIndex = slides.length }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slides[slideIndex - 1].style.display = "block";
    }
</script>

</body>
</html>
