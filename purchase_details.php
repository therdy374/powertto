<?php
$page_title = "Purchase Details";

require "./includes/menubar.php";

?>

<style>
    body {
        overflow-x: hidden;
        height: 100%;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        align-items: center;
        /* Align items vertically */
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
        transition: background-color 0.3s, color 0.3s;
    }

    .pagination a.active {
        background-color: #3b5ccb;
        color: white;
        border: 1px solid #3b5ccb;
    }

    /* Add hover effect */
    .pagination a:hover {
        background-color: #3b5ccb;
        color: white;
    }

    /* Add margin to the 'Showing X to Y of Z entries' text */
    .pagination span {
        margin: 0 10px;
    }

    /* Center the 'Showing X to Y of Z entries' text */
    .pagination-container span {
        flex: 1;
        /* Fill remaining space */
        text-align: center;
    }

    @media screen and (max-width:768px) {
        .container .header h2 {
            font-size: 25px;
            margin-top: 50px;
        }

        .table-comm th {
            font-size: 10px;
            letter-spacing: -0.05em;
            padding: 5px 3px;
        }

        .table-comm td {
            font-size: 12px;
            letter-spacing: -0.05em;
            padding: 5px 1px;
        }


    }
</style>


<section class="container">
    <?php alertMessage(); ?>
    <!-- <h1 class="content-tit visual04"><span>로또안내</span></h1> -->
    <div class="header">
        <h2>구매내역</h2>
        <div class="btn-w">
            <a href="lotto_pb.php">파워또 구매하기</a>
        </div>
        <div class="navi">
            <a href="home.php">홈으로</a>
            <span>로또안내</span>
            <span>구매내역</span>
        </div>
    </div>
    <div class="contents">
        <ul class="depth2-menu">
            <li class="item select"><a href="purchase_details.php">구매내역</a></li>
        </ul>
        <div class="img-prize mt30 img-prize-logo"><img src="./asset/images/newPtto.jpg" alt="파월볼"></div>
        <div class="inner-contents">

            <?php
            $user_id = $_SESSION['loggedInUser']['user_id'];
            $results_per_page = 20;

            // Get total row count with date condition
            $sql2 = "SELECT COUNT(*) AS row_count FROM user_purchases WHERE user_id = '$user_id' AND date_purchase >= CURDATE() - INTERVAL 20 DAY";
            $query_run2 = mysqli_query($conn, $sql2);

            if ($query_run2->num_rows > 0) {
                $row = $query_run2->fetch_assoc();
                $rowCount = $row['row_count'];
                $totalPages = ceil($rowCount / $results_per_page);

                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

                // Calculate the starting index for the results on the current page
                $start_index = ($currentPage - 1) * $results_per_page;

                // Fetch user purchases with pagination and date condition
                $sql = "SELECT * FROM user_purchases WHERE user_id = '$user_id' AND date_purchase >= CURDATE() - INTERVAL 20 DAY ORDER BY date_purchase DESC LIMIT $start_index, $results_per_page";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
            ?>
                    <h3 class="tit-h3 mt50">총 구매내역: <strong><span class="t-red"><?php echo $rowCount; ?></span></strong></h3>
                    <!-- <strong><span class="t-red">총 구매내역: <?php echo $rowCount; ?></span></strong> -->
                    <div class="m-overflow mt10">
                        <strong><h1  class="t-red" style="text-align: center;font-size: 14px;">구매일로 20일이 지난 내역은 자동으로 삭제 처리됩니다.</h1><br></strong>
                        <table class="table-comm w100p" cellpadding="0" cellspacing="0">
                            <colgroup>
                                <col style="width:20%">
                                <col style="width:20%">
                                <col style="width:20%">
                                <col style="width:20%">
                                <col style="width:20%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>사용자 ID</th>
                                    <th>구매번호</th>
                                    <th>지급상</th>
                                    <th>구매 모드</th>
                                    <th>상황</th>
                                    <th>구매일자</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    setlocale(LC_TIME, 'ko_KR.utf8'); // Set locale to Korean
                                    $days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");

                                    $timestamp = strtotime($row['date_purchase']);
                                    $date_purchase = new DateTime();
                                    $date_purchase->setTimestamp($timestamp);
                                    $day_of_week = $days[date('w', $timestamp)]; // Convert day of the week to Korean

                                    // Explode, sort, and implode the selected_numbers
                                    $selectedNumbers = explode(',', $row["selected_numbers"]);
                                    sort($selectedNumbers);
                                    $sortedNumbers = implode(', ', $selectedNumbers);

                                    $rowClass = ($row['marked'] == 0) ? 'highlight' : '';
                                    echo "<tr data-id='" . $row['id'] . "' class='$rowClass'>";

                                    echo '
                                <td>' . $row["username"] . '</td>
                                <td class="t-c">
                                    ' . $sortedNumbers . ', <span class="t-red">' . $row["powerballs"] . '</span>
                                </td>
                                <td class="t-c">' . number_format($row["to_received"]) . ' ₩</td>
                                <td class="t-c">';
                                    if ($row['purchase_status'] == 0) {
                                        echo '<span class="t-gr">구매완료</span>';
                                    } else {
                                        echo '<span class="t-red">취소</span>';
                                    }
                                    echo '</td>
                            <td>' . $row["modes"] . '</td>
                                <td class="t-c">' . $date_purchase->format('Y.m.d ') . "({$day_of_week}) " . date('h:i(A)') . '</td>
                            </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- Pagination controls centered -->
                        <div class="pagination-container">
                            <div class="pagination">
                                <?php
                                // Define a function to generate pagination links
                                function generatePagination($totalPages, $currentPage)
                                {
                                    $pagination = '<div class="pagination">';

                                    // Previous button
                                    if ($currentPage > 1) {
                                        $pagination .= '<a href="?page=' . ($currentPage - 1) . '">Previous</a>';
                                    }

                                    // First page
                                    if ($currentPage > 2) {
                                        $pagination .= '<a href="?page=1">1</a>';
                                    }

                                    // Ellipsis after the first page
                                    if ($currentPage > 3) {
                                        $pagination .= '<span>...</span>';
                                    }

                                    // Pages before the current page
                                    for ($i = max(1, $currentPage - 1); $i < $currentPage; $i++) {
                                        $pagination .= '<a href="?page=' . $i . '">' . $i . '</a>';
                                    }

                                    // Current page
                                    $pagination .= '<span class="active">' . $currentPage . '</span>';

                                    // Pages after the current page
                                    for ($i = $currentPage + 1; $i <= min($totalPages, $currentPage + 1); $i++) {
                                        $pagination .= '<a href="?page=' . $i . '">' . $i . '</a>';
                                    }

                                    // Ellipsis before the last page
                                    if ($currentPage < $totalPages - 2) {
                                        $pagination .= '<span>...</span>';
                                    }

                                    // Last page
                                    if ($currentPage < $totalPages - 1) {
                                        $pagination .= '<a href="?page=' . $totalPages . '">' . $totalPages . '</a>';
                                    }

                                    // Next button
                                    if ($currentPage < $totalPages) {
                                        $pagination .= '<a href="?page=' . ($currentPage + 1) . '">Next</a>';
                                    }

                                    $pagination .= '</div>';

                                    return $pagination;
                                }

                                // Generate pagination links
                                echo generatePagination($totalPages, $currentPage);
                                ?>
                            </div>
                        </div>
                    </div>
            <?php
                } else {
                    echo "No purchase records found in the last 20 days.";
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