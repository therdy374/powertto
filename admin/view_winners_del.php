
<?php
include "inc/connect.php";

if (isset($_GET['view_winners_del'])) {
    $user_id = $_GET['view_winners_del'];

    $delete_prod = "delete from `winners_participants` where id=$user_id";
    $result_del = mysqli_query($conn, $delete_prod);

    if ($result_del) {
       
        echo "<script>alert('Are you sure you want to delete this user!')</script>";
        echo "<script>window.open('index.php?view_winners','_self')</script>";
    }
}
?>