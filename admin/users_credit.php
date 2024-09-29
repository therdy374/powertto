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
                <strong>
                    <h6 class="mb-4 text-center text-primary">회원목록</h6>
                </strong>
                <?php //include_once("./data/admin_new_modal.php"); 
                ?>
                <!-- <div class="d-flex">
                    <a href="#addnew" class="btn btn-primary text-light btn-sm mx-0 my-2" data-bs-toggle="modal"><i class="bi bi-plus-square me-2"></i>Add new admin</a>
                </div> -->
                <div class="table-responsive text-center">
                    <table class="table table-bordered text-white text-center my-3" style="font-size: small;" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center">SI No</th>
                                <th class="text-center">ID</th>
                                <th class="text-center">이름</th>
                                <th class="text-center">보유머니</th>
                                <th class="text-center">가입날짜</th>
                                <th class="text-center">edit</th>
                                <th class="text-center">삭제</th>
                            </tr>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            include "./inc/connect.php";
                            date_default_timezone_set('Asia/Seoul');

                            // Fetching all user purchases grouped by date_purchase
                            $get_users = "SELECT * FROM users";
                            $result_query = mysqli_query($conn, $get_users);

                            $num = 1;

                            while ($run_query = mysqli_fetch_array($result_query)) {
                                $date_purchase = date('Y.m.d (D)', strtotime($run_query['created_at']));;
                                $id = $run_query['id'];
                                $name = $run_query['userid'];
                                $total_winning_amount = $run_query['credit'];

                            ?>

                                <tr class='text-center'>
                                    <td><?php echo $num++ ?></td>
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $name ?></td>
                                    <td>₩ <?php echo number_format($total_winning_amount) ?> </td>
                                    <td><?php echo $date_purchase ?></td>
                                    <td><a href='test_credit_update.php?id=<?php echo $id ?>' class='text-success'><i class='fa-solid fa-pen-to-square'></i></a></td>
                                    <td><a href='index.php?delete_list_user=<?php echo $id ?>' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td>
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