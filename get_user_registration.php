<?php
include('db.php');
$records_per_page = 10;

// Get the current page number from the request (default to page 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
// echo "my page is".$page;1

// Calculate the offset for the query 1-1*5=0  ,2-1*5=5, 3-1*5=10 ,4-1*5=15
$offset = ($page - 1) * $records_per_page;//

$sql = "SELECT * FROM user_login LIMIT $records_per_page OFFSET $offset";
// $sql = "SELECT * FROM user_login LIMIT $offset OFFSET $records_per_page";
$result = mysqli_query($conn, $sql);

// Initialize an array to hold the data
$data = array();

// Fetch the results and store them in the data array
while ($row = mysqli_fetch_assoc($result)) {
    $image=$row['image'];
    $_SESSION['image']=$image;
    // echo "my image is ".$image."..............";
    $data[] = $row;
}

// Query the total record count
$total_records_query = "SELECT COUNT(*) AS total FROM user_login";
$total_records_result = mysqli_query($conn, $total_records_query);
$total_records = mysqli_fetch_assoc($total_records_result)['total'];
// echo "total records".$total_records;//6

// Calculate total number of pages 6/10= 0.5
// $total_pages = ($total_records / $records_per_page);//1.2
$total_pages = ceil($total_records / $records_per_page);//2
// echo "result".$total_pages;

// Create pagination links
$pagination = '<nav><ul class="pagination">';
for ($i = 1; $i <= $total_pages; $i++) {
    // $active = ($i == $page) ? 'active' : '';
    // echo $active;
    $pagination .= '<li class="page-item"><a class="page-link" href="#" id="' . $i . '">' . $i . '</a></li>';
}
 '</ul></nav>';

// Return the data and pagination as a JSON object
$response = array(
    'data' => $data,
    'pagination' => $pagination
);

// header('Content-Type: application/json');
echo json_encode($response);
mysqli_close($conn);
?>
