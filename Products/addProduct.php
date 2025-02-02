<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
       
        body {
            background: url('/ProjektiG5/ProjektiImages/scissors.jpg') no-repeat center center/cover;
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

      
        .container {
            width: 100%;
            max-width: 450px;
            background: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(255, 165, 0, 0.6);
            text-align: center;
        }

        h1 {
            color: orange;
            font-size: 26px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            text-align: left;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: bold;
            color: orange;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background: #222;
            color: white;
            font-size: 16px;
            outline: none;
        }

        input::placeholder, textarea::placeholder {
            color: #bbb;
        }

        button {
            background: orange;
            color: black;
            font-size: 16px;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-weight: bold;
        }

        button:hover {
            background: darkorange;
        }

        .back-btn {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: black;
            background: white;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .back-btn:hover {
            background: orange;
            color: black;
        }

        @media (max-width: 500px) {
            .container {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Add Product</h1>

        <?php if (!empty($success)) echo "<p style='color: green; font-weight: bold;'>$success</p>"; ?>
        <?php if (!empty($error)) echo "<p style='color: red; font-weight: bold;'>$error</p>"; ?>

        <form method="POST" action="" enctype="multipart/form-data">
            <label for="name">Product Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter product name" required>

            <label for="info">Product Info:</label>
            <textarea name="info" id="info" rows="4" placeholder="Enter product description" required></textarea>

            <label for="price">Price:</label>
            <input type="number" step="0.01" name="price" id="price" placeholder="Enter price ($)" required>

            <label for="image">Product Image:</label>
            <input type="file" name="image" id="image" accept="image/*" required>

            <button type="submit" name="submit">Add Product</button>
            <a href="/ProjektiG5/Products/products.php" class="back-btn">Back to Products</a>
        </form>
    </div>

</body>
</html>
