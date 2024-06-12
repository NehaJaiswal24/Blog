<?php

session_start();
include('db.php');

// Include PHPMailer
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Define secure SMTP credentials (make sure to replace placeholders)
$smtpUsername = 'your-email@gmail.com';
$smtpPassword = 'your-email-password';

// Define the `generateToken` function
function generateToken() {
    return bin2hex(random_bytes(32));
}

// Define the `sendEmail` function
function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // PHPMailer configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nj954385@gmail.com';
        $mail->Password = 'hqcy fxru juai gfpa';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        // Set email details
        $mail->setFrom('nj954385@gmail.com', 'Neha jaiswal');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $body;
        
        // Send the email
        $mail->send();
        return true;
    } catch (Exception $e) {
        // Handle exceptions by printing error message
        echo 'Failed to send email: ' . $mail->ErrorInfo;
        return false;
    }
}

// Define the `logMessage` function for logging purposes
function logMessage($message) {
    error_log($message);
}

/// Make sure to include the necessary headers to allow AJAX to interpret JSON responses
header('Content-Type: application/json');

if (isset($_POST['requestReset'])) {
    $email = $_POST['email'];

    // Validate the email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
        exit;
    }

    // Query the database to find the user
    $query = $conn->prepare("SELECT id FROM user_login WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        // User found, generate token and expiry date
        $token = generateToken();
       
        date_default_timezone_set('Asia/Kolkata'); // Replace 'Asia/Kolkata' with your local time zone
        // Generate expiry time 1 hour from the current time
        $expiry = date('Y-m-d H:i:s', strtotime('+10 minutes'));
        
        // Store expiry time in the session
        $_SESSION['expiry'] = $expiry;
        // $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        // $_SESSION['expiry'] = $expiry;
        // echo $_SESSION['expiry'];

        // Store token and expiry date in the database
        $updateQuery = $conn->prepare("UPDATE user_login SET token = ?, token_expiry = ? WHERE email = ?");
        $updateQuery->bind_param("sss", $token, $expiry, $email);
        $updateQuery->execute();

        if ($updateQuery->affected_rows > 0) {
            // Prepare the password reset link
            $resetLink = "http://localhost/blogsystem/user_password_reset.php?token=$token";

            // Email subject and body
            $subject = "Password Reset Request";
            $body = "Hi,\n\nYou requested to reset your password. Please click the link below to reset your password:\n$resetLink\n\nThank you.";

            // Send the email
            if (sendEmail($email, $subject, $body)) {
                echo json_encode(['success' => true, 'message' => 'password reset link is sent.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to send email.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to store token and expiry date in the database.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Email not found.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}



?>