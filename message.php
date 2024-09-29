<?php include './includes/connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Messaging System</title>
</head>
<body>
    <h2>User Send Message</h2>
    <form method="POST" action="message_send.php">
        <input type="hidden" name="sender" value="user">
        <input type="hidden" name="receiver" value="admin">
        <textarea name="message" placeholder="Type your message here"></textarea><br>
        <button type="submit">Send Message</button>
    </form>

    <h2>Admin Reply</h2>
    <form method="POST" action="message_send.php">
        <input type="hidden" name="sender" value="admin">
        <input type="text" name="receiver" placeholder="Reply to user"><br>
        <textarea name="message" placeholder="Type your message here"></textarea><br>
        <button type="submit">Send Reply</button>
    </form>

    <h2>Messages</h2>
    <?php
    $sql = "SELECT * FROM message ORDER BY timestamp DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<strong>" . $row["sender"] . " to " . $row["receiver"] . ":</strong> " . $row["message"] . " <em>(" . $row["timestamp"] . ")</em><br>";
        }
    } else {
        echo "No messages.";
    }
    $conn->close();
    ?>
    
</body>
</html>
