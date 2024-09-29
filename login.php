<?php
$page_title = "LOGIN PAGE";
include "includes/header.php";


if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    redirect('index.php', 'You are already logged in.');
    exit(0);
}
?>
<!-- Rest of your HTML code -->
<style>
    footer .warning {
        background: #4d5860;
        text-align: center;
        padding: 15px 0;
        color: #fff;
        margin-top: 8%;
    }

    .menu-open header::before {
        height: 60px;
    }
</style>

<section class="container" style="padding-top: 160px">
    <h1 class="content-tit visual06"><span>회원</span></h1>
    <div class="header">
        <h2>로그인</h2>
        <div class="navi">
            <a href="index.php">홈으로</a>
            <span>회원</span>
            <span>로그인</span>
        </div>
    </div>
    <div class="contents">

        <div class="desc-main"> 파워또에 오신 것을 환영합니다.</div>
        <div class="desc-sub">로그인 하시면 다양한 서비스를 이용하실 수 있습니다.</div>
        <?php alertMessage(); ?>

        <form name="login_form" method="POST" action="login-code.php">
            <input type="hidden" name="login" value="1">
            <fieldset class="login-form">
                <div>
                    <input type="text" name="userid" id="userid" placeholder="사용자 ID">
                    <input type="password" name="password" id="passwd" placeholder="비밀번호">
                </div>
                <div class="auto-login-w">
                    <label><!--input type="checkbox" name=""> 자동 로그인--></label>
                    <div>
                        <!-- <a href="../w_member/id_find.php" title="아이디 찾기">아이디 찾기</a> -->
                        <!-- <a href="password_find.php" title="비밀번호를 잊어버렸습니까?">비밀번호를 잊어버렸습니까?</a> -->
                    </div>
                </div>

                <button type="submit" class="btn-comm btn-r mb10" name="userLoginBtn">로그인</button>
                <a href="join.php"><button type="button" class="btn-comm btn-bl">회원가입</button></a>
            </fieldset>
        </form>

        <div class="txt-login mt50">※ 로그인 한지 6개월이 경과하신 분은 비밀번호를 반드시 변경하여 주시기 바랍니다. </div>

    </div>
</section>

<?php require './includes/footer.php'; ?>