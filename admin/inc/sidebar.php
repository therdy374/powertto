<?php
// Determine the current page name and query string (if any)
$page = basename($_SERVER['SCRIPT_NAME']);
$query_string = $_SERVER['QUERY_STRING'];

// Function to check if a page is active
function isActive($page_name, $query_param = '')
{
    global $page, $query_string;
    if ($query_param) {
        return $page == $page_name && strpos($query_string, $query_param) !== false;
    }
    return $page == $page_name;
}

// Function to check if a dropdown should be active
function isDropdownActive($items)
{
    foreach ($items as $item) {
        if (isActive($item[0], $item[1])) {
            return true;
        }
    }
    return false;
}

// Define dropdown items
$userManagementItems = [
    ['index.php', 'view_users'],
    ['index.php', 'list_user_purchase'],
    ['index.php', 'deposit_users'],
    ['index.php', 'view_users_withdrawal'],
    ['index.php', 'payment_history'],
    ['index.php', 'daily_details_fee'],
    ['index.php', 'daily_prize_fee'],
    ['index.php', 'admins_fee']
];

$adminAccountItems = [
    ['index.php', 'view_admin'],
    ['index.php', 'view_agent'],
    ['index.php', 'view_admin_L4'],
    ['index.php', 'view_admin_L3'],
    ['index.php', 'view_admin_L2'],
    ['index.php', 'view_admin_L1'],
    ['index.php', 'user_log_failed'],
    ['index.php', 'double_login']
];


$adminComm = [
    // ['index.php', 'commission_history'],
    ['commission_daily.php'],
    ['commission_weekly.php'],
    ['commission_monthly.php'],
  
];



$settingsItems = [
    ['index.php', 'winning_numbers'],
    ['index.php', 'comparetable'],
    ['index.php', 'terms_condition'],
    ['index.php', 'announcement'],

    ['index.php', 'codeWinners'],
    ['index.php', 'chatUsers']
];


?>

<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="index.php" class="navbar-brand mx-4 mb-3">
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
            <a href="dashboard.php" class="nav-item nav-link <?= isActive('dashboard.php') ? 'active' : ''; ?>"><i class="fa fa-tachometer-alt me-2"></i> 월금액 세분화</a>

            <div class="nav-item dropdown <?= isDropdownActive($userManagementItems) ? 'show' : ''; ?>">
                <a href="#" class="nav-link <?= isDropdownActive($userManagementItems) ? 'active' : 'dropdown-toggle'; ?>" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i> 사용자 관리</a>
                <div class="dropdown-menu bg-transparent border-0 <?= isDropdownActive($userManagementItems) ? 'show' : ''; ?>" style="font-size: small;">
                    <a href="index.php?view_users" class="dropdown-item <?= isActive('index.php', 'view_users') ? 'active' : ''; ?>">사용자리스트</a>
                    <a href="index.php?list_user_purchase" class="dropdown-item <?= isActive('index.php', 'list_user_purchase') ? 'active' : ''; ?>">구매목록</a>
                    <a href="index.php?deposit_users" class="dropdown-item <?= isActive('index.php', 'deposit_users') ? 'active' : ''; ?>">입금관리</a>
                    <a href="index.php?view_users_withdrawal" class="dropdown-item <?= isActive('index.php', 'view_users_withdrawal') ? 'active' : ''; ?>">출금관리</a>
                    <a href="index.php?payment_history" class="dropdown-item <?= isActive('index.php', 'payment_history') ? 'active' : ''; ?>">당첨지급내역</a>
                    <a href="index.php?daily_details_fee" class="dropdown-item <?= isActive('index.php', 'daily_details_fee') ? 'active' : ''; ?>">참여금액 내역</a>
                    <a href="index.php?daily_prize_fee" class="dropdown-item <?= isActive('index.php', 'daily_prize_fee') ? 'active' : ''; ?>">당첨금액 내역</a>
                    <a href="index.php?admins_fee" class="dropdown-item <?= isActive('index.php', 'admins_fee') ? 'active' : ''; ?>">1일 별 수수료 내역</a>
                </div>
            </div>

            <div class="nav-item dropdown <?= isDropdownActive($adminAccountItems) ? 'show' : ''; ?>">
                <a href="#" class="nav-link <?= isDropdownActive($adminAccountItems) ? 'active' : 'dropdown-toggle'; ?>" data-bs-toggle="dropdown"><i class="fa-solid fa-user me-2"></i> 관리자 계정</a>
                <div class="dropdown-menu bg-transparent border-0 <?= isDropdownActive($adminAccountItems) ? 'show' : ''; ?>" style="font-size: small;">
                    <a href="index.php?view_admin" class="dropdown-item <?= isActive('index.php', 'view_admin') ? 'active' : ''; ?>">관리자관리</a>
                    <a href="index.php?view_agent" class="dropdown-item <?= isActive('index.php', 'view_agent') ? 'active' : ''; ?>">Admin Agent</a>
                    <a href="index.php?view_admin_L4" class="dropdown-item <?= isActive('index.php', 'view_admin_L4') ? 'active' : ''; ?>">Level 4</a>
                    <a href="index.php?view_admin_L3" class="dropdown-item <?= isActive('index.php', 'view_admin_L3') ? 'active' : ''; ?>">Level 3</a>
                    <a href="index.php?view_admin_L2" class="dropdown-item <?= isActive('index.php', 'view_admin_L2') ? 'active' : ''; ?>">Level 2</a>
                    <a href="index.php?view_admin_L1" class="dropdown-item <?= isActive('index.php', 'view_admin_L1') ? 'active' : ''; ?>">Level 1</a>
                    <a href="index.php?user_log_failed" class="dropdown-item <?= isActive('index.php', 'user_log_failed') ? 'active' : ''; ?>">User Login Failed</a>
                    <a href="index.php?double_login" class="dropdown-item <?= isActive('index.php', 'double_login') ? 'active' : ''; ?>">Double Login Info</a>
                </div>
            </div>
            <!-- Commission histtory List-->
            <div class="nav-item dropdown <?= isDropdownActive($adminComm) ? 'show' : ''; ?>">
                <a href="#" class="nav-link <?= isDropdownActive($adminComm) ? 'active' : 'dropdown-toggle'; ?>" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Commission</a>
                <div class="dropdown-menu bg-transparent border-0 <?= isDropdownActive($adminComm) ? 'show' : ''; ?>" style="font-size: small;">
                    <!-- <a href="index.php?commission_history" class="dropdown-item <?= isActive('index.php', 'commission_history') ? 'active' : ''; ?>">Commission List</a> -->
                    <a href="commission_daily.php" class="dropdown-item <?= isActive('commission_daily.php') ? 'active' : ''; ?>">Commission Daily</a>
                    <a href="commission_weekly.php" class="dropdown-item <?= isActive('commission_weekly.php') ? 'active' : ''; ?>">Commission weekly</a>
                    <a href="commission_monthly.php" class="dropdown-item <?= isActive('commission_monthly.php') ? 'active' : ''; ?>">Commission monthly</a>
                 
                </div>
            </div>


            <div class="nav-item dropdown <?= isDropdownActive($settingsItems) ? 'show' : ''; ?>">
                <a href="#" class="nav-link <?= isDropdownActive($settingsItems) ? 'active' : 'dropdown-toggle'; ?>" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i> 설정</a>
                <div class="dropdown-menu bg-transparent border-0 <?= isDropdownActive($settingsItems) ? 'show' : ''; ?>" style="font-size: small;">
                    <a href="index.php?winning_numbers" class="dropdown-item <?= isActive('index.php', 'winning_numbers') ? 'active' : ''; ?>">당첨번호 추첨</a>
                    <a href="index.php?comparetable" class="dropdown-item <?= isActive('index.php', 'comparetable') ? 'active' : ''; ?>">매칭우승자</a>
                    <a href="index.php?terms_condition" class="dropdown-item <?= isActive('index.php', 'terms_condition') ? 'active' : ''; ?>">약관 및 조항</a>
                    <a href="index.php?announcement" class="dropdown-item <?= isActive('index.php', 'announcement') ? 'active' : ''; ?>">공지사항 설정</a>
                    <a href="index.php?codeWinners" class="dropdown-item <?= isActive('index.php', 'codeWinners') ? 'active' : ''; ?>">Code Winners</a>


                    <a href="index.php?chatUsers" class="dropdown-item <?= isActive('index.php', 'chatUsers') ? 'active' : ''; ?>">Chat Users</a>
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
