<?php
require "./includes/menubar.php";
?>

<div class="quick-prod-top">
    <div class="con">
        <a href="/ver_02/w_play/lotto_em.php" title="�&nbsp;로밀리언즈" class="quick-prod-em"><img src="asset/images/logo_em.png" /><span>3,081억</span></a>

        <a href="/ver_02/w_play/lotto_cfl.php" title="캐시4라이프" class="quick-prod-cfl"><img src="asset/images/logo_cfl.png" /><span>1,000불/매일</span></a>

        <a href="/ver_02/w_play/lotto_pb.php" title="파워볼" class="quick-prod-pb"><img src="asset/images/logo_pb.png" /><span>5,356억</span></a>

        <a href="/ver_02/w_play/lotto_mm.php" title="메가밀리언즈" class="quick-prod-mm"><img src="asset/images/logo_mm.png" /><span>4,901억</span></a>

        <a href="/ver_02/w_play/lotto_sl.php" title="슈퍼로또플러스" class="quick-prod-sl"><img src="asset/images/logo_sl.png" /><span>0억</span></a>

        <a href="/ver_02/w_play/lotto_nl.php" title="뉴욕로또" class="quick-prod-nl"><img src="asset/images/logo_nl.png" /><span>104억</span></a>

        <a href="/ver_02/w_play/lotto_lp.php" title="라 프리미티바" class="quick-prod-lp"><img src="asset/images/logo_lp.png" /><span>197억</span></a>

        <a href="/ver_02/w_play/lotto_eg.php" title="엘 �&nbsp;르도" class="quick-prod-eg"><img src="asset/images/logo_eg.png" /><span>74억</span></a>

        <a href="/ver_02/w_play/lotto_ej.php" title="�&nbsp;로 잭팟" class="quick-prod-ej"><img src="asset/images/logo_ej.png" /><span>468억</span></a>
    </div>
</div>

<style>
    .quick-prod-top {
        display: none;
    }

    .container {
        padding-top: 130px;
    }

    @media screen and (max-width: 768px) {
        .container {
            padding-top: 55px;
        }
    }
</style>
<div class="container">
    <div class="main-inner-bn">

        <div class="main-bn">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="https://www.lottocamp3.com/ver_02/w_play/lotto_etc.php?part_idx=1"><img src="asset/images/1.jpg" /></a>
                    </div>
                    <div class="swiper-slide">
                        <a href="https://www.lottocamp3.com/ver_02/w_play/lotto_etc.php?part_idx=4"><img src="asset/images/2.jpg" /></a>
                    </div>
                    <div class="swiper-slide">
                        <a href="https://www.lottocamp3.com/ver_02/w_play/lotto_etc.php?part_idx=2"><img src="asset/images/3.jpg" /></a>
                    </div>
                    <div class="swiper-slide">
                        <a href="https://www.lottocamp3.com/ver_02/w_play/lotto_etc.php?part_idx=3"><img src="asset/images/4.jpg" /></a>
                    </div>
                    <div class="swiper-slide">
                        <a href="https://www.lottocamp3.com/ver_02/w_play/lotto_etc.php?part_idx=5"><img src="asset/images/5.jpg" /></a>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <div class="main-hot-notice">
            <h3>HOT! 최근 소식</h3>
            <a href="w_customer/lotto_news.php" class="btn-more-w"></a>


            <a href="./w_customer/event_view.php?bbs_data=aWR4PTY5MjImc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPSZjb2RlPSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||" class="linked">
                <span class="content">
                    <span class="tit">[1월이벤트-3] 슈퍼유로밀리언 FREE공구 이벤트</span>
                </span>
                <span class="date">2024-01-23</span>
            </a>




            <a href="./w_customer/notice_view.php?bbs_data=aWR4PTY5MjEmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPSZjb2RlPSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||" class="linked">
                <span class="content">
                    <span class="tit">한국에서 싸이트 접속불가시 로또캠프 블로그를 확인하세요</span>
                </span>
                <span class="date">2024-01-21</span>
            </a>




            <a href="./w_customer/notice_view.php?bbs_data=aWR4PTY5MTkmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPSZjb2RlPSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||" class="linked">
                <span class="content">
                    <span class="tit">2024년 첫번째 슈퍼유로밀리언 안내 (1월 27일)</span>
                </span>
                <span class="date">2024-01-14</span>
            </a>


        </div>
    </div>

    <div class="main-lotto-buy-w" id="lottoBuy">
        <div class="main-lotto-inner">
            <h3>로또 구매</h3>

            <div class="main-lotto-buy">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <script type="text/javascript">
                            function getTime() {
                                now = new Date();
                                k_year = Number("2023");
                                k_month = Number("12") - 1;
                                k_day = Number("04");
                                k_hour = Number("23");
                                k_min = Number("50");
                                //alert(k_year);
                                dday = new Date(
                                    k_year,
                                    k_month,
                                    k_day,
                                    k_hour,
                                    k_min,
                                    "59"
                                );
                                //alert(dday);
                                days = (dday - now) / 1000 / 60 / 60 / 24;
                                //alert (days);
                                daysRound = Math.floor(days);

                                hours = (dday - now) / 1000 / 60 / 60 - 24 * daysRound;
                                hoursRound = Math.floor(hours);

                                minutes =
                                    (dday - now) / 1000 / 60 -
                                    24 * 60 * daysRound -
                                    60 * hoursRound;
                                minutesRound = Math.floor(minutes);

                                seconds =
                                    (dday - now) / 1000 -
                                    24 * 60 * 60 * daysRound -
                                    60 * 60 * hoursRound -
                                    60 * minutesRound;
                                secondsRound = Math.round(seconds);
                                //alert (getTime);
                                //alert (daysRound  + "-" + hoursRound + "-" + minutesRound + "-" + secondsRound);
                                if (
                                    Number(
                                        daysRound +
                                        "" +
                                        hoursRound +
                                        "" +
                                        minutesRound +
                                        "" +
                                        secondsRound
                                    ) > 0
                                ) {
                                    if (hoursRound < 10) {
                                        hoursRound_str = "0" + hoursRound;
                                    } else {
                                        hoursRound_str = hoursRound;
                                    }
                                    if (minutesRound < 10) {
                                        minutesRound_str = "0" + minutesRound;
                                    } else {
                                        minutesRound_str = minutesRound;
                                    }
                                    if (secondsRound < 10) {
                                        secondsRound_str = "0" + secondsRound;
                                    } else {
                                        secondsRound_str = secondsRound;
                                    }
                                    document.getElementById("show_cate_str").innerHTML =
                                        daysRound +
                                        "일 " +
                                        hoursRound_str +
                                        ":" +
                                        minutesRound_str +
                                        ":" +
                                        secondsRound_str +
                                        " ";
                                } else {
                                    document.getElementById("show_cate_str").innerHTML =
                                        "마감";
                                }
                                newtime = window.setTimeout("getTime();", 1000);
                            }
                        </script>
                        <?php

                        $last_draw = "SELECT * FROM generate_numbers ORDER BY generated_at DESC";

                        $query = mysqli_query($conn, $last_draw);

                        if (mysqli_num_rows($query) > 0) {
                            foreach ($query as $row) {
                        ?>

                                <div class="swiper-slide">
                                    <div class="logo">
                                        <img src="asset/images/logo2_pb.jpg" />
                                        <span>EVENT</span>
                                    </div>
                                    <div class="pay">
                                        5,356억 <span class="money">$412,000,000</span>
                                    </div>
                                    <div class="date">마지막 추첨 : <?= date('Y.m.d(D)h:m:s', strtotime($row['generated_at'])) ?></div>
                                    <!-- <div class="end-date">
                                        주문마감 : <span id="show_cate_str">0일 21:34:19 </span>
                                        <script>
                                            getTime();
                                        </script>
                                    </div> -->
                                    <div class="num">

                                        <a href="javascript:sign();">
                                            <em class="bg-bl"><?= date('M', strtotime($row['generated_at'])) ?></em>
                                        </a>
                                        <?= $row['main_numbers'] ?>,<span class="t-red"> <?= $row['powerball_number'] ?></span>
                                    </div>
                                    <!-- <div class="btn">
                                        <a href="/ver_02/w_play/lotto_pb.php" class="btn-comm btn-pk">구매하기</a>
                                    </div> -->
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

                <button class="btn-lotto-prev">
                    <img src="asset/images/btn_main_swiper_prev.png" alt="이�&nbsp;�" />
                </button>
                <button class="btn-lotto-next">
                    <img src="asset/images/btn_main_swiper_next.png" alt="다음" />
                </button>
                <div class="pagination-w">
                    <div class="swiper-pagination"></div>
                    <button type="button" class="btn-view-all btn-view-open">
                        View All
                    </button>
                </div>
            </div>
            <!-- view all -->
            <div class="main-lotto-buy-all" style="display: none">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <script type="text/javascript">
                            function getTime_Prod() {
                                now = new Date();
                                k_year = Number("2023");
                                k_month = Number("12") - 1;
                                k_day = Number("04");
                                k_hour = Number("23");
                                k_min = Number("50");
                                //alert(k_year);
                                dday = new Date(
                                    k_year,
                                    k_month,
                                    k_day,
                                    k_hour,
                                    k_min,
                                    "59"
                                );
                                //alert(dday);
                                days = (dday - now) / 1000 / 60 / 60 / 24;
                                //alert (days);
                                daysRound = Math.floor(days);

                                hours = (dday - now) / 1000 / 60 / 60 - 24 * daysRound;
                                hoursRound = Math.floor(hours);

                                minutes =
                                    (dday - now) / 1000 / 60 -
                                    24 * 60 * daysRound -
                                    60 * hoursRound;
                                minutesRound = Math.floor(minutes);

                                seconds =
                                    (dday - now) / 1000 -
                                    24 * 60 * 60 * daysRound -
                                    60 * 60 * hoursRound -
                                    60 * minutesRound;
                                secondsRound = Math.round(seconds);
                                //alert (getTime_Prod);
                                //alert (daysRound  + "-" + hoursRound + "-" + minutesRound + "-" + secondsRound);
                                if (
                                    Number(
                                        daysRound +
                                        "" +
                                        hoursRound +
                                        "" +
                                        minutesRound +
                                        "" +
                                        secondsRound
                                    ) > 0
                                ) {
                                    if (hoursRound < 10) {
                                        hoursRound_str = "0" + hoursRound;
                                    } else {
                                        hoursRound_str = hoursRound;
                                    }
                                    if (minutesRound < 10) {
                                        minutesRound_str = "0" + minutesRound;
                                    } else {
                                        minutesRound_str = minutesRound;
                                    }
                                    if (secondsRound < 10) {
                                        secondsRound_str = "0" + secondsRound;
                                    } else {
                                        secondsRound_str = secondsRound;
                                    }
                                    document.getElementById(
                                            "show_cate_str_Prod"
                                        ).innerHTML =
                                        daysRound +
                                        "일 " +
                                        hoursRound_str +
                                        ":" +
                                        minutesRound_str +
                                        ":" +
                                        secondsRound_str +
                                        " ";
                                } else {
                                    document.getElementById(
                                        "show_cate_str_Prod"
                                    ).innerHTML = "마감";
                                }
                                newtime_Prod = window.setTimeout("getTime_Prod();", 1000);
                            }
                        </script>

                        <?php

                        $last_draw = "SELECT * FROM generate_numbers ORDER BY generated_at DESC";

                        $query = mysqli_query($conn, $last_draw);

                        if (mysqli_num_rows($query) > 0) {
                            foreach ($query as $row) {
                        ?>

                                <div class="swiper-slide">
                                    <div class="logo">
                                        <img src="asset/images/logo2_pb.jpg" />
                                        <span>EVENT</span>
                                    </div>
                                    <div class="pay">
                                        5,356억 <span class="money">$412,000,000</span>
                                    </div>
                                    <div class="date">마지막 추첨 : <?= date('Y.m.d(D)h:m:s', strtotime($row['generated_at'])) ?></div>
                                    <!-- <div class="end-date">
                                            주문마감 : <span id="show_cate_str">0일 21:34:19 </span>
                                            <script>
                                                getTime();
                                            </script>
                                        </div> -->
                                    <div class="num">

                                        <a href="javascript:sign();">
                                            <em class="bg-bl"><?= date('M', strtotime($row['generated_at'])) ?></em>
                                        </a>
                                        <?= $row['main_numbers'] ?>,<span class="t-red"> <?= $row['powerball_number'] ?></span>
                                    </div>
                                    <!-- <div class="btn">
                                            <a href="/ver_02/w_play/lotto_pb.php" class="btn-comm btn-pk">구매하기</a>
                                        </div> -->
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
                <div class="pagination-w">
                    <a href="#lottoBuy"><button type="button" class="btn-view-all btn-view-close">
                            Close
                        </button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="main-bbs-w">
        <div class="main-bbs-inner">
            <div class="con">
                <div class="bbs-w">
                    <ul>
                        <li onclick="javascript:bbsTab('1');" class="selected">
                            당첨소식
                        </li>
                        <li onclick="javascript:bbsTab('2');">공지사항</li>
                        <li onclick="javascript:bbsTab('3');">복권뉴스</li>
                        <li onclick="javascript:bbsTab('4');">도움안내</li>
                        <li onclick="javascript:bbsTab('5');">이벤트</li>
                    </ul>
                    <div class="main-bbs-list">
                        <a href="w_customer/win_story.php" class="btn-more"></a>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/win_story_view.php?bbs_data=aWR4PTY4NzMmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXdpbl9uZXdzJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">2023년
                                    Dia de la Madre 어머니의�&nbsp; 특별복권
                                    추첨소식</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/win_story_view.php?bbs_data=aWR4PTY4NjUmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXdpbl9uZXdzJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">2023년
                                    DIA DEL PADRE 아�&nbsp;의�&nbsp; 특별복권
                                    추첨소식</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/win_story_view.php?bbs_data=aWR4PTY4NjImc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXdpbl9uZXdzJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">2023년
                                    San Valentin 성발�&nbsp;�타인 특별복권 추첨소식
                                    (40107)</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/win_story_view.php?bbs_data=aWR4PTY4NTYmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXdpbl9uZXdzJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">2023년
                                    EL NINO 특별복권 추첨소식 (89603)</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/win_story_view.php?bbs_data=aWR4PTY4NTQmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXdpbl9uZXdzJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">2022
                                    나비닷(엘�&nbsp;르도) 성탄특별복권 추첨 소식</a></span>
                        </div>
                    </div>
                    <div class="main-bbs-list" style="display: none">
                        <a href="w_customer/notice.php" class="btn-more"></a>
                        <div class="item">
                            <span class="linked"><a href="./w_customer/notice_view.php?bbs_data=aWR4PTY5MDkmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5vdGljZSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">8일
                                    성모마리아축일 �&nbsp;럽복권 마감시간 임시변경
                                    (7일)</a></span><span class="ico-new">NEW</span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/notice_view.php?bbs_data=aWR4PTY5MDgmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5vdGljZSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">29일
                                    (美)오더 메릴랜드 티켓으로 구매 예�&nbsp;�</a></span><span class="ico-new">NEW</span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/notice_view.php?bbs_data=aWR4PTY5MDcmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5vdGljZSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">한국내
                                    구매대행업체의 대법원 판례와 구매에 대한 안내</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/notice_view.php?bbs_data=aWR4PTY5MDMmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5vdGljZSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">금일
                                    추첨 메가�&nbsp;�슷잭팟 상품구매 대체 발행</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/notice_view.php?bbs_data=aWR4PTY4OTkmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5vdGljZSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">현재
                                    싸이트 �&nbsp;�속이 원활합니다. (복구완료)</a></span>
                        </div>
                    </div>
                    <div class="main-bbs-list" style="display: none">
                        <a href="w_customer/lotto_news.php" class="btn-more"></a>
                        <div class="item">
                            <span class="linked"><a href="./w_customer/lotto_news_view.php?bbs_data=aWR4PTY4ODgmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5ld3Mmc2VhcmNoX2l0ZW09JnNlYXJjaF9vcmRlcj0=||">갈수록
                                    가관. 막장을 치닫는 한국 복권</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/lotto_news_view.php?bbs_data=aWR4PTY4Nzkmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5ld3Mmc2VhcmNoX2l0ZW09JnNlYXJjaF9vcmRlcj0=||">스웨덴에는
                                    스피드 카메라 복권이 주목 받�&nbsp;
                                    있습니다.</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/lotto_news_view.php?bbs_data=aWR4PTY4Nzcmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5ld3Mmc2VhcmNoX2l0ZW09JnNlYXJjaF9vcmRlcj0=||">�&nbsp;�
                                    세계 복권판매 급증..... 서민들의 꿈과 희망을
                                    건다</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/lotto_news_view.php?bbs_data=aWR4PTY4NTImc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5ld3Mmc2VhcmNoX2l0ZW09JnNlYXJjaF9vcmRlcj0=||">슈퍼�&nbsp;로밀리언에서
                                    나온 공동구매당첨</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/lotto_news_view.php?bbs_data=aWR4PTY4MzUmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPW5ld3Mmc2VhcmNoX2l0ZW09JnNlYXJjaF9vcmRlcj0=||">필리핀
                                    로또 추첨서 잭팟 1등만 433명 당첨금은?</a></span>
                        </div>
                    </div>
                    <div class="main-bbs-list" style="display: none">
                        <a href="w_customer/help.php" class="btn-more"></a>
                        <div class="item">
                            <span class="linked"><a href="./w_customer/help_view.php?bbs_data=aWR4PTY2NTkmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXFuYSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">비밀번호는
                                    6개월마다 변경 해주세요</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/help_view.php?bbs_data=aWR4PTY2NTEmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXFuYSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">방화벽차단으로
                                    �&nbsp;�속이 불가합니다.</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/help_view.php?bbs_data=aWR4PTY2MjEmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXFuYSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">존재하지
                                    않은 아이디로 표시되는 경우</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/help_view.php?bbs_data=aWR4PTY1NDYmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXFuYSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">�&nbsp;객센터로
                                    메일을 보냈는데 답변이 없습니다.</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/help_view.php?bbs_data=aWR4PTU5MzUmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPXFuYSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">회원가입후
                                    이메일인증을 해야 로그인이
                                    가능합니다.(QR가입�&nbsp;�외)</a></span>
                        </div>
                    </div>
                    <div class="main-bbs-list" style="display: none">
                        <a href="w_customer/event.php" class="btn-more"></a>
                        <div class="item">
                            <span class="linked"><a href="./w_customer/event_view.php?bbs_data=aWR4PTY5MDUmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWV2ZW50JnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">[11월이벤트-4]
                                    메릴랜드 티켓 구입시 THANKSWINNING
                                    TICKET 증�&nbsp;�(랜덤)-종료</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/event_view.php?bbs_data=aWR4PTY5MDQmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWV2ZW50JnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">[11월이벤트-3]
                                    FREE공구 메가�&nbsp;�스트잭팟 이벤트</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/event_view.php?bbs_data=aWR4PTY5MDImc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWV2ZW50JnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">[11월이벤트-2]
                                    FREE공구 EuroDreams �&nbsp;로드림즈 5QP
                                    20골드</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/event_view.php?bbs_data=aWR4PTY5MDEmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWV2ZW50JnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">[11월이벤트-1]
                                    나비닷(성탄)복권 사�&nbsp;�예약 이벤트
                                    (�&nbsp;인�&nbsp;�공) [종료]</a></span>
                        </div>

                        <div class="item">
                            <span class="linked"><a href="./w_customer/event_view.php?bbs_data=aWR4PTY4OTQmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWV2ZW50JnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">[10월이벤트]
                                    �&nbsp;규가입회원 $100이상 충�&nbsp;�시
                                    보너스포인트 증�&nbsp;�</a></span>
                        </div>
                    </div>
                </div>
                <div class="faq-w">
                    <h3>자주묻는 질문</h3>
                    <a href="w_customer/faq.php" class="btn-more"></a>

                    <div class="item">
                        <span class="ico-comm bg-sky">1등당첨금</span>
                        <span class="linked"><a href="./w_customer/faq_view.php?bbs_data=aWR4PTY4OTEmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWZhcSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">메릴랜드
                                티켓은 어떻게 구매�&nbsp; 수 있나요?</a></span>
                    </div>

                    <div class="item">
                        <span class="ico-comm bg-org">주문(결�&nbsp;�)</span>
                        <span class="linked"><a href="./w_customer/faq_view.php?bbs_data=aWR4PTY3NzEmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWZhcSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">키오스크라는
                                기계를 통해 구입해도 되나요?</a></span>
                    </div>

                    <div class="item">
                        <span class="ico-comm bg-gr">기타</span>
                        <span class="linked"><a href="./w_customer/faq_view.php?bbs_data=aWR4PTQ4NDUmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWZhcSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">미국로또
                                한국인이 구매하면 처벌되나요?</a></span>
                    </div>

                    <div class="item">
                        <span class="ico-comm bg-org">주문(결�&nbsp;�)</span>
                        <span class="linked"><a href="./w_customer/faq_view.php?bbs_data=aWR4PTE2OTgmc3RhcnRQYWdlPSZsaXN0Tm89JnRhYmxlPWNzX2dvb2RzX2V0YyZjb2RlPWZhcSZzZWFyY2hfaXRlbT0mc2VhcmNoX29yZGVyPQ==||">미국&amp;�&nbsp;럽복권
                                처음 구매자(초보자) 를 위한
                                사용안내</a></span>
                    </div>

                    <div class="item">
                        <span class="ico-comm bg-sky">1등당첨금</span>
                        <span class="linked"><a href="./w_customer/faq_view.php?bbs_data=aWR4PTU2NyZzdGFydFBhZ2U9Jmxpc3RObz0mdGFibGU9Y3NfZ29vZHNfZXRjJmNvZGU9ZmFxJnNlYXJjaF9pdGVtPSZzZWFyY2hfb3JkZXI9||">Euromillions
                                당첨금은 어디서 수�&nbsp;�을 하나요?</a></span>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>