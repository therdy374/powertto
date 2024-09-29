<?php
include './includes/connect.php'; // Ensure this file contains your database connection

if (isset($_POST['req_id']) && isset($_POST['hide'])) {
    $req_id = $_POST['req_id'];
    $hide = $_POST['hide'];

    $sql = "UPDATE users_request SET hide = ? WHERE req_id = ?";
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
