<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve approval status
    $approval = $_POST['approval'];
    // Retrieve username
    $username = $_POST['username'];

    // Here, you would typically update your database or perform other actions based on the admin's decision.
    if ($approval == 'approve') {
        // Notify the user about the password reset
        $message = "Your password reset request has been approved. Please proceed to reset your password.";
        // Here you could send an email to the user with the notification message.

        // Redirect user to password reset form
        header("Location: password_reset_form.php?username=" . urlencode($username));
        exit;
    } elseif ($approval == 'reject') {
        echo "Password reset request rejected.";
        // You can handle rejection as needed, such as notifying the user.
    }
} else {
    // Redirect back to the form if accessed directly without submission
    header("Location: reset_password_form.php");
    exit;
}
?>
