<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/ProjektiG5/products.css">
     <style>


body {
    background: url('/ProjektiG5/ProjektiImages/background.jpg') no-repeat center center/cover;
    color: white;
    text-align: center;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}


body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7); 
    z-index: -1;
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
    width: 100%;
    z-index: 10;
}

#logo {
    height: 50px;
    margin-left: 20px;
}

#top {
    list-style: none;
    display: flex;
    margin-right: 20px;
}

#top li {
    margin: 0 15px;
}

#top li a {
    text-decoration: none;
    color: orange;
    font-weight: bold;
    transition: 0.3s;
}

#top li a:hover {
    color: white;
}


#main {
    margin-top: 100px;
    width: 80%;
}


#d2, #d3, #d4 {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: rgba(0, 0, 0, 0.85);
    border: 2px solid orange; 
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(255, 102, 0, 0.7);
    margin: 20px auto;
    padding: 15px;
    max-width: 800px; 
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;

}


b {
    font-size: 27px;
    color: orange;
}


.buy-now {
    display: inline-block;
    background: orange;
    color: white;
    font-size: 22px;
    font-weight: bold;
    padding: 10px 20px;
    margin-top: 10px;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    transition: 0.3s ease-in-out;
}

.buy-now:hover {
    background: white;
    color: orange;
    border: 2px solid orange;
    transform: scale(1.05);
}


    </style>
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
