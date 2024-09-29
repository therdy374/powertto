<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="table-responsive my-2">
    <form id="search-form" method="POST" action="">
        <label for="" class="me-5">Date*</label>
        <div class="d-flex col-md-3 mb-2">
            <input type="text" id="date-picker" name="selected-date" value="<?php echo isset($_POST['selected-date']) ? $_POST['selected-date'] : 'Select Date'; ?>" class="form-control" required />
            <button type="submit" id="search-btn" name="search" class="btn btn-primary">Search</button>
        </div>
    </form><br>

    <?php
    include "../includes/connect.php";
    date_default_timezone_set('Asia/Seoul');

    if (isset($_POST['search'])) {
        $selectedDate = $_POST['selected-date'];
    } else {
        $selectedDate = date('Y-m-d');
    }

    $sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 WHERE Date(date_purchase) = '$selectedDate' AND Date(generated_at) = '$selectedDate';";
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

                $maxMatchesRows[] = $row;
            }
        }

        if (!empty($maxMatchesRows)) {
            echo "<table class='table table-bordered text-white text-center my-3' style='font-size: small;' id='myTable'>";
            echo "<thead>";
            echo "<tr>
                                    <th class='text-center'>SI No</th>
                                    
                                    <th class='text-center'>사용자ID</th>
                                    <th class='text-center'>넘버</th>
                                    <th class='text-center'>선택한 번호</th>
                                    <th class='text-center'>파워볼</th>
                                    <th class='text-center'>일치하는 숫자</th>
                                    <th class='text-center'>매칭 파워볼</th>
                                    <th class='text-center'>모드</th>
                                    <th class='text-center'>당첨 금액</th>
                                    <th class='text-center'>상태</th>
                                    <th class='text-center'>ID</th>
                                    <th class='text-center'>추첨번호</th>
                                    <th class='text-center'>파워볼 번호</th>
                                    <th class='text-center'>생성날짜</th>
                                    <th class='text-center'>표시</th>
                                    <th class='text-center'>보다</th>
                                    <th class='text-center'>삭제</th>
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

                $query = "SELECT winning_amount FROM user_purchases WHERE DATE(date_purchase) = '$selectedDate' ORDER BY `date_purchase` DESC";
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
                        echo '<span class="badge bg-success">지급</span>';
                    } else {
                        echo '<span class="badge bg-danger">미지급</span>';
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

                    echo "<td><a href='index.php?update_winners=" . $row['id'] . "&date=" . urlencode($selectedDate) . "' class='text-success'>edit<i class='fa-solid fa-pen-to-square'></i></a></td>";


                    echo "<td><a href='index.php?view_winners_del=" . $row['id'] . "' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td>";
                    echo "</tr>";
                }
            }

            echo "</tbody>";
            echo "</table>";

            echo "<div class='text-center'>총 당첨금액(상금): " . number_format($total_winning) . " ₩</div>";
            echo "<div class='text-center'>당첨자 명수:" . $winnerCount . "</div>";
            $averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;
            echo "<div class='text-center'>우승자당 당첨금: " . number_format($averagePrizePerWinner) . " ₩</div>";
        } else {
            echo "No matching records found.";
        }
    } else {
        echo "No matching records found.";
    }

    $conn->close();
    ?>

    <div>
        <h6 class="mb-4">
            <a href="../home.php" class="btn btn-primary btn-sm float-end">메인에 게시 hoem</a>
        </h6>
    </div>
</div>

<script>
    flatpickr("#date-picker", {
        enableTime: false,
        dateFormat: "Y-m-d",
    });
</script>