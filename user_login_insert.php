<?php
include('db.php'); 
session_start();

$email = $_POST['email'];
$password = $_POST['password'];


if(isset($_POST['email']) && isset($_POST['password'])){
    $sql = "SELECT * FROM `user_login` WHERE `email`='$email' AND `password`='$password'";
    $data = mysqli_query($conn, $sql) or die("query failed");
    $total = mysqli_num_rows($data);
    // echo $total;

    if($total == 1){
      $user = mysqli_fetch_assoc($data);
      //this seesion variable will store the email of the user who has logged in.
        $_SESSION['username'] = $email;

        //this session variable will store the id of the who logged in .
        $_SESSION['id'] = $user['id'];
        $_SESSION['user_image'] = $user['image'];
        $_SESSION['isadmin'] = $user['is_admin'];
  
        echo "success";
      }
      else{
        echo "password or email is incorrect ";
      }
}
else{
    echo 'Please enter email or password';
}



?>
