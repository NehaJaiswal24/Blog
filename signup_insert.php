<?php  
include('db.php');
session_start();

// Retrieve POST data
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$no = $_POST['no'];
$email = $_POST['email'];
$hash = $_POST['psw'];
$psw = password_hash($hash, PASSWORD_DEFAULT); 


if(isset($_FILES['image'])){
    $filename=$_FILES['image']['name'];
    $file_tmp=$_FILES['image']['tmp_name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    // echo $ext;die;--jpg
    $valid_extensions = array('jpeg', 'jpg', 'png');
    if(in_array($ext,$valid_extensions)){
         $new_name=uniqid($ext).'.'.$ext; // Generating a unique name for the image file
        //  echo $new_name;die;
         $imagepath="upload_image/".$new_name; // Adjust the path according to your directory structure
        // die;
        move_uploaded_file($file_tmp,$imagepath);
    }
}



if (isset($fname) && isset($lname) && isset($no) && isset($email)  && isset($imagepath) && isset($psw)) {
    // duplicate entries in the database
    $checkQuery = "SELECT * FROM `user_login` WHERE `email` = ? OR `contact` = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($checkQuery);
    
    // Bind parameters to the statement
    $stmt->bind_param("ss", $email, $no);
    
    // Execute the statement
    $stmt->execute();
    
    // Store the result
    $stmt->store_result();
    
    // Check if there are any existing records with the same email or contact
    if ($stmt->num_rows > 0) {
        // Duplicate data found, output an error message
        echo  "Data already exists.";
        // $_SESSION['message'] = $message;
    } else {
        // Prepare SQL query to insert data into the `user_login` table
        $insertQuery = "INSERT INTO `user_login` (`fname`, `lname`, `contact`, `email`, `password`,`image`) VALUES (?, ?, ?, ?, ?,?)";
        
        // Prepare the statement
        $insertStmt = $conn->prepare($insertQuery);
        
        // Bind parameters to the statement
        // $insertStmt->bind_param("sssss", $fname, $lname, $no, $email, $psw,$imagepath);
        $insertStmt->bind_param("ssssss", $fname, $lname, $no, $email, $psw, $imagepath);

        
        // Execute the insertion
        $result = $insertStmt->execute();
        
        // Check the result of the insertion
        if ($result) {
            echo "Data insert success";
            // $successmsg= "Data insert success";
            // echo json_encode($successmsg);
        }
        //  else {
        //     echo "Error inserting data.";
        // }
        
        // Close the insert statement
        $insertStmt->close();
    }
    
    // Close the check statement
    $stmt->close();
} else {
    echo "Error: Missing required fields.";
}

// Close the connection
$conn->close();
?>

<?php
// include('db.php'); 
// $id=$_POST['id'];
// $fname=$_POST['fname'];
// $lname=$_POST['lname'];
// $no=$_POST['no'];
// $email=$_POST['email'];
// $psw=$_POST['psw'];


//     $sql="INSERT INTO `user_login` (`fname`,`lname`,`contact`,`email`,`password`) VALUES ('$fname','$lname','$no','$email','$psw')";
//     $result=mysqli_query($conn,$sql);
//     if($result){
//         echo "data inser success";
//     }
    
?>