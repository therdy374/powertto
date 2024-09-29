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

                <?php
                if (isset($_GET['commission_agent_list'])) {
                    $user_id = $_GET['commission_agent_list'];
                ?>
                    <h6 class="mb-4 text-left text-primary">
                        Users Affiliated of code: <?php echo htmlspecialchars($user_id); ?>
                        <a href="index.php?commission_history" class="btn btn-primary float-end">BACK</a>
                    </h6>
                    <br>
                <?php
                } else {
                    echo '<h6 class="mb-4 text-left text-primary">Agent Commission List <a href="index.php?commission_history" class="btn btn-primary float-end">BACK</a></h6><br>';
                }
                ?>


                <div class="table-responsive text-center">
                    <table class="table table-bordered text-white text-center" style="font-size: small;" id="myTable">
                        <thead>
                            <tr>
                                
                                <th>USER ID</th>
                                <th>Referal Code #</th>
                                <th>Total Daily Payment</th>
                                <th>Total Weekly Payment</th>
                                <th>Total Monthly Payment</th>
                                <th>Date Transaction</th>
                                
                            </tr>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (isset($_GET['commission_agent_list'])) {
                                $user_id = $_GET['commission_agent_list'];

                                $sql = "SELECT * FROM commission_history WHERE referal_code = '$user_id' LIMIT 1";
                                $result_query = $conn->query($sql);

                                $today_date = date('Y-m-d');
                                $start_of_week = date('Y-m-d', strtotime('last Monday', strtotime($today_date)));
                                $start_of_month = date('Y-m-01', strtotime($today_date));

                                while ($run_query = mysqli_fetch_array($result_query)) {
                                    $id = $run_query['id'];
                                    $name = $run_query['name'];
                                    $referal_code = $run_query['referal_code'];
                                    // $credit = $run_query['credit'];
                                    $created_at = $run_query['date_transaction'];

                                    // Query to sum payments for the current date for the given userid and referral_code
                                    $sum_daily_query = "SELECT SUM(admin_comm) as total_daily_payment 
                                    FROM commission_history 
                                    WHERE name ='$name'
                                    AND referal_code = '$referal_code' 
                                    AND DATE(date_transaction) = '$today_date'";

                                    // Query to sum payments for the current week for the given userid and referral_code
                                    $sum_weekly_query = "SELECT SUM(admin_comm) as total_weekly_payment 
                                    FROM commission_history 
                                    WHERE name = '$name' 
                                    AND referal_code = '$referal_code' 
                                    AND DATE(date_transaction) >= '$start_of_week'";

                                    // Query to sum payments for the current month for the given userid and referral_code
                                    $sum_monthly_query = "SELECT SUM(admin_comm) as total_monthly_payment 
                                    FROM commission_history 
                                    WHERE name = '$name' 
                                    AND referal_code = '$referal_code' 
                                    AND DATE(date_transaction) >= '$start_of_month'";

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
                                       
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $referal_code ?></td>
                                       
                                        <td><?php echo number_format($total_daily_payment, 2) ?> ₩</td>
                                        <td><?php echo number_format($total_weekly_payment, 2) ?> ₩</td>
                                        <td><?php echo number_format($total_monthly_payment, 2) ?> ₩</td>
                                       
                                        <td><?php echo $created_at ?></td>
                                    </tr>
                            <?php
                                }
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