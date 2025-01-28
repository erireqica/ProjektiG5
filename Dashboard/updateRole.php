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

if (isset($_POST['user_id']) && isset($_POST['role'])) {
    if ($adminDashboard->updateUserRole($_POST['user_id'], $_POST['role'])) {
        header("Location: dashboard.php?message=Role updated successfully!");
    } else {
        header("Location: dashboard.php?message=Failed to update role. Please try again.");
    }
    exit;
}
?>
