<!-- Add -->
<div class="modal fade" id="create_deposit_users" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content bg-dark">
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center text-warning">
                        <i class="bi bi-person-fill-add me-2"></i>Deposit Users
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
                                <label class="form-label">User Id</label>
                                <input type="text" name="user_id" class="form-control bg-light text-dark" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3 text-white">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control bg-light text-dark" required>
                            </div>

                            <div class="col-md-6 p-0 text-white">
                                <label class="form-label">Amount Deposit</label>
                                <input type="text" name="amount_deposit" class="form-control bg-light text-dark" required>
                            </div>
                        </div>
                        <div class="text-center my-1">
                            <button type="submit" name="add_user" class="btn btn-sm btn-warning rounded py-1 px-1 me-2"><i class="bi bi-person-fill-add me-1"></i>Deposit</button>
                            <button type="button" class="btn btn-sm btn-secondary rounded py-1 px-1 me-2" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

$conn = mysqli_connect("localhost", "root", "", "pos_mgt_system");

if (isset($_POST['add_user'])) {

    $users_id = $_POST['user_id'];
    $name = $_POST['name'];
    $amount_deposit = $_POST['amount_deposit'];

    $sql = "INSERT INTO deposit_mgt (user_id, name, amount_deposit) VALUES ('$users_id', '$name', '$amount_deposit')";
    $res_query = mysqli_query($conn, $sql);

    $sql2 = "UPDATE `users` SET `credit`='$amount_deposit' WHERE id = $users_id";
    $res_query = mysqli_query($conn, $sql2);

    if ($res_query) {
        echo "<script>alert('Daposit already loaded successfully!')</script>";
        echo "<script>window.open('index.php?deposit_users','_self')</script>";
    }
}
