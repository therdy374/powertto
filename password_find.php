<?php
require 'includes/header.php';

$page_title = "Email Resend";
?>


<script language="JavaScript">
    <!--
    function pass_sendit() {
        var form = document.idpass_form;

        if (form.name.value == "") {
            alert("회원님의 이름을 입력해 주세요.");
            form.name.focus();
        } else if (form.email1.value == "") {
            alert("회원님의 E-Mail를 입력해 주세요.");
            form.email1.focus();
            //	} else if(form.email2.value=="") {
            //		alert("회원님의 E-Mail를 입력해 주세요.");
            //		form.email2.focus();
        } else {
            form.submit();
        }
    }
    //
    -->
</script>

<style>
    footer .warning {
    background: #4d5860;
    text-align: center;
    padding: 15px 0;
    color: #fff;
    margin-top: 20px;
}
</style>

<section class="container">
<?php alertMessage(); ?>
    <h1 class="content-tit visual06"><span>회원</span></h1>
    <div class="header">
        <h2>암호 재설정</h2>
        <div class="navi">
            <a href="index.php">홈으로</a>
            <span>회원</span>
            <span>암호 재설정</span>
        </div>
    </div>
    <div class="contents">

        <div class="desc-main">파워또에 오신 것을 환영합니다.</div>
        <div class="desc-sub">암호를 재설정하려면 유효한 이메일을 입력하십시오!</div>

        <form method="POST" action="reset-code.php">
            <fieldset class="login-form">
                <div>
                    <input type="text" name="email" id="login_name" placeholder="아이디(이메일)">
                    <span class="t-red">We'll never share your email with anyone else.</span>
                </div><br>

                <button type="submit" class="btn-comm btn-bl" name="reset_btn" >암호 재설정 링크 전송</button>
            </fieldset>
        </form>

        <div class="txt-login mt50">※ 수신용 이메일로 비밀번호가 전송 됩니다.<br>비밀번호/아이디 찾기가 불가능한 분께서는 고객센터로 문의 또는 우측 하단의 메모를 남겨주세요.</div>

    </div>
</section>


<?php
require 'includes/footer.php';
?>