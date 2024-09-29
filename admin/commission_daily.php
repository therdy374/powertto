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
        <!-- Total Payment -->
        <div class="row g-4">
            <?php
            date_default_timezone_set('Asia/Seoul');

            // Get today's date
            $currentDate = date('Y-m-d');
            // Get the start of the week (Monday)
            $startOfWeek = date('Y-m-d', strtotime('monday this week'));
            // Get the start of the month
            $startOfMonth = date('Y-m-01');

            // Daily Payment Query
            $daily_query = "
                    SELECT 
                        DATE(date_transaction) AS transaction_date,
                        SUM(admin_comm) AS total_daily_payment
                    FROM 
                        commission_history
                    WHERE 
                        DATE(date_transaction) = '$currentDate'
                ";
            $result_daily = $conn->query($daily_query);
            $total_daily_payment = ($result_daily->num_rows > 0) ? number_format($result_daily->fetch_assoc()['total_daily_payment'], 2) : '0.00';

            // Weekly Payment Query
            $overall_query = "
                    SELECT 
                        SUM(admin_comm) AS total_monthly_payment
                    FROM 
                        commission_history
                    WHERE 
                        DATE(date_transaction)
                ";
            $overall_weekly = $conn->query($overall_query);
            $overall_weekly_payment = ($overall_weekly->num_rows > 0) ? number_format($overall_weekly->fetch_assoc()['total_monthly_payment']) : '0.00';

            // Monthly Payment Query
            $monthly_query = "
                    SELECT 
                        SUM(admin_comm) AS total_monthly_payment
                    FROM 
                        commission_history
                    WHERE 
                        DATE(date_transaction) BETWEEN '$startOfMonth' AND '$currentDate'
                ";
            $result_monthly = $conn->query($monthly_query);
            $total_monthly_payment = ($result_monthly->num_rows > 0) ? number_format($result_monthly->fetch_assoc()['total_monthly_payment'], 2) : '0.00';
            ?>

            <!-- Display Daily Payment -->
            <div class="col-sm-4 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-calendar-day fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">오늘</p>
                        <h6 class="mb-0"><?php echo $total_daily_payment; ?> ₩</h6>
                    </div>
                </div>
            </div>

            <!-- Display Weekly Payment -->
            <!-- <div class="col-sm-4 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-calendar-week fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">이번 주</p>
                        <h6 class="mb-0"><?php echo $overall_weekly_payment; ?> ₩</h6>
                    </div>
                </div>
            </div> -->

            <!-- Display Monthly Payment -->
            <div class="col-sm-4 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-calendar-alt fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">이번 달</p>
                        <h6 class="mb-0"><?php echo $total_monthly_payment; ?> ₩</h6>
                    </div>
                </div>
            </div>
        </div><br>


        <!-- table -->
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
                        echo '<h6 class="mb-4 text-left text-primary">Agent Commission Daily <a href="index.php?commission_history" class="btn btn-primary float-end">BACK</a></h6><br>';
                    }
                    ?>


                    <div class="table-responsive">
                        <table class="table table-bordered text-white" style="font-size: small;" id="myTable1">
                            <thead>
                                <tr>
                                    <th>Date Transaction</th>
                                    <th>Admin Level / Admin ID</th>
                                    <!-- <th>Percentage</th> -->
                                    <th>Total Daily Commission</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                // Fetch unique dates and their total daily payments from the transaction table
                                $date_query = "
                                    SELECT 
                                        DATE(date_transaction) AS transaction_date,
                                        SUM(admin_comm) AS total_daily_payment
                                    FROM 
                                        commission_history
                                    GROUP BY 
                                        DATE(date_transaction)
                                    ORDER BY 
                                        transaction_date DESC
                                ";
                                $result_date = $conn->query($date_query);

                                // Check if the date query execution was successful
                                if ($result_date) {
                                    // Loop through each date
                                    while ($row_date = $result_date->fetch_assoc()) {
                                        $transaction_date = date('Y.m.d', strtotime($row_date['transaction_date']));
                                        $total_daily_payment = $row_date['total_daily_payment']; // Raw value for percentage calculation
                                        $total_daily_payment_formatted = number_format($total_daily_payment);

                                        // Display the date header
                                        echo "<tr><td colspan='4' class='text-center'><strong>{$transaction_date}</strong></td></tr>";

                                        // Fetch all admins who had transactions on the current date
                                        $admin_query = "
                                                SELECT 
                                                    name,
                                                    referal_code,
                                                    admin_level,
                                                    SUM(admin_comm) AS admin_daily_payment
                                                FROM 
                                                    commission_history
                                                WHERE 
                                                    DATE(date_transaction) = '" . $row_date['transaction_date'] . "'
                                                GROUP BY 
                                                    name, referal_code, admin_level
                                                ORDER BY 
                                                    admin_level DESC
                                            ";
                                        $result_admin = $conn->query($admin_query);

                                        if ($result_admin) {
                                            // Create an array to keep track of displayed users and sub-users
                                            $displayed_users = [];

                                            // Loop through each admin
                                            while ($row_admin = $result_admin->fetch_assoc()) {
                                                $name = $row_admin['name'];
                                                $referal_code = $row_admin['referal_code'];
                                                $admin_level = $row_admin['admin_level'];
                                                
                                                $admin_daily_payment = $row_admin['admin_daily_payment'];
                                                $admin_daily_payment_formatted = number_format($admin_daily_payment);

                                                // Calculate the percentage
                                                $percentage = ($admin_daily_payment / $total_daily_payment) * 100;
                                                $percentage_formatted = number_format($percentage);

                                                // Only display the admin if not already displayed
                                                if (!in_array($referal_code, $displayed_users)) {
                                                    $displayed_users[] = $referal_code;

                                                    // Determine the padding based on the admin level
                                                    $padding = '';
                                                    switch ($admin_level) {
                                                        case 4:
                                                            $padding = 'padding-left: 0px; font-weight: bold;';
                                                            break; // Top-level
                                                        case 3:
                                                            $padding = 'padding-left: 20px; font-style: italic;';
                                                            break; // Second level
                                                        case 2:
                                                            $padding = 'padding-left: 40px;';
                                                            break; // Third level
                                                        case 1:
                                                            $padding = 'padding-left: 60px; color: gray;';
                                                            break; // Fourth level
                                                    }

                                                    echo "<tr>";
                                                    echo "<td>{$transaction_date}</td>";
                                                    echo "<td style='{$padding}'>Lvl -0{$admin_level} - {$name}</td>";
                                                    // echo "<td>%</td>";
                                                    echo "<td>₩ {$admin_daily_payment_formatted}</td>";
                                                    echo "</tr>";
                                                }

                                                // Fetch sub-users under this admin
                                                $sub_query = "
                                                        SELECT
                                                            a.id,
                                                            a.username AS Child_name,
                                                            a.admin_level,
                                                            a.percentage,
                                                            a.referal_code
                                                        FROM
                                                            admins a
                                                        WHERE
                                                            a.parent_name = '" . $row_admin['referal_code'] . "'
                                                        ORDER BY
                                                            a.admin_level DESC
                                                    ";
                                                $result_sub = $conn->query($sub_query);

                                                if ($result_sub) {
                                                    // Loop through each sub-user
                                                    while ($row_sub = $result_sub->fetch_assoc()) {
                                                        $child_name = $row_sub['Child_name'];
                                                        $sub_level = $row_sub['admin_level'];
                                                        $percentage = $row_sub['percentage'];
                                                        $sub_referal_code = $row_sub['referal_code'];

                                                        // Only display the sub-user if not already displayed
                                                        if (!in_array($sub_referal_code, $displayed_users)) {
                                                            $displayed_users[] = $sub_referal_code;

                                                            // Calculate sub-user total amount
                                                            $sub_user_query = "
                                                                        SELECT 
                                                                            SUM(admin_comm) AS sub_user_total
                                                                        FROM 
                                                                            commission_history
                                                                        WHERE 
                                                                            referal_code = '" . $sub_referal_code . "'
                                                                            AND DATE(date_transaction) = '" . $row_date['transaction_date'] . "'
                                                                    ";
                                                            $result_sub_user = $conn->query($sub_user_query);
                                                            $sub_user_total = 0;
                                                            if ($result_sub_user) {
                                                                $row_sub_user = $result_sub_user->fetch_assoc();
                                                                $sub_user_total = $row_sub_user['sub_user_total'];
                                                                $sub_user_total_formatted = number_format($sub_user_total);
                                                            }

                                                            // Calculate the percentage for sub-users
                                                            $sub_percentage = ($sub_user_total / $total_daily_payment) * 100;
                                                            $sub_percentage_formatted = number_format($sub_percentage);

                                                            // Determine the padding for sub-users
                                                            $sub_padding = '';
                                                            switch ($sub_level) {
                                                                case 4:
                                                                    $sub_padding = 'padding-left: 0px; font-weight: bold;';
                                                                    break; // Top-level
                                                                case 3:
                                                                    $sub_padding = 'padding-left: 20px; font-style: italic;';
                                                                    break; // Second level
                                                                case 2:
                                                                    $sub_padding = 'padding-left: 40px;';
                                                                    break; // Third level
                                                                case 1:
                                                                    $sub_padding = 'padding-left: 60px; color: gray;';
                                                                    break; // Fourth level
                                                            }

                                                            echo "<tr>";
                                                            echo "<td>{$transaction_date}</td>";
                                                            echo "<td style='{$sub_padding}'>ㄴ Lvl -0{$sub_level} - {$child_name}</td>";
                                                            // echo "<td>{$percentage}</td>";
                                                            echo "<td>₩ {$sub_user_total_formatted}</td>";
                                                            echo "</tr>";
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                        // Display the total payment row at the bottom
                                        echo "<tr>";
                                        echo "<td colspan='2' class='text-end'><strong>{$transaction_date}</strong></td>";
                                        echo "<td colspan='1' style='text-align:left; color:green'><strong>Total Payment: ₩ {$total_daily_payment_formatted}</strong></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    // Handle the query error
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