<?php
session_start();
if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$host = "localhost";
$username = "root";
$password = "";
$dbname = "log";
$table = "users";

try {
    $dsn = "mysql:host=$host;dbname=$dbname";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->query("SELECT id, name, email, role FROM $table");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div id="main">
        <div id="topbar">
            <img id="logo" src="../ProjektiImages/logo.png" alt="logo">
            <nav>
                <ul id="top">
                    <li><a href="/ProjektiG5A/ProjektiG5/Main/main.php">Home</a></li>
                    <li><a href="/ProjektiG5A/ProjektiG5/Products/products.html">Products</a></li>
                    <li><a href="/ProjektiG5A/ProjektiG5/Reviews/reviews.php">Reviews</a></li>
                    <li><a href="/ProjektiG5A/ProjektiG5/ContactUS/ContactUs.html">Contact Us</a></li>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="/ProjektiG5A/ProjektiG5/LogIn/logout.php">Sign Out</a></li>
                </ul>
            </nav>
        </div>

        <div id="kryesor">
            <div id="content">
                <h1>Admin Dashboard</h1>

                <?php if (isset($_GET['message'])): ?>
                    <div class="success"><?php echo htmlspecialchars($_GET['message']); ?></div>
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
    </div>
</body>
</html>
