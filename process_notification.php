<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input
    $username = $_POST['username'];
    $message = $_POST['message'];

    // Notify admin (you can replace this with your notification logic)
    $adminEmail = 'geronimo.t0324@gmail.com';
    $subject = 'Notification Request';
    $body = "User: $username\n\nMessage: $message";
    $headers = 'From: ' . $username . "\r\n" .
               'Reply-To: ' . $username . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    // Send notification email
    mail($adminEmail, $subject, $body, $headers);

    // Redirect user back to the form with a success message
    header('Location: test2.php?status=success');
    exit();
} else {
    // If someone tries to access this script directly, redirect to the form
    header('Location: test2.php');
    exit();
}
?>
