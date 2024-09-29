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
                <div>
                    <h6 class="mb-4 text-center">Chat Users
                        <!-- <a href="index.php?view_users_withdrawal" class="btn btn-primary btn-sm float-end">Back</a> -->
                    </h6>
                </div>

                <?php //include_once("./data/create_deposit_users.php");
                ?>
                <!-- <div class="d-flex">
                    <a href="#create_deposit_users" class="btn btn-primary text-light btn-sm mx-0 my-2" data-bs-toggle="modal"><i class="bi bi-plus-square me-2"></i>Deposit users</a>
                </div> -->

                <div class="table-responsive text-center">
                    <table class="table table-bordered text-white text-center" style="font-size: small;" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center">SI No</th>
                                <th class="text-center">사용자 ID</th>
                                <!-- <th class="text-center">Number</th> -->
                                <th class="text-center">IP Address</th>
                                <th class="text-center">Device Use</th>
                                <th class="text-center">User Access</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Date Logs</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $current_month = date('m');
                            $current_year = date('Y');
                            $get_users = "SELECT * FROM login_logs WHERE MONTH(date_logs) = $current_month AND YEAR(date_logs) = $current_year ORDER BY date_logs DESC";
                            
                            $result_query = mysqli_query($conn, $get_users);
                            while ($run_query = mysqli_fetch_array($result_query)) {
                                $id = $run_query['id'];
                                $userid = $run_query['userid'];
                                // $user_id = $run_query['user_id'];
                                $ip_address = $run_query['ip_address'];
                                $device_use = $run_query['device_use'];
                                $status = $run_query['status'];
                                $date_logs = date('Y.m.d (D) h:i:s (A)', strtotime($run_query['date_logs']));
                                $date_logout = date('Y.m.d (D) h:i:s (A)', strtotime($run_query['logout_time']));
                            ?>
                                <tr>
                                    <td><?php echo $id ?></td>
                                    <?php include "./data/view_logs_modal.php"; ?>
                                    <td>
                                        <a href="#view_logs<?php echo $id ?>" data-bs-toggle="modal"><?php echo $userid ?></a>
                                    </td>
                                    <!-- <td><?php echo $user_id ?></td> -->
                                    <td><?php echo $ip_address ?></td>
                                    <td><?php echo $device_use ?></td>
                                    <td>
                                        <?php
                                        if ($status == 1) {
                                            echo "<span class='badge bg-success'>IN USED</span>";
                                        } else {
                                            echo "<span class='badge bg-danger'>OUT</span>";
                                        }
                                        ?>
                                    </td>

                                    <td>
                                        <button class="btn btn-info"><a href="../admin.php">start chat</a></button>
                                    </td>
                                    <td><?php echo $date_logs ?></td>
                                    <td>
                                        <a href='index.php?delete_logs=<?php echo $id ?>' class='text-danger'>
                                            <i class='fa-solid fa-trash-can'></i>
                                        </a>
                                    </td>
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