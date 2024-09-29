<?php
// session_start();
include_once('../inc/connect.php');
// $conn = mysqli_connect("localhost","root","","pos_mgt_system");

if (isset($_POST['add'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $bycrypt_password = password_hash($password, PASSWORD_BCRYPT);
        $phone = $_POST['phone'];
        $verify_token = md5(rand());
        $verify_status = 0;
        $is_ban = isset($_POST['is_ban']) == true ? 1 : 0;

        if($name == '' || $email == '' || $password == '' || $verify_token == '' || $is_ban == '' ){
            echo "<script>alert('Please fill all the available fields')</script>";
            exit();
        }

        $sql = "INSERT INTO admins (name, email, password, phone, verify_token, verify_status, is_ban) VALUES ('$name', '$email', '$bycrypt_password', '$phone', '$verify_token', '$verify_status', '$is_ban')";

        $res_query = mysqli_query($conn, $sql);

        if ($res_query) {
            echo "<script>alert('Data updated successfully!')</script>";
            echo "<script>window.open('index.php?list_user','_self')</script>";
        }
}else{
    echo "<script>alert('Mali');</script>";
}



