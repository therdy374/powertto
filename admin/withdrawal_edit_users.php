<?php
include "./inc/connect.php";

if (isset($_GET['withdrawal_edit_users'])) {

    $user_id = $_GET['withdrawal_edit_users'];

    $select_query = "Select * from `users_withdrawal` where id='$user_id'";
    $result_query = mysqli_query($conn, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);

    $name = $row_fetch['name'];
    $user_id1 = $row_fetch['user_id'];
    $amount_withdrawal = $row_fetch['amount_withdrawal'];

    if (isset($_POST['user_withdrawal'])) {

        $admin_id = $_SESSION['id'];    

        $name = $_POST['name'];
        $user_id1 = $_POST['user_id'];
        $amount_withdrawal = $_POST['amount_withdrawal'];


        if ($name == '' || $amount_withdrawal == '') {
            echo "<script>alert('Please fill all the fields requierd')</script>";
        } 
        else {
            // user query
            $sql2 = "UPDATE `users` SET `credit` = '$amount_withdrawal' WHERE `id` = $user_id1";
            $res_query = mysqli_query($conn, $sql2);

            $query = "DELETE FROM `users_withdrawal` WHERE `id` = '$user_id';";
            $res_query = mysqli_query($conn, $query);

            $user_update = "INSERT INTO deposit_mgt (name, user_id, amount_withdrawal) VALUES ( '$name','$user_id1','$amount_withdrawal')";
            $result_query_update = mysqli_query($conn, $user_update);

            // admin query
            $admin_query = "SELECT admin_credit FROM admins where id = $admin_id";
            $query_run = mysqli_query($conn, $admin_query);

            while ($run_query = mysqli_fetch_array($query_run)) {
                $admin_credit = $run_query['admin_credit'];
            }

            $initialBalance = $admin_credit;
            $finalBalance = $initialBalance - $amount_withdrawal;

            $update_admin_credit = "UPDATE `admins` SET `admin_credit` = '$finalBalance' where id = $admin_id";
            $res_query = mysqli_query($conn, $update_admin_credit);
            // end admin query
    
            if ($result_query_update) {

                echo '<script>alert("Users Withdrawal completed!\n Admin Balance!\n ' . $finalBalance . ' ")</script>';
                echo "<script>window.open('index.php?deposit_users','_self')</script>";
            }
            else{
                echo "<script>alert('Oppss may mali!')</script>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdrawal Update</title>
</head>

<body>
    <div class="col-md-12 col-xl-12">
        <div class="bg-secondary rounded h-100 p-4">
        <div>
                <h6 class="mb-4 text-primary">USERS WITHDRAWAL REQUEST
                        <a href="index.php?view_users_withdrawal" class="btn btn-primary btn-sm float-end">Back</a>
                    </h6>
                </div>
            <!-- <h6 class="mb-4 text-center text-primary">Users Withdrawal Account</h6> -->
            
            <form action="" method="POST" class="mb-2">
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo $user_id; ?>" class="form-control" />
                    <input type="hidden" name="user_id" value="<?php echo $user_id1; ?>" class="form-control" />
                    <div class="col-md-6 mb-3">
                        <label for="">Name *</label>
                        <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Withdrawal Amount *</label>
                        <input type="text" name="amount_withdrawal" value="<?php echo number_format($amount_withdrawal); ?>" class="form-control" />
                    </div>
                </div>
                <!-- <button type="submit" name="user_update" class="btn btn-primary">Save</button> -->
                <input type="submit" value="Update Withdrawal" name="user_withdrawal" class="bg-primary border-0 rounded py-2 px-3 text-light">
            </form>
        </div>
    </div>
</body>

</html>