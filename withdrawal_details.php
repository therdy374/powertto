<?php
$page_title = "Withdrawals Details";

require "./includes/menubar.php";

?>

<style>
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
    }

    .pagination a {
        padding: 8px 12px;
        margin: 0 4px;
        border: 1px solid #ccc;
        text-decoration: none;
        color: #333;
        border-radius: 4px;
    }

    .pagination a.active {
        background-color: #3b5ccb;
        color: white;
        border: 1px solid #3b5ccb;
    }

    .highlight {
        background-color: lightblue;
    }

    .depth2-menu .item.select2 a,
    .depth2-menu .item a:hover {
        background: #6d7aff;
        color: #FFF;
    }

    @media only screen and (max-width: 600px) {
        .depth2-menu {
            display: block;
        }

        .depth2-menu li {
            display: block;
            border: none;
            padding: 10px 10px;
            box-sizing: border-box;
            white-space: now;
        }

        .depth2-menu li a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #171717;
        }

        .depth2-menu .item.select2 a,
        .depth2-menu .item a:hover {
            background: #6d7aff;
            color: #FFF;
        }

        .depth2-menu .item {
            width: 100%;

        }

        .container .header h2 {
            font-size: 25px;
            margin-top: 25px;
        }
    }
</style>


<section class="container">
    <?php alertMessage(); ?>
    <!-- <h1 class="content-tit visual04"><span>로또안내</span></h1> -->
    <div class="header">
        <h2>입출금 내역</h2>
        <!-- <div class="btn-w">
            <a href="lotto_pb.php">파워볼 구매하기</a>
        </div> -->
        <div class="navi">
            <a href="home.php">홈으로</a>
            <span>파워토</span>
            <span>출금내역</span>
        </div>
    </div>

    <div class="contents">
        <ul class="depth2-menu">
            <li class="item select"><a href="deposit_details.php">입금내역</a></li>
            <li class="item select2 "><a href="withdrawal_details.php">출금내역</a></li>
        </ul>
        
        <div class="inner-contents">
            <?php
            $user_id = $_SESSION['loggedInUser']['user_id'];
            $results_per_page = 10;

            // Get total row count with the new condition
            $sql2 = "SELECT COUNT(*) AS row_count FROM user_withdrawal_request WHERE user_id = '$user_id' AND DATE(date_withdrawal) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
            $query_run2 = mysqli_query($conn, $sql2);

            if ($query_run2->num_rows > 0) {
                $row = $query_run2->fetch_assoc();
                $rowCount = $row['row_count'];
                $totalPages = ceil($rowCount / $results_per_page);

                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

                // Calculate the starting index for the results on the current page
                $start_index = ($currentPage - 1) * $results_per_page;

                // Fetch user purchases with pagination and the new condition
                $sql = "SELECT * FROM user_withdrawal_request WHERE user_id = $user_id AND DATE(date_withdrawal) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) ORDER BY `date_withdrawal` DESC LIMIT $start_index, $results_per_page";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // Calculate starting number for descending order
                    $num = $rowCount - $start_index;
            ?>
                    <h3 class="tit-h3 mt50">총보증금:<strong><span class="t-red"> <?php echo $rowCount; ?></span></strong></h3>

                    <div class="m-overflow mt10">
                        <strong>
                            <h1 class="t-red" style="text-align: center;font-size: 14px;">입출금 7일이 지난 내역은 자동으로 삭제 처리됩니다.</h1><br>
                        </strong>
                        <table class="table-comm w100p" cellpadding="0" cellspacing="0">
                            <colgroup>
                                <col style="width:16.66%">
                                <col style="width:16.66%">
                                <col style="width:16.66%">
                                <col style="width:16.66%">
                                <col style="width:16.66%">
                                <col style="width:16.66%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>요청일시</th>
                                    <th>종류</th>
                                    <th>금액</th>
                                    <th>상태</th>
                                    <th>액션</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $days_old = (time() - strtotime($row['date_withdrawal'])) / (60 * 60 * 24);
                                    $reminder_class = $days_old > 30 ? 'reminder' : '';
                                    $hide_class = $row['hide'] == 1 ? 'hide-row' : '';

                                    echo "<tr class='$reminder_class $hide_class' data-id='{$row['id']}'>";
                                    echo '
                                        <td>' . $num-- . '</td>
                                        <td class="t-c">' . date('Y.m.d(D) h:i:s(A)', strtotime($row['date_withdrawal'])) . '</td>
                                        <td>' . $row["name"] . '</td>
                                        <td class="t-c">
                                            <span class="t-red">' . number_format($row["amount_withdrawal"]) . ' ₩</span>
                                        </td>
                                        <td class="t-c">' . $row["status"] . '</td> 
                                        <td class="t-c" style="font-size: 14px;"><button onclick="toggleHide(' . $row['id'] . ', ' . $row['hide'] . ')">지우다</button></td> 
                                    </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- Pagination controls centered -->
                        <div class="pagination-container">
                            <div class="pagination">
                                <?php
                                if ($currentPage > 1) {
                                    echo '<a href="?page=' . ($currentPage - 1) . '">Previous</a>';
                                }

                                for ($page = 1; $page <= $totalPages; $page++) {
                                    echo '<a ' . ($page == $currentPage ? 'class="active"' : '') . ' href="?page=' . $page . '">' . $page . '</a>';
                                }

                                if ($currentPage < $totalPages) {
                                    echo '<a href="?page=' . ($currentPage + 1) . '">Next</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <script>
                        function toggleHide(id, currentHideStatus) {
                            const newHideStatus = currentHideStatus === 1 ? 0 : 1;
                            const row = document.querySelector(`tr[data-id='${id}']`);

                            if (row) {
                                row.classList.toggle('hide-row');
                                const xhr = new XMLHttpRequest();
                                xhr.open('POST', 'update_hide_withdrawal.php', true);
                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                xhr.onload = function() {
                                    if (xhr.status === 200) {
                                        console.log('Hide status updated successfully');
                                    } else {
                                        console.error('An error occurred while updating hide status');
                                    }
                                };
                                xhr.send('id=' + id + '&hide=' + newHideStatus);
                            }
                        }
                    </script>
                    <style>
                        .hide-row {
                            display: none;
                        }

                        .reminder {
                            background-color: #03363d7d;
                        }
                    </style>
            <?php
                } else {
                    echo "입금 내역이 없습니다.";
                }
            }
            ?>
        </div>
    </div>
</section><br>

<script>
    function markRow(id) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    var row = document.querySelector("tr[data-id='" + id + "']");
                    row.classList.toggle('highlight');
                } else {
                    console.error("Error updating record");
                }
            }
        };
        xhr.open("GET", "update_marked.php?id=" + id, true);
        xhr.send();
    }
</script>

<?php include "./includes/footer.php"; ?>