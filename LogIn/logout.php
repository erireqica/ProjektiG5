<?php
    session_start();
    require_once '../PHP/Database.php';
    require_once '../PHP/User.php';

    $user = new User(null);
    $user->logout();

    header("Location: /ProjektiG5/Main/main.php");
    exit;
?>
