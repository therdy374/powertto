<!-- Table Start -->
<style>
    table.dataTable tbody th,
    table.dataTable tbody td {
        padding: 8px 10px;
        display: absolute;
        width: 150px;
    }

    table.dataTable th,
    table.dataTable td {
        box-sizing: content-box;
    }

    .table-bordered>:not(caption)>*>* {
        border-width: 3px 1px;
    }

    .table>:not(caption)>*>* {
        padding: .5rem .5rem;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }

    thead,
    tbody,
    tfoot,
    tr,
    td,
    th {
        border-color: inherit;
        border-style: solid;
        border-width: 0;
    }
</style>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 p-4">
                <!-- <h6 class="mb-4 text-left text-primary">관리자 목록 USERS Affiliated
                    <a href="index_L3.php?view_admin" class="btn btn-primary float-end">BACK</a>
                </h6><br> -->
                <?php
                if (isset($_GET['users_affiliated'])) {
                    $user_id = $_GET['users_affiliated'];
                ?>
                    <h6 class="mb-4 text-left text-primary">
                        Users Affiliated of code: <?php echo $_SESSION['referal_code']; ?>
                        <a href="index_L3.php?view_admin_L3" class="btn btn-primary float-end">BACK</a>
                    </h6>
                    <br>
                <?php
                } else {
                    echo '<h6 class="mb-4 text-left text-primary">Users Affiliated <a href="index.php?view_admin_L4" class="btn btn-primary float-end">BACK</a></h6><br>';
                }
                ?>

                <div class="table-responsive text-center">
                    <table class="table table-bordered text-white text-center" style="font-size: small;" id="myTable">
                        <thead>
                            <tr>
                                <th>SI No</th>
                                <th>USER ID</th>
                                <th>Referal Code #</th>
                                <th>User Credit</th>
                                <th>Total Daily Payment</th>
                                <th>Total Weekly Payment</th>
                                <th>Total Monthly Payment</th>
                                <th>Account Status</th>
                                <th>Date Created</th>
                                <!-- <th>View</th>
                                <th>Delete</th> -->
                            </tr>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            // if (isset($_GET['users_affiliated'])) {
                            //     $user_id = $_GET['users_affiliated'];
                            $referal_code = $_SESSION['referal_code'];

                                $sql = "SELECT * FROM users WHERE referal_code = '$referal_code'";
                                $result_query = $conn->query($sql);

                                $today_date = date('Y-m-d');
                                $start_of_week = date('Y-m-d', strtotime('last Monday', strtotime($today_date)));
                                $start_of_month = date('Y-m-01', strtotime($today_date));

                                while ($run_query = mysqli_fetch_array($result_query)) {
                                    $id = $run_query['id'];
                                    $userid = $run_query['userid'];
                                    $referal_code = $run_query['referal_code'];
                                    $credit = $run_query['credit'];
                                    $created_at = $run_query['created_at'];

                                    // Query to sum payments for the current date for the given userid and referral_code
                                    $sum_daily_query = "SELECT SUM(payment) as total_daily_payment 
                                    FROM user_purchases 
                                    WHERE username = '$userid' 
                                    AND referal_code = '$referal_code' 
                                    AND DATE(date_purchase) = '$today_date'";

                                    // Query to sum payments for the current week for the given userid and referral_code
                                    $sum_weekly_query = "SELECT SUM(payment) as total_weekly_payment 
                                    FROM user_purchases 
                                    WHERE username = '$userid' 
                                    AND referal_code = '$referal_code' 
                                    AND DATE(date_purchase) >= '$start_of_week'";

                                    // Query to sum payments for the current month for the given userid and referral_code
                                    $sum_monthly_query = "SELECT SUM(payment) as total_monthly_payment 
                                    FROM user_purchases 
                                    WHERE username = '$userid' 
                                    AND referal_code = '$referal_code' 
                                    AND DATE(date_purchase) >= '$start_of_month'";

                                    $check_daily_sum = mysqli_query($conn, $sum_daily_query);
                                    $check_weekly_sum = mysqli_query($conn, $sum_weekly_query);
                                    $check_monthly_sum = mysqli_query($conn, $sum_monthly_query);

                                    // Fetch the total daily payment
                                    $tot_daily_pay = mysqli_fetch_assoc($check_daily_sum);
                                    $total_daily_payment = $tot_daily_pay['total_daily_payment'] ?? 0;

                                    // Fetch the total weekly payment
                                    $tot_weekly_pay = mysqli_fetch_assoc($check_weekly_sum);
                                    $total_weekly_payment = $tot_weekly_pay['total_weekly_payment'] ?? 0;

                                    // Fetch the total monthly payment
                                    $tot_monthly_pay = mysqli_fetch_assoc($check_monthly_sum);
                                    $total_monthly_payment = $tot_monthly_pay['total_monthly_payment'] ?? 0;

                            ?>
                                    <tr class='text-center'>
                                        <td><?php echo $id ?></td>
                                        <td><?php echo $userid ?></td>
                                        <td><?php echo $referal_code ?></td>
                                        <td><?php echo number_format($credit) ?> ₩</td>
                                        <td><?php echo number_format($total_daily_payment) ?> ₩</td>
                                        <td><?php echo number_format($total_weekly_payment) ?> ₩</td>
                                        <td><?php echo number_format($total_monthly_payment) ?> ₩</td>
                                        <td>
                                            <?php
                                            if ($run_query['is_ban'] == 1) {
                                                echo '<span class="badge bg-danger">Banned</span>';
                                            } else {
                                                echo '<span class="badge bg-success">Active</span>';
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $created_at ?></td>
                                    </tr>
                            <?php
                                }
                         
                            ?>

                        </tbody>


                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Table End -->