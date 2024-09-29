<?php
$page_title = "Registration Form";

include 'inc/header.php';

include 'inc/navbar.php';


?>
<div class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <?php alertMessage(); ?>
        <div class="card shadow">
          <div class="card-header">
            <h5>Registration Form</h5>
          </div>
          <div class="card-body">

            <form action="reg-code.php" method="POST">
              <div class="form-group mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" name="name" class="form-control">
              </div>

              <label for="" class="form-label">Phone Number</label><br>
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="phone1" placeholder="XXXX" aria-label="Username">
                &nbsp;
                <input type="text" class="form-control" name="phone2" placeholder="XXX" aria-label="Server">
                &nbsp;
                <input type="text" class="form-control" name="phone3" placeholder="XXXX" aria-label="Server">&nbsp;
                <span class="mt-2 text-danger">(Ex. 0965 588 8208)</span>
              </div>

              <label for="exampleInputEmail1" class="form-label">Email User ID</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="userid1" placeholder="(example)" aria-label="Username">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" name="userid2" placeholder="(gmail.com)" aria-label="Server">
              </div>

              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="email1" placeholder="(example)" aria-label="Username">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" name="email2" placeholder="(gmail.com)" aria-label="Server">
              </div>

              <div class="form-group mb-3">
                <label for="" class="form-label">Date of Birth</label>
                <input type="text" name="bod" placeholder="03/07/86" class="form-control">
              </div>


              <div class="form-group mb-3">
                <label for="" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
              </div>
              <div class="form-group mb-3">
                <label for="" class="form-label">Confirm Password</label>
                <input type="password" name="con_password" class="form-control">
              </div>
              <button type="submit" name="register_btn" class="btn btn-primary">Submit</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include 'inc/footer.php';
?>