<?php 
include('db.php'); 
// pagination me total records nikalte hai database se then kitne records rkhna hai page me -->formula
// total page=total records/limit per page
// ceil(19/9)==>2.333==>ceil point se upr ki value deta hai 3 return karega

// Initialize response array
$response = array(
    'data' => [],
    'pagination' => ''
);

// Get search term -URL se search-box parameter ko check kiya agar wo set hai to use retrieve karte hain.
$search_term = isset($_GET['search-box']) ? $_GET['search-box'] : '';
$search_term_escaped = mysqli_real_escape_string($conn, $search_term);

// Number of records per page
$records_per_page = 9; //Ek page me kitne records show karne hain,variable set kiya .



//URL se page parameter ko check karte hai,agar set hai to uski value retrieve karte hai,warna default 1 set karte hai.
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Ensure the page number is at least 1

// Calculate the offset for the query
// offset meaning page me record show ho rhe hai wo kaha se start honge like 0,9 first page me fir 9,9 second page me and limit fix rhti hai 
$offset = ($page - 1) * $records_per_page; // (1-1)*9=0 //((2-1)*9)=9 //(3-1)*9=18

// Query to fetch data
// konse record show honge next page me uske liye query me limit lgate hai LIMIT(offset, limit) offset meaning kaha se start karna hai, limit meaning kitne records show krwana hai.
// SELECT * FROM user_login LIMIT 0,9
// SELECT * FROM user_login LIMIT 9,9
// SELECT * FROM user_login LIMIT 18,9
$query = "
    SELECT u.id, u.fname, u.lname, u.contact, b.post_id, b.user_id, b.title, b.content, b.date
    FROM user_login AS u
    INNER JOIN blog AS b ON u.id = b.user_id 
    WHERE u.fname LIKE '%{$search_term_escaped}%' 
    OR u.lname LIKE '%{$search_term_escaped}%'
    OR b.title LIKE '%{$search_term_escaped}%'
    LIMIT $records_per_page OFFSET $offset";
// %-- naam ke kisi hisse ko bhi search karna chahte hain, toh aap % wildcard ka use kar sakte hain:
// LIKE ka istemal karte hain, tab aap partial match kar sakte hain, matlab aapko woh records bhi milenge jinke andar aapka search term shamil hai.EXAMPLE--- > SELECT * FROM `user_login` WHERE `fname` LIKE '%John%';

$fetch = mysqli_query($conn, $query);

$data = array();
if ($fetch && mysqli_num_rows($fetch) > 0) {
    while ($row = mysqli_fetch_assoc($fetch)) {
        $data[] = $row;
    }
    $response['data'] = $data;//Fetch kiye gaye records ko data array me store kiya
}

// Query to get the total number of matching records
// sare records fetch kiye database se
$total_records_query = "
    SELECT COUNT(*) AS total
    FROM user_login AS u
    INNER JOIN blog AS b ON u.id = b.user_id 
    WHERE u.fname LIKE '%{$search_term_escaped}%' 
    OR u.lname LIKE '%{$search_term_escaped}%'
    OR b.title LIKE '%{$search_term_escaped}%'";
$total_records_result = mysqli_query($conn, $total_records_query);
$total_records = mysqli_fetch_assoc($total_records_result)['total'] ?? 0;//Total records ko fetch karte hain aur agar koi result na ho to default 0 set karte hain.

// Calculate the total number of pages
$total_pages = ceil($total_records / $records_per_page); // 19/9=2.111 //ceil(2.111)=3 //3 pages honge browser me

// Generate pagination HTML
$pagination = '<nav><ul class="pagination">';
for ($i = 1; $i <= $total_pages; $i++) {
    $active = ($i == $page) ? 'active' : '';
    $pagination .= '<li class="page-item ' . $active . '"><a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
}
$pagination .= '</ul></nav>';

$response['pagination'] = $pagination;

// header('Content-Type: application/json');
echo json_encode($response);






// $query="SELECT u.id,u.fname,u.lname,u.contact,u.email,u.password,b.post_id ,b.title,b.content,b.date  FROM user_login as u inner join blog as b on u.id = b.post_id";
// $query="SELECT * FROM blog"; 
// $query"SELECT u.id,u.fname,u.lname,u.contact,u.email,u.password,b.user_id ,b.title,b.content,b.date  FROM user_login as u inner join blog as b on u.id = b.user_id";

// $query="SELECT u.id,u.fname,u.lname,u.contact,b.post_id,b.user_id ,b.title,b.content,b.date  FROM user_login as u inner join blog as b on u.id = b.user_id";
// $fetch=mysqli_query($conn,$query);
// if(mysqli_num_rows($fetch)>0){
//   $data=array(); //array me data dal diya araay ko data variable me dal diya 
//   while($row=mysqli_fetch_assoc($fetch)){
//     $data[] = $row;
//   }
// }
// echo json_encode($data); die;

?>