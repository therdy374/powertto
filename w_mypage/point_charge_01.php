<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Request</title>
</head>

<body>

    <?php
    include "../includes/connect.php";

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $user_id = $_POST['user_id'];
        $message = "$name $user_id " . $_POST['message'];
        $query = "INSERT INTO `users_request_deposit` (`name`, `user_id`, `message`) VALUES ('$name', '$user_id','$message')";
        $res = mysqli_query($conn, $query);

        if ($query) {
            echo "<script>alert('Your account request is now pending for approval. Please wait for confirmation. Thank you.')</script>";
        } else {
            echo "<script>alert('Unknown error occured.')</script>";
        }
    }

    ?>


    <h2>Notification Request Form</h2>
    <form action="" method="post">
        <label for="username">User Id:</label>
        <input type="text" name="user_id" value="<?= $_SESSION['loggedInUser']['user_id']; ?>" required><br>

        <label for="username">Your Name:</label>
        <input type="text" name="name" value="<?= $_SESSION['loggedInUser']['name']; ?>" required><br>

        <label for="message">Notification Message:</label>
        <textarea name="message" rows="4" required></textarea><br>

        <input type="submit" name="submit" value="Send Notification">
    </form>
</body>

</html>