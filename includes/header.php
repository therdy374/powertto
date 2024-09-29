<?php
require 'config/function.php';
// require '/authentication.php';

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <title><?php if (isset($page_title)) {
                echo "$page_title";
            } ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta meta="" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1" />
    <meta name="description" content="미국로또 파워볼주문 파워플레이옵션 QP주문 로또캠프" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="로또캠프-해외로또 구매대행" />
    <meta property="og:title" content="파워볼 구매하기 " />
    <meta property="og:description" content="미국로또 파워볼주문 파워플레이옵션 QP주문 로또캠프" />
    <!-- <meta property="og:url" content="http://lottocamp3.com" />
    <meta property="og:image" content="http://lottocamp3.com/ver_02/images/header/logo_header.png" /> -->
    <meta name="keywords" content="미국로또, 메가밀리언, 파워볼, 캐시포라이프, 유로잭팟, 유로밀리언 공식복권 신뢰도1위 해외로또 구매대행" />

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="asset/css/common.css?v=2023-12-04 13:08:06" />
    <link rel="stylesheet" type="text/css" href="asset/css/layout.css?v=2023-12-04 13:08:06" />
    <link rel="stylesheet" type="text/css" href="asset/css/main.css?v=2023-12-04 13:08:06" />
    <link rel="stylesheet" type="text/css" href="asset/css/jquery-ui.min.css?v=2023-12-04 13:08:06" />
    <link rel="stylesheet" type="text/css" href="asset/css/sidemenu.css?v=20200218" />
    <link rel="stylesheet" type="text/css" href="asset/css/swiper.min.css" />
    <link rel="shortcut icon" href="asset/images/newcopy.jpg" type="image/x-icon" />

    <!-- Add the Odometer.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js" integrity="sha512-51WDTV7haD9BBDc8RWH2r5TnuSiRyAqEnbGyuKHYn+qpYCrCckxFeqlr1I5UoOULijyLV2vnHO9LS4MrAzHxwQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Add the Odometer.js minimal theme -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/themes/odometer-theme-minimal.min.css" integrity="sha512-xrkXFZ23kz8LEz0A+4xg9jIeawVCZPjsVoXcJhEKlWMmY3Sf2G4dRV0x8X1SaNVRBP35WaaYIDTs8ziFj0wsTg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- preventBack on the page -->
    <script type="text/javascript">
        function preventBack() {
            window.history.forward()
        };
        setTimeout("preventBack()", 0);
        window.onunload = function() {}
    </script>

    <script src="asset/js/jquery.min.js"></script>
    <script src="asset/js/jquery-ui.min.js"></script>
    <script src="asset/js/common.js?v=2023-12-04 13:08:06"></script>
    <script src="asset/js/jquery.hoverIntent.js"></script>
    <script src="asset/js/swiper.min.js"></script>
    <script src="asset/js/sidemenu.js"></script>
    <script src="asset/js/jquery.stickyNavbar.min.js"></script>


    <link type="text/css" rel="stylesheet" charset="UTF-8" href="https://www.gstatic.com/_/translate_http/_/ss/k=translate_http.tr.qhDXWpKopYk.L.W.O/am=CAM/d=0/rs=AN8SPfqeKn8wA30q4viup18yaci8udUjKQ/m=el_main_css" />
</head>

<style>
    .number-button.selected,
    .single-number-button.selected {
        background-color: #ffcc00;
        color: #000;
    }
</style>

<body>
    <div class="wrap">

        <header>
            <?php if (isset($_SESSION['loggedIn'])) :  ?>

                <div class="my-info">
                    <a href="mypage.php" class="name">환영해요 <?= $_SESSION['loggedInUser']['name']; ?> 님! 반갑습니다.
                    </a>

                    <?php

                    $user_id = $_SESSION['loggedInUser']['user_id'];

                    $sql = "SELECT * FROM users WHERE id = '$user_id'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $formatted_credit = number_format($row['credit']);
                        }
                    } else {
                        echo "0 results";
                    }

                    ?>

                    <span class="ml10">
                        <!-- 예약로또현황 | <a href="/ver_02/w_mypage/auto_reserv.php">0종</a> |포인트:  -->
                        <a href="request_deposit.php">₩ <?= number_format($_SESSION['loggedInUser']['credit']); ?></a>
                        <a href="user_request_deposit.php" class="btn-point" title="포인트충전">포인트충전</a>
                        <a href="purchase_details.php" title="구매내역" class="btn-point">구매내역</a>
                        <a href="winning_details.php" title="당첨내역" class="btn-point">당첨내역</a>
                    </span>

                </div>

                <div class="max-wrapper">
                    <h1 class="gnb-logo">
                        <a href="home.php" title="로또캠프"><img src="asset/images/powerTTO2.jpg" alt="로또캠프" /></a>
                    </h1>
                    <a href="javascript:void(0)" class="btn-nav btn-nav-open mo-menu">
                        <img src="asset/images/btn_menu_open.png" alt="메뉴 열기" />
                    </a>
                    <nav class="gnb">
                        <div class="my-info-mo">
                            <div>
                                <a href="user_request_withdrawal.php" class="name"></a>환영해요 <?= $_SESSION['loggedInUser']['name']; ?> 님! 반갑습니다.
                                ₩ <?php echo $formatted_credit; ?>
                            </div>
                            <div>
                                <a href="purchase_details.php" title="구매내역" class="btn-point">구매내역</a>
                                <a href="winning_details.php" title="당첨내역" class="btn-point">당첨내역</a>
                            </div>
                        </div>

                        <div class="sub-menu">
                            <?php alertMessage(); ?>
                            <a href="logout.php" title="로그아웃">로그아웃</a>

                            <a href="javascript:void(0)" class="btn-nav  btn-nav-close2"><img src="./asset/images/btn_menu_close.png" alt="메뉴 닫기"></a>
                        </div>

                        <ul class="gnb-menu">
                            <li class="menu-item">

                                <span class="gnb-btn" style="cursor:pointer">파워또구매</span>
                                <ul class="depth2">
                                    <li><a href="lotto_pb.php" title="파워또">파워또</a></li>
                                </ul>
                            </li>

                            <li class="menu-item">

                                <span class="gnb-btn" style="cursor:pointer">참여리스트</span>
                                <ul class="depth2">
                                    <li><a href="list_purchase.php" title="참여리스트">참여리스트</a></li>
                                </ul>
                            </li>

                            <li class="menu-item">
                                <span class="gnb-btn" style="cursor:pointer">당첨자게시판</span>
                                <ul class="depth2">
                                    <li><a href="winners_board.php" title="당첨자게시판">당첨자게시판</a></li>
                                </ul>
                            </li>

                            <li class="menu-item">
                                <span class="gnb-btn" style="cursor:pointer">당첨번호&통계</span>
                                <ul class="depth2">
                                    <li><a href="winning_statistics.php" title="당첨번호&통계">당첨번호&통계</a></li>
                                </ul>
                            </li>

                            <li class="menu-item">

                                <span class="gnb-btn" style="cursor:pointer">공지사항</span>
                                <ul class="depth2">
                                    <li><a href="notice.php" title="공지사항">공지사항</a></li>
                                </ul>
                            </li>

                            <li class="menu-item">

                                <span class="gnb-btn" style="cursor:pointer">마이페이지</span>
                                <ul class="depth2">
                                    <li> <a href="mypage.php" title="마이페이지">마이페이지</a></li>
                                </ul>
                            </li>

                            <li class="menu-item">

                                <span class="gnb-btn" style="cursor:pointer">입출금</span>
                                <ul class="depth2">
                                    <li><a href="user_depositform.php" title="보증금">입금신청</a></li>
                                    <li><a href="user_withdrawalform.php" title="출금신청">출금신청</a></li>
                                    <li><a href="deposit_details.php" title="입출금 내역">입출금 내역</a></li>
                                </ul>
                            </li>

                            <li class="menu-item">

                                <span class="gnb-btn" style="cursor:pointer">고객센터</span>
                                <ul class="depth2">
                                    <li><a href="cust_details_req.php" title="고객센터">1:1 문의하기</a></li>

                                </ul>
                            </li>
                        </ul>
                        <a href="javascript:void(0)" class="btn-nav btn-nav-open pc-menu">
                            <img src="asset/images/btn_menu_open.png" alt="메뉴 열기" />
                        </a>
                        <a href="javascript:void(0)" class="btn-nav  btn-nav-close1"><img src="asset/images/btn_menu_close.png" alt="메뉴 닫기" /></a>
                        <div class="quick-menu-w" style="right:0px;">
                            <div class="con">
                                <div class="btn-quick-close">
                                    <img src="asset/images/btn_quick_close2.jpg" class="quick-close" /><img src="asset/images/btn_quick_open2.jpg" class="quick-open" style="display:none" />
                                </div>

                                <div class="quick-menu-link">
                                    <!-- <div class="quick-menu">
                                        <a href="w_customer/prize_info.php" class="item"><img src="asset/images/ico_quick2_01.png" alt="당첨금 수령안내" />
                                            <span>당첨금<br />수령</span></a>
                                        <a href="w_customer/prize_info5.php" class="item"><img src="asset/images/ico_quick2_02.png" alt="당첨금 세금안내" />
                                            <span>당첨<br />세금</span></a>
                                        <a href="w_number/mn_analysis.php" class="item"><img src="asset/images/ico_quick2_03.png" alt="내번호 분석" />
                                            <span>내번호<br />분석</span></a>
                                        <a href="w_customer/lotto_news.php" class="item"><img src="asset/images/ico_quick2_04.png" alt="당청스토리" />
                                            <span>당첨<br />스토리</span></a>
                                        <a href="w_mypage/auto_reserv.php" class="item"><img src="asset/images/ico_quick2_05.png" alt="자동예약" />
                                            <span>자동<br />예약</span></a>
                                        <a href="w_customer/qa.php" class="item"><img src="asset/images/ico_quick2_06.png" alt="Q&amp;A문의" />
                                            <span>Q&amp;A<br />문의</span></a>
                                        <a href="https://lottocamp.net/" target="_blank" class="item"><img src="asset/images/ico_quick2_07.png" alt="블로그" />
                                            <span>블로그</span></a>
                                    </div> -->
                                    <!-- <div class="quick-prod">
                                        <a href="w_play/lotto_em.php" title="유로밀리언즈"><img src="asset/images/logo_em.png" /><span>552억</span></a>
                                        <a href="w_play/lotto_cfl.php" title="캐시4라이프"><img src="asset/images/logo_cfl.png" /><span>1,000불/매일</span></a>

                                        <a href="w_play/lotto_pb.php" title="파워볼"><img src="asset/images/logo_pb.png" /><span>7,145억</span></a>
                                        <a href="w_play/lotto_mm.php" title="메가밀리언즈"><img src="asset/images/logo_mm.png" /><span>534억</span></a>

                                        <a href="w_play/lotto_sl.php" title="슈퍼로또플러스"><img src="asset/images/logo_sl.png" /><span>0억</span></a>
                                        <a href="w_play/lotto_nl.php" title="뉴욕로또"><img src="asset/images/logo_nl.png" /><span>121억</span></a>

                                        <a href="w_play/lotto_lp.php" title="라 프리미티바"><img src="asset/images/logo_lp.png" /><span>346억</span></a>
                                        <a href="w_play/lotto_eg.php" title="엘 고르도"><img src="asset/images/logo_eg.png" /><span>80억</span></a>

                                        <a href="w_play/lotto_ej.php" title="유로 잭팟"><img src="asset/images/logo_ej.png" /><span>949억</span></a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>

            <?php else : ?>

                <div class="my-info">
                </div>

                <div class="max-wrapper">
                    <h1 class="gnb-logo"><a href="home.php" title="로또캠프"><img src="asset/images/powerTTO2.jpg" alt="로또캠프"></a></h1>
                    <a href="javascript:void(0)" class="btn-nav btn-nav-open mo-menu"> <img src="./asset/images/btn_menu_open.png" alt="메뉴 열기"> </a>
                    <nav class="gnb">

                        <div class="sub-menu">
                            <a href="login.php" title="로그인">로그인</a>
                            <a href="join.php" title="회원가입">회원가입</a>
                            <a href="javascript:void(0)" class="btn-nav  btn-nav-close2"><img src="./asset/images/btn_menu_close.png" alt="메뉴 닫기"></a>
                        </div>

                        <ul class="gnb-menu">
                            <li class="menu-item">
                                <span class="gnb-btn" style="cursor:pointer"><a href="lotto_pb.php" title="파워 어게인">파워또구매</a></span>
                                <ul class="depth2">
                                    <!-- <li><a href="lotto_pb.php" title="파워 어게인">파워또구매</a></li> -->
                                </ul>
                            </li>

                            <li class="menu-item">
                                <span class="gnb-btn" style="cursor:pointer"><a href="winners_board.php" title="당첨자게시판">당첨자게시판</a></span>
                                <ul class="depth2">
                                </ul>
                            </li>


                            <li class="menu-item">
                                <span class="gnb-btn" style="cursor:pointer"><a href="winning_statistics.php" title="당첨번호&amp;통계">당첨번호&amp;통계</a></span>
                                <ul class="depth2">
                                </ul>
                            </li>



                            <li class="menu-item">
                                <span class="gnb-btn" style="cursor:pointer"><a href="notice.php">공지사항</a></span>
                                <ul class="depth2">
                                </ul>
                            </li>

                            <!-- <li class="menu-item">
                                <span class="gnb-btn" style="cursor:pointer">마이페이지</span>
                                <ul class="depth2">
                                </ul>
                            </li> -->

                            <li class="menu-item">
                                <span class="gnb-btn" style="cursor:pointer"><a href="customer_service.php" title="고객센터">고객센터</a></span>

                                <!-- <ul class="depth2">
                                    <li><a href="../ver_02/w_customer/lotto_news.php" title="파워볼 안내">파워볼 안내</a></li>
                                    <li><a href="/ver_02/w_info/lotto_mm.php" title="메가밀리언 안내">메가밀리언 안내</a></li>
                                    <li><a href="/ver_02/w_info/lotto_sl.php" title="슈퍼로또 안내">슈퍼로또 안내</a></li>
                                    <li><a href="/ver_02/w_info/lotto_nl.php" title="뉴욕로또 안내">뉴욕로또 안내</a></li>
                                    <li><a href="/ver_02/w_info/lotto_cfl.php" title="캐쉬포라이프 안내">캐쉬포라이프 안내</a></li>
                                    <li><a href="/ver_02/w_info/lotto_em.php" title="유로밀리언 안내">유로밀리언 안내</a></li>
                                    <li><a href="/ver_02/w_info/lotto_eg.php" title="엘 고르도 안내">엘 고르도 안내</a></li>
                                    <li><a href="/ver_02/w_info/lotto_lp.php" title="라 프리미티바 안내">라 프리미티바 안내</a></li>
                                    <li><a href="/ver_02/w_info/lotto_ej.php" title="유로잭팟 안내">유로잭팟 안내</a></li>
                                    <li><a href="/ver_02/w_info/lotto_649.php" title="로또649 안내">로또649 안내</a></li>
                                    <li><a href="/ver_02/w_info/lotto_lm.php" title="로또맥스 안내">로또맥스 안내</a></li>
                                    <li><a href="/ver_02/w_info/lotto_bc49.php" title="BC49 안내">BC49 안내</a></li>
                                </ul> -->
                            </li>
                        </ul>

                        <a href="javascript:void(0)" class="btn-nav btn-nav-open pc-menu"> <img src="./asset/images/btn_menu_open.png" alt="메뉴 열기"> </a>
                        <a href="javascript:void(0)" class="btn-nav  btn-nav-close1"><img src="./asset/images/btn_menu_close.png" alt="메뉴 닫기"></a>
                        <div class="quick-menu-w" style="right: -58px;">
                            <div class="con">
                                <div class="btn-quick-close"><img src="./asset/images/btn_quick_close2.jpg" class="quick-close" style="display: none;"><img src="./asset/images/btn_quick_open2.jpg" class="quick-open" style="display:none"></div>
                                <div class="quick-menu-link">
                                    <!-- <div class="quick-menu">
                                        <a href="/ver_02/w_customer/prize_info.php" class="item"><img src="./asset/images/ico_quick2_01.png" alt="당첨금 수령안내"> <span>당첨금<br>수령</span></a>
                                        <a href="/ver_02/w_customer/prize_info5.php" class="item"><img src="./asset/images/ico_quick2_02.png" alt="당첨금 세금안내"> <span>당첨<br>세금</span></a>.
                                        <a href="/ver_02/w_number/mn_analysis.php" class="item"><img src="./asset/images/ico_quick2_03.png" alt="내번호 분석"> <span>내번호<br>분석</span></a>
                                        <a href="/ver_02/w_customer/lotto_news.php" class="item"><img src="./asset/images/ico_quick2_04.png" alt="당청스토리"> <span>당첨<br>스토리</span></a>
                                        <a href="/ver_02/w_mypage/auto_reserv.php" class="item"><img src="./asset/images/ico_quick2_05.png" alt="자동예약"> <span>자동<br>예약</span></a>
                                        <a href="/ver_02/w_customer/qa.php" class="item"><img src="./asset/images/ico_quick2_06.png" alt="Q&amp;A문의"> <span>Q&amp;A<br>문의</span></a>
                                        <a href="https://lottocamp.net/" target="_blank" class="item"><img src="./asset/images/ico_quick2_07.png" alt="블로그"> <span>블로그</span></a>
                                    </div>
                                    <div class="quick-prod">
                                        <a href="/ver_02/w_play/lotto_em.php" title="유로밀리언즈"><img src="./asset/images/logo_em.png"><span>552억</span></a>
                                        <a href="/ver_02/w_play/lotto_cfl.php" title="캐시4라이프"><img src="./asset/images/logo_cfl.png"><span>1,000불/매일</span></a>

                                        <a href="/ver_02/w_play/lotto_pb.php" title="파워볼"><img src="./asset/images/logo_pb.png"><span>7,476억</span></a>
                                        <a href="/ver_02/w_play/lotto_mm.php" title="메가밀리언즈"><img src="./asset/images/logo_mm.png"><span>534억</span></a>

                                        <a href="/ver_02/w_play/lotto_sl.php" title="슈퍼로또플러스"><img src="./asset/images/logo_sl.png"><span>0억</span></a>
                                        <a href="/ver_02/w_play/lotto_nl.php" title="뉴욕로또"><img src="./asset/images/logo_nl.png"><span>121억</span></a>

                                        <a href="/ver_02/w_play/lotto_lp.php" title="라 프리미티바"><img src="./asset/images/logo_lp.png"><span>346억</span></a>
                                        <a href="/ver_02/w_play/lotto_eg.php" title="엘 고르도"><img src="./asset/images/logo_eg.png"><span>80억</span></a>

                                        <a href="/ver_02/w_play/lotto_ej.php" title="유로 잭팟"><img src="./asset/images/logo_ej.png"><span>949억</span></a>
                                    </div>
                                </div> -->
                                </div>
                            </div>
                    </nav>
                </div>
                
            <?php endif; ?>
        </header>