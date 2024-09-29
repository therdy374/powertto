<?php
$page_title = "Request_Withdrawal";
require 'includes/header.php';

if (!isset($_SESSION['loggedIn'])) {
?>
    <script>
        window.location.href = 'index.php';
    </script>
<?php
}
?>

<section class="container" style="padding-top: 150px;">
    <h1 class="content-tit visual06"><span>회원</span></h1>
    <div class="header">
        <h2>철회요청</h2>
        <div class="navi">
            <a href="home.php">홈으로</a>
            <span>멤버</span>
            <span>철수</span>
            
        </div>
    </div>
    
    <?php
    include "./includes/connect.php";

    if (isset($_POST['amount_withdraw'])) {
        $name = $_POST['name'];
        $user_id = $_POST['user_id'];
        $message = "$name $user_id " . $_POST['amount_withdrawal'];
        $query = "INSERT INTO `user_request_withdrawal` (`name`, `user_id`, `amount_withdrawal`) VALUES ('$name', '$user_id','$message')";
        $res = mysqli_query($conn, $query);

        if ($query) {
            echo "<script>alert('Your request withdrawal is now pending for approval. Please wait for confirmation. Thank you.')</script>";
        } else {
            echo "<script>alert('Unknown error occured.')</script>";
        }
    }

    ?>

    <div class="contents">
        <div class="desc-main">로또캠프 웹사이트에 오신 것을 환영합니다.</div>
        <div class="desc-sub">충전 지점 요청.</div>

        <form name="login_form" method="post" action="">
            <input type="hidden" name="login" value="1">
            <fieldset class="login-form">
                <input type="hidden" name="user_id" value="<?= $_SESSION['loggedInUser']['user_id']; ?>" placeholder="비밀번호"><br>

                <input type="hidden" name="name" value="<?= $_SESSION['loggedInUser']['name']; ?>" placeholder="아이디"><br>
                <div>
                    <textarea name="amount_withdrawal" rows="4" style="width: 495px;" placeholder="청구금액인출" required></textarea>
                </div>

                <button type="submit" name="amount_withdraw" class="btn-comm btn-r mb10" >의뢰서를 내다 </button>

            </fieldset>
        </form>

        <div class="txt-login mt50">※ 로그인 한지 6개월이 경과하신 분은 비밀번호를 반드시 변경하여 주시기 바랍니다. </div>

    </div>
</section>

<?php require './includes/footer.php'; ?>