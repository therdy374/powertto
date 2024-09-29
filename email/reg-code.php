<?php
require '../config/dbcon.php';
require '../config/function.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader

function sendemail_verify($name, $combine_email, $verify_token)
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
    $mail->addAddress($combine_email);


    $mail->isHTML(true);
    $mail->Subject = 'Email Verification from POS';

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

if (isset($_POST['register_btn'])) {

    $name = validate($_POST['name']);

    $bod = validate($_POST['bod']);

    $userid1 = validate($_POST['userid1']);
    $userid2 = validate($_POST['userid2']);

    $email1 = validate($_POST['email1']);
    $email2 = validate($_POST['email2']);

    $password = validate($_POST['password']);
    $con_password = validate($_POST['con_password']);

    $phone1 = validate($_POST['phone1']);
    $phone2 = validate($_POST['phone2']);
    $phone3 = validate($_POST['phone3']);

    $combine_email = $email1 . '@' . $email2 . '';

    $combine_userid = $userid1 . '@' . $userid2 . '';

    $combine_phone = $phone1 . '' . $phone2 . '' . $phone3 . '';

    $verify_token = md5(rand());

    if (!empty($name) && !empty($combine_email) && !empty($combine_userid) && !empty($combine_userid) && !empty($bod) && !empty($password) && !empty($combine_phone)) {

        if ($password == $con_password) {

                $check_email = "SELECT * FROM users WHERE email = '$combine_email' || email_userid ='$combine_userid'";

                $check_email_query_run = mysqli_query($conn, $check_email);

                if($combine_email == $combine_userid){

                    if (mysqli_num_rows($check_email_query_run) > 0) {

                        $_SESSION['status'] = "Email already exist";
                        header("Location: register.php");
                        
                    } else {
    
                        $bycrypt_password = password_hash($password, PASSWORD_BCRYPT);
    
                        $query = "INSERT INTO users (name, phone, email, email_userid, bod, password, verify_token) VALUES 
                        ('$name','$combine_phone','$combine_email',' $combine_userid', '$bod', '$bycrypt_password','$verify_token')";
    
                        $query_run = mysqli_query($conn, $query);
    
                        if ($query_run) {
                            sendemail_verify("$name", "$combine_email", "$verify_token");
    
                            $_SESSION['status'] = "Registration Sucessfullly.! Please verify your email.!";
                            header("Location: login.php");
                        } else {
                            $_SESSION['status'] = "Registration failed";
                            header("Location: register.php");
                        }
                    }
                    
                }
                else{
                    $_SESSION['status'] = "Email does not match!";
                    header("Location: register.php");
                }
               

        } else {
            $_SESSION['status'] = "Password does not match!";
            header("Location: register.php");
        }
    } else {
        redirect('register.php', 'All fields are mandatory');
    }
}
