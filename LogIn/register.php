<?php


    if (isset($_POST['register'])) {

        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "log";
        $table = "users";

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $pass = $_POST['password'];

        if (empty($name) || empty($surname) || empty($email) || empty($pass)) {
            die("Please fill in all fields.");
        }

        try {
            $dsn = "mysql:host=$host;dbname=$dbname";
            $conn = new PDO($dsn, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $hashed_password = password_hash($pass, PASSWORD_BCRYPT);

            $stmt = $conn->prepare("INSERT INTO $table (name, surname, email, password, role) VALUES (:name, :surname, :email, :password, :role)");
            $stmt->execute([
                ":name" => $name,
                ":surname" => $surname,
                ":email" => $email,
                ":password" => $hashed_password,
                ":role" => "user"
            ]);

            header("Location: LogIn.php?success");
            exit();
            
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            exit();
        }

        
    } 
?>