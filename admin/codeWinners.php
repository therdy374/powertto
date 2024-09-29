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
                    <h6 class="mb-4">당첨번호 Winning Numbers
                        <a href="index.php" class="btn btn-primary btn-sm float-end">Back</a>
                    </h6>
                </div>

                <?php include_once("./data/create_numbers.php"); ?>
                <div class="d-flex">
                    <a href="#winningnumbers" class="btn btn-primary text-light btn-sm my-2 mx-0" data-bs-toggle="modal"><i class="bi bi-plus-square me-2"></i>새로운 당첨번호</a>
                </div>
                <div class="table-responsive my-2">
                    <table class="table table-bordered text-white text-center my-3" style="font-size: small;" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center">SI No</th>
                                <th class="text-center">일반볼</th>
                                <th class="text-center">파워볼</th>
                                <th class="text-center">당참금액</th>
                                <th class="text-center">날짜</th>
                                <th class="text-center">보다</th>
                                <th class="text-center">삭제</th>
                                <th class="text-center">삭제</th>
                                <th class="text-center">삭제</th>
                                <th class="text-center">삭제</th>
                            </tr>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            include "./inc/connect.php";

                            date_default_timezone_set('Asia/Seoul');
                            $winner_code = $_SESSION['referal_code'];

                            $get_users = "SELECT * FROM `user_purchases` WHERE referal_code = '$winner_code' ORDER BY `date_purchase` DESC";
                            $result_query = mysqli_query($conn, $get_users);

                            while ($run_query = mysqli_fetch_array($result_query)) {

                                $id = $run_query['id'];
                                $user_name = $run_query['user_name'];
                                $username = $run_query['username'];
                                $selected_numbers = $run_query['selected_numbers'];
                                $powerballs = $run_query['powerballs'];
                                $to_received = $run_query['to_received'];
                                $currentDateTime = date('Y.m.d (D) h:i:s(A)', strtotime($run_query['date_purchase']));
                                $referal_code = $run_query['referal_code'];

                                // Check if referal_code is not 0 before displaying the row
                                if ($to_received != 0) {
                            ?>
                                    <tr class='text-center'>
                                        <td><?php echo $id ?></td>
                                        <td><?php echo ($referal_code) ?></td>
                                        <td><?php echo ($user_name) ?></td>
                                        <td><?php echo ($username) ?></td>
                                        <td><?php echo $selected_numbers ?></td>
                                        <td><?php echo $powerballs ?></td>
                                        <td><?php echo $currentDateTime ?></td>
                                        <td><?php echo number_format($to_received) ?></td>
                                        <td><a href='index.php?winning_numbers_update=<?php echo $id ?>' class='text-success'><i class='fa-solid fa-pen-to-square'></i></a></td>
                                        <td><a href='index.php?delete_draw_numbers=<?php echo $id ?>' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td>
                                    </tr>
                            <?php
                                }
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