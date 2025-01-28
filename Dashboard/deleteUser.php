<?php
session_start();
require_once '../PHP/Database.php';
require_once '../PHP/AdminDashboard.php';

if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] !== 'admin') {
    header("Location: /ProjektiG5/Main/main.php");
    exit;
}

$db = new Database();
$adminDashboard = new AdminDashboard($db->getConnection());

try {
    if (isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        
        if ($adminDashboard->deleteUser($user_id)) {
            header("Location: dashboard.php?message=User deleted successfully!");
        } else {
            header("Location: dashboard.php?message=Failed to delete user. Please try again.");
        }
    } else {
        header("Location: dashboard.php?message=Failed to delete user. Please try again.");
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
