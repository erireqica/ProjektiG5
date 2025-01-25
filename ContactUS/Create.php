<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="/projekti WEB G5/ContactUs/ContactUs.css">
    <script src='/projekti WEB G5/ContactUs.js'></script>
    <style>
        body {
            font-family: 'Gill Sans';
            margin: 0;
            padding: 0;
            background-image:  url("/projekti WEB G5/ProjektiImages/background.jpg");
            background-size: cover;
            color: #333;
        }

    </style>
</head>
<body>
<div id="main">
        <div id="topbar">
            <img id="logo" src="/ProjektiImages/logo (1).png" alt="logo" class="barber-logo">
            <ul id="top">
                <li><a href="/ProjektiG5/Main/main.php">Home</a></li>
                <li><a href="/ProjektiG5/Products/products.html">Products</a></li>
                <li><a href="/ProjektiG5/AboutUs/AboutUs.html">About Us</a></li>
                <li><a href="/ProjektiG5/LogIn/LogIn.html">Log In</a></li>
                
            </ul>
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
