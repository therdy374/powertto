<?php
$page_title = "Homepage";

require "./includes/menubar.php";
?>
<style>
    body {
        overflow-x: hidden;
        height: 100%;
    }

    .quick-prod-top {
        display: none
    }

    .container {
        padding-top: 130px
    }

    /* @media screen and (max-width:768px) {
        .container {
            padding-top: 55px
        }


    } */

    .container1 {
        max-width: 1405px;
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
        box-sizing: border-box;
    }

    .main-lotto-buy .swiper-slide {
        border-radius: 10px;
        background: #ffffff;
        padding: 13px 0px;
        min-height: 360px;
        /* margin: auto; */
        align-items: center !important;
        justify-content: center !important;
        width: 320px !important;
        /* width: 90%; */
        margin-left: auto;
        margin-top: 250px;
    }

    .main-bbs-w .main-bbs-inner .con {
        position: relative;
        display: flex;
        justify-content: center;
        padding: 50px 50px 50px 50px;
        background: radial-gradient(circle, rgba(253, 116, 84, 1) 0%, rgba(255, 101, 172, 1) 100%);
        max-width: 100%;
        width: 100%;
        min-height: 755px;
        border-radius: 10px;
    }

    .main-bbs-w .main-bbs-inner .con .faq-w {
        position: relative;
        width: 37%;
    }

    .main-lotto-buy .swiper-wrapper {
        flex-wrap: wrap;
        justify-content: center;
        /* width: 170px; */
    }

    @media screen and (max-width: 768px) {
        .container {
            padding-top: 55px
        }

        .container1 {
            padding: 10px;
        }

        .main-bbs-w .main-bbs-inner .con {
            padding: 4px;
        }

        .main-lotto-buy .swiper-slide {
            margin-left: 22px;
            margin-right: auto;
            margin-bottom: 20px;
        }
    }
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
                // Convert the date to Korean format
                $timestamp = strtotime($row['generated_at']);
                $day_of_week = date('w', $timestamp); // Get the numeric representation of the day of the week (0 for Sunday, 1 for Monday, etc.)
                $days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
                $generated_at = date('Y.m.d', $timestamp) . " (" . $days[$day_of_week] . ")";
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
                    sort($mainNumbers); // Sort the main numbers
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

    <!-- 1 list customer winner -->
    <div class="container1">
        <h4 style="font-weight: 500; color:red">당첨자 발표 인원 </h4><br>

        <?php
        include "./includes/connect.php";

        date_default_timezone_set('Asia/Seoul');
        $currentDate = new DateTime();
        $yesterday = $currentDate->modify('-1 day');
        $date = $yesterday->format('Y-m-d');

        $days = ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"];
        $dayOfWeek = $yesterday->format('w');
        $dayName = $days[$dayOfWeek];

        echo $date . " (" . $dayName . ") 추첨번호 ";

        // Query to fetch last draw data
        $last_draw = "SELECT * FROM posted_winners WHERE DATE(generated_at) = '$date';";
        $query = mysqli_query($conn, $last_draw);

        $mainNumbers = [];
        $powerballNumber = '';

        if ($query && mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            $mainNumbers = explode(',', $row['main_numbers']);
            $powerballNumber = $row['powerball_number'];
        } else {
            echo "<div style='color: red'><strong>Stand by! Winners to be Announced.</strong></div>";
        }

        // Display the main numbers and powerball number
        if (!empty($mainNumbers) && !empty($powerballNumber)) {
            sort($mainNumbers);
            echo '<div class="withdrawal">';
            echo '<p>일반볼: ';
            foreach ($mainNumbers as $number) {
                echo '<span class="t-red"><strong>' . trim($number) . '</strong></span>, ';
            }
            echo '</p>';
            echo '<p>| 파워볼: <span class="t-red"><strong>' . $powerballNumber . '</strong></span></p>';
            echo '</div><br>';
        }

        // Function to format asterisks in names
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

        // Query to fetch user purchases and generate numbers
        $sql = "SELECT * FROM posted_winners WHERE DATE(generated_at) = '$date';";
        $result_query = mysqli_query($conn, $sql);

        if (!$result_query) {
            echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
        } else {
            if (mysqli_num_rows($result_query) > 0) {
                $maxMatches = 0;
                $maxMatchesRows = [];

                while ($row = mysqli_fetch_assoc($result_query)) {
                    $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
                    $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
                    $numMatches = count($matchingNumbers);

                    if ($matchingPowerball) {
                        $numMatches++;
                    }

                    if ($numMatches > $maxMatches) {
                        $maxMatches = $numMatches;
                        $maxMatchesRows = [$row];
                    } elseif ($numMatches == $maxMatches) {
                        $maxMatchesRows[] = $row;
                    }
                }

                if (!empty($maxMatchesRows)) {
                    echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
                    
                    $winnerCount = 0;
                    $total_winning = 0;

                    foreach ($maxMatchesRows as $row) {
                        $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
                        $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
                        $numMatches = count($matchingNumbers);

                        if ($matchingPowerball) {
                            $numMatches++;
                        }

                        $query = "SELECT winning_amount FROM user_purchases WHERE DATE(date_purchase) = '$date' ORDER BY `date_purchase` DESC";
                        $query_run = mysqli_query($conn, $query);

                        while ($num = mysqli_fetch_assoc($query_run)) {
                            $total_winning += $num['winning_amount'];
                        }

                        if ($numMatches >= 1 && $numMatches <= 6) {
                            $winnerCount++;
                            $originalUsername = $row['username'];
                            $convertedUsername = formatAsterisks($originalUsername);

                            $selectedNumbers = explode(',', $row["selected_numbers"]);
                            sort($selectedNumbers);
                            $sortedNumbers = implode(', ', $selectedNumbers);

                            $matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';
                            $sortedMatchingNumbers = explode(', ', $matchingNumbersString);
                            sort($sortedMatchingNumbers);
                            $sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

                          
                            echo '<div class="withdrawal">';
                            echo '<p><img src="asset/images/ico_prize.png"></p>';
                            echo '<p>ID: ' . $convertedUsername . ' </p>';
                            echo '<p>| 선택한 번호: ' . $sortedNumbers . ' </p>';
                            echo '<p>| 파워볼: ' . $row["powerballs"] . ' </p>';
                            echo '<p>| (' . $row["modes"] . ')</p>';
                            echo '<p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>';
                            echo '<p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>';
                            echo '<p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>';
                            echo '</div><br>';
                        }
                    }
                    echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
                } else {
                    echo "<div>No matching records found after checking purchases.</div>";
                }
            } else {
                echo "<div>No winners records found.</div>";
            }
        }
        ?>

    </div>

    <!-- 2 list customer winner -->
    <div class="container1">
        <h4 style="font-weight: 500; color:red">당첨자 발표 인원 </h4><br>

        <?php
        include "./includes/connect.php";

        date_default_timezone_set('Asia/Seoul');
        $currentDate = new DateTime();
        $yesterday = $currentDate->modify('-2 day');
        $date = $yesterday->format('Y-m-d');

        $days = ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"];
        $dayOfWeek = $yesterday->format('w');
        $dayName = $days[$dayOfWeek];

        echo $date . " (" . $dayName . ") 추첨번호 ";


        // Query to fetch last draw data
        $last_draw = "SELECT * FROM posted_winners WHERE DATE(generated_at) = '$date';";
        $query = mysqli_query($conn, $last_draw);

        $mainNumbers = [];
        $powerballNumber = '';

        if ($query && mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            $mainNumbers = explode(',', $row['main_numbers']);
            $powerballNumber = $row['powerball_number'];
        } else {
            echo "<div style='color: red'><strong>Stand by! Winners to be Announced.</strong></div>";
        }

        // Display the main numbers and powerball number
        if (!empty($mainNumbers) && !empty($powerballNumber)) {
            sort($mainNumbers);
            echo '<div class="withdrawal">';
            echo '<p>일반볼: ';
            foreach ($mainNumbers as $number) {
                echo '<span class="t-red"><strong>' . trim($number) . '</strong></span>, ';
            }
            echo '</p>';
            echo '<p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>';
            echo '</div><br>';
        }

        // Query to fetch user purchases and generate numbers
        $sql = "SELECT * FROM posted_winners WHERE DATE(generated_at) = '$date';";
        $result_query = mysqli_query($conn, $sql);

        if (!$result_query) {
            echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
        } else {
            if (mysqli_num_rows($result_query) > 0) {
                $maxMatches = 0;
                $maxMatchesRows = [];

                while ($row = mysqli_fetch_assoc($result_query)) {
                    $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
                    $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
                    $numMatches = count($matchingNumbers);

                    if ($matchingPowerball) {
                        $numMatches++;
                    }

                    if ($numMatches > $maxMatches) {
                        $maxMatches = $numMatches;
                        $maxMatchesRows = [$row];
                    } elseif ($numMatches == $maxMatches) {
                        $maxMatchesRows[] = $row;
                    }
                }

                if (!empty($maxMatchesRows)) {
                    echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
                    $winnerCount = 0;
                    $total_winning = 0;

                    foreach ($maxMatchesRows as $row) {
                        $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
                        $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
                        $numMatches = count($matchingNumbers);

                        if ($matchingPowerball) {
                            $numMatches++;
                        }

                        $query = "SELECT winning_amount FROM user_purchases WHERE DATE(date_purchase) = '$date' ORDER BY `date_purchase` DESC";
                        $query_run = mysqli_query($conn, $query);

                        while ($num = mysqli_fetch_assoc($query_run)) {
                            $total_winning += $num['winning_amount'];
                        }

                        if ($numMatches >= 1 && $numMatches <= 6) {
                            $winnerCount++;
                            $originalUsername = $row['username'];
                            $convertedUsername = formatAsterisks($originalUsername);

                            $selectedNumbers = explode(',', $row["selected_numbers"]);
                            sort($selectedNumbers);
                            $sortedNumbers = implode(', ', $selectedNumbers);

                            $matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';
                            $sortedMatchingNumbers = explode(', ', $matchingNumbersString);
                            sort($sortedMatchingNumbers);
                            $sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

                        
                            echo '<div class="withdrawal">';
                            echo '<p><img src="asset/images/ico_prize.png"></p>';
                            echo '<p>ID: ' . $convertedUsername . ' </p>';
                            echo '<p>| 선택한 번호: ' . $sortedNumbers . ' </p>';
                            echo '<p>| 파워볼: ' . $row["powerballs"] . ' </p>';
                            echo '<p>| (' . $row["modes"] . ')</p>';
                            echo '<p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>';
                            echo '<p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>';
                            echo '<p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>';
                            echo '</div><br>';
                        }
                    }
                    echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
                } else {
                    echo "<div>No matching records found after checking purchases.</div>";
                }
            } else {
                echo "<div>No winners records found.</div>";
            }
        }
        ?>

    </div>

    <!-- 3 list customer winner -->
    <div class="container1">
        <h4 style="font-weight: 500; color:red">당첨자 발표 인원 </h4><br>

        <?php
        include "./includes/connect.php";

        date_default_timezone_set('Asia/Seoul');
        $currentDate = new DateTime();
        $yesterday = $currentDate->modify('-3 day');
        $date = $yesterday->format('Y-m-d');

        $days = ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"];
        $dayOfWeek = $yesterday->format('w');
        $dayName = $days[$dayOfWeek];

        echo $date . " (" . $dayName . ") 추첨번호 ";


        // Query to fetch last draw data
        $last_draw = "SELECT * FROM posted_winners WHERE DATE(generated_at) = '$date';";
        $query = mysqli_query($conn, $last_draw);

        $mainNumbers = [];
        $powerballNumber = '';

        if ($query && mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            $mainNumbers = explode(',', $row['main_numbers']);
            $powerballNumber = $row['powerball_number'];
        } else {
            echo "<div style='color: red'><strong>Stand by! Winners to be Announced.</strong></div>";
        }

        // Display the main numbers and powerball number
        if (!empty($mainNumbers) && !empty($powerballNumber)) {
            sort($mainNumbers);
            echo '<div class="withdrawal">';
            echo '<p>일반볼: ';
            foreach ($mainNumbers as $number) {
                echo '<span class="t-red"><strong>' . trim($number) . '</strong></span>, ';
            }
            echo '</p>';
            echo '<p>| 파워볼: <span class="t-red"><strong>' . $powerballNumber . '</strong></span></p>';
            echo '</div><br>';
        }

        // Query to fetch user posted_winners
        $sql = "SELECT * FROM posted_winners WHERE DATE(generated_at) = '$date';";
        $result_query = mysqli_query($conn, $sql);

        if (!$result_query) {
            echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
        } else {
            if (mysqli_num_rows($result_query) > 0) {
                $maxMatches = 0;
                $maxMatchesRows = [];

                while ($row = mysqli_fetch_assoc($result_query)) {
                    $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
                    $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
                    $numMatches = count($matchingNumbers);

                    if ($matchingPowerball) {
                        $numMatches++;
                    }

                    if ($numMatches > $maxMatches) {
                        $maxMatches = $numMatches;
                        $maxMatchesRows = [$row];
                    } elseif ($numMatches == $maxMatches) {
                        $maxMatchesRows[] = $row;
                    }
                }

                if (!empty($maxMatchesRows)) {
                    echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
                    $winnerCount = 0;
                    $total_winning = 0;

                    foreach ($maxMatchesRows as $row) {
                        $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
                        $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
                        $numMatches = count($matchingNumbers);

                        if ($matchingPowerball) {
                            $numMatches++;
                        }

                        $query = "SELECT winning_amount FROM user_purchases WHERE DATE(date_purchase) = '$date' ORDER BY `date_purchase` DESC";
                        $query_run = mysqli_query($conn, $query);

                        while ($num = mysqli_fetch_assoc($query_run)) {
                            $total_winning += $num['winning_amount'];
                        }

                        if ($numMatches >= 1 && $numMatches <= 6) {
                            $winnerCount++;
                            $originalUsername = $row['username'];
                            $convertedUsername = formatAsterisks($originalUsername);

                            $selectedNumbers = explode(',', $row["selected_numbers"]);
                            sort($selectedNumbers);
                            $sortedNumbers = implode(', ', $selectedNumbers);

                            $matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';
                            $sortedMatchingNumbers = explode(', ', $matchingNumbersString);
                            sort($sortedMatchingNumbers);
                            $sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);


                            echo '<div class="withdrawal">';
                            echo '<p><img src="asset/images/ico_prize.png"></p>';
                            echo '<p>ID: ' . $convertedUsername . ' </p>';
                            echo '<p>| 선택한 번호: ' . $sortedNumbers . ' </p>';
                            echo '<p>| 파워볼: ' . $row["powerballs"] . ' </p>';
                            echo '<p>| (' . $row["modes"] . ')</p>';
                            echo '<p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>';
                            echo '<p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>';
                            echo '<p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>';
                            echo '</div><br>';
                        }
                    }
                    echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4>';
                } else {
                    echo "<div>No matching records found after checking purchases.</div>";
                }
            } else {
                echo "<div>No winners records found.</div>";
            }
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
                                            <!-- <span>EVENT</span> -->
                                        </div>
                                        <div class="pay">
                                            ₩ <?php echo number_format($total_winning); ?>
                                        </div>
                                        <div class="date">최근추첨번호<br> <?php echo $generated_at; ?></div>

                                        <div class="num">

                                            <a href="javascript:sign();">
                                                <em class="bg-bl">결과:</em>
                                            </a>
                                            <?= $row['main_numbers'] ?>,<span class="t-red"> <?= $row['powerball_number'] ?></span>
                                        </div>
                                        <div class="num t-red"><span id="countdown2">1일 13시간 30분 6초</span>
                                            <!-- JavaScript code for countdown -->
                                            <script type="text/javascript">
                                                function getTime2() {

                                                    const now = new Date(new Date().toLocaleString("en-US", {
                                                        timeZone: "Asia/Seoul"
                                                    }));

                                                    const k_year = now.getFullYear();
                                                    const k_month = now.getMonth();
                                                    const k_day = now.getDate();
                                                    const k_hour = 22;
                                                    const k_min = 0;

                                                    let dday = new Date(k_year, k_month, k_day, k_hour, k_min, 0);

                                                    if (now > dday) {
                                                        dday.setDate(dday.getDate() + 1);
                                                    }

                                                    const remainingTime = dday - now;
                                                    const days = Math.floor(remainingTime / (1000 * 60 * 60 * 22));
                                                    const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 22)) / (1000 * 60 * 60));
                                                    const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                                                    const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

                                                    document.getElementById("countdown2").innerHTML = days + "일 " + hours + "시간 " + minutes + "분 " + seconds + "초";


                                                    setTimeout(getTime2, 1000);
                                                }
                                                getTime2();
                                            </script>
                                        </div>
                                        <div class="btn">
                                            <a href="lotto_pb.php" class="btn-comm btn-pk">구매하기</a>
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
                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <div class="bbs-w">

                    <ul>
                        <h4 style="font-weight: 500; color:red">당첨출금내역</h4><br>
                    </ul>

                    <div class="main-bbs-list">
                        <?php

                        $days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");

                        $sql = "SELECT * FROM `users_withdrawal` ORDER BY date_withdrawal DESC LIMIT 30";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['status'] == '취소') {
                                continue; // Skip this iteration if status is '취소'
                            }

                            $formattedName = formatAsterisks($row['userid']);
                            $timestamp = strtotime($row['date_withdrawal']);
                            $date_withdrawal = new DateTime();
                            $date_withdrawal->setTimestamp($timestamp);
                            $day_of_week = $days[date('w', $timestamp)]; // Convert day of the week to Korean

                            // Correct the time format to use the DateTime object correctly
                            $formattedDate = $date_withdrawal->format('Y.m.d');
                            $formattedTime = $date_withdrawal->format('h:i(A)'); // 24-hour format for hours
                        ?>
                            <div class="item">
                                <span class="linked">
                                    <img src="asset/images/ico_prize.png">
                                    | ID: <?php echo $formattedName; ?>
                                    | 출금금액: <?php echo number_format($row["amount_withdrawal"]); ?> ₩
                                    | 출금일시: <?php echo "{$formattedDate} ({$day_of_week}) {$formattedTime}"; ?>
                                </span>
                            </div>
                        <?php
                        }
                        ?>
                    </div>


                    <style>
                        /* for animation */
                        .main-bbs-w .main-bbs-inner {
                            position: absolute;
                            top: 10px;
                            display: flex;
                            justify-content: center;
                            width: 100%;
                        }

                        .bbs-w {
                            width: 50%;
                            /* Adjust the width as needed */
                            margin: 0 auto;
                            border: 0px solid #ccc;
                            /* Add border */
                            padding: 10px;
                        }

                        .main-bbs-w {
                            background: #eaecee;
                            height: 900px;
                            position: relative;
                            margin-bottom: 120px;
                        }


                        .main-bbs-list {
                            height: 800px;
                            overflow: hidden;
                            position: relative;
                            border: 0px solid #eee;
                            /* Add border */
                            border-radius: 5px;
                            /* Add border radius */
                        }

                        .item {
                            animation: moveUp 30s linear infinite;
                            /* Adjust animation duration here */
                            padding: 10px;
                            box-sizing: border-box;
                        }

                        .item span {
                            font-size: 20px;
                            /* Adjust font size for smaller screens */
                        }

                        @keyframes moveUp {
                            0% {
                                transform: translateY(0);
                            }

                            100% {
                                transform: translateY(calc(-100% * <?php echo mysqli_num_rows($result); ?>));
                            }
                        }

                        /* Styles for mobile */
                        @media only screen and (max-width: 768px) {
                            .bbs-w {
                                width: 100%;
                            }

                            .item span {
                                font-size: 13px;
                                /* Adjust font size for smaller screens */
                            }

                            .main-bbs-w {
                                background: #eaecee;
                                height: 900px;
                                position: relative;
                                margin-bottom: 120px;
                            }


                            .main-bbs-list {
                                height: 800px;
                                overflow: hidden;
                                position: relative;
                                border: 0px solid #eee;
                                /* Add border */
                                border-radius: 5px;
                                /* Add border radius */
                            }

                            footer .warning {
                                padding: 15px;
                                margin-top: 400px;
                            }

                            .main-lotto-buy .swiper-slide {
                                margin-left: 22px;
                                margin-right: auto;
                                margin-bottom: 20px;
                                margin-top: 10px;
                            }


                        }
                    </style>

                </div>

            </div>
        </div>
    </div>

    <script>
        function checkSessionId() {
            fetch('check_login.php')
                .then(response => response.json())
                .then(responseData => {
                    if (responseData.output === 'logout') {
                        alert("You are logged in from a different location!");
                        window.location.href = "logout.php";
                    }
                })
                .catch(error => {
                    console.error('Error checking session:', error);
                });
        }
        setInterval(checkSessionId, 5000); // Changed interval to 5 seconds
    </script>

</div>




<?php require "includes/footer.php"; ?>