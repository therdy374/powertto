<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4 text-center">사용자 입금 요청 </h6>
                <?php //include_once("./data/create_deposit_users.php"); ?>
                <!-- <div class="d-flex">
                    <a href="#create_deposit_users" class="btn btn-primary text-light btn-sm mx-0 my-2" data-bs-toggle="modal"><i class="bi bi-plus-square me-2"></i>Deposit users</a>
                </div> -->
                <div class="table-responsive text-center">
                    <table class="table text-white text-center my-3" style="font-size: small;" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center">SI No</th>
                                <th class="text-center">사용자 ID</th>
                                <th class="text-center">이름</th>
                                <th class="text-center">금액요청</th>
                                <th class="text-center">날짜요청</th>
                                <th class="text-center">비고</th>
                                <th class="text-center">입금요청</th>
                                <th class="text-center">삭제</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            include "./inc/connect.php";
                            date_default_timezone_set('Asia/Seoul');
                            $currentDateTime = date('Y-m-d H:i:s');

                            $referal_code = $_SESSION['referal_code'];

                            $get_users = "Select * from `users_request_deposit` where referal_code ='$referal_code' order by `date_message` DESC";
                            $result_query = mysqli_query($conn, $get_users);


                            while ($run_query = mysqli_fetch_array($result_query)) {

                                $id = $run_query['id'];
                                $user_id = $run_query['user_id'];
                                $name = $run_query['name'];
                                $userid = $run_query['userid'];
                                $amount_deposit = $run_query['message'];
                                $referal_code = $run_query['referal_code'];
                                // $created_at = date('Y.m.d (D) h:i:s (A)', strtotime($run_query['date_message']))
                                $date_message = $run_query['date_message'];

                                $amount_deposit = preg_replace('/[^\d.]/', '', $amount_deposit);

                            ?>

                                <tr class='text-center'>
                                    <td><?php echo $id ?></td>
                                    
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $userid ?></td>
                                    <td><?php echo number_format($amount_deposit) ?> ₩</td>
                                    <td> <?php echo $date_message ?></td>
                                    <td>
                                        <form action="" method="POST" onsubmit="return validateForm(this)">
                                            <input type="hidden" name="id" value="<?php echo $id ?>">
                                            <select name="action">
                                                <option value="Select">선택하다</option>
                                                <option value="Confirm">확인하다</option>
                                                <option value="Cancel">취소</option>
                                            </select>
                                            <button type="submit">제출하다</button>
                                        </form>
                                    </td>

                                    <td><a href='index.php?deposit_edit_users=<?php echo $id ?>' class='text-success'><i class="fa-sharp fa-solid fa-user-plus"></i></a></td>
                                    <td><a href='index.php?deposit_delete_users=<?php echo $id ?>' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td>

                                </tr>
                            <?php } ?>

                            <?php
                            if (isset($_POST['action']) && isset($_POST['id'])) {
                                $admin_id = $_SESSION['id'];

                                $action = $_POST['action'];
                                $id = $_POST['id'];

                                if ($action == 'Confirm') {

                                    $users_query = "SELECT credit FROM users WHERE id = $user_id";
                                    $query_run = mysqli_query($conn, $users_query);
                                    $userBalance = mysqli_fetch_assoc($query_run)['credit'];
                                    $user_finalBalance = $userBalance + $amount_deposit;
                                    $user_sql2 = "UPDATE `users` SET `credit` = '$user_finalBalance' WHERE `id` = $user_id";
                                    mysqli_query($conn, $user_sql2);

                                    // Update customer service using the specific date_message
                                    $update_cust_dep = "UPDATE `customer_service` SET `status` = '입금처리완료', `reply_message` = '$amount_deposit' WHERE `date_message` = '$date_message'";
                                    mysqli_query($conn, $update_cust_dep);

                                    // Update users_request using the specific date_message
                                    $users_req = "UPDATE `users_request` SET `status` = '입금처리완료' WHERE `date_message` = '$date_message'";
                                    mysqli_query($conn, $users_req);

                                    // Update users_request_deposit using the specific date_message
                                    $query = "DELETE FROM `users_request_deposit` WHERE `id` = '$id'";
                                    mysqli_query($conn, $query);

                                    // Insert into deposit_mgt
                                    $user_update = "INSERT INTO deposit_mgt (name, referal_code, user_id, amount_deposit, status, date_deposit, userid) VALUES ('$name','$referal_code','$user_id','$amount_deposit', 'Completed', '$currentDateTime','$userid')";
                                    mysqli_query($conn, $user_update);

                                    // Update admin credit
                                    $admin_query = "SELECT admin_credit FROM admins WHERE id = $admin_id";
                                    $query_run = mysqli_query($conn, $admin_query);
                                    $admin_credit = mysqli_fetch_assoc($query_run)['admin_credit'];
                                    $finalBalance = $admin_credit - $amount_deposit;
                                    $update_admin_credit = "UPDATE `admins` SET `admin_credit` = '$finalBalance' WHERE id = $admin_id";
                                    mysqli_query($conn, $update_admin_credit);

                                    if ($user_update) {
                                        echo '<script>alert("Users deposit completed!\n Admin Balance!\\n ' . number_format($finalBalance) . ' ")</script>';
                                        echo "<script>window.open('index_L4.php?deposit_users','_self')</script>";
                                    } else {
                                        echo "<script>alert('Opps something went wrong!')</script>";
                                    }

                                } elseif ($action == 'Cancel') {

                                    // Update customer service using the specific date_message
                                    $update_cust_dep = "UPDATE `customer_service` SET `status` = '입금 요청이 취소되었습니다!', `reply_message` = '$amount_deposit' WHERE `date_message` = '$date_message'";
                                    mysqli_query($conn, $update_cust_dep);

                                    // Update users_request using the specific date_message
                                    $users_req = "UPDATE `users_request` SET `status` = '입금 요청이 취소되었습니다!' WHERE `date_message` = '$date_message'";
                                    mysqli_query($conn, $users_req);

                                    // Update users_request_deposit using the specific date_message
                                    $query = "DELETE FROM `users_request_deposit` WHERE `id` = '$id'";
                                    mysqli_query($conn, $query);
                                   

                                    echo '<script>alert("입금 요청이 취소되었습니다!..")</script>';
                                    echo ("<script>location.href='index.php?deposit_users'</script>");
                                }
                            }
                            ?>

                        </tbody>

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

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Table End -->