<?php 
include('db.php'); 
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
  margin: 1px 29% 1px 88%;
}

nav.navbar.navbar-expand-lg.navbar-light {
    background-color: #489fb5;
}
.footer {
      background-color: #f8f9fa;
      padding: 50px 0;
  }
.user-name {
  color: #fff;
  font-size: 15px;
  font-family: itelic;
}
.card-title {
  color: #2424db;
  font-size: 18px;
  font-family: sans-serif;
  font-family: helvatica;
}
.nav-item {
    display: flex;
    align-items: center;
}

a.nav-link.text-light.fas.fa-sign-out-alt {
    font-size: 18px;
    padding-left: 10px;
}
img, svg {
    vertical-align: middle;
    height: 52px;
    width: 60px;
    border-radius: 9px;
}
</style>


<nav class="navbar navbar-expand-lg navbar-light">

<div class="user-name">
<?php

$user = $_SESSION['username'] ?? null;
$admin = $_SESSION['email'] ?? null;


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
          <a class="nav-link text-light" href="dashboard.php">Home</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link text-light" href="add_post.php">add post</a>
        </li> -->
        <li class="nav-item "></i>
         <a class="nav-link text-light fas fa-sign-out-alt" href="#" onclick="logout()"></a>
        </li>

         <!-- <div class="display">
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
                <a class="dropdown-item">
                  setting
                </a>
              </li>
              <li>
                <a class="dropdown-item">
                  privacy
                </a>
              </li>
              <li>
                <a class="dropdown-item">
                  Feedback
                </a>
              </li>
            </ul>
          </li>
        </div>  -->

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
