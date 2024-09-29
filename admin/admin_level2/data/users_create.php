<!-- Add -->
<div class="modal fade" id="addnewuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content bg-dark">
			<form action="" method="POST">
				<div class="modal-header">
					<h5 class="modal-title d-flex align-items-center text-warning">
						<i class="bi bi-person-fill-add me-2"></i>Add new users
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
								<label class="form-label">Name</label>
								<input type="text" name="name" class="form-control bg-light text-dark" required>
							</div>

							<div class="col-md-6 ps-0 mb-3 text-white">
								<label class="form-label">Email</label>
								<input type="email" name="email" class="form-control bg-light text-dark" required>
							</div>

							<div class="col-md-6 p-0 text-white">
								<label class="form-label">Password</label>
								<input type="password" name="password" class="form-control bg-light text-dark" required>
							</div>

							<div class="col-md-6 ps-0 mb-3 text-white">
								<label class="form-label">Phone Number</label>
								<input type="number" name="phone" class="form-control bg-light text-dark" required>
							</div>

							<div class="col-md-3 mb-3 text-white">
								<label class="form-label">Is Ban</label>
								<br />
								<input type="checkbox" name="is_ban" style="width:20px;height:20px" />
							</div>
							<!-- <input type="hidden" name="user_type" value="user" class="form-control bg-light" required> -->
						</div>
						<div class="text-center my-1">
							<button type="submit" name="add_user" class="btn btn-sm btn-warning rounded py-1 px-1 me-2"><i class="bi bi-person-fill-add me-1"></i>Save</button>
							<button type="button" class="btn btn-sm btn-secondary rounded py-1 px-1 me-2" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php

$conn = mysqli_connect("localhost","root","","pos_mgt_system");

if (isset($_POST['add_user'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $bycrypt_password = password_hash($password, PASSWORD_BCRYPT);
        $phone = $_POST['phone'];
        $verify_token = md5(rand());
        $verify_status = 0;
        $is_ban = isset($_POST['is_ban']) == true ? 1 : 0;

        if($name == '' || $email == '' || $password == '' || $verify_token == '' || $is_ban == '' ){
            echo "<script>alert('Please fill all the available fields')</script>";
            exit();
        }

        $sql = "INSERT INTO users (name, email, password, phone, verify_token, verify_status, is_ban) VALUES ('$name', '$email', '$bycrypt_password', '$phone', '$verify_token', '$verify_status', '$is_ban')";

        $res_query = mysqli_query($conn, $sql);

        if ($res_query) {
            echo "<script>alert('Data updated successfully!')</script>";
            echo "<script>window.open('index.php?view_users','_self')</script>";
        }
}

