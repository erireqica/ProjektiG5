<?php
session_start();
require_once '../PHP/Database.php';
require_once '../PHP/AdminDashboard.php';

if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'admin') {
    header("Location: /ProjektiG5/Main/main.php");
    exit;
}

$db = new Database();
$adminDashboard = new AdminDashboard($db->getConnection());

try {
    $users = $adminDashboard->getUsers();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/desktop.css?v=1" media="screen and (min-width: 1025px)">
    <link rel="stylesheet" href="css/tablet.css?v=2" media="screen and (min-width: 768px) and (max-width: 1024px)">
    <link rel="stylesheet" href="css/mobile.css?v=2" media="screen and (min-width: 1px) and (max-width: 767px)">
</head>

<body>
    <div id="main">
        <div id="topbar">
        <a href="/ProjektiG5/Main/main.php"> <img id="logo" src="../ProjektiImages/logo.png" alt="logo"></a>
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

        <div id="kryesor" style="background-image: url('../ProjektiImages/background.jpg');">
            <div id="content">
                <h1>Admin Dashboard</h1>

                <?php if (isset($_GET['message'])): ?>
                    <div class="success"> <?php echo htmlspecialchars($_GET['message']); ?> </div>
                <?php endif; ?>

                <h2>Manage Users</h2>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['role']); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <form method="POST" action="updateRole.php">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <select name="role">
                                            <option value="user" <?php echo $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                                            <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                        </select>
                                        <button type="submit" class="update-button">Update</button>
                                    </form>
                                    <form method="POST" action="deleteUser.php">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <button type="submit" class="delete-button">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <div id="kryesor2" style="background-image: url('../ProjektiImages/background2.jpg');">
            <div id="content2">
                <h2>Manage Comments</h2>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($comments as $comment): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($comment['emri']); ?></td>
                            <td><?php echo htmlspecialchars($comment['email']); ?></td>
                            <td><?php echo htmlspecialchars($comment['komenti']); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <form method="POST" action="updateComment.php">
                                        <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                                        <button type="submit" class="update-button">Update</button>
                                    </form>
                                    <form method="POST" action="deleteComment.php">
                                        <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                                        <button type="submit" class="delete-button">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
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
