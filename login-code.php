<?php

date_default_timezone_set('Asia/Seoul');
require_once "./config/function.php";

// Function to determine device type
function getDeviceType($user_agent)
{
    $mobile_agents = array("iPhone", "iPad", "Android", "webOS", "BlackBerry", "iPod", "Symbian", "Windows Phone", "Mobile");
    foreach ($mobile_agents as $agent) {
        if (strpos($user_agent, $agent) !== false) return 'Mobile';
    }
    return 'PC';
}

if (isset($_POST['userLoginBtn'])) {

    if (!empty(trim($_POST['userid'])) && !empty(trim($_POST['password']))) {

        $user_id = validate($_POST['userid']);
        $password = validate($_POST['password']);

        $login_query = "SELECT * FROM users WHERE userid=? LIMIT 1";
        $stmt = mysqli_prepare($conn, $login_query);
        mysqli_stmt_bind_param($stmt, 's', $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            $hashpassword = $row['password'];

            // Check if the user is already logged in from another session
            if (!$row['verify_token']) {
                redirect('login.php', 'logout ka muna');
                exit(0);
            }

            if (!password_verify($password, $hashpassword)) {

                $ip_address = $_SERVER['REMOTE_ADDR'];
                $user_agent = $_SERVER['HTTP_USER_AGENT'];
                $device_use = getDeviceType($user_agent);
                $date_logs = date('Y-m-d H:i:s');
                $status = 0; 
                $verify_token = null; 
                
                $logs_prob = '암호가 잘못되었습니다';

                $insert_wrong = mysqli_query($conn, "INSERT INTO `logs_history_failed` (`userid`,`ip_address`, `device_use`, `verify_token`, `status`, `logs_prob`, `date_logs`)
                 VALUES ('$user_id ','$ip_address','$device_use','$verify_token','$status','$logs_prob','$date_logs')");

                redirect('login.php', '암호가 잘못되었습니다');
                exit(0);
            }

            if ($row['is_ban'] == 1) {

                redirect('login', 'Your account has been banned. Please contact your administrator.');
                exit(0);
            }

            if ($row['verify_status'] == "1") {

                session_regenerate_id();
                $verify_token = session_id();

                // Insert login logs
                $ip_address = $_SERVER['REMOTE_ADDR'];
                $user_agent = $_SERVER['HTTP_USER_AGENT'];
                $device_use = getDeviceType($user_agent);
                $date_logs = date('Y-m-d H:i:s');
                $status = 1;

                $user_logs_query = "INSERT INTO login_logs (userid, user_id, ip_address, device_use, verify_token, status, date_logs) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $user_logs_query);
                mysqli_stmt_bind_param($stmt, 'sisssis', $user_id, $row['id'], $ip_address, $device_use, $verify_token, $status, $date_logs);

                if (mysqli_stmt_execute($stmt)) {
                    // Set session variables
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['loggedInUser'] = [
                        'user_id' => $row['id'],
                        'name' => $row['name'],
                        'password' => $row['password'],
                        'email' => $row['email'],
                        'phone' => $row['phone'],
                        'credit' => $row['credit'],
                        'userid' => $row['userid'],
                        'bank_name' => $row['bank_name'],
                        'bank_acct_num' => $row['bank_acct_num'],
                        'referal_code' => $row['referal_code'],
                        'percentage' => $row['percentage'],
                        'affiliated_agent_code' => $row['affiliated_agent_code'],
                        'verify_token' => $verify_token,
                        'status' => $status,
                        'date_logs' => $date_logs,
                    ];

                    // Updating database for new session id
                    $query = "UPDATE users SET verify_token = ? WHERE id = ?";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, 'si', $verify_token, $row['id']);
                    mysqli_stmt_execute($stmt);

                
                    redirect('index', '로그인 성공');
                    exit(0);
                } else {
                    redirect('login', '로그인 시도를 기록하는 중 오류가 발생했습니다. 다시 시도하십시오.');
                    exit(0);
                }
            } else {
                $ip_address = $_SERVER['REMOTE_ADDR'];
                $user_agent = $_SERVER['HTTP_USER_AGENT'];
                $device_use = getDeviceType($user_agent);
                $date_logs = date('Y-m-d H:i:s');
                $status = 0;
                $verify_token = null; 
                $logs_prob = '계정이 아직 승인되지 않았습니다! 관리자에게 문의하십시오!';

                $insert_wrong = mysqli_query($conn, "INSERT INTO `logs_history_failed` (`userid`,`ip_address`, `device_use`, `verify_token`, `status`, `logs_prob`, `date_logs`)
                 VALUES ('$user_id ','$ip_address','$device_use','$verify_token','$status','$logs_prob','$date_logs')");

                redirect('login.php', '계정이 아직 승인되지 않았습니다!\\n관리자에게 문의하십시오!');
                exit(0);
            }
        } else {

            $ip_address = $_SERVER['REMOTE_ADDR'];
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $device_use = getDeviceType($user_agent);
            $date_logs = date('Y-m-d H:i:s');
            $status = 0; 
            $verify_token = null; 

            $logs_prob = '잘못된 사용자 ID';

            $insert_wrong = mysqli_query($conn, "INSERT INTO `logs_history_failed` (`userid`,`ip_address`, `device_use`, `verify_token`, `status`, `logs_prob`, `date_logs`)
                 VALUES ('$user_id ','$ip_address','$device_use','$verify_token','$status','$logs_prob','$date_logs')");

            redirect('login', '잘못된 사용자 ID');
            exit(0);
        }
    } else {
        redirect('login', '모든 필드가 필요합니다!');
        exit(0);
    }
}
