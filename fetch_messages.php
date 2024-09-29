<?php
// session_start(); // Ensure session is started

include "./includes/connect.php";

// // Get the logged-in user's ID
// if (!isset($_SESSION['loggedInUser']['userid'])) {
//     die("User not logged in");
// }

// $user = $_SESSION['loggedInUser']['userid'];
// $receiver = 'admin'; // Assuming the receiver is always 'admin'

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Prepare and execute the SQL query
// $stmt = $conn->prepare("SELECT * FROM message WHERE (sender = ? AND receiver = ?) OR (sender = ? AND receiver = ?) ORDER BY id ASC");
// if ($stmt === false) {
//     die("Prepare failed: " . $conn->error);
// }

// $stmt->bind_param("ssss", $user, $receiver, $receiver, $user);
// $stmt->execute();
// $result = $stmt->get_result();

// $messages = array();
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $messages[] = $row;
//     }
// }

// // Output messages as JSON
// header('Content-Type: application/json');
// echo json_encode($messages);

// // Close the connection
// $stmt->close();
// $conn->close();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM message ORDER BY id ASC"; 
$result = $conn->query($sql);

$messages = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

echo json_encode($messages);
$conn->close();
?>
