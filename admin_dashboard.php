<?php 
ob_start();//echo "This content will not be sent to the browser.";
include('db.php');
session_start();
?>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="admin_dashboard_style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script> -->
    
</head>

<style>
body{
   margin: 0;
   padding: 0; 
   overflow-x: hidden;

}

.custom-blue {
    background-color: #489fb5; Choose your desired shade of blue
}
p#settingsDropdown {
    font-size: 18px;
    font-family: itelic;
    /* margin-top: 10px; */
}
img {
    vertical-align: middle;
    border-style: none;
    border-radius: 4px;
    width: 70px;
    height: 48px;
}
img.admin_image {
    width: 100px;
    height: 69px;
    border-radius: 10px;
}
.dropdown-menu.show {
  display: block;
  margin: 1px 29% 1px 88%;
  font-family: itelic;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}
@media (min-width: 768px) {
    .col-md-2 {
        flex: 0 0 auto;
        width: 16.666667%;
        background-color: #16697a;
    }
}
.sidebar {
    height: 125vh;
    padding-top: 20px;
    color: #ffffff;
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
button.btn-edit {
    border: none;
    background-color: #7efd7e;
    color: white;
    border-radius: 5px;
}
button.btn-del {
    border: none;
    background-color: #ef4545;
    color: white;
    border-radius: 5px;
}
.input_scroll {
    overflow-x: scroll;
}
.pass {
    font-size: 9px;
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
                        $image_url = $_SESSION['images'];
                        echo "<img src='" . htmlspecialchars($image_url, ENT_QUOTES, 'UTF-8') . "' alt='Admin Image' class='admin_image'/>";
                        ?>
            </div>
            <div class="display">
                
                    <p class="nav-link text-light dropdown-toggle" id="settingsDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">display</p>
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
    <!-- sidebar Navbar -->

<div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <nav class="nav flex-column">
                <a class="nav-link active" href="admin_dashboard.php">Dashboard</a>
                <a class="nav-link" href="dashboard.php">View user POST</a>
                <a class="nav-link" href="add_admin_post.php">Add POST</a>
            </nav>
        </div>


        <!-- Main Content -->
    <div class="input_scroll col-md-10 content">

         <div class="fw-bold py-2">
            <?php 
            echo "Welcome Admin " . $_SESSION['email'] ;
    
            $user = $_SESSION['email'];
            if (!$user) {
                header('Location: admin_login.php');
                exit;
            }
            ob_end_flush();
            ?>
         </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>FIRST NAME</th>
                        <th>LAST NAME</th>
                        <th>CONTACT</th>
                        <th>EMAIL</th>
                        <th>PASSWORD</th>
                        <th>profile<th>
                        <th colspan="2" >Action</th>
                    </tr>
                </thead>
                <tbody id="tbody"></tbody>
            </table>
            <div id="pagination">
                <!-- Pagination links add karega dynamically -->
            </div>

        </div>
    </div>
 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <script>
    // Function to fetch data from the server and display it in the table
    function showData(page = 1) {
        $.ajax({
            url: 'get_user_registration.php',
            type: 'GET',
            data: { page: page }, // Pass the page number to the server for pagination
            dataType: 'json',
            success: function (response) {
                // Clear previous data
                $('#tbody').empty();

                // Check if data is returned and has results
                if (response.data && response.data.length > 0) {
                    // Iterate through the results and append rows to tbody
                    response.data.forEach(function (row) {
                        if (row.is_admin != 1) {  // Exclude users with is_admin = 1 ,not show in table 
                            $('#tbody').append(`
                                <tr>
                                    <td>${row.id}</td>
                                    <td>${row.fname}</td>
                                    <td>${row.lname}</td>
                                    <td>${row.contact}</td>
                                    <td>${row.email}</td>
                                    <td><div class="pass">${row.password}</div></td>
                                    <td>
                                       <img src='${row.image}' style='max-width: 100px; height: 50px;'>
                                    </td>
                                    <td>
                                        <a href='edit_user_form.php?id=${row.id}' class='edit-link'>
                                            <button class='btn-edit'>Edit</button>
                                        </a>
                                    </td>
                                    <td>
                                        <button class='btn-del' data-id='${row.id}'>Delete</button>
                                    </td>
                                </tr>
                            `);
                        }
                    });

                    // Update pagination (if applicable)
                    if (response.pagination) {
                        $('#pagination').html(response.pagination);
                    }
                } else {
                    // If no data is returned
                    $('#tbody').html('<tr><td colspan="9">No records found</td></tr>');
                }

                }
            });
        }

        // Initial call to fetch data
        showData();

        // Event listener for pagination
        $(document).on('click', '#pagination a', function (event) {
            event.preventDefault();
            const pageId = $(this).attr('id');
            showData(pageId);
        });

        // Event listener for delete button
        $("tbody").on("click", ".btn-del", function () {
            if (confirm("Are you sure you want to delete this item?")) {
                let id = $(this).attr("data-id");
                let mydata = { id: id }; // Change key from $id to id
                console.log(mydata);
                
                $.ajax({
                    url: "delete_user_information.php",
                    method: "POST",
                    data: mydata, // Send the mydata object as the POST data
                    success: function (data) {
                        alert(data);
                showData();
            },
         });
      }
});


        // Call the showdata function to load data initially
        // showdata();
</script>

</body>
