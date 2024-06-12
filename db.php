<?php 
// session_start();
$servername="localhost";
$username="root";
$password="";
$db="blogsysytem";
$conn=mysqli_connect($servername,$username,$password,$db);
if($conn){
    // echo "connection  perfect";
}
else{
    echo "error";
}
?>