<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4 text-center">Users Inquiries Request </h6>
                <?php //include_once("./data/create_deposit_users.php");
                ?>
                <!-- <div class="d-flex">
                    <a href="#create_deposit_users" class="btn btn-primary text-light btn-sm mx-0 my-2" data-bs-toggle="modal"><i class="bi bi-plus-square me-2"></i>Deposit users</a>
                </div> -->
                <div class="table-responsive text-center">
                    <table class="table text-white text-center my-3" style="font-size: small;" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center">SI No</th>
                                <th class="text-center">이름</th>
                                <th class="text-center">사용자 ID</th>
                                <th class="text-center">메세지</th>
                                <th class="text-center">상황</th>
                                <th class="text-center">날짜 요청</th>
                                <th class="text-center">회신문의</th>
                                <th class="text-center">삭제</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            include "./inc/connect.php";

                            $get_users = "Select * from `customer_service` order by `date_message` DESC";
                            $result_query = mysqli_query($conn, $get_users);


                            while ($run_query = mysqli_fetch_array($result_query)) {

                                $id = $run_query['id'];
                                $name = $run_query['name'];
                                $user_id = $run_query['user_id'];
                                $message = $run_query['message'];
                                $status = $run_query['status'];
                                $created_at = date('Y.m.d (D) h:i:s(A)', strtotime($run_query['date_message']))

                            ?>

                                <tr class='text-center'>
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $user_id ?></td>
                                    <td><?php echo $message ?></td>
                                    <td>
                                    <?php
                                        if ($run_query['status'] == '입금처리완료' || $run_query['status'] == '답변완료') {
                                            echo '<span class="badge bg-success">Completed</span>';
                                        } else {
                                            echo '<span class="badge bg-danger">Pending</span>';
                                        }
                                        ?>
                                    </td>
                                    
                                    <td> <?php echo $created_at ?></td>
                                    <td><a href='index.php?users_process_inquiries=<?php echo $id ?>' class='text-success'><i class="fa-sharp fa-solid fa-user-plus"></i></a></td>
                                    <td><a href='index.php?delete_inquiries=<?php echo $id ?>' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td>

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