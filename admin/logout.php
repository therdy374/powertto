<?php
session_start();

if (isset($_SESSION['id'])) {
    unset($_SESSION['id']);
}

header("Location: signin.php");

// session_unset();
// session_destroy();
// echo "<script>alert('로그아웃 성공!');</script>";
// echo "<script>window.open('signin.php','_self')</script>";
?>