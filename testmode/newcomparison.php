<style>
    .highlight {
        background-color: lightblue;
    }
</style>

<?php
include "../includes/connect.php";
date_default_timezone_set('Asia/Seoul');
// $currentDate = new DateTime();
// $yesterday = $currentDate->modify('-1 day');
// $date = $yesterday->format('Y-m-d (l)');

$date = date("2024-03-12");

$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 WHERE Date(date_purchase) = '$date' AND Date(generated_at) = '$date';";
$result_query = $conn->query($sql);

if ($result_query->num_rows > 0) {

    // Initialize variables to keep track of the maximum matches and corresponding rows
    $maxMatches = 0;
    $maxMatchesRows = array();

    while ($row = $result_query->fetch_assoc()) {
        $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
        $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
        $numMatches = count($matchingNumbers);

        if ($matchingPowerball) {
            $numMatches++; // Increment if Powerball matches
        }

        // Check if the current row has more matches than the current maximum
        if ($numMatches > $maxMatches) {
            $maxMatches = $numMatches;
            $maxMatchesRows = array($row);
        } elseif ($numMatches == $maxMatches) {
            // If there's a tie, add the row to the array
            $maxMatchesRows[] = $row;
        }
    }

    if (!empty($maxMatchesRows)) {
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
            <th class='text-center'>Status Payment</th>
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

        $winnerCount = 0;

        // Display all rows with the highest number of matches
        foreach ($maxMatchesRows as $row) {
            $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
            $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
            $numMatches = count($matchingNumbers);

            if ($matchingPowerball) {
                $numMatches++; // Increment if Powerball matches
            }

            $query = "SELECT winning_amount FROM user_purchases WHERE DATE(date_purchase) = '$date' ORDER BY `date_purchase` DESC";
            $query_run = mysqli_query($conn, $query);

            $total_winning = 0;

            while ($num = mysqli_fetch_assoc($query_run)) {
                $total_winning +=  $num['winning_amount'];
            }

            if ($numMatches >= 1 && $numMatches <= 6) {
                $winnerCount++;
                $columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;
            
                $rowClass = ($row['marked'] == 0) ? 'highlight' : '';
                echo "<tr data-id='" . $row['id'] . "' class='$rowClass'>";
            
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['user_id'] . "</td>";
            
                // Explode, sort, and implode the selected_numbers
                $selectedNumbers = explode(',', $row["selected_numbers"]);
                sort($selectedNumbers);
                $sortedNumbers = implode(', ', $selectedNumbers);
            
                echo "<td>" . $sortedNumbers . "</td>";
                echo "<td>" . $row['powerballs'] . "</td>";
            
                // Display the most matching numbers
                $matchingNumbersString = ($matchingNumbers !== null) ? implode(', ', $matchingNumbers) : 'No Match';
            
                // Explode, sort, and implode the matching numbers
                $sortedMatchingNumbers = explode(', ', $matchingNumbersString);
                sort($sortedMatchingNumbers);
                $sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);
                echo "<td>" . $sortedMatchingNumbersString . "<br>(" . $numMatches . " matches)</td>";
            
                echo "<td>" . ($matchingPowerball ? $row['powerballs'] : 'No Match') . "</td>";
                echo "<td>" . $row['modes'] . "</td>";
                echo "<td> " . number_format($row['to_received']) . "</td>";
            
                echo "<td>";
                if ($row['marked'] == 0) {
                    echo '<span class="badge bg-success">Paid</span>';
                } else {
                    echo '<span class="badge bg-danger">Not Paid</span>';
                }
                echo "</td>";
            
                echo "<td>" . $row['gen_id'] . "</td>";
            
                // Explode, sort, and implode the main_numbers
                $main_numbers = explode(',', $row["main_numbers"]);
                sort($main_numbers);
                $sortedNumbers2 = implode(', ', $main_numbers);
            
                echo "<td>" . $sortedNumbers2 . "</td>";
                echo "<td>" . $row['powerball_number'] . "</td>";
                echo "<td>" . date('Y.m.d (D) h:i:s(A)', strtotime($row['generated_at'])) . "</td>";
            
                echo "<td><button onclick='markRow(" . $row['id'] . ")' class='btn btn-primary btn-sm'>Mark</button></td>";
            
                echo "<td><a href='index.php?update_winners=" . $row['id'] . "' class='text-success'><i class='fa-solid fa-pen-to-square'></i></a></td>";
                echo "<td><a href='index.php?view_winners_del=" . $row['id'] . "' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td>";
                echo "</tr>";
            }
        }

        echo "</tbody>";
        echo "</table>";

        echo "<div class='text-center'>Total Winning Amount (Prize): " . number_format($total_winning) . " ₩</div>";
        echo "<div class='text-center'>Total got the match numbers: " . $winnerCount . "</div>";
        $averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;
        echo "<div class='text-center'>Average Prize per Winner: " . number_format($averagePrizePerWinner) . " ₩</div>";
    } else {
        echo "No matching records found.";
    }

} else {
    echo "No matching records found.";
}

$conn->close();
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