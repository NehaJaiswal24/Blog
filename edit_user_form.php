<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Registration  </title>
    <link rel="stylesheet" href="edit_user_form_style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <style>
    .error{
      color: red;
   }
   #imagePath {
  border-radius: 10px;
  padding: -11px;
  margin: 10px;
}
  </style>
<body>
  <div class="container">
    <div class="title">Update your Registration Form </div>
    <div class="content">
      <form id="myform">
        <div class="user-details">
          <div class="input-box">
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
            <label for="imagePath">Display Image</label>
            <div>
           <img id="imagePath" name="imagePath" style="max-width: 100px; height: 50px;">
            </div>
            <span id="gmailError" class="error"></span><br>
          </div>
          <!-- <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="text" placeholder="Confirm your password" id="conpws" name="conpws" >
            <span id="conpasswordError" class="error"></span><br>
          </div> -->
        </div>
        <div class="button">
          <input type="submit" value="Update">
        </div>
      </form>
    </div>
  </div>


</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    let id = <?php echo $_GET['id'] ?>;
    // console.log(id);
    var mydata = { id: id }; 
    $.ajax({
        url: "get_user_information.php",
        method: "POST",
        dataType: "json",
        data: mydata,
        success: function(data) {
          // alert(data.no);
         $("#id").val(data.id);
            $("#fname").val(data.fname);
            $("#lname").val(data.lname);
            $("#no").val(data.contact);
            $("#email").val(data.email);
            $("#psw").val(data.password);
            $("#uploadedImage").attr(data.image);
            $("#imagePath").attr("src", data.image);
            
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
            url: "user_edit_query.php",
            method: "POST",
            data: mydata,
            contentType: false,
            processData: false,
            success: function(data) {
              // console.log('hiii');
                window.location.href="admin_dashboard.php"
            },
            error: function(xhr, status, error) {
                console.error("Error updating user:", xhr.responseText);
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

    if (psw ==="") {
      $("#passwordError").text("Password is required");
      isValid = false;

    } else if (!/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{8,16}$/.test(psw)) {
      $("#passwordError").text("Password must be at least 8 characters long");
      isValid = false;
    } else {
      $("#passwordError").text("");
    }
    
    // if (conpws === "") {
    //   $("#conpasswordError").text("please confirm Password is required");
    //   isValid = false;
    // }else if (!/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{8,16}$/.test(conpws)) {
    //   $("#passwordError").text("Password must be at least 8 characters long");
    //   isValid = false;
    // }else if(psw!=conpws){
    //   $("#conpasswordError").text("password and confirm Password must be same"); 
    // }
    // else {
    //   $("#conpasswordError").text("");
    // }

    // if (image === "") {
    //     $("#imageError").text("Image is required");
    //     isValid = false;
    //      } else {
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