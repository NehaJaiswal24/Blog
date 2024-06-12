<?php include('db.php'); 
session_start();
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
</head>

<body>
  <style>
    ul.dropdown-menu.show {
      font-family: itelic;
      box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;

    }
    .dropdown-menu.show {
      margin: 0px 6% 0px 69%;

}
nav.navbar.navbar-expand-lg.navbar-light {
    background-color: #489fb5;
}
.user-name {
  color: #fff;
  font-size: 18px;
  font-family: itelic;
}
.card-title {
  color: #2424db;
  font-size: 18px;
  font-family: sans-serif;
  font-family: helvatica;
}
img, svg {
    vertical-align: middle;
    height: 52px;
    width: 60px;
    border-radius: 9px;
}
input#search-box {
    margin: 10px;
    border-color: #fff;
    border-radius: 5px;
}
.fa-search:before {
    content: "\f002";
    color: #fff;
}

</style>


<nav class="navbar navbar-expand-lg navbar-light">

<div class="user-name">


<?php 
// after image update 
if(isset($_SESSION['user_images'])) {
  $updated_img = $_SESSION['user_images'];//after_update-img_display.php
  // echo "<img src='" . $updated_img . "' alt='User Image' />";
  $_SESSION['user_image'] = $updated_img;
  $_SESSION['images'] = $updated_img;
} else {
  // Handle the case where 'user_images' is not set in the session

}
?>
<?php 

// Initialize session variables
// session email id store ki 
$user = $_SESSION['username'] ?? null;
// echo "user email ".$user;
$admin = $_SESSION['email'] ?? null;
// echo "admin".$admin;


$user_image_url = $_SESSION['user_image'] ?? null;
$admin_image_url = $_SESSION['images'] ?? null;

// admin and user me se koi login huaa hai ya nhi
if (!empty($user) || !empty($admin)) {

    if (!empty($admin)) {
        // admin image ayegi
        if (!empty($admin_image_url)) {
            echo "<img src='" . ($admin_image_url ) . "' alt='Admin Image' />";
        }
       // if admin set hai to
        echo "  Welcome admin: $admin <br>";
        
    } else {
        // user image ayegi
        if (!empty($user_image_url)) {
            echo "<img src='" . ($user_image_url ) . "' alt='User Image' />";
        }
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
        <form class="search-form">
          <input type="search" id="search-box" name="search-box" placeholder="search here....">
          <label for="search-box" class="fa fa-search"></lable>
        </form>

      </ul>
    </div>
  </nav>
  <?php include('create_card.php'); ?>


  <!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
