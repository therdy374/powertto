
<?php
include "inc/connect.php";


if (isset($_GET['deposit_delete_users'])) {
    $user_id = $_GET['deposit_delete_users'];
    
    echo "<script>
        var confirmDelete = confirm('Are you sure you want to delete this list deposit');
        if (confirmDelete) {
            window.location.href = 'deposit_delete_users.php?confirmed_delete=$user_id';
        } else {
            window.location.href = 'index.php?deposit_users';
        }
    </script>";
}

if (isset($_GET['confirmed_delete'])) {
    $user_id = $_GET['confirmed_delete'];
    
    $delete_prod = "DELETE FROM `deposit_mgt` WHERE id=$user_id";
    $result_del = mysqli_query($conn, $delete_prod);

    if ($result_del) {
        echo "<script>alert('Deposit user deleted successfully!')</script>";
        echo "<script>window.open('index.php?deposit_users','_self')</script>";
    } else {
        echo "<script>alert('Error deleting agent.')</script>";
        echo "<script>window.open('index.php?deposit_users','_self')</script>";
    }
}
?>