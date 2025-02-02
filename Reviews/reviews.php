<?php
    session_start();
    require_once '../PHP/Database.php';
    require_once '../PHP/Review.php';

    $db = new Database();
    $reviewObj = new Review($db->getConnection());

    if (isset($_POST['submit_review']) && isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
        $review = $_POST['review_text'];
        $rating = $_POST['rating'];
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['user'];
        $imagePath = null;

        if (isset($_FILES['review_image']) && $_FILES['review_image']['error'] === UPLOAD_ERR_OK) {
            $imageTmpName = $_FILES['review_image']['tmp_name'];
            $imageName = basename($_FILES['review_image']['name']);
            $uploadDir = 'uploads/';
            $imagePath = $uploadDir . uniqid() . '_' . $imageName;

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (!move_uploaded_file($imageTmpName, $imagePath)) {
                $imagePath = null;
            }
        }

        if (!empty($review) && $rating >= 1 && $rating <= 5) {
            $reviewObj->addReview($user_id, $username, $review, $rating, $imagePath);
        }
    }

    if (isset($_POST['delete_review']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        $review_id = $_POST['review_id'];
        $reviewObj->deleteReview($review_id);
    }

    $reviews = $reviewObj->getAllReviews();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/desktop.css?v=2" media="screen and (min-width: 1025px)">
        <link rel="stylesheet" href="css/tablet.css?v=2" media="screen and (min-width: 768px) and (max-width: 1024px)">
        <link rel="stylesheet" href="css/mobile.css?v=1" media="screen and (min-width: 1px) and (max-width: 767px)">
    </head>
    <body>
        <div id="main">
            <div id="topbar">
            <a href="/ProjektiG5/Main/main.php"> <img id="logo" src="../ProjektiImages/logo.png" alt="logo"></a>
                <button id="menu-toggle" style="color:white; margin-left:auto">&#9776;</button>
                <nav>
                    <ul id="top">
                        <li><a href="/ProjektiG5/Main/main.php">Home</a></li>
                        <li><a href="/ProjektiG5/Products/products.php">Products</a></li>
                        <li><a href="reviews.php">Reviews</a></li>
                        <li><a href="/ProjektiG5/ContactUS/Create.php">Contact Us</a></li>
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
            <div id="kryesor" style="position:absolute; background-image: url('../ProjektiImages/background.jpg');">           
            <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']): ?>
                <div id="review-form">
                    <h2 style="text-align:center; color:orange;">Submit Your Review</h2>
                    <form method="POST" enctype="multipart/form-data">
                        <textarea name="review_text" placeholder="Write your review here..." required></textarea>
                        <select name="rating" required>
                            <option value="" disabled selected>Rate us</option>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                        <input style="color:white; margin-bottom:10px" type="file" name="review_image" accept="image/*">
                        <button type="submit" name="submit_review">Submit</button>
                    </form>
                </div>
            <?php else: ?>
               <h2 id="teksti"> You need to be logged in to review! </h2>
               <button type="button" id="btn"><a style="color:white; text-decoration:none;" href="/ProjektiG5/LogIn/LogIn.php"> Log In </a> </button>
            <?php endif; ?>

            <div id="reviews-section">
                <h2>Customer Reviews</h2>
                <div id="reviews">
                    <?php foreach ($reviews as $review): ?>
                        <div class="review">
                            <h3><?= htmlspecialchars($review['username']) ?></h3>
                            <p><?= htmlspecialchars($review['review_text']) ?></p>
                            <div class="rating">
                                Rating: <?= str_repeat('⭐', $review['rating']) ?>
                            </div>
                            <?php if (!empty($review['image_path'])): ?>
                                <div class="review-image">
                                    <img src="<?= htmlspecialchars($review['image_path']) ?>" alt="Review Image">
                                </div>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                <form method="POST" class="delete-form">
                                    <input type="hidden" name="review_id" value="<?= $review['id'] ?>">
                                    <button type="submit" name="delete_review">Delete</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
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
