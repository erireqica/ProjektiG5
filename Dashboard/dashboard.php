<?php
session_start();
if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>

<html>
    <head>
        <title>JavaScript Form Validation using a sample registration form</title>
        <link rel='stylesheet' href='dashboard.css' type='text/css' />
        <script src="LogIn.js"></script> 
    </head> 
    
    <body> 

        <div id="main">
            <div id="topbar">
                <img id="logo" src="../ProjektiImages/logo.png" alt="logo">
                <nav>
                <ul id="top">
                    <li><a href="/ProjektiG5A/ProjektiG5/Main/main.php"> Home </a></li>
                    <li><a href="/ProjektiG5A/ProjektiG5/Products/products.html"> Products </a></li>
                    <li><a href="/ProjektiG5A/ProjektiG5/News/news.php"> News </a></li>
                    <li><a href="/ProjektiG5A/ProjektiG5/ContactUS/ContactUs.html"> Contact Us </a></li>
                    <li><a href="dashboard.php"> Dashboard </a></li>
                    <li><a href="/ProjektiG5A/ProjektiG5/LogIn/logout.php">Sign Out</a></li>
                </ul>
                </nav>
                
            </div>

            <div id="kryesor" style="background-image: url('../ProjektiImages/background.jpg'); background-size: cover; background-position: center; height: 100vh;">
                
            </div>

            </div> 
        </div>
        
        
    </body> 
</html>
