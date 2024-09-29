<?php
include "inc/header.php";
// include "inc/index_function.php";
?>

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

<!-- Content Start -->
<div class="content">
    <?php include "inc/navbar.php"; ?>
    <!-- Sale & Revenue Start -->


    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <?php
            date_default_timezone_set('Asia/Seoul');

            // Get today's date
            $currentDate = date('Y-m-d');
            // Get the start of the month
            $startOfMonth = date('Y-m-01');

            // Query to get the total monthly payment
            $overall_query = "
            SELECT 
                SUM(admin_comm) AS total_monthly_payment
            FROM 
                commission_history
            
        ";
            $overall_monthly = $conn->query($overall_query);
            $overall_monthly_payment = ($overall_monthly->num_rows > 0) ? number_format($overall_monthly->fetch_assoc()['total_monthly_payment']) : '0.00';
            ?>

            <!-- Display Overall Monthly -->
            <div class="col-sm-4 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-calendar-day fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">Total Over All Monthly</p>
                        <h6 class="mb-0"><?php echo $overall_monthly_payment; ?> ₩</h6>
                    </div>
                </div>
            </div>
        </div><br>

        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-secondary rounded h-100 p-4">

                    <?php
                    if (isset($_GET['commission_agent_list'])) {
                        $user_id = $_GET['commission_agent_list'];
                    ?>
                        <h6 class="mb-4 text-left text-primary">
                            Users Affiliated of code
                            <a href="index.php?commission_history" class="btn btn-primary float-end">BACK</a>
                        </h6>
                        <br>
                    <?php
                    } else {
                        echo '<h6 class="mb-4 text-left text-primary">Agent Commission Monthly <a href="index.php?commission_history" class="btn btn-primary float-end">BACK</a></h6><br>';
                    }
                    ?>

                    <div class="table-responsive text-center">
                        <table class="table table-bordered text-white text-center" style="font-size: small;" id="myTable1">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>USER ID</th>
                                    <th>Referral Code #</th>
                                    <th>Total Monthly Payment</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                // Initialize the overall total array to store monthly totals
                                $monthly_totals = array();

                                // SQL query to sum payments for every user grouped by month
                                $sum_query = "
                                    SELECT 
                                        DATE_FORMAT(date_transaction, '%Y-%m') AS transaction_month,
                                        COALESCE(SUM(admin_comm), 0) AS total_monthly_payment
                                    FROM commission_history
                                    GROUP BY transaction_month
                                    ORDER BY transaction_month DESC
                                ";

                                // Execute the query
                                $result_query = $conn->query($sum_query);

                                // Check if the query execution was successful
                                if ($result_query) {
                                    // Loop through the results
                                    while ($run_query = $result_query->fetch_assoc()) {
                                        $transaction_month = $run_query['transaction_month'];
                                        $total_monthly_payment = isset($run_query['total_monthly_payment']) ? (float)$run_query['total_monthly_payment'] : 0.0;

                                        // Store monthly total in array
                                        $monthly_totals[$transaction_month] = $total_monthly_payment;

                                        // Get details for each user in this month
                                        $user_query = "
                                                SELECT 
                                                    name,
                                                    referal_code,
                                                    COALESCE(SUM(admin_comm), 0) AS user_total_payment
                                                FROM commission_history
                                                WHERE DATE_FORMAT(date_transaction, '%Y-%m') = '$transaction_month'
                                                GROUP BY name, referal_code
                                                ORDER BY name
                                            ";

                                        $result_users = $conn->query($user_query);

                                        if ($result_users) {
                                            while ($user_row = $result_users->fetch_assoc()) {
                                                $name = $user_row['name'];
                                                $referal_code = $user_row['referal_code'];
                                                $user_total_payment = isset($user_row['user_total_payment']) ? (float)$user_row['user_total_payment'] : 0.0;
                                ?>
                                                <tr class='text-center'>
                                                    <td><?php echo htmlspecialchars($transaction_month); ?></td>
                                                    <td data-bs-toggle="collapse" data-bs-target=".group-<?php echo htmlspecialchars($referal_code); ?>" style="cursor: pointer;">
                                                        <?php echo htmlspecialchars($name); ?>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($referal_code); ?></td>
                                                    <td><?php echo number_format($user_total_payment); ?> ₩</td>
                                                </tr>
                                                <?php

                                                // Get additional users related to this referral code
                                                $additional_users_query = "
                                                        SELECT *
                                                        FROM admins
                                                        WHERE parent_name = '{$referal_code}'
                                                        AND admin_level != 5
                                                    ";

                                                $additional_users_result = $conn->query($additional_users_query);

                                                if ($additional_users_result) {
                                                    while ($additional_user_row = $additional_users_result->fetch_assoc()) {
                                                        $username1 = $additional_user_row['username'];
                                                        $referal_code1 = $additional_user_row['referal_code'];
                                                        $total_monthly_payment1 = isset($monthly_totals[$transaction_month]) ? (float)$monthly_totals[$transaction_month] : 0.0;
                                                ?>
                                                        <tr class='text-center collapse group-<?php echo htmlspecialchars($referal_code); ?>' data-bs-parent="tbody">
                                                            <td></td>
                                                            <td class="text-primary" data-bs-toggle="collapse" data-bs-target=".group-<?php echo htmlspecialchars($referal_code1); ?>" style="cursor: pointer;">
                                                                <?php echo htmlspecialchars($username1); ?>
                                                            </td>
                                                            <td><?php echo htmlspecialchars($referal_code1); ?></td>
                                                            <td><?php echo number_format($total_monthly_payment1); ?> ₩</td>
                                                        </tr>
                                        <?php
                                                    }
                                                }
                                            }
                                        }

                                        // Display monthly total row at the bottom
                                        ?>
                                        <tr class='text-center'>
                                            <td><?php echo htmlspecialchars($transaction_month); ?></td>
                                            <td colspan="2" style="text-align: right; color:green"><strong>Total for <?php echo htmlspecialchars($transaction_month); ?>:</strong></td>
                                            <td style="text-align: left; color:green"><?php echo number_format($total_monthly_payment); ?> ₩</td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>Error executing query: " . $conn->error . "</td></tr>";
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include "inc/footer.php"; ?>