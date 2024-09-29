<?php
include "inc/connect.php";

if (isset($_POST['add_newAdmin'])) {
	$parent_name = ($_POST['parent_name']);
	$name = ($_POST['name']);
	$username = strtolower($_POST['username']);
	$password = ($_POST['password']);
	$phone = ($_POST['phone']);
	$admin_level = ($_POST['admin_level']);
	$percentage = ($_POST['percentage']);
	$referal_code = strtoupper(bin2hex(random_bytes(4)));

	$koreanPattern = '/[\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}]/u'; // Hangul syllables and Hangul Jamo
	// Check if the input contains Korean characters
	if (preg_match($koreanPattern, $username)) {
		echo "<script> alert('아이디는 영문,숫자 4자 이상가능합니다.\\n 숫자만은 불가합니다.');</script>";
		exit;
	}

	$check_admin_id = "SELECT * FROM admins WHERE username = '$username'";
	$check_result = mysqli_query($conn, $check_admin_id);

	if (mysqli_num_rows($check_result) > 0) {

		echo "<script> alert('이미 사용중인 아이디입니다.SORI')</script>";
		echo "<script> window.location.href = 'index.php?view_admin'; </script>";
	} else {


		$bycrypt_password = password_hash($password, PASSWORD_BCRYPT);

		$query = "INSERT INTO admins (parent_name,name,username,password,phone,verify_status,admin_level,referal_code,referal_points,percentage) 
                        VALUES ('$parent_name','$name','$username','$bycrypt_password','$phone','1','$admin_level','$referal_code','0','$percentage')";

		$query_run = mysqli_query($conn, $query);

		if ($query_run) {
			// sendemail_verify("$name", "$combine_email", "$verify_token");

			echo "<script>alert('새 관리자가 이제 추가됨.')</script>";
			echo "<script> window.location.href = 'index.php?view_admin'; </script>";
		} else {
			echo "Error: " . mysqli_error($conn);
		}
	}
}

?>

<div class="modal fade" id="add_admin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content bg-dark">
			<form action="" method="POST">
				<div class="modal-header">
					<h5 class="modal-title d-flex align-items-center text-warning">
						<i class="bi bi-person-fill-add me-2"></i>Add new admin
					</h5>
					<button type="reset" class="btn-close shadow-none text-warning" data-bs-dismiss="modal" aria-label="Close">X</button>
				</div>
				<hr>
				<div class="modal-body">
					<span class="badge rounded-pill bg-dark text-danger mb-3 text-wrap lh-base">
						Note: This is required field of user to make an add! Please fill the all field required!
					</span>
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12 ps-0 mb-3 text-white">
								<label class="form-label">Affiliated Agent*</label>
								<input type="text" name="parent_name" class="form-control bg-light text-dark" value="<?php echo $_SESSION['referal_code']; ?>" readonly>
							</div>
							
							<div class="col-md-6 ps-0 mb-3 text-white">
								<label class="form-label">Agent Name*</label>
								<input type="text" name="name" class="form-control bg-light text-dark" required>
							</div>

							<div class="col-md-6 ps-0 mb-3 text-white">
								<label class="form-label">Username*</label>
								<input type="text" name="username" class="form-control bg-light text-dark" required>
							</div>

							<div class="col-md-6 ps-0 mb-3 text-white">
								<label class="form-label">Password*</label>
								<input type="password" name="password" class="form-control bg-light text-dark" required>
							</div>

							<div class="col-md-6 ps-0 mb-3 text-white">
								<label class="form-label">Phone Number*</label>
								<input type="number" name="phone" class="form-control bg-light text-dark" required>
							</div>

							<div class="col-md-6 mb-3 text-white">
								<label class="form-label">Agent level</label>
								<select class="form-select form-select-md bg-light text-dark" aria-label=".form-select-md example" name="admin_level" required>
									<option selected disabled>Agent Level</option>
									<option value="1">One (1)</option>
									<option value="2">Two (2)</option>
									<option value="3">Three (3)</option>
									<option value="4">Four (4)</option>
									<option value="5">Five (5)</option>
									<option value="5">Six (6)</option>
								</select>
							</div>

							<div class="col-md-6 mb-3 text-white">
								<label class="form-label">Percentage</label>
								<select class="form-select form-select-md bg-light text-dark" aria-label=".form-select-md example" name="percentage" required>
									<option selected disabled>Percentage</option>
									<option value="10%">10%</option>
									<option value="20%">20%</option>
									<option value="30%">30%</option>
									<option value="40%">40%</option>
									<option value="50%">50%</option>
									<option value="60%">60%</option>
									<!-- <option value="70%">70%</option>
									<option value="80%">80%</option>
									<option value="90%">90%</option>
									<option value="100%">100%</option> -->
								</select>
							</div>
							<!-- <div class="col-md-3 mb-3 text-white">
								<label class="form-label">Is Ban</label>
								<br />
								<input type="checkbox" name="is_ban" style="width:20px;height:20px" />
							</div> -->
							<!-- <input type="hidden" name="user_type" value="user" class="form-control bg-light" required> -->
						</div>
						<div class="text-center my-1">
							<button type="submit" name="add_newAdmin" class="btn btn-sm btn-warning rounded py-1 px-1 me-2"><i class="bi bi-person-fill-add me-1"></i>Save</button>
							<button type="button" class="btn btn-sm btn-secondary rounded py-1 px-1 me-2" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>