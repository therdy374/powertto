<?php
$page_title = "Bulletin Board";

require "./includes/menubar.php";
?>


<div class="quick-prod-top">
	<div class="con">

		<a href="./w_play/lotto_em.php" title="유로밀리언즈" class="quick-prod-em"><img src="./asset/images/logo_em.png"><span>430억</span></a>

		<a href="./w_play/lotto_cfl.php" title="캐시4라이프" class="quick-prod-cfl"><img src="./asset/images/logo_cfl.png"><span>1,000불/매일</span></a>

		<a href="./w_play/lotto_pb.php" title="파워볼" class="quick-prod-pb"><img src="./asset/images/logo_pb.png"><span>8,925억</span></a>

		<a href="./w_play/lotto_mm.php" title="메가밀리언즈" class="quick-prod-mm"><img src="./asset/images/logo_mm.png"><span>1,198억</span></a>

		<a href="./w_play/lotto_sl.php" title="슈퍼로또플러스" class="quick-prod-sl"><img src="./asset/images/logo_sl.png"><span>0억</span></a>

		<a href="./w_play/lotto_nl.php" title="뉴욕로또" class="quick-prod-nl"><img src="./asset/images/logo_nl.png"><span>127억</span></a>

		<a href="./w_play/lotto_lp.php" title="라 프리미티바" class="quick-prod-lp"><img src="./asset/images/logo_lp.png"><span>31억</span></a>

		<a href="./w_play/lotto_eg.php" title="엘 고르도" class="quick-prod-eg"><img src="./asset/images/logo_eg.png"><span>84억</span></a>

		<a href="./w_play/lotto_ej.php" title="유로 잭팟" class="quick-prod-ej"><img src="./asset/images/logo_ej.png"><span>1,450억</span></a>
	</div>
</div>

<style>
	.quick-prod-top {
		display: none
	}

	.container {
		padding-top: 130px
	}

	@media screen and (max-width:768px) {
		.container {
			padding-top: 55px
		}
	}

	.container1 {
		max-width: 1160px;
		margin: 20px auto;
		background-color: #fff;
		padding: 20px;
		border-radius: 10px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		/* width: 100%; */
	}

	.withdrawal {
		margin-bottom: 10px;
		display: block;
	}

	.withdrawal h3,
	.withdrawal p {
		margin: 0;
		color: #333;
		font-size: 15px;
		display: inline-block;
	}
</style>

<div class="container">
	<?php alertMessage(); ?>
	<div class="main-inner-bn">
		<div class="prize-num-w">

			<?php
			include "./includes/connect.php";

			$last_draw = "SELECT * FROM generate_numbers ORDER BY generated_at DESC LIMIT 1";
			$query = mysqli_query($conn, $last_draw);

			while ($row = mysqli_fetch_assoc($query)) {
				$last_mdraw = $row['main_numbers'];
				$last_pdraw = $row['powerball_number'];
				// Convert the date to Korean format
				$timestamp = strtotime($row['generated_at']);
				$day_of_week = date('w', $timestamp); // Get the numeric representation of the day of the week (0 for Sunday, 1 for Monday, etc.)
				$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
				$generated_at = date('Y.m.d', $timestamp) . " (" . $days[$day_of_week] . ")";
			}
			?>
			<div class="prize-tit">
				최근추첨번호
				<div><?php echo $generated_at; ?> 24:00 (한국시간)</div>
			</div>


			<?php

			$sql = "SELECT main_numbers, powerball_number FROM generate_numbers ORDER BY generated_at DESC LIMIT 1";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {

				while ($row = $result->fetch_assoc()) {
					$mainNumbers = explode(",", $row['main_numbers']);
					$powerballNumber = $row['powerball_number'];
				}
				echo "<div class='prize-num'>";
				echo '<span>' . $mainNumbers[0] . '</span>';
				echo '<span>' . $mainNumbers[1] . '</span>';
				echo '<span>' . $mainNumbers[2] . '</span>';
				echo '<span>' . $mainNumbers[3] . '</span>';
				echo '<span>' . $mainNumbers[4] . '</span>';
				echo '<span class="bg-pk">' . $powerballNumber . '</span>';
				echo "</div>";
			} else {
				echo "0 results";
			}

			?>

		</div>
	</div>

	<!-- list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원 </h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-1 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Function to format asterisks in names
		function formatAsterisks($name)
		{
			$asteriskPositions = [2, 3, 4, 6, 8, 9, 10];
			$formattedName = '';

			for ($i = 0; $i < strlen($name); $i++) {
				if (in_array($i + 1, $asteriskPositions)) {
					$formattedName .= '*';
				} else {
					$formattedName .= $name[$i];
				}
			}

			return $formattedName;
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';

					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>

	<!-- 2nd list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-2 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 3rd list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-3 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {

					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}

					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 4 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-4 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {

					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}

					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 5 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-5 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 6 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-6 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 7 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-7 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 8 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-8 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 9 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-9 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 10 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-10 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>

	<!-- 11 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-11 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 12nd list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-12 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 13rd list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-13 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 14 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-14 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 15 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-15 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 16 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-16 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!--  17list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-17 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 18 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-18 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 19 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-19 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 20 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-20 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>

	<!-- 21 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-21 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 22nd list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-22 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 23rd list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-23 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 24 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-24 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 25 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-25 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 26 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-26 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 27 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-27 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 28 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-28 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 29 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-29 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>
	<!-- 30 list customer winner -->
	<div class="container1">
		<h4 style="font-weight: 500; color:red">당첨자 발표 인원</h4><br>
		<?php
		include "./includes/connect.php";

		date_default_timezone_set('Asia/Seoul');
		$currentDate = new DateTime();
		$yesterday = $currentDate->modify('-30 day');
		$date = $yesterday->format('Y-m-d');

		$days = array("일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일");
		$dayOfWeek = $yesterday->format('w');
		$dayName = $days[$dayOfWeek];

		echo $date . " (" . $dayName . ") 추첨번호 ";

		// Query to fetch last draw data
		$last_draw = "SELECT * FROM generate_numbers
                  WHERE DATE(generated_at) = '$date';";
		$query = mysqli_query($conn, $last_draw);

		$mainNumbers = [];
		$powerballNumber = '';

		if ($query && mysqli_num_rows($query) > 0) {
			$row = mysqli_fetch_assoc($query);
			$mainNumbers = explode(',', $row['main_numbers']);
			$powerballNumber = $row['powerball_number'];
		} else {
			echo "<div>No Participants found.</div>";
		}

		// Display the main numbers and powerball number
		if (!empty($mainNumbers) && !empty($powerballNumber)) {
			sort($mainNumbers);

			echo '
        <div class="withdrawal">
            <p>일반볼: ';

			foreach ($mainNumbers as $number) {
				echo '<span class="t-red">' . trim($number) . '</span>, ';
			}

			echo '</p>
            <p>| 파워볼: <span class="t-red">' . $powerballNumber . '</span></p>
        </div>';
		}

		// Query to fetch user purchases and generate numbers
		$sql = "SELECT * FROM user_purchases t1 JOIN generate_numbers t2 
            ON DATE(t1.date_purchase) = DATE(t2.generated_at) 
            WHERE DATE(t1.date_purchase) = '$date';";
		$result_query = mysqli_query($conn, $sql);

		if (!$result_query) {
			echo "<div>Error executing query: " . mysqli_error($conn) . "</div>";
		} else {
			if (mysqli_num_rows($result_query) > 0) {
				$maxMatches = 0;
				$maxMatchesRows = array();

				while ($row = mysqli_fetch_assoc($result_query)) {
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

				if (!empty($maxMatchesRows)) {
					echo '<h4 style="font-weight: 500; color:red">당첨자</h4><br>';
					$winnerCount = 0;

					foreach ($maxMatchesRows as $row) {
						$matchingNumbers = array_intersect(explode(',', $row['selected_numbers']), explode(',', $row['main_numbers']));
						$matchingPowerball = ($row['powerballs'] == $row['powerball_number']);
						$numMatches = count($matchingNumbers);

						if ($matchingPowerball) {
							$numMatches++;
						}

						$query = "SELECT winning_amount FROM user_purchases 
                              WHERE DATE(date_purchase) = '$date' 
                              ORDER BY `date_purchase` DESC";
						$query_run = mysqli_query($conn, $query);

						$total_winning = 0;

						while ($num = mysqli_fetch_assoc($query_run)) {
							$total_winning += $num['winning_amount'];
						}

						if ($numMatches >= 1 && $numMatches <= 6) {
							$winnerCount++;
							$columnPrize = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$originalUsername = $row['username'];
							$convertedUsername = formatAsterisks($originalUsername);

							$averagePrizePerWinner = ($winnerCount > 0) ? $total_winning / $winnerCount : 0;

							$selectedNumbers = explode(',', $row["selected_numbers"]);
							sort($selectedNumbers);
							$sortedNumbers = implode(', ', $selectedNumbers);

							$matchingNumbersString = (!empty($matchingNumbers)) ? implode(', ', $matchingNumbers) : 'No Match';

							$sortedMatchingNumbers = explode(', ', $matchingNumbersString);
							sort($sortedMatchingNumbers);
							$sortedMatchingNumbersString = implode(', ', $sortedMatchingNumbers);

							echo '
                        <div class="withdrawal">
                            <p><img src="asset/images/ico_prize.png"></p>
                            <p>ID: ' . $convertedUsername . ' </p>
                            <p>| 선택한 번호: ' . $sortedNumbers . ' </p>
                            <p>| 파워볼: ' . $row["powerballs"] . ' </p>
                            <p>| (' . $row["modes"] . ')</p>
                            <p>| 일치번호: <span class="t-red">' . $sortedMatchingNumbersString . '</span></p>
                            <p>| 파워볼 매치: <span class="t-red">' . ($matchingPowerball ? $row['powerballs'] : 'No Match') . '</span></p>
                            <p>| 당첨금액: ' . number_format($row["to_received"]) . ' ₩</p>
                        </div>';
						}
					}
					echo '<h4 style="font-weight: 500; color:red">전일당첨자수: ' . $winnerCount . '</h4><br>';
				} else {
					echo "<div>No matching records found after checking purchases.</div>";
				}
			} else {
				echo "<div>No matching records found in the user purchases table.</div>";
			}
		}
		?>
	</div>

</div>

<?php require "includes/footer.php"; ?>