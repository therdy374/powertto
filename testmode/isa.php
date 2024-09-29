<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pos_mgt_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 WHERE Date(date_purchase) = '2024-02-22' AND Date(generated_at) = '2024-02-22';";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Rows</title>
    <style>
        .highlight {
            background-color: lightblue;
        }
    </style>
</head>

<body>

    <?php
    if ($result->num_rows > 0) {
        echo "<table class='table text-white text-center my-3' style='font-size: small;' id='myTable'>";
        echo "<thead>";
        echo "<tr>
                
                <th class='text-center'>SI No</th>
                <th class='text-center'>Name</th>
                <th class='text-center'>User ID</th>
                <th class='text-center'>Selected Numbers</th>
                <th class='text-center'>Powerballs</th>
                <th class='text-center'>Matched Numbers</th>
                <th class='text-center'>Matched Powerball</th>
                <th class='text-center'>Modes</th>
                <th class='text-center'>Winnig Amount</th>
                <th class='text-center'>Date Purchase</th>
                <th class='text-center'>ID</th>
                <th class='text-center'>Main Numbers</th>
                <th class='text-center'>Powerball Number</th>
                <th class='text-center'>Generated At</th>
                <th class='text-center'>Mark</th>
                <th class='text-center'>View</th>
                <th class='text-center'>Delete</th>
            </tr>";
        echo "</thead>";
        echo "<tbody>";

        $total_winning = 0;
        $winnerCount = 0;

        $date = date("2024-02-22");
        while ($row = $result->fetch_assoc()) {
            $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
            $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);

            $numMatches = count($matchingNumbers);

            $query = "SELECT winning_amount FROM user_purchases WHERE DATE(date_purchase) = '$date' ORDER BY `date_purchase` DESC";
            $query_run = mysqli_query($conn, $query);

            $total_winning = 0;

            while ($num = mysqli_fetch_assoc($query_run)) {
                $total_winning +=  $num['winning_amount'];
            }

            // Determine the prize for the main numbers and Powerball
            if ($numMatches >= 3) {
                $winnerCount++; // Increment winner count
                $columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0; // Prize for 3 or more matches
            } else {
                switch ($numMatches) {
                    case 4:
                        $columnPrize = 400;
                        $winnerCount++; // Increment winner count
                        break;
                    case 5:
                        $columnPrize = 500;
                        $winnerCount++; // Increment winner count
                        break;
                    case 6:
                        $columnPrize = "jackpot";
                        $winnerCount++; // Increment winner count
                        break;
                    default:
                        // Check if Powerball matches
                        $columnPrize = ($matchingPowerball ? 10000 : 0);
                        if ($matchingPowerball) {
                            $winnerCount++; // Increment winner count
                        }
                }
            }

            $rowClass = ($row['marked'] == 0) ? 'highlight' : '';
            echo "<tr data-id='" . $row['id'] . "' class='$rowClass'>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['user_id'] . "</td>";
            echo "<td>" . $row['selected_numbers'] . "</td>";
            echo "<td>" . $row['powerballs'] . "</td>";
            echo "<td>" . implode(', ', $matchingNumbers) . "</td>";
            echo "<td>" . ($matchingPowerball ? $row['powerballs'] : 'No Match') . "</td>";
            echo "<td>" . $row['modes'] . "</td>";
            echo "<td> " . number_format($row['to_received']) . "</td>";
            echo "<td>" . date('Y.m.d (D)', strtotime($row['date_purchase'])) . "</td>";
            echo "<td>" . $row['gen_id'] . "</td>";
            echo "<td>" . $row['main_numbers'] . "</td>";
            echo "<td>" . $row['powerball_number'] . "</td>";
            echo "<td>" . date('Y.m.d (D)', strtotime($row['generated_at'])) . "</td>";
            echo "<td><button onclick='markRow(" . $row['id'] . ")'>Mark</button></td>";

            echo "<td><a href='index.php?update_winners=" . $row['id'] . "' class='text-success'><i class='fa-solid fa-pen-to-square'></i></a></td>";
            echo "<td><a href='index.php?view_winners_del=" . $row['id'] . "' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";

        // Display the total winning amount as the prize of the winners
        echo "<div class='text-center'>Total Winning Amount (Prize): " . number_format($total_winning) . "</div>";

        // Display the total number of winners
        echo "<div class='text-center'>Total Number of Winners: " . $winnerCount . "</div>";

        // Display the average prize per winner
        $averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;
        echo "<div class='text-center'>Average Prize per Winner: " . number_format($averagePrizePerWinner) . "</div>";
        
     
    } else {
        echo "<tr><td colspan='4'>No data found</td></tr>";
    }
 
    ?>


    <script>
        function markRow(id) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var row = document.querySelector("tr[data-id='" + id + "']");
                        row.classList.toggle('highlight');
                    } else {
                        console.error("Error updating record");
                    }
                }
            };
            xhr.open("GET", "update_marked.php?id=" + id, true);
            xhr.send();
        }
    </script>

</body>

</html>

<?php
$conn->close();
?>