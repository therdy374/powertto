<div class="col-sm-12 col-xl-6">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Admin Informartion</h6>
        <div class="accordion" id="accordionExample">

            <?php
            $admin_id = $_SESSION['id'];
            $master = $_SESSION['parent_name'];

            $admin_query = "SELECT * FROM admins WHERE id = $admin_id";
            $query_run = mysqli_query($conn, $admin_query);

            while ($run_query = mysqli_fetch_array($query_run)) {
                $referal_code = $run_query['referal_code'];
                $referal_points = $run_query['referal_points'];
                $username = $run_query['username'];
                $admin_credit = $run_query['admin_credit'];
            }
            ?>

            <div class="accordion-item bg-transparent">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" autofocus>
                        Admin Accounts Balance
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?php
                        echo "Master Code: " . $master . "<br>";
                        echo "Admin Username: " . $username . "<br>";
                        echo "Admin Current Balance: ₩ " . number_format($admin_credit) . "<br><br>";
                        ?>

                        <?php include_once("./data/admin_recharge.php"); ?>
                        <div class="d-flex">
                            <a href="#adminRecharge<?php echo $admin_id ?>" class="btn btn-primary text-light btn-md mx-0 my-2" data-bs-toggle="modal"><i class="bi bi-plus-square me-2"></i>Admin Recharge</a>
                        </div>
                   
                    </div>

                </div>

            </div><br>

            <?php
            include "./inc/connect.php";

            $admin_id = $_SESSION['id'];
            $master = $_SESSION['parent_name'];

            $admin_query = "SELECT * FROM admins WHERE id = $admin_id";
            $query_run = mysqli_query($conn, $admin_query);

            while ($run_query = mysqli_fetch_array($query_run)) {
                $referal_code = $run_query['referal_code'];
                $referal_points = $run_query['referal_points'];
            }
            ?>
            <div class="accordion-item bg-transparent">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Referal Code
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?php
                        echo "Master Code: " . $master . "<br>";
                        echo "Admin Username: " . $username . "<br>";
                        echo "Your Referal Points: " . $referal_points . "<br>";
                        echo "Your Referal Links: 
                        <a href='http://localhost/phpproject/powertto/join_02.php?refer=" . $referal_code . "'>
                        http://localhost/phpproject/powertto/join_02.php?refer=" . $referal_code . "</a>";
                        ?>
                    </div>
                </div>
            </div><br>

            <!-- <div class="accordion-item bg-transparent">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Accordion Item #3
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Dolore eos dolor tempor justo sea eos amet eos kasd dolor, et diam tempor lorem dolores vero. Stet dolore gubergren nonumy diam. Consetetur sit takimata magna invidunt, dolore sea amet consetetur ea et rebum, invidunt et amet sit sea. Dolor eirmod sed magna sadipscing sadipscing lorem lorem sed, sit lorem.
                    </div>
                </div>
            </div> -->

        </div>
    </div>
</div>