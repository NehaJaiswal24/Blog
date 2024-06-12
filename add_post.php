<?php include('db.php'); 
 include('z.php'); 
 //user_login se id ko laye - jab id ayegi tabhi page open hoga 
// session_start();
$_SESSION['userid']=$_SESSION['id'];
if (!isset($_SESSION['userid']) && !isset($_SESSION['id'])) {
    // Agar dono mein se koi bhi ID set nahi hai, to user ko admin_login.php par redirect kar dijiye
    header('Location: user_login.php');
    exit(); // Yeh line isliye hai taaki code yahin par band ho jaye aur age kuch execute na ho
}
// $_SESSION['userr_id'] = $_SESSION['id'];

// print_r( $_SESSION['id']);
// print_r($_SESSION);?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
body{
   margin: 0;
   padding: 0; 
}


.form{
    justify-content: center;
    display: flex;
}
.form.pt-5 {
  height: 500px;
  width: 1138px;
  left: 20px;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  margin: 20px;
   /* margin-left: 20px; */
  margin-left: 20px;
  margin-left: 0px;
  background-color: #f2f4f4;
}
.title {
  font-size: 20px;
  font-family: itelic;
}
.error{
  color: red;
}
</style>
<body>
<div class="container">
<div class="form pt-5 ">
<form style="height: 500px; width:800px;"  id="myform">
  
  <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $_SESSION['userid']; ?>">
  
  <div class="form-group" >
    <label for="title" class="title">Title</label>
    <input type="text" class="form-control" id="title" name="title">
    <span id="title_error" class="error"></span>
  </div>

  <div class="form-group">
  <label for="content" class="title"> Post Image </label>
    <!-- <input type="hidden" value="'.$file.'" name="delete_file" /> -->
    <input type="file" id="post_image" name="post_image" style="height:35px" ><br>
    <span id="postimageError" class="error"></span><br>
  </div>
  

  <div class="form-group">
    <label for="content" class="title"> Content </label>
    <textarea class="form-control" id="content" rows="3" name="content"></textarea>
    <span id="contenterror" class="error"></span>
  </div>

  <div class="form-group">
    <label for="date" class="title">Date</label>
    <input type="date" id="date" name="date" ><br>
    <!-- <input type="datetime-local" id="date" name="date" ><br> -->
    <span id="date_error" class="error"></span>
  </div>
  
  <button type="submit" class="btn btn-primary mb-2" id="addbtn">Add New Post</button>
</form>
</div>
</div>
    
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Calculate the current date
    const now = new Date();
    const currentDate = now.toISOString().split('T')[0]; // current date in ISO format YYYY-MM-DD

    // Calculate the date one year in the future
    const futureDate = new Date(new Date().setFullYear(now.getFullYear() + 1)).toISOString().split('T')[0];

    // Set the 'min' and 'max' attributes for the date input field
    $('#date').attr('min', currentDate);
    $('#date').attr('max', futureDate);

    // Form validation function
    function formValidation() {
        let isValid = true;

        // Validate the date input
        var title = $('#title').val();
        // var post_image = $('#post_image').val();
        var content = $('#content').val();
        const date = $('#date').val();
        if (!date) {
            $("#date_error").text('Date is required.');
            isValid = false;
        } else {
            // Check if the selected date is within the allowed range
            const selectedDate = new Date(date);
            const minDate = new Date(currentDate);
            const maxDate = new Date(futureDate);

            if (selectedDate < minDate || selectedDate > maxDate) {
                $("#date_error").text('Date must be within the allowed range.');
                isValid = false;
            } else {
                $("#date_error").text('');
            }
        }
        
        if (title === "") {
            // If the title is empty, display an error message
            $("#title_error").text('Title is required.');
            isValid = false;  // Set isValid to false
        } else if (title.length > 50) {
            // If the title length exceeds 50 characters, display an error message
            $("#title_error").text('Title cannot exceed 50 characters.');
            isValid = false;  // Set isValid to false
        } else {
            // If no issues, clear any error message
            $("#title_error").text('');
       }

       if (content.trim() === "") {
        // Display an error message if content is empty
        $("#contenterror").text('Content is required.');
        isValid = false; 
        } else {
            $("#contenterror").text('');
        }
        

        return isValid;
    }

    // Attach the form validation function to the form submission event
    $('#myform').submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        // Check form validation
        if (formValidation()) {
            // If the form is valid, you can proceed with form submission
            const formData = new FormData(this);
            // Add your AJAX request code here
            $.ajax({
                url: "insert_new_post.php",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    window.location.href = "dashboard.php";
                    $('#myform')[0].reset();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
});


</script>