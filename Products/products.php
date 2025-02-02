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
<style>
    #ad1{
    padding: 5px 10px;
    font-size: 1em;
    background-color: #f39c12;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

  
    <link rel="stylesheet" href="/ProjektiG5/Products/css/desktop.css?v=3" media="screen and (min-width: 1025px)">


  
    <link rel="stylesheet" href="css/desktop.css?v=3" media="screen and (min-width: 1025px)">
    <link rel="stylesheet" href="css/tablet.css?v=3" media="screen and (min-width: 768px) and (max-width: 1024px)">
    <link rel="stylesheet" href="css/mobile.css?v=3" media="screen and (max-width: 767px)">
    <link rel="stylesheet" href="/products.css?v=3" media="screen and (max-width: 767px)">
</head>
<body>
    <div id="main">
        <div id="d1">
        <div id="topbar">
        <img id="logo" src="/ProjektiImages/logo.png" alt="logo">
    <button id="menu-toggle">☰</button> <!-- Menu Button -->
    
    <ul id="top">
        <li><a href="/ProjektiG5/Main/main.php">Home</a></li>
        <li><a href="/ProjektiG5/Products/products.php">Products</a></li>
        <li><a href="/ProjektiG5/ContactUS/Create.php">Contact Us</a></li>
        
        <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']): ?>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <li><a href="/ProjektiG5/Dashboard/dashboard.php">Dashboard</a></li>
            <?php endif; ?>
            <li><a href="/ProjektiG5/LogIn/logout.php">Sign Out</a></li>
        <?php else: ?>
            <li><a href="/ProjektiG5/LogIn/LogIn.php">Log In</a></li>
        <?php endif; ?>
    </ul>
</div>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        document.getElementById('top').classList.toggle('active');
    });
</script>

        </div>

        <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']): ?>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <button><a href="/ProjektiG5/Products/addProduct.php" id="ad1">Add Product</a></button>
            <?php endif; ?>
        <?php else: ?>
            <p id="a1" style="color: red; margin-right:10%;">You must be logged in to add products.</p>
        <?php endif; ?>

        <div id="main1">
    <h2>Available Products:</h2>

    <div id="product-container">
        <?php if ($productResult->num_rows > 0): ?>
            <?php while ($product = $productResult->fetch_assoc()): ?>
                <div class="product-card">
                    <div class="product-details">
                        <b><?= htmlspecialchars($product['name']) ?></b>
                        <p><?= htmlspecialchars($product['info']) ?></p>
                        <p style="color:white">Price: $<?= number_format($product['price'], 2) ?></p>
                    </div>
                    <div class="product-image-container">
                        <img class="product-image" src="<?= htmlspecialchars($product['image_path']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                        

                    </div>

                    <!-- Show delete button only if admin -->
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <form action="/ProjektiG5/Products/deleteProduct.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            <input type="hidden" name="product_id" value="<?= $product['ID']; ?>">
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No products available.</p>
        <?php endif; ?>
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
