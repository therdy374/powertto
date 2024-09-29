<?php
$page_title = "Deposit Form";

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
            font-size: 14px;
            padding: 10px;
            letter-spacing: -0.05em;
            white-space: nowrap;
            margin: auto;
        }
        .container .header h2 {
            font-size: 25px;
            margin-top: 30px;
        }

    }
</style>

<section class="container">
    <h1 class="content-tit visual04"><span>입금신청</span></h1>
    <div class="header">
        <h2>입금신청</h2>
        <div class="btn-w">
            <a href="depositform.php">입금신청</a>
        </div>
        <div class="navi">
            <a href="user_depositform.php">홈으로</a>
            <span>입금신청</span>
            <!-- <span>입금신청</span> -->
        </div>
    </div>
    <div class="contents">
        <ul class="depth2-menu">
            <li class="item select"><a href="deposit_details.php">입금내역확인</a></li>

        </ul>
        <div class="inner-contents">

            <div class="message-box-gy mt40">
                <h4 class="tit-h4 mb10">입금방법</h4>
                <div class="mt10 ml20">
                    <div class="dot-item">
                        1. 입금하실 때에는 인터넷뱅킹, 폰뱅킹, 무통장 입금, ATM이체 등의 방법을 이용하여 입금이 가능 합니다.<br>
                        <em class="t-red">아래의 입금 계좌는 수시로 변경될 수 있습니다. 입금하시기 전에 다시한번 입금계좌 확인을 해주시기 바랍니다.</em>
                    </div>
                    <div class="dot-item">
                        2. 입금자 이름 란에는 송금하시는 통장의 입금주(통장명의자) 성함을 넣어주셔야 하며,<br>
                        <em class="t-red">회원정보 예금주와 다른 이름을 넣으실 경우 입금확인이 불가하여 입금이 되지 않거나 지연될 수 있습니다.</em>
                    </div>
                    <div class="dot-item">
                        3. 입금신청 버튼을 클릭하시면 신청이 완료 됩니다.
                    </div>
                </div>
            </div>

            <div class="message-box-gy mt40">
                <h4 class="tit-h4 mb10">주의사항</h4>
                <div class="mt10 ml20">
                    <div class="dot-item">
                        1. 입금하시기 전에 항상 계좌확인을 부탁드리며, 계좌확인을 안하시면 입금신청을 하실 수 없습니다.<br>
                    </div>
                    <div class="dot-item">
                        2. <em class="t-red">입금 전 입금신청은 취소처리됩니다.</em>
                    </div>
                    <div class="dot-item">
                        3. 입금자명(입금통장명의자) / 입금신청금액 / 실제입금금액이 일치하시면 입금 후 빠르게 처리가됩니다.
                    </div>
                    <div class="dot-item">
                        4. 입금신청은 신청하신 내용이 완료되지 않거나 삭제(취소)되지 않은 상태에서는 중복신청 또는 추가신청이 불가 합니다.<br>
                    </div>
                    <div class="dot-item">
                        5. 수표입금 시 입금 처리가 되지 않습니다.
                    </div>
                    <div class="dot-item">
                        6. 입금 완료 5분 내에 추가 신청할 수 없습니다..
                    </div>
                </div>
            </div>

            <?php
            include "./includes/connect.php";
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d H:i:s');

            if (isset($_POST['dep_inquiry'])) {
                $name = $_POST['name'];
                $user_id = $_POST['user_id'];
                $message = $_POST['message'];
                $message1 = $_POST['message1'];
                $status = $_POST['status'];
                $userid = $_POST['userid'];
                $referal_code = $_POST['referal_code'];


                $query3 = "INSERT INTO `customer_service` (`name`, `referal_code`, `user_id`, `message`, `title`, `status`,`date_message`,`userid`) VALUES ('$name', '$referal_code', '$user_id','$message1','계좌문의','$status','$currentDateTime','$userid')";
                $res3 = mysqli_query($conn, $query3);

                if ($query) {
                    echo "<script>alert('귀하의 요청은 현재 보류 중이며 승인을 요청합니다.\\n확인을 기다려주세요 감사합니다.')</script>";
                    echo ("<script>location.href='cust_details_req.php'</script>");
                } else {
                    echo "<script>alert('Unknown error occured.')</script>";
                }
            }

            if (isset($_POST['dep_req'])) {
                $name = $_POST['name'];
                $user_id = $_POST['user_id'];
                $message = $_POST['message'];
                $status = $_POST['status'];
                $user_request = $_POST['title'];
                $userid = $_POST['userid'];
                $referal_code = $_POST['referal_code'];
                // $message = "$user_id $name " . $_POST['message'];

                if ($message == '') {
                    echo "<script>alert('Please enter your request.')</script>";
                } else {
                    $query = "INSERT INTO `users_request_deposit` (`name`, `referal_code`, `user_id`, `message`, `status`, `date_message`,`userid`) VALUES ('$name', '$referal_code', '$user_id','$message', '$status', '$currentDateTime','$userid')";
                    $res = mysqli_query($conn, $query);

                    $query2 = "INSERT INTO `users_request` (`name`, `referal_code`, `user_id`, `message`, `status`, `date_message`,`userid`) VALUES ('$name', '$referal_code', '$user_id','$message', '$status', '$currentDateTime','$userid')";
                    $res2 = mysqli_query($conn, $query2);


                    $query3 = "INSERT INTO `customer_service` (`name`, `referal_code`, `user_id`, `message`, `title`, `status`,`date_message`,`userid`) VALUES ('$name', '$referal_code', '$user_id','$message','$user_request','$status','$currentDateTime','$userid')";
                    $res3 = mysqli_query($conn, $query3);

                    if ($res && $res2 && $res3) {
                        echo "<script>alert('귀하의 요청은 현재 보류 중이며 승인을 요청합니다.\\n확인을 기다려주세요 감사합니다.')</script>";
                        echo ("<script>location.href='cust_details_req.php'</script>");
                    } else {
                        echo "<script>alert('Unknown error occurred ok.')</script>";
                    }
                }
            }
            ?>

            <form action="" method="POST">
                <input type="hidden" name="user_id" value="<?= $_SESSION['loggedInUser']['user_id']; ?>" placeholder="비밀번호"><br>
                <input type="hidden" name="name" value="<?= $_SESSION['loggedInUser']['name']; ?>" placeholder="아이디"><br>
                <input type="hidden" name="userid" value="<?= $_SESSION['loggedInUser']['userid']; ?>" placeholder="아이디"><br>
                <input type="text" name="referal_code" value="<?= $_SESSION['loggedInUser']['referal_code']; ?>" placeholder="아이디"><br>

                <input type="hidden" name="status" value="답변대기"><br>

                <input type="hidden" name="title" value="입금신청"><br>

                <input type="hidden" name="message1" value="입금계좌를 알려주시기 바랍니다." />
                <div>
                    <table cellpadding="0" cellspacing="0" class="table-col">
                        <colgroup>
                            <col style="width:200px" class="mw80" />
                            <col style="width:auto" />
                        </colgroup>
                        <tbody>
                            <tr>
                                <th><em>※</em> 입금계좌정보</th>
                                <td class="m-flex">
                                    <button type="submit" name="dep_inquiry" class="btn-comm btn-re w10p max-w-5">계좌문의</button>
                                    <button type="submit" name="dep_inquiry2" class="btn-comm btn-r  w10p max-w-5"><a href="cust_details_req.php">고객센터</a></button>
                                </td>
                            </tr>
                            <tr>
                                <th><em>※</em> 입금금액</th>
                                <td>
                                    <!-- <input type="number" name="message" class="w250 mw100p" placeholder="금액입력" /> -->
                                    <input type="text" name="message" class="w250 mw100p" placeholder="금액입력" oninput="formatNumber(this)" />
                                    <span class="form-sub-desc-r ml10">
                                        ※ 예금주(보내시는분)
                                    </span>
                                    <span><?= $_SESSION['loggedInUser']['name']; ?><span>
                                </td>
                            </tr>
                            <script>
                                function formatNumber(input) {

                                    let value = input.value.replace(/\D/g, '');
                                    let formattedValue = Number(value).toLocaleString();

                                    input.value = formattedValue;
                                }
                            </script>


                        </tbody>
                    </table>

                    <div class="btn-cart mt50 al-center ">
                        <button type="submit" name="dep_req" class="btn-comm btn-dpk ">입금신청</button>
                    </div>

            </form>


        </div>
    </div>
</section>

<?php include "./includes/footer.php"; ?>