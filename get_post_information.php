<?php 
include('db.php');
//     $sql ="SELECT * FROM blog";
//     $fetch=mysqli_query($conn,$sql);
//     if(mysqli_num_rows($fetch)>0){
//         $data=array(); //array me data dal diya araay ko data variable me dal diya 
//     while($row=mysqli_fetch_assoc($fetch)){
//        $data[] = $row;
//   }
// }
// echo json_encode($data); die;

$id = isset($_POST['id']) ? $_POST['id'] : null;
if (!empty($id)) {
    $sql ="SELECT * FROM blog WHERE post_id='".$id."'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    // echo $row;
    echo json_encode($row);
}

?>