<?php include('db.php'); 
//admin_login se id ko laye - jab id ayegi tabhi page open hoga admin_login par redairect hoga
session_start();
if (!isset($_SESSION['userr_id']) && !isset($_SESSION['id'])) {
    // Agar dono mein se koi bhi ID set nahi hai, to user ko admin_login.php par redirect kar dijiye
    header('Location: admin_login.php');
    exit(); // Yeh line isliye hai taaki code yahin par band ho jaye aur age kuch execute na ho
}
$_SESSION['userr_id'] = $_SESSION['id'];
// print_r( $_SESSION['id']);
// print_r($_SESSION);?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="admin_dashboard_style.css"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    
</head>
<style>
body{
   margin: 0;
   padding: 0; 
}
.custom-blue {
    background-color: #489fb5; /* Choose your desired shade of blue */
}
p#settingsDropdown {
    font-size: 18px;
    font-family: itelic;
    /* margin-top: 10px; */
}
img.admin_image {
    width: 100px;
    height: 69px;
    border-radius: 10px;
}

.sidebar {
    height: 100vh;
    /* height: 600px; */
    padding-top: 20px;
    /* color: blue; */
    background-color: #16697a;
}

.sidebar a {
    color: #fff;
    padding: 18px;
    display: block;
    font-family: ui-serif;
}
.sidebar a {
    color: #ffffff;
    text-decoration: none;
    padding: 22px;
    border-radius: 8px;
    display: block;
}
.sidebar a:hover {
    background-color: #82c0cc;
    width: 106%;
}
/* ul.dropdown-menu.show {
    box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
    font-familt: itelic;
} */
.dropdown-menu.show {
    display: block;
    margin: 1px 29% 1px 88%;
    font-family: itelic;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}
/* @media (min-width: 768px) {
    .col-md-2 {
        flex: 0 0 auto;
        width: 16.666667%;
        background-color: #16697a;
    }
} */
.form{
    justify-content: center;
    display: flex;
}
.para_admin_post {
    display: flex;
    justify-content: center;
    font-weight: bold;
    font-style: inherit;
}
.form.pt-5 {
  height: 500px;
  width: 1100px;
  left: 20px;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  margin: 5px;
   /* margin-left: 20px; */
  margin-left: 20px;
  margin-left: 0px;
  background-color: #f2f4f4;
}

.error{
  color: red;
}
p {
    margin-top: 0;
    margin-bottom: 1rem;
    font-size: 20px;
    text-align: center;
    font-family: itelic;
}
.add_btn {
    display: flex;
    justify-content: center;
}

</style>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light custom-blue w-100">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <?php 
            // Start the session if not already started
            $image_url = $_SESSION['images'] ?? ''; // Check if the session variable is set
            echo "<img src='" . htmlspecialchars($image_url, ENT_QUOTES, 'UTF-8') . "' alt='Admin Image' class='admin_image'/>";
            ?>
        </div>
        <div class="display">
            <!-- Display dropdown -->
            <p class="nav-link text-light dropdown-toggle" id="settingsDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">Display</p>
            <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                <li><a class="dropdown-item" href="#" onclick="logout()">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<script>
function logout() {
    if (confirm('Are you sure you want to logout this page?')) {
        window.location.href = 'admin_logout.php';
        }
}
</script>

<div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <nav class="nav flex-column">
                <a class="nav-link active" href="admin_dashboard.php">Dashboard</a>
                <a class="nav-link" href="dashboard.php">View user POST</a>
                <a class="nav-link" href="add_admin_post.php">Add POST</a>
            </nav>
        </div>

    
<div class="container">

<div class="para_admin_post">
<p>ADMIN POST</p>
</div>
<div class="form pt-5 ">
<form style="height: 500px; width:800px;"  id="myform">
  
<input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $_SESSION['userr_id']; ?>">
  
  <div class="form-group" >
    <label for="title" class="title">Title</label>
    <input type="text" class="form-control" id="title" name="title">
    <span id="title_error" class="error"></span>
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
  
  <div class="add_btn">
  <button type="submit" class="btn btn-primary mb-2" id="addbtn">Add New Post</button>
</div>
</form>
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
                    alert(data);
                    window.location.href = "admin_dashboard.php";
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