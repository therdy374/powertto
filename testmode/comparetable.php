<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "pos_mgt_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Date range for filtering

// SQL query
$sql = "
SELECT * FROM user_purchases t1 
JOIN generate_numbers t2 
WHERE DATE(t2.generated_at) >= '2024-02-20 00:00:00' 
AND DATE(t2.generated_at) <= '2024-02-20 23:59:59';";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Display results in an HTML table
    echo '<table border="1">';
    
    // Display table header
    echo '<tr>';
    while ($field = $result->fetch_field()) {
        echo '<th>' . $field->name . '</th>';
    }
    echo '</tr>';

    // Fetch data from the result set and display rows
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        foreach ($row as $value) {
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
    }

    echo '</table>';

    // Free the result set
    $result->free();
} else {
    // Display an error message if the query fails
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
