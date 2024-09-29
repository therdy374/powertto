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
            // Get the start of the week (Monday)
            $startOfWeek = date('Y-m-d', strtotime('monday this week'));
            // Get the start of the month
            $startOfMonth = date('Y-m-01');

          
            $overall_query = "
                    SELECT 
                        SUM(admin_comm) AS total_weekly_payment
                    FROM 
                        commission_history
                    WHERE 
                        DATE(date_transaction)
                ";
            $overall_weekly = $conn->query($overall_query);
            $overall_weekly_payment = ($overall_weekly->num_rows > 0) ? number_format($overall_weekly->fetch_assoc()['total_weekly_payment']) : '0.00';
            ?>

            <!-- Display Overall -->
            <div class="col-sm-4 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-calendar-day fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 te-end">Total Over All Weekly</p>
                        <h6 class="mb-0 text-end"><?php echo $overall_weekly_payment; ?> ₩</h6>
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
                        echo '<h6 class="mb-4 text-left text-primary">Agent Commission Weekly <a href="index.php?commission_history" class="btn btn-primary float-end">BACK</a></h6><br>';
                    }
                    ?>


                    <div class="table-responsive text-center">
                        <table class="table table-bordered text-white text-center" style="font-size: small;" id="myTable1">
                            <thead>
                                <tr>
                                    <th>Date Transaction</th>
                                    <th>USER ID</th>
                                    <th>Referal Code #</th>
                                    <th>Total Weekly Payment</th>

                                </tr>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                // Initialize the total payment sum
                                $overall_total_payment = 0;

                                // Sum payments for every user grouped by week
                                $sum_query = "
                                    SELECT 
                                        YEARWEEK(date_transaction, 1) AS transaction_week,  -- Group by week (mode 1 starts on Monday)
                                        DATE_ADD(DATE(date_transaction), INTERVAL -WEEKDAY(date_transaction) DAY) AS week_start,  -- Week start date
                                        DATE_ADD(DATE(date_transaction), INTERVAL 6 - WEEKDAY(date_transaction) DAY) AS week_end,  -- Week end date
                                        name,
                                        referal_code,
                                        SUM(admin_comm) AS total_weekly_payment
                                    FROM commission_history
                                    GROUP BY transaction_week, name, referal_code
                                    ORDER BY transaction_week DESC, name
                                ";

                                $result_query = $conn->query($sum_query);

                                // Check if the query execution was successful
                                if ($result_query) {
                                    // Loop through the results
                                    while ($run_query = $result_query->fetch_assoc()) {
                                        $week_start = $run_query['week_start'];
                                        $week_end = $run_query['week_end'];
                                        $name = $run_query['name'];
                                        $referal_code = $run_query['referal_code'];
                                        $total_weekly_payment = isset($run_query['total_weekly_payment']) ? $run_query['total_weekly_payment'] : 0;

                                        // Add to overall total
                                        $overall_total_payment += $total_weekly_payment;
                                ?>
                                        <tr class='text-center'>
                                            <td><?php echo htmlspecialchars($week_start) . ' - ' . htmlspecialchars($week_end); ?></td>
                                            <td data-bs-toggle="collapse" data-bs-target=".group-<?php echo htmlspecialchars($referal_code); ?>" style="cursor: pointer;">
                                                <?php echo htmlspecialchars($name); ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($referal_code); ?></td>
                                            <td><?php echo number_format($total_weekly_payment); ?> ₩</td>
                                        </tr>
                                        <!-- Toggle Content -->
                                        <?php
                                        $get_users = "
                                                SELECT * 
                                                FROM admins 
                                                WHERE parent_name = '{$referal_code}' 
                                                AND admin_level != 5
                                            ";
                                        $result_users = $conn->query($get_users);

                                        if ($result_users) {
                                            while ($res_ref = $result_users->fetch_assoc()) {
                                                $id1 = $res_ref['id'];
                                                $username1 = $res_ref['username'];
                                                $admin_level1 = $res_ref['admin_level'];
                                                $referal_code1 = $res_ref['referal_code'];
                                                $referal_points1 = $res_ref['referal_points'];
                                                $percentage1 = $res_ref['percentage'];
                                                $is_ban1 = $res_ref['is_ban'];
                                                $created_at1 = date('Y.m.d (D)', strtotime($res_ref['created_at']));
                                                $total_weekly_payment1 = isset($run_query['total_weekly_payment']) ? $run_query['total_weekly_payment'] : 0;
                                        ?>
                                                <tr class='text-center collapse group-<?php echo htmlspecialchars($referal_code); ?>' data-bs-parent="tbody">
                                                    <td><?php echo htmlspecialchars($week_start) . ' - ' . htmlspecialchars($week_end); ?></td>
                                                    <td class="text-primary" data-bs-toggle="collapse" data-bs-target=".group-<?php echo htmlspecialchars($referal_code1); ?>" style="cursor: pointer;">
                                                        <?php echo htmlspecialchars($username1); ?>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($referal_code1); ?></td>
                                                    <td><?php echo number_format($total_weekly_payment1); ?> ₩</td>
                                                </tr>
                                <?php
                                            }
                                        }
                                    }
                                } else {
                                    
                                    echo "<tr><td colspan='4'>Error executing query: " . $conn->error . "</td></tr>";
                                }
                                ?>
                                
                                <tr class='text-end'>
                                    <td colspan="3"><strong>Over All Total:</strong></td>
                                    <td style='text-align:left; color:green'><strong><?php echo number_format($overall_total_payment); ?> ₩</strong></td>
                                </tr>

                                <script>
                                    function updateAction(selectElement, userId) {
                                        var formId = "userForm_" + userId;
                                        var form = document.getElementById(formId);
                                        var selectedOption = selectElement.value;
                                        if (selectedOption === "view") {
                                            form.action = "commission_weekly=<?php echo $id ?>";
                                        } else {
                                            
                                            form.action = "#"; 
                                        }
                                    }
                                </script>
                            </tbody>



                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <?php include "inc/footer.php"; ?>