<?php
date_default_timezone_set('Asia/Manila');

require './config/function.php';
// require 'authentication.php';

if (isset($_POST['btn_purchase'])) {

    $u_num = validate($_POST['name']);
    $u_num1 = validate($_POST['user_id']);
    $u_num2 = validate($_POST['whiteballs']);
    $u_num3 = validate($_POST['powerball']);
    $u_num4 = validate($_POST['payment']);
    $u_num5 = validate($_POST['winning_amount']);


    $query = "SELECT credit FROM users where id = $u_num1";
    $query_run = mysqli_query($conn, $query);

    if (!empty($u_num1) && !empty($u_num2) && !empty($u_num3) && !empty($u_num4) && !empty($u_num5)) {

        while ($run_query = mysqli_fetch_array($query_run)) {
            $credit = $run_query['credit'];
            // $name = $run_query['name'];
        }
        $initialBalance = $credit;
        $finalBalance = $initialBalance - $u_num4;

        if ($credit == 0) {
            redirect('number_list.php', 'Sorry! Please Reload your balance!');
        } else if ($credit <= 50000) {
            redirect('number_list.php', 'Your balance is not enough! Please Reload your balance!');
        }

        $sql = "INSERT INTO user_purchases (username, user_id, selected_numbers, powerballs, payment, winning_amount, modes)
        VALUES ('$u_num','$u_num1', '$u_num2', '$u_num3', '$u_num4', '$u_num5', '$selectedMode')";

        $sql2 = "UPDATE `users` SET `credit`='$finalBalance' WHERE id = $u_num1";
        $res_query = mysqli_query($conn, $sql2);

        // winning price update to be edit
        $query1 = "SELECT * FROM winning_price";
        $query_run = mysqli_query($conn, $query1);

        $qty = 0;
        $newDate = date('Y-m-d H:i:s');

        while ($num = mysqli_fetch_assoc($query_run)) {
            $qty =  $num['total_price'];
            $total = $qty + 35000;
        }

        $query2 = "UPDATE `winning_price` SET `total_price` = '$total', `price_date` = '$newDate'";
        $query_run2 = mysqli_query($conn, $query2);


        // admin payment update
        $query3 = "SELECT * FROM admins";
        $query_run3 = mysqli_query($conn, $query3);

        $admin_credit = 0;
        while ($num = mysqli_fetch_assoc($query_run3)) {
            $admin_credit =  $num['admin_credit'];
            $tot = $admin_credit + 15000;
        }
        $query = "UPDATE `admins` SET `admin_credit`= $tot";
        $query_run2 = mysqli_query($conn, $query);

    
        if ($conn->query($sql) === TRUE) {

            redirect('number_list.php', 'Congratulations your lucky number will be place!\n' . 'Your Balance now is ₩' . number_format($finalBalance));
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        
    } else {
        redirect('number_list.php', 'Please select your number!');
    }
}
