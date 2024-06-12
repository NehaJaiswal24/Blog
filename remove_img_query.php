<?php
include('db.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Update the SQL query to set the image column to NULL instead of DELETE (since DELETE is not applicable)
    $sql = "UPDATE `user_login` SET `image` = NULL WHERE `id` = $id";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo " Remove Image";
    } else {
        echo "Error: Could not delete image.";
    }
} else {
    echo "No ID received.";
}
?>
