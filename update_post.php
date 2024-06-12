<?php
include("db.php");
$title = mysqli_real_escape_string($conn, $_POST['title']);
$content = mysqli_real_escape_string($conn, $_POST['content']);
$date = mysqli_real_escape_string($conn, $_POST['date']);


session_start();

// Check if the session key 'is_admin' is set
if (isset($_SESSION['is_admin'])) {
    $admin = $_SESSION['is_admin'];
} else {
    // Handle the case when the key is not set
    $admin = false; 
}


// Check if the session user ID is set
if(isset($_SESSION['id'])) {
    // Store the session user ID in a variable
    $sessionUserID = $_SESSION['id'];
    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : '';
    if (!empty($post_id)) {
        // Construct the SQL query to fetch the user ID associated with the post
        $post_id = mysqli_real_escape_string($conn, $_POST['post_id']);
        $sql = "SELECT user_id FROM blog WHERE post_id = '" .$post_id. "'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // Fetch the row from the result set
            $row = mysqli_fetch_assoc($result);
            
            // Retrieve the user ID associated with the post
            $postUserID = $row['user_id'];
            if ($sessionUserID == $postUserID || $admin=="1") {
                $updatesql = "UPDATE `blog` SET `title`='$title', `content`='$content', `date`='$date' WHERE `post_id`='$post_id'";
                $updatequery = mysqli_query($conn, $updatesql);

                //update was successful
                if ($updatequery) {
                    echo "post update";
                }
                else{
                    echo "ERROR: " . mysqli_error($conn);
                  }
                
                
            } else {
                // Session user is not authorized to delete this post
                echo "You are not authorized to update this post.";
            }
        } 
        // else {
        //     echo "Post not found";
        // }
    } else {
        echo "Post ID is empty";
    }
} else {
    echo "Session user ID not set";
}





// Retrieve form data from POST request
// $title = isset($_POST['title']) ? $_POST['title'] : '';
// $content = isset($_POST['content']) ? $_POST['content'] : '';
// $date = isset($_POST['date']) ? $_POST['date'] : '';


// // Assuming 'post_id' is also part of the form data sent via AJAX
// $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : '';

// // Construct the SQL UPDATE query
// $query = "UPDATE `blog` SET `title`='$title', `content`='$content', `date`='$date' WHERE `post_id`='$post_id'";

// // Execute the SQL query
// $result = mysqli_query($conn, $query);

// if ($result) {
//     echo "Record updated successfully.";
// } else {
//     echo "Error updating record: " . mysqli_error($conn);
// }
?>
