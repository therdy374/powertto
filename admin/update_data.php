<?php
// Include necessary files and connect to the database
include "../includes/connect.php";
date_default_timezone_set('Asia/Seoul');

if (isset($_POST['selectedDate'])) {
    $selectedDate = $_POST['selectedDate'];
} else {
    $selectedDate = date('Y-m-d');
}

$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 WHERE Date(date_purchase) = '$selectedDate' AND Date(generated_at) = '$selectedDate';";
$result_query = $conn->query($sql);

if ($result_query->num_rows > 0) {
    // Start table structure
    $output = "<table class='table table-bordered text-white text-center my-3' style='font-size: small;' id='myTable'>";
    $output .= "<thead><tr><th class='text-center'>SI No</th><th class='text-center'>사용자ID</th><th class='text-center'>넘버</th><th class='text-center'>선택한 번호</th><th class='text-center'>파워볼</th><th class='text-center'>일치하는 숫자</th><th class='text-center'>매칭 파워볼</th><th class='text-center'>모드</th><th class='text-center'>당첨 금액</th><th class='text-center'>상태</th><th class='text-center'>ID</th><th class='text-center'>추첨번호</th><th class='text-center'>파워볼 번호</th><th class='text-center'>생성날짜</th><th class='text-center'>표시</th><th class='text-center'>보다</th><th class='text-center'>삭제</th></tr></thead>";
    $output .= "<tbody>";

    while ($row = $result_query->fetch_assoc()) {
        // Your existing PHP code to fetch and display data based on the selected date
        // ...

        // Example row content, replace with your actual data
        $output .= "<tr>";
        $output .= "<td>" . $row['id'] . "</td>";
        $output .= "<td>" . $row['user_id'] . "</td>";
        $output .= "<td>" . $row['username'] . "</td>";
        // Add other table cells here
        $output .= "</tr>";
    }

    // End table structure
    $output .= "</tbody></table>";

    // Output the HTML content
    echo $output;

    // Close database connection if open
    $conn->close();
} else {
    echo "No matching records found.";
}
