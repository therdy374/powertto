<?php

include "./inc/connect.php";



$id = $_POST['id'];
$username = $_POST['username'];
$user_id = $_POST['user_id'];
$selected_numbers = $_POST['selected_numbers'];
$powerballs = $_POST['powerballs'];
$winning_match_numbers = $_POST['winning_match_numbers'];
$powerball_match = $_POST['powerball_match'];
$modes = $_POST['modes'];
$to_received = $_POST['to_received'];
$main_numbers = $_POST['main_numbers'];
$powerball_number = $_POST['powerball_number'];
$generated_at = $_POST['generated_at'];


if (isset($_POST['post_submit'])) {
    if ($username = '' && $user_id = '' && $selected_numbers = '' && $powerballs = '' && $winning_match_numbers = '' && $powerball_match = '' && $modes = '' && $main_numbers = '' && $powerball_number = '' && $generated_at = '' && $to_received) {
        echo "oppss";
    } else {
        $query = mysqli_query($conn, "INSERT INTO posted_winners(username, user_id, selected_numbers, powerballs, winning_match_numbers, powerball_match, modes, to_received,main_numbers,powerball_number,generated_at) VALUES('$username', '$user_id', '$selected_numbers', '$powerballs', '$winning_match_numbers', '$powerball_match', '$modes', '$to_received', '$main_numbers', '$powerball_number', '$generated_at' )");

        if ($query) {
            echo "The winners is now POsted";
        } else {
            echo "Sori no winners this time";
        }
    }
}
