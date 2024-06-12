<?php 
include('db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=2.1">
   <title>Document</title>
   <link rel="stylesheet" href="admin_login_style.css?v=2.3">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
   body{
      background-color: #fff;
   }
   .error {
      color: red;
      font-size: 12px;

   }

   div#error-msg {
    color: red;
    font-size: 18px;
    font-family: math;
    display: flex;
    justify-content: center;
}

   .data {
      position: relative;
      display: inline-block;
   }

   input[type="password"] {
      padding-right: 20px;
      /* Space for the eye icon */
   }

   #togglePassword {
      position: absolute;
      right: 2px;
      top: 100%;
      transform: translateY(-30%);
      cursor: pointer;
   }
</style>

<body>
   <div class="container ">
      <div class="form">
         <form id="adminform">
            <div class="logo">
               <img src="https://th.bing.com/th/id/OIP.F_oo-HIe743EBbgzBYyJ7gHaGN?w=223&h=186&c=7&r=0&o=5&pid=1.7" alt="">
            </div>
            <h1>Admin login</h1>
            <div class="data">
               <label>Email</label> <i class="fa-solid fa-envelope"></i>
             
               <input type="text" name="email" id="email" placeholder="Admin email">
               <span id="emailError" class="error"></span><br>
            </div>
            <div class="data">
               <label>Password</label>
               <i class="fa-solid fa-lock"></i>
               <input type="password" name="password" id="password" placeholder=" Password">
               <i class="fa-regular fa-eye" id="togglePassword"></i>
               <span id="passwordError" class="error"></span>
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

            <div class="forgot-pass"><br>
               <a class="forgot-pass0" href="user_login_forgot_password.php">Forgot Password?</a>
            </div>
            <div class="btn">
               <div class="inner"></div>
               <button type="submit">login</button>
            </div>
            <!-- show message when email and password wrong:login failed -->
            <div id="error-msg"></div>

            <a href="user_login.php">back</a>
         </form>
      </div>
   </div>
</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
   $(document).ready(function () {
      // console.log("hiii");
      $('#adminform').submit(function (event) {
         event.preventDefault();
         if (validateform()) {
            let email = $('#email').val();
            let pass = $('#password').val();
            let mydata = { email: email, password: pass }
            // console.log(mydata);
            $.ajax({
               url: "admin_login_insert.php",
               method: "POST",
               data: mydata,
               success: function (data) {
                  //  alert(data);
                  if (data == "success") {
                     window.location.href = "admin_dashboard.php";
                  } else {
                     $('#error-msg').text('Login failed. Please try again.');
                  }
                  $('#adminform')[0].reset();

                  //   after login failed show message only 2 seccond
                  setTimeout(function () {
                     $('#error-msg').text(''); // Clear the error message
                  }, 2000);
               }
            });
         }

      });
   });

   function validateform() {
      var email = $('#email').val();
      var password = $('#password').val();
      var isValid = true;

      if (email == "") {
         $("#emailError").text("Email is required");
         isValid = false;
      } else if (!/\S+@\S+\.\S+/.test(email)) {
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