<?php
//session_start(); // Add session_start() to the beginning of your script

include './includes/connect.php';
include './config/function.php';

if (isset($_POST['uname'])) {

  $userid = $_POST['userid'];

  $check_userid = "SELECT * FROM users WHERE userid = '$userid'";
  $check_result = mysqli_query($conn, $check_userid);

  if (empty($userid)) {
    $_SESSION['status'] = "Please fill all the fields.";
    header("Location: newreg.php");
    exit(); // Exit to prevent further execution
  }

  if (mysqli_num_rows($check_result) > 0) {
    $_SESSION['status'] = "The User ID is already exist on the database";
  } else {
    $_SESSION['status'] = "사용 가능한 아이디입니다.";
  }

  // Retain the value in the input field
  $userid_value = htmlspecialchars($userid);

  // Redirect to the same page with userid in URL
  header("Location: newreg.php?userid=$userid_value");
  exit;
}

// Check if userid is set in URL to retain its value
$userid_value = isset($_GET['userid']) ? $_GET['userid'] : '';
?>

<form method="post" action="">
  <tr>
    <th><em>*</em> 아이디</th>
    <td class="m-flex">
      <input type="text" name="userid" class="w250 mw30p" value="<?php echo $userid_value; ?>" />
      <span class="form-sub-desc-r ml10">※ ID는 4~16자리입니다</span>
      <button type="submit" name="uname" class="btn-comm btn-k mw70 ml5">중복확인</button>
      <?php if (isset($_SESSION['status'])) : ?>
        <div><?php echo $_SESSION['status']; ?></div>
        <?php unset($_SESSION['status']); // clear the status after displaying ?>
      <?php endif; ?>
    </td>
  </tr>
</form>
