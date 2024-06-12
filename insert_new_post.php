<?php  
include('db.php'); 
// $post_id=$_POST['post_id'];
$user_id=$_POST['user_id'];

if(isset($_FILES['post_image'])){
    $filename=$_FILES['post_image']['name'];
    $file_tmp=$_FILES['post_image']['tmp_name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    // echo $ext;die;--jpg
    $valid_extensions = array('jpeg', 'jpg', 'png');
    if(in_array($ext,$valid_extensions)){
         $new_name=uniqid($ext).'.'.$ext; // Generating a unique name for the image file
        //  echo $new_name;die;
         $imagepath="upload_post_image/".$new_name; // Adjust the path according to your directory structure
        // die;
        move_uploaded_file($file_tmp,$imagepath);
    }
}

$title=$_POST['title'];
$content=$_POST['content'];
$date=$_POST['date'];


$stmt = $conn->prepare("INSERT INTO `blog` (`user_id`, `title`, `content`, `date`,`post_image`) VALUES (?, ?, ?, ?,?)");
$stmt->bind_param("sssss", $user_id, $title, $content, $date, $imagepath);

if ($stmt->execute()) {
    echo "Data insert success";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();


 
// $sql="INSERT INTO `blog` (`user_id`,`title`,`content`,`date`) VALUES ('$user_id','$title','$content','$date')";
// $result=mysqli_query($conn,$sql);
// if($result){
//     echo "data inser success";
// }else{
//     echo "error";
// }

// $title=$_POST['title'];
// $content=$_POST['content'];
// $date=$_POST['date'];
// $user_id=$_POST['user_id'];
 
// $sql="INSERT INTO `blog` (`user_id`,`title`,`content`,`date`) VALUES ('$user_id','$title','$content','$date')";
// $result=mysqli_query($conn,$sql);
// if($result){
//     echo "data inser success";
// }else{
//     echo "error";
// }
?>