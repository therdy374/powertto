<?php require "includes/header.php"; ?>


<!-- <div class="quick-prod-top">
    <div class="con">
        <a href="/ver_02/w_play/lotto_em.php" title="유로밀리언즈" class="quick-prod-em"><img src="/ver_02/asset/images/logo_em.png"><span>245억</span></a>

        <a href="/ver_02/w_play/lotto_cfl.php" title="캐시4라이프" class="quick-prod-cfl"><img src="/ver_02/asset/images/logo_cfl.png"><span>1,000불/매일</span></a>

        <a href="/ver_02/w_play/lotto_pb.php" title="파워볼" class="quick-prod-pb"><img src="/ver_02/asset/images/logo_pb.png"><span>1,343억</span></a>

        <a href="/ver_02/w_play/lotto_mm.php" title="메가밀리언즈" class="quick-prod-mm"><img src="/ver_02/asset/images/logo_mm.png"><span>2,739억</span></a>

        <a href="/ver_02/w_play/lotto_sl.php" title="슈퍼로또플러스" class="quick-prod-sl"><img src="/ver_02/asset/images/logo_sl.png"><span>0억</span></a>

        <a href="/ver_02/w_play/lotto_nl.php" title="뉴욕로또" class="quick-prod-nl"><img src="/ver_02/asset/images/logo_nl.png"><span>152억</span></a>

        <a href="/ver_02/w_play/lotto_lp.php" title="라 프리미티바" class="quick-prod-lp"><img src="/ver_02/asset/images/logo_lp.png"><span>222억</span></a>

        <a href="/ver_02/w_play/lotto_eg.php" title="엘 고르도" class="quick-prod-eg"><img src="/ver_02/asset/images/logo_eg.png"><span>102억</span></a>

        <a href="/ver_02/w_play/lotto_ej.php" title="유로 잭팟" class="quick-prod-ej"><img src="/ver_02/asset/images/logo_ej.png"><span>144억</span></a>
    </div>
</div> -->
<script language="JavaScript">

    function find_sendit() {
        var form = document.id_form;

        if (form.name.value == "") {
            alert("회원님의 이름을 입력해 주세요.");
            form.name.focus();
        } else if (form.birthday.value == "") {
            alert("생년월일를 주세요.");
            form.birthday.focus();
        } else {
            form.submit();
        }
    }

</script>
<section class="container">
    <h1 class="content-tit visual06"><span>회원</span></h1>
    <div class="header">
        <h2>아이디찾기</h2>
        <div class="navi">
            <a href="index.php">홈으로</a>
            <span>회원</span>
            <span>아이디찾기</span>
        </div>
    </div>
    <div class="contents">

        <div class="desc-main">아이디를 잊으셨나요?</div>
        <div class="desc-sub">로또캠프 웹사이트에 오신 것을 환영합니다.<br>회원가입시 입력하신 이름 및 휴대전화번호를 입력하여 주세요.<br>※ 성과 이름을 띄워 등록한경우는 띄워 입력하세요.</div>

        <form method="post" action="id_find_result.php" name="id_form">
            <input type="hidden" name="mode" value="search" />
            <fieldset class="login-form">
                <div>
                    <input type="text" name="name" id="name" placeholder="이름">
                    <input type="text" name="birthday" id="birthday" placeholder="생년월일 - 예)810203">
                    <input type="text" name="phone" id="phone" placeholder="휴대전화 '-' 없이 입력">
                </div>

                <button type="button" class="btn-comm btn-bl" onclick="javascript:find_sendit();">찾기</button>
            </fieldset>
        </form>

        <div class="txt-login mt50">※ 비밀번호/아이디 찾기가 불가능한 분께서는 고객센터로 문의 또는 우측 하단의 '메세지 남기기'에 메세지를 남겨주세요.</div>
    </div>
</section>

<?php require "includes/footer.php"; ?>