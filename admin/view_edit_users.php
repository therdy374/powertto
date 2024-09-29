<?php
include "./inc/connect.php";

if (isset($_GET['view_edit_users'])) {

    $user_id = $_GET['view_edit_users'];
    echo $user_id;
    
    $select_query = "SELECT u.id, u.name, u.phone, u.userid, u.password, u.bod, u.credit, u.bank_name, u.bank_acct_num, u.verify_token, u.verify_status, u.is_ban, u.memo, u.referal_code, u.created_at, 
    COALESCE(SUM(d.amount_deposit), 0) AS total_deposit,
    COALESCE(SUM(w.amount_withdrawal), 0) AS total_withdrawal,
    ll.ip_address AS ip,
    ll.device_use AS device,
    ll.date_logs AS date
    FROM users u 
    LEFT JOIN (SELECT user_id, SUM(amount_deposit) AS amount_deposit FROM deposit_mgt GROUP BY user_id) d ON u.id = d.user_id
    LEFT JOIN (SELECT user_id, SUM(amount_withdrawal) AS amount_withdrawal FROM users_withdrawal GROUP BY user_id) w ON u.id = w.user_id
    LEFT JOIN login_logs ll ON u.id = ll.user_id
    WHERE u.id = $user_id
    GROUP BY u.id, u.name, u.phone, u.userid, u.password, u.bod, u.credit, u.bank_name, u.bank_acct_num, u.verify_token, u.verify_status, u.is_ban, u.created_at, ll.ip_address, ll.device_use, ll.date_logs
    ORDER BY u.created_at";

    $result_query = mysqli_query($conn, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);

    $name = $row_fetch['name'];
    $userid = $row_fetch['userid'];
    $password = $row_fetch['password'];
    $phone = $row_fetch['phone'];
    $bod = $row_fetch['bod'];
    $credit = $row_fetch['credit'];
    $bank_name = $row_fetch['bank_name'];
    $bank_acct_num = $row_fetch['bank_acct_num'];

    $created_at = date('Y.m.d (D)', strtotime($row_fetch['created_at']));

    $verify_token = $row_fetch['verify_token'];
    $verify_status = $row_fetch['verify_status'];
    $is_ban = isset($row_fetch['is_ban']) == true ? 1 : 0;

    $total_deposit = $row_fetch['total_deposit'];
    $total_withdrawal = $row_fetch['total_withdrawal'];

    $ip = $row_fetch['ip'];
    $device = $row_fetch['device'];
    $date = $row_fetch['date'];

    $memo = $row_fetch['memo'];
    $referal_code = $row_fetch['referal_code'];

    $calculated_amount = $total_deposit - $total_withdrawal;

    $num = 0;
    if (isset($_POST['user_updated'])) {
        $name = $_POST['name'];
        $userid = $_POST['userid'];
        $new_password = $_POST['password']; // New password input
        $phone = $_POST['phone'];
        $bod = $_POST['bod'];
        $verify_status = $_POST['verify_status'];
        $verify_token = md5(rand());
        $is_ban = isset($_POST['is_ban']) ? 0 : 1; // Simplified the condition

        $memo = $_POST['memo'];
        $bank_name = $_POST['bank_name'];
        // $user_id = $_POST['user_id']; 

        if ($name == '' || $userid == '' || $phone == '' || $verify_status == '') {
            echo "<script>alert('Please fill all the required fields')</script>";
        } else {
            // Removed unnecessary password update check
            if (!empty($new_password)) {
                $bycrypt_password = password_hash($new_password, PASSWORD_BCRYPT);
                $password_update = " `password`='$bycrypt_password', ";
            } else {
                $password_update = "";
            }

            // Corrected SQL query by removing quotes around $password_update variable
            $user_update = "UPDATE `users` SET `name`='$name', `userid`='$userid', `bod`='$bod', `bank_name`='$bank_name', $password_update `phone`='$phone', `verify_status`='$verify_status', `verify_token`='$verify_token', `is_ban`='$is_ban', `memo`='$memo' WHERE `id`='$user_id'";

            $result_query_update = mysqli_query($conn, $user_update);

            if ($result_query_update) {
                echo "<script>alert('Data updated successfully!')</script>";
                echo "<script>window.open('index.php?view_users','_self')</script>";
            } else {
                echo "<script>alert('Oops! Something went wrong!')</script>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>

    <!-- Summernote CSS - CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        .note-editor.note-airframe .note-editing-area .note-editable,
        .note-editor.note-frame .note-editing-area .note-editable {
            padding: 10px;
            overflow: auto;
            word-wrap: break-word;
            color: black;
            background: white;
        }
    </style>

</head>

<body>
    <div class="col-md-12 col-xl-12">
        <div class="bg-secondary rounded h-100 p-4">

            <div>
                <h6 class="mb-4 text-primary">사용자 계정 업데이트
                    <a href="index.php?view_users" class="btn btn-primary btn-sm float-end">Back</a>
                </h6>
            </div>

            <h6>회원정보/사이트명: <span class="text-primary"><?php echo $name; ?></span> / 가입일: <span class="text-primary"><?php echo $created_at; ?></span></h6>

            <form action="" method="POST" class="mb-2">
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo $user_id; ?>" class="form-control" />


                    <div class="col-md-4 mb-3">
                        <label for="">핸드폰 *</label>
                        <input type="text" name="phone" value="<?php echo $phone; ?>" class="form-control" />
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="">사용자ID *</label>
                        <input type="text" name="userid" value="<?php echo $userid; ?>" class="form-control" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">구성원 상태 (checked=Active, UnChecked=Banned)*</label>
                        <br />
                        <input type="checkbox" name="is_ban" value="" <?php echo $row_fetch['is_ban'] == 0 ? "checked" : "" ?> style="width:20px;height:20px" />
                    </div>


                    <div class="col-md-4 mb-3">
                        <label for="">보유머니 *</label>
                        <input type="text" name="credit" value="<?php echo number_format($credit); ?> ₩" class="form-control" readonly />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="">총 입금/ 총 출금 *</label>
                        <input type="text" name="tot_deposit" value="<?php echo number_format($total_deposit); ?> ₩" class="form-control" readonly />
                        <input type="text" name="tot_withdrawal" value="<?php echo number_format($total_withdrawal); ?> ₩" class="form-control" readonly />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="">계산된 금액 *</label>
                        <input type="text" name="tot_amount" value="<?php echo number_format($calculated_amount); ?> ₩" class="form-control" readonly />
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="">예금주 *</label>
                        <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" />
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="">입금은행*</label>
                        <select name="bank_name" class="form-control">
                            <option value=""> Select Option</option>
                            <option value="농협은행" <?php if ($bank_name == "농협은행") echo " selected"; ?>>농협은행</option>
                            <option value="국민은행" <?php if ($bank_name == "국민은행") echo " selected"; ?>>국민은행</option>
                            <option value="기업은행" <?php if ($bank_name == "기업은행") echo " selected"; ?>>기업은행</option>

                            <option value="하나은행" <?php if ($bank_name == "하나은행") echo " selected"; ?>>하나은행</option>
                            <option value="신한은행" <?php if ($bank_name == "신한은행") echo " selected"; ?>>신한은행</option>
                            <option value="우리은행" <?php if ($bank_name == "우리은행") echo " selected"; ?>>우리은행</option>

                            <option value="상업은행" <?php if ($bank_name == "상업은행") echo " selected"; ?>>상업은행</option>
                            <option value="카카오뱅크" <?php if ($bank_name == "카카오뱅크") echo " selected"; ?>>카카오뱅크</option>
                            <option value="토스뱅크" <?php if ($bank_name == "토스뱅크") echo " selected"; ?>>토스뱅크</option>

                            <option value="저축은행" <?php if ($bank_name == "저축은행") echo " selected"; ?>>저축은행</option>
                            <option value="신협" <?php if ($bank_name == "신협") echo " selected"; ?>>신협</option>
                            <option value="새마을금고" <?php if ($bank_name == "새마을금고") echo " selected"; ?>>새마을금고</option>

                            <option value="우체국" <?php if ($bank_name == "우체국") echo " selected"; ?>>우체국</option>
                            <option value="수협은행" <?php if ($bank_name == "수협은행") echo " selected"; ?>>수협은행</option>
                            <option value="경남은행" <?php if ($bank_name == "경남은행") echo " selected"; ?>>경남은행</option>

                            <option value="부산은행" <?php if ($bank_name == "부산은행") echo " selected"; ?>>부산은행</option>
                            <option value="대구은행" <?php if ($bank_name == "대구은행") echo " selected"; ?>>대구은행</option>
                            <option value="전북은행" <?php if ($bank_name == "전북은행") echo " selected"; ?>>전북은행</option>

                            <option value="광주은행" <?php if ($bank_name == "광주은행") echo " selected"; ?>>광주은행</option>
                            <option value="제주은행" <?php if ($bank_name == "제주은행") echo " selected"; ?>>제주은행</option>
                            <option value="SC제일은행" <?php if ($bank_name == "SC제일은행") echo " selected"; ?>>SC제일은행</option>

                            <option value="한국씨티은행" <?php if ($bank_name == "한국씨티은행") echo " selected"; ?>>한국씨티은행</option>
                            <option value="도이치은행" <?php if ($bank_name == "도이치은행") echo " selected"; ?>>도이치은행</option>
                            <option value="게이뱅크" <?php if ($bank_name == "게이뱅크") echo " selected"; ?>>게이뱅크</option>


                        </select>


                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">계좌번호 *</label>
                        <input type="text" name="bod" value="<?php echo $bank_acct_num; ?>" class="form-control" />
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="">생년월일*</label>
                        <input type="date" id="date-picker" name="bod" value="<?php echo $bod; ?>" class="form-control" />
                    </div>


                    <div class="col-md-6 mb-3">
                        <label for=""> 추천코드/추천인*</label>
                        <input type="text" name="referal_code" value="<?php echo $referal_code; ?>" class="form-control" readonly />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">비밀번호 *</label>
                        <input type="password" name="password" value="" class="form-control" />
                    </div>

                    <!-- <div class="col-md-4 mb-3">
                        <label for=""> 배팅설정*</label>
                        <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                            <option selected="">Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div> -->

                    <!-- <div class="col-md-4 mb-3">
                        <label for="">충전설정 *</label>
                   
                        <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                            <option selected="">Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div> -->

                    <!-- <div class="col-md-4 mb-3">
                        <label for="">환전설정 *</label>
                        <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                            <option selected="">Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div> -->

                    <div class="col-md- mb-3">
                        <label for="">메모 *</label>
                        <textarea name="memo" value="" class="form-control text-primary" id="summernote"><?php echo $memo; ?></textarea>
                    </div>

                </div>

                <center>
                    <input type="submit" value="수정하기" name="user_updated" class="bg-primary border-0 rounded py-2 px-3 text-light">
                    <!-- <input type="submit" value="Just make the button" name="user_updated" class="bg-primary border-0 rounded py-2 px-3 text-light"> -->
                </center><br><br>

                <h6>Member commission settings</h6><br>


                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for=""> Deposit details*</label>
                        <div class="table-responsive my-2">
                            <table class="table table-bordered text-white my-3" style="font-size: small;" id="myTable1">
                                <thead>
                                    <tr>
                                        <th class="text-center">번호</th>
                                        <th class="text-center">입금액</th>
                                        <th class="text-center">신청일시</th>
                                        <th class="text-center">상황.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td><?php echo $user_id; ?> </td>
                                    <td>₩ <?php echo number_format($total_deposit) ?> </td>
                                    <td><?php echo $created_at ?> </td>
                                    <td>Application</td>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="">Withdrawal details *</label>
                        <div class="table-responsive my-2">
                            <table class="table table-bordered text-white my-3" style="font-size: small;" id="myTable1">
                                <thead>
                                    <tr>
                                        <th class="text-center">번호</th>
                                        <th class="text-center">입금액</th>
                                        <th class="text-center">신청일시</th>
                                        <th class="text-center">상황.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td><?php echo $user_id; ?> </td>
                                    <td>₩ <?php echo number_format($total_withdrawal) ?> </td>
                                    <td><?php echo $created_at ?> </td>
                                    <td>Application</td>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="col-md-4 mb-3">
                        <label for="">Login Information *</label>
                        <div class="table-responsive my-2">
                            <table class="table table-bordered text-white my-3" style="font-size: small;" id="myTable1">
                                <thead>
                                    <tr>
                                        <th class="text-center">번호</th>
                                        <th class="text-center">연결</th>
                                        <th class="text-center">기기 사용</th>
                                        <th class="text-center">상황.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td><?php echo $userid ?> </td>
                                    <td><?php echo $ip ?> </td>
                                    <td><?php echo $device ?> </td>
                                    <td><?php echo $date ?></td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="hidden" name="verify_status" value="<?php echo $verify_status; ?>" class="form-control" />
                </div>
            </form>
        </div>
    </div>

    <script>
        // Initialize Flatpickr datetime picker
        flatpickr("#date-picker", {
            enableTime: false,
            dateFormat: "Y-m-d",
        });
    </script>
</body>

</html>