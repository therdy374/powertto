<?php
include 'includes/connect.php'; // Ensure your database connection is correct

header('Content-Type: application/json');

if (isset($_GET['referal_code'])) {
    $referal_code = mysqli_real_escape_string($conn, $_GET['referal_code']);
    $query = "SELECT parent_name FROM admins WHERE referal_code = '$referal_code'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $agent_code = $row['parent_name'];
            echo json_encode(['success' => true, 'agent_code' => $agent_code]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No agent found']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Query failed']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
