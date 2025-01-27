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

    public function deleteUser($userId) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = :id");
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
            header("Location: dashboard.php?message=User deleted successfully!");
            exit;
        } catch (PDOException $e) {
            header("Location: dashboard.php?message=Failed to delete user. Please try again.");
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

if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $userManager->deleteUser($userId);
} else {
    header("Location: dashboard.php?message=Failed to delete user. Please try again.");
    exit;
}
?>
