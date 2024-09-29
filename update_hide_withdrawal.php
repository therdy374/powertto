<?php
include './includes/connect.php'; // Ensure this file contains your database connection

if (isset($_POST['id']) && isset($_POST['hide'])) {
    $req_id = $_POST['id'];
    $hide = $_POST['hide'];

    $sql = "UPDATE user_withdrawal_request SET hide = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $hide, $req_id);

    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>
