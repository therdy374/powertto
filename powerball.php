<?php
$page_title = "Homepage";

require "./includes/menubar.php";
?>


<div class="quick-prod-top">
    <div class="con">

        <a href="./w_play/lotto_em.php" title="유로밀리언즈" class="quick-prod-em"><img src="./asset/images/logo_em.png"><span>430억</span></a>

        <a href="./w_play/lotto_cfl.php" title="캐시4라이프" class="quick-prod-cfl"><img src="./asset/images/logo_cfl.png"><span>1,000불/매일</span></a>

        <a href="./w_play/lotto_pb.php" title="파워볼" class="quick-prod-pb"><img src="./asset/images/logo_pb.png"><span>8,925억</span></a>

        <a href="./w_play/lotto_mm.php" title="메가밀리언즈" class="quick-prod-mm"><img src="./asset/images/logo_mm.png"><span>1,198억</span></a>

        <a href="./w_play/lotto_sl.php" title="슈퍼로또플러스" class="quick-prod-sl"><img src="./asset/images/logo_sl.png"><span>0억</span></a>

        <a href="./w_play/lotto_nl.php" title="뉴욕로또" class="quick-prod-nl"><img src="./asset/images/logo_nl.png"><span>127억</span></a>

        <a href="./w_play/lotto_lp.php" title="라 프리미티바" class="quick-prod-lp"><img src="./asset/images/logo_lp.png"><span>31억</span></a>

        <a href="./w_play/lotto_eg.php" title="엘 고르도" class="quick-prod-eg"><img src="./asset/images/logo_eg.png"><span>84억</span></a>

        <a href="./w_play/lotto_ej.php" title="유로 잭팟" class="quick-prod-ej"><img src="./asset/images/logo_ej.png"><span>1,450억</span></a>
    </div>
</div>

<style>
    .quick-prod-top {
        display: none
    }

    .container {
        padding-top: 130px
    }

    @media screen and (max-width:768px) {
        .container {
            padding-top: 55px
        }
    }

    .container1 {
        max-width: 1160px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        /* width: 100%; */
    }

    .withdrawal {
        margin-bottom: 10px;
        display: block;
    }

    .withdrawal h3,
    .withdrawal p {
        margin: 0;
        color: #333;
        font-size: 15px;
        display: inline-block;
    }

    .main-lotto-buy .swiper-slide {
        border-radius: 10px;
        background: #ffffff;
        padding: 13px 0px;
        min-height: 308px;
        margin-left: auto;
        align-items: center !important;
        justify-content: center !important;
        width: 320px !important;
    }

    .main-bbs-w .main-bbs-inner .con {
        position: relative;
        display: flex;
        justify-content: center;
        padding: 50px 50px 50px 50px;
        background: radial-gradient(circle, rgba(253, 116, 84, 1) 0%, rgba(255, 101, 172, 1) 100%);
        max-width: 100%;
        width: 100%;
        min-height: 480px;
        border-radius: 10px;
    }

    .main-bbs-w .main-bbs-inner .con .faq-w {
        position: relative;
        width: 37%;
    }

    /* .main-bbs-w .main-bbs-inner .con .bbs-w {
        width: 60%;
    } */
</style>

<div class="container">
    <?php alertMessage(); ?>
    <!-- Announce Winning balls -->
    <div class="main-inner-bn">
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
                최근추첨번호
                <div><?php echo $generated_at; ?> 24:00 (한국시간)</div>
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
    </div>

    <!-- list customer winner -->
    <div class="container1">

        <h4 style="font-weight: 500; color:red">전일당첨자수</h4><br>
        <?php
        include "./includes/connect.php";

        date_default_timezone_set('Asia/Seoul');
        $currentDate = new DateTime();
        $yesterday = $currentDate->modify('-1 day');
        $date = $yesterday->format('Y-m-d (l)');
        // $date = Date("2024-03-12");

        echo "Yesterday's Winners: $date";

        $last_draw = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 WHERE DATE(t1.date_purchase ) = '$date' AND DATE(t2.generated_at) = '$date' ORDER BY `generated_at` DESC LIMIT 1; ";
        $query = mysqli_query($conn, $last_draw);

        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $mainNumbers = explode(',', $row['main_numbers']);
                $powerballNumber = $row['powerball_number'];

                // Sort the main numbers array
                sort($mainNumbers);

                echo '
					<div class="withdrawal">
						<p>WhiteBalls: ';

                // Display each sorted main number separately
                foreach ($mainNumbers as $number) {
                    echo '<span class="t-red">' . trim($number) . '</span>, ';
                }

                echo '</p>
						<p>| PowerBalls: <span class="t-red">' . $powerballNumber . '</span></p>
					</div>
				';
            }
        } else {
            echo "Error in query: " . mysqli_error($conn);
        }



        // Function to alternate asterisks
        function formatAsterisks($name)
        {
            $asteriskPositions = [1, 3, 4, 6, 7, 8, 9, 10];
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

        $sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 WHERE DATE(t1.date_purchase) = '$date' AND DATE(t2.generated_at) = '$date';";

        $result_query = $conn->query($sql);

        if ($result_query->num_rows > 0) {

            // Initialize variables to keep track of the maximum matches and corresponding rows
            $maxMatches = 0;
            $maxMatchesRows = array();

            while ($row = $result_query->fetch_assoc()) {
                $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
                $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
                $numMatches = count($matchingNumbers);

                if ($matchingPowerball) {
                    $numMatches++; // Increment if Powerball matches
                }

                // Check if the current row has more matches than the current maximum
                if ($numMatches > $maxMatches) {
                    $maxMatches = $numMatches;
                    $maxMatchesRows = array($row);
                } elseif ($numMatches == $maxMatches) {
                    // If there's a tie, add the row to the array
                    $maxMatchesRows[] = $row;
                }
            }

            if (!empty($maxMatchesRows)) {


                $winnerCount = 0;

                // Display all rows with the highest number of matches
                foreach ($maxMatchesRows as $row) {
                    $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
                    $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
                    $numMatches = count($matchingNumbers);

                    if ($matchingPowerball) {
                        $numMatches++; // Increment if Powerball matches
                    }

                    $query = "SELECT winning_amount FROM user_purchases WHERE DATE(date_purchase) = '$date' ORDER BY `date_purchase` DESC";
                    $query_run = mysqli_query($conn, $query);

                    $total_winning = 0;

                    while ($num = mysqli_fetch_assoc($query_run)) {
                        $total_winning +=  $num['winning_amount'];
                    }

                    if ($numMatches >= 1 && $numMatches <= 6) {
                        $winnerCount++;
                        $columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

                        $originalUsername = $row['username'];
                        $convertedUsername = formatAsterisks($originalUsername);

                        $averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

                        // Explode, sort, and implode the selected_numbers
                        $selectedNumbers = explode(',', $row["selected_numbers"]);
                        sort($selectedNumbers);
                        $sortedNumbers = implode(', ', $selectedNumbers);

                        // Display the most matching numbers
                        $matchingNumbersString = ($matchingNumbers !== null) ? implode(', ', $matchingNumbers) : 'No Match';

                        // Explode, sort, and implode the matching numbers
                        $sortedMatchingNumbers = explode(', ', $matchingNumbersString);
                        sort($sortedMatchingNumbers);
                        $sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

                        echo '
                            <div class="withdrawal">
                                <p><img src="asset/images/ico_prize.png"></p>
                                <p>ID: ' . $convertedUsername . ' </p>
                                <p>| Selected Numbers: ' . $sortedNumbers . ' </p>
                                <p>| PowerBalls: ' . $row["powerballs"] . ' </p>
                                <p>| (' . $row["modes"] . ')</p>
                                <p>| Match Numbers: <span class="t-red">' . $sortedMatchingNumbersString . '</span> </p>
                                <p>| Match Powerballs: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                                <p>| Winning Price: ' . number_format($row["to_received"]) . ' ₩</p>
                            </div>
                        ';
                    }
                }
            } else {
                echo "No matching records found.";
            }
        } else {
            echo "No matching records found.";
        }

        ?>
    </div>

    <!-- 2nd list customer winner -->
    <div class="container1">

        <h4 style="font-weight: 500; color:red">전일당첨자수</h4><br>
        <?php
        include "./includes/connect.php";

        date_default_timezone_set('Asia/Seoul');
        $currentDate = new DateTime();
        $yesterday = $currentDate->modify('-2 day');
        $date = $yesterday->format('Y-m-d (l)');
        // $date = Date("2024-03-12");

        echo "Yesterday's Winners: $date";

        $last_draw = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 WHERE DATE(t1.date_purchase ) = '$date' AND DATE(t2.generated_at) = '$date' ORDER BY `generated_at` DESC LIMIT 1; ";
        $query = mysqli_query($conn, $last_draw);

        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $mainNumbers = explode(',', $row['main_numbers']);
                $powerballNumber = $row['powerball_number'];

                // Sort the main numbers array
                sort($mainNumbers);

                echo '
					<div class="withdrawal">
						<p>WhiteBalls: ';

                // Display each sorted main number separately
                foreach ($mainNumbers as $number) {
                    echo '<span class="t-red">' . trim($number) . '</span>, ';
                }

                echo '</p>
						<p>| PowerBalls: <span class="t-red">' . $powerballNumber . '</span></p>
					</div>
				';
            }
        } else {
            echo "Error in query: " . mysqli_error($conn);
        }




        $sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 WHERE DATE(t1.date_purchase) = '$date' AND DATE(t2.generated_at) = '$date';";

        $result_query = $conn->query($sql);

        if ($result_query->num_rows > 0) {

            // Initialize variables to keep track of the maximum matches and corresponding rows
            $maxMatches = 0;
            $maxMatchesRows = array();

            while ($row = $result_query->fetch_assoc()) {
                $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
                $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
                $numMatches = count($matchingNumbers);

                if ($matchingPowerball) {
                    $numMatches++; // Increment if Powerball matches
                }

                // Check if the current row has more matches than the current maximum
                if ($numMatches > $maxMatches) {
                    $maxMatches = $numMatches;
                    $maxMatchesRows = array($row);
                } elseif ($numMatches == $maxMatches) {
                    // If there's a tie, add the row to the array
                    $maxMatchesRows[] = $row;
                }
            }

            if (!empty($maxMatchesRows)) {


                $winnerCount = 0;

                // Display all rows with the highest number of matches
                foreach ($maxMatchesRows as $row) {
                    $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
                    $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
                    $numMatches = count($matchingNumbers);

                    if ($matchingPowerball) {
                        $numMatches++; // Increment if Powerball matches
                    }

                    $query = "SELECT winning_amount FROM user_purchases WHERE DATE(date_purchase) = '$date' ORDER BY `date_purchase` DESC";
                    $query_run = mysqli_query($conn, $query);

                    $total_winning = 0;

                    while ($num = mysqli_fetch_assoc($query_run)) {
                        $total_winning +=  $num['winning_amount'];
                    }

                    if ($numMatches >= 1 && $numMatches <= 6) {
                        $winnerCount++;
                        $columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

                        $originalUsername = $row['username'];
                        $convertedUsername = formatAsterisks($originalUsername);

                        $averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

                        // Explode, sort, and implode the selected_numbers
                        $selectedNumbers = explode(',', $row["selected_numbers"]);
                        sort($selectedNumbers);
                        $sortedNumbers = implode(', ', $selectedNumbers);

                        // Display the most matching numbers
                        $matchingNumbersString = ($matchingNumbers !== null) ? implode(', ', $matchingNumbers) : 'No Match';

                        // Explode, sort, and implode the matching numbers
                        $sortedMatchingNumbers = explode(', ', $matchingNumbersString);
                        sort($sortedMatchingNumbers);
                        $sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

                        echo '
                            <div class="withdrawal">
                                <p><img src="asset/images/ico_prize.png"></p>
                                <p>ID: ' . $convertedUsername . ' </p>
                                <p>| Selected Numbers: ' . $sortedNumbers . ' </p>
                                <p>| PowerBalls: ' . $row["powerballs"] . ' </p>
                                <p>| (' . $row["modes"] . ')</p>
                                <p>| Match Numbers: <span class="t-red">' . $sortedMatchingNumbersString . '</span> </p>
                                <p>| Match Powerballs: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                                <p>| Winning Price: ' . number_format($row["to_received"]) . ' ₩</p>
                            </div>
                        ';
                    }
                }
            } else {
                echo "No matching records found.";
            }
        } else {
            echo "No matching records found.";
        }

        ?>
    </div>

    <!-- 3rd list customer winner -->
    <div class="container1">

        <h4 style="font-weight: 500; color:red">전일당첨자수</h4><br>
        <?php
        include "./includes/connect.php";

        date_default_timezone_set('Asia/Seoul');
        $currentDate = new DateTime();
        $yesterday = $currentDate->modify('-3 day');
        $date = $yesterday->format('Y-m-d (l)');
        // $date = Date("2024-03-12");

        echo "Yesterday's Winners: $date";

        $last_draw = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 WHERE DATE(t1.date_purchase ) = '$date' AND DATE(t2.generated_at) = '$date' ORDER BY `generated_at` DESC LIMIT 1; ";
        $query = mysqli_query($conn, $last_draw);

        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $mainNumbers = explode(',', $row['main_numbers']);
                $powerballNumber = $row['powerball_number'];

                // Sort the main numbers array
                sort($mainNumbers);

                echo '
					<div class="withdrawal">
						<p>WhiteBalls: ';

                // Display each sorted main number separately
                foreach ($mainNumbers as $number) {
                    echo '<span class="t-red">' . trim($number) . '</span>, ';
                }

                echo '</p>
						<p>| PowerBalls: <span class="t-red">' . $powerballNumber . '</span></p>
					</div>
				';
            }
        } else {
            echo "Error in query: " . mysqli_error($conn);
        }




        $sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 WHERE DATE(t1.date_purchase) = '$date' AND DATE(t2.generated_at) = '$date';";

        $result_query = $conn->query($sql);

        if ($result_query->num_rows > 0) {

            // Initialize variables to keep track of the maximum matches and corresponding rows
            $maxMatches = 0;
            $maxMatchesRows = array();

            while ($row = $result_query->fetch_assoc()) {
                $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
                $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
                $numMatches = count($matchingNumbers);

                if ($matchingPowerball) {
                    $numMatches++; // Increment if Powerball matches
                }

                // Check if the current row has more matches than the current maximum
                if ($numMatches > $maxMatches) {
                    $maxMatches = $numMatches;
                    $maxMatchesRows = array($row);
                } elseif ($numMatches == $maxMatches) {
                    // If there's a tie, add the row to the array
                    $maxMatchesRows[] = $row;
                }
            }

            if (!empty($maxMatchesRows)) {


                $winnerCount = 0;

                // Display all rows with the highest number of matches
                foreach ($maxMatchesRows as $row) {
                    $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
                    $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
                    $numMatches = count($matchingNumbers);

                    if ($matchingPowerball) {
                        $numMatches++; // Increment if Powerball matches
                    }

                    $query = "SELECT winning_amount FROM user_purchases WHERE DATE(date_purchase) = '$date' ORDER BY `date_purchase` DESC";
                    $query_run = mysqli_query($conn, $query);

                    $total_winning = 0;

                    while ($num = mysqli_fetch_assoc($query_run)) {
                        $total_winning +=  $num['winning_amount'];
                    }

                    if ($numMatches >= 1 && $numMatches <= 6) {
                        $winnerCount++;
                        $columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

                        $originalUsername = $row['username'];
                        $convertedUsername = formatAsterisks($originalUsername);

                        $averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

                        // Explode, sort, and implode the selected_numbers
                        $selectedNumbers = explode(',', $row["selected_numbers"]);
                        sort($selectedNumbers);
                        $sortedNumbers = implode(', ', $selectedNumbers);

                        // Display the most matching numbers
                        $matchingNumbersString = ($matchingNumbers !== null) ? implode(', ', $matchingNumbers) : 'No Match';

                        // Explode, sort, and implode the matching numbers
                        $sortedMatchingNumbers = explode(', ', $matchingNumbersString);
                        sort($sortedMatchingNumbers);
                        $sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

                        echo '
                            <div class="withdrawal">
                                <p><img src="asset/images/ico_prize.png"></p>
                                <p>ID: ' . $convertedUsername . ' </p>
                                <p>| Selected Numbers: ' . $sortedNumbers . ' </p>
                                <p>| PowerBalls: ' . $row["powerballs"] . ' </p>
                                <p>| (' . $row["modes"] . ')</p>
                                <p>| Match Numbers: <span class="t-red">' . $sortedMatchingNumbersString . '</span> </p>
                                <p>| Match Powerballs: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                                <p>| Winning Price: ' . number_format($row["to_received"]) . ' ₩</p>
                            </div>
                        ';
                    }
                }
            } else {
                echo "No matching records found.";
            }
        } else {
            echo "No matching records found.";
        }

        ?>
    </div>


    <div class="main-bbs-w">
        <div class="main-bbs-inner">
            <div class="con">


                <div class="faq-w">
                    <div class="main-lotto-buy">

                        <div class="swiper-wrapper">
                            <?php

                            date_default_timezone_set('Asia/Seoul');
                            $currentDate = new DateTime();
                            $yesterday = $currentDate->modify('-1 day');
                            $date = $yesterday->format('Y-m-d (l)');

                            $last_draw_query = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 WHERE Date(date_purchase) = '$date' AND Date(generated_at) = '$date' ORDER BY generated_at LIMIT 1";
                            $query = mysqli_query($conn, $last_draw_query);

                            $query2 = "SELECT winning_amount FROM user_purchases WHERE DATE(date_purchase) = '$date' ORDER BY `date_purchase` DESC";
                            $query_run = mysqli_query($conn, $query2);

                            $total_winning = 0;

                            while ($num = mysqli_fetch_assoc($query_run)) {
                                $total_winning +=  $num['winning_amount'];
                            }

                            if (mysqli_num_rows($query) > 0) {

                                while ($row = mysqli_fetch_assoc($query)) {

                            ?>
                                    <div class="swiper-slide">
                                        <div class="logo">
                                            <img src="asset/images/powerTTO1.jpg" />
                                            <span>EVENT</span>
                                        </div>
                                        <div class="pay">
                                            ₩ <?php echo number_format($total_winning); ?>억
                                        </div>
                                        <div class="date">최근추첨번호<br> <?= date('Y.m.d (l)', strtotime($row['generated_at'])) ?></div>

                                        <div class="num">

                                            <a href="javascript:sign();">
                                                <em class="bg-bl">결과:</em>
                                            </a>
                                            <?= $row['main_numbers'] ?>,<span class="t-red"> <?= $row['powerball_number'] ?></span>
                                        </div>

                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <h1> no record found</h1>
                            <?php
                            }

                            ?>



                        </div>
                    </div>
                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <div class="bbs-w">
                    <ul>
                        <h4 style="font-weight: 500; color:red">Received Withdrawals</h4><br>
                    </ul>
                    <div class="main-bbs-list">
                        <!-- <a href="w_customer/win_story.php" class="btn-more"></a> -->
                        <?php
                        include "./includes/connect.php";

                        function formatAsteriskss($name)
                        {
                            $asteriskPositions = [1, 3, 4, 6, 7, 8, 9, 10];
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

                        $displayedDates = array();
                        $displayedCount = 0;

                        $sql = "SELECT * FROM users_withdrawal ORDER BY date_withdrawal DESC LIMIT 5";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $formattedName = formatAsteriskss($row['name']);

                                echo '<div class="item">
								<span class="linked">
									<img src="asset/images/ico_prize.png">
									
									| Name: ' . $formattedName . '
									
									| Winning Prize: ' . number_format($row["amount_withdrawal"]) . ' ₩
                                    | Withdrawal: ' . date('Y.m.d (D) H:i:s(A)', strtotime($row['date_withdrawal'])) . '
									
								</span>
								
							</div>';
                            }
                        }
                        ?>

                    </div>

                </div>

            </div>
        </div>
    </div>

</div>



<?php require "includes/footer.php"; ?>