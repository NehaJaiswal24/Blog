<?php
// view_more.php-ajax for delete post
include("db.php");

session_start();
// Check if the 'is_admin' key exists in the $_SESSION array
if (isset($_SESSION['is_admin'])) {
    $admin = $_SESSION['is_admin'];
} else {
    // Handle the case where 'is_admin' key is not set in $_SESSION
    // For example, you can set a default value
    $admin = false; // Assuming a non-admin user as default
}


// Check  session user ID is set
if(isset($_SESSION['id'])) {
    // Store the session user ID in a variable
    $sessionUserID = $_SESSION['id'];
    // echo $sessionUserID;

    $postID = isset($_POST['id']) ? $_POST['id'] : null;
    // echo "hii".$postID;

    // Check if the post ID is not empty
    if (!empty($postID)) {
        // Construct the SQL query to fetch the user ID associated with the post
        $sql = "SELECT user_id FROM blog WHERE post_id = '" . mysqli_real_escape_string($conn, $postID) . "'";

        // Execute the SQL query
        $result = mysqli_query($conn, $sql);
        // print_r($result);

        // Check if the query was successful and if a row was returned
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the row from the result set
            $row = mysqli_fetch_assoc($result);
            // print_r($row);
            
            // Retrieve the user ID associated with the post
            $postUserID = $row['user_id'];
            // echo $postUserID;

            // Check if the session user ID matches the user ID associated with the post
            if ($sessionUserID == $postUserID || $admin=="1") {
                // User is authorized to delete the post
                // SQL query to delete the record with the specified post ID
                $deleteSQL = "DELETE FROM blog WHERE post_id='" . mysqli_real_escape_string($conn, $postID) . "'";

                // Execute the SQL query to delete the post
                $deleteQuery = mysqli_query($conn, $deleteSQL);

                // Check if the deletion was successful
                if ($deleteQuery) {
                    echo "Data deleted";
                } else {
                    echo "ERROR: " . mysqli_error($conn); // Output any SQL errors for debugging
                }
            } else {
                echo "You are not authorized to delete this post.";
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



// session_start();
// $_SESSION['userr_id'] = $_SESSION['id'];
// print_r($_SESSION['id']);
// // print_r($_SESSION);


// $id = isset($_POST['id']) ? $_POST['id'] : null;

// // Check if 'id' is not empty
// if (!empty($id)) {
//     // Construct the SQL query to delete the record with the specified 'id'
//     $sql = "DELETE FROM blog WHERE post_id='" . mysqli_real_escape_string($conn, $id) . "'";

//     // Execute the SQL query
//     $query = mysqli_query($conn, $sql);

//     // Check if the query was successful
//     if ($query) {
//         echo "Data deleted";
//     } else {
//         echo "ERROR: " . mysqli_error($conn); // Output any SQL errors for debugging
//     }
// } else {
//     echo "ID is empty";
// }
?>
