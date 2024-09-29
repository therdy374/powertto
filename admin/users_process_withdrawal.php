<?php
include "./inc/connect.php";

if (isset($_GET['users_process_withdrawal'])) {

    $user_id = $_GET['users_process_withdrawal'];

    $select_query = "Select * from `user_request_withdrawal` where id='$user_id'";
    $result_query = mysqli_query($conn, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);

    $name = $row_fetch['name'];
    $user_id1 = $row_fetch['user_id'];
    $bank_name = $row_fetch['bank_name'];
    $bank_acct_num = $row_fetch['bank_acct_num'];
    $credit_balance = $row_fetch['credit_balance'];
    // $amount_deposit = $row_fetch['message'];

    if (isset($_POST['user_withdrawal'])) {
        date_default_timezone_set('Asia/Seoul');
        $currentDateTime = date('Y-m-d H:i:s');

        $name = $_POST['name'];
        $user_id1 = $_POST['user_id'];
        $amount_withdrawal = $_POST['amount_withdrawal'];
        $bank_name = $row_fetch['bank_name'];
        $bank_acct_num = $row_fetch['bank_acct_num'];
        $status = $_POST['status'];

        // Remove formatting to get the actual value
        $amount_withdrawal = preg_replace('/[^\d.]/', '', $amount_withdrawal);


        if ($name == '' || $amount_withdrawal == '') {
            echo "<script>alert('Please fill all the fields requierd')</script>";
        } else {
            // user credit withdrawal query
            $users_withdraw = "SELECT credit FROM users where id = $user_id1";
            $query_run = mysqli_query($conn, $users_withdraw);

            while ($run_query = mysqli_fetch_array($query_run)) {
                $users_credit = $run_query['credit'];
            }

            $initialBalance = $users_credit;
            $finalBalance = $initialBalance - $amount_withdrawal;
            // end credit withdrawal query

            // user update new credit query
            $sql2 = "UPDATE `users` SET `credit` = '$finalBalance' WHERE `id` = '$user_id1'";
            $res_query = mysqli_query($conn, $sql2);

            $query = "DELETE FROM `user_request_withdrawal` WHERE `id` = '$user_id';";
            $res_query = mysqli_query($conn, $query);

            $sql3 = "UPDATE `user_withdrawal_request` SET `credit_balance`='$finalBalance',`status`='$status' WHERE `user_id` = '$user_id1'";
            $res_query3 = mysqli_query($conn, $sql3);

            $user_update = "INSERT INTO users_withdrawal (name, user_id, amount_withdrawal, bank_name, bank_acct_num, status, date_withdrawal) VALUES ( '$name','$user_id1','$amount_withdrawal','$bank_name','$bank_acct_num','$status','$currentDateTime')";
            $result_query_update = mysqli_query($conn, $user_update);

            if ($result_query_update) {

                echo '<script>alert("Users withdrawal is now completed!\\n Your balance now is: ' . $finalBalance . ' ")</script>';
                echo "<script>window.open('index.php?view_users_withdrawal','_self')</script>";
            } else {
                echo "<script>alert('Oppss Error Occured!')</script>";
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
    <title>Edit Account</title>
</head>

<body>
    <div class="col-md-12 col-xl-12">
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">Users Process Withdrawal
                <a href="index.php?users_request_withdrawal" class="btn btn-primary btn-sm float-end">Back</a>
            </h6>
            <form action="" method="POST" class="mb-2">
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo $user_id; ?>" class="form-control" />
                    <input type="hidden" name="user_id" value="<?php echo $user_id1; ?>" class="form-control" />
                    <input type="hidden" name="bank_name" value="<?php echo $bank_name; ?>" class="form-control" />
                    <input type="hidden" name="bank_acct_num" value="<?php echo $bank_acct_num; ?>" class="form-control" />
                    <input type="hidden" name="status" value="출금완료" class="form-control" />

                    <div class="col-md-7 mb-3">
                        <label for="">Name *</label>
                        <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" readonly />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Balance Amount *</label>
                        <input type="text" name="credit_balance" value="<?php echo number_format($credit_balance); ?> ₩" class="form-control" readonly />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Withdrawal Amount *</label>
                        <input type="text" name="amount_withdrawal" value="" class="form-control" oninput="formatNumber(this)" />
                    </div>
                </div>
                <!-- <button type="submit" name="user_update" class="btn btn-primary">Save</button> -->
                <input type="submit" value="Submit Withdrawal" name="user_withdrawal" class="bg-primary border-0 rounded py-2 px-3 text-light">
            </form>
        </div>
    </div>
    <script>
        function formatNumber(input) {

            let value = input.value.replace(/\D/g, '');
            let formattedValue = Number(value).toLocaleString();

            input.value = formattedValue;
        }
    </script>
</body>

</html>