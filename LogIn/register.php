<?php
    require_once '../PHP/Database.php';
    require_once '../PHP/User.php';

    $db = new Database();
    $user = new User($db->getConnection());

    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $pass = $_POST['password'];

        if (empty($name) || empty($surname) || empty($email) || empty($pass)) {
            header("Location: LogIn.php?register_error=" . urlencode("Please fill in all fields."));
            exit();
        }

        if ($user->register($name, $surname, $email, $pass)) {
            header("Location: LogIn.php?success=1");
            exit();
        } else {
            header("Location: LogIn.php?register_error=" . urlencode("Database error: Registration failed."));
            exit();
        }
    }
?>
