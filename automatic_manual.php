<?php
// Initialize $randomNumbers variable
$randomNumbers = [];
$randomNumbers1 = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["manual_submit"])) {
        $randomNumbers = handleManualButtonClick($conn);
    } elseif (isset($_POST["automatic_submit"])) {
        $randomNumbers = handleAutomaticButtonClick($conn);
        // $randomNumbers1 = generateRandomNumbers1(1);
    } elseif (isset($_POST["no_selection"])) {
        $randomNumbers = handleNoSelection($conn);
    }
}

function handleNoSelection($conn)
{
    date_default_timezone_set('Asia/Seoul');


    $requiredFields = ['selected_numbers', 'selected_single_number', 'name', 'user_id', 'payment', 'winning_amount'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            showError("Please select Autoamtic or Manual mode");
            return;
        }
    }


    $selectedNumbers = $_POST["selected_numbers"];
    if (count(explode(',', $selectedNumbers)) < 5) {
        showError("Please select your 6 Lucky Numbers!");
        return;
    }
}

function handleManualButtonClick($conn)
{
    date_default_timezone_set('Asia/Seoul');
    $currentDateTime = date('Y-m-d H:i:s');
    $currentTime = date('H:i');

    // Check if the current time is 22:00
    if (($currentTime >= '22:00' && $currentTime <= '23:59') || ($currentTime >= '00:00' && $currentTime <= '08:59')) {
        echo "<script>alert('죄송합니다. 구매 마감되었습니다.\\n파워또 구매는 12시에 재개됩니다\\n구매가능시간 12:00 ~ 22:00!...');</script>";
        return;
    } else {

        $selectedSingleNumber = ($_POST["selected_single_number"]);
        $user_name = ($_POST['user_name']);
        $name = ($_POST['name']);
        $user_id = ($_POST['user_id']);
        $payment = ($_POST['payment']);
        $winning_amount = ($_POST['winning_amount']);

        $referal_code = $_POST['referal_code'];
        $affiliated_agent_code = $_POST['affiliated_agent_code'];

        $requiredFields = ['selected_numbers', 'name', 'user_id', 'payment', 'winning_amount'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                showError("일반볼 5개와 파워볼 1개를 선택해주세요!");
                // return;
            }
        }

        if ($selectedSingleNumber == '') {
            showError("일반볼 5개와 파워볼 1개를 선택해주세요!");;
            return;
        }


        // Validate 'selected_numbers' length
        $selectedNumbers = $_POST["selected_numbers"];
        if (count(explode(',', $selectedNumbers)) < 5) {
            showError("일반볼 5개와 파워볼 1개를 선택해주세요!");
            // return;
        }

        $credit = getUserCredit($conn, $user_id);

        $initialBalance = $credit;
        $finalBalance = $initialBalance - $payment;

        if ($credit == 0 || $credit <= 49000) {
            showError("죄송합니다! 다시 균형을 잡으세요!\\n관리자에게 문의하시기 바랍니다!");
        } else {
            updateCredit($conn, $user_id, $finalBalance);
        }

        // // Check if the submit button is clicked more than once
        // if (isset($_SESSION['manual_submit']) && $_SESSION['manual_submit'] === true) {
        //     echo "<script>alert('요청이 처리되는 동안 기다려 주십시오.!\\n관리자에게 문의하십시오!');</script>";
        //     return;
        // }

        // // Set the submitted session variable to true
        // $_SESSION['manual_submit'] = true;

        // // Disable the button using JavaScript
        // echo "<script>document.getElementById('manual_submit_button').disabled = true;</script>";

        // // Show an alert for double click
        // echo "<script>alert('구매확인...');</script>";

        updateAdminCredit($conn);
        
        // admin insert
        $admin_sql = mysqli_query($conn, "INSERT INTO admins_fee (user_name, name, user_id, admin_fee, date_purchase)
        VALUES ('$user_name', '$name', '$user_id','15000','$currentDateTime')");

        $query = "INSERT INTO user_purchases (user_name, username, user_id, selected_numbers, powerballs, payment, winning_amount, modes, referal_code, affiliated_agent_code, date_purchase)
    VALUES (?, ?, ?, ?, ?, ?, ?, '수동', ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            die("Error in SQL query preparation: " . mysqli_error($conn));
        }

        // Bind parameters with types
        mysqli_stmt_bind_param($stmt, 'sssssdssss', $user_name, $name, $user_id, $selectedNumbers, $selectedSingleNumber, $payment, $winning_amount, $referal_code, $affiliated_agent_code, $currentDateTime);

        if (!mysqli_stmt_execute($stmt)) {
            die("Error executing SQL query: " . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);

        // Show success message and redirect
        showSuccess("행운의 숫자 선택 구매완료! $selectedNumbers $selectedSingleNumber\\n 구매 후 보유 머니 ₩ " . number_format($finalBalance));

        unset($_SESSION['manual_submit']);
        session_destroy($_SESSION['manual_submit']);
    }
}

function getUserCredit($conn, $user_id)
{
    $query = "SELECT credit FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['credit'];
    } else {
        die("Error in SQL query: " . mysqli_error($conn));
    }
}

function updateCredit($conn, $user_id, $finalBalance)
{
    $sql = "UPDATE `users` SET `credit` = $finalBalance WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error in SQL query: " . mysqli_error($conn));
    }
}

function updateAdminCredit($conn)
{
    $name = $_POST['name'];
    // admin payment update
    if ($_POST['referal_code'] != '' && $_POST['affiliated_agent_code'] != '') {
        $referal_code = $_POST['referal_code'];
        $affiliated_agent_code = $_POST['affiliated_agent_code'];

        // Prepare and execute the referral code check query
        $check_query = $conn->prepare("SELECT * FROM `admins` WHERE `referal_code` = ?");
        $check_query->bind_param('s', $referal_code);
        $check_query->execute();
        $result_query = $check_query->get_result();

        // Prepare and execute the affiliated agent code check query
        $check_query_affiliated = $conn->prepare("SELECT * FROM `admins` WHERE `referal_code` = ?");
        $check_query_affiliated->bind_param('s', $affiliated_agent_code);
        $check_query_affiliated->execute();
        $result_query_affiliated = $check_query_affiliated->get_result();

        if ($result_query && $result_query_affiliated) {
            if ($result_query->num_rows == 1 && $result_query_affiliated->num_rows == 1) {
                $result_fetch = $result_query->fetch_assoc();
                $result_fetch_affiliated = $result_query_affiliated->fetch_assoc();

                // Sanitize and validate percentage value
                $agent_name = $result_fetch['name'];
                $admin_level = $result_fetch['admin_level'];
                $percentage = trim($result_fetch['percentage']);
                $percentage = rtrim($percentage, '%');
                if (!is_numeric($percentage)) {
                    echo "<script>
                alert('Invalid percentage value for referral');
                window.location.href='join2.php';
                </script>";
                    exit;
                }
                $percentage = floatval($percentage);
                $admin_comm = 15000 * ($percentage / 100);
                $admin_credit = $result_fetch['admin_credit'] + $admin_comm;
                $comm = $result_fetch['admin_comm'] + $admin_comm;
                $username = $result_fetch['username'];


                // admin insert
                $com_insert = mysqli_query($conn,"INSERT INTO `commission_history`(`username`, `name`, `referal_code`, `admin_comm`, `percentage`, `admin_level`) VALUES ('$name','$agent_name','$referal_code','$admin_comm','$percentage','$admin_level')");

                // Update the main admin
                $update_query = $conn->prepare("UPDATE `admins` SET `admin_credit` = ?, `admin_comm` = ? WHERE `username` = ?");
                $update_query->bind_param('dds', $admin_credit, $comm, $username);
                $update_result = $update_query->execute();


                $admin_comm_affiliated = 15000 * ($percentage / 100);
                $admin_credit_affiliated = $result_fetch_affiliated['admin_credit'] + $admin_comm_affiliated;
                $comm_affiliated = $result_fetch_affiliated['admin_comm'] + $admin_comm_affiliated;
                $username_affiliated = $result_fetch_affiliated['username'];

                // Update the affiliated agent admin
                $update_query_affiliated = $conn->prepare("UPDATE `admins` SET `admin_credit` = ?, `admin_comm` = ? WHERE `username` = ?");
                $update_query_affiliated->bind_param('dds', $admin_credit_affiliated, $comm_affiliated, $username_affiliated);
                $update_result_affiliated = $update_query_affiliated->execute();

                if (!$update_result || !$update_result_affiliated) {
                    echo "<script>
                        alert('Cannot run query');
                        window.location.href='list_purchase.php';
                        </script>";
                    exit;
                }
            } else {
                echo "<script>
                alert('Invalid referral');
                window.location.href='join2.php';
                </script>";
                exit;
            }
        } else {
            echo "<script>
                alert('Something went wrong');
                window.location.href='login.php';
                </script>";
            exit;
        }
    }
}


function showError($message)
{
    echo "<script> alert('$message' );</script>";

    echo ("<script>location.href='number_list.php'</script>");
    exit;
}

function showSuccess($message)
{
    echo "<script>
            alert('$message');
            parent.location.href='list_purchase.php';
        </script>";
    exit;
}

// Automatic codes
function handleAutomaticButtonClick($conn)
{
    date_default_timezone_set('Asia/Seoul');
    $currentDateTime = date('Y-m-d H:i:s');
    $currentTime = date('H:i');

    // Check if the current time is within the purchase window
    if (($currentTime >= '22:00' && $currentTime <= '23:59') || ($currentTime >= '00:00' && $currentTime <= '08:59')) {
        echo "<script>alert('죄송합니다. 구매 마감되었습니다.\\n파워또 구매는 12시에 재개됩니다\\n구매가능시간 12:00 ~ 22:00!...');</script>";
        return;
    } else {
        $user_name = validate($_POST['user_name']);
        $name = validate($_POST['name']);
        $user_id = validate($_POST['user_id']);
        $payment = validate($_POST['payment']);
        $winning_amount = validate($_POST['winning_amount']);

        $gen1 = $_POST['gen1'];
        $gen2 = $_POST['gen2'];
        $gen3 = $_POST['gen3'];
        $gen4 = $_POST['gen4'];
        $gen5 = $_POST['gen5'];

        $randomNumbers = $gen1 . ',' . $gen2 . ',' . $gen3 . ',' . $gen4 . ',' . $gen5;
        $power = $_POST['power'];

        $referal_code = $_POST['referal_code'];
        $affiliated_agent_code = $_POST['affiliated_agent_code'];

        // Check if the submit button is clicked more than once
        if (isset($_SESSION['automatic_submit']) && $_SESSION['automatic_submit'] === true) {
            echo "<script>alert('요청이 처리되는 동안 기다려 주십시오.!\\n관리자에게 문의하십시오!');</script>";
            return;
        }
        // Set the submitted session variable to true
        $_SESSION['automatic_submit'] = true;

        // Disable the button using JavaScript
        echo "<script>document.getElementById('automatic_submit_button').disabled = true;</script>";
        echo "<script>alert('구매확인...');</script>";

        $query = "SELECT credit FROM users WHERE id = $user_id";
        $query_run = mysqli_query($conn, $query);

        while ($run_query = mysqli_fetch_array($query_run)) {
            $credit = $run_query['credit'];
        }

        if ($credit == 0) {
            echo "<script>alert('죄송합니다! 다시 균형을 잡으세요!\\n관리자에게 문의하십시오!');</script>";
            return;
        } elseif ($credit <= 49000) {
            echo "<script>alert('잔액이 부족합니다! 잔액을 다시 불러주세요!\\n관리자에게 문의하십시오!');</script>";
            return;
        } else {
            $initialBalance = $credit;
            $finalBalance = $initialBalance - $payment;


            $sql2 = "UPDATE `users` SET `credit` = '$finalBalance' WHERE id = $user_id";
            $res_query = mysqli_query($conn, $sql2);
        }

        // admin payment update
        if ($_POST['referal_code'] != '' && $_POST['affiliated_agent_code'] != '') {
            $referal_code = $_POST['referal_code'];
            $affiliated_agent_code = $_POST['affiliated_agent_code'];

            // Prepare and execute the referral code check query
            $check_query = $conn->prepare("SELECT * FROM `admins` WHERE `referal_code` = ?");
            $check_query->bind_param('s', $referal_code);
            $check_query->execute();
            $result_query = $check_query->get_result();

            // Prepare and execute the affiliated agent code check query
            $check_query_affiliated = $conn->prepare("SELECT * FROM `admins` WHERE `referal_code` = ?");
            $check_query_affiliated->bind_param('s', $affiliated_agent_code);
            $check_query_affiliated->execute();
            $result_query_affiliated = $check_query_affiliated->get_result();



            if ($result_query && $result_query_affiliated) {
                if ($result_query->num_rows == 1 && $result_query_affiliated->num_rows == 1) {
                    $result_fetch = $result_query->fetch_assoc();
                    $result_fetch_affiliated = $result_query_affiliated->fetch_assoc();

                    // Sanitize and validate percentage value
                    $agent_name = trim($result_fetch['name']);
                    $admin_level = $result_fetch['admin_level'];
                    $percentage = trim($result_fetch['percentage']);
                    $percentage = rtrim($percentage, '%');
                    if (!is_numeric($percentage)) {
                        echo "<script>
                        alert('Invalid percentage value for referral');
                        window.location.href='join2.php';
                        </script>";
                        exit;
                    }
                    $percentage = floatval($percentage);
                    $admin_comm = 15000 * ($percentage / 100);
                    $admin_credit = $result_fetch['admin_credit'] + $admin_comm;
                    $comm = $result_fetch['admin_comm'] + $admin_comm;

                    $username = $result_fetch['username'];

                    // Update the main admin
                    $update_query = $conn->prepare("UPDATE `admins` SET `admin_credit` = ?, `admin_comm` = ? WHERE `username` = ?");
                    $update_query->bind_param('dds', $admin_credit, $comm, $username);
                    $update_result = $update_query->execute();


                    $admin_comm_affiliated = 15000 * ($percentage / 100);
                    $admin_credit_affiliated = $result_fetch_affiliated['admin_credit'] + $admin_comm_affiliated;
                    $comm_affiliated = $result_fetch_affiliated['admin_comm'] + $admin_comm_affiliated;
                    $username_affiliated = $result_fetch_affiliated['username'];

                    // Update the affiliated agent admin
                    $update_query_affiliated = $conn->prepare("UPDATE `admins` SET `admin_credit` = ?, `admin_comm` = ? WHERE `username` = ?");
                    $update_query_affiliated->bind_param('dds', $admin_credit_affiliated, $comm_affiliated, $username_affiliated);
                    $update_result_affiliated = $update_query_affiliated->execute();

                
                    if (!$update_result || !$update_result_affiliated) {
                        echo "<script>
                        alert('Cannot run query');
                        window.location.href='list_purchase.php';
                        </script>";
                        exit;
                    }
                } else {
                    echo "<script>
                    alert('Invalid referral');
                    window.location.href='join2.php';
                    </script>";
                    exit;
                }
            } else {
                echo "<script>
                alert('Something went wrong');
                window.location.href='login.php';
                </script>";
                exit;
            }
        }

        // comm insert
        $com_insert = mysqli_query($conn,"INSERT INTO `commission_history`(`username`, `name`, `referal_code`, `admin_comm`, `percentage`, `admin_level`) VALUES ('$name','$agent_name','$referal_code','$admin_comm','$percentage','$admin_level')");
        
        // admin insert
        $admin_sql = mysqli_query($conn, "INSERT INTO admins_fee (user_name, name, user_id, admin_fee, date_purchase)
        VALUES ('$user_name', '$name', '$user_id','15000','$currentDateTime')");

        // User_purchase insert
        $sql = "INSERT INTO user_purchases (user_name, username, user_id, selected_numbers, powerballs, payment, winning_amount, modes, referal_code, affiliated_agent_code, date_purchase)
        VALUES ('$user_name', '$name', '$user_id', '$randomNumbers', '$power', '$payment', '$winning_amount', '자동', '$referal_code', '$affiliated_agent_code', '$currentDateTime')";

        if ($conn->query($sql) === TRUE) {
            $formattedBalance = number_format($finalBalance);
            echo "<script>alert('행운의 숫자 선택 구매완료! $randomNumbers $power\\n 구매 후 보유 머니 ₩ $formattedBalance\\n');</script>";

            echo ("<script>parent.location.href='list_purchase.php'</script>");
        } else {
            echo "<script>alert('Error processing your request.');</script>";
        }

        // Clear the submitted session variable
        unset($_SESSION['automatic_submit']);
    }
}


function generateRandomNumbers($count)
{
    $numbers = range(1, 28);
    shuffle($numbers);
    return array_slice($numbers, 0, $count);
}

function generateRandomNumber1($count)
{
    $numbers = range(0, 9);
    shuffle($numbers);
    return array_slice($numbers, 0, $count);
}
