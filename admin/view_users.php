<!-- Table Start -->
<style>
    table.dataTable tbody th,
    table.dataTable tbody td {
        padding: 8px 10px;
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
                    <h6 class="mb-4 text-center text-primary">사용자 리스트
                        <!-- <a href="index.php" class="btn btn-primary btn-sm float-end">Back</a> -->
                    </h6>
                </div>
                <?php include_once("./data/users_create.php"); ?>
                <div class="d-flex">
                    <a href="#addnewuser" class="btn btn-primary text-light btn-sm my-2 mx-0" data-bs-toggle="modal"><i class="bi bi-plus-square me-2"></i>신규 사용자</a>
                </div>

                <div class="table-responsive my-2">
                    <table width="100%" class="table table-bordered text-white my-3" style="font-size: small;" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center">SI No</th>
                                <th class="text-center">이름</th>
                                <th class="text-center">핸드폰</th>
                                <th class="text-center">사용자ID</th>
                                <th class="text-center">생년월일</th>
                                <th class="text-center">현재잔액</th>

                                <th class="text-center">입금</th>
                                <th class="text-center">출금</th>
                                <th class="text-center">계산된금액</th>
                                <th class="text-center">계정이 확인되었습니다</th>
                                <th class="text-center">계정상태</th>
                                <th class="text-center">생성 일자</th>
                                <th class="text-center">보다</th>
                                <th class="text-center">삭제</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            include "./inc/connect.php";

                            $get_users = "SELECT u.id, u.name, u.phone, u.userid, u.bod, u.credit, u.verify_status, u.is_ban, u.memo, u.created_at, 
                            COALESCE(SUM(d.amount_deposit), 0) AS total_deposit,
                            COALESCE(SUM(w.amount_withdrawal), 0) AS total_withdrawal
                            FROM users u 
                            LEFT JOIN (SELECT user_id, SUM(amount_deposit) AS amount_deposit FROM deposit_mgt GROUP BY user_id) d ON u.id = d.user_id 
                            LEFT JOIN (SELECT user_id, SUM(amount_withdrawal) AS amount_withdrawal FROM users_withdrawal GROUP BY user_id) w ON u.id = w.user_id 
                            GROUP BY u.id 
                            ORDER BY u.created_at DESC";

                            $result_query = mysqli_query($conn, $get_users);

                            while ($run_query = mysqli_fetch_array($result_query)) {

                                $id = $run_query['id'];
                                $name = $run_query['name'];
                                $phone = $run_query['phone'];
                                $userid = $run_query['userid'];
                                $bod = $run_query['bod'];
                                $credit = $run_query['credit'];
                                $winning_match_numbers = $run_query['verify_status'];
                                $is_ban = $run_query['is_ban'];
                                $memo = $run_query['memo'];
                                $created_at = date('Y.m.d (D)', strtotime($run_query['created_at']));
                                $total_deposit = $run_query['total_deposit'];
                                $total_withdrawal = $run_query['total_withdrawal'];

                                $calculated_amount = $total_deposit - $total_withdrawal

                            ?>

                                <tr class='text-center'>
                                    <?php
                                    include "./data/view_users_modal.php";
                                    ?>
                                    <td><?php echo $id ?></td>
                                    <td>
                                        <a href="#view_users_modal<?php echo $id ?>" data-bs-toggle="modal"><?php echo $name ?></a>
                                    </td>
                                    <td><?php echo $phone ?></td>
                                    <td>
                                        <a href="#view_users_modal<?php echo $id ?>" data-bs-toggle="modal"><?php echo $userid ?></a>
                                    </td>

                                    <td><?php echo $bod ?></td>
                                    <td>₩ <?php echo number_format($credit) ?> </td>
                                    <td>₩ <?php echo number_format($total_deposit) ?> </td>
                                    <td>₩ <?php echo number_format($total_withdrawal) ?> </td>
                                    <td>₩ <?php echo number_format($calculated_amount < 0 ? 0 : $calculated_amount) ?> </td>

                                    <td>
                                        <?php
                                        if ($run_query['verify_status'] == 1) {
                                            echo '<span class="badge bg-success">Verified</span>';
                                        } else {
                                            echo '<span class="badge bg-danger"> Not Verified</span>';
                                        }
                                        ?>
                                    </td>
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
                                    <td><a href='index.php?view_edit_users=<?php echo $id ?>' class='text-success'><i class='fa-solid fa-pen-to-square'></i></a></td>
                                    <td><a href='index.php?delete_user=<?php echo $id ?>' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td>

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