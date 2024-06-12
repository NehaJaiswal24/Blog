<?php
session_start();
include('db.php');

// Check if post_id is provided in the query 
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    
    // Query the database for the specified post_id
    $sql = "SELECT `title`, `content`, `date` ,`user_id` FROM `blog` WHERE `post_id` = '$post_id'";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the data from the query result
        $row = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $row['user_id'];
        // echo $_SESSION['user_id'];
        // Return the data in JSON format
        echo json_encode($row);
    } else {
        // No data found for the given post_id
        echo json_encode(['error' => 'No data found for the given post_id']);
    }
} else {
   
    echo json_encode('No post_id provided');
}



// $post_id=$_GET['post_id'];

// $sql ="SELECT `title`,`content`,`date` FROM `blog` WHERE `post_id`='".$post_id."'";
// $result=mysqli_query($conn,$sql);
// $row=mysqli_fetch_assoc($result);
// echo json_encode($row);
?>


