<?php

if (isset($_SESSION['loggedIn'])) {
    $name = validate($_SESSION['loggedInUser']['name']);
    $verify_token = validate($_SESSION['loggedInUser']['verify_token']);

    $query = "SELECT * FROM users WHERE name='$name' AND verify_token='$verify_token' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        logoutSession();
        redirect('login.php', 'Access Denied...');
    } else {

        $row = mysqli_fetch_assoc($result);

        if ($row['is_ban'] == 1) {
            logoutSession();
            redirect('login.php', 'Your account has been banned please contact your Administrator');
        }
    }
} else {
    redirect('login.php', '로그인 후 이용하실 수 있습니다....');
}


