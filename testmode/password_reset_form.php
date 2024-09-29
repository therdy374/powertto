


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <h2>Password Reset</h2>
    <?php
    // Check if username parameter is set in the URL
    if(isset($_GET['username'])) {
        $username = $_GET['username'];
    ?>
    <form method="post" action="new_reset_password.php">
        <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
        <label for="new_password">New Password:</label><br>
        <input type="password" id="new_password" name="new_password" required><br><br>
        <input type="submit" value="Reset Password">
    </form>
    <?php } else {
        // Display error message if username parameter is not set
        echo "<p>Error: Username not provided.</p>";
    } ?>
</body>
</html>
