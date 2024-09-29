<?php
 include "inc/connect.php";

 // $servername = "localhost";
 // $username = "root";
 // $password = "";
 // $dbname = "pos_mgt_system";

 // $conn = new mysqli($servername, $username, $password, $dbname);
 // if ($conn->connect_error) {
 //     die("Connection failed: " . $conn->connect_error);
 // }

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update the "marked" column in the database
    $updateSql = "UPDATE user_purchases SET marked = 1 - marked WHERE id = $id";

    if ($conn->query($updateSql) === TRUE) {
        echo "Update successful";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
