<?php
session_start();
$username = $_SESSION['logged'];
session_destroy(); 
header('Location: ../index.php');
?>

