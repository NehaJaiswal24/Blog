<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password Reset</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            outline: none;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            width: 100%;
            background: #fff !important;
        }

        .container {
          background: #fff;
          width: 410px;
          padding: 20px;
          box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
          margin: auto;
          margin-top: 32px;
          border-radius: 5px;
        }

        .container .text {
            font-size: 35px;
            font-weight: 600;
            text-align: center;
        }

        /* .container form {
            margin-top: 20px;
        } */

        .container form .data {
            height: 45px;
            width: 100%;
            margin: 5px;
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
            margin-top: 15px;
            border-radius: 3px;
        }

        form .btn {
            margin: 30px 0;
            height: 45px;
            width: 100%;
            position: relative;
            overflow: hidden;
            display: flex;
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

        .email_pass_input {
            padding: 10px;
        }

        .email_pass_input1 {
            padding: 10px;
        }

        div#header_input_title {
            display: flex;
            justify-content: center;
        }

        .error {
            color: red;
        }

    
        button {
          width: 100%;
          height: 43px;
          font-weight: bold;
          font-size: 15px;
          border-radius: 3px;
          background-color: blue;
          color: #fff;
          font-size: 14px;
          border: none;
          letter-spacing: 1px;
          margin-top: 40px;
          cursor: pointer;
      }
        

        button:disabled {
            cursor: not-allowed;
        }

        .input_type_btn {
            display: flex;
            justify-content: center;
            /* padding: 10px; */
        }

        .input_type_backbtn {
            margin-top: 85px;
            padding: 10px;
        }

        h2 {
            display: flex;
            justify-content: center;
            font-family: itelic;
        }

        div#responseMessage {
          font-size: 14px;
          font-family: math;
          margin-top: 0px;
          padding: 8px;
        }

        #waitingMessage {
            color: green;
            margin-left: 9px;
            font-size: 14px;
        }
        span#emailError {
    color: red;
    font-size: 13px;
}
div#responseMessage {
    margin-top: 10px;
}

        /* error {
            color: red;
            font-size: 13px;
            /* margin-top: 9px; */
        } */
    </style>
</head>

<body>
    <div class="container">
        <div class="form">
            <form id="resetForm">
                <div class="input_type_title">
                    <h2>Forgot Password</h2>
                </div>
                <div class="data">
                    <!-- <label for="email">Email:</label> -->
                    <input type="type" id="email" name="email" placeholder="Enter Email">
                    <span id="emailError" class="error"></span>
                    <div class="input_type_btn">
                        <button type="submit" name="requestReset" id="submitButton">Request Reset</button>
                    </div>
                </div>

                <div id="responseMessage"></div>
                <div id="waitingMessage"></div>
                <div class="input_type_backbtn">
                    <a href="user_login.php">Back</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#resetForm').on('submit', function (e) {
                e.preventDefault(); // Default form submission ko rokta hai
                if (validateform()) {
                    // Form data ko serialize karte hain
                    var formData = $(this).serialize();

                    // Button ko disable karte hain aur cursor ko not-allowed state me karte hain
                    $('#submitButton').prop('disabled', true);

                    // Waiting message show karte hain
                    $('#waitingMessage').text('Please wait.....').show();

                    // AJAX request bhejte hain
                    $.ajax({
                        url: 'user_password_reset_request.php',
                        type: 'POST',
                        data: {
                            requestReset: true,
                            email: $('#email').val()
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.success) {
                                // Success message ko green color me
                                $('#responseMessage').text(response.message).css('color', 'green');
                            } else {
                                // Error message ko red color me
                                $('#responseMessage').text(response.message).css('color', 'red');
                            }
                            $('#waitingMessage').hide();
                            $("#resetForm")[0].reset();

                            // Response message ko 3 seconds ke baad hata do
                            setTimeout(function () {
                                $('#responseMessage').text('');
                            }, 2000);
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX error:', status, error);
                            alert('Request bhejne me error aaya.');
                            $('#waitingMessage').hide();
                        },
                        complete: function () {
                            // Button ko wapas enable karte hain aur cursor ko default state me le aate hain
                            $('#submitButton').prop('disabled', false);
                        }
                    });
                }
            });
        });

        function validateform() {
            var email = $('#email').val();
            var isValid = true;

            if (email == "") {
                $("#emailError").text("Email required");
                isValid = false;
            } else if (!/\S+@\S+\.\S+/.test(email)) {
                $("#emailError").text("Email format invalid .");
                isValid = false;
            } else {
                $("#emailError").text("");
            }

            return isValid;
        }
    </script>
</body>

</html>
