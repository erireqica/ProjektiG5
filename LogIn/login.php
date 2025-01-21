<?php
if (isset($_POST['login'])) {
    session_start();
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "log";
    $table = "users";

    $email = $_POST['email'];
    $pass = $_POST['password'];

    if (empty($email) || empty($pass)) {
        die("Please fill in all fields.");
    }

    try {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM $table WHERE email = :email");
        $stmt->execute([":email" => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($pass, $user['password'])) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['user'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: dashboard.php");
            } else {
                header("Location: /ProjektiG5A/ProjektiG5/Main/main.html");
            }
            exit;
        } else {
            echo "Incorrect email or password.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
