<?php
include "./includes/connect.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender = $conn->real_escape_string($_POST['sender']);
    $receiver = $conn->real_escape_string($_POST['receiver']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO message (sender, receiver, message) VALUES ('$sender','$receiver','$message')";

    if ($conn->query($sql) === TRUE) {
        // Send the message to admin and wait for the response
        $admin_response = "Thank you for your message. We will get back to you shortly.";

        // Now, let's try to find an automated response if it exists
        $userMessage = strtolower($message);
        $response_sql = "SELECT response FROM responses WHERE keyword LIKE '%$userMessage%' LIMIT 1";
        $result = $conn->query($response_sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $admin_response = $row["response"];
            }
        }

        echo $admin_response;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    exit();
}

$conn->close();
?>
