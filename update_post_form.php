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
.user-name {
    color: #fff;
    font-family: itelic;
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
          <a class="nav-link text-light" href="dashboard.php">Home</a>
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
<div class="form pt-5 ">
<form style="height: 500px; width:800px;"  id="myform">
  
  <!-- <input type="text" class="form-control" id="user_id" name="user_id" value="<?php //echo "user login ID ". $_SESSION['userr_id']; ?>"> -->
  <div class="form-group" >
  <input type="hidden" class="form-control" id="post_id" name="post_id">
  <input type="hidden" class="form-control" id="user_id" name="user_id">
  </div>

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
  
  <button type="submit" class="btn btn-primary mb-2" id="addbtn">Update Post</button>
</form>
</div>
</div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
                let id = <?php echo $_GET['post_id']?>;
                // console.log('User ID:', id);
                // Your further logic here using the user ID
                var mydata = { id: id }; 
                $.ajax({
                    url: "get_post_information.php",
                    method: "POST",
                    dataType: "json",
                    data: mydata,
                    success: function(data) {
                    // alert(data.no);
                        $("#post_id").val(data.post_id);
                        $("#user_id").val(data.user_id);
                        $("#title").val(data.title);
                        $("#content").val(data.content);
                        $("#date").val(data.date);
                       },
                });

                  // if(formValidation()){
                    $("#myform").submit(function(e){
                      // console.log('clicked');
                      e.preventDefault(); // Prevent the default form submission
                      if(validateform()){
                      var formData = new FormData(this); // Create a FormData object
                      // console.log(formData);
                      $.ajax({
                          url: "update_post.php",
                          method: "POST",
                          data: formData,
                          contentType: false,  // Don't set contentType
                          processData: false, // Don't process data
                          success: function(response) {
                              alert(response); 
                              window.location.href = "dashboard.php";
                          },
                          error: function(xhr, status, error) {
                              console.error(xhr.responseText);
                            
                          }
                      });
                      }
          
                    });
    });

function validateform(){
      
    var title = $('#title').val();
    var content = $('#content').val();
    var date = $('#date').val();
    var isValid=true;
    if(title === "") {
      $("#title_error").text('Title is required.');
      isValid = false;  // Set isValid to false
      } else {
        $("#title_error").text();
      }

    if(content===""){
      $("#contenterror").text('content is required');
      isValid=false;
    }else{
      $("#contenterror").text();
    }


    if(date===""){
      $("#date_error").text('content is required');
      isValid=false;
    }else{
      $("#date_error").text();
    }

        return isValid;
    }

     
</script>
</body>
</html>
