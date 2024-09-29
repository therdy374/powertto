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
                date_default_timezone_set('Asia/Seoul');
                $date = date('Y-m-d');

                include "./includes/connect.php";
                $results_per_page = 20;

                $sql2 = "SELECT COUNT(*) AS row_count FROM user_purchases WHERE DATE(date_purchase)='$date'";
                $query_run2 = mysqli_query($conn, $sql2);

                if ($query_run2->num_rows > 0) {
                    $row = $query_run2->fetch_assoc();
                    $rowCount = $row['row_count'];
                    $totalPages = ceil($rowCount / $results_per_page);
                ?>
                    <div>
                        <h3 class="tit-h3 mt50">구매 참여 목록 작성</h3>
                        <strong><span class="t-red">오늘의 총 구매량은: <?php echo $rowCount; ?> </span></strong>
                    </div>

                    <div class="table-head">
                        <div class="search-w">
                            <span class="t-red">
                                Date Today: <?php echo date("Y-m-d (l)"); ?>
                            </span>
                        </div>
                    </div>
                <?php
                } else {
                    echo "No participants today";
                }
                ?>

                <div class="item th-head">
                    <div class="pw20p"><span class="">사용자 ID</span></div>
                    <div class="pw20p">(일반볼)선택번호</div>
                    <div class="pw20p">(파워볼)선택번호</div>
                    <div class="pw20p">구매모드</div>
                    <div class="pw20p">구매현황</div>
                    <div class="pw20p">구매일자</div>
                </div>

                <div class="tbody">
                    <?php
                    include "./includes/connect.php";

                    date_default_timezone_set('Asia/Seoul');
                    $date = date('Y-m-d');


                    // Calculate current page and offset
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($currentPage - 1) * $results_per_page;


                    $sql = "SELECT * FROM user_purchases WHERE DATE(date_purchase) = '$date' ORDER BY `date_purchase` DESC LIMIT $offset, $results_per_page";

                    $result = mysqli_query($conn, $sql);

                    // Function to alternate asterisks
                    function formatAsterisks($name)
                    {
                        $asteriskPositions = [2, 3, 4, 6, 8, 9, 10];
                        $formattedName = '';

                        for ($i = 0; $i < strlen($name); $i++) {
                            if (in_array($i + 1, $asteriskPositions)) {
                                $formattedName .= '*';
                            } else {
                                $formattedName .= $name[$i];
                            }
                        }

                        return $formattedName;
                    }

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {
                            
                            if ($row['purchase_status'] == 0) {

                                $originalUsername = $row['username'];
                                $formattedUsername = formatAsterisks($originalUsername);

                                echo "<div class='item'>";
                                echo '<div class="pw20p">' . $formattedUsername . '</div>';

                                // Explode, sort, and implode the selected_numbers
                                $selectedNumbers = explode(',', $row["selected_numbers"]);
                                sort($selectedNumbers);
                                $sortedNumbers = implode(', ', $selectedNumbers);

                                echo '<div class="pw20p">' . $sortedNumbers . '</div>';
                                echo '<div class="pw20p t-red">' . $row["powerballs"] . '</div>';
                                echo '<div class="pw20p t-red">' . $row['modes'] . '</div>';
                                echo '<div class="pw20p t-red">';
                                if ($row['purchase_status'] == 0) {
                                    echo '<span class="badge bg-success">구매완료</span>';
                                } else {
                                    echo '<span class="badge bg-danger">취소</span>';
                                }
                                echo '</div>';
                                echo '<div class="pw20p">' . date('Y.m.d h:i:s', strtotime($row['date_purchase'])) . '</div>';
                                echo "</div>";
                            }
                        }
                    } else {
                        echo "0 results";
                    }


                    $sql = "SELECT * FROM user_purchases WHERE DATE(date_purchase) = '$date' ORDER BY `date_purchase` DESC";
                    $query_run = mysqli_query($conn, $sql);

                    $qty = 0;
                    while ($num = mysqli_fetch_assoc($query_run)) {
                        $qty +=  $num['winning_amount'];
                    }
                    ?>
                </div>

                <!-- Pagination controls centered -->
                <div class="pagination-container">
                    <div class="pagination">
                        <?php
                        // Display Previous button
                        if ($currentPage > 1) {
                            echo '<a href="?page=' . ($currentPage - 1) . '">Previous</a>';
                        }

                        // Display automatic page links
                        for ($page = max(1, $currentPage - 2); $page <= min($totalPages, $currentPage + 2); $page++) {
                            echo '<a ' . ($page == $currentPage ? 'class="active"' : '') . ' href="?page=' . $page . '">' . $page . '</a>';
                        }

                        // Display Next button
                        if ($currentPage < $totalPages) {
                            echo '<a href="?page=' . ($currentPage + 1) . '">Next</a>';
                        }
                        ?>
                    </div>
                </div><br>

                <div class="list-result">
                    당첨금액: ₩ &nbsp; <strong><span id="odometer-container"></span></strong>
                </div>
                <!-- odometer script-->
                <script>
                    var odometer = new Odometer({
                        el: document.querySelector('#odometer-container'),
                        value: <?php echo $qty; ?>, // Set the initial value
                        format: '(,ddd)',
                    });

                    odometer.render();

                    function simulateUpdates() {
                        let currentValue = <?php echo $qty; ?>;
                        setInterval(function() {
                            currentValue += Math.floor(Math.random() * 3);
                            odometer.update(currentValue);
                        }, 5000);
                    }

                    // Run the simulation on page load
                    simulateUpdates();
                </script>
            </div>

            <style>
                .pw20p {
                    width: 16%;
                }

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

                @media screen and (max-width: 768px) {

                    body,
                    input,
                    textarea,
                    select,
                    button,
                    table,
                    div,
                    p {
                        font-size: 20px;
                        min-width: 17%;
                    }
                }
            </style>


        </div>
    </div>
</section>

<?php require "includes/footer.php"; ?>