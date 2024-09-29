<?php
require "./config/function.php";
require 'authentication.php';

?>
<html lang="ko">

<head>
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="user-scalable=yes, initial-scale=1.0, width=device-width">
    <meta name="description" content="">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="로또캠프-해외로또 구매대행">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <!-- <meta property="og:url" content="http://lottocamp3.com"> -->
    <meta property="og:image" content="http://lottocamp3.com/ver_02/images/header/logo_header.png">
    <meta name="keywords" content="미국로또, 메가밀리언, 파워볼, 캐시포라이프, 유로잭팟, 유로밀리언 공식복권 신뢰도1위 해외로또 구매대행">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="asset/css/common.css?v=2023-12-27 17:16:14">
    <link rel="stylesheet" type="text/css" href="asset/css/layout.css?v=2023-12-27 17:16:14">
    <link rel="stylesheet" type="text/css" href="asset/css/main.css?v=20211218">
    <link rel="stylesheet" type="text/css" href="asset/css/sidemenu.css?v=20200218">
    <link rel="stylesheet" type="text/css" href="asset/css/swiper.min.css">
    <link rel="shortcut icon" href="asset/images/ico.ico" type="image/x-icon">
    <script src="asset/js/jquery.min.js"></script>
    <script src="asset/js/common.js"></script>
    <script src="asset/js/jquery.hoverIntent.js"></script>
    <script src="asset/js/swiper.min.js"></script>
    <script src="asset/js/sidemenu.js"></script>
    <script src="asset/js/jquery.stickyNavbar.min.js"></script>
</head>
<style>
    body {
        overflow: hidden;
        height: 100vh;
    }

    @media screen and (max-width: 768px) {
        .btn-comm {
            font-size: 13px;
            height: 45px;
            width: 100%;
            margin: auto;
        }

    }

    .dot-item {
        font-family: Verdana, sans-serif;
        padding: 10px;
    }

    .dot-item p {
        margin: 10px 0;
        line-height: 1.4;
    }

    /* Media query for screens smaller than 600px (typical mobile devices) */
    @media (max-width: 768px) {
        .dot-item {
            padding: 5px;
        }

        .dot-item p {
            font-size: 15px;
            /* height: 100vh; */
        }
    }
</style>

<body>

    <?php alertMessage(); ?>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="user_name" value="<?= $_SESSION['loggedInUser']['name']; ?>">
        <input type="hidden" name="name" value="<?= $_SESSION['loggedInUser']['userid']; ?>">
        <input type="hidden" name="user_id" value="<?= $_SESSION['loggedInUser']['user_id']; ?>">
        <input type="hidden" name="payment" value="50000">
        <input type="hidden" name="winning_amount" value="35000" />
        <input type="hidden" name="selected_numbers" id="selectedNumbersInput" maxlength="5">
        <input type="hidden" name="selected_single_number" id="selectedSingleNumberInput" />

        <input type="hidden" name="referal_code" value="<?= $_SESSION['loggedInUser']['referal_code']; ?>">
        <input type="hidden" name="affiliated_agent_code" value="<?= $_SESSION['loggedInUser']['affiliated_agent_code']; ?>">

        <div class="lotto-buy-w">

            <div class="number-select-w">
                <!-- Manual -->
                <?php
                include "automatic_manual.php";

                if (isset($_POST["manual"])) : ?>
                    <h3 class="tit-h3">5 개의 일반볼 번호를 선택하세요.</h3>
                    <div class="number-select">
                        <?php for ($i = 1; $i <= 28; $i++) : ?>
                            <button type="button" class="number-button" data-number="<?php echo $i; ?>"><?php echo $i; ?></button>
                        <?php endfor; ?>
                    </div>
                    <br>
                    <h3 class="tit-h3 mt30">1 개의 파워볼 번호를 선택하세요.</h3>
                    <div class="number-select num-power">
                        <?php for ($i = 0; $i <= 9; $i++) : ?>
                            <button type="button" class="single-number-button" data-number="<?php echo $i; ?>"><?php echo $i; ?></button>
                        <?php endfor; ?>
                        <br>
                    </div>

                    <!-- automatic -->
                <?php

                elseif (isset($_POST["automatic"])) :

                    $randomNumbers = generateRandomNumbers(5);
                    $randomNumbers1 = generateRandomNumber1(1);

                ?>
                    <h3 class="tit-h3">5 개의 일반볼 번호를 선택하세요.</h3>
                    <div class="number-select">
                        <?php for ($i = 1; $i <= 28; $i++) : ?>
                            <button type="button" class="number-button1" data-number="<?php echo $i; ?>"><?php echo $i; ?></button>
                        <?php endfor; ?>
                    </div>
                    <br>
                    <h3 class="tit-h3 mt30">1 개의 파워볼 번호를 선택하세요.</h3>
                    <div class="number-select num-power">
                        <?php for ($i = 0; $i <= 9; $i++) : ?>
                            <button type="button" class="single-number-button1" data-number="<?php echo $i; ?>"><?php echo $i; ?></button>
                        <?php endfor; ?>
                        <br>
                    </div>
                    <input type="hidden" name="gen1" value="<?php echo ($randomNumbers[0]); ?>">
                    <input type="hidden" name="gen2" value="<?php echo ($randomNumbers[1]); ?>">
                    <input type="hidden" name="gen3" value="<?php echo ($randomNumbers[2]); ?>">
                    <input type="hidden" name="gen4" value="<?php echo ($randomNumbers[3]); ?>">
                    <input type="hidden" name="gen5" value="<?php echo ($randomNumbers[4]); ?>">
                    <input type="hidden" name="power" value="<?php echo implode(",", $randomNumbers1); ?>">

                <?php else : ?>
                    <h3 class="tit-h3">5 개의 일반볼 번호를 선택하세요.</h3>
                    <div class="number-select">
                        <?php for ($i = 1; $i <= 28; $i++) : ?>
                            <button type="button" class="number-button" data-number="<?php echo $i; ?>"><?php echo $i; ?></button>
                        <?php endfor; ?>
                    </div>
                    <br>
                    <h3 class="tit-h3 mt30">1 개의 파워볼 번호를 선택하세요.</h3>
                    <div class="number-select num-power">
                        <?php for ($i = 0; $i <= 9; $i++) : ?>
                            <button type="button" class="single-number-button" data-number="<?php echo $i; ?>"><?php echo $i; ?></button>
                        <?php endfor; ?>
                        <br>
                    </div>
                <?php endif; ?>
            </div>


            <div class="number-selected-w">
                <?php
                if (isset($_POST["manual"])) : ?>
                    <h3 class="tit-h3 p-l">선택한 번호</h3>
                    <div class="message-box-gy">
                        <div class="general-num" id="selected_numbers">
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <span class="selected-number" name="selected_numbers" data-index="<?= $i - 1 ?>" required></span>
                            <?php endfor; ?>
                        </div>
                        <span class="selected-single-number bg-pk" name="selectedSingleNumberSpan" id="selectedSingleNumberSpan"></span>
                    </div>

                    <div class="btn-number">
                        <button type="submit" name="automatic" class="btn-comm-mid btn-gy">자동</button>
                        <button type="submit" name="manual" class="btn-comm-mid btn-gy">수동</button>
                    </div>

                <?php elseif (isset($_POST["automatic"])) : ?>
                    <h3 class="tit-h3 p-l">선택한 번호</h3>
                    <div class="message-box-gy">
                        <div class="general-num" id="selected_numbers">
                            <span><?php echo ($randomNumbers[0]); ?></span>
                            <span><?php echo ($randomNumbers[1]); ?></span>
                            <span><?php echo ($randomNumbers[2]); ?></span>
                            <span><?php echo ($randomNumbers[3]); ?></span>
                            <span><?php echo ($randomNumbers[4]); ?></span>
                        </div>
                        <span id="powerball_view" name="powerball_view" class="bg-pk"><?php echo implode(",", $randomNumbers1); ?></span>
                    </div>

                    <div class="btn-number">
                        <button type="submit" name="automatic" class="btn-comm-mid btn-gy">자동</button>
                        <button type="submit" name="manual" class="btn-comm-mid btn-gy">수동</button>
                    </div>

                <?php else : ?>
                    <h3 class="tit-h3 p-l">선택한 번호</h3>
                    <div class="message-box-gy">
                        <div class="general-num" id="selected_numbers">
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <span class="selected-number" name="selected_numbers" data-index="<?= $i - 1 ?>" required></span>
                            <?php endfor; ?>
                        </div>
                        <span class="selected-single-number bg-pk" name="selectedSingleNumberSpan" id="selectedSingleNumberSpan"></span>
                    </div>

                    <div class="btn-number">
                        <button type="submit" name="automatic" class="btn-comm-mid btn-gy">자동</button>
                        <button type="submit" name="manual" class="btn-comm-mid btn-gy">수동</button>
                    </div>
                    <div class="btn-cart">
                        <button type="submit" name="manual_submit" class="btn-comm btn-dpk"><img src="asset/images/ico_in_cart.png" alt="icon" class="mr5">선택된 번호 구매하기</button>
                    </div>
                <?php endif; ?>

                <?php if (isset($_POST["manual"])) : ?>
                    <div class="btn-cart">
                        <button type="submit" name="manual_submit" class="btn-comm btn-dpk"><img src="asset/images/ico_in_cart.png" alt="icon" class="mr5">선택된 번호 구매하기</button>
                    </div>

                <?php elseif (isset($_POST["automatic"])) : ?>
                    <div class="btn-cart">
                        <button type="submit" name="automatic_submit" class="btn-comm btn-dpk"><img src="asset/images/ico_in_cart.png" alt="icon" class="mr5">선택된 번호 구매하기</button>
                    </div>
                <?php endif; ?>

            </div>

        </div>
    </form>
    
    <?php
    $sql = "SELECT * FROM terms_condition";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $content = $row['content'];
    }
    ?>
    <h3 class="tit-h3 mt50">파워또 구매관련 안내</h3>
    <div class="message-box-gy ">
        <div class="dot-item"><?php echo $content ?></div>
    </div>

    <script>
        // JavaScript code to handle number button clicks and update selected numbers
        const numberButtons = document.querySelectorAll('.number-button');
        const singleNumberButtons = document.querySelectorAll('.single-number-button');
        const selectedNumbersSpans = document.querySelectorAll('.selected-number');
        const selectedSingleNumberSpan = document.getElementById('selectedSingleNumberSpan');

        let selectedNumbers = [];
        let selectedSingleNumber = '';

        numberButtons.forEach(button => {
            button.addEventListener('click', () => {
                const selectedNumber = button.getAttribute('data-number');

                if (selectedNumbers.includes(selectedNumber)) {
                    selectedNumbers = selectedNumbers.filter(number => number !== selectedNumber);
                    button.style.backgroundColor = '';
                } else if (selectedNumbers.length < 5) {
                    selectedNumbers.push(selectedNumber);
                    button.style.backgroundColor = 'lightblue';
                } else {
                    alert("일반볼 숫자는 5개만 선택할 수 있습니다..");
                }

                updateSelectedNumbers();
            });
        });

        singleNumberButtons.forEach(button => {
            button.addEventListener('click', () => {
                const selectedNumber = button.getAttribute('data-number');

                if (selectedSingleNumber === selectedNumber) {
                    selectedSingleNumber = '';
                    button.style.backgroundColor = '';
                } else {
                    selectedSingleNumber = selectedNumber;
                    singleNumberButtons.forEach(btn => {
                        btn.style.backgroundColor = '';
                    });
                    button.style.backgroundColor = '#ff8aa6';
                }

                updateSelectedSingleNumber();
            });
        });

        function updateSelectedNumbers() {
            selectedNumbersSpans.forEach((span, index) => {
                span.textContent = selectedNumbers[index] || '';
            });
            document.getElementById('selectedNumbersInput').value = selectedNumbers.join(',');

        }

        function updateSelectedSingleNumber() {
            selectedSingleNumberSpan.textContent = selectedSingleNumber;

            document.getElementById('selectedSingleNumberInput').value = selectedSingleNumber;
        }
    </script>

    <script>
        function highlightSelectedNumbers(numbers) {
            numbers.forEach(function(num) {
                var button = document.querySelector('.number-button1[data-number="' + num + '"]');
                if (button) {
                    button.classList.add('selected');
                    button.style.backgroundColor = 'lightblue';
                }
            });
        }

        function highlightSelectedSingleNumber(num) {
            var button = document.querySelector('.single-number-button1[data-number="' + num + '"]');
            if (button) {
                button.classList.add('selected');
                button.style.backgroundColor = '#ff8aa6';
            }
        }

        // Add these lines after generating random numbers
        highlightSelectedNumbers(<?php echo json_encode($randomNumbers); ?>);
        highlightSelectedSingleNumber(<?php echo json_encode($randomNumbers1[0]); ?>);
    </script>
</body>

</html>