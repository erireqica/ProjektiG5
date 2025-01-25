<?php
session_start();
session_unset();
session_destroy();
header("Location: /ProjektiG5/Main/main.php");
exit;
?>