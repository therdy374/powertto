<?php
$page_title = "Buy PowerBall";

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

            <div class="table-lisw-w table-line-type lotto-buy-head">
                <div class="item th-head">
                    <div class="w80p">추첨일</div>
                    <!-- <div class="pwauto play-prize-th">당첨금</div> -->
                    <div class="w80p">
                        주문마감
                    </div>
                </div>

                <div class="tbody">
                    <div class="item">
                        <div class="w80p f-wrap">
                            <div class="w100p t-bl">
                                <?php
                                date_default_timezone_set('Asia/Seoul');
                                $date = date('Y-m-d (l)');
                                $days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
                                $english_days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
                                $korean_date = str_replace($english_days, $days, $date);

                                echo $korean_date;
                                ?>

                            </div>
                            <div class="w100p t-pk"> <br class="mo-view"> 24:00 (한국시간)</div>
                            <div class="w100p t-pk"><span id="countdown">1일 13시간 30분 6초</span>
                                <!-- JavaScript code for countdown -->
                                <script type="text/javascript">
                                    function getTime() {

                                        const now = new Date(new Date().toLocaleString("en-US", {
                                            timeZone: "Asia/Seoul"
                                        }));

                                        const k_year = now.getFullYear();
                                        const k_month = now.getMonth();
                                        const k_day = now.getDate();
                                        const k_hour = 24;
                                        const k_min = 0;

                                        let dday = new Date(k_year, k_month, k_day, k_hour, k_min, 0);

                                        if (now > dday) {
                                            dday.setDate(dday.getDate() + 1);
                                        }

                                        const remainingTime = dday - now;
                                        const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
                                        const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                                        const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

                                        document.getElementById("countdown").innerHTML = days + "일 " + hours + "시간 " + minutes + "분 " + seconds + "초";


                                        setTimeout(getTime, 1000);
                                    }
                                    getTime();
                                </script>
                            </div>

                        </div>
                        <!-- <div class="pwauto f-wrap play-prize-td">
                            <div class="w100p t-w">₩ 10,554억원</div>
                            <div class="w100p t-pk">KOR $ 810,000,000</div>
                        </div> -->
                        <div class="w80p f-wrap">
                            <div class="w100p t-bl">
                                <?php
                                echo $korean_date;
                                ?> <br class="mo-view">
                            </div>
                            <div class="w100p t-bl">12:00 ~ <br class="mo-view">22:00 (한국시간)</div>
                            <div class="w100p t-pk"><span id="countdown2">1일 13시간 30분 6초</span>
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


                        </div>
                    </div>
                </div>
            </div>

            <h3 class="tit-lotto-buy"><img src="asset/images/newPtto.jpg" alt="파워볼"></h3>

            <!--betting -->
            <iframe src="number_list.php" width="100%" height="1550vh" frameborder="0">

            </iframe>


        </div>
    </div>
</section><br>

<?php require "includes/footer.php"; ?>