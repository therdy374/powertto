<?php
$page_title = "Notice";
include "./includes/menubar.php";

?>
<style>
    .table-lisw-w .ico-notice>div:nth-child(2) span {
    display: inline-block;
    width: 60px;
    height: 27px;
    text-align: center;
    /* border: 1px solid #069; */
    color: #fff;
    font-size: 16px;
    box-sizing: border-box;
    background-color: #03363d;
}
</style>

<section class="container" style="padding-top: 130px;">
    <h1 class="content-tit visual05"><span>고객센터</span></h1>
    <div class="header">
        <h2>공지사항</h2>
        <div class="navi">
            <a href="/index.php">홈으로</a>
            <span>공지사항</span>
        </div>
    </div>
    <div class="contents">
  
        <div class="inner-contents">
            
                <div class="table-head">
                    <div class="list-tit">전체<em class="t-red">137</em> 건이 검색되었습니다.</div>
                </div>
            
            <div class="table-lisw-w type-bbs mt20">
                <div class="item th-head">
                    <div class="pw8p">번호</div>
                    <div class="pwauto">제목</div>
                    <div class="pw15p">글쓴이</div>
                    <!-- <div class="pw10p">조회</div> -->
                </div>

                <div class="tbody">

                    <div class="item ico-notice">
                        
                        <div class="pw8p"><span>4</span></div>
                        <div class="pwauto t-l"><a href="lotto_news_view.php?"><span>공지</span> 차트 기준점</a></div>
                        <div class="pw15p">관리자</div>
                        <!-- <div class="pw10p">379</div> -->
                    </div>

                    <div class="item ico-notice">
                        
                        <div class="pw8p"><span>3</span></div>
                        <div class="pwauto t-l"><a href="lotto_news_view.php?"><span>공지</span> ※ 운영시간 및 입출금 시간 안내 ※</a></div>
                        <div class="pw15p">관리자</div>
                        <!-- <div class="pw10p">379</div> -->
                    </div>

                    <div class="item ico-notice">
                        
                        <div class="pw8p"><span>2</span></div>
                        <div class="pwauto t-l"><a href="lotto_news_view.php?"><span>공지</span>※PC & 스마트폰 쿠키파일 삭제 방법 안내 ※</a></div>
                        <div class="pw15p">관리자</div>
                        <!-- <div class="pw10p">379</div> -->
                    </div>

                    <div class="item ico-notice">
                        
                        <div class="pw8p"><span>1</span></div>
                        <div class="pwauto t-l"><a href="lotto_news_view.php?"><span>공지</span> ※ 입출금 관련 안내 ※</a></div>
                        <div class="pw15p">관리자</div>
                        <!-- <div class="pw10p">379</div> -->
                    </div>

                </div>
            </div>

            <div class="paging">
               
                <a href="" class="btn moreview">더보기</a>
            </div>


        </div>
    </div>
</section>

<iframe src="" name="ifr1" width="0" height="0"></iframe>

<?php require "includes/footer.php"; ?>