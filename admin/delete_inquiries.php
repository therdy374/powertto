
<?php
include "inc/connect.php";

if (isset($_GET['delete_inquiries'])) {
    $user_id = $_GET['delete_inquiries'];
    
    // echo $delete_id;

    $delete_prod = "delete from `customer_service` where id=$user_id";
    $result_del = mysqli_query($conn, $delete_prod);
    // $row=mysqli_fetch_assoc($result_del);
   // echo $row;

    if ($result_del) {
        // $username=$row['user_username'];
        echo "<script>alert('Are you sure you want to delete this inquiries!')</script>";
        echo "<script>window.open('index.php?users_inquiries','_self')</script>";
    }
}
?>