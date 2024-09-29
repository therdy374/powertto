<?php
include "inc/header.php";

?>

<!-- Content Start -->
<div class="content">
    <?php include "inc/navbar.php"; ?>

    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">


        <div class="row g-4">

            <!-- everyday prize -->
            <?php
            date_default_timezone_set('Asia/Seoul');

            $get_users = "SELECT *, SUM(payment) AS total_payment_amount FROM user_purchases GROUP BY DATE(date_purchase) ORDER BY `date_purchase` ASC";
            $result_query = mysqli_query($conn, $get_users);

            $previous_date = null; // Initialize variable to keep track of previous date
            $total_prize = 0; // Initialize total payment

            while ($run_query = mysqli_fetch_array($result_query)) {
                $date_purchase = date('Y.m.d (D)', strtotime($run_query['date_purchase']));

                // If previous_date is null or if current date is different from previous date, reset total_payment
                if ($previous_date === null || date('Y-m-d', strtotime($previous_date)) != date('Y-m-d', strtotime($run_query['date_purchase']))) {
                    $total_prize = 0;
                }

                $total_prize += $run_query['total_payment_amount']; // Add current day's payment to total_payment
                $previous_date = $run_query['date_purchase']; // Update previous date
            }
            ?>
            <div class="col-sm-12 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">1일 합계</p>
                        <h6 class="mb-0"><?php echo number_format($total_prize); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <!-- everyday payment -->
            <?php
            date_default_timezone_set('Asia/Seoul');

            $get_users = "SELECT *, SUM(winning_amount) AS total_prize_amount FROM user_purchases GROUP BY DATE(date_purchase) ORDER BY `date_purchase` ASC";
            $result_query = mysqli_query($conn, $get_users);

            $previous_date = null; // Initialize variable to keep track of previous date
            $total_payment = 0; // Initialize total payment

            while ($run_query = mysqli_fetch_array($result_query)) {
                $date_purchase = date('Y.m.d (D)', strtotime($run_query['date_purchase']));

                // If previous_date is null or if current date is different from previous date, reset total_payment
                if ($previous_date === null || date('Y-m-d', strtotime($previous_date)) != date('Y-m-d', strtotime($run_query['date_purchase']))) {
                    $total_payment = 0;
                }

                $total_payment += $run_query['total_prize_amount']; // Add current day's payment to total_payment
                $previous_date = $run_query['date_purchase']; // Update previous date
            }
            ?>
            <div class="col-sm-12 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">1일 총상금</p>
                        <h6 class="mb-0"><?php echo number_format($total_payment); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <!-- everyday commission -->
            <?php
            date_default_timezone_set('Asia/Seoul');

            $get_users = "SELECT *, SUM(admin_fee) AS total_commi_amount FROM admins_fee GROUP BY DATE(date_purchase) ORDER BY `date_purchase` ASC";
            $result_query = mysqli_query($conn, $get_users);

            $previous_date = null; // Initialize variable to keep track of previous date
            $total_commi = 0; // Initialize total payment

            while ($run_query = mysqli_fetch_array($result_query)) {
                $date_purchase = date('Y.m.d (D)', strtotime($run_query['date_purchase']));

                // If previous_date is null or if current date is different from previous date, reset total_payment
                if ($previous_date === null || date('Y-m-d', strtotime($previous_date)) != date('Y-m-d', strtotime($run_query['date_purchase']))) {
                    $total_commi = 0;
                }

                $total_commi += $run_query['total_commi_amount']; // Add current day's payment to total_payment
                $previous_date = $run_query['date_purchase']; // Update previous date
            }
            ?>
            <div class="col-sm-12 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">1일 수수료</p>
                        <h6 class="mb-0"><?php echo number_format($total_commi); ?> ₩</h6>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <div class="row g-4">
            <?php
            $referal_codes = $_SESSION['referal_code'];

            $query = "SELECT SUM(admin_comm) AS total_admin_fee FROM commission_history WHERE referal_code = '$referal_codes'";
            $query_run = mysqli_query($conn, $query);

            $total_admin_fee = 0;

            if ($run_query = mysqli_fetch_array($query_run)) {
                $total_admin_fee = $run_query['total_admin_fee'];
            }
            ?>
            <!-- Admin Balance -->
            <div class="col-sm-12 col-xl-4">
                <!-- <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">Total Code: <span class="text-primary"><?php echo $_SESSION['referal_code']; ?></span> Commision</p>
                        <h6 class="mb-0" style="text-align: right;"><?php echo number_format($total_admin_fee); ?> ₩</h6>
                    </div>
                </div> -->
            </div>

            <div class="col-sm-12 col-xl-4">
            </div>

            <div class="col-sm-12 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">Total Code:<span class="text-primary"><?php echo $_SESSION['referal_code']; ?></span> Commision</p>
                        <h6 class="mb-0" style="text-align: right;"><?php echo number_format($total_admin_fee); ?> ₩</h6>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- 2nd child -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">

                <?php

                if (isset($_GET['codeWinners'])) {
                    include('codeWinners.php');
                }


                // deposit user under referl_code
                if (isset($_GET['user_deposit_request4'])) {
                    include('user_deposit_request4.php');
                }
                // end deposit

                if (isset($_GET['new_ListPurchase'])) {
                    include('new_ListPurchase.php');
                }

                if (isset($_GET['new_subscriber'])) {
                    include('new_subscriber.php');
                }

                if (isset($_GET['my_profile'])) {
                    include('my_profile.php');
                }

                if (isset($_GET['dashboard'])) {
                    include('dashboard.php');
                }

                if (isset($_GET['users_credit'])) {
                    include('users_credit.php');
                }



                // Daily List Fee
                if (isset($_GET['daily_details_fee'])) {
                    include('daily_details_fee.php');
                }

                // Daily Prize Fee
                if (isset($_GET['daily_prize_fee'])) {
                    include('daily_prize_fee.php');
                }

                // winning_numbers
                if (isset($_GET['winning_numbers'])) {
                    include('winning_numbers.php');
                }
                if (isset($_GET['winning_numbers_update'])) {
                    include('winning_numbers_update.php');
                }
                if (isset($_GET['delete_draw_numbers'])) {
                    include('delete_draw_numbers.php');
                }

                // view_users
                if (isset($_GET['view_users'])) {
                    include('view_users.php');
                }
                if (isset($_GET['view_edit_users'])) {
                    include('view_edit_users.php');
                }
                if (isset($_GET['delete_user'])) {
                    include('delete_user.php');
                }


                // list_user_purchase
                if (isset($_GET['list_user_purchase'])) {
                    include('list_user_purchase.php');
                }
                if (isset($_GET['list_edit_user'])) {
                    include('list_edit_user.php');
                }
                if (isset($_GET['delete_list_user'])) {
                    include('delete_list_user.php');
                }

                // deposit user
                if (isset($_GET['user_deposit_request'])) {
                    include('user_deposit_request.php');
                }

                if (isset($_GET['deposit_users'])) {
                    include('deposit_users.php');
                }
                if (isset($_GET['deposit_edit_users'])) {
                    include('deposit_edit_users.php');
                }
                if (isset($_GET['deposit_delete_users'])) {
                    include('deposit_delete_users.php');
                }

                if (isset($_GET['user_deposit_update'])) {
                    include('user_deposit_update.php');
                }

                // users withdrawal
                if (isset($_GET['users_request_withdrawal'])) {
                    include('users_request_withdrawal.php');
                }

                if (isset($_GET['withdrawal_edit_users'])) {
                    include('withdrawal_edit_users.php');
                }

                if (isset($_GET['users_process_withdrawal'])) {
                    include('users_process_withdrawal.php');
                }

                if (isset($_GET['view_users_withdrawal'])) {
                    include('view_users_withdrawal.php');
                }
                // comparetable
                if (isset($_GET['comparetable'])) {
                    include('comparetable.php');
                }

                if (isset($_GET['update_winners'])) {
                    include('update_winners.php');
                }

                if (isset($_GET['payment_history'])) {
                    include('payment_history.php');
                }

                // user inquiries
                if (isset($_GET['users_inquiries'])) {
                    include('users_inquiries.php');
                }

                if (isset($_GET['users_process_inquiries'])) {
                    include('users_process_inquiries.php');
                }

                if (isset($_GET['delete_inquiries'])) {
                    include('delete_inquiries.php');
                }

                // announcement
                if (isset($_GET['announcement'])) {
                    include('announcement.php');
                }
                if (isset($_GET['update_announcement'])) {
                    include('update_announcement.php');
                }
                if (isset($_GET['delete_announcement'])) {
                    include('delete_announcement.php');
                }

                // Terms & Condition
                if (isset($_GET['terms_condition'])) {
                    include('terms_condition.php');
                }
                if (isset($_GET['update_terms'])) {
                    include('update_terms.php');
                }

                if (isset($_GET['users_affiliated'])) {
                    include('users_affiliated.php');
                }

                if (isset($_GET['delete_admin'])) {
                    include('delete_admin.php');
                }

                if (isset($_GET['admin_edit'])) {
                    include('admin_edit.php');
                }

                if (isset($_GET['view_admin'])) {
                    include('view_admin.php');
                }
                // admins Fee
                if (isset($_GET['admins_fee'])) {
                    include('admins_fee.php');
                }

                // Level Admin
                if (isset($_GET['view_admin_L1'])) {
                    include('view_admin_L1.php');
                }
                if (isset($_GET['view_admin_L2'])) {
                    include('view_admin_L2.php');
                }
                if (isset($_GET['view_admin_L3'])) {
                    include('view_admin_L3.php');
                }
                if (isset($_GET['view_admin_L4'])) {
                    include('view_admin_L4.php');
                }
                if (isset($_GET['view_admin_L5'])) {
                    include('view_admin_L5.php');
                }


                ?>
            </div>
        </div>
    </div>

    <?php include "inc/footer.php"; ?>