<?php
if (array_key_exists('delete_file', $_POST)) {
  $filename = $_POST['delete_file'];
  if (file_exists($filename)) {
    unlink($filename);
    echo 'File '.$filename.' has been deleted';
  } else {
    echo 'Could not delete '.$filename.', file does not exist';
  }
}
?>
<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Registration  </title>
    <link rel="stylesheet" href="signup_style.css?v=2.6">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <style>
    .error{
      color: red;
      font-size: 14px;
    }
    .message {
            color: red;
        }
    
    </style>
<body>



  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form id="myform">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" placeholder="Enter your fname" id="fname" name="fname" >
            <span id="fnameError" class="error"></span><br>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" placeholder="Enter your username" id="lname" name="lname" >
            <span id="lnameError" class="error"></span><br>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your number" id="no" name="no" >
            <span id="noError" class="error"></span><br>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" placeholder="Enter your email" id="email" name="email" >
            <span id="emailError" class="error"></span><br>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="text" placeholder="Enter your password" id="psw" name="psw" >
            <span id="passwordError" class="error"></span><br>
          </div>
          <!-- <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="text" placeholder="Confirm your password" id="conpws" name="conpws" >
            <span id="conpasswordError" class="error"></span><br>
          </div> -->
          <div class="input-box">
            <span class="details">Profile</span>
            <input type="hidden" value="'.$file.'" name="delete_file" />
            <input type="file" id="image" name="image" style="height:35px" ><br>
            <span id="imageError" class="error"></span><br>
          </div>
          
        </div>
        <div class="button">
          <input type="submit" value="Register">
        </div>
        <div id="insertmsg"></div>
        <!-- <div id="message"></div> -->
        
        <!-- <div id="duplicateError"></div> -->
      </form>
      <a href="user_login.php">Back</a>
    </div>
  </div>

</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // console.log("clickd");
    $('#myform').submit(function(e){
        e.preventDefault();
        if(validateform()){
            let formData = new FormData(this);
            $.ajax({
                url: "signup_insert.php",
                method: "POST",
                data: formData,
                processData: false, 
                contentType: false,  
                success: function(data){
                    if(data){
                        // console.log(data);
                        $('#insertmsg').text(data).css('color', 'blue'); // Set message color to blue
                    }else{
                        $('#insertmsg').text(data).css('color', 'red'); // Set message color to red
                        // console.log(data);
                    }
                    $('#myform')[0].reset();
                    setTimeout(function(){
                       $('#insertmsg').text('');// Clear the error message
                     },2000);
                    //alert('submit form successfully');
                    // window.location.href="user_login.php";
                }
            });
        }
    });
});


function validateform(){
  var fname = $('#fname').val();
  var lname = $('#lname').val();
  var no = $('#no').val();
  var email = $('#email').val();
  var psw = $('#psw').val();
  // var conpws = $('#conpws').val();
  var image = $("#image").val();
  var isValid=true;

    if(fname===""){
      $('#fnameError').text('First name is required');
      isValid =false;
      }else {
        $("#fnameError").text("");
    }

    if (lname === ""){
      $("#lnameError").text("Last Name is required");
      isValid = false;
      } else {
        $("#lnameError").text("");
    }

    if (no === "") {
    $("#noError").text("Mobile number is required");
    isValid = false;
    } else if (!/^[6-9]\d{9}$/.test(no)) {
        $("#noError").text("Invalid mobile number format");
        isValid = false;
    } else if (no.length < 10) {
        $("#noError").text("Mobile number should be 10 digits");
        isValid = false;
    } else if (no.length > 10) {
        $("#noError").text("Mobile number should not exceed 10 digits");
        isValid = false;
    } else {
        $("#noError").text("");
    }




    //Email validation
    if (email == "") {
      $("#emailError").text("Email is required");
      // isValid = false;
    } else if(!/\S+@\S+\.\S+/.test(email)) {
      $("#emailError").text("Invalid email format");
      isValid = false;
    } else {
      $("#emailError").text("");
    }

    // if (psw ==="") {
    //   $("#passwordError").text("Password is required");
    // } else if (!/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{8,16}$/.test(psw)) {
    //   $("#passwordError").text("Password must be 8 characters; password contain at least one uppercase, lowercase and numbers and special characters.");
      
    //   isValid = false;
    // } else {
    //   $("#passwordError").text("");
    // }

    if (psw === "") {
      $("#passwordError").text("Password is required");
      isValid = false;
         } else if (psw.length < 8) {
         $("#passwordError").text("Password must be at least 8 characters.");
         isValid = false;
         } else if (!/[a-z]/.test(psw)) {
         $("#passwordError").text("Password must contain at least one lowercase character.");
         isValid = false;
         } else if (!/[A-Z]/.test(psw)) {
         $("#passwordError").text("Password must contain at least one uppercase character.");
         isValid = false;
         } else if (!/[0-9]/.test(psw)) {
         $("#passwordError").text("Password must contain at least one number.");
         isValid = false;
         } else if (!/[!@#$%^&*(),.?":{}|<>]/.test(psw)) {
            $("#passwordError").text("Password must contain at least one special character.");
            isValid = false;
         }
         else {
            $("#passwordError").text("");
        }
    
    // if (conpws === "") {
    //   $("#conpasswordError").text("please confirm Password is required");
    //   isValid = false;
    // }else if(psw!=conpws){
    //   $("#conpasswordError").text("password and confirm Password must be same"); 
    // }
    // else {
    //   $("#conpasswordError").text("");
    // }
    
    if (image === "") {
        $("#imageError").text("Image is required");
        isValid = false;
         } else {
        var fileExtension = image.split('.').pop().toLowerCase(); //image: This variable holds the value of the file path or file name that has been selected in the file input field./ split('.')-"example.jpg"->["example", "jpg"]./pop():This function is used to remove and return the last element .return karega jpg./toLowerCase(): ->JPG", .toLowerCase() will convert it to "jpg".
        // consile.log(fileExtension);
        if (fileExtension !== "jpg" && fileExtension !== "jpeg" && fileExtension !== "png") {
            $("#imageError").text("Only JPG, JPEG, and PNG files are allowed");
            isValid = false;
        } else {
            $("#imageError").text("");
        }
      }



  return isValid;
}
</script>




