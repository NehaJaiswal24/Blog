<?php
include('db.php');
session_start();

// Session variable "expiry" ki availability check karna
if(isset($_SESSION['expiry'])) {
    $expiry = $_SESSION['expiry'];

    // Current time ko retrieve karna
    date_default_timezone_set('Asia/Kolkata'); // Asia/Kolkata server ka timezone hai, aapke server ka timezone ke hisab se set karein
    $currentTime = date('Y-m-d H:i:s');

    if($currentTime > $expiry) {
        header('location:user_login_forgot_password.php');
        exit();
    }
} else {
    echo "Link expired.";
}
echo "cuurent time is ".$currentTime."<br>";
echo "expiry time is".$expiry;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
/* CSS code as provided */
body {
    height: 100vh;
    width: 100%;
    background: #fff !important;
}
h1 {
    display: flex;
    justify-content: center;
}
.container {
    background: #fff;
    width: 410px;
    padding: 10px;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    margin: auto;
    margin-top: 25px;
    border-radius: 5px;
    height: 430px;
}
.container .text {
    font-size: 35px;
    font-weight: 600;
    text-align: center;
}
.container form .data {
    height: 45px;
    width: 98%;
    margin-top: 36px;
}
form .data label {
    font-size: 18px;
}
form .data input {
    height: 100%;
    width: 100%;
    padding-left: 5px;
    font-size: 13px;
    border: 1px solid silver;
}
form .data input:focus {
    border-color: #3498db;
    border-bottom-width: 2px;
}
form .btn {
    margin: 30px 0;
    height: 45px;
    width: 100%;
    position: relative;
    overflow: hidden;
    display:flex;
    justify-content: center;
}
form .btn .inner {
    height: 100%;
    width: 300%;
    position: absolute;
    left: -100%;
    z-index: -1;
    background: #fff;
    transition: all 0.4s;
}
form .btn:hover .inner {
    left: 0;
}
form .btn button {
    height: 100%;
    width: 50%;
    background: #489fb5;
    border: none;
    color: #ffffff;
    font-size: 15px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    border-radius: 20px;
}
.message {
    font-size: 25px;
    font-family: italic;
    margin: 30px;
    color: green;
}
.success {
    color: green;
    font-size: 16px;
    margin: 7px;
}
.error {
    color: red;
    font-size: 12px;
}
div#time {
    display: flex;
    justify-content: center;
    color: green;
    margin-top: 21px;
}
</style>
<body>
    <div class="container">
        <div class="form">
            <form method="POST" action="#" id="myform" onsubmit="validateForm(event)">
                <h1>Password Reset</h1>
                <div class="data">
                    <label>Enter New Password</label>
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="new_password" id="new_password" placeholder="Enter Password">
                    <span id="newpasswordError" class="error"></span><br>
                </div><br>
                <div class="data">
                    <label>Re-Enter New Password:</label>
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="cpassword" id="cpassword" placeholder="Re-Enter Password">
                    <span id="cpasswordError" class="error"></span><br>
                </div><br>
                <?php
                if (isset($_SESSION['message'])) {
                    // Display the session message
                    echo "<div id='time'>{$_SESSION['message']}</div>";
                    // Unset the message so it doesn't persist
                    unset($_SESSION['message']);
                }
                ?>
                <div class="btn">
                    <div class="inner"></div>
                    <button type="submit" name="submit">Update Password</button>
                </div>
                <a href="user_login.php">Back</a>
            </form>
        </div>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        if(isset($_GET['token'])){
            $token = $_GET['token'];
            $new_password = $_POST['new_password'];
            $cpassword = $_POST['cpassword'];
            if ($new_password === $cpassword) {
                $updatequery = "UPDATE `user_login` SET `password` = '$new_password' WHERE `token` = '$token'";
                $query = mysqli_query($conn, $updatequery);
                if ($query) {
                    $_SESSION['message'] = "Password updated successfully.";
                } else {
                    $_SESSION['message'] = "Error updating password.";
                }
            } else {
                $_SESSION['message'] = "Passwords do not match. Please try again.";
            }
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    }
    ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
function validateForm(event) {
    var newpass = $('#new_password').val();
    var cpass = $('#cpassword').val();
    var isValid = true;

    // Reset error messages
    $('#newpasswordError').text('');
    $('#cpasswordError').text('');

    // Validate New Password
    if (newpass.trim() === "") {
        $('#newpasswordError').text('New password is required ');
        isValid = false;
    } else if (newpass.length < 8) {
        $('#newpasswordError').text('New password must be at least 8 characters long');
        isValid = false;
    } else if (!/[A-Z]/.test(newpass)) {
        $('#newpasswordError').text('New password must contain at least one uppercase letter');
        isValid = false;
    } else if (!/[a-z]/.test(newpass)) {
        $('#newpasswordError').text('New password must contain at least one lowercase letter');
        isValid = false;
    } else if (!/[~!@#$%^&*().,;{}()/]/.test(newpass)) {
        $('#newpasswordError').text('New password must contain at least one special character');
        isValid = false;
    } else if (!/[0-9]/.test(newpass)) {
        $('#newpasswordError').text('New password must contain at least one number');
        isValid = false;
    }

    // Validate Re-entered Password
    if (cpass === "") {
        $('#cpasswordError').text('Confirm password is required');
        isValid = false;
    } else if (cpass !== newpass) {
        $('#cpasswordError').text('Passwords do not match');
        isValid = false;
    }

    if (isValid) {
        document.getElementById("myform").submit();
    }

    event.preventDefault();
}
</script>
</html>
