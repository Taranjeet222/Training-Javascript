<?php 
session_start();
include '../includes/user.php';
$lgout = new User();
$lgout->logout();
header('Location: ../index.php');
?>