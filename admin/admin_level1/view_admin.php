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
                <?php include_once("../data/admin_new_modal.php");
                ?>
                <!-- <div class="d-flex">
                    <a href="#add_admin" class="btn btn-primary text-light btn-sm mx-0 my-2" data-bs-toggle="modal"><i class="bi bi-plus-square me-2"></i>새 관리자</a>
                </div> -->
                <div class="table-responsive text-center">
                    <table class="table table-bordered text-white" style="font-size: small;" id="myTable">
                        <thead>
                            <tr>
                                <th>SI No</th>
                                <th>Affiliated Agent</th>
                                <th>Username/Email</th>
                                <th>Referal Code #</th>
                                <th>Referal Points</th>
                                <th>Agent credit</th>
                                <th>Agent Comm</th>
                                <th>Percentage</th>
                                <th>Admin Level</th>
                                <th>Account Status</th>
                                <th>Date Created</th>
                                <!-- <th>View List Users</th>
                                <th>Delete</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "./inc/connect.php";


                            $get_users = "Select * from `admins` order by `created_at` DESC";
                            $result_query = mysqli_query($conn, $get_users);
                            while ($run_query = mysqli_fetch_array($result_query)) {
                                $id = $run_query['id'];
                                $parent_name = $run_query['parent_name'];
                                // $name = $run_query['name'];
                                $email = $run_query['email'];
                                $referal_code = $run_query['referal_code'];
                                $referal_points = $run_query['referal_points'];
                                $email = $run_query['email'];
                                $admin_comm = $run_query['admin_comm'];
                                $admin_level = $run_query['admin_level'];
                                $admin_credit = $run_query['admin_credit'];
                                $percentage = $run_query['percentage'];
                                $is_ban = $run_query['is_ban'];
                                $created_at = date('Y.m.d (D)', strtotime($run_query['created_at']))
                            ?>
                                <tr class='text-center'>
                                    
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $parent_name ?></td>
                                    <!-- <td><?php echo $name ?></td> -->

                                    <td>
                                        <?php echo $email; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <!-- <a href='index.php?admin_edit=<?php echo $id ?>' class='text-success'>
                                            <i class="fa fa-user-plus text-success"></i>
                                        </a> -->
                                    </td>

                                    <td><?php echo $referal_code ?></td>
                                    <td><?php echo $referal_points ?></td>
                                    <td><?php echo number_format($admin_credit) ?> ₩</td>
                                    <td><?php echo number_format($admin_comm) ?> ₩</td>
                                    <td><?php echo $percentage ?></td>
                                    <td><?php echo $admin_level ?> </td>
                                    <td>
                                        <?php
                                        if ($run_query['is_ban'] == 1) {
                                            echo '<span class="badge bg-danger">Banned</span>';
                                        } else {
                                            echo '<span class="badge bg-success">Active</span>';
                                        }
                                        ?>
                                    </td>
                                    <td> <?php echo $created_at ?></td>

                                    <!-- <td><a href='index.php?users_affiliated=<?php echo $referal_code ?>' class='text-success'><i class='fa-solid fa-pen-to-square'></i></a></td>
                                    <td><a href='index.php?delete_admin=<?php echo $id ?>' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td> -->

                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <script>
                        function updateAction(selectElement, userId) {
                            var formId = "userForm_" + userId;
                            var form = document.getElementById(formId);
                            var selectedOption = selectElement.value;
                            if (selectedOption === "view") {
                                form.action = "index.php?users_affiliated=<?php echo $id ?>";
                            } else {
                                // You can set the action for other options if needed
                                form.action = "#"; // Default action
                            }
                        }
                    </script>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- Table End -->