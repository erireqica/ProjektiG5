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

$productQuery = "SELECT * FROM products ORDER BY id DESC";
$productResult = $conn->query($productQuery);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/ProjektiG5/products.css">
    
</head>
<body>
     <div id="main">
        <div id="d1">
            <div id="topbar">
                <img id="logo" src="/ProjektiImages/logo.png" alt="logo">
                <ul id="top">
                    <li><a href="/ProjektiG5/Main/main.php"> Home </a></li>
                    <li><a href="/ProjektiG5/Products/products.php"> Products </a></li>
                    <li><a href="/ProjektiG5/ContactUS/Create.php"> Contact Us</a></li>
                    <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']): ?>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                            <li><a href="/ProjektiG5/Dashboard/dashboard.php"> Dashboard </a></li>
                        <?php endif; ?>
                        <li><a href="/ProjektiG5/LogIn/logout.php">Sign Out</a></li>
                        <?php else: ?>
                            <li><a href="/ProjektiG5/LogIn/LogIn.php">Log In</a></li>
                        <?php endif; ?>
                   
                </ul>
                <?div>
        </div>
                         <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']): ?>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <button><a href="/ProjektiG5/Products/addProduct.php">Add Product</a></button>
            <?php endif; ?>
        <?php else: ?>
            <p>You must be logged in to add products.</p>
        <?php endif; ?>

                h2>Available Products</h2>

         <?php if ($productResult->num_rows > 0): ?>
            <?php while ($product = $productResult->fetch_assoc()): ?>
                <div class="product-card">
                    <div class="product-details">
                        <b><?= htmlspecialchars($product['name']) ?></b>
                        <p><?= htmlspecialchars($product['info']) ?></p>
                        <p style="color:black">Price: $<?= number_format($product['price'], 2) ?></p>
                        <a href="/ProjektiG5/LogIn/LogIn.php" class="buy-now">Buy Now</a>
                    </div>
                    <div class="product-image-container">
                        <img class="product-image" src="<?= htmlspecialchars($product['image_path']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No products available.</p>
        <?php endif; ?>
        
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
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const menuToggle = document.getElementById("menu-toggle");
        const topNav = document.getElementById("top");

        menuToggle.addEventListener("click", function () {
            topNav.classList.toggle("active");
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const productContainer = document.getElementById("product-container");
        const productCards = document.querySelectorAll(".product-card");

        if (productCards.length > 2) {
            productContainer.style.overflowY = "scroll";
        }
    });
</script>
</body>
</html>
