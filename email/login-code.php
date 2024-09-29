<?php
// require_once "../config/dbcon.php";
require_once "../config/function.php";

if (isset($_POST['login_now_btn'])) {


    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['email']))) {
        $email = validate($_POST['email']);
        $password = validate($_POST['password']);

        $login_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $login_query);

        if (mysqli_num_rows($result) > 0) {


            $row = mysqli_fetch_assoc($result);
            $hashpassword = $row['password'];

            if (!password_verify($password, $hashpassword)) {
                redirect('login.php', 'Invalid Password');
            }

            if ($row['is_ban'] == 1) {
                redirect('login.php', 'Your account has been banned contact your Administrator');
                exit(0);
            }

            if ($row['verify_status'] == "1") {

                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                ];
                redirect('dashboard.php', 'Logged in Successfully');
                exit(0);
            } else {
                redirect('login.php', 'Please verify your account in your email to login!');
            }
        } else {
            redirect('login.php', 'Invalid Email Address');
            exit(0);
        }
    } else {
        redirect('login.php', 'All fields are mandatory');
        exit(0);
    }
}
