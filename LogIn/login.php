<?php
    session_start();
    require_once '../PHP/Database.php';
    require_once '../PHP/User.php';

    $error = "";
    $db = new Database();
    $user = new User($db->getConnection());

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];

        if (empty($email) || empty($pass)) {
            $error = "Please fill in all fields.";
        } else {
            $role = $user->login($email, $pass);

            if ($role) {
                if ($role === 'admin') {
                    header("Location: /ProjektiG5/Dashboard/dashboard.php");
                } else {
                    header("Location: /ProjektiG5/Main/main.php");
                }
                exit;
            } else {
                $error = "Incorrect email or password.";
            }
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/desktop.css?=v2" media="screen and (min-width: 1025px)">
        <link rel="stylesheet" href="css/tablet.css?=v1" media="screen and (min-width: 768px) and (max-width: 1024px)">
        <link rel="stylesheet" href="css/mobile.css?=v1" media="screen and (min-width: 1px) and (max-width: 767px)">
        <script src="login.js"></script>
    </head> 
    
    <body> 
        <div id="main">
            <div id="topbar">
                <a href="/ProjektiG5/Main/main.php"> <img id="logo" src="../ProjektiImages/logo.png" alt="logo"></a>
                <button id="menu-toggle" style="color:white; margin-left:auto">&#9776;</button>
                <nav>
                    <ul id="top">
                        <li class="bar"><a href="/ProjektiG5/Main/main.php"> Home </a></li>
                        <li class="bar"><a href="/ProjektiG5/Products/Products.php"> Products </a></li>
                        <li class="bar"><a href="/ProjektiG5/Reviews/reviews.php"> Reviews </a></li>
                        <li class="bar"><a href="/ProjektiG5/ContactUS/Create.php"> Contact Us </a></li>
                        <li class="bar"><a href="LogIn.php"> Log In </a></li>
                    </ul>
                </nav>
            </div>

            <div id="kryesor" style="background-image: url('../ProjektiImages/background.jpg');">
                <div id="Block1">
                    <div id="LogIn">
                        <form action="login.php" method="POST"> 
                            <ul> 
                                <label id="tekst1" style="color: white;"> <h1 class="h1">&nbsp; Log In</h1></label>
                                <li><input id="emaili1" name="email" type="email" placeholder="Email" size="20"/></li>
                                <li><input id="pass1" name="password" type="password" placeholder="Password" size="20" /></li>
                                <li><input id="submit1" name="login" type="submit" value="SUBMIT" /></li>
                                <?php if (!empty($error)): ?>
                                    <p class="text" style="color: red;"><?php echo htmlspecialchars($error); ?></p>
                                <?php endif; ?>
                            </ul> 
                        </form> 
                    </div>
                </div>

                <div id="Block2">
                <div id="SignUp">
                    <form action="register.php" method="POST"> 
                        <ul> 
                            <label id="tekst2" style="color: white;"><h1 class="h1">&nbsp; Sign Up</h1></label>
                            <li><input id="emri1" name="name" type="text" placeholder="Name" size="20"/></li> 
                            <li><input id="mbiemri1" name="surname" type="text" placeholder="Surname" size="20"/></li>
                            <li><input id="emaili2" name="email" type="email" placeholder="Email" size="20"/></li>
                            <li><input id="pass2" name="password" type="password" placeholder="Password" size="20"/></li>
                            <li><input id="submit2" name="register" type="submit" value="SUBMIT"/></li>
                            <?php 
                                if (isset($_GET['register_error'])) {
                                    echo "<p class='text2' style='color: red;'>" . htmlspecialchars($_GET['register_error']) . "</p>";
                                } elseif (isset($_GET['success'])) {
                                    echo "<p class='text3' style='color: lightgreen;'>Sign Up Successful</p>";
                                }
                            ?>
                        </ul> 
                    </form> 
                </div>
                </div>
            </div> 
        </div>
            <script>
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
    </body> 
</html>
