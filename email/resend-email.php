<?php
require '../config/function.php';

$page_title = "Email Resend";

include 'inc/header.php';
include 'inc/navbar.php';

if (isset($_SESSION['loggedIn'])) {
    redirect('dashboard.php', 'You are already logged in!');
    exit(0);

}
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <?php alertMessage(); ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Resend Email Verification</h5>
                    </div>
                    <div class="card-body">

                        <form action="resend-code.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <button type="submit" name="resend_btn" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>