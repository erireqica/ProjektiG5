<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'admin') {
    header("Location: /ProvaG5/Main/main.php");
    exit;
}

$host = "localhost";
$username = "root";
$password = "";
$dbname = "log";

if (isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];

    try {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM tbl3 WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $comment_id]);

        header("Location: dashboard.php?message=Comment deleted successfully");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
