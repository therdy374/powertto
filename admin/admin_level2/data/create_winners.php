<!-- Add -->
<div class="modal fade" id="addnewwinner" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg ">
		<div class="modal-content bg-dark">
			<form action="" method="POST">
				<div class="modal-header">
					<h5 class="modal-title d-flex align-items-center text-warning">
						<i class="bi bi-person-fill-add me-2"></i>New Winners
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
								<label class="form-label">Whiteballs</label>
								<input type="text" name="whiteballs" class="form-control bg-light text-dark" required>
							</div>

							<div class="col-md-6 p-0 text-white">
								<label class="form-label">Powerballs</label>
								<input type="text" name="powerballs" class="form-control bg-light text-dark" required>
							</div>

							<div class="col-md-6 ps-0 mb-3 text-white">
								<label class="form-label">Winning Amount</label>
								<input type="text" name="winning_amount" class="form-control bg-light text-dark" required>
							</div>

                            <div class="col-md-6 ps-0 mb-3 text-white">
								<label class="form-label">Matched Numbers</label>
								<input type="text" name="match_numbers" class="form-control bg-light text-dark" required>
							</div>
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

// $conn = mysqli_connect("localhost","root","","pos_mgt_system");
include "./inc/connect.php";

if (isset($_POST['add_user'])) {

        $name = $_POST['name'];
        $whiteballs = $_POST['whiteballs'];
        $powerballs = $_POST['powerballs'];
        $winning_amount = $_POST['winning_amount'];
        $match_numbers = $_POST['match_numbers'];

        if($name == '' || $whiteballs == '' || $powerballs == '' || $winning_amount == '' || $match_numbers == '' ){
            echo "<script>alert('Please fill all the available fields')</script>";
            exit();
        }

        $sql = "INSERT INTO winners_participants (name, whiteballs, powerballs, winning_amount, match_numbers) VALUES ('$name', '$whiteballs', '$powerballs', '$winning_amount', '$match_numbers')";

        $res_query = mysqli_query($conn, $sql);

        if ($res_query) {
            echo "<script>alert('The new winners in now announced successfully!')</script>";
            echo "<script>window.open('index.php?view_winners','_self')</script>";
        }
}

