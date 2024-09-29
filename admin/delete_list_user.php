
<?php
include "inc/connect.php";


if (isset($_GET['delete_list_user'])) {
    $user_id = $_GET['delete_list_user'];
    
    echo "<script>
        var confirmDelete = confirm('Are you sure you want to delete this purchase of user?');
        if (confirmDelete) {
            window.location.href = 'delete_list_user.php?confirmed_delete=$user_id';
        } else {
            window.location.href = 'index.php?list_user_purchase';
        }
    </script>";
}

if (isset($_GET['confirmed_delete'])) {
    $user_id = $_GET['confirmed_delete'];
    
    $delete_prod = "DELETE FROM `user_purchases` WHERE id=$user_id";
    $result_del = mysqli_query($conn, $delete_prod);

    if ($result_del) {
        echo "<script>alert('Purchase of user deleted successfully!')</script>";
        echo "<script>window.open('index.php?list_user_purchase','_self')</script>";
    } else {
        echo "<script>alert('Error deleting agent.')</script>";
        echo "<script>window.open('index.php?list_user_purchase','_self')</script>";
    }
}
?>