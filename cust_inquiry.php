<?php
$page_title = "Customer Inquiry";

require "./includes/menubar.php";
?>
<style>
    /* Existing CSS styles */
    a:link,
    a:visited {
        color: #fff;
        font-family: 'Noto Sans KR', 'Apple SD Gothic Neo', 'Malgun Gothic', '맑은 고딕', 'san-serif';
        text-decoration: none;
    }

    @media screen and (max-width: 768px) {
        .btn-comm {
            width: 100%;
            margin: auto;
        }

        .table-col th,
        .table-col td {
            display: block;
            width: 100%;
        }
    }

    /* New CSS to add line below p element */
    .user-message {
        border-bottom: 4px solid black;
        padding-bottom: 10px;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    /* New CSS to align admin answer in one line */
    .admin-answer {
        display: flex;
        align-items: center;
    }
</style>

<section class="container">
    <h1 class="content-tit visual04"><span>1:1문의</span></h1>
    <div class="header">
        <h2>1:1문의</h2>
    </div>
    <div class="contents">
    <div class="inner-contents">

<?php
include "./includes/connect.php";
date_default_timezone_set('Asia/Seoul');

$user_id = $_GET['id'];
// Use prepared statement to prevent SQL injection
$sql = "SELECT * FROM customer_service WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $message = $row['message'];
    $title = $row['title'];
    $date_message = $row['date_message'];
    $reply_message = $row['reply_message'];
?>
    <div>
        <table cellpadding="0" cellspacing="0" class="table-col">
            <tbody>
                <tr>
                    <th class="w10p"><em>※</em> 제목</th>
                    <td>
                        <input type="text" name="bank_name" class="w250 mw100p" value="<?= $title; ?>" readonly />
                    </td>
                </tr>
                <tr>
                    <th class="w10p"><em>※</em> 작성자</th>
                    <td>
                        <input type="text" name="name" class="w250 mw100p" value="<?= htmlspecialchars($_SESSION['loggedInUser']['name']) ?>" placeholder="작성자" readonly />
                    </td>
                    <th class="w10p"><em>※</em> 작성일</th>
                    <td>
                        <input type="text" name="date_message" class="w250 mw100p" value="<?= date('Y/m/d', strtotime($date_message)) ?>" readonly />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

<?php
}
?>

<p class="user-message"> 사용자: <?= $message ?></p>

<?php if ($reply_message) : ?>
    <span class="admin-answer">관리자답변: &nbsp; 
        <?php if (is_numeric($reply_message)) : ?>
            <?= number_format($reply_message) ?>
        <?php else : ?>
            <?= htmlspecialchars($reply_message) ?>
        <?php endif; ?>
    </span>
<?php endif; ?>

<div class="btn-cart mt30 al-center">
    <a href="cust_details_req.php" class="btn-comm btn-dpk">목록</a>
</div>

</div>

    </div>
</section><br>

<?php include "./includes/footer.php"; ?>
