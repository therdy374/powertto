<?php
$page_title = "Login Form";

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
                        <h5>Login Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="login-code.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="login_now_btn" class="btn btn-primary">Submit</button>

                                <a href="reset-password.php" class="float-end text-decoration-none text-dark mt-2"> Forgot Password? </a>
                            </div>

                        </form>
                        <hr>
                        <span>Did not receive your Verification Email?<a href="resend-email.php" class="text-decoration-none text-danger"><strong>Resend</strong> </a></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>