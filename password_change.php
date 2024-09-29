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
        <h2>새 암호 만들기</h2>
        <div class="navi">
            <a href="index.php">홈으로</a>
            <span>회원</span>
            <span>새 암호 만들기</span>
        </div>
    </div>
    <div class="contents">

        <div class="desc-main">파워또에 오신 것을 환영합니다.</div>
        <div class="desc-sub">암호를 재설정하려면 유효한 이메일을 입력하십시오!</div>

        <fieldset class="login-form">
            <form action="reset-code.php" method="POST">
                <input type="hidden" name="password_token" value="<?php if (isset($_GET['token'])) {
                                                                    echo $_GET['token'];
                                                                } ?>">

                <div class="form-group mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="text" name="email" value="<?php if (isset($_GET['email'])) {
                                                                echo $_GET['email'];
                                                            } ?>" class="form-control" readonly>
                    <div id="emailHelp" class="form-text t-red">We'll never share your email with anyone else.</div>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">New Password</label>
                    <input type="password" name="new_password" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control">
                </div>

                <div class="form-group">
                <button type="submit" class="btn-comm btn-bl" name="password_update" >Update Password</button>
                    <!-- <button type="submit" name="password_update" class="btn btn-success w-100">Update Password</button> -->
                </div>
            </form>
        </fieldset>


        <div class="txt-login mt50">※ 수신용 이메일로 비밀번호가 전송 됩니다.<br>비밀번호/아이디 찾기가 불가능한 분께서는 고객센터로 문의 또는 우측 하단의 메모를 남겨주세요.</div>

    </div>

</section>


<?php
require 'includes/footer.php';
?>