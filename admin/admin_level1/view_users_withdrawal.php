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
                <h6 class="mb-4 text-center">출금 내역 목록
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
                                <th class="text-center">이름</th>
                                <th class="text-center">사용자 ID</th>
                                <th class="text-center">출금 금액</th>
                                <th class="text-center">상태</th>
                                <th class="text-center">출금 날짜</th>
                                <!-- <th class="text-center">View</th> -->
                                <th class="text-center">삭제</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            include "./inc/connect.php";
                            $referal_code = $_SESSION['referal_code'];

                            $get_users = "Select * from users_withdrawal where referal_code = '$referal_code' order by `date_withdrawal` DESC";
                            $result_query = mysqli_query($conn, $get_users);
                            while ($run_query = mysqli_fetch_array($result_query)) {

                                $id = $run_query['id'];
                                $name = $run_query['name'];
                                $userid = $run_query['userid'];
                                $user_id = $run_query['user_id'];
                                $amount_withdrawal = $run_query['amount_withdrawal'];
                                $status = $run_query['status'];
                                $created_at = date('Y.m.d (D) h:i:s(A)', strtotime($run_query['date_withdrawal']))

                            ?>

                                <tr >
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $userid ?></td>
                                    <td>₩ <?php echo number_format($amount_withdrawal) ?></td>
                                    <td>
                                    <?php
                                        if ($run_query['status'] == '출금완료') {
                                            echo '<span class="badge bg-success">완료</span>';
                                        } else if($run_query['status'] == '취소'){
                                            echo '<span class="badge bg-danger">취소하다</span>';
                                        }
                                        else{
                                            echo '<span class="badge bg-danger">Pending</span>';
                                        }
                                        ?>
                                    </td>
                                    <td> <?php echo $created_at ?></td>
                                    <!-- <td><a href='index.php?withdrawal_edit_users=<?php echo $id ?>' class='text-success'><i class='fa-solid fa-pen-to-square'></i></a></td> -->
                                    <td><a href='index.php?admin_delete_withdrawals=<?php echo $id ?>' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td>

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