<?php
    session_start();

    if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'admin') {
        header("Location: /ProjektiG5/Main/main.php");
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

        if (isset($_POST['user_id']) && isset($_POST['role'])) {
            $user_id = $_POST['user_id'];
            $new_role = $_POST['role'];

            $stmt = $conn->prepare("UPDATE $table SET role = :role WHERE id = :id");
            $stmt->bindParam(':role', $new_role);
            $stmt->bindParam(':id', $user_id);
            $stmt->execute();

            header("Location: dashboard.php?message=Role updated successfully!");
            exit;
        } else {
            header("Location: dashboard.php?message=Failed to update role. Please try again.");
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>
