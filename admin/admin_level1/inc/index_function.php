<?php
include 'connect.php';

function userDeposit()
{
    global $conn;

    $query = "SELECT * FROM deposit_mgt";
    $query_run = mysqli_query($conn, $query);

    $user_deposit = 0;
    while ($num = mysqli_fetch_assoc($query_run)) {
        $user_deposit +=  $num['amount_deposit'];
    }

    echo '
    <div class="col-sm-12 col-xl-4">
        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
            <i class="fa fa-chart-line fa-3x text-primary"></i>
            <div class="ms-3">
                <p class="mb-2">User Deposit</p>
                <h6 class="mb-0">₩'.  number_format($user_deposit); '</h6>
            </div>
        </div>
    </div>
    ';
   

}


?>