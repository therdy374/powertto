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
                <h6 class="mb-4 text-center text-primary">Commission History</h6>
                <?php include_once("./data/admin_new_modal.php");
                ?>
                <div class="d-flex">
                    <a href="#add_admin" class="btn btn-primary text-light btn-sm mx-0 my-2" data-bs-toggle="modal"><i class="bi bi-plus-square me-2"></i>새 관리자</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered text-white text-left" style="font-size: small;" id="myTable">
                        <thead>
                            <tr>
                                <th>Date Transaction</th>
                                <th>Admin Level</th>
                                <th>Admin ID</th>
                                <th>Referal Code #</th>
                                <th>Total Daily Payment</th>

                            </tr>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            // Sum payments for every user grouped by date
                            $sum_query = "
                                        SELECT 
                                            a.id, 
                                            a.referal_code,
                                            a.parent_name, 
                                            COALESCE(b.username, 'ROOT') AS parent_name, 
                                            a.username AS child_name, 
                                            a.admin_level, 
                                            c.admin_comm, 
                                            c.date_transaction AS transaction_date,
                                            SUM(c.admin_comm) AS total_daily_payment
                                        FROM 
                                            admins a 
                                        LEFT JOIN 
                                            admins b ON a.parent_name COLLATE utf8mb4_unicode_ci = b.referal_code COLLATE utf8mb4_unicode_ci
                                        LEFT JOIN 
                                            commission_history c ON a.referal_code COLLATE utf8mb4_unicode_ci = c.referal_code COLLATE utf8mb4_unicode_ci
                                        GROUP BY
                                            a.id, a.referal_code, a.parent_name, b.username, a.username, a.admin_level, c.date_transaction
                                        ORDER BY
                                            a.admin_level DESC;
                                    ";

                            $result_query = $conn->query($sum_query);

                            // Check if the query execution was successful
                            if ($result_query) {
                                // Loop through the results
                                while ($row = $result_query->fetch_assoc()) {
                                    $transaction_date = date('Y.m.d', strtotime($row['transaction_date']));
                                    $parent_name = htmlspecialchars($row['parent_name']);
                                    $child_name = htmlspecialchars($row['child_name']);
                                    $referal_code = htmlspecialchars($row['referal_code']);
                                    $admin_level = htmlspecialchars($row['admin_level']);
                                    $total_daily_payment = isset($row['total_daily_payment']) ? number_format($row['total_daily_payment'], 2) : '0.00';
                            ?>
                                    <tr class="">
                                        <td><?php echo $transaction_date; ?></td>
                                        <td data-bs-toggle="collapse" data-bs-target=".group-<?php echo $referal_code; ?>" style="cursor: pointer;"><?php echo "Lvl " .$admin_level. " - " .$child_name ?></td>
                                        <!-- <td><?php echo $parent_name; ?></td> -->

                                        <td data-bs-toggle="collapse" data-bs-target=".group-<?php echo $referal_code; ?>" style="cursor: pointer;"><?php echo $child_name; ?></td>
                                        <td><?php echo $referal_code; ?></td>
                                        <td><?php echo $total_daily_payment; ?> ₩</td>
                                    </tr>

                                    <!-- Toggle Content -->
                                    <?php
                                    // Retrieve child users
                                    $get_users = "
                                                    SELECT 
                                                        a.id, 
                                                        a.referal_code,
                                                        a.parent_name AS Parent_CODE, 
                                                        IFNULL(b.username, 'ROOT') AS Parent_Name,
                                                        a.username AS child_name, 
                                                        a.admin_level, 
                                                        c.admin_comm, 
                                                        c.date_transaction AS transaction_date
                                                    FROM 
                                                        admins a 
                                                    LEFT JOIN 
                                                        admins b ON a.parent_name COLLATE utf8mb4_unicode_ci = b.referal_code COLLATE utf8mb4_unicode_ci
                                                    LEFT JOIN 
                                                        commission_history c ON a.referal_code COLLATE utf8mb4_unicode_ci = c.referal_code COLLATE utf8mb4_unicode_ci
                                                    WHERE
                                                        a.parent_name = ? 
                                                    ORDER BY
                                                        a.admin_level DESC;
                                                ";

                                    $stmt = $conn->prepare($get_users);
                                    $stmt->bind_param("s", $referal_code);
                                    $stmt->execute();
                                    $result_users = $stmt->get_result();

                                    if ($result_users) {
                                        while ($child_row = $result_users->fetch_assoc()) {
                                            $child_username = htmlspecialchars($child_row['child_name']);
                                            $child_parent = htmlspecialchars($child_row['Parent_Name']);
                                            $child_admin_level = htmlspecialchars($child_row['admin_level']);
                                            $child_referal_code = htmlspecialchars($child_row['referal_code']);
                                    ?>
                                            <tr class="collapse group-<?php echo $referal_code; ?>" data-bs-parent="tbody">
                                                <td><?php echo $transaction_date; ?></td>
                                                <td class="text-primary">
                                                    <?php
                                                    if ($child_admin_level == 4) {
                                                        echo "<span style='padding-left: 10px;'>ㄴ Lvl " . $child_admin_level ." - " .$child_username. "</span>";
                                                    } 
                                                    elseif ($child_admin_level == 3) {
                                                        echo "<span style='padding-left: 20px;'>ㄴ Lvl " . $child_admin_level ." - " .$child_username. "</span>";
                                                    }
                                                    elseif ($child_admin_level == 2) {
                                                        echo "<span style='padding-left: 40px;'>ㄴ Lvl " . $child_admin_level ." - " .$child_username. "</span>";
                                                    } elseif ($child_admin_level == 1) {
                                                        echo "<span style='padding-left: 40px;'>ㄴ Lvl " . $child_admin_level ." - " .$child_username. "</span>";
                                                    }

                                                    ?>
                                                </td>

                                                <!-- <td class="text">
                                                    <?php
                                                    echo "<span style='padding-left: 10px;'>ㄴ " . $child_parent . "</span>";
                                                  
                                        

                                                    ?>
                                                </td> -->
                                                <td class="text-primary" style="cursor: pointer;">
                                                    <?php 
                                                    

                                                    if($child_admin_level == 3 )
                                                    {
                                                        echo "<span style='padding-left: 10px;'>ㄴ " . $child_username . "</span>";  
                                                    }
                                                    elseif($child_admin_level == 2)
                                                    {
                                                        echo "<span style='padding-left: 20px;'>ㄴ " . $child_username . "</span>";  
                                                    }
                                                    elseif($child_admin_level == 1)
                                                    {
                                                        echo "<span style='padding-left: 20px;'>ㄴ " . $child_username . "</span>";  
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $child_referal_code; ?></td>
                                                <td><?php echo number_format(0, 2); ?> ₩</td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>Error retrieving users: " . $conn->error . "</td></tr>";
                                    }
                                    ?>
                            <?php
                                }
                            } else {
                                // Handle the query error
                                echo "<tr><td colspan='9'>Error executing query: " . $conn->error . "</td></tr>";
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