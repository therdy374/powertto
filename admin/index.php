<?php
include "inc/header.php";
// include "inc/index_function.php";
?>

<!-- Content Start -->
<div class="content">
    <?php include "inc/navbar.php"; ?>

    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <?php
            $query = "SELECT * FROM deposit_mgt";
            $query_run = mysqli_query($conn, $query);

            $user_deposit = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $user_deposit +=  $num['amount_deposit'];
            }
            ?>
            <!-- User Deposit -->
            <div class="col-sm-12 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">User Deposit</p>
                        <h6 class="mb-0"><?php echo number_format($user_deposit); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            $users_withdrawal = "SELECT * FROM users_withdrawal";
            $query_run = mysqli_query($conn, $users_withdrawal);

            $total_withdrawal = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $total_withdrawal +=  $num['amount_withdrawal'];
            }
            ?>
            <!-- Total Withdrawal -->
            <div class="col-sm-12 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">Total Withdrawal</p>
                        <h6 class="mb-0" style="text-align: end;"><?php echo number_format($total_withdrawal) ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            $id = $_SESSION['id'];

            $query = "SELECT admin_credit FROM admins where id = $id";
            $query_run = mysqli_query($conn, $query);

            while ($run_query = mysqli_fetch_array($query_run)) {
                $credit = $run_query['admin_credit'];
            }
            ?>
            <!-- Admin Balance -->
            <div class="col-sm-12 col-xl-4">
               <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                   <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                   <div class="ms-3">
                       <p class="mb-2 float-end">Admin Balance</p>
                       <h6 class="mb-0"><?php echo number_format($credit); ?> ₩</h6>
                   </div>
               </div>
            </div>


            <!-- <?php
            // $query = "SELECT admin_fee FROM admins_fee";
            // $query_run = mysqli_query($conn, $query);

            // $total_admin_fee = 0;

            // while ($run_query = mysqli_fetch_array($query_run)) {
            //     $total_admin_fee += $run_query['admin_fee'];
            // }
            ?>
           
            <div class="col-sm-12 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">Admin Balance</p>
                        <h6 class="mb-0"><?php echo number_format($total_admin_fee); ?> ₩</h6>
                    </div>
                </div>
            </div> -->

            <!-- Total Payment -->
            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');
            $currentMonth = date('m', strtotime($currentDateTime));
            $currentYear = date('Y', strtotime($currentDateTime));

            $startDate = date('Y-m-01', strtotime($currentDateTime));
            $endDate = date('Y-m-t', strtotime($currentDateTime));

            $sql = "SELECT payment FROM user_purchases WHERE MONTH(date_purchase) = '$currentMonth' AND YEAR(date_purchase) = '$currentYear'";

            $query_run = mysqli_query($conn, $sql);
            $pay_monthly = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $pay_monthly += $num['payment'];
            }
            ?>
            <div class="col-sm-12 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">이번달 합계</p>
                        <h6 class="mb-0"><?php echo number_format($pay_monthly); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <!-- Total Prize -->
            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');
            $currentMonth = date('m', strtotime($currentDateTime));
            $currentYear = date('Y', strtotime($currentDateTime));

            $startDate = date('Y-m-01', strtotime($currentDateTime));
            $endDate = date('Y-m-t', strtotime($currentDateTime));

            $sql = "SELECT winning_amount FROM user_purchases WHERE MONTH(date_purchase) = '$currentMonth' AND YEAR(date_purchase) = '$currentYear'";

            $query_run = mysqli_query($conn, $sql);
            $prize_monthly = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $prize_monthly += $num['winning_amount'];
            }
            ?>
            <div class="col-sm-12 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">이번달 총상금</p>
                        <h6 class="mb-0"><?php echo number_format($prize_monthly); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <!-- Total Commission -->
            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');
            $currentMonth = date('m', strtotime($currentDateTime));
            $currentYear = date('Y', strtotime($currentDateTime));

            $startDate = date('Y-m-01', strtotime($currentDateTime));
            $endDate = date('Y-m-t', strtotime($currentDateTime));

            $sql = "SELECT admin_fee FROM admins_fee WHERE MONTH(date_purchase) = '$currentMonth' AND YEAR(date_purchase) = '$currentYear'";

            $query_run = mysqli_query($conn, $sql);
            $com_monthly = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $com_monthly += $num['admin_fee'];
            }
            ?>
            <div class="col-sm-12 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">이번 달 총 수수료</p>
                        <h6 class="mb-0" style="text-align: end;"   ><?php echo number_format($com_monthly); ?> ₩</h6>
                    </div>
                </div>
            </div>
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
                        <h6 class="mb-0" style="text-align: end;"><?php echo number_format($total_prize); ?> ₩</h6>
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
    </div>
    <!-- 2nd child -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">

                <?php

                if (isset($_GET['chatUsers'])) {
                    include('chatUsers.php');
                }

                if (isset($_GET['codeWinners'])) {
                    include('codeWinners.php');
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

                if (isset($_GET['view_admin'])) {
                    include('view_admin.php');
                }
                // admins Fee
                if (isset($_GET['admins_fee'])) {
                    include('admins_fee.php');
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

                if (isset($_GET['admin_delete_withdrawals'])) {
                    include('admin_delete_withdrawals.php');
                }

                if (isset($_GET['delete_inquiries'])) {
                    include('delete_inquiries.php');
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
                    include('./data/admin_edit.php');
                }

                // Level Admin
                if (isset($_GET['view_agent'])) {
                    include('view_agent.php');
                }

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

                if (isset($_GET['all_logs'])) {
                    include('all_logs.php');
                }

                if (isset($_GET['delete_logs'])) {
                    include('delete_logs.php');
                }

                if (isset($_GET['user_log_failed'])) {
                    include('user_log_failed.php');
                }

                if (isset($_GET['double_login'])) {
                    include('double_login.php');
                }

                if (isset($_GET['delete_double_logs'])) {
                    include('delete_double_logs.php');
                }


                if (isset($_GET['commission_history'])) {
                    include('commission_history.php');
                }

                if (isset($_GET['commission_agent_list'])) {
                    include('commission_agent_list.php');
                }

                if (isset($_GET['commission_daily'])) {
                    include('commission_daily.php');
                }



                ?>
            </div>
        </div>
    </div>

    <?php include "inc/footer.php"; ?>