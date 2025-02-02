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
    <title>Contact Us</title>
    <link rel="stylesheet" href="/ContactUs/CSS/ContactUs.css">
    <script src='/ContactUs/Contact.js'></script>
    <style>
        
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}


body {
    background: url('/ProjektiG5/ProjektiImages/background.jpg') no-repeat center center/cover;
    color: #fff;
    text-align: center;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}


body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7); 
    z-index: 0;
}

#topbar {
    background: rgba(0, 0, 0, 0.9);
    width: 100%;
    padding: 15px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
}

#logo {
    height: 50px;
    margin-left: 20px;
}

nav ul {
    list-style: none;
    display: flex;
    margin-right: 20px;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a {
    text-decoration: none;
    color: #ff6600;
    font-weight: bold;
    transition: 0.3s;
}

nav ul li a:hover {
    color: white;
}

.container {
    background: rgba(0, 0, 0, 0.85);
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(255, 102, 0, 0.8);
    max-width: 400px;
    width: 90%;
    backdrop-filter: blur(5px);
}


h1 {
    color: #ff6600;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
}

input, textarea {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    border: 2px solid #ff6600;
    background: #222;
    color: white;
    border-radius: 5px;
}

textarea {
    height: 100px;
}

input[type="submit"] {
    background: #ff6600;
    color: white;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

input[type="submit"]:hover {
    background: white;
    color: #ff6600;
}


.container a {
    display: block;
    margin-top: 15px;
    color:  ornage;
    text-decoration: none;
    font-weight: bold;
}

.container a:hover {
    color: white;
}
#main{
    background-image: url('../ProjektiImages/background.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100%;
    color: white;
    font-family: Arial, sans-serif;
    overflow: hidden;
}
    </style>
    

</head>
<body>
<div id="main">
        <div id="topbar">
                <img id="logo" src="../ProjektiG5/ProjektiImages/logo.png" alt="logo">
                <button id="menu-toggle">&#9776;</button>
                <nav>
                    <ul id="top">
                        <li><a href="/ProjektiG5/Main/main.php">Home</a></li>
                        <li><a href="/ProjektiG5/Products/products.php">Products</a></li>
                        
                        <li><a href="Create.php">Contact Us</a></li>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                            <li><a href="/ProjektiG5/Dashboard/dashboard.php"> Dashboard </a></li>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']): ?>
                            <li><a href="/ProjektiG5/LogIn/logout.php">Sign Out</a></li>
                        <?php else: ?>
                            <li><a href="/ProjektiG5/LogIn/LogIn.php">Log In</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        
        <div class="container">
            <h1>Contact Us</h1>
            <div class="form-container">
        <form action="Create.php" method="post">
            <input type="text" name="emri" placeholder="Emri" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text"   name="message" placeholder="Komenti" required>
            <input type="submit" name="submit" value="Submit">
        </form>
        

      

        </div>

        
</div>    

    <?php
    
    $host='localhost';
    $username='root';
    $password="";
    $dbname='log';
    $tabela="tbl3";


    if (isset($_POST['submit'])) {
        $emri = $_POST['emri'];
        $email = $_POST['email'];
        $komenti = $_POST['message'];

    if (empty($emri) || empty($email) || empty($komenti)) {
        die("Please fill in all fields.");
    }

    try {
        $dsn = "mysql:host=$host; dbname=$dbname;";
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO $tabela (emri, email, komenti) VALUES (:emri, :email, :komenti)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':emri' => $emri, ':email' => $email, ':komenti' => $komenti]);

        
        
        exit;
    } catch (PDOException $a) {
        echo "Error: " . $a->getMessage();
    }
}
?>

     

</body>
</html>
