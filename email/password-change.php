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
                        
                        <form action="reset-code.php" method="POST">
                            <input type="text" name="password_token" value="<?php if(isset($_GET['token'])){ echo $_GET['token'];} ?>">

                            <div class="form-group mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="text" name="email" value="<?php if(isset($_GET['email'])){ echo $_GET['email'];} ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label">New Password</label>
                                <input type="password" name="new_password" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control">
                            </div>
                            
                            <div class="form-group">    
                                <button type="submit" name="password_update" class="btn btn-success w-100">Update Password</button>
                            </div>
                        </form>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>