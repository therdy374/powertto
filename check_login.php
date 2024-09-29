<?php 
session_start();

require "config/dbcon.php";

$query = "SELECT verify_token FROM users WHERE id = '".$_SESSION['loggedInUser']['user_id']."'";
$result = mysqli_query($conn, $query);

foreach($result as $row){
    if($_SESSION['loggedInUser']['verify_token'] != $row['verify_token']){
        $data['output']='logout';
    }else{
        $data['output']='login';
    }
}
echo json_encode($data);



?>