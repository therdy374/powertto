<?php
require_once './config/function.php';
date_default_timezone_set('Asia/Seoul');

// Function to determine device type
function getDeviceType($user_agent)
{
    $mobile_agents = array("iPhone", "iPad", "Android", "webOS", "BlackBerry", "iPod", "Symbian", "Windows Phone", "Mobile");
    foreach ($mobile_agents as $agent) {
        if (strpos($user_agent, $agent) !== false) return 'Mobile';
    }
    return 'PC';
}

// Check if the user is logged in
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    $verify_token = $_SESSION['loggedInUser']['verify_token'];
    $user_id = $_SESSION['loggedInUser']['user_id'];
    $name = $_SESSION['loggedInUser']['name'];
    $userid = $_SESSION['loggedInUser']['userid'];

    // Get the current date and time for logout
    $logout_time = date('Y-m-d H:i:s');

    // Update the login_logs table with the logout time
    $update_logs_query = "UPDATE login_logs SET status =  0, logout_time = ? WHERE user_id = ? AND verify_token = ?";
    $stmt = mysqli_prepare($conn, $update_logs_query);
    mysqli_stmt_bind_param($stmt, 'sis', $logout_time, $user_id, $verify_token);
    mysqli_stmt_execute($stmt);

    // Check if there is already a login session with the same user_id and status 1 (logged in)
    $check_double_login_query = "SELECT COUNT(*) FROM login_logs WHERE user_id = ? AND status = 1";
    $stmt = mysqli_prepare($conn, $check_double_login_query);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $login_count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($login_count > 1) {
        // Insert into login_double table only if there is a double login
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $device_use = getDeviceType($user_agent);
        $date_logs = date('Y-m-d H:i:s');
        $status = 0; // Status 0 for failed attempt
        $verify_token = null; // Null for failed attempts
        $logs_prob = 'you are make a double logged in!';

        $insert_wrong = mysqli_query($conn, "INSERT INTO `login_double` (`userid`,`user_id`,`ip_address`, `device_use`, `verify_token`, `status`, `logs_prob`, `date_logs`)
         VALUES ('$userid','$user_id','$ip_address','$device_use','$verify_token','$status','$logs_prob','$date_logs')");
    }

    // Destroy the session
    session_id($_SESSION['loggedInUser']['verify_token']);
    session_unset();
    session_destroy();

    echo "<script>
        alert('로그아웃 성공\\n Have a great day! " . addslashes($name) . "');
        window.location.href = 'login';
        </script>";

    exit(0);
} else {
    // If the user is not logged in, just redirect to the login page
    redirect('login', '로그인하지 않은 상태입니다.');
    // exit(0);
}


?>
