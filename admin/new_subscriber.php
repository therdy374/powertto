<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4 text-center">신규 가입자</h6>
                <?php //include_once("./data/create_deposit_users.php"); 
                ?>
                <!-- <div class="d-flex">
                    <a href="#create_deposit_users" class="btn btn-primary text-light btn-sm mx-0 my-2" data-bs-toggle="modal"><i class="bi bi-plus-square me-2"></i>New Subscriber</a>
                </div> -->

                <div class="table-responsive text-center">
                    <table class="table text-white text-center my-3" style="font-size: small;" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center">SI No</th>
                                <th class="text-center">이름</th>
                                <th class="text-center">사용자 ID</th>
                                <th class="text-center">출생의 날짜</th>
                                <th class="text-center">은행명</th>
                                <th class="text-center">통장</th>
                                <th class="text-center">추천코드</th>
                                <th class="text-center">상태 확인</th>
                                <th class="text-center">확증의</th>
                                <th class="text-center">가입일</th>
                                
                                <!-- <th class="text-center">편집하다</th> -->
                                <!-- <th class="text-center">지우다</th> -->
                            </tr>
                            </tr>
                        </thead>

                        <tbody>
                            <?php

                            include "./inc/connect.php";
                            date_default_timezone_set('Asia/Seoul');
                            $currentDateTime = date('Y-m-d H:i:s');

                            $get_users = "SELECT * FROM `users` WHERE `verify_status`='0' ORDER BY `created_at` DESC";
                            $result_query = mysqli_query($conn, $get_users);

                            while ($run_query = mysqli_fetch_array($result_query)) {

                                $id = $run_query['id'];
                                $name = $run_query['name'];
                                $user_id = $run_query['userid'];
                                $bod = $run_query['bod'];
                                $bank_name = $run_query['bank_name'];
                                $bank_acct_num = $run_query['bank_acct_num'];
                                $referal_code = $run_query['referal_code'];
                                $verify_status = $run_query['verify_status'];
                                $created_at = date('Y.m.d (D) h:i:s (A)', strtotime($run_query['created_at']));

                            ?>

                                <tr class='text-center'>
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $user_id ?></td>
                                    <td><?php echo $bod ?></td>
                                    <td><?php echo $bank_name ?></td>
                                    <td><?php echo $bank_acct_num ?></td>
                                    <td><?php echo $referal_code ?></td>
                                    <td>
                                        <?php
                                        if ($verify_status == 1) {
                                            echo '<span class="badge bg-success"> Cancelled</span>';
                                        } else {
                                            echo '<span class="badge bg-danger"> Not Verified</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <form action="" method="POST" onsubmit="return validateForm(this)">
                                            <input type="hidden" name="id" value="<?php echo $id ?>">
                                            <select name="action">
                                                <option value="Select">선택하다</option>
                                                <option value="Confirm">확인하다</option>
                                                <option value="Cancel">취소</option>
                                            </select>
                                            <button type="submit" >제출하다</button>
                                        </form>
                                    </td>
                                    <td><?php echo $created_at ?></td>

                                    

                                    <!-- <td><a href='index.php?deposit_edit_users=<?php echo $id ?>' class='text-success'><i class="fa-sharp fa-solid fa-user-plus"></i></a></td> -->
                                    <!-- <td><a href='index.php?deposit_delete_users=<?php echo $id ?>' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td> -->

                                </tr>
                            <?php } ?>

                            <?php
                            if (isset($_POST['action']) && isset($_POST['id'])) {

                                $action = $_POST['action'];
                                $id = $_POST['id'];

                                if ($action == 'Confirm') {

                                    $user_sql2 = "UPDATE `users` SET `verify_status` = '1' WHERE `id` = $id";
                                    mysqli_query($conn, $user_sql2);

                                    if ($user_sql2) {
                                        echo '<script>alert("Users Approved by admin")</script>';
                                        echo "<script>window.open('index.php?view_users','_self')</script>";
                                    } else {
                                        echo "<script>alert('Opps something went wrong!')</script>";
                                    }
                                } elseif ($action == 'Cancel') {

                                    // Get the user data to be cancelled
                                    $cancel_query = "SELECT * FROM `users` WHERE `id` = $id";
                                    $result = mysqli_query($conn, $cancel_query);
                                    $cancelled_user = mysqli_fetch_assoc($result);
                                
                                    // Insert cancelled user data into users_cancelled table
                                    $insert_query = "INSERT INTO `users_cancelled` (`name`, `userid`, `bod`, `bank_name`, `bank_acct_num`, `referal_code`,`password`,`phone`,`verify_token`) 
                                                     VALUES ('{$cancelled_user['name']}', '{$cancelled_user['userid']}', '{$cancelled_user['bod']}', '{$cancelled_user['bank_name']}', '{$cancelled_user['bank_acct_num']}','{$cancelled_user['referal_code']}','{$cancelled_user['password']}','{$cancelled_user['phone']}','{$cancelled_user['verify_token']}')";
                                    mysqli_query($conn, $insert_query);
                                
                                    // Delete user from users table
                                    $delete_query = "DELETE FROM `users` WHERE `id` = '$id'";
                                    mysqli_query($conn, $delete_query);
                                
                                    echo '<script>alert("입금 요청이 취소되었습니다!..Sorry")</script>';
                                    echo "<script>window.open('index.php?new_subscriber','_self')</script>";
                                }
                                
                            }
                            ?>

                            <script>
                                function validateForm(form) {
                                    var action = form.action.value;
                                    if (action == "Select") {
                                        alert("Please select an action!");
                                        return false;
                                    }
                                    return true;
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