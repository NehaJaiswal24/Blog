<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title> Login </title>
      <link rel="stylesheet" href="user_login_style.css?v=4.4">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="user_login_style.css">
   </head>
   <style>
      .error{
          color: red;
          font-size:14px;
         }
         div#error {
            margin: 18px;
            font-size: 16px;
            color: red;
            /* align-items: center; */
            display: flex;
            justify-content: center;
         }
         .email_pass_input {
            margin-top: 10px;
         }
         /* .email_pass_input {
            margin-top: 20px;
         } */
         .email_pass_input1 {
         margin-top: 20px;
         }
         div#forgot-pass {
            padding: 10px;
            margin-top: 20px;
         }
         .data {
         position: relative;
         display: inline-block;
         }

         input[type="password"] {
          /* Space for the eye icon */
         }

         #togglePassword {
            position: absolute;
            right: 10px;
            top: 100%;
            transform: translateY(-50%);
            cursor: pointer;
         }

         
         
   </style>
   <body>
         <div class="container ">
            <div class="form">
            <form id="myform">
             <div id="header_input_title">
            <h1>Login</h1>
      </div>
            <div class="textt_profile_login">
               <div class="email_pass_input">
               <div class="data">
                  <label>Email</label>
                  <i class="fa-solid fa-envelope"></i>
                  <input type="text" name="email" id="email" placeholder="Enter User Email" >
                  <span id="emailError" class="error"></span><br>
               </div>
             </div>
      <div class="email_pass_input1">
               <div class="data">
                  <label>Password</label>
                  <i class="fa-solid fa-lock"></i>
                  <input type="password" name="password" id="password" placeholder="Enter User Password">
                  <i class="fa-regular fa-eye" id="togglePassword"></i>
                  <span id="passwordError" class="error"></span>
               </div>
           </div>
      </div>
               <script>
                  document.getElementById('togglePassword').addEventListener('click', function () {
                     const passwordField = document.getElementById('password');
                     const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                     passwordField.setAttribute('type', type);
                     
                     // Toggle the eye slash icon
                     this.classList.toggle('fa-eye-slash');
                  });
               </script>

               <div class="forgot-pass" id="forgot-pass">
                  <a href="user_login_forgot_password.php">Forgot Password?</a>
               </div>
               <div class="btn">
                  <div class="inner"></div>
                  <button type="submit">login</button>
               </div>
               
               <!-- show message when email and password wrong: login failed -->
               <div id="error"></div>
               
               <div class="signup-link">
                  Not a member? <a href="signup.php">Registration now</a>
               </div>
               <div class="signup-link">
               If you are admin <a href="admin_login.php"> login here</a>
               </div>
            </form>
         </div>
      </div>
   </body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
    $('#myform').submit(function(e) {
        e.preventDefault();
        if(validateform()){
        let formdata = new FormData(this);

        $.ajax({
            url: "user_login_insert.php",
            method: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            success: function(response) {
               // console.log(response);
					// Swal.fire(  'Thank You!',  'We will get in touch with you shortly!',  'success');
               // window.location.href = "dashboard.php";
                if (response=="success") { 
                  window.location.href = "dashboard.php";
                } else{
                  // alert('Login failed. Please try again.');
                  $('#error').text('Login failed. Please try again.');
               }
               $("#myform")[0].reset();

               setTimeout(function(){
                  $('#error').text('');// Clear the error message
               },2000);
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
                alert("An error occurred. Please try again later.");
            }
        });
     }
   });
});

function validateform(){
   var email = $('#email').val();
   var password = $('#password').val();
   var isValid=true;
    
   if (email == "") {
      $("#emailError").text("Email is required");
      isValid = false;
    } else if(!/\S+@\S+\.\S+/.test(email)) {
      $("#emailError").text("Invalid email format.");
      isValid = false;
    } else {
      $("#emailError").text("");
    }

    if (password === "") {
      $("#passwordError").text("Password is required");
      isValid = false;
     } else if (password.length < 8) {
      $("#passwordError").text("Password must be at least 8 characters.");
      isValid = false;
     } else if (!/[a-z]/.test(password)) {
      $("#passwordError").text("Password must contain at least one lowercase character.");
      isValid = false;
     } else if (!/[A-Z]/.test(password)) {
      $("#passwordError").text("Password must contain at least one uppercase character.");
      isValid = false;
     } else if (!/[0-9]/.test(password)) {
      $("#passwordError").text("Password must contain at least one number.");
      isValid = false;
     } else if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
      $("#passwordError").text("Password must contain at least one special character.");
      isValid = false;
    }
      else {
         $("#passwordError").text("");
   }


   return isValid;
}


</script>
