<?php
include('db.php');
session_start();
// Redirect the user to user-login.php
if(isset($_SESSION['id'])){
    header('location: dashboard.php');
}else{
    header("Location: user_login.php");
}
?>
