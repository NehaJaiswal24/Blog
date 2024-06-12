<?php 
include('db.php');
session_start();


$email =$_POST['email'];
$password=$_POST['password'];
$sql="SELECT * FROM `user_login` WHERE `email`='$email' AND `password`='$password' AND `is_admin`='1'";
$result=mysqli_query($conn,$sql);
$total = mysqli_num_rows($result);
// echo $total";
if($total==1){
    $userr=mysqli_fetch_assoc($result);
    $_SESSION['email']=$userr['email'];
    $_SESSION['id']=$userr['id'];
    $_SESSION['is_admin']=$userr['is_admin'];
    $_SESSION['images'] = $userr['image'];
    // echo $_SESSION['is_admin'];

    // $_SESSION['emailname'] = $email;
    echo "success";
    // echo "success".$_SESSION['image'];
}else{
    echo "admin email id and password is wrong";   
}
 

?>