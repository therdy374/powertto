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
        color: #fff;
        font-size: 16px;
        box-sizing: border-box;
        background-color: #03363d;
    }

    @media screen and (max-width: 768px) {
        .btn-comm {
            width: 30%;
            margin: auto;
            white-space: nowrap;
            font-size: 20px;
        }

    }
</style>

<section class="container" style="padding-top: 130px;">
<?php alertMessage(); ?>
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

            <?php
            // Get total row count
            $sql2 = "SELECT COUNT(*) AS row_count FROM announcement";
            $query_run2 = mysqli_query($conn, $sql2);

            if ($query_run2->num_rows > 0) {
                $row = $query_run2->fetch_assoc();
                $rowCount = $row['row_count'];
            ?>
                <div class="table-head">
                    <div class="list-tit">전체<em class="t-red"> <?php echo $rowCount; ?></em> 건이 검색되었습니다.</div>
                </div>

                <div class="table-lisw-w type-bbs mt20">
                    <div class="item th-head">
                        <div class="pw8p">번호</div>
                        <div class="pwauto">제목</div>
                        <div class="pw15p">글쓴이</div>
                    </div>
                    <?php
                    $sql = "SELECT * FROM announcement ORDER BY `date_content` DESC";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <div class="tbody">
                            <?php
                            $num = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];

                                echo '
                                <div class="item ico-notice">
                                    <div class="pw8p"><span>' . $num++ . '</span></div>
                                    <div class="pwauto t-l"><a href="post_notice.php?id=' . $id . '"><span>공지</span> ' . $row["title"] . '</a></div>
                                    <div class="pw15p">' . $row["name"] . '</div>
                                </div>';
                            }
                            ?>
                        </div>
                <?php
                    } else {
                        echo "No Announcement today";
                    }
                }
                ?>

                </div>

                <div class="btn-cart mt30 al-center ">
                    <button type="submit" name="more" class="btn-comm btn-dpk "><img src="asset/images/ico_in_cart.png" alt="icon" class="mr5">더보기</button>
                </div>
               
        </div>
</section>

<iframe src="" name="ifr1" width="0" height="0"></iframe>

<?php require "includes/footer.php"; ?>