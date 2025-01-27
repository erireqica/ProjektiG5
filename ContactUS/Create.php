<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="Contact.css">
    <script src='Contact.js'></script>
   
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
                        <li><a href="Create.php">Contact Us</a></li>
                        <li><a href="/ProjektiG5/Dashboard/dashboard.php">Dashboard</a></li>
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

            <a href="/Dashboard/dashboard.php">View Comments</a>
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
