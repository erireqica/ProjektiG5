<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "log";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $textContent = [];
    $sql = "SELECT section, content FROM text_content";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $textContent[$row['section']] = $row['content'];
        }
    }

    $conn->close();


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/desktop.css" media="screen and (min-width: 1025px)">
        <link rel="stylesheet" href="css/tablet.css" media="screen and (min-width: 768px) and (max-width: 1024px)">
        <link rel="stylesheet" href="css/mobile.css" media="screen and (min-width: 1px) and (max-width: 767px)">
        <title>Document</title>
    </head>

    <body>

        <div id="main">
            
            <div id="topbar">
                <img id="logo" src="../ProjektiImages/logo.png" alt="logo">
                <button style="color:white;" id="menu-toggle">&#9776;</button>
                <ul id="top">
                    <li><a href="main.php"> Home </a></li>
                    <li><a href="/ProjektiG5A/ProjektiG5/Products/products.html"> Products </a></li>
                    <li><a href="/ProjektiG5A/ProjektiG5/Reviews/reviews.php"> Reviews </a></li>
                    <li><a href="/ProjektiG5A/ProjektiG5/ContactUS/ContactUs.html"> Contact Us </a></li>
                    <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']): ?>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <li><a href="/ProjektiG5A/ProjektiG5/Dashboard/dashboard.php"> Dashboard </a></li>
                    <?php endif; ?>
                    <li><a href="/ProjektiG5A/ProjektiG5/LogIn/logout.php">Sign Out</a></li>
                    <?php else: ?>
                        <li><a href="/ProjektiG5A/ProjektiG5/LogIn/LogIn.php">Log In</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        
            <div id="kryesor3" style="background-image: url('../ProjektiImages/background2.jpg')">
                <p id="titulli">THE BARBERSHOP</p>
                <div id="slider-container">
                    <div id="slider">
                        <img src="../ProjektiImages/cut1.jpg" alt="Slide 1">
                        <img src="../ProjektiImages/cut2.jpg" alt="Slide 2">
                        <img src="../ProjektiImages/cut3.jpg" alt="Slide 3">
                    </div>
                    <button id="prev">&#10094;</button>
                    <button id="next">&#10095;</button>
                </div>
            </div>

            <script>
               let currentIndex = 0;
                const slides = document.querySelectorAll("#slider img");
                const slider = document.getElementById("slider");
                const totalSlides = slides.length;

                let autoSlideInterval = setInterval(nextSlide, 4000);

                function updateSlider() {
                    slider.style.transform = `translateX(-${currentIndex * (100 / totalSlides)}%)`;
                }

                function nextSlide() {
                    currentIndex = (currentIndex + 1) % totalSlides;
                    updateSlider();
                }

                function prevSlide() {
                    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                    updateSlider();
                }

                document.getElementById("prev").addEventListener("click", () => {
                    clearInterval(autoSlideInterval);
                    prevSlide();
                    autoSlideInterval = setInterval(nextSlide, 4000);
                });

                document.getElementById("next").addEventListener("click", () => {
                    clearInterval(autoSlideInterval);
                    nextSlide();
                    autoSlideInterval = setInterval(nextSlide, 4000);
                });



                
                if (window.matchMedia("(max-width: 767px)").matches) {
                const menuToggle = document.getElementById('menu-toggle');
                const topNav = document.getElementById('top');

                menuToggle.addEventListener('click', () => {
                    topNav.classList.toggle('active');
                    menuToggle.classList.toggle('active');
                });
            } else {
                const topNav = document.getElementById('top');
                const menuToggle = document.getElementById('menu-toggle');
                menuToggle.style.display = 'none';
                topNav.style.display = 'flex';
            }


            </script>


            <div id="kryesor" style="background-image: url('../ProjektiImages/background.jpg')">
                <div id="teksti">
                    <p><b><?php echo htmlspecialchars($textContent['teksti']); ?></b></p>
                    <button id="btn1"><a href="/ProjektiG5A/ProjektiG5/ContactUS/ContactUs.html"><b> CONTACT US </b></a></button>
                </div>
                <div id="foto">
                    <img id="barber" src="/ProjektiG5A/ProjektiG5/ProjektiImages/barber.jpg" alt="barber">
                </div>
            </div>

            <div id="kryesor2" style="background-image: url('../ProjektiImages/background.jpg')">
                <div id="foto2">
                    <img id="products" src="../ProjektiImages/products.png" alt="products">
                </div>

                <div id="teksti2">
                    <p><b><?php echo htmlspecialchars($textContent['teksti2']); ?></b></p>
                    <button id="btn2"><a href="/ProjektiG5A/ProjektiG5/Products/Products.html"><b> PRODUCTS </b></a></button>
                </div>

            </div>

        </div>
        
    </body>

</html>
