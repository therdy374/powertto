<!-- Add -->
<div class="modal fade" id="winningnumbers" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content bg-dark">
			<form action="" method="POST" onsubmit="return validateForm()">
				<div class="modal-header">
					<h5 class="modal-title d-flex align-items-center text-warning">
						<i class="bi bi-person-fill-add me-2"></i>추첨번호발표
					</h5>
					<button type="reset" class="btn-close shadow-none text-warning" data-bs-dismiss="modal" aria-label="Close">X</button>
				</div>
				<hr>
				<div class="modal-body">
					<span class="badge rounded-pill bg-dark text-danger mb-3 text-wrap lh-base">
						참고: 당첨번호를 추가하려면 ,은 필수 입니다! 모든 숫자를 , 을붙여 모두 입력하십시오!
					</span>
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6 ps-0 mb-3 text-white">
								<label class="form-label">일반볼</label>
								<input type="text" name="main_numbers" class="form-control" placeholder="일반볼 1~28 를 입력하세요. (Ex. XX,XX,XX,XX,XX)" required>
							</div>

							<div class="col-md-6 p-0 text-white">
								<label class="form-label">파워볼</label>
								<input type="text" name="powerball_number" class="form-control" placeholder="파워볼 1 ~ 9 를 입력하세요." required>
							</div>

							<div class="col-md-6 ps-0 mb-3 text-white">
								<label class="form-label">당첨금액</label>
								<input type="text" name="winning_price" class="form-control" placeholder="Winning Amount" oninput="formatNumber(this)" required>
							</div>

							<script>
								function formatNumber(input) {
									let value = input.value.replace(/\D/g, '');
									let formattedValue = Number(value).toLocaleString();
									input.value = formattedValue;
								}

								function validateMainNumbers() {
									let mainNumbersInput = document.querySelector('input[name="main_numbers"]').value;
									let mainNumbers = mainNumbersInput.split(',').map(num => parseInt(num.trim(), 10));

									// Check if exactly 5 numbers are provided
									if (mainNumbers.length !== 5) {
										alert("Please input exactly 5 regular numbers.");
										return false;
									}

									// Check if each number is in the range 1 to 28
									for (let num of mainNumbers) {
										if (isNaN(num) || num < 1 || num > 28) {
											alert("Input the regular numbers from 1 to 28 only.");
											return false;
										}
									}

									// Check for duplicate numbers
									let uniqueNumbers = new Set(mainNumbers);
									if (uniqueNumbers.size !== mainNumbers.length) {
										alert("Numbers should not be repeated.");
										return false;
									}

									return true;
								}

								function validatePowerballNumber() {
									let powerballInput = document.querySelector('input[name="powerball_number"]').value;
									let powerballNumbers = powerballInput.split(',').map(num => parseInt(num.trim(), 10));

									// Check if exactly 1 number is provided
									if (powerballNumbers.length !== 1) {
										alert("Please input exactly 1 powerball number.");
										return false;
									}

									// Check if the number is in the range 1 to 9
									let powerballNumber = powerballNumbers[0];
									if (isNaN(powerballNumber) || powerballNumber < 0 || powerballNumber > 9) {
										alert("Input the powerball numbers from 0 to 9 only.");
										return false;
									}

									return true;
								}

								function validateForm() {
									return validateMainNumbers() && validatePowerballNumber();
								}
							</script>
						</div>
						<div class="text-center my-1">
							<button type="submit" name="add_winning_numbers" class="btn btn-sm btn-warning rounded py-1 px-1 me-2"><i class="bi bi-person-fill-add me-1"></i>발표</button>
							<button type="button" class="btn btn-sm btn-secondary rounded py-1 px-1 me-2" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> 취소</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
include "inc/connect.php";

if (isset($_POST['add_winning_numbers'])) {
	date_default_timezone_set('Asia/Seoul');
	$currentDate = new DateTime();
	$yesterday = $currentDate->modify('-1 day');
	$date = $yesterday->format('Y-m-d H:i:s');

	$whiteballs = $_POST['main_numbers'];
	$powerballs = $_POST['powerball_number'];
	$winning_price = $_POST['winning_price'];

	$winning_price = preg_replace('/[^\d.]/', '', $winning_price);

	if ($whiteballs == '' || $powerballs == '') {
		echo "<script>alert('Please fill all the available fields')</script>";
		exit();
	}

	$sql = "INSERT INTO generate_numbers (main_numbers, powerball_number, winning_price, generated_at) VALUES ('$whiteballs', '$powerballs', '$winning_price', '$date')";
	$res_query = mysqli_query($conn, $sql);

	if ($res_query) {
		echo "<script>alert('추첨번호 발표 완료 데이터베이스 등록 완료')</script>";
		echo "<script>window.open('index.php?winning_numbers','_self')</script>";
	}
}
?>