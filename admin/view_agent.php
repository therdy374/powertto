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
                <h6 class="mb-4 text-center text-primary">관리자 목록</h6>
                <?php include_once("./data/admin_new_modal.php");
                ?>
                <div class="d-flex">
                    <a href="#add_admin" class="btn btn-primary text-light btn-sm mx-0 my-2" data-bs-toggle="modal"><i class="bi bi-plus-square me-2"></i>새 관리자</a>
                </div>
                <div class="table-responsive text-center">
                    <table class="table table-bordered text-white" style="font-size: small;" id="myTable1">
                        <thead>
                            <tr>
                                <th>Affiliated Master</th>
                                <th>Admin ID</th>
                                <th>Level 03</th>
                                <th>Level 02</th>
                                <th>Level 01</th>
                                <th>Admin Level</th>
                                <th>Daily</th>
                                <th>WEEKLY</th>
                                <th>Monthly</th>
                                <th>Referal Code #</th>
                                <th>Percentage</th>
                                <th>Account Status</th>
                                <th>Date Created</th>
                                <th>Delete</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            include "./inc/connect.php";

                            // Get today's date
                            $today_date = date('Y-m-d');
                            $start_of_week = date('Y-m-d', strtotime('last Monday', strtotime($today_date)));
                            $start_of_month = date('Y-m-01', strtotime($today_date));

                            // Query to sum payments for the current date for each user
                            $sum_daily_query = "
                            SELECT name, referal_code, SUM(admin_comm) AS total_daily_payment
                            FROM commission_history
                            WHERE DATE(date_transaction) = '$today_date'
                            GROUP BY name, referal_code";
                            $check_daily_sum = mysqli_query($conn, $sum_daily_query);

                            // Query to sum payments for the current week for each user and referral code
                            $sum_weekly_query = "
                            SELECT name, referal_code, SUM(admin_comm) as total_weekly_payment 
                            FROM commission_history 
                            WHERE DATE(date_transaction) >= '$start_of_week'
                            GROUP BY name, referal_code";
                            $check_weekly_sum = mysqli_query($conn, $sum_weekly_query);

                            // Query to sum payments for the current month for each user and referral code
                            $sum_monthly_query = "
                            SELECT name, referal_code, SUM(admin_comm) as total_monthly_payment 
                            FROM commission_history 
                            WHERE DATE(date_transaction) >= '$start_of_month'
                            GROUP BY name, referal_code";
                            $check_monthly_sum = mysqli_query($conn, $sum_monthly_query);

                            // Create arrays to store total payments
                            $daily_payments = [];
                            $weekly_payments = [];
                            $monthly_payments = [];

                            // Fetch daily payments
                            while ($row = mysqli_fetch_assoc($check_daily_sum)) {
                                $daily_payments[$row['name']][$row['referal_code']] = $row['total_daily_payment'];
                            }

                            // Fetch weekly payments
                            while ($row = mysqli_fetch_assoc($check_weekly_sum)) {
                                $weekly_payments[$row['name']][$row['referal_code']] = $row['total_weekly_payment'];
                            }

                            // Fetch monthly payments
                            while ($row = mysqli_fetch_assoc($check_monthly_sum)) {
                                $monthly_payments[$row['name']][$row['referal_code']] = $row['total_monthly_payment'];
                            }

                            // Query to select all users
                            $get_users = "SELECT * FROM `admins` WHERE admin_level != 5";
                            $result_query = mysqli_query($conn, $get_users);

                            // Fetch all users
                            $users = [];
                            while ($run_query = mysqli_fetch_array($result_query)) {
                                $users[] = $run_query;
                            }

                            foreach ($users as $run_query) {
                                $id = $run_query['id'];
                                $parent_name = $run_query['parent_name'];
                                $referal_code = $run_query['referal_code'];
                                $referal_points = $run_query['referal_points'];
                                $username = $run_query['username'];
                                $admin_comm = $run_query['admin_comm'];
                                $admin_level = $run_query['admin_level'];
                                $admin_credit = $run_query['admin_credit'];
                                $percentage = $run_query['percentage'];
                                $is_ban = $run_query['is_ban'];
                                $created_at = date('Y.m.d (D)', strtotime($run_query['created_at']));
                                $toggleId = "toggleContent" . $id; // Unique ID for toggle

                                // Fetch the total payments for this user and referral code
                                $total_daily_payment = $daily_payments[$username][$referal_code] ?? 0;
                                $total_weekly_payment = $weekly_payments[$username][$referal_code] ?? 0;
                                $total_monthly_payment = $monthly_payments[$username][$referal_code] ?? 0;
                            ?>
                                <tr class='text-center'>
                                    <td><?php echo $parent_name ?></td>
                                    <td data-bs-toggle="collapse" data-bs-target=".group-<?php echo $referal_code; ?>" style="cursor: pointer;">
                                        <?= $username ?>
                                    </td>
                                    <td>
                                        <?php if ($referal_code) {
                                            echo $username . ' (Admin Level: ' . $admin_level . ')';
                                        } ?>
                                    </td>
                                    <td>
                                        <?php if ($admin_level == 2) {
                                            echo $username . ' (Admin Level: ' . $admin_level . ')';
                                        } ?>
                                    </td>
                                    <td>
                                        <?php if ($admin_level == 1) {
                                            echo $username . ' (Admin Level: ' . $admin_level . ')';
                                        } ?>
                                    </td>
                                    <td><?php echo $admin_level ?></td>
                                    <td><?php echo number_format($total_daily_payment, 2) ?> ₩</td>
                                    <td><?php echo number_format($total_weekly_payment, 2) ?> ₩</td>
                                    <td><?php echo number_format($total_monthly_payment, 2) ?> ₩</td>
                                    
                                    <td><?php echo $referal_code ?></td>

                                    <td><?php echo $percentage ?></td>
                                    <td>
                                        <?php
                                        if ($is_ban == 1) {
                                            echo '<span class="badge bg-danger">Banned</span>';
                                        } else {
                                            echo '<span class="badge bg-success">Active</span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $created_at ?></td>
                                    <td><a href='index.php?users_affiliated=<?php echo $referal_code ?>' class='text-success'><i class='fa-solid fa-pen-to-square'></i></a></td>
                                    <td><a href='index.php?delete_admin=<?php echo $id ?>' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td>
                                </tr>

                                <!-- Toggle Content -->
                                <?php
                                foreach ($users as $res_ref) {
                                    if ($res_ref['parent_name'] == $referal_code) {
                                        $id1 = $res_ref['id'];
                                        $username1 = $res_ref['username'];
                                        $parent_name1 = $res_ref['parent_name'];
                                        $referal_code1 = $res_ref['referal_code'];
                                        $referal_points1 = $res_ref['referal_points'];
                                        $admin_comm1 = $res_ref['admin_comm'];
                                        $admin_level1 = $res_ref['admin_level'];
                                        $admin_credit1 = $res_ref['admin_credit'];
                                        $percentage1 = $res_ref['percentage'];
                                        $is_ban1 = $res_ref['is_ban'];
                                        $created_at1 = date('Y.m.d (D)', strtotime($res_ref['created_at']));
                                ?>
                                        <tr class='text-center collapse group-<?php echo $referal_code; ?>'>
                                            <td colspan="1"></td>
                                            <td><?php echo "<a href='index.php?admin_edit=$id1'>$username1</a>"; ?></td>
                                            <td><?php echo $admin_level1 ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><?php echo $referal_code1 ?></td>
                                            <td><?php echo $referal_points1 ?></td>
                                            <td><?php echo $percentage1 ?></td>
                                            <td>
                                                <?php
                                                if ($is_ban1 == 1) {
                                                    echo '<span class="badge bg-danger">Banned</span>';
                                                } else {
                                                    echo '<span class="badge bg-success">Active</span>';
                                                }
                                                ?>
                                            </td>
                                            <td></td>
                                            <td><?php echo $created_at1 ?></td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                            <script>
                                function toggleVisibility(toggleId) {
                                    var element = document.getElementById(toggleId);
                                    if (element.classList.contains('collapse')) {
                                        element.classList.remove('collapse');
                                    } else {
                                        element.classList.add('collapse');
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
<!-- Table End -->