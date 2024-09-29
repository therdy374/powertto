<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4 text-center">사용자 출금 요청</h6>
                <?php //include_once("./data/create_deposit_users.php");
                ?>

                <div class="table-responsive text-center">
                    <table class="table text-white text-center my-3" style="font-size: small;" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center">SI No</th>
                                <!-- <th class="text-center">이름sss</th> -->
                                <th class="text-center">이름</th>
                                <th class="text-center">사용자ID</th>
                                <th class="text-center">출금요청</th>
                                <th class="text-center">사용자 잔액</th>
                                <th class="text-center">날짜요청</th>
                                <th class="text-center">새로운상태</th>
                                <th class="text-center">비고</th>
                                <!-- <th class="text-center">Update Withdrawal</th> -->
                                <th class="text-center">삭제</th>
                            </tr>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            include "./inc/connect.php";

                            $get_users = "SELECT * FROM user_request_withdrawal ORDER BY `date_withdrawal` DESC";
                            $result_query = mysqli_query($conn, $get_users);

                            while ($run_query = mysqli_fetch_array($result_query)) {
                                $id = $run_query['id'];
                                $userid = $run_query['userid'];
                                $name = $run_query['name'];
                                // $user_id = $run_query['user_id'];
                                $amount_withdrawal = $run_query['amount_withdrawal'];
                                $credit_balance = $run_query['credit_balance'];
                                $status = $run_query['status'];
                                $referal_code = $run_query['referal_code'];
                                $created_at = date('Y.m.d (D) h:i:s(A)', strtotime($run_query['date_withdrawal']));
                            ?>
                                <tr class='text-center'>
                                    <td><?php echo $id ?></td>

                                    <td><?php echo $name ?></td>
                                    <td><?php echo $userid ?></td>
                                    <td><?php echo number_format($amount_withdrawal) ?> ₩</td>
                                    <td class="text-primary"><?php echo number_format($credit_balance) ?> ₩</td>
                                    <td><?php echo $created_at ?></td>
                                    <td><?php echo $status ?></td>
                                    <td>
                                        <form action="" method="POST" onsubmit="return validateForm(this)">
                                            <input type="hidden" name="id" value="<?php echo $id ?>">
                                            <input type="hidden" name="date_withdrawal" value="<?php echo $created_at ?>">
                                            <input type="hidden" name="referal_code" value="<?php echo $referal_code ?>">
                                            <select name="action">
                                                <option value="Select">선택하다</option>
                                                <option value="Confirm">확인하다</option>
                                                <option value="Cancel">취소</option>
                                            </select>
                                            <button type="submit">제출하다</button>
                                        </form>
                                    </td>

                                    <td><a href='index.php?deposit_delete_users=<?php echo $id ?>' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td>
                                </tr>
                            <?php } ?>

                            <?php
                            if (isset($_POST['action']) && isset($_POST['id'])) {

                                $action = $_POST['action'];
                                $id = $_POST['id'];
                                $created_at = $_POST['date_withdrawal'];

                                if ($action == 'Confirm') {
                                    $sql_update = "UPDATE user_withdrawal_request SET status='출금완료' WHERE id=?";
                                    $stmt = mysqli_prepare($conn, $sql_update);
                                    mysqli_stmt_bind_param($stmt, "i", $id);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_close($stmt);

                                    // Fetch the withdrawal details
                                    $sql_select = "SELECT * FROM user_request_withdrawal WHERE id=?";
                                    $stmt = mysqli_prepare($conn, $sql_select);
                                    mysqli_stmt_bind_param($stmt, "i", $id);
                                    mysqli_stmt_execute($stmt);
                                    $result_select = mysqli_stmt_get_result($stmt);
                                    $withdrawal_details = mysqli_fetch_assoc($result_select);
                                    mysqli_stmt_close($stmt);

                                    // Insert the withdrawal details into users_withdrawal table
                                    $userid = $withdrawal_details['userid'];
                                    $name = $withdrawal_details['name'];
                                    $user_id1 = $withdrawal_details['user_id'];
                                    $amount_withdrawal = $withdrawal_details['amount_withdrawal'];
                                    $bank_name = $withdrawal_details['bank_name'];
                                    $bank_acct_num = $withdrawal_details['bank_acct_num'];
                                    $status = '출금완료';
                                    $currentDateTime = date('Y-m-d H:i:s');

                                    $user_update = "INSERT INTO users_withdrawal (referal_code, userid, name, user_id, amount_withdrawal, bank_name, bank_acct_num, status, date_withdrawal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                    $stmt = mysqli_prepare($conn, $user_update);
                                    mysqli_stmt_bind_param($stmt, "sssiissss", $referal_code, $userid, $name, $user_id1, $amount_withdrawal, $bank_name, $bank_acct_num, $status, $currentDateTime);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_close($stmt);

                                    // Delete the confirmed withdrawal request from user_request_withdrawal table
                                    $query = "DELETE FROM `user_request_withdrawal` WHERE `id` = ?";
                                    $stmt = mysqli_prepare($conn, $query);
                                    mysqli_stmt_bind_param($stmt, "i", $id);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_close($stmt);

                                    $users_withdraw = "SELECT credit FROM users where id = $user_id1";
                                    $query_run = mysqli_query($conn, $users_withdraw);

                                    while ($run_query = mysqli_fetch_array($query_run)) {
                                        $users_credit = $run_query['credit'];
                                    }

                                    echo '<script>alert("이제 사용자 철회가 완료되었습니다!\\n 현재 사용자 균형은 다음과 같습니다: ' . number_format($users_credit) . '₩")</script>';
                                    echo ("<script>location.href='index.php?view_users_withdrawal'</script>");
                                } elseif ($action == 'Cancel') {
                                    // Fetch the withdrawal details
                                    $sql_select = "SELECT * FROM user_request_withdrawal WHERE id=?";
                                    $stmt = mysqli_prepare($conn, $sql_select);
                                    mysqli_stmt_bind_param($stmt, "i", $id);
                                    mysqli_stmt_execute($stmt);
                                    $result_select = mysqli_stmt_get_result($stmt);
                                    $withdrawal_details = mysqli_fetch_assoc($result_select);
                                    mysqli_stmt_close($stmt);

                                    $userid = $withdrawal_details['userid'];
                                    $amount_withdrawal = $withdrawal_details['amount_withdrawal'];

                                    // Update the status to '취소' in both tables
                                    $sql_update1 = "UPDATE user_withdrawal_request SET status='취소' WHERE id=?";
                                    $stmt = mysqli_prepare($conn, $sql_update1);
                                    mysqli_stmt_bind_param($stmt, "i", $id);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_close($stmt);

                                    $sql_update2 = "UPDATE user_request_withdrawal SET status='취소' WHERE id=?";
                                    $stmt = mysqli_prepare($conn, $sql_update2);
                                    mysqli_stmt_bind_param($stmt, "i", $id);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_close($stmt);

                                    // Insert the withdrawal details into users_withdrawal table with status 'cancel'
                                    $name = $withdrawal_details['name'];
                                    $user_id1 = $withdrawal_details['user_id'];
                                    $bank_name = $withdrawal_details['bank_name'];
                                    $bank_acct_num = $withdrawal_details['bank_acct_num'];
                                    $status = '취소';
                                    $currentDateTime = date('Y-m-d H:i:s');

                                    $user_update = "INSERT INTO users_withdrawal (referal_code, userid, name, user_id, amount_withdrawal, bank_name, bank_acct_num, status, date_withdrawal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                    $stmt = mysqli_prepare($conn, $user_update);
                                    mysqli_stmt_bind_param($stmt, "sssiissss", $referal_code, $userid, $name, $user_id1, $amount_withdrawal, $bank_name, $bank_acct_num, $status, $currentDateTime);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_close($stmt);


                                    // Delete the confirmed withdrawal request from user_request_withdrawal table
                                    $query = "DELETE FROM `user_request_withdrawal` WHERE `id` = ?";
                                    $stmt = mysqli_prepare($conn, $query);
                                    mysqli_stmt_bind_param($stmt, "i", $id);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_close($stmt);

                                    // Update the user's credit balance
                                    $users_withdraw2 = "SELECT credit FROM users WHERE `userid` = '$userid'";
                                    $query_run = mysqli_query($conn, $users_withdraw2);

                                    while ($run_query = mysqli_fetch_array($query_run)) {
                                        $users_credit = $run_query['credit'];
                                    }

                                    $initialBalance = $users_credit;
                                    $finalBalance = $initialBalance + $amount_withdrawal;

                                    $sql2 = "UPDATE `users` SET `credit` = '$finalBalance' WHERE `userid` = '$userid'";
                                    $res_query = mysqli_query($conn, $sql2);

                                    echo '<script>alert("출금요청이 취소되었습니다!")</script>';
                                    echo ("<script>location.href='index.php?view_users_withdrawal'</script>");
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