<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content bg-dark">

			<form action="/data/admin_edit.php?admin_id=<?php echo $row['id']; ?>" method="POST">
				<div class="modal-header">
					<h5 class="modal-title d-flex align-items-center text-warning">
						<i class="bi bi-person-check-fill me-2"></i>Update admin account
					</h5>
					<button type="reset" class="btn-close shadow-none text-warning" data-bs-dismiss="modal" aria-label="Close">X</button>
				</div>
				<hr>
				<div class="modal-body">
					<span class="badge rounded-pill bg-dark text-danger mb-3 text-wrap lh-base">
						* Note: This is required field of user to make an Update!
					</span>
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6 ps-0 mb-3 text-white">
								<label class="form-label">Firstname</label>
								<input type="text" name="firstname" value="<?php echo $row['username']; ?>" class="form-control bg-light text-dark" required>
							</div>
							<div class="col-md-6 p-0 text-white">
								<label class="form-label">Lastname</label>
								<input type="text" name="lastname" value="<?php echo $row['user_id']; ?>" class="form-control bg-light text-dark" required>
							</div>
							<div class="col-md-12 ps-0 mb-3 text-white">
								<label class="form-label">Email</label>
								<input type="email" name="email" value="<?php echo $row['selected_numbers']; ?>" class="form-control bg-light text-dark" required>
							</div>
							<div class="col-md-6 ps-0 mb-3 text-white">
								<label class="form-label">Username</label>
								<input type="text" name="admin_username" value="<?php echo $row['powerballs']; ?>" class="form-control bg-light text-dark" required>
							</div>
							<div class="col-md-6 p-0 mb-3 text-white">
								<label class="form-label">Password</label>
								<input type="text" name="password" value="<?php echo $row['winning_amount']; ?>" class="form-control bg-light text-dark" required>
							</div>
							<div class="col-md-6 p-0 mb-3 text-white">
								<label class="form-label">Password</label>
								<input type="password" name="password" value="<?php echo $row['winning_amount']; ?>" class="form-control bg-light text-dark" required>
							</div>
						</div>
						<div class="text-center my-1">
							<button type="submit" name="edit" class="btn btn-sm btn-warning rounded py-1 px-1"><i class="bi bi-person-fill-add me-1"></i>Update User</button>
							<button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
						</div>
					</div>
				</div>
			</form>

		</div>
	</div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title d-flex align-items-center text-warning">
					<i class="bi bi-trash3-fill text-danger me-1"></i>Delete Account
				</h5>
				<button type="reset" class="btn-close shadow-none text-warning" data-bs-dismiss="modal" aria-label="Close">X</button>
			</div>
			<div class="modal-body">
				<p class="text-center text-warning">Are you sure you want to Delete!</p>
				<h2 class="text-center text-warning"><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></h2>
			</div>
			<div class="modal-footer">
				<a href="/yesbet/admin/data/admin_delete.php?admin_id=<?php echo $row['admin_id']; ?>" name="" class="btn btn-sm btn-danger"><i class="bi bi-trash3-fill me-1"></i>Yes</a>
				<button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
			</div>
		</div>
	</div>
</div>