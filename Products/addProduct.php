<?php
session_start();

// Ensure only admins can access this page
if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Only admins can add products.");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "log";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $info = $conn->real_escape_string($_POST['info']);
    $price = floatval($_POST['price']);

    // Ensure the images directory exists
    $targetDirectory = __DIR__ . "/images/";
    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    $imagePath = "";
    if (!empty($_FILES["image"]["name"])) {
        $imageName = basename($_FILES["image"]["name"]);
        $imagePath = "images/" . $imageName;
        $targetFile = $targetDirectory . $imageName;

        // Check if the file is an actual image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $message = "File is not an image.";
        } else {
            // Move the uploaded file
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $sql = "INSERT INTO products (name, info, price, image_path) VALUES ('$name', '$info', '$price', '$imagePath')";
                if ($conn->query($sql) === TRUE) {
                    $message = "✅ Product added successfully!";
                } else {
                    $message = "❌ Error: " . $conn->error;
                }
            } else {
                $message = "❌ Error: Failed to upload image. Check folder permissions.";
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            background: url('/ProjektiG5/ProjektiImages/background.jpg') no-repeat center center/cover;
            color: white;
            text-align: center;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 10px;
            width: 50%;
            max-width: 500px;
            box-shadow: 0 0 15px rgba(255, 102, 0, 0.7);
        }

        h2 {
            color: orange;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            color: orange;
            margin-top: 10px;
        }

        input, textarea {
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
        }

        input[type="file"] {
            background: white;
            padding: 5px;
        }

        button {
            background: orange;
            color: black;
            font-size: 18px;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
            font-weight: bold;
        }

        button:hover {
            background: darkorange;
        }

        .message {
            margin-top: 15px;
            font-weight: bold;
        }

        @media (max-width: 600px) {
            .container {
                width: 80%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add a New Product</h2>

        <?php if (!empty($message)): ?>
            <p class="message"><?= $message; ?></p>
        <?php endif; ?>

        <form action="addProduct.php" method="POST" enctype="multipart/form-data">
            <label>Name:</label>
            <input type="text" name="name" required>

            <label>Info:</label>
            <textarea name="info" required></textarea>

            <label>Price:</label>
            <input type="number" step="0.01" name="price" required>

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" required>

            <button type="submit">Add Product</button>
            <button><a href="/ProjektiG5/Products/products.php">Go Back</a></button>
        </form>
    </div>
</body>
</html>
