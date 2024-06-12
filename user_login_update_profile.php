<?php include('db.php'); 
session_start();
// user login se id ko laye
$_SESSION['userid']=$_SESSION['id'];
// echo $_SESSION['userid'];
if (!isset($_SESSION['userid']) && !isset($_SESSION['id'])) {
    // Agar dono mein se koi bhi ID set nahi hai, to user ko admin_login.php par redirect kar dijiye
    header('Location: user_login.php');
    exit(); // Yeh line isliye hai taaki code yahin par band ho jaye aur age kuch execute na ho
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NEWS-POST</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
  <style>
    ul.dropdown-menu.show {
      font-family: itelic;
      box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

    }
    .dropdown-menu.show {
  margin: 1px 29% 1px 88%;
}
nav.navbar.navbar-expand-lg.navbar-light {
    background-color: #489fb5;
}
.user-name {
  color: #fff;
  font-size: 18px;
  font-family: itelic;
}
img, svg {
    vertical-align: middle;
    height: 52px;
    width: 60px;
    border-radius: 9px;
}
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins',sans-serif;
}
.error{
  color: red;
}
body{
  height: 100vh;
  align-items: center;
  padding: 10px;
  background: #fff;
}
#imagePath {
  border-radius: 10px;
  padding: -11px;
  margin: 10px;
}
.container{
  max-width: 700px;
  width: 100%;
  background-color: #fff;
  padding: 25px 30px;
  border-radius: 5px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.15);
  padding: 23px;
  margin-top: 23px;
}
.container .title{
  font-size: 25px;
  font-weight: 500;
  position: relative;
  display: flex;
  justify-content: center;
  margin-bottom: 29px;
  font-family: itelic;
}
.content form .user-details{
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 20px 0 12px 0;
}
form .user-details .input-box{
  margin-bottom: 15px;
  width: calc(100% / 2 - 20px);
}
form .input-box span.details{
  display: block;
  font-weight: 500;
  margin-bottom: 5px;
}
.user-details .input-box input{
  height: 45px;
  width: 100%;
  outline: none;
  font-size: 16px;
  border-radius: 5px;
  padding-left: 15px;
  border: 1px solid #ccc;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
}
 form .gender-details .gender-title{
  font-size: 20px;
  font-weight: 500;
 }
 form .category{
   display: flex;
   width: 80%;
   margin: 14px 0 ;
   justify-content: space-between;
 }
 form .category label{
   display: flex;
   align-items: center;
   cursor: pointer;
 }
 form .category label .dot{
  height: 18px;
  width: 18px;
  border-radius: 50%;
  margin-right: 10px;
  background: #d9d9d9;
  border: 5px solid transparent;
  transition: all 0.3s ease;
}

 form input[type="radio"]{
   display: none;
 }
 form .button{
   height: 45px;
   margin: 35px 0
 }
 form .button input{
   height: 100%;
   width: 100%;
   border-radius: 5px;
   border: none;
   color: #fff;
   font-size: 18px;
   font-weight: 500;
   letter-spacing: 1px;
   cursor: pointer;
   transition: all 0.3s ease;
   background:  #489fb5;
 }
 form .button input:hover{

  background:  #8ecae6;
  }
 @media(max-width: 584px){
 .container{
  max-width: 100%;
}
form .user-details .input-box{
    margin-bottom: 15px;
    width: 100%;
  }
  
}
.remove_img button {
  padding: 5px;
    background-color: #f44336;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 10px;
    border-radius: 5px;
}

    .remove_img button:hover {
      background-color: #d32f2f;
    }

</style>

<body>
<nav class="navbar navbar-expand-lg navbar-light">

<div class="user-name">
<?php 

// Initialize session variables
// session email id store ki 
$user = $_SESSION['username'] ?? null;
// echo "user email ".$user;
$admin = $_SESSION['email'] ?? null;
// echo "admin".$admin;

// admin and user me se koi login huaa hai ya nhi
if (!empty($user) || !empty($admin)) {

    if (!empty($admin)) {
       // if admin set hai to
        echo "  Welcome admin: $admin <br>";
        
    } else {
        // if user set hai to 
        echo "  Welcome user: $user <br>";
    }
} else {
    header('Location: user_login.php');
    exit();
}
?>

</div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id=" navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link text-light" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="add_post.php">add post</a>
        </li>
        <div class="display">
          <li class="nav-item">
            <p class="nav-link text-light dropdown-toggle" id="settingsDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">display</p>
            <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
              <li>
                <a class="dropdown-item" href="#" onclick="logout()">
                  Logout
                </a>
              </li>
             
              <li>
                <a class="dropdown-item" href="user_login_update_profile.php">
                  Edit profile
                </a>
              </li>
            
            </ul>
          </li>
        </div>

        <script>
          function logout() {
            if (confirm('Are you sure you want to logout this email?')) {
              window.location.href = 'logout.php';
            }
          }
        </script>

      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="title">Edit Profile </div>
    <div class="content">

      <form id="myform">
        <div class="user-details">
          <div class="input-box">
          <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $_SESSION['userid']; ?>">
          <input type="hidden" id="id" name="id">
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
          <div class="input-box">
            <label for="uploadedImage">Uploaded Image</label>
            <input type="file" id="uploadedImage" name="uploadedImage">
            <span id="imageError" class="error"></span><br>
          </div>
          <div class="input-box">
            <div class=image_container>
            <label for="imagePath">Display Image</label>
            <div class="second-box">
            <img id="imagePath" name="imagePath" style="max-width: 100px; height: 50px;">
            </div>
            <div class="remove_img">
            <button type="button" name="removeImageBtn" id="removeImageBtn">Remove image</button>
            </div>
            <!-- <span id="gmailError" class="error"></span><br> -->
            </div>
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Edit profile">
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

$(document).ready(function(){
    let id = <?php echo $_SESSION['userid']; ?>;
    // console.log(id);
    var mydata = { id: id }; 
    $.ajax({
        url: "get_user_information.php",//login hone ke bad user profil get ki hai  and admin bhi get  kar sakta hai user informtaion eak hi query ka use uaa hai ---get_user_information.php
        method: "POST",
        dataType: "json",
        data: mydata,
        success: function(data) {
          // console.log(data.uploadedImage);
          // alert(data.no);
            $("#id").val(data.id);
            $("#fname").val(data.fname);
            $("#lname").val(data.lname);
            $("#no").val(data.contact);
            $("#email").val(data.email);
            $("#psw").val(data.password);
            // $("#uploadedImage").attr(data.image);
            // console.log("Image path:", data.image);
            $("#imagePath").attr("src", data.image);
            // $("button[name='delete_image']").click(function(){
            //     $("#imagePath").attr("src", data.image);
            // });
            

            // Store image path in session variable---
            // sessionStorage.setItem('userImagePath', data.image);
            // console.log(sessionStorage.getItem('userImagePath'));
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });

    $('#myform').submit(function(e) {
        e.preventDefault(); // Prevent form from submitting the default way
        if(validateform()){

        let mydata = new FormData(this);
        
        $.ajax({
            url: "user_edit_query.php",//login hone ke bad user profil edit and admin bhi edit  kar sakta hai user informtaion eak hi query ka use uaa hai ---user_edit_query.php
            method: "POST",
            data: mydata,
            contentType: false,
            processData: false,
            success: function(data) {
              // console.log('data');
                window.location.href="after_update_img_display.php"
                // window.location.href="dashboard.php"
            },
            error: function(xhr, status, error) {
                console.error("Error updating user:", xhr.responseText);
            }
        });
        }
    });

     // remove image for ajax
     $('#removeImageBtn').click(function() {
    console.log("hii");
    let id = <?php echo json_encode($_SESSION['userid']); ?>; // Correctly encode PHP variable to JavaScript
    console.log(id);
    var mydata = { id: id }; 
    console.log(mydata);
    $.ajax({
      url: "remove_img_query.php",
      method: "POST",
      data: mydata,
      success: function(response) {
        // console.log(response);
        alert(response);
        // Clear the image preview and file input
        $('#imagePath').attr('src', '');
        $('#uploadedImage').val(''); // Clear the file input
      },
      error: function(xhr, status, error) {
        console.error("Error updating user:", xhr.responseText);
      }
    });
  });
  
});

function validateform(){
  var fname = $('#fname').val();
  var lname = $('#lname').val();
  var no = $('#no').val();
  var email = $('#email').val();
  var psw = $('#psw').val();
  // var conpws = $('#conpws').val();
  var image = $("#uploadedImage").val();
  var isValid=true;

    if(fname===""){
      $('#fnameError').text('First name is required');
      isValid =false;
      }else{
        $('fnameError').text()
    }

    if (lname === ""){
      $("#lnameError").text("Last Name is required");
      isValid = false;
      } else {
        $("#lnameError").text("");
    }

    if (no == "") {
      $("#noError").text(" mobile Number is required");;
    }else if(!/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/.test(no)) {
      $("#noError").text("Invalid mobile format");
      isValid = false;
    }
    else {
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
    
    // if (image === "") {
    //     var fileExtension = image.split('.').pop().toLowerCase(); //image: This variable holds the value of the file path or file name that has been selected in the file input field./ split('.')-"example.jpg"->["example", "jpg"]./pop():This function is used to remove and return the last element .return karega jpg./toLowerCase(): ->JPG", .toLowerCase() will convert it to "jpg".
    //     // consile.log(fileExtension);
    //     if (fileExtension !== "jpg" && fileExtension !== "jpeg" && fileExtension !== "png") {
    //         $("#imageError").text("Only JPG, JPEG, and PNG files are allowed");
    //         isValid = false;
    //     } else {
    //         $("#imageError").text("");
    //     }
    //   }


  return isValid;
}
</script>
  

</body>
