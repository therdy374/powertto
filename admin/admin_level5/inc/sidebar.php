        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index_L4.php" class="navbar-brand mx-4 mb-3">
                    <h5 class="text-primary"><i class="fa fa-user-edit me-2"></i><?php echo $_SESSION['name']; ?>-mode</h5>
                </a>

                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="assets/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <div class="datetime" style="font-size: small;">
                            <div class="time text-warning">
                                <i class="fa fa-clock me-lg-2"></i>
                                <span id="hour">00</span>:
                                <span id="minutes">00</span>:
                                <span id="seconds">00</span>
                                <span id="period">AM</span>
                            </div>
                            <div class="date text-warning">
                                <span id="dayname">Day</span>,
                                <span id="month">Month</span>
                                <span id="daynum">00</span>,
                                <span id="year">Year</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="navbar-nav w-100">
                    <!-- <a href="dashboard.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>월금액 세분화</a> -->
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>사용자 관리</a> 
                        <div class="dropdown-menu bg-transparent border-0" style="font-size: small;">
                            <a href="index.php?view_users" class="dropdown-item">사용자리스트</a> 
                            <a href="index.php?list_user_purchase" class="dropdown-item">구매목록</a>
                            <a href="index.php?deposit_users" class="dropdown-item">입금관리</a>
                            <a href="index.php?view_users_withdrawal" class="dropdown-item">출금관리</a> 
                            
                            <a href="index.php?payment_history" class="dropdown-item">당첨지급내역</a>
                            <a href="index.php?daily_details_fee" class="dropdown-item">참여금액 내역</a> 
                            <a href="index.php?daily_prize_fee" class="dropdown-item">당첨금액 내역</a>
                            <a href="index.php?admins_fee" class="dropdown-item">1일 별 수수료 내역</a> 

                        </div>
                    </div> -->

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-user me-2"></i>관리자 계정</a>
                        <div class="dropdown-menu bg-transparent border-0" style="font-size: small;">
                            <!-- <a href="index_L4.php?view_admin" class="dropdown-item">관리자관리</a> -->
                            <!-- <a href="index.php?view_admin_L1" class="dropdown-item">Level 1</a>
                            <a href="index.php?view_admin_L2" class="dropdown-item">Level 2</a>
                            <a href="index.php?view_admin_L3" class="dropdown-item">Level 3</a> -->
                            <a href="index_L5.php?view_admin_L5" class="dropdown-item">Level 5</a>
                            <!-- <a href="index.php?view_admin_L5" class="dropdown-item">Level 5</a> -->
                            <!-- <a href="index.php?users_credit" class="dropdown-item">회원목록</a> -->
                        </div>
                    </div>
                    
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>설정</a>
                        <div class="dropdown-menu bg-transparent border-0" style="font-size: small;">
                        <a href="index.php?winning_numbers" class="dropdown-item">당첨번호 추첨</a>
                        <a href="index.php?comparetable" class="dropdown-item">매칭우승자</a> 
                        <a href="index.php?terms_condition" class="dropdown-item">약관 및 조항</a>
                        <a href="index.php?announcement" class="dropdown-item">공지사항 설정</a>
                    
                        </div>
                    </div> -->

        
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->