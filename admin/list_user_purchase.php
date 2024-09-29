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
                    <h6 class="mb-4 text-center text-primary">사용자 구매 목록</h6>
                </strong>
                <?php //include_once("./data/admin_new_modal.php"); 
                ?>
                <!-- <div class="d-flex">
                    <a href="#addnew" class="btn btn-primary text-light btn-sm mx-0 my-2" data-bs-toggle="modal"><i class="bi bi-plus-square me-2"></i>Add new admin</a>
                </div> -->
                <div class="table-responsive ">
                    <table class="table table-bordered text-white" style="font-size: small;" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center">SI No</th>
                                <th class="text-center">사용자ID</th>
                                <th class="text-center">넘버</th>
                                <th class="text-center">선택한 번호</th>
                                <th class="text-center">파워볼</th>
                                <th class="text-center">시스템 결제</th>
                                <th class="text-center">상태 확인</th>
                                <th class="text-center">계정 상태</th>
                                <th class="text-center">구매일</th>
                                <th class="text-center">보다</th>
                                <th class="text-center">삭제</th>
                            </tr>
                        </thead>

                        <?php
                        include "./inc/connect.php";

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $action = $_POST["action"];
                            $id = $_POST["id"];

                            if ($action == "Cancel") {
                                // Get the payment amount to refund
                                $get_payment_query = "SELECT payment, date_purchase FROM `user_purchases` WHERE id = $id";
                                $payment_result = mysqli_query($conn, $get_payment_query);
                                $payment_row = mysqli_fetch_assoc($payment_result);
                                $payment_amount = $payment_row['payment'];
                                $date_purchase = $payment_row['date_purchase'];

                                // Update the user's credit column
                                $get_user_query = "SELECT credit FROM `users` WHERE id = (SELECT user_id FROM `user_purchases` WHERE id = $id)";
                                $user_result = mysqli_query($conn, $get_user_query);
                                $user_row = mysqli_fetch_assoc($user_result);
                                $current_credit = $user_row['credit'];

                                $new_credit = $current_credit + $payment_amount;

                                $update_credit_query = "UPDATE `users` SET credit = $new_credit WHERE id = (SELECT user_id FROM `user_purchases` WHERE id = $id)";
                                mysqli_query($conn, $update_credit_query);

                                // Update the purchase status to 1 (Cancelled)
                                $update_purchase_query = "UPDATE `user_purchases` SET payment= '0', winning_amount ='0', purchase_status = '1' WHERE id = $id";
                                mysqli_query($conn, $update_purchase_query);

                                // Update the admin_fee column to 0 in admins_fee table with the same date
                                $update_admin_fee_query = "UPDATE `admins_fee` SET admin_fee = 0 WHERE date_purchase = '$date_purchase'";
                                mysqli_query($conn, $update_admin_fee_query);

                                // Display alert message
                                echo "<script>alert('Cancellation successful!');</script>";
                            }
                        }

                        $current_month = date('m');
                        $current_year = date('Y');

                        $get_users = "SELECT * FROM user_purchases WHERE MONTH(date_purchase) = $current_month AND YEAR(date_purchase) = $current_year ORDER BY date_purchase DESC";

                        // Modify the query to filter out entries older than 2 months
                        // $get_users = "SELECT * FROM `user_purchases` WHERE date_purchase >= DATE_SUB(NOW(), INTERVAL 1 MONTH) ORDER BY `date_purchase` DESC";

                        $result_query = mysqli_query($conn, $get_users);
                        while ($run_query = mysqli_fetch_array($result_query)) {

                            $selectedNumbers = explode(',', $run_query["selected_numbers"]);
                            sort($selectedNumbers);
                            $sortedNumbers = implode(', ', $selectedNumbers);
                            $id = $run_query['id'];
                            $user_username = $run_query['username'];
                            $user_id = $run_query['user_id'];
                            $selected_numbers = $run_query['selected_numbers'];
                            $powerballs = $run_query['powerballs'];
                            $payment = $run_query['payment'];
                            $purchase_status = $run_query['purchase_status'];
                            $date_purchase = date('Y.m.d(D) h:i:s(A)', strtotime($run_query['date_purchase']));
                        ?>

                            <tr class='text-center'>
                                <td><?php echo $id ?></td>
                                <td><?php echo $user_username ?></td>
                                <td><?php echo $user_id ?></td>
                                <td><?php echo $sortedNumbers ?></td>
                                <td><?php echo $powerballs ?> </td>
                                <td>₩ <?php echo number_format($payment) ?> </td>
                                <td>
                                    <form action="" method="POST" onsubmit="return validateForm(this)">
                                        <input type="hidden" name="id" value="<?php echo $id ?>">
                                        <select name="action">
                                            <option value="Select">선택하다</option>
                                            <!-- <option value="Confirm">확인하다</option> -->
                                            <option value="Cancel">취소</option>
                                        </select>
                                        <button type="submit">제출하다</button>
                                    </form>
                                </td>
                                <td>
                                    <?php
                                    if ($run_query['purchase_status'] == 0) {
                                        echo '<span class="badge bg-success">Active</span>';
                                    } else {
                                        echo '<span class="badge bg-danger">Cancel</span>';
                                    }
                                    ?>
                                </td>
                                <td> <?php echo $date_purchase ?></td>
                                <td><a href='index.php?list_edit_user=<?php echo $id ?>' class='text-success'><i class='fa-solid fa-pen-to-square'></i></a></td>
                                <td><a href='index.php?delete_list_user=<?php echo $id ?>' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td>
                            </tr>
                        <?php
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

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Table End -->