<?php
 date_default_timezone_set('Asia/Seoul');

include "inc/connect.php";

if (isset($_GET['update_winners'])) {

    $user_id = $_GET['update_winners'];
    $selectedDate = $_SESSION['selected-date'];
    echo $selectedDate;

    // $sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 ON t1.id = $user_id where generated_at = '$selectedDate'";
    $sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 ON t1.id = $user_id WHERE Date(date_purchase) = '$selectedDate' AND Date(generated_at) = '$selectedDate';";
    $result_query = $conn->query($sql);

    if ($row = $result_query->fetch_assoc()) {

        $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
        $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
        $numMatches = count($matchingNumbers);
        $win_id = $row['id'];
        $username = $row['username'];
        $user_id = $row['user_id'];
        $selected_numbers = $row['selected_numbers'];
        $powerballs = $row['powerballs'];
        $to_received = $row['to_received'];
        $matchingNumbers2 = $matchingNumbers;
        $matchingPowerball2 = ($matchingPowerball ? $row['powerballs'] : 'No Match');


        if (isset($_POST['winners_update'])) {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
            $powerballs = mysqli_real_escape_string($conn, $_POST['powerballs']);
            $matchingNumbers2 = mysqli_real_escape_string($conn, $_POST['winning_match_numbers']);
            $matchingPowerball2 = mysqli_real_escape_string($conn, $_POST['powerball_match']);
            $to_received = $_POST['to_received'];

            // Remove formatting to get the actual value
            $to_received = preg_replace('/[^\d.]/', '', $to_received);

            $winners_update = "UPDATE user_purchases SET `username`= '$username', `user_id` = '$user_id', `powerballs` = '$powerballs', `winning_match_numbers`='$matchingNumbers2', `to_received` = '$to_received', `powerball_match`='$matchingPowerball2' WHERE `id` = '$win_id'";

            // admin query
            $admin_id = $_SESSION['id'];

            $admin_query = "SELECT admin_credit FROM admins WHERE id = $admin_id";
            $query_run = mysqli_query($conn, $admin_query);
            
            while ($run_query = mysqli_fetch_array($query_run)) {
                $admin_credit = $run_query['admin_credit'];
            }
            
            if ($admin_credit <= 0 || $admin_credit < 50000) {
                echo "<script>alert('Your Balance is not enough to proceed this transactions!\\Please Recharge your account!\\n Admin Balance is: $admin_credit')</script>";
                echo "<script>window.open('index.php?comparetable','_self')</script>";
            } else {
                // Users
                $users_query = "SELECT credit FROM users where id = $user_id";
                $query_run4 = mysqli_query($conn, $users_query);
            
                while ($run_query = mysqli_fetch_array($query_run4)) {
                    $users_credit = $run_query['credit'];
                }
                $final_user_balance = $users_credit + $to_received;
            
                $user_sql2 = "UPDATE `users` SET `credit` = '$final_user_balance' WHERE `id` = $user_id";
                $res_query = mysqli_query($conn, $user_sql2);
            
                $admin_initial_balance = $admin_credit;
                $admin_final_balance = $admin_initial_balance - $to_received;
            
                $update_admin_credit = "UPDATE admins SET `admin_credit` = '$admin_final_balance' WHERE `id` = $admin_id";
                $res_query = mysqli_query($conn, $update_admin_credit);
            
                $result_query_update = mysqli_query($conn, $winners_update);
                if ($result_query_update) {
                    echo "<script>alert('사용자 결제 완료!\\n 관리 균형은 다음과 같습니다: ". number_format($admin_final_balance)." ₩ ')</script>";
                    echo "<script>window.open('index.php?comparetable','_self')</script>";
                } else {
                    echo "<script>alert('Oops, something went wrong!')</script>";
                    echo "Error updating record: " . mysqli_error($conn);
                }
            }
            
        }   
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winners Update</title>
</head>

<body>
    <div class="col-md-12 col-xl-12">
        <div class="bg-secondary rounded h-100 p-4">
            <div>
                <h6 class="mb-4 text-primary">당첨자 업데이트
                    <a href="index.php?comparetable" class="btn btn-primary btn-sm float-end">Back</a>
                </h6>
            </div>
            <form action="" method="POST" class="mb-2">
                <div class="row">
                    <input type="text" name="username" value="<?php echo $win_id; ?>" class="form-control" readonly />
                    <div class="col-md-12 mb-3">
                        <label for="">사용자ID *</label>
                        <input type="text" name="username" value="<?php echo $username; ?>" class="form-control" readonly />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Unique Id *</label>
                        <input type="text" name="user_id" value="<?php echo $user_id; ?>" class="form-control" readonly />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">당첨금액*</label>
                        <input type="text" name="to_received" value="<?php echo number_format($to_received); ?>" class="form-control" oninput="formatNumber(this)" required />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">선택한 번호 *</label>
                        <input type="text" name="selected_numbers" value="<?php echo $selected_numbers; ?>" class="form-control" readonly />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">파워볼 *</label>
                        <input type="text" name="powerballs" value="<?php echo $powerballs; ?>" class="form-control" readonly />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Matched Numbers*</label>
                        <input type="text" name="winning_match_numbers" value="<?php echo implode(', ', $matchingNumbers); ?>" class="form-control" readonly />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">매치 파워볼 번호*</label>
                        <input type="text" name="powerball_match" value="<?php echo $matchingPowerball2; ?>" class="form-control" readonly />
                    </div>

                    <input type="hidden" name="update_winners" value="<?php echo $user_id; ?>">
                </div>
                <input type="submit" value="당첨자 업데이트" name="winners_update" class="bg-primary border-0 rounded py-2 px-3 text-light">
            </form>
        </div>
    </div>
    <script>
        function formatNumber(input) {

            let value = input.value.replace(/\D/g, '');
            let formattedValue = Number(value).toLocaleString();

            input.value = formattedValue;
        }
    </script>
</body>

</html>
