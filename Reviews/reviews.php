<?php
session_start();
?>
<html>
    <head>
        <title>JavaScript Form Validation using a sample registration form</title>
        <link rel='stylesheet' href='reviews.css' type='text/css' />
        <script src="LogIn.js"></script> 
    </head> 
    
    <body> 

        <div id="main">
            <div id="topbar">
                <img id="logo" src="../ProjektiImages/logo.png" alt="logo">
                    <ul id="top">
                        <li><a href="/ProjektiG5A/ProjektiG5/Main/main.php"> Home </a></li>
                        <li><a href="/ProjektiG5A/ProjektiG5/Products/products.html"> Products </a></li>
                        <li><a href="reviews.php"> Reviews </a></li>
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
                
            </div>

            </div> 
        </div>
        
        
    </body> 
</html>