<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password Reset</title>
    <link rel="stylesheet" href="user_login_style.css?v=1.1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Inline styles */
        .error {
            color: red;
        }
        div#responseMessage {
            font-size: 19px;
            margin: 27px;
            font-family: math;
        }
        #waitingMessage{
            color:green;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form">
            <form  id="resetForm">
                <h2>Admin Forgot Password Reset</h2>
                <div class="data">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter Email" required>
                    <span id="emailError" class="error"></span>
                </div>
                <div class="btn">
                    <button type="submit" name="requestReset">Request Reset</button>
                </div>
                <!-- show: response massage  -->
                <div id="responseMessage"></div>

                <!-- show waitingmsg -->
                <div id="waitingMessage"></div>

                <a href="admin_login.php">Back</a>
            </form>
        </div>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
    $('#resetForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting the default way
        if(validateform()){
        // Get the form data
        var formData = $(this).serialize();
        
        // Send an AJAX request
        $('#waitingMessage').text('Please wait.....').show(); // Show waiting message
        $.ajax({
            url: 'user_password_reset_request.php',
            type: 'POST',
            data: {
                requestReset: true,
                email: $('#email').val()
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // console.log(response.message);
                    $('#responseMessage').text(response.message).css('color', 'green');
                } else {
                    // console.log(response.message);
                    $('#responseMessage').text(response.message).css('color', 'red'); 
                }
                $('#waitingMessage').hide(); // Hide waiting message after response
                $("#resetForm")[0].reset();
                
                //  after login failed show message only 3 seconds
                setTimeout(function(){
                    $('#responseMessage').text('');
                }, 2000);
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', status, error);
                alert('An error occurred while sending the request.');
                $('#waitingMessage').hide(); // Hide waiting message in case of error
            }
        });
    }
    });
});


function validateform(){
   var email = $('#email').val();
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

            return isValid;
    }


</script>


