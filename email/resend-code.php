<?php
require '../config/dbcon.php';
require '../config/function.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader

function resend_email_verify($name, $email, $verify_token)
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


    $mail->setFrom('therd07@gmail.com', 'Therdy');
    $mail->addAddress($email);


    $mail->isHTML(true);
    $mail->Subject = 'Resend - Email Verification from POS';

    $email_template = "
        <h2>You have Registered with POS</h2>
        <h5>Verify your email address to Login with the below given link</h5>
        <br/><br/>
        <a href='http://localhost/POS2/email/verify-email.php?token=$verify_token'> Click Me </a>
    ";

    $mail->Body = $email_template;
    $mail->send();
    // echo 'Message has been sent';
}

if (isset($_POST['resend_btn'])) {
    if (!empty(trim($_POST['email']))) {
        $email = validate($_POST['email']);

        $checkemail_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";

        $checkemail_query_run = mysqli_query($conn, $checkemail_query);

        if (mysqli_num_rows($checkemail_query_run) > 0) {

            $row = mysqli_fetch_array($checkemail_query_run);
            if ($row['verify_status'] == "0") {

                $name = $row['name'];
                $email = $row['email'];
                $verify_token = $row['verify_token'];

                resend_email_verify($email, $email, $verify_token);
                redirect('login.php', 'Verification Email Link is send it to your email address. Please check your email!');
                exit(0);

            } else {
                redirect('resend-email.php', 'Email Already verified. Please Login!');
                exit(0);
            }
        } else {
            redirect('resend-email.php', 'Email is not registered! Please <a href="register.php">Register Now!</a>');
            exit(0);
        }
    } else {
        redirect('resend-email.php', ' Please enter the email field!');
        exit(0);
    }
}
