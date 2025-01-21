<?php
    if (isset($_POST['register'])) {
        session_start();

        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "log";
        $table = "users";

        $email = $_POST['email'];
        $pass = $_POST['password'];

        if (empty($email) || empty($pass)) {
            die("Ju lutem plotësoni të gjitha fushat.");
        }

        try {
            $dsn = "mysql:host=$host;dbname=$dbname";
            $conn = new PDO($dsn, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * FROM $table WHERE email = :email");
            $stmt->execute([":email" => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($pass, $user['password'])) {
                $_SESSION['user'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                echo "Logimi u krye me sukses si " . $user['role'];
            } else {
                echo "Email-i ose fjalëkalimi janë të pasakta.";
            }
        } catch (PDOException $e) {
            echo "Gabim: " . $e->getMessage();
        }
    }

?>
