<?php
include('db.php');

// Check if all required POST variables are set
if (isset($_POST['id']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['no']) && isset($_POST['email']) && isset($_POST['psw'])) {
    // Sanitize input values
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $no = mysqli_real_escape_string($conn, $_POST['no']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    // $psw = mysqli_real_escape_string($conn, $_POST['psw']);

    $hash = mysqli_real_escape_string($conn, $_POST['psw']);
    $psw = password_hash($hash, PASSWORD_DEFAULT); 
    
    
    // Check if an image file is uploaded
    if (!empty($_FILES['uploadedImage']['name'])) {
        // Handle file upload
        $targetDir = "upload_image/";
        $filename = basename($_FILES["uploadedImage"]["name"]);
        $targetFile = $targetDir . $filename;
        $tmpName = $_FILES["uploadedImage"]["tmp_name"];

        // Move uploaded file to the target directory
        if (move_uploaded_file($tmpName, $targetFile)) {
            $imagePath = $targetFile;
        } else {
            echo "Error uploading file.";
            exit; // Stop execution if there's an error
        }
    } else {
        // No new image uploaded, retrieve the existing image path
        $query = "SELECT `image` FROM `user_login` WHERE `id` = '$id'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $imagePath = $row['image'];
        } else {
            echo "Error retrieving existing image path.";
            exit; // Stop execution if there's an error
        }
    }

    // Create the SQL query
    $query = "UPDATE `user_login` SET `fname` = '$fname', `lname` = '$lname', `contact` = '$no', `email` = '$email', `password` = '$psw', `image` = '$imagePath' WHERE `id` = '$id'";

    // Execute the query and check for errors
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "All fields are required.";
}



// include('db.php');

// if (isset($_POST['id']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['no']) && isset($_POST['email']) && isset($_POST['psw']) && isset($_POST['image']) ) {
//     $id = $_POST['id'];
//     $fname = $_POST['fname'];
//     $lname = $_POST['lname'];
//     $no = $_POST['no'];
//     $email = $_POST['email'];
//     $psw = $_POST['psw'];

//     // $targetDir = "upload_image/";
//     // $filename=basename($_FILES["uploadedImage"]["name"]);
//     // $targetFile = $targetDir . $filename;
//     // $tmpname=$_FILES["uploadedImage"]["tmp_name"];
//     // move_uploaded_file($tmpname, $targetFile);
//     // $imagePath = $targetFile;
    
   
//     $query = "UPDATE `user_login` SET `fname`='$fname', `lname`='$lname', `contact`='$no', `email`='$email', `password`='$psw' WHERE id='$id'";
//     $result = mysqli_query($conn, $query);
    
//     if ($result) {
//         echo "Record updated successfully.";
//     } else {
//         echo "Error updating record: " . mysqli_error($conn);
//     }
// } else {
//     echo "All fields are required.";
// }
?>
