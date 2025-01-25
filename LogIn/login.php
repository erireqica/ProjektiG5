<?php
$error = "";

if (isset($_POST['login'])) {
    session_start();
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "log";
    $table = "users";

    $email = $_POST['email'];
    $pass = $_POST['password'];

    if (empty($email) || empty($pass)) {
        $error = "Please fill in all fields.";
    } else {
        try {
            $dsn = "mysql:host=$host;dbname=$dbname";
            $conn = new PDO($dsn, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * FROM $table WHERE email = :email");
            $stmt->execute([":email" => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($pass, $user['password'])) {
                $_SESSION['loggedIn'] = true;
                $_SESSION['user'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['user_id'] = $user['id'];

                if ($user['role'] === 'admin') {
                    header("Location: /ProjektiG5A/ProjektiG5/Dashboard/dashboard.php");
                } else {
                    header("Location: /ProjektiG5A/ProjektiG5/Main/main.php");
                }
                exit;
            } else {
                $error = "Incorrect email or password.";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>

<html>
    <head>
        <link rel='stylesheet' href='LogIn.css' type='text/css' />
        <link rel="stylesheet" href="css/desktop.css" media="screen and (min-width: 1025px)">
        <link rel="stylesheet" href="css/tablet.css" media="screen and (min-width: 768px) and (max-width: 1024px)">
        <link rel="stylesheet" href="css/mobile.css" media="screen and (min-width: 1px) and (max-width: 767px)">
    </head> 
    
    <body> 
        <div id="main">
            <div id="topbar">
                <img id="logo" src="../ProjektiImages/logo.png" alt="logo">
                <ul id="top">
                    <li class="bar"><a href="/ProjektiG5A/ProjektiG5/Main/main.php"> Home </a></li>
                    <li class="bar"><a href="/ProjektiG5A/ProjektiG5/Products/Products.html"> Products </a></li>
                    <li class="bar"><a href="/ProjektiG5A/ProjektiG5/Reviews/reviews.php"> Reviews </a></li>
                    <li class="bar"><a href="/ProjektiG5A/ProjektiG5/ContactUS/ContactUs.html"> Contact Us </a></li>
                    <li class="bar"><a href="LogIn.php"> Log In </a></li>
                </ul>
            </div>

            <div id="kryesor" style="background-image: url('../ProjektiImages/background.jpg');">
                <div id="Block1">
                    <div id="LogIn">
                        <form action="login.php" method="POST"> 
                            <ul> 
                                <label id="tekst1" style="color: white;"> <h1 class="h1">Log In</h1></label>
                                <li><input id="emaili1" name="email" type="email" placeholder="Email" size="20" value="<?php echo htmlspecialchars($email ?? ''); ?>" /></li>
                                <li><input id="pass1" name="password" type="password" placeholder="Password" size="20" /></li>
                                <li><input id="submit1" name="login" type="submit" value="SUBMIT" /></li>
                                <?php if (!empty($error)): ?>
                                    <p style="color: red; margin-left: 15%;"><?php echo htmlspecialchars($error); ?></p>
                                <?php endif; ?>
                            </ul> 
                        </form> 
                    </div>
                </div>

                <div id="Block2">
                <div id="SignUp">
                    <form action="register.php" method="POST"> 
                        <ul> 
                            <label id="tekst2" style="color: white;"><h1 class="h1">Sign Up</h1></label>
                            <li><input id="emri1" name="name" type="text" placeholder="Name" size="20"/></li> 
                            <li><input id="mbiemri1" name="surname" type="text" placeholder="Surname" size="20"/></li>
                            <li><input id="emaili2" name="email" type="email" placeholder="Email" size="20"/></li>
                            <li><input id="pass2" name="password" type="password" placeholder="Password" size="20"/></li>
                            <li><input id="submit2" name="register" type="submit" value="SUBMIT"/></li>
                            <?php 
                                if (isset($_GET['register_error'])) {
                                    echo "<p style='color: red;'>" . htmlspecialchars($_GET['register_error']) . "</p>";
                                } elseif (isset($_GET['success'])) {
                                    echo "<p style='color: lightgreen; margin-left: 25%;'>Sign Up Successful</p>";
                                }
                            ?>
                        </ul> 
                    </form> 
                </div>
                </div>
            </div> 
        </div>
    </body> 
</html>
