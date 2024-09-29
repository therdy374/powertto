<!-- Add -->
<div class="modal fade" id="adminRecharge<?php echo $admin_id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content bg-dark">
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center text-warning">
                        <i class="bi bi-person-fill-add me-2"></i>Admin Recharge Balance
                    </h5>
                    <button type="reset" class="btn-close shadow-none text-warning" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <hr>
                <div class="modal-body">
                    <span class="badge rounded-pill bg-dark text-danger mb-3 text-wrap lh-base">
                        Note: This is a required field for admin to make a recharge!
                    </span>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3 text-white">
                                <label class="form-label">Admin Id</label>
                                <input type="text" name="username" value="<?php echo $username ?>" class="form-control bg-light text-dark" readonly>
                            </div>
                            <div class="col-md-6 p-0 text-white">
                                <label class="form-label">Admin Balance</label>
                                <input type="text" name="admin_credit" class="form-control bg-light text-dark" oninput="formatNumber(this)" required>
                            </div>
                            <script>
                                function formatNumber(input) {
                                    let value = input.value.replace(/\D/g, '');
                                    let formattedValue = Number(value).toLocaleString();
                                    input.value = formattedValue;
                                }
                            </script>
                        </div>
                        <div class="text-center my-1">
                            <button type="submit" name="adminRecharge" class="btn btn-sm btn-warning rounded py-1 px-1 me-2"><i class="bi bi-person-fill-add me-1"></i>Submit</button>
                            <button type="button" class="btn btn-sm btn-secondary rounded py-1 px-1 me-2" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['adminRecharge'])) {
    $admin_credit = str_replace(',', '', $_POST['admin_credit']); // Remove commas from the formatted number
    $admin_credit = mysqli_real_escape_string($conn, $admin_credit); // Sanitize the input

    $sql = "UPDATE `admins` SET `admin_credit`='$admin_credit' WHERE id='$admin_id'";
    $res_query = mysqli_query($conn, $sql);

    if ($res_query) {
        echo "<script>alert('Admin Recharge submitted successfully!')</script>";
        echo "<script>window.open('index.php?my_profile','_self')</script>";
    } else {
        echo "<script>alert('Error in submitting admin recharge!')</script>";
    }
}
?>
