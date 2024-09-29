<?php
include "./inc/connect.php";

date_default_timezone_set('Asia/Seoul');
$currentDateTime = date('Y-m-d H:i:s');

if (isset($_GET['deposit_edit_users'])) {
    $user_id = $_GET['deposit_edit_users'];

    $select_query = "SELECT * FROM `users_request_deposit` WHERE id='$user_id'";
    $result_query = mysqli_query($conn, $select_query);

    $row_fetch = mysqli_fetch_assoc($result_query);
    $name = $row_fetch['name'];
    $user_id1 = $row_fetch['user_id'];
    $date_message = $row_fetch['date_message'];

    if (isset($_POST['user_updated'])) {
        $admin_id = $_SESSION['id'];

        $name = $_POST['name'];
        $user_id1 = $_POST['user_id'];
        $amount_deposit = $_POST['amount_deposit'];
        $status = $_POST['status'];

        // Remove formatting to get the actual value
        $amount_deposit = preg_replace('/[^\d.]/', '', $amount_deposit);

        if ($name == '' || $amount_deposit == '') {
            echo "<script>alert('Please fill all the required fields')</script>";
        } else {
            // Update user credit
            $users_query = "SELECT credit FROM users WHERE id = $user_id1";
            $query_run = mysqli_query($conn, $users_query);
            $userBalance = mysqli_fetch_assoc($query_run)['credit'];
            $user_finalBalance = $userBalance + $amount_deposit;
            $user_sql2 = "UPDATE `users` SET `credit` = '$user_finalBalance' WHERE `id` = $user_id1";
            mysqli_query($conn, $user_sql2);

            // Update customer service using the specific date_message
            $update_cust_dep = "UPDATE `customer_service` SET `status` = '$status', `reply_message` = '$amount_deposit' WHERE `date_message` = '$date_message'";
            mysqli_query($conn, $update_cust_dep);

            // Update users_request using the specific date_message
            $users_req = "UPDATE `users_request` SET `status` = '$status' WHERE `date_message` = '$date_message'";
            mysqli_query($conn, $users_req);

            // Update users_request_deposit using the specific date_message
            $query = "DELETE FROM `users_request_deposit` WHERE `id` = '$user_id'";
            mysqli_query($conn, $query);

            // Insert into deposit_mgt
            $user_update = "INSERT INTO deposit_mgt (name, user_id, amount_deposit, status, date_deposit) VALUES ('$name','$user_id1','$amount_deposit', 'Completed', '$currentDateTime')";
            mysqli_query($conn, $user_update);

            // Update admin credit
            $admin_query = "SELECT admin_credit FROM admins WHERE id = $admin_id";
            $query_run = mysqli_query($conn, $admin_query);
            $admin_credit = mysqli_fetch_assoc($query_run)['admin_credit'];
            $finalBalance = $admin_credit - $amount_deposit;
            $update_admin_credit = "UPDATE `admins` SET `admin_credit` = '$finalBalance' WHERE id = $admin_id";
            mysqli_query($conn, $update_admin_credit);

            if ($user_update) {
                echo '<script>alert("Users deposit completed!\n Admin Balance!\\n ' . number_format($finalBalance) . ' ")</script>';
                echo "<script>window.open('index.php?deposit_users','_self')</script>";
            } else {
                echo "<script>alert('Opps something went wrong!')</script>";
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
    <title>Deposit Account</title>
</head>

<body>
    <div class="col-md-12 col-xl-12">
        <div class="bg-secondary rounded h-100 p-4">
            <div>
                <h6 class="mb-4">Participants Request Deposit
                    <a href="index.php?user_deposit_request" class="btn btn-primary btn-sm float-end">Back</a>
                </h6>
            </div>
            <div class="d-flex">
                <?php
                $date = date("Y-m-d (D)");
                echo "<span class='text-danger'>Date:  $date </span>";
                ?>
            </div><br>
            <form action="" method="POST" class="mb-2">
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo $user_id; ?>" class="form-control" />
                    <input type="hidden" name="user_id" value="<?php echo $user_id1; ?>" class="form-control" />
                    <input type="hidden" name="status" value="입금처리완료" />

                    <div class="col-md-6 mb-3">
                        <label for="">Name *</label>
                        <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" readonly />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Deposit Amount *</label>
                        <input type="text" name="amount_deposit" value="" class="form-control" oninput="formatNumber(this)" />
                    </div>
                    <script>
                        function formatNumber(input) {
                            let value = input.value.replace(/\D/g, '');
                            let formattedValue = Number(value).toLocaleString();
                            input.value = formattedValue;
                        }
                    </script>
                </div>
                <input type="submit" value="Update deposit" name="user_updated" class="bg-primary border-0 rounded py-2 px-3 text-light">
            </form>
        </div>
    </div>
</body>

</html>