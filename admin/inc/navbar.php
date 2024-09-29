<!-- Navbar Start -->
<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>


    <div class="navbar-nav align-items-center ms-auto">
        <!--Current Accessor-->
        <div class="nav-item dropdown">

            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <!-- <i class="fa fa-envelope me-lg-2"><span class="text-primary" style="font-size: 10px; margin-bottom: 14px;">0</span></i> -->
                <span class="d-none d-lg-inline-flex">현재의 접속자</span>
            </a>

            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <hr class="dropdown-divider">
                <a href="index.php?all_logs" class="dropdown-item text-center">See all Logs</a>
            </div>

        </div>


        <!--New Subscriber-->
        <div class="nav-item dropdown">
            <?php
            include "connect.php";

            $user_inquiry = "SELECT * FROM users WHERE verify_status = '0' ORDER BY created_at DESC";
            $result0 = mysqli_query($conn, $user_inquiry);
            $row_count2 = mysqli_num_rows($result0);

            if ($row_count2 > 0) {

                echo '
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-envelope me-lg-2"><span class="text-primary" style="font-size: 10px; margin-bottom: 14px;">' . $row_count2 . '</span></i>
                    <span class="d-none d-lg-inline-flex">신규 가입자</span>
                </a>';
            } else {
                echo '
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-envelope me-lg-2"><span class="text-primary" style="font-size: 10px; margin-bottom: 14px;">0</span></i>
                    <span class="d-none d-lg-inline-flex">신규 가입자</span>
                </a>';
            }
            ?>


            <?php
            $user_inquiry = "SELECT * FROM users WHERE verify_status = '0' ORDER BY created_at DESC";
            $result0 = mysqli_query($conn, $user_inquiry);


            while ($row = mysqli_fetch_assoc($result0)) {

                echo '
                    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                        <a href="index.php?new_subscriber" class="dropdown-item">
                            <div class="d-flex align-items-center">
                            <img class="rounded-circle" src="assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="ms-2">
                                    <h6 class="fw-normal mb-0">' . $row['name'] . ' </h6>
                                    <small>' . $row['created_at'] . '</small>
                                </div>
                            </div>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item text-center">See all notifications</a>
                    </div>';
            }


            ?>

            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <a href="index.php?new_subscriber" class="dropdown-item">
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src="assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="ms-2">
                            <h6 class="fw-normal mb-0"> </h6>
                            <small>No Pending Request</small>
                        </div>
                    </div>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item text-center">See all notifications</a>
            </div>

        </div>

        <!--Inquiry-->
        <div class="nav-item dropdown">
            <?php
            include "connect.php";

            $user_inquiry = "SELECT * FROM customer_service WHERE status = '답변대기' ORDER BY date_message DESC";
            $result0 = mysqli_query($conn, $user_inquiry);
            $row_count2 = mysqli_num_rows($result0);

            if ($row_count2 > 0) {

                echo '
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-envelope me-lg-2"><span class="text-primary" style="font-size: 10px; margin-bottom: 14px;">' . $row_count2 . '</span></i>
                    <span class="d-none d-lg-inline-flex">고객센터</span>
                </a>';
            } else {
                echo '
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-envelope me-lg-2"><span class="text-primary" style="font-size: 10px; margin-bottom: 14px;">0</span></i>
                    <span class="d-none d-lg-inline-flex">고객센터</span>
                </a>';
            }
            ?>


            <?php

            $user_inquiry = "SELECT * FROM customer_service ORDER BY date_message DESC";
            $result0 = mysqli_query($conn, $user_inquiry);


            while ($row = mysqli_fetch_assoc($result0)) {

                echo '
                    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                        <a href="index.php?users_inquiries" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle" src="assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="ms-2">
                                    <h6 class="fw-normal mb-0">' . $row['name'] . ' </h6>
                                    <small>' . $row['date_message'] . '</small>
                                </div>
                            </div>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item text-center">See all notifications</a>
                    </div>';
            }


            ?>

            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <a href="index.php?users_inquiries" class="dropdown-item">
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src="assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="ms-2">
                            <h6 class="fw-normal mb-0"> </h6>
                            <small>No Pending Request</small>
                        </div>
                    </div>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item text-center">See all notifications</a>
            </div>

        </div>

        <!--withdrawal-->
        <div class="nav-item dropdown">
            <?php
            include "connect.php";

            $user_withdraw = "SELECT * FROM user_request_withdrawal ORDER BY date_withdrawal DESC";
            $result2 = mysqli_query($conn, $user_withdraw);
            $row_count2 = mysqli_num_rows($result2);

            if ($row_count2 > 0) {

                echo '
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-sack-dollar"><span class="text-primary" style="font-size: 10px; margin-bottom: 14px;">' . $row_count2 . '</span></i>
                        <span class="d-none d-lg-inline-flex">출금신청</span>
                    </a>';
            } else {
                echo '
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-sack-dollar"><span class="text-primary" style="font-size: 10px; margin-bottom: 14px;">0</span></i>
                        <span class="d-none d-lg-inline-flex">출금신청</span>
                    </a>';
            }
            ?>


            <?php

            $user_withdraw = "SELECT * FROM user_request_withdrawal ORDER BY date_withdrawal DESC";
            $result2 = mysqli_query($conn, $user_withdraw);


            while ($row = mysqli_fetch_assoc($result2)) {

                echo '
                    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                        <a href="index.php?users_request_withdrawal" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="ms-2">
                                    <h6 class="fw-normal mb-0">' . $row['name'] . ' </h6>
                                    <small>' . $row['date_withdrawal'] . '</small>
                                </div>
                            </div>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item text-center">See all notifications</a>
                    </div>';
            }


            ?>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <a href="index.php?users_request_withdrawal" class="dropdown-item">
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src="assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="ms-2">
                            <h6 class="fw-normal mb-0"> </h6>
                            <small>No Pending Request</small>
                        </div>
                    </div>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item text-center">See all notifications</a>
            </div>

        </div>

        <!--Deposit-->
        <div class="nav-item dropdown">
            <?php
            include "../includes/connect.php";

            $sql = "SELECT * FROM users_request_deposit ORDER BY date_message DESC ";
            $result = mysqli_query($conn, $sql);
            $row_count = mysqli_num_rows($result);

            if ($row_count > 0) {

                echo '
                    <a href="test.php" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-bell me-lg-2"><span class="text-primary" style="font-size: 10px; margin-bottom: 14px;">' . $row_count . '</span></i>
                        <span class="d-none d-lg-inline-flex">입금신청</span>
                    </a>';
            } else {
                echo '
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-bell me-lg-2"><span class="text-primary" style="font-size: 10px; margin-bottom: 14px;">0</span></i>
                        <span class="d-none d-lg-inline-flex">입금신청</span>
                    </a>';
            }
            ?>

            <?php

            $sql = "SELECT * FROM users_request_deposit ORDER BY date_message DESC ";
            $result = mysqli_query($conn, $sql);


            while ($row = mysqli_fetch_assoc($result)) {

                echo '
                <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                    <a href="index.php?user_deposit_request" class="dropdown-item">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle" src="assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <div class="ms-2">
                                <h6 class="fw-normal mb-0">' . $row['name'] . ' </h6>
                                <small>' . $row['date_message'] . '</small>
                            </div>
                        </div>
                    </a>
                    <hr class="dropdown-divider">
                    <a href="#" class="dropdown-item text-center">See all notifications</a>
                </div>';
            }


            ?>

            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <a href="index.php?user_deposit_request" class="dropdown-item">
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src="assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="ms-2">
                            <h6 class="fw-normal mb-0"> </h6>
                            <small>No Pending Request</small>
                        </div>
                    </div>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item text-center">See all notifications</a>
            </div>
        </div>

        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['name']; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <a href="index.php?my_profile" class="dropdown-item">My Profile</a>
                <!-- <a href="#" class="dropdown-item">Settings</a> -->
                <a href="logout.php" class="dropdown-item">Log Out</a>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->