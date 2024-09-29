<?php
include "inc/header.php";
// include "inc/index_function.php";
?>

<!-- Content Start -->
<div class="content">
    <?php include "inc/navbar.php"; ?>
    <!-- Sale & Revenue Start -->

    
    <div class="container-fluid pt-4 px-4">
        <!-- Total Payment -->
        <div class="row g-4">
            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 1월
            $startDate = date('Y-01-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-01-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT payment FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $jan = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $jan +=  $num['payment'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">1월</p>
                        <h6 class="mb-0"><?php echo number_format($jan); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-02-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-02-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT payment FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $feb = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $feb +=  $num['payment'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">2월</p>
                        <h6 class="mb-0"><?php echo number_format($feb); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-03-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-03-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT payment FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $mar = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $mar +=  $num['payment'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">3월</p>
                        <h6 class="mb-0"><?php echo number_format($mar); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-04-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-04-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT payment FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $apr = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $apr +=  $num['payment'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">4월</p>
                        <h6 class="mb-0"><?php echo number_format($apr); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-05-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-05-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT payment FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $may = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $may +=  $num['payment'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">5월</p>
                        <h6 class="mb-0"><?php echo number_format($may); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-06-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-06-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT payment FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $june = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $june +=  $num['payment'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">6월</p>
                        <h6 class="mb-0"><?php echo number_format($june); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-07-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-07-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT payment FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $july = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $july +=  $num['payment'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">7월</p>
                        <h6 class="mb-0"><?php echo number_format($july); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-08-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-08-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT payment FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $aug = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $aug +=  $num['payment'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">8월</p>
                        <h6 class="mb-0"><?php echo number_format($aug); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-09-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-09-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT payment FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $sept = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $sept +=  $num['payment'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">9월</p>
                        <h6 class="mb-0"><?php echo number_format($sept); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-10-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-10-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT payment FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $oct = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $oct +=  $num['payment'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">10월</p>
                        <h6 class="mb-0"><?php echo number_format($oct); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-11-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-11-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT payment FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $nov = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $nov +=  $num['payment'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">11월</p>
                        <h6 class="mb-0"><?php echo number_format($nov); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-12-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-12-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT payment FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $dec = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $dec +=  $num['payment'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">12월</p>
                        <h6 class="mb-0"><?php echo number_format($dec); ?> ₩</h6>
                    </div>
                </div>
            </div>


            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start date of the current three-month period
            $currentMonth = date('m', strtotime($currentDateTime));
            $startMonth = $currentMonth - ($currentMonth - 1) % 3;
            $startDate = date('Y-m-01', strtotime(date('Y') . '-' . $startMonth . '-01'));

            // Get the end date of the current three-month period
            $endDate = date('Y-m-t', strtotime($startDate . ' +2 months'));

            $sql = "SELECT payment FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $qty = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $qty +=  $num['payment'];
            }

            ?>

            <div class="col-sm-4 col-xl-4 text-center">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie  fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">총 지불약</p>
                        <h6 class="mb-0"><?php echo number_format($qty); ?> ₩</h6>
                    </div>
                </div>
            </div>

        </div><br>
        <!-- Total Amount Prize -->
        <div class="row g-4">
            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-01-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-01-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT winning_amount FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $jan = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $jan +=  $num['winning_amount'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">1월</p>
                        <h6 class="mb-0"><?php echo number_format($jan); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-02-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-02-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT winning_amount FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $feb = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $feb +=  $num['winning_amount'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">2월</p>
                        <h6 class="mb-0"><?php echo number_format($feb); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-03-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-03-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT winning_amount FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $mar = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $mar +=  $num['winning_amount'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">3월</p>
                        <h6 class="mb-0"><?php echo number_format($mar); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-04-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-04-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT winning_amount FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $apr = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $apr +=  $num['winning_amount'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">4월</p>
                        <h6 class="mb-0"><?php echo number_format($apr); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-05-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-05-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT winning_amount FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $may = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $may +=  $num['winning_amount'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">5월</p>
                        <h6 class="mb-0"><?php echo number_format($may); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-06-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-06-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT winning_amount FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $june = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $june +=  $num['winning_amount'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">6월</p>
                        <h6 class="mb-0"><?php echo number_format($june); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-07-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-07-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT winning_amount FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $july = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $july +=  $num['winning_amount'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">7월</p>
                        <h6 class="mb-0"><?php echo number_format($july); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-08-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-08-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT winning_amount FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $aug = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $aug +=  $num['winning_amount'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">8월</p>
                        <h6 class="mb-0"><?php echo number_format($aug); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-09-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-09-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT winning_amount FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $sept = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $sept +=  $num['winning_amount'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">9월</p>
                        <h6 class="mb-0"><?php echo number_format($sept); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-10-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-10-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT winning_amount FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $oct = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $oct +=  $num['winning_amount'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">10월</p>
                        <h6 class="mb-0"><?php echo number_format($oct); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-11-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-11-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT winning_amount FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $nov = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $nov +=  $num['winning_amount'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">11월</p>
                        <h6 class="mb-0"><?php echo number_format($nov); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-12-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-12-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT winning_amount FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $dec = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $dec +=  $num['winning_amount'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">12월</p>
                        <h6 class="mb-0"><?php echo number_format($dec); ?> ₩</h6>
                    </div>
                </div>
            </div>
            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start date of the current three-month period
            $currentMonth = date('m', strtotime($currentDateTime));
            $startMonth = $currentMonth - ($currentMonth - 1) % 3;
            $startDate = date('Y-m-01', strtotime(date('Y') . '-' . $startMonth . '-01'));

            // Get the end date of the current three-month period
            $endDate = date('Y-m-t', strtotime($startDate . ' +2 months'));

            $sql = "SELECT winning_amount FROM user_purchases WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $qty = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $qty +=  $num['winning_amount'];
            }
            ?>

            <div class="col-sm-4 col-xl-4 text-center">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie  fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">총 상금 금액</p>
                        <h6 class="mb-0"> <?php echo number_format($qty); ?> ₩</h6>
                    </div>
                </div>
            </div>

        </div><br>

        <!-- Total 15% Commission -->
        <div class="row g-4">
            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 1월
            $startDate = date('Y-01-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-01-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT admin_fee FROM admins_fee WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $jan = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $jan +=  $num['admin_fee'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">1월</p>
                        <h6 class="mb-0"><?php echo number_format($jan); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-02-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-02-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT admin_fee FROM admins_fee WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $feb = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $feb +=  $num['admin_fee'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">2월</p>
                        <h6 class="mb-0"><?php echo number_format($feb); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-03-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-03-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT admin_fee FROM admins_fee WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $mar = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $mar +=  $num['admin_fee'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">3월</p>
                        <h6 class="mb-0"><?php echo number_format($mar); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-04-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-04-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT admin_fee FROM admins_fee WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $apr = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $apr +=  $num['admin_fee'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">4월</p>
                        <h6 class="mb-0"><?php echo number_format($apr); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-05-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-05-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT admin_fee FROM admins_fee WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $may = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $may +=  $num['admin_fee'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">5월</p>
                        <h6 class="mb-0"><?php echo number_format($may); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-06-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-06-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT admin_fee FROM admins_fee WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $june = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $june +=  $num['admin_fee'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">6월</p>
                        <h6 class="mb-0"><?php echo number_format($june); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-07-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-07-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT admin_fee FROM admins_fee WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $july = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $july +=  $num['admin_fee'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">7월</p>
                        <h6 class="mb-0"><?php echo number_format($july); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-08-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-08-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT admin_fee FROM admins_fee WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $aug = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $aug +=  $num['admin_fee'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">8월</p>
                        <h6 class="mb-0"><?php echo number_format($aug); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-09-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-09-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT admin_fee FROM admins_fee WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $sept = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $sept +=  $num['admin_fee'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">9월</p>
                        <h6 class="mb-0"><?php echo number_format($sept); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-10-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-10-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT admin_fee FROM admins_fee WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $oct = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $oct +=  $num['admin_fee'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">10월</p>
                        <h6 class="mb-0"><?php echo number_format($oct); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-11-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-11-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT admin_fee FROM admins_fee WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $nov = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $nov +=  $num['admin_fee'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">11월</p>
                        <h6 class="mb-0"><?php echo number_format($nov); ?> ₩</h6>
                    </div>
                </div>
            </div>

            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start and end dates for 2월
            $startDate = date('Y-12-01', strtotime(date('Y-m-01', strtotime($currentDateTime))));
            $endDate = date('Y-12-t', strtotime(date('Y-m-t', strtotime($currentDateTime))));

            $sql = "SELECT admin_fee FROM admins_fee WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $dec = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $dec +=  $num['admin_fee'];
            }
            ?>
            <div class="col-sm-4 col-xl-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-sack-dollar fa-3x text-primary"></i>

                    <div class="ms-3">
                        <p class="mb-2 float-end">12월</p>
                        <h6 class="mb-0"><?php echo number_format($dec); ?> ₩</h6>
                    </div>
                </div>
            </div>
            <?php
            date_default_timezone_set('Asia/Seoul');
            $currentDateTime = date('Y-m-d');

            // Get the start date of the current three-month period
            $currentMonth = date('m', strtotime($currentDateTime));
            $startMonth = $currentMonth - ($currentMonth - 1) % 3;
            $startDate = date('Y-m-01', strtotime(date('Y') . '-' . $startMonth . '-01'));

            // Get the end date of the current three-month period
            $endDate = date('Y-m-t', strtotime($startDate . ' +2 months'));

            $sql = "SELECT admin_fee FROM admins_fee WHERE `date_purchase` BETWEEN '$startDate' AND '$endDate' ORDER BY `date_purchase` DESC";

            $query_run = mysqli_query($conn, $sql);

            $admins_fee = 0;
            while ($num = mysqli_fetch_assoc($query_run)) {
                $admins_fee +=  $num['admin_fee'];
            }
            ?>

            <div class="col-sm-4 col-xl-4 text-center">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie  fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 float-end">총 수수료</p>
                        <h6 class="mb-0"> <?php echo number_format($admins_fee); ?> ₩</h6>
                    </div>
                </div>
            </div>
        </div><br>
       
    </div>

    
    <?php include "inc/footer.php"; ?>