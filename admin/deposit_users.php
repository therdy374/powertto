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
                <h6 class="mb-4 text-center text-primary">입금 내역 목록</h6>
                <?php //include_once("./data/create_deposit_users.php");
                ?>
                <!-- <div class="d-flex">
                    <a href="#create_deposit_users" class="btn btn-primary text-light btn-sm mx-0 my-2" data-bs-toggle="modal"><i class="bi bi-plus-square me-2"></i>Deposit users</a>
                </div> -->
                <div class="table-responsive text-center">
                    <table class="table table-bordered text-white text-center my-3" style="font-size: small;" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center">SI No</th>
                                <th class="text-center">이름</th>
                                <th class="text-center">사용자 ID</th>
                                <th class="text-center">입금 금액</th>
                                <th class="text-center">상태</th>
                                <th class="text-center">입금 날짜</th>
                                <th class="text-center">보기</th>
                                <th class="text-center">삭제</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            include "./inc/connect.php";

                            $get_users = "Select * from `deposit_mgt` order by `date_deposit` DESC";
                            $result_query = mysqli_query($conn, $get_users);
                            while ($run_query = mysqli_fetch_array($result_query)) {

                                $id = $run_query['id'];
                                $name = $run_query['name'];
                                $userid = $run_query['userid'];
                                $amount_deposit = $run_query['amount_deposit'];
                                $created_at = date('Y.m.d (D) H:i:s(A)', strtotime($run_query['date_deposit']))

                            ?>

                                <tr class='text-center'>
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $userid ?></td>
                                    <td>₩ <?php echo number_format($amount_deposit) ?></td>
                                    
                                    <td>
                                    <?php
                                        if ($run_query['status'] == 'Completed') {
                                            echo '<span class="badge bg-success">완료</span>';
                                        } else {
                                            echo '<span class="badge bg-danger">Pending</span>';
                                        }
                                        ?>
                                    </td>
                                    <td> <?php echo $created_at ?></td>
                                    <td><a href='index.php?user_deposit_update=<?php echo $id ?>' class='text-success'><i class='fa-solid fa-pen-to-square'></i></a></td>
                                    <td><a href='index.php?deposit_delete_users=<?php echo $id ?>' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td>

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