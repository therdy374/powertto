
<?php
include "inc/connect.php";

// if (isset($_GET['delete_user'])) {
//     $user_id = $_GET['delete_user'];

//     $delete_prod = "delete from `users` where id=$user_id";
//     $result_del = mysqli_query($conn, $delete_prod);

//     if ($result_del) {
       
//         echo "<script>alert('Are you sure you want to delete this user!')</script>";
//         echo "<script>window.open('index.php?view_users','_self')</script>";
//     }
// }
if (isset($_GET['delete_user'])) {
    $user_id = $_GET['delete_user'];
    
    echo "<script>
        var confirmDelete = confirm('Are you sure you want to delete this Users?');
        if (confirmDelete) {
            window.location.href = 'delete_user.php?confirmed_delete=$user_id';
        } else {
            window.location.href = 'index.php?view_users';
        }
    </script>";
}

if (isset($_GET['confirmed_delete'])) {
    $user_id = $_GET['confirmed_delete'];
    
    $delete_prod = "DELETE FROM `admins` WHERE id=$user_id";
    $result_del = mysqli_query($conn, $delete_prod);

    if ($result_del) {
        echo "<script>alert('Agent deleted successfully!')</script>";
        echo "<script>window.open('index.php?view_users','_self')</script>";
    } else {
        echo "<script>alert('Error deleting agent.')</script>";
        echo "<script>window.open('index.php?view_users','_self')</script>";
    }
}
?>