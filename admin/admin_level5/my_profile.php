<div class="col-sm-12 col-xl-6">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Admin Information</h6>
        <div class="accordion" id="accordionExample">
          
            <div class="accordion-item bg-transparent">
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
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        referal_code
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?php
                        echo "Master Code: " .$master."<br>";
                        echo "Your Referal Code: " .$referal_code."<br>";
                        echo "Your Referal Points: " .$referal_points. "<br>";
                        echo "Your Referal Links: 
                        <a href='http://localhost/phpproject/powertto/join_02.php?refer=".$referal_code."'>
                        http://localhost/phpproject/powertto/join_02.php?refer=".$referal_code."</a>" ;
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>