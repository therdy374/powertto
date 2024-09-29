
<?php
include "inc/connect.php";


if (isset($_GET['admin_delete_withdrawals'])) {
    $user_id = $_GET['admin_delete_withdrawals'];
    
    echo "<script>
        var confirmDelete = confirm('Are you sure you want to delete this withdrawal of user?');
        if (confirmDelete) {
            window.location.href = 'admin_delete_withdrawals.php?confirmed_delete=$user_id';
        } else {
            window.location.href = 'index.php?view_users_withdrawal';
        }
    </script>";
}

if (isset($_GET['confirmed_delete'])) {
    $user_id = $_GET['confirmed_delete'];
    
    $delete_prod = "DELETE FROM `users_withdrawal` WHERE id=$user_id";
    $result_del = mysqli_query($conn, $delete_prod);

    if ($result_del) {
        echo "<script>alert('Withdrawal of user deleted successfully!')</script>";
        echo "<script>window.open('index.php?view_users_withdrawal','_self')</script>";
    } else {
        echo "<script>alert('Error deleting agent.')</script>";
        echo "<script>window.open('index.php?view_users_withdrawal','_self')</script>";
    }
}
?>
