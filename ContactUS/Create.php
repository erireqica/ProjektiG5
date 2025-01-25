<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="Contact.css">
    <script src='Contact.js'></script>
    <style>
        body {
            font-family: 'Gill Sans';
            margin: 0;
            padding: 0;
            background-image:  url("../ProjektiImages/background.jpg");
            background-size: cover;
            color: #333;
        }

        #main {
            background-color:clear(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            margin: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 93%;
            height: 93%;
        }

        #topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background: clear;
        }

        #topbar img {
            height: 50px;
        }

        #topbar ul {
            list-style: none;
            padding: 0;
            display: flex;
        }

        #topbar ul li {
            margin-right: 15px;
        }

        #topbar ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        
        .container {
            text-align: center;
            margin-top: 30px;
        }

        .container h1 {
            font-size: 32px;
            color: red;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }


        .form-group input, .form-group textarea {
            width:93%;
            padding: 10px;
            font-size: 16px;
            border: 2px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
        }

        .form-group input:focus, .form-group textarea:focus {
            border-color: #FFD700;
            outline: none;
        }

        button {
            background-color: #333;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #FFD700;
        }

        #responseMessage {
            color: green;
            font-size: 18px;
            margin-top: 20px;
        }

        #topbar ul li a:hover {
            color: #FFD700;
        }

        .hidden {
            display: none;
        }

      

       
        a {
            text-decoration: none;
            color: #333;
            font-size: 18px;
            display: inline-block;
            margin-top: 20px;
        }

        a:hover {
            color: #FFD700;
        }
    </style>
</head>
<body>
<div id="main">
        <div id="topbar">
                <img id="logo" src="../ProjektiImages/logo.png" alt="logo">
                <button id="menu-toggle">&#9776;</button>
                <nav>
                    <ul id="top">
                        <li><a href="/ProjektiG5/Main/main.php">Home</a></li>
                        <li><a href="/ProjektiG5/Products/products.html">Products</a></li>
                        <li><a href="/ProjektiG5/Reviews/reviews.php">Reviews</a></li>
                        <li><a href="/ProjektiG5/ContactUS/ContactUs.html">Contact Us</a></li>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="/ProjektiG5/LogIn/logout.php">Sign Out</a></li>
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

            <a href="Read.php">View Comments</a>
        </div>

        
</div>    

    <?php
    
    $host='localhost';
    $username='root';
    $password="";
    $dbname='tbl1';
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
