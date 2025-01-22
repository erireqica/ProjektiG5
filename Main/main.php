<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Document</title>
</head>

<body>

    <div id="main">
        <div id="topbar">
            <img id="logo" src="../ProjektiImages/logo.png" alt="logo">
            <ul id="top">
                <li><a href="main.php"> Home </a></li>
                <li><a href="/ProjektiG5A/ProjektiG5/Products/products.html"> Products </a></li>
                <li><a href="/ProjektiG5A/ProjektiG5/News/news.php"> News </a></li>
                <li><a href="/ProjektiG5A/ProjektiG5/ContactUS/ContactUs.html"> Contact Us </a></li>
                <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']): ?>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <li><a href="/ProjektiG5A/ProjektiG5/Dashboard/dashboard.php"> Dashboard </a></li>
                <?php endif; ?>
                <li><a href="/ProjektiG5A/ProjektiG5/LogIn/logout.php">Sign Out</a></li>
                <?php else: ?>
                    <li><a href="/ProjektiG5A/ProjektiG5/LogIn/LogIn.html">Log In</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div id="kryesor" style="background-image: url('../ProjektiImages/background.jpg'); background-size: cover; background-position: center; height: 100vh;">
            <div id="teksti">
                <p><b>Where style meets precision. Whether you're here for a sharp new look or a relaxing shave, our expert barbers are ready to provide you with top-notch grooming in a comfortable, laid-back atmosphere. Book your appointment today and leave feeling your best!</b></p>
                <button id="btn1"><a href="/ProjektiG5A/ProjektiG5/ContactUS/ContactUs.html"><b> CONTACT US </b></a></button>
            </div>
            <div id="foto">
                <img id="barber" src="/ProjektiG5A/ProjektiG5/ProjektiImages/barber.jpg" alt="barber">
            </div>
        </div>

        <div id="kryesor2" style="width: 100%; height: 100%; display: flex; background-color: black; background-image: url('../ProjektiImages/background2.jpg'); background-size: cover; background-position: center; border-top: solid black 5px;">
            <div id="foto2">
                <img id="products" src="../ProjektiImages/products.png" alt="products">
            </div>

            <div id="teksti2">
                <p><b>Discover top-quality grooming products designed to elevate your style. From premium razors and clippers to nourishing beard oils and hair care essentials, we offer everything you need to look and feel your best. Experience the ultimate in barber-quality care!</b></p>
                <button id="btn2"><a href="/ProjektiG5A/ProjektiG5/Products/Products.html"><b> PRODUCTS </b></a></button>
            </div>

        </div>

    </div>
    
</body>

</html>
