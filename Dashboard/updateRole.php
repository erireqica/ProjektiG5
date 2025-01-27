<?php
session_start();

class UserManager {
    private $conn;
    private $table;

    public function __construct($host, $username, $password, $dbname, $table) {
        $this->table = $table;
        try {
            $dsn = "mysql:host=$host;dbname=$dbname";
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    }

    public function verifyAccess() {
        if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'admin') {
            header("Location: /ProjektiG5/Main/main.php");
            exit;
        }
    }

    public function updateUserRole($userId, $newRole) {
        try {
            $stmt = $this->conn->prepare("UPDATE {$this->table} SET role = :role WHERE id = :id");
            $stmt->bindParam(':role', $newRole);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
            header("Location: dashboard.php?message=Role updated successfully!");
            exit;
        } catch (PDOException $e) {
            header("Location: dashboard.php?message=Failed to update role. Please try again.");
            exit;
        }
    }
}

$host = "localhost";
$username = "root";
$password = "";
$dbname = "log";
$table = "users";

$userManager = new UserManager($host, $username, $password, $dbname, $table);
$userManager->verifyAccess();

if (isset($_POST['user_id']) && isset($_POST['role'])) {
    $userId = $_POST['user_id'];
    $newRole = $_POST['role'];
    $userManager->updateUserRole($userId, $newRole);
} else {
    header("Location: dashboard.php?message=Failed to update role. Please try again.");
    exit;
}
?>