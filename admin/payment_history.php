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
                    <h6 class="mb-4 text-primary text-center">당첨 지급 내역
                        <!-- <a href="index.php?view_users_withdrawal" class="btn btn-primary btn-sm float-end">Back</a> -->
                    </h6>
                </div>

                <?php //include_once("./data/create_deposit_users.php");
                ?>
                <!-- <div class="d-flex">
                    <a href="#create_deposit_users" class="btn btn-primary text-light btn-sm mx-0 my-2" data-bs-toggle="modal"><i class="bi bi-plus-square me-2"></i>Deposit users</a>
                </div> -->
                <?php
                include "./inc/connect.php";

            
                $get_users = "SELECT * FROM `user_purchases` WHERE `to_received` > 0";
                $result_query = mysqli_query($conn, $get_users);

                if ($result_query) { // Check if the query was successful
                ?>

                    <div class="table-responsive">
                        <table class="table table-bordered text-white text-center" style="font-size: small;" id="myTable">
                            <thead>
                                <tr>
                                    <th class="text-center">SI No</th>
                                    <th class="text-center">이름</th>
                                    <th class="text-center">아이디</th>
                                    <th class="text-center">지급 내역</th>
                                    <th class="text-center">지급 날짜</th>
                                    <!-- <th class="text-center">View</th> -->
                                    <th class="text-center">삭제</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 1; // Initialize counter
                                while ($run_query = mysqli_fetch_array($result_query)) {

                                    $id = $run_query['id'];
                                    $user_name = $run_query['user_name'];
                                    $name = $run_query['username'];
                                    $payment = $run_query['to_received'];
                                    $created_at = date('Y.m.d (D) h:m:sa', strtotime($run_query['date_purchase']));

                                ?>
                                    <tr>
                                        <td><?php echo $counter++; ?></td>
                                        <td><?php echo $user_name ?></td>
                                        <td><?php echo $name ?></td>
                                        <td>₩ <?php echo number_format($payment) ?></td>
                                        <td> <?php echo $created_at ?></td>
                                        <!-- <td><a href='index.php?withdrawal_edit_users=<?php echo $id ?>' class='text-success'><i class='fa-solid fa-pen-to-square'></i></a></td> -->
                                        <td><a href='index.php?deposit_delete_users=<?php echo $id ?>' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>

                        </table>
                    </div>

                <?php
                } else {
                    echo "Error executing the query: " . mysqli_error($conn);
                }
                ?>


            </div>
        </div>
    </div>
</div>
<!-- Table End -->