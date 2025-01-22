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

        if (isset($_POST['user_id'])) {
            $user_id = $_POST['user_id'];

            $stmt = $conn->prepare("DELETE FROM $table WHERE id = :id");
            $stmt->bindParam(':id', $user_id);
            $stmt->execute();

            header("Location: dashboard.php?message=User deleted successfully!");
            exit;
        } else {
            header("Location: dashboard.php?message=Failed to delete user. Please try again.");
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>