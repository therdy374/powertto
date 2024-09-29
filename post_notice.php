<?php
$page_title = "Customer Inquiry";

require "./includes/menubar.php";
?>
<style>
    a:link,
    a:visited {
        color: #fff;
        font-family: 'Noto Sans KR', 'Apple SD Gothic Neo', 'Malgun Gothic', '맑은 고딕', 'san-serif';
        text-decoration: none;
    }


    .container .contents {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px 20px 30px 20px;
        border: 1px solid #bfbfbf;
        margin-bottom: 20px;
    }


    .btn-cart .cancel {
        background-color: gray;
        display: inline-block;
        padding: 15px 20px;
        text-decoration: none;
        color: #fff;

    }

    .btn-cart .cancel:hover {
        background-color: darkgray;

    }

    .btn-dpk {
        background: #f42c6c;
        color: #FFF !important;
        margin-left: 5px;

    }

    .table-col td input[type='text'] {
        height: 40px;
        background: #f6f6f6;
        box-shadow: 2px;
    }

    .table-col th {
        background: #f6f6f6;
        /* padding-left: 28px; */
        font-size: 16px;
        font-weight: 300;
        text-align: left;
        vertical-align: middle;
        letter-spacing: -0.05em;
    }


    @media only screen and (max-width: 600px) {

        .table-col th,
        .table-col td {
            display: block;
            width: 100%;
        }

        .table-col th {
            margin-top: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
        }

        .btn-comm {
            width: 30%;
            margin: auto;
            font-size: 25px;
        }

   
    }
</style>

<section class="container">
    <h1 class="content-tit visual04"><span>Post Notice</span></h1>
    <div class="header">
        <h2>공지사항</h2>
        <!-- <div class="btn-w">
            <a href="user_depositform.php">출금신청</a>
        </div>
        <div class="navi">
            <a href="">홈으로</a>
            <span>입금신청</span>
            <span>1:1문의</span>
        </div> -->
    </div>
    <div class="contents">

        <div class="inner-contents">
            <input type="hidden" name="user_id" value="<?= $_SESSION['loggedInUser']['user_id']; ?>" placeholder="비밀번호"><br>
            <input type="hidden" name="bank_name" value="<?= $_SESSION['loggedInUser']['bank_name']; ?>">
            <input type="hidden" name="bank_acct_num" value="<?= $_SESSION['loggedInUser']['bank_acct_num']; ?>">
            <input type="hidden" name="name" value="<?= $_SESSION['loggedInUser']['name']; ?>">
            <input type="hidden" name="credit" value="<?= $_SESSION['loggedInUser']['credit']; ?>">
            <input type="hidden" name="status" value="pending"><br>

            <div>
                <table cellpadding="0" cellspacing="0" class="table-col">
                    <colgroup>
                        <col style="width:200px" class="mw80" />
                        <col style="width:auto" />
                    </colgroup>
                    <?php
                    include "./includes/connect.php";
                    date_default_timezone_set('Asia/Seoul');

                    $user_id = $_GET['id'];
                    // Use prepared statement to prevent SQL injection
                    $sql = "SELECT * FROM announcement WHERE id=?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $date_message = $row['date_content'];
                        $reply_message = $row['content'];

                        // echo $reply_message;
                    ?>

                        <tbody>
                            <tr>
                                <th class="w10p"><em>※</em> 제목</th>
                                <td>
                                    <input type="text" name="bank_name" class="w250 mw100p" value="<?php echo $row['title']; ?>" readonly />
                                </td>
                            </tr>
                            <tr>
                                <th class="w10p"><em>※</em> 작성자</th>
                                <td>
                                    <input type="text" name="name" class="w250 mw100p" value="<?php echo $row['name']; ?>" placeholder="작성자" readonly />
                                </td>
                                <th class="w10p"><em>※</em> 작성일</th>
                                <td>
                                    <!-- Displaying date_message as Y/m -->
                                    <input type="text" name="date_message" class="w250 mw100p" value="<?= date('Y/m/d', strtotime($date_message)) ?>" readonly />
                                </td>
                            </tr>
                        </tbody>
                    <?php
                    }
                    ?>

                </table>
                <span><?php echo $reply_message; ?></span>

                <div class="btn-cart mt30 al-center ">
                    <button type="submit" name="more" class="btn-comm btn-dpk "><a href="notice.php">목록</a></button>
                </div>
                <!-- <div class="mt50 al-center mo-mt20">
                    <button type="submit" name="req_withdrawal" class="btn-comm btn-bl t-w w10p max-w-5"><a href="notice.php">목록</a></button>
                </div> -->

            </div>
        </div>
</section>

<?php include "./includes/footer.php"; ?>