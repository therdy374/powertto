<?php
include "inc/connect.php";

if (isset($_GET['delete_announcement'])) {

    $id = $_GET['delete_announcement'];

    $delete_prod = "delete from `announcement` where id = $id";
    $result_del = mysqli_query($conn, $delete_prod);

    if ($result_del) {
       
        echo "<script>alert('Are you sure you want to delete this announcement!')</script>";
        echo "<script>window.open('index.php?announcement','_self')</script>";
    }
}
?>