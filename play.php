<?php
$page_title = "List Purchase";

require "./includes/menubar.php";
?>

<section class="container" style="padding-top: 130px;">
    <h1 class="content-tit visual01"><span>파워또</span></h1>
    <div class="header">
        <h2>파워또</h2>
        <div class="btn-w">
            <a href="javascript:void(0);" class="tab-view">파워또
                <div class="tab-view-layer" style="display: none;">
                    <h3>파워또 (POWER TTO)</h3>
                    <div>
                        파워또는 동행 복권 파워볼의 기반으로
                        당일 마지막 추첨번호를 적용하여
                        참여자들 중 당첨자를 추첨하며
                        현실적인 당첨 확률과 현실적인 당첨 금액을
                        지급하는 1일 추첨 복권입니다.
                    </div>
                </div>
            </a>
            <a href="notice.php">이용안내 보기</a>
        </div>
        <div class="navi">
            <a href="/index.php">홈으로</a>
            <span>로또구매</span>
            <span>파워볼</span>
        </div>
    </div>

    <div class="contents">
        <ul class="depth2-menu">
            <li class="item select"><a href="lotto_pb.php">파워또</a></li>
        </ul>
        <div class="inner-contents">
            <div class="prize-num-w">
                <?php
                include "./includes/connect.php";

                $last_draw = "SELECT * FROM generate_numbers ORDER BY generated_at DESC LIMIT 1";
                $query = mysqli_query($conn, $last_draw);

                while ($row = mysqli_fetch_assoc($query)) {
                    $last_mdraw = $row['main_numbers'];
                    $last_pdraw = $row['powerball_number'];
                    $generated_at = date('Y.m.d (D)', strtotime($row['generated_at']));
                }
                ?>
                <div class="prize-tit">
                    최근추첨번호 <span class="ico-state bg-bl">이월</span>
                    <div><?php echo $generated_at; ?> 24:00 (한국 시간)</div>
                </div>

                <?php

                $sql = "SELECT main_numbers, powerball_number FROM generate_numbers ORDER BY generated_at DESC LIMIT 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        $mainNumbers = explode(",", $row['main_numbers']);
                        $powerballNumber = $row['powerball_number'];
                    }
                    echo "<div class='prize-num'>";
                    echo '<span>' . $mainNumbers[0] . '</span>';
                    echo '<span>' . $mainNumbers[1] . '</span>';
                    echo '<span>' . $mainNumbers[2] . '</span>';
                    echo '<span>' . $mainNumbers[3] . '</span>';
                    echo '<span>' . $mainNumbers[4] . '</span>';
                    echo '<span class="bg-pk">' . $powerballNumber . '</span>';
                    echo "</div>";
                } else {
                    echo "0 results";
                }

                ?>

            </div>

            <h3 class="tit-lotto-buy"><img src="asset/images/newPtto.jpg" alt="파워볼"></h3>

            <!-- List of user total amount user -->
            <div class="table-lisw-w table-line-type buy-select-num">
                <?php
                include "./includes/connect.php";

                date_default_timezone_set('Asia/Seoul');

                $resultsPerPage = 10;
                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

                // Calculate the offset for pagination
                $offset = ($currentPage - 1) * $resultsPerPage;

                $sql2 = "SELECT COUNT(*) AS row_count FROM generate_numbers";
                $query_run2 = mysqli_query($conn, $sql2);

                if ($query_run2->num_rows > 0) {
                    $row = $query_run2->fetch_assoc();
                    $rowCount = $row['row_count'];
                    $totalPages = ceil($rowCount / $resultsPerPage);
                ?>
                    <div>
                        <h3 class="tit-h3 mt50">날짜별 추첨 목록</h3>
                        <strong><span class="t-red">오늘의 총 구매량은: <?php echo $rowCount; ?> </span></strong>
                    </div>

                    <div class="table-head">
                        <div class="search-w">
                            <span class="t-red">
                                <!-- Date Today: <?php echo date("Y-m-d (l)"); ?> -->
                            </span>
                        </div>
                    </div>
                <?php
                } else {
                    echo "No participants today";
                }
                ?>

                <div class="item th-head">
                    <div class="pw20p"><span class="">추첨날짜</span></div>
                    <div class="pw22p">(일반볼)선택번호</div>
                    <div class="pw22p">(파워볼)선택번호</div>
                    <div class="pw20p">당첨금</div>
                    <div class="pw20p">당첨자 수</div>
                </div>

                <div class="tbody">
                    <?php
                    include "./includes/connect.php";

                    // Pagination
                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                    $records_per_page = 20;
                    $offset = ($page - 1) * $records_per_page;

                    $sql_dates_count = "SELECT COUNT(DISTINCT DATE(generated_at)) AS total_dates FROM generate_numbers";
                    $result_dates_count = mysqli_query($conn, $sql_dates_count);
                    $total_dates_row = mysqli_fetch_assoc($result_dates_count);
                    $total_dates = $total_dates_row['total_dates'];
                    $total_pages = ceil($total_dates / $records_per_page);

                    $sql_dates = "SELECT DISTINCT DATE(generated_at) AS draw_date FROM generate_numbers ORDER BY draw_date DESC LIMIT $offset, $records_per_page";
                    $result_dates = mysqli_query($conn, $sql_dates);


                    while ($date_row = mysqli_fetch_assoc($result_dates)) {
                        $current_date = $date_row['draw_date'];

                        $sql_purchases = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 WHERE Date(t1.date_purchase) = '$current_date' AND Date(t2.generated_at) = '$current_date'";
                        $result_query = $conn->query($sql_purchases);

                        if ($result_query->num_rows > 0) {
                            $total_winning = 0;
                            $maxMatches = 0; // Initialize maxMatches counter
                            $maxMatchesRows = array(); // Initialize array to hold rows with max matches

                            while ($row = $result_query->fetch_assoc()) {

                                $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
                                $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
                                $numMatches = count($matchingNumbers);

                                if ($matchingPowerball) {
                                    $numMatches++;
                                }

                                if ($numMatches >= 1 && $numMatches <= 6) {
                                    // Update maxMatches if the current row has more matches
                                    if ($numMatches > $maxMatches) {
                                        $maxMatches = $numMatches;
                                        // Reset the array with new row
                                        $maxMatchesRows = array($row);
                                    } elseif ($numMatches == $maxMatches) {
                                        // If there's a tie, add the row to the array
                                        $maxMatchesRows[] = $row;
                                    }
                                }
                            }

                            // Count the number of users with the maximum number of matches
                            $winnerCount = count($maxMatchesRows);
                        } else {
                            echo "No matching records found for date: $current_date";
                            continue;
                        }

                        $sql_draws = "SELECT * FROM generate_numbers WHERE DATE(generated_at) = '$current_date' ORDER BY generated_at DESC";
                        $result_draws = mysqli_query($conn, $sql_draws);
                    }


                    if (mysqli_num_rows($result_draws) > 0) {
                        while ($row = mysqli_fetch_assoc($result_draws)) {

                            echo "<div class='item'>";
                            echo '<div class="pw20p">' . date('Y.m.d (D)', strtotime($row['generated_at'])) . '</div>';

                            echo '<div class="pw22p">' . $row['main_numbers'] . '</div>';
                            echo '<div class="pw22p t-red">' . $row["powerball_number"] . '</div>';
                            echo '<div class="pw20p t-red">' . number_format($row["winning_price"]) . '</div>';
                            echo '<div class="pw20p">' . $winnerCount . ' 사람</div>';
                            echo "</div>";
                        }
                    } else {
                        echo "No results found for date: $current_date";
                    }

                    echo "<div class='pagination'>";
                    if ($total_pages > 1) {
                        echo "<ul>";
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $page) {
                                echo "<li class='active'><a href='#'>$i</a></li>";
                            } else {
                                echo "<li><a href='?page=$i'>$i</a></li>";
                            }
                        }
                        echo "</ul>";
                    }
                    echo "</div>";

                    ?>
                </div>

    
            </div>
            <!-- Pagination controls centered -->
            <style>
                .pagination {
                    margin-top: 20px;
                    text-align: center;
                }

                .pagination ul {
                    display: inline-block;
                    padding: 0;
                    margin: 0;
                }

                .pagination ul li {
                    display: inline;
                    margin-right: 5px;
                }

                .pagination ul li a {
                    color: #333;
                    text-decoration: none;
                    padding: 5px 10px;
                    border: 1px solid #ccc;
                }

                .pagination ul li.active a {
                    /* background-color: #333;
                    color: #fff;
                    border-color: #333; */
                    background-color: #3b5ccb;
                    color: white;
                    border: 1px solid #3b5ccb;
                }
            </style>


        </div>
    </div>
</section>

<?php require "includes/footer.php"; ?>