
<?php
include "inc/connect.php";


if (isset($_GET['delete_logs'])) {
    $user_id = $_GET['delete_logs'];
    
    echo "<script>
            var confirmDelete = confirm('Are you sure you want to delete this logs of user?');
            if (confirmDelete) {
                window.location.href = 'delete_logs.php?confirmed_delete=$user_id';
            } else {
                window.location.href = 'index.php?all_logs';
            }
        </script>";
}

if (isset($_GET['confirmed_delete'])) {
    $user_id = $_GET['confirmed_delete'];
    
    $delete_prod = "DELETE FROM `login_logs` WHERE id=$user_id";
    $result_del = mysqli_query($conn, $delete_prod);

    if ($result_del) {
        echo "<script>alert('logs of user deleted successfully!')</script>";
        echo "<script>window.open('index.php?all_logs','_self')</script>";
    } else {
        echo "<script>alert('Error deleting agent.')</script>";
        echo "<script>window.open('index.php?all_logs','_self')</script>";
    }
}
?>
