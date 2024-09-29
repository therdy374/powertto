<?php
// require './config/dbcon.php';
require './config/function.php';

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader

// function sendemail_verify($name, $combine_email, $verify_token)
// {
//     require './vendor/autoload.php';
//     require("vendor/phpmailer/phpmailer/src/PHPMailer.php");
//     require("vendor/phpmailer/phpmailer/src/SMTP.php");
//     require("vendor/phpmailer/phpmailer/src/Exception.php");

//     $mail = new PHPMailer(true);

//     $mail->isSMTP();
//     $mail->SMTPAuth   = true;

//     $mail->Host       = 'smtp.gmail.com';
//     $mail->Username   = 'therd07@gmail.com';
//     $mail->Password   = 'tfty ecwm entx rrqo';

//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//     $mail->Port       = 587;


//     $mail->setFrom('therd07@gmail.com', 'Therdy');
//     $mail->addAddress($combine_email);


//     $mail->isHTML(true);
//     $mail->Subject = 'Email Verification from LOTTO CAMP';

//     $email_template = "
//         <h2>You have Registered in LOTTO CAMP</h2>
//         <h5>Verify your email address to Login with the below given link</h5>
//         <br/><br/>
//         <a href='http://localhost/samplesave/ver_02/verify-email.php?token=$verify_token'> Click Me </a>
//     ";

//     $mail->Body = $email_template;
//     $mail->send();
// }



if (isset($_POST['uname'])) {

    $minLength = 4;
    $maxLength = 13;

    $userid = $_POST['userid'];

    $check_userid = "SELECT * FROM users WHERE userid = '$userid'";
    $check_result = mysqli_query($conn, $check_userid);


    if (empty($userid)) {
        $_SESSION['status'] = "모든 필드에 입력해 주세요.";
        header("Location: join_02.php");
        exit();
    }

    if (strlen($userid) < $minLength || strlen($userid) > $maxLength || is_numeric($userid)) {

        $_SESSION['status'] = "아이디는 영문,숫자 4자 이상가능합니다.\\n 숫자만은 불가합니다.";
        header("Location: join_02.php");
        exit();
    }

    $koreanPattern = '/[\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}]/u'; // Hangul syllables and Hangul Jamo

    // Check if the input contains Korean characters
    if (preg_match($koreanPattern, $userid)) {
        $_SESSION['status'] = "아이디는 영문,숫자 4자 이상가능합니다.\\n 숫자만은 불가합니다.";
        header("Location: join_02.php");
        exit();
    }

    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['status'] = "이미 사용중인 아이디입니다.";
    } else {
        $_SESSION['status'] = "사용 가능한 아이디입니다.";
    }


    $userid_value = htmlspecialchars($userid);


    header("Location: join_02.php?userid=$userid_value");
    exit;
}

// Check if userid is set in URL to retain its value
$userid_value = isset($_GET['userid']) ? $_GET['userid'] : '';

if (isset($_POST['register_btn'])) {

    $userid = validate($_POST['userid']);
    $password = validate($_POST['password']);
    $con_password = validate($_POST['con_password']);

    $name = validate($_POST['name']);
    $bod = validate($_POST['bod']);
    // $email = validate($_POST['email']);

    $phone1 = validate($_POST['phone1']);
    $phone2 = validate($_POST['phone2']);
    $phone3 = validate($_POST['phone3']);

    $combine_phone = $phone1 . '' . $phone2 . '' . $phone3 . '';

    $bank = validate($_POST['bank_name']);
    $acct_number = validate($_POST['bank_acct_num']);

    $referal_code = validate($_POST['referal_code']);
    $affiliated_agent_code = validate($_POST['affiliated_agent_code']);

    $verify_token = md5(rand());
    $verify_status = 0;
    $is_ban = 0;


    if (empty($userid) || empty($password) || empty($con_password) || empty($name) || empty($bod) || empty($phone1) || empty($phone2) || empty($phone3) || empty($bank) || empty($acct_number)) {
        $_SESSION['status'] = "모든 필드에 입력해 주세요.";
        header("Location: join_02.php");
        exit(); // Exit to prevent further execution
    }

    $koreanPattern = '/[\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}]/u'; // Hangul syllables and Hangul Jamo

    // Check if the input contains Korean characters
    if (preg_match($koreanPattern, $userid)) {
        $_SESSION['status'] = "아이디는 영문,숫자 4자 이상가능합니다.\\n 숫자만은 불가합니다.";
        header("Location: join_02.php");
        exit();
    }


    if ($password == $con_password) {
        $minLength = 4;
        $maxLength = 13;

        if (strlen($userid) < $minLength || strlen($userid) > $maxLength || is_numeric($userid)) {

            $_SESSION['status'] = "아이디는 영문,숫자 4자 이상가능합니다.\\n 숫자만은 불가합니다.";
            header("Location: join_02.php");
            exit();
        } else {

            // Referal Code
            if ($_POST['referal_code'] != '') {

                $check_query = "SELECT * FROM `admins` where `referal_code`='$_POST[referal_code]'";
                $result_query = mysqli_query($conn, $check_query);

                if ($result_query) {
                    if (mysqli_num_rows($result_query) == 1) {

                        $result_fetch = mysqli_fetch_assoc($result_query);
                        $point = $result_fetch['referal_points'] + 10;
                        $udpate_query =  "UPDATE `admins` SET `referal_points`='$point' WHERE `username`='$result_fetch[username]'";

                        if (!mysqli_query($conn, $udpate_query)) {
                            echo "<script>
                            alert('cannot run query');
                            window.location.href='login.php'
                            </script>";
                            exit;
                        }
                    } else {
                        echo "<script>
                        alert('invalid referal');
                        window.location.href='join_02.php';
                        </script>";
                        exit;
                    }
                } else {
                    echo "<script>
                    alert('Something went wrong');
                    window.location.href='login.php';
                    </script>";
                     exit;
                }
            }

            $check_userid = "SELECT * FROM users WHERE userid = '$userid'";
            $check_result = mysqli_query($conn, $check_userid);

            if (mysqli_num_rows($check_result) > 0) {

                $_SESSION['status'] = "이미 사용중인 아이디입니다.";
                header("Location: join_02.php");
            } else {

                $bycrypt_password = password_hash($password, PASSWORD_BCRYPT);

                $query = "INSERT INTO users (name, phone, userid, bod, email, password, referal_code, affiliated_agent_code, verify_token, verify_status, is_ban, bank_name, bank_acct_num) 
                        VALUES ('$name','$combine_phone','$userid','$bod', '$email', '$bycrypt_password', '$referal_code', '$affiliated_agent_code', '$verify_token', '$verify_status','$is_ban','$bank','$acct_number')";

                $query_run = mysqli_query($conn, $query);

                if ($query_run) {
                    // sendemail_verify("$name", "$combine_email", "$verify_token");

                    $_SESSION['status'] = "등록완료! 가입 심사 중입니다 승인 완료 후 로그인할 수 있습니다.";
                    header("Location: login.php");
                } else {
                    $_SESSION['status'] = "Registration failed";
                    header("Location: join_02.php");
                }
            }
        }
    } else {
        $_SESSION['status'] = "암호가 일치하지 않습니다! ss ";
        header("Location: join_02.php");
    }
}
