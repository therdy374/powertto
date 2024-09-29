<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and new password from form
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];

    // Here, you would typically update your database to set the new password for the user.
    // For demonstration, let's just echo a message.
    echo "Password reset for username: " . $username . "<br>";
    echo "New password: " . $new_password;
} else {
    // Redirect back to the form if accessed directly without submission
    header("Location: password_reset_form.php");
    exit;
}
?>
