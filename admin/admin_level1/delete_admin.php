
<?php
include "inc/connect.php";

if (isset($_GET['delete_admin'])) {
    $user_id = $_GET['delete_admin'];
    
    echo "<script>
        var confirmDelete = confirm('Are you sure you want to delete this Agent?');
        if (confirmDelete) {
            window.location.href = 'delete_admin.php?confirmed_delete=$user_id';
        } else {
            window.location.href = 'index_L1.php?view_admin_L1';
        }
    </script>";
}

if (isset($_GET['confirmed_delete'])) {
    $user_id = $_GET['confirmed_delete'];
    
    $delete_prod = "DELETE FROM `admins` WHERE id=$user_id";
    $result_del = mysqli_query($conn, $delete_prod);

    if ($result_del) {
        echo "<script>alert('Agent deleted successfully!')</script>";
        echo "<script>window.open('index_L1.php?view_admin_L1','_self')</script>";
    } else {
        echo "<script>alert('Error deleting agent.')</script>";
        echo "<script>window.open('index_L1.php?view_admin_L1','_self')</script>";
    }
}
?>
