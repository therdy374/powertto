<?php
$hash = '$2y$10$/WmC2WIEugcjZkDQBPuWI.37HhDcMhYuGLUCE2w.ZKdhFW.13jp7y';
$password = 'asdf@123';

if (password_verify($password, $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
?>
