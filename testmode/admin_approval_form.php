<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Approval</title>
</head>
<body>
    <h2>Admin Approval</h2>
    <?php
    // Check if username parameter is set in the URL
    if(isset($_GET['username'])) {
        $username = $_GET['username'];
    ?>
    <form method="post" action="admin_approval.php">
        <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
        <label for="approval">Do you approve this password reset request?</label><br>
        <input type="radio" id="approve" name="approval" value="approve" required>
        <label for="approve">Approve</label><br>
        <input type="radio" id="reject" name="approval" value="reject" required>
        <label for="reject">Reject</label><br><br>
        <input type="submit" value="Submit">
    </form>
    <?php } else {
        // Display error message if username parameter is not set
        echo "<p>Error: Username not provided.</p>";
    } ?>
</body>
</html>
