<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection established
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pos_mgt_system";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get values from the form
    $data1 = $_POST["data1"];
    $data2 = $_POST["data2"];
    // $data3 = $_POST["data3"];

    // Concatenate the three data values into a single string
    $combined_data = $data1 . '@' . $data2 . '';

    // Insert data into the table
    $sql = "INSERT INTO users (email) VALUES ('$combined_data')";

    if ($conn->query($sql) === TRUE) {
        echo "New record inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<h2>Data Insertion Form</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="data1">Data 1:</label>
    <input type="text" name="data1" required>
    <input type="text" name="data2" required>
    <br>

    <!-- <label for="data2">Data 2:</label>
    <input type="text" name="data2" required>
    <br> -->

    <!-- <label for="data3">Data 3:</label>
    <input type="text" name="data3" required>
    <br> -->

    <input type="submit" value="Submit">
</form>

</body>
</html>
