<?php
require '../config/dbcon.php';
require '../config/function.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader

function send_password_reset($get_name, $get_email, $token)
{
    require './vendor/autoload.php';
    require("vendor/phpmailer/phpmailer/src/PHPMailer.php");
    require("vendor/phpmailer/phpmailer/src/SMTP.php");
    require("vendor/phpmailer/phpmailer/src/Exception.php");

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->SMTPAuth   = true;

    $mail->Host       = 'smtp.gmail.com';
    $mail->Username   = 'therd07@gmail.com';
    $mail->Password   = 'tfty ecwm entx rrqo';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;


    $mail->setFrom('therd07@gmail.com', $get_name);
    $mail->addAddress($get_email);


    $mail->isHTML(true);
    $mail->Subject = 'Reset Password Notification';

    $email_template = "
        <h2>Hi</h2>
        <h5>You are received this email because we received a password reset from your account</h5>
        <br/><br/>
        <a href='http://localhost/POS2/email/password-change.php?token=$token&email=$get_email'> Click Me </a>
    ";

    $mail->Body = $email_template;
    $mail->send();
    // echo 'Message has been sent';
}

if (isset($_POST['reset_btn'])) {

    if (!empty(trim($_POST['email']))) {

        $email = validate($_POST['email']);
        $token = md5(rand());

        $check_email =  "SELECT email FROM users WHERE email = '$email' LIMIT 1";
        $checkemail_run = mysqli_query($conn, $check_email);

        if (mysqli_num_rows($checkemail_run) > 0) {
            $row = mysqli_fetch_array($checkemail_run);
            $get_name = $row['name'];
            $get_email = $row['email'];

            $update_token = "UPDATE users SET verify_token = '$token' WHERE email = '$get_email' LIMIT 1";

            $update_token_run = mysqli_query($conn, $update_token);

            if ($update_token_run) {
                send_password_reset($get_name, $get_email, $token);
                redirect('reset-password.php', 'We e-emailed you a password reset! Please check your email');
                exit(0);
            } else {
                redirect('reset-password.php', 'Something went wrong!');
                exit(0);
            }
        } else {
            redirect('reset-password.php', 'Your email is not valid!');
            exit(0);
        }
    } else {
        redirect('reset-password.php', ' Please enter the email field!');
        exit(0);
    }
}


if (isset($_POST['password_update'])) {

    $email = validate($_POST['email']);
    $new_password = validate($_POST['new_password']);
    $confirm_password = validate($_POST['confirm_password']);
    $token = validate($_POST['password_token']);


    if (!empty($token)) {

        if (!empty($email) && !empty($new_password) && !empty($confirm_password)) {
            // check tokem is valid or not
            $check_token = "SELECT verify_token FROM users WHERE verify_token = '$token' LIMIT 1";

            $check_token_run = mysqli_query($conn, $check_token);

            if (mysqli_num_rows($check_token_run) > 0) {


                $bycrypt_password = password_hash($new_password, PASSWORD_BCRYPT);
                
                
                if ($new_password == $confirm_password) {

                    $update_password = "UPDATE users SET password = '$bycrypt_password' WHERE verify_token = '$token' LIMIT 1";
                    $update_password_run = mysqli_query($conn, $update_password);

                    if ($update_password_run) {
                        $_SESSION['status'] = "New Password updated successfully! You can now login!";
                        header("Location: login.php");
                        exit(0);
                    } else {
                        $_SESSION['status'] = "Did not update!";
                        header("Location: password-change.php?token=$token&email=$email");
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "Password and confirm password does not match!";
                    header("Location: password-change.php?token=$token&email=$email");
                    exit(0);
                }

            } else {
                $_SESSION['status'] = "Invalid Token";
                header("Location: password-change.php?token=$token&email=$email");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "All fields are Mandatory";
            header("Location: password-change.php?token=$token&email=$email");
            exit(0);
        }
    } else {
        redirect('password-change.php', 'No Token Available!');
        exit(0);
    }
}
