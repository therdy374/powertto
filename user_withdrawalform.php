<?php
$page_title = "Withdrawal";

require "./includes/menubar.php";
?>
<style>
    .btn-comm {
        display: inline-flex;
        height: 50px;
        padding: 0 15px;
        font-size: 16px;
        align-items: center;
        justify-content: center;
        text-align: center;
        box-sizing: border-box;
        cursor: pointer;
        line-height: 1em;
        border-radius: 10px;
    }

    @media screen and (max-width: 768px) {
        .btn-comm {
            width: 100%;
            margin: auto;
        }

        .table-col th {
            font-size: 15px;
            padding: 5px;
            letter-spacing: -0.05em;
            width: 50px;
            white-space: nowrap;
        }
        .container .header h2 {
            font-size: 25px;
            margin-top: 30px;
        }

    }
</style>

<section class="container">
    <h1 class="content-tit visual04"><span>출금신청</span></h1>
    <div class="header">
        <h2>출금신청</h2>
        <div class="btn-w">
            <a href="withdrawalform.php">출금신청</a>
        </div>
        <div class="navi">
            <a href="home.php">홈으로</a>
            <span>출금신청</span>
            <span>출금신청</span>
        </div>
    </div>
    <div class="contents">
        <ul class="depth2-menu">
            <li class="item select"><a href="withdrawal_details.php">입금내역확인</a></li>
        </ul>
        <div class="inner-contents">

            <div class="message-box-gy mt40">
                <h4 class="tit-h4 mb10">입금방법</h4>
                <div class="mt10 ml20">
                    <div class="dot-item">
                        1. 상담 가능시간 : 09:00 ~ 20:00.<br>
                        입금 가능시간 : 24시간<br>
                        <em class="t-red">출금 가능시간 : 10:00 ~ 19:00(주중).</em><br>
                        휴무시간 : 토요일 05:00 ~ 월요일 09:00
                    </div>
                    <div class="dot-item">
                        2. 10분 이상 입금이 지연될 경우에는 회원님의 입금계좌정보를 잘못 기입한 경우가 많습니다.<br>

                    </div>
                    <div class="dot-item">
                        3. 다른 계좌로 출금하시려면 고객센터로 문의해주세요.
                    </div>
                </div>
            </div>


            <?php
            include "./includes/connect.php";
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d H:i:s');

            $user_id = $_SESSION['loggedInUser']['user_id'];

            $sql = "SELECT * FROM users WHERE id = '$user_id'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $users_credit = $row['credit'];
                }
            } else {
                echo "0 results";
                exit;
            }

            if (isset($_POST['req_withdrawal'])) {
                $userid = $_POST['userid'];
                $user_id = $_POST['user_id'];
                $bank_name = $_POST['bank_name'];
                $bank_acct_num = $_POST['bank_acct_num'];
                $name = $_POST['name'];
                $amount_withdrawal = $_POST['amount_withdrawal'];
                $status = $_POST['status'];
                $referal_code = $_POST['referal_code'];

                $amount_withdrawal = preg_replace('/[^\d.]/', '', $amount_withdrawal);
                $credit_balance = $users_credit - $amount_withdrawal; // Deduct withdrawal amount from user's credit balance

                $query = "INSERT INTO `user_request_withdrawal` (`referal_code`,`userid`, `name`, `user_id`, `amount_withdrawal`, `credit_balance`, `bank_name`, `bank_acct_num`, `status`, `date_withdrawal`) 
                            VALUES ('$referal_code','$userid', '$name', '$user_id','$amount_withdrawal', '$credit_balance', '$bank_name', '$bank_acct_num', '$status','$currentDateTime')";
                $res = mysqli_query($conn, $query);

                if ($res) {
                    $query2 = "INSERT INTO `user_withdrawal_request` (`referal_code`,`userid`, `name`, `user_id`, `amount_withdrawal`, `credit_balance`, `bank_name`, `bank_acct_num`, `status`,`date_withdrawal`)
                    VALUES ('$referal_code','$userid', '$name', '$user_id','$amount_withdrawal', '$credit_balance', '$bank_name', '$bank_acct_num', '$status','$currentDateTime')";
                    $res2 = mysqli_query($conn, $query2);

                    // Update user credit balance
                    $sql2 = "UPDATE `users` SET `credit` = '$credit_balance' WHERE `id` = '$user_id'";
                    $res_query = mysqli_query($conn, $sql2);

                    if ($res_query) {
                        echo "<script>alert('귀하의 요청은 접수되었습니다 승인을 요청합니다.\\n확인을 기다려주세요 감사합니다.')</script>";
                        echo ("<script>location.href='withdrawal_details.php'</script>");
                    } else {
                        echo "<script>alert('Unknown error occurred while updating user balance.')</script>";
                    }
                } else {
                    echo "<script>alert('Unknown error occurred while processing your request.')</script>";
                }
            }
            ?>


            <form action="" method="POST">
                <input type="hidden" name="user_id" value="<?= $_SESSION['loggedInUser']['user_id']; ?>" placeholder="비밀번호"><br>

                <input type="hidden" name="bank_name" value="<?= $_SESSION['loggedInUser']['bank_name']; ?>">

                <input type="hidden" name="bank_acct_num" value="<?= $_SESSION['loggedInUser']['bank_acct_num']; ?>">

                <input type="hidden" name="name" value="<?= $_SESSION['loggedInUser']['name']; ?>">

                <input type="text" name="referal_code" value="<?= $_SESSION['loggedInUser']['referal_code']; ?>">
       

                <input type="hidden" name="status" value="답변대기"><br>


                <div>
                    <table cellpadding="0" cellspacing="0" class="table-col">
                        <colgroup>
                            <col style="width:200px" class="mw80" />
                            <col style="width:auto" />
                        </colgroup>
                        <tbody>
                            <tr>
                                <th class="w10p"><em>※</em> 거래은행</th>
                                <td>
                                    <input type="text" name="bank_name" class="w250 mw100p" value="<?= $_SESSION['loggedInUser']['bank_name']; ?>" placeholder="금액입력" readonly />
                                </td>
                                <th class="w10p"><em>※</em> 계좌번호</th>
                                <td>
                                    <input type="text" name="bank_acct_num" class="w250 mw100p" value="<?= $_SESSION['loggedInUser']['bank_acct_num']; ?>" placeholder="금액입력" readonly />
                                </td>
                            </tr>
                            <tr>
                                <th class="w10p"><em>※</em> 예금주</th>
                                <td>
                                    <input type="text" name="userid" class="w250 mw100p" value="<?= $_SESSION['loggedInUser']['userid']; ?>" placeholder="금액입력" readonly />
                                </td>
                                <th class="w10p"><em>※</em> 출금금액</th>
                                <td>
                                    <input type="text" name="amount_withdrawal" class="w250 mw100p" placeholder="원" oninput="formatNumber(this)" required />
                                </td>
                            </tr>

                            <tr>
                                <th><em>※</em> 보유금액</th>
                                <td>
                                    <input type="text" name="credit_balance" class="w250 mw100p" value="<?php echo number_format($users_credit); ?>" placeholder="금액입력" readonly />
                                </td>

                            </tr>

                        </tbody>
                    </table>

                    <div class="btn-cart mt50 al-center ">
                        <button type="submit" name="req_withdrawal" class="btn-comm btn-dpk ">출금신청</button>
                    </div>



            </form>

            <script>
                function formatNumber(input) {

                    let value = input.value.replace(/\D/g, '');
                    let formattedValue = Number(value).toLocaleString();

                    input.value = formattedValue;
                }
            </script>


        </div>
    </div>
</section>

<?php include "./includes/footer.php"; ?>