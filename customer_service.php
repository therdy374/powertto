<?php
$page_title = "Customer Service";
require "./includes/menubar.php";
?>
<style>
    body {
        overflow-x: hidden;
    }

    .container .header h2 {
        padding: 20px;
        margin-top: 20px;
    }

    .inner-contents {
        margin-top: 20px;
    }

    .btn-cart .a .cancel {
        background-color: green;
    }

    .btn-cart .btn-cust {
        background-color: #f42c6c;
        display: inline-block;
        padding: 13px 20px;
        text-decoration: none;
        color: #fff;
        margin-top: -5px;
    }

    .btn-cart .cancel:hover {
        background-color: darkgray;
        /* Change background color on hover */
    }


    .btn-cart .a .cancel {
        background-color: green;
    }

    .btn-cart .cancel {
        background-color: gray;

        display: inline-block;

        padding: 11px 20px;

        text-decoration: none;

        color: #fff;

    }

    .btn-cart .cancel:hover {
        background-color: darkgray;
        /* Change background color on hover */
    }


    /* Adjustments for smaller screens */
    @media screen and (max-width: 600px) {
        .table-col col {
            width: auto !important;
        }

        .table-col th,
        .table-col td {
            display: block;
            width: 100%;
            padding: 10px 0;
        }

        .btn-comm {
            width: 100%;
            margin: auto;
        }

        .cancel {
            margin: auto;
        }

        .container .header h2 {
            font-size: 25px;
            margin-top: 50px;
        }

        .content-tit {
            font-size: 18px;
            text-align: center;
        }
    }
</style>
<section class="container">
    <h1 class="content-tit visual05"><span>고객센터</span></h1>
    <div class="header">
        <h2>1:1 문의 하기</h2>
        <div class="navi">
            <a href="home.php">홈으로</a>
            <span>고객센터</span>
            <span>1:1 문의 하기</span>
        </div>
    </div>
    <div class="contents">
        <ul class="depth2-menu menu-item-9">
            <li class="item select"><a href="cust_details_req.php">1:1 문의 하기</a></li>
        </ul>

        <div class="inner-contents">
            <?php
            include "./includes/connect.php";
            if (isset($_POST['cust_req'])) {
                date_default_timezone_set('Asia/Seoul');
                $currentDateTime = date('Y-m-d H:i:s');
                $name = $_POST['name'];
                $user_id = $_POST['user_id'];
                $title = $_POST['title'];
                $status = $_POST['status'];
                $message = $_POST['message'];

                $user_request = $_POST['user_request'];

                $query = "INSERT INTO `customer_service` (name, user_id, message, title, status, user_request, date_message) VALUES ('$name', '$user_id', '$message', '$title', '$status', '$user_request', '$currentDateTime')";
                $res = mysqli_query($conn, $query);
                if ($query) {
                    echo "<script>alert('귀하의 요청은 현재 보류 중이며 승인을 요청합니다..\\n확인을 기다려주세요 감사합니다.')</script>";
                    echo ("<script>location.href='cust_details_req.php'</script>");
                } else {
                    echo "<script>alert('Unknown error occurred.')</script>";
                }
            }
            ?>
            <form action="" method="POST">
                <input type="hidden" name="user_id" value="<?= $_SESSION['loggedInUser']['user_id']; ?>" placeholder="비밀번호"><br>
                <input type="hidden" name="name" value="<?= $_SESSION['loggedInUser']['name']; ?>" placeholder="아이디"><br>
                <input type="hidden" name="status" value="답변대기"><br>

                <input type="hidden" name="user_request" value="[입금계좌문의]"><br>
                <div>
                    <table cellpadding="0" cellspacing="0" class="table-col">
                        <colgroup>
                            <col style="width:200px" class="mw80" />
                            <col style="width:1000px" />
                        </colgroup>
                        <tbody>
                            <tr>
                                <th><em>※</em> 제목</th>
                                <td class="m-flex">
                                    <input type="text" name="title" style="width: 100%;" placeholder="제목" required>
                                </td>
                            </tr>
                            <tr>
                                <th><em>※</em> 내용</th>
                                <td>
                                    <div>
                                        <textarea name="message" rows="4" style="width: 100%;" placeholder="Enter your message" required></textarea>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="btn-cart mt30 al-center">
                        <button type="submit" name="cust_req" class="btn-cust">글쓰기</button>
                        <a href="cust_details_req.php" class="cancel">취소</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?php include "./includes/footer.php"; ?>