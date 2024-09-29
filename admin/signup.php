<?php
require_once("./includes/connect.php");

$firstname = $lastname = $admin_username = $email = $password = $conpass = $bank = "";

$firstnameErr = $lastnameErr = $admin_usernameErr = $emailErr = $passwordErr = $conpassErr = $bankErr = "";

if (isset($_POST["btn_signup"])) {

    if (empty($_POST["firstname"])) {
        $firstnameErr = 'firstname is Required!';
    } else {
        $firstname = $_POST['firstname'];
    }

    if (empty($_POST["lastname"])) {
        $lastnameErr = 'lastname is Required!';
    } else {
        $lastname = $_POST['lastname'];
    }

    if (empty($_POST["admin_username"])) {
        $admin_usernameErr = 'Username is Required!';
    } else {
        $admin_username = $_POST['admin_username'];
    }

    if (empty($_POST["email"])) {
        $emailErr = 'email is Required!';
    } else {
        $email = $_POST['email'];
    }

    if (empty($_POST["password"])) {
        $passwordErr = 'Password is Required!';
    } else {
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    if (empty($_POST["conpass"])) {
        $conpassErr = 'confirm password is Required!';
    } else {
        $conpass = $_POST['conpass'];
        $conpass = password_hash($conpass, PASSWORD_DEFAULT);
    }

    if (empty($_POST["bank"])) {
        $bankErr = 'Bank is Required!';
    } else {
        $bank = $_POST['bank'];
    }

    if ($firstname && $lastname && $admin_username && $email && $password && $conpass && $bank) {

        $sql = "SELECT * FROM `tb_admin` WHERE admin_username ='$admin_username' || email = '$email'";
        $result = mysqli_query($con, $sql);
        $num = mysqli_num_rows($result);

        $check_aname = strlen($admin_username);

        if ($check_aname < 5) {
            $admin_usernameErr = "Your username is less than 5 character!";
        } else {

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            } else {

                if ($num > 0) {
                    $admin_usernameErr = "Username or email already exists";
                }

                else if ($_POST['password'] == $_POST['conpass']) {
                    mysqli_query($con, "INSERT INTO `tb_admin` (firstname,lastname,admin_username,email,password,bank) VALUES ('$firstname','$lastname','$admin_username','$email','$password','$bank')");
                    echo "<script>alert('You are now register!')</script>";
                    header("refresh:1;url=signin.php");
                } else {
                    $conpassErr = "Password does not much!";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Yesbet</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/bootstrap.css" rel="stylesheet">
</head>


<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <style>
                        .error {
                            color: red;
                        }
                    </style>
                    <form action="" method="POST">
                        <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="index.html" class="">
                                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Admin</h3>
                                </a>
                                <h3>Sign Up</h3>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" name="firstname" value="<?php echo $firstname; ?>" class="form-control" id="floatingText" placeholder="test">
                                <label for="floatingText">Firstname</label><span class="error"><?php echo $firstnameErr; ?></span>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" name="lastname" value="<?php echo $lastname; ?>" class="form-control" id="floatingText" placeholder="test">
                                <label for="floatingText">Lastname</label><span class="error"><?php echo $lastnameErr; ?></span>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" name="admin_username" value="<?php echo $admin_username; ?>" class="form-control" id="floatingText" placeholder="test">
                                <label for="floatingText">Username</label><span class="error"><?php echo $admin_usernameErr; ?></span>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" name="email" value="<?php echo $email; ?>" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label><span class="error"><?php echo $emailErr; ?></span>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label><span class="error"><?php echo $passwordErr; ?></span>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" name="conpass" class="form-control" id="floatingPassword" placeholder="Confirm Password">
                                <label for="floatingPassword">Confirm Password</label><span class="error"><?php echo $conpassErr; ?></span>
                            </div>

                            <select class="form-select mb-3" name="bank">
                                <option name="bank" name="bank" value="">Bank Name</option>
                                <option name="bank" <?php if ($bank == "1") {
                                                        echo "Selected";
                                                    } ?> value="1">One</option>
                                <option name="bank" <?php if ($bank == "2") {
                                                        echo "Selected";
                                                    } ?> value="2">Two</option>
                                <option name="bank" <?php if ($bank == "3") {
                                                        echo "Selected";
                                                    } ?> value="3">Three</option>
                            </select><span class="error"><?php echo $bankErr; ?></span>

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <a href="">Forgot Password</a>
                            </div>

                            <button type="submit" name="btn_signup" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                            <p class="text-center mb-0">Already have an Account? <a href="signin.php">Sign In</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>