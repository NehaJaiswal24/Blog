<?php 
include('db.php');
session_start();
session_destroy();
session_unset();
header('location:user_login.php');
?>