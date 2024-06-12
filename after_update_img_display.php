<?php
include('db.php'); 
session_start();
$id= $_SESSION['userid']; 

    $sql = "SELECT * FROM `user_login` WHERE `id`='$id' ";
    $data = mysqli_query($conn, $sql) or die("query failed");
    $total = mysqli_num_rows($data);
    // echo $total;

    if($total == 1){
      $user = mysqli_fetch_assoc($data);
      //this seesion variable will store the email of the user who has logged in.

        //this session variable will store the id of the who logged in .
        $_SESSION['id'] = $user['id'];
        $_SESSION['user_images'] = $user['image'];
        $_SESSION['isadmin'] = $user['is_admin'];
  
        echo "success".$_SESSION['user_images'];
        header('location:dashboard.php');
      }
      else{
        echo "password or email is incorrect ";
      }

?>
