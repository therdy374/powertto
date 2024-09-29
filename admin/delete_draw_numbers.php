
<?php
include "inc/connect.php";

// if (isset($_GET['delete_draw_numbers'])) {
//     $user_id = $_GET['delete_draw_numbers'];

//     $delete_prod = "delete from `generate_numbers` where gen_id=$user_id";
//     $result_del = mysqli_query($conn, $delete_prod);

//     if ($result_del) {
       
//         echo "<script>alert('Are you sure you want to delete this draw_numbers!')</script>";
//         echo "<script>window.open('index.php?winning_numbers','_self')</script>";
//     }
// }
if (isset($_GET['delete_draw_numbers'])) {
    $user_id = $_GET['delete_draw_numbers'];
    
    echo "<script>
        var confirmDelete = confirm('Are you sure you want to delete this Draw Numbers?');
        if (confirmDelete) {
            window.location.href = 'delete_draw_numbers.php?confirmed_delete=$user_id';
        } else {
            window.location.href = 'index.php?winning_numbers';
        }
    </script>";
}

if (isset($_GET['confirmed_delete'])) {
    $user_id = $_GET['confirmed_delete'];
    
    $delete_prod = "DELETE FROM `generate_numbers` WHERE gen_id=$user_id";
    $result_del = mysqli_query($conn, $delete_prod);

    if ($result_del) {
        echo "<script>alert('Draw Numbers deleted successfully!')</script>";
        echo "<script>window.open('index.php?winning_numbers','_self')</script>";
    } else {
        echo "<script>alert('Error deleting Draw Numbers.')</script>";
        echo "<script>window.open('index.php?winning_numbers','_self')</script>";
    }
}
?>