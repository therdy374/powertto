<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username from form
    $username = $_POST['username'];

    // Here, you would typically perform validation and verification
    // of the username, ensuring it exists in your database or user records.

    // For demonstration, let's just echo the username for now.
    echo "Password reset requested for username: " . $username;

    // Redirect to admin approval form with username as parameter
    header("Location: admin_approval_form.php?username=" . urlencode($username));
    exit;
} else {
    // Redirect back to the form if accessed directly without submission
    header("Location: reset_password_form.php");
    exit;
}
?>
