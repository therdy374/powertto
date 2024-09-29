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
                <strong>
                    <h6 class="mb-4 text-center text-primary">사용자 구매 목록</h6>
                </strong>

                <div class="table-responsive">
                    <table class="table table-bordered text-white" style="font-size: small;" id="myTable1">
                        <thead>
                            <tr>
                                <th class="text-center">SI No</th>
                                <th class="text-center">사용자ID</th>
                                <th class="text-center">CODE</th>
                                <th class="text-center">선택한 번호</th>
                                <th class="text-center">파워볼</th>
                                <th class="text-center">시스템 결제</th>
                                <th class="text-center">상태 확인</th>
                                <th class="text-center">구매일</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            include "./inc/connect.php";

                            $referal_code = $_SESSION['referal_code'];
                            $get_users = "SELECT 
                                            id,
                                            username,
                                            user_id,
                                            selected_numbers,
                                            powerballs,
                                            payment,
                                            purchase_status,
                                            referal_code,
                                            date_purchase
                                          FROM user_purchases
                                          WHERE referal_code = '$referal_code'
                                          ORDER BY date_purchase DESC";

                            $result_query = mysqli_query($conn, $get_users);
                            $daily_totals = [];
                            $grand_total = 0;
                            $current_date = null;
                            $daily_sum = 0;

                            if ($result_query) {
                                while ($run_query = mysqli_fetch_assoc($result_query)) {
                                    $date_purchase = date('Y.m.d', strtotime($run_query['date_purchase']));
                                    $payment = $run_query['payment'];

                                    if ($current_date !== $date_purchase && $current_date !== null) {
                                        echo "<tr class='text-center'>";
                                        echo "<td colspan='5' class='text-end'><strong>{$current_date}</strong></td>";
                                        echo "<td colspan='3' style='text-align:left; color:red'><strong>Daily Total: ₩ " . number_format($daily_sum) . "</strong></td>";
                                        echo "</tr>";

                                        $daily_totals[$current_date] = $daily_sum;
                                        $daily_sum = 0;
                                    }

                                    $current_date = $date_purchase;
                                    $daily_sum += $payment;
                                    $grand_total += $payment;

                                    $selectedNumbers = explode(',', $run_query["selected_numbers"]);
                                    sort($selectedNumbers);
                                    $sortedNumbers = implode(', ', $selectedNumbers);

                                    $id = $run_query['id'];
                                    $user_username = $run_query['username'];
                                    $user_refCode = $run_query['referal_code'];
                                    $powerballs = $run_query['powerballs'];
                                    $purchase_status = $run_query['purchase_status'];
                                    $formatted_date_purchase = date('Y.m.d(D) h:i:s(A)', strtotime($run_query['date_purchase']));
                                    ?>

                                    <tr class='text-center'>
                                        <td><?php echo htmlspecialchars($id); ?></td>
                                        <td><?php echo htmlspecialchars($user_username); ?></td>
                                        <td><?php echo htmlspecialchars($user_refCode); ?></td>
                                        <td><?php echo htmlspecialchars($sortedNumbers); ?></td>
                                        <td><?php echo htmlspecialchars($powerballs); ?></td>
                                        <td>₩ <?php echo number_format($payment); ?></td>
                                        <td>
                                            <?php
                                            if ($purchase_status == 0) {
                                                echo '<span class="badge bg-success">Active</span>';
                                            } else {
                                                echo '<span class="badge bg-danger">Cancel</span>';
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($formatted_date_purchase); ?></td>
                                    </tr>
                                    <?php
                                }
                                
                                // Print the last daily total
                                if ($current_date !== null) {
                                    echo "<tr class='text-center'>";
                                    echo "<td colspan='5' class='text-end'><strong>{$current_date}</strong></td>";
                                    echo "<td colspan='3' style='text-align:left; color:red'><strong>Daily Total: ₩ " . number_format($daily_sum) . "</strong></td>";
                                    echo "</tr>";
                                    
                                    $daily_totals[$current_date] = $daily_sum;
                                }
                            } else {
                                echo '<tr><td colspan="8" class="text-center">No records found</td></tr>';
                            }
                            ?>
                        </tbody>

                        <tfoot>
                            <tr class="text-center">
                                <td colspan="5" class="text-end"><strong>Overall Total:</strong></td>
                                <td colspan="3" style="text-align:left; color:green"><strong>₩ <?php echo number_format($grand_total); ?></strong></td>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Table End -->

<script>
    function validateForm(form) {
        var action = form.action.value;
        if (action === "Select") {
            alert("Please select an action!");
            return false;
        }
        return true;
    }
</script>
