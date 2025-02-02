<?php
session_start();


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: products.php");
    exit();
}


$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'log';
$tabela = "products";

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $conn = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $productName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $productInfo = filter_input(INPUT_POST, 'info', FILTER_SANITIZE_STRING);
    $productPrice = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $image = $_FILES['image'];

    if ($productName && $productInfo && $productPrice && $image) {
        if ($image['error'] === UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileType = mime_content_type($image['tmp_name']);

            if (in_array($fileType, $allowedTypes)) {
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $uploadFile = $uploadDir . time() . "_" . basename($image['name']);

                if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
                    try {
                        $sql = "INSERT INTO $tabela (name, info, price, image_path) VALUES (:name, :info, :price, :image_path)";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([
                            ':name' => $productName,
                            ':info' => $productInfo,
                            ':price' => $productPrice,
                            ':image_path' => $uploadFile
                        ]);

                        $success = "Product added successfully!";
                    } catch (PDOException $e) {
                        $error = "Database Error: " . htmlspecialchars($e->getMessage());
                    }
                } else {
                    $error = "Error saving the uploaded image.";
                }
            } else {
                $error = "Only JPEG, PNG, and GIF files are allowed.";
            }
        } else {
            $error = "Error uploading image.";
        }
    } else {
        $error = "Please fill in all fields correctly.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body { background-color: black; color: orange; font-family: Arial, sans-serif; }
        form { max-width: 400px; margin: 50px auto; padding: 20px; background-color: #333; border-radius: 10px; }
        label { display: block; margin-bottom: 10px; }
        input, textarea { width: 100%; padding: 10px; margin-bottom: 10px; }
        button { background-color: orange; color: black; padding: 10px 20px; border: none; cursor: pointer; }
        button:hover { background-color: darkorange; }
    </style>
</head>
<body>
    <h1>Add Product</h1>
    <?php if (!empty($success)) echo "<p style='color: green;'>$success</p>"; ?>
    <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="info">Product Info:</label>
        <textarea name="info" id="info" required></textarea>

        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" id="price" required>

        <label for="image">Product Image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>

        <button type="submit" name="submit">Add Product</button>
    </form>

    <p><a href="products.php" style="color: orange;"> Back to Products</a></p>
</body>
</html>
