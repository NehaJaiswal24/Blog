
<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

  <style>
    body {
      margin: 8px;
      font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
      font-size: 1rem;
      font-weight: 157;
      line-height: 1.9;
      color: #264f79;
      text-align: left;
      background-color: #f4f3f7;
      font-size: 20px;
      font-family: itelic;
  }
  .card-title {
  font-size: 38px;
  text-align: center;
  color: #030322;
  font-family: Arial, Helvetica, sans-serif;
  font-weight: bold;
}
.btn-dlt {
  height: ;
  font-size: 11px;
  border: none;
  border-radius: 2px;
  background-color:#cd3f3f;
  color: weight;
  color: #fff;
}
.btn-edit {
  height: ;
  font-size: 11px;
  border: none;
  border-radius: 2px;
  background-color: #ace588;
  color: weight;
  color: #fff;
  margin: 5px;
}
.d-flex.flex-row.mb-3 {
  display: flex;
  justify-content: flex-end;
  column-gap: 4px;
}
</style>
<?php 
//check which id here
// session_start();
// $_SESSION['userr_id'] = $_SESSION['id'];
// echo "user login id ".$_SESSION['userr_id'];

//_______________________________________
// $user_login_id= $_SESSION['id'];
// echo "user login id".$user_login_id;

// $post_id=$_GET['post_id'];
// echo "post id".$post_id;

// $userid=$_SESSION['user_id'];
// echo "user_id".$userid;
//________________________________________
?>


<?php
// ob_start():function output buffering start karta hai.Iska matlab hai ki koi bhi output browser ko immediately send nahi hota.
// ob_end_flush():function output buffer ko flush kar deta hai, yaani buffer mein jo bhi content hota hai wo browser ko send ho jata hai.
//specified post_id database mein exist nahi karta hai, toh user ko dashboard.php par redirect kar diya jaye.jise data delete hone ke bad wapas use page par na jaye 
$post_id=$_GET['post_id'];
$sql = "SELECT post_id FROM blog WHERE post_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$stmt->store_result();

// Step 4: Agar koi row nahi milti, toh redirect kar dena dashboard.php par
if ($stmt->num_rows == 0) {
    header("Location: dashboard.php");
    exit(); // Redirect ke baad script ko exit karna zaroori hai
}
?>
  
<?php
include('z.php');
if(isset($_SESSION['is_admin'])) {
    // echo "iss_admin value: " . $_SESSION['is_admin'];
} 
?>

    <div class="d-flex flex-row mb-3">
    <a href='delete_post.php?post_id=<?php echo $post_id; ?>' id="dlt" style="display:none"><button class='btn-dlt'>DELETE</button></a>
    <a href='update_post_form.php?post_id=<?php echo $post_id; ?>' id="edit" style="display:none"><button class='btn-edit'> UPDATE</button></a>
    </div>
    
    <div id="dataContain" data-user-login-id="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : ''; ?>"></div>

    <!-- Check if is_admin session variable is set -->
    <?php if(isset($_SESSION['is_admin'])) { ?>
        <div id="isAdminContain" data-is-admin="<?php echo $_SESSION['is_admin']; ?>"></div>
    <?php } else { ?>
        <!-- If is_admin session variable is not set, provide a default value -->
        <div id="isAdminContain" data-is-admin="0"></div>
    <?php } ?>

   


    

<!--Main Navigation-->
<body>
<div class="container">
<div id="dataContainer" class="row"></div>
</div>


<footer class="bg-body-tertiary text-center">
  <!-- Grid container -->
  <div class="container p-4 pb-0">
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a
      data-mdb-ripple-init
        class="btn text-white btn-floating m-1"
        style="background-color: #3b5998;"
        href="#!"
        role="button"
        ><i class="fab fa-facebook-f"></i
      ></a>
      <!-- Google -->
      <a
        data-mdb-ripple-init
        class="btn text-white btn-floating m-1"
        style="background-color: #dd4b39;"
        href="#!"
        role="button"
        ><i class="fab fa-google"></i
      ></a>

      <!-- Instagram -->
      <a
        data-mdb-ripple-init
        class="btn text-white btn-floating m-1"
        style="background-color: #ac2bac;"
        href="#!"
        role="button"
        ><i class="fab fa-instagram"></i
      ></a>

      <!-- Linkedin -->
      <a
        data-mdb-ripple-init
        class="btn text-white btn-floating m-1"
        style="background-color: #0082ca;"
        href="#!"
        role="button"
        ><i class="fab fa-linkedin-in"></i
      ></a>
    </section>
    <!-- Section: Social media -->
  </div>

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2024 Copyright:
    <a class="text-body" href="https://mdbootstrap.com/">MDBootstrap.com</a>
  </div>
  
</footer>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  //ajax for delete post
    $(document).ready(function() {
    $('#dlt').click(function(e) {
        e.preventDefault(); 
        // console.log('lllllll');
        var href = $(this).attr('href');
            
            // Split the href string to get the post_id
            var postId = href.split('=')[1];
            console.log(postId);
            var mydata = { id: postId }
            // console.log(mydata);
        
            $.ajax({
                type: 'POST',
                url: 'delete_post.php',
                data: mydata, 
                success: function(response) {
                    alert(response); // Show the response
                    // Redirect to dashboard.php after successful deletion
                    window.location.href = "dashboard.php";
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
    
         
        // else {
        //     console.error('User ID not found in URL parameter.');
        // }
      });


    //ajax for show post in view-more page
    const postId = <?php echo json_encode($post_id); ?>;
    $.ajax({
    type: 'GET',
    url: 'show_view_more_query.php',
    data: { post_id: postId },
    dataType: 'json', // Expected response data type
    success: function(data) {
        console.log('Raw server response:', data);
        
        // Get the user_login_id and isAdmin from data attributes
        let userLoginId = $('#dataContain').data('user-login-id');
        let isAdmin = $('#isAdminContain').data('is-admin') == 1;
        // console.log("User login id: ", userLoginId);
        console.log("Is admin : ", isAdmin);

        
        // Check if data is an object
        if (typeof data === 'object') {
            let output = `
                <div class="view-more">
                    <h5 class="card-title">${data.title}</h5>
                    <p class="card-text">${data.content}</p>
                    <p class="card-text"><small class="text-body-secondary">${data.date}</small></p>
                </div>
            `;
            // <p class="card-text">${data.user_id}</p>

            // Insert the output into dataContainer
            $("#dataContainer").html(output);

            // Retrieve the buttons
            let deleteButton = $('#dlt');
            let editButton = $('#edit');

            // Compare userLoginId with user_id from data or check if isAdmin
            console.log(userLoginId);
            console.log(data.user_id);
            if (userLoginId == data.user_id || isAdmin) {
              // if (userLoginId == data.user_id) {
                // If user is the owner of the post or is an admin, show buttons
                deleteButton.show();
                editButton.show();
            } else {
                deleteButton.hide();
                editButton.hide();
            }
        } else {
            console.error('Unexpected data structure:', data);
        }
    }
});

});

</script>




