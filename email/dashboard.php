<?php
$page_title = "Dashboard";

include 'inc/header.php';
include 'inc/navbar.php';

require_once '../config/function.php';
require 'authentication.php';

?>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            <?php alertMessage(); ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h5>User Dashboard</h5>
                    </div>
                    <div class="card-body">
                        <h2>May Account </h2>
                        <h5> Name:  <?=$_SESSION['loggedInUser']['name']; ?></h5>
                        <h5> Phome: <?=$_SESSION['loggedInUser']['phone']; ?></h5>
                        <h5> Email: <?=$_SESSION['loggedInUser']['email']; ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>