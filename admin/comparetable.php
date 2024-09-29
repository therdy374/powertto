<!-- Table Start -->
<style>
    .highlight {
        background-color: #155059;
    }

    table.dataTable tbody th,
    table.dataTable tbody td {
        padding: 8px 10px;
        display: absolute;
        width: 150px;
    }

    table.dataTable th,
    table.dataTable td {
        box-sizing: content-box;
    }

    .table-bordered>:not(caption)>*>* {
        border-width: 3px 1px;
    }

    .table>:not(caption)>*>* {
        padding: .5rem .5rem;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }

    thead,
    tbody,
    tfoot,
    tr,
    td,
    th {
        border-color: inherit;
        border-style: solid;
        border-width: 0;
    }
</style>


<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 p-4">
                <div>
                    <h6 class="mb-4">참가자 경기 승자
                        <a href="index.php" class="btn btn-primary btn-sm float-end">Back</a>
                    </h6>
                </div>

                <?php //include_once("./data/create_winners.php"); 
                ?>
                <!-- <div class="d-flex">
                    <?php
                    date_default_timezone_set('Asia/Seoul');
                    $currentDate = new DateTime();
                    $yesterday = $currentDate->modify('-1 day');
                    $date = $yesterday->format('Y-m-d');

                    echo "<span class='text-danger'>어제 우승자:  $date </span>";
                    ?>
                </div><br> -->
                <div class="table-responsive my-2">
                    <form id="search-form" method="POST">
                        <label for="" class="me-5">Date*</label>
                        <div class="d-flex col-md-3 mb-2">
                            <input type="text" id="date-picker" name="selected-date" value="<?php echo isset($_POST['selected-date']) ? $_POST['selected-date'] : 'Select Date'; ?>" class="form-control" required />
                            <button type="submit" id="search-btn" name="search" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                    <br>

                    <?php
                    if (!isset($_SESSION['selected-date'])) {
                        $_SESSION['selected-date'] = date('Y-m-d');
                    }

                    include "../includes/connect.php";
                    date_default_timezone_set('Asia/Seoul');

                    if (isset($_POST['search'])) {
                        $_SESSION['selected-date'] = $_POST['selected-date'];
                    }

                    $selectedDate = $_SESSION['selected-date'];

                    $sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 WHERE Date(date_purchase) = '$selectedDate' AND Date(generated_at) = '$selectedDate';";
                    $result_query = $conn->query($sql);

                    $maxMatches = 0;
                    $maxMatchesRows = array();

                    if ($result_query->num_rows > 0) {
                        while ($row = $result_query->fetch_assoc()) {
                            $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
                            $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
                            $numMatches = count($matchingNumbers);

                            if ($matchingPowerball) {
                                $numMatches++;
                            }

                            if ($numMatches > $maxMatches) {
                                $maxMatches = $numMatches;
                                $maxMatchesRows = array($row);
                            } elseif ($numMatches == $maxMatches) {
                                $maxMatchesRows[] = $row;
                            }
                        }
                    }
                    ?>

                    <table class='table table-bordered text-white text-center my-3' style='font-size: small;' id='myTable1'>
                        <thead>
                            <tr>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($maxMatchesRows)) {
                                $winnerCount = 0;
                                foreach ($maxMatchesRows as $row) {
                                    $matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
                                    $matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
                                    $numMatches = count($matchingNumbers);

                                    if ($matchingPowerball) {
                                        $numMatches++;
                                    }

                                    $query = "SELECT winning_amount FROM user_purchases WHERE DATE(date_purchase) = '$selectedDate' ORDER BY `date_purchase` DESC";
                                    $query_run = mysqli_query($conn, $query);

                                    $total_winning = 0;

                                    while ($num = mysqli_fetch_assoc($query_run)) {
                                        $total_winning += $num['winning_amount'];
                                    }

                                    if ($numMatches >= 1 && $numMatches <= 6) {
                                        $winnerCount++;
                                        $columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

                                        $rowClass = ($row['marked'] == 0) ? 'highlight' : '';
                                        echo "<tr data-id='" . $row['id'] . "' class='$rowClass'>";

                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['username'] . "</td>";
                                        echo "<td>" . $row['user_id'] . "</td>";

                                        $selectedNumbers = explode(',', $row["selected_numbers"]);
                                        sort($selectedNumbers);
                                        $sortedNumbers = implode(', ', $selectedNumbers);

                                        echo "<td>" . $sortedNumbers . "</td>";
                                        echo "<td>" . $row['powerballs'] . "</td>";

                                        $matchingNumbersString = ($matchingNumbers !== null) ? implode(', ', $matchingNumbers) : 'No Match';
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

                                        $main_numbers = explode(',', $row["main_numbers"]);
                                        sort($main_numbers);
                                        $sortedNumbers2 = implode(', ', $main_numbers);

                                        echo "<td>" . $sortedNumbers2 . "</td>";
                                        echo "<td>" . $row['powerball_number'] . "</td>";
                                        echo "<td>" . date('Y.m.d (D) h:i:s(A)', strtotime($row['generated_at'])) . "</td>";

                                        echo "<td><button onclick='markRow(" . $row['id'] . ")' class='btn btn-primary btn-sm'>Mark</button></td>";
                                        echo "<td><a href='index.php?update_winners=" . $row['id'] . "&date=" . urlencode($selectedDate) . "' class='text-success'><i class='fa-solid fa-pen-to-square'></i></a></td>";
                                        echo "<td><a href='index.php?view_winners_del=" . $row['id'] . "' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td>";
                                        echo "</tr>";
                                    }
                                }
                            } else {
                                echo "<tr><td colspan='17'>No matching records found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                    if (!empty($maxMatchesRows)) {
                        echo "<div class='text-center'>총 당첨금액(상금): " . number_format($total_winning) . " ₩</div>";
                        echo "<div class='text-center'>당첨자 명수:" . $winnerCount . "</div>";
                        $averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;
                        echo "<div class='text-center'>우승자당 당첨금: " . number_format($averagePrizePerWinner) . " ₩</div>";
                    }
                    ?>

                    <form id="post-form" method="POST">
                        <?php foreach ($maxMatchesRows as $index => $row) { ?>
                            <input type="hidden" name="rows[<?php echo $index; ?>][id]" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="rows[<?php echo $index; ?>][username]" value="<?php echo $row['username']; ?>">
                            <input type="hidden" name="rows[<?php echo $index; ?>][user_id]" value="<?php echo $row['user_id']; ?>">
                            <input type="hidden" name="rows[<?php echo $index; ?>][selected_numbers]" value="<?php echo $row['selected_numbers']; ?>">
                            <input type="hidden" name="rows[<?php echo $index; ?>][powerballs]" value="<?php echo $row['powerballs']; ?>">
                            <input type="hidden" name="rows[<?php echo $index; ?>][winning_match_numbers]" value="<?php echo $row['winning_match_numbers']; ?>">
                            <input type="hidden" name="rows[<?php echo $index; ?>][powerball_match]" value="<?php echo $row['powerball_match']; ?>">
                            <input type="hidden" name="rows[<?php echo $index; ?>][modes]" value="<?php echo $row['modes']; ?>">
                            <input type="hidden" name="rows[<?php echo $index; ?>][main_numbers]" value="<?php echo $row['main_numbers']; ?>">
                            <input type="hidden" name="rows[<?php echo $index; ?>][powerball_number]" value="<?php echo $row['powerball_number']; ?>">
                            <input type="hidden" name="rows[<?php echo $index; ?>][generated_at]" value="<?php echo $row['generated_at']; ?>">
                            <input type="hidden" name="rows[<?php echo $index; ?>][to_received]" value="<?php echo $row['to_received']; ?>">
                        <?php } ?>

                        <?php
                        if (isset($_POST['post_submit'])) {
                            $rows = $_POST['rows'] ?? [];
                            $all_inserted = true;

                            foreach ($rows as $row) {
                                $id = $row['id'] ?? '';
                                $username = $row['username'] ?? '';
                                $user_id = $row['user_id'] ?? '';
                                $selected_numbers = $row['selected_numbers'] ?? '';
                                $powerballs = $row['powerballs'] ?? '';
                                $winning_match_numbers = $row['winning_match_numbers'] ?? '';
                                $powerball_match = $row['powerball_match'] ?? '';
                                $modes = $row['modes'] ?? '';
                                $main_numbers = $row['main_numbers'] ?? '';
                                $powerball_number = $row['powerball_number'] ?? '';
                                $generated_at = $row['generated_at'] ?? '';
                                $to_received = $row['to_received'] ?? '';

                                $check_posted = mysqli_query($conn, "SELECT * FROM posted_winners WHERE id = '$id' AND generated_at = '$generated_at'");

                                if (mysqli_num_rows($check_posted) == 0) { // Check if entry with generated_at does not already exist
                                    $query = mysqli_query($conn, "INSERT INTO posted_winners (id, username, user_id, selected_numbers, powerballs, winning_match_numbers, powerball_match, modes, to_received, main_numbers, powerball_number, generated_at) VALUES ('$id', '$username', '$user_id', '$selected_numbers', '$powerballs', '$winning_match_numbers', '$powerball_match', '$modes', '$to_received', '$main_numbers', '$powerball_number', '$generated_at')");

                                    if (!$query) {
                                        $all_inserted = false;
                                    }
                                } else {
                                    echo "<script>alert('The winners is already posted!')</script>";
                                    echo "<script>window.open('index.php?comparetable','_self')</script>";
                                }
                            }

                            if ($all_inserted) {
                                echo "<script>alert('All winners are now posted.')</script>";
                            } else {
                                echo "<script>alert('Sorry, not all winners could be posted.')</script>";
                            }
                        }
                        ?>

                        <div class="text-end">
                            <button type="submit" name="post_submit" class="btn btn-primary btn-sm">Post</button>
                        </div>
                    </form>
                </div>

                <script>
                    flatpickr("#date-picker", {
                        enableTime: false,
                        dateFormat: "Y-m-d",
                    });
                </script>


            </div>
        </div>
    </div>
</div>
<!-- Table End -->


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