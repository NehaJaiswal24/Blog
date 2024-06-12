<?php 
include('db.php');
$id=$_POST['id'];
if(!empty($id)){
    $sql ="SELECT * FROM user_login WHERE id='".$id."'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    // echo $row;
    echo json_encode($row);
}
?>