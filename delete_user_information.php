<?php
include("db.php");

// Check if the POST request contains 'id'
if (isset($_POST['id'])) {
    $id = $_POST['id']; // Retrieve the 'id' from POST data
    
    // Log the received id (for debugging purposes)
    error_log("Received ID: " . $id);

    // Check if the id is not empty
    if (!empty($id)) {
        // Prepare the SQL DELETE query
        $sql = "DELETE FROM user_login WHERE id = '" . mysqli_real_escape_string($conn, $id) . "'";

        // Execute the query
        $query = mysqli_query($conn, $sql);
        
        // Check if the query was successful
        if ($query) {
            echo "data deleted";
        } else {
            echo "ERROR";
        }
    } else {
        echo "ID is empty";
    }
} else {
    echo "ID not provided";
}
?>
