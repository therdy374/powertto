<?php
$page_title = "My Page";
require "./includes/menubar.php";

?>

<style>
  .container .contents {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px 20px 30px 20px;
    border: 1px solid #bfbfbf;
    margin-bottom: 20px;
  }

  .btn-cart .a .cancel {
    background-color: green;
  }

  .btn-cart .cancel {
    background-color: gray;
    display: inline-block;
    padding: 15px 20px;
    text-decoration: none;
    color: #fff;

  }

  .btn-cart .cancel:hover {
    background-color: darkgray;

  }

  .btn-dpk {
    background: #f42c6c;
    color: #FFF !important;
    margin-left: 5px;

  }

  .table-col td input[type='text'] {
    height: 40px;
    background: #f6f6f6;
    box-shadow: 2px;
  }

  .table-col th {
    background: #f6f6f6;
    /* padding-left: 28px; */
    font-size: 16px;
    font-weight: 300;
    text-align: left;
    vertical-align: middle;
    letter-spacing: -0.05em;
  }


  @media only screen and (max-width: 600px) {

    .table-col th,
    .table-col td {
      display: block;
      width: 100%;
    }

    .table-col th {
      margin-top: 10px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
    }

    .btn-comm {
      width: 100%;
      margin: auto;
    }

    .cancel {
      width: 100%;
      margin: auto;
    }
  }
</style>

<section class="container">
  <h1 class="content-tit visual04"><span>1:1문의</span></h1>
  <div class="header">
    <h2>마이페이지</h2>
  </div>
  <div class="contents">
    <h3 class="tit-h3">회원정보입력.</h3>

    <div class="inner-contents">

      <?php

      include "./includes/connect.php";
      date_default_timezone_set('Asia/Seoul');

      // Check if the form is submitted
      if (isset($_POST['modify'])) {
        // Retrieve user ID from session
        $user_id = $_SESSION['loggedInUser']['user_id'];

        // Retrieve new password from the form
        $email = $_POST['email'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['c_password'];
        $entered_password = $_POST['password']; // Added line to retrieve entered password

        // Retrieve user's existing password from the database
        $sql_password = "SELECT password FROM users WHERE id=?";
        $stmt_password = mysqli_prepare($conn, $sql_password);
        mysqli_stmt_bind_param($stmt_password, "i", $user_id);
        mysqli_stmt_execute($stmt_password);
        $result_password = mysqli_stmt_get_result($stmt_password);
        $row_password = mysqli_fetch_assoc($result_password);
        $existing_password = $row_password['password'];

        // Check if entered password matches the existing password
        if (!password_verify($entered_password, $existing_password)) {
          echo "<script>alert('기존 비밀번호가 잘못되었습니다.');</script>";
        } elseif ($new_password !== $confirm_password) {
          echo "<script>alert('새로운 비밀번호와 확인 항목이 일치하지 않음');</script>";
        } else {
          // Update the user's password in the database
          $sql_update = "UPDATE users SET email = ?, password = ? WHERE id = ?";
          $stmt_update = mysqli_prepare($conn, $sql_update);

          if ($stmt_update) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt_update, "ssi", $email, $hashed_password, $user_id);
            $success = mysqli_stmt_execute($stmt_update);
            if ($success) {
              echo "<script>alert('비밀번호가 업데이트되었습니다. 로그아웃되었습니다');</script>";
              // Destroy session to automatically logout user
              session_destroy();
              echo ("<script>location.href='login.php'</script>");
            } else {
              echo "<script>alert('Failed to update password.');</script>";
            }
          } else {
            echo "<script>alert('Database error.');</script>";
          }
        }
      }

      // Retrieve user details
      $sql = "SELECT * FROM users WHERE id=?";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "i", $user_id);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $userid = $row['userid'];
        $password = $row['password'];
        $email = $row['email'];
        $dob = $row['bod'];
        $bank_name = $row['bank_name'];
        $bank_acct_num = $row['bank_acct_num'];
        $created_at = $row['created_at'];



      ?>
        <div>
          <form method="post" action="">
            <table cellpadding="0" cellspacing="0" class="table-col">
              <tbody>
                <input type="hidden" name="name" style="width: 100%;" value="<?= $user_id ?>" readonly />
                <tr>
                  <th class="w15p"><em>※</em> 이름</th>
                  <td>
                    <input type="text" name="name" style="width: 100%;" value="<?= htmlspecialchars($_SESSION['loggedInUser']['name']) ?>" readonly />
                  </td>

                  <th class="w15p"><em>※</em>전자 메일</th>
                  <td>
                    <input type="email" name="email" style="width: 100%;" value="<?= $email ?>"  />
                  </td>
                </tr>

                <tr>
                  <th class="w15p"><em>※</em> 아이디</th>
                  <td>
                    <input type="text" name="id" style="width: 100%;" value="<?= $userid ?>" readonly />
                  </td>
                  <th class="w15p"><em>※</em> 기존 비밀번호</th>
                  <td>
                    <input type="password" name="password" style="width: 100%;" value="" placeholder="기존 비밀번호" required />
                  </td>
                </tr>
                <tr>
                  <th class="w15p"><em>※</em> 변경할 비밀번호</th>
                  <td>
                    <input type="password" name="new_password" style="width: 100%;" value="" placeholder="변경할 비밀번호" required />
                  </td>
                  <th class="w15p"><em>※</em> 변경할 비밀번호확인</th>
                  <td>
                    <input type="password" name="c_password" style="width: 100%;" value="" placeholder="변경할 비밀번호확인" required />
                  </td>
                </tr>
                <tr>
                  <th class="w15p"><em>※</em> 예금주 </th>
                  <td>
                    <input type="text" name="name" style="width: 100%;" value="<?= htmlspecialchars($_SESSION['loggedInUser']['name']) ?>" placeholder="작성자" readonly />
                  </td>
                  <th class="w15p"><em>※</em> 생년월일</th>
                  <td>
                    <input type="text" name="dob" style="width: 100%;" value="<?= $dob ?>" readonly />
                  </td>
                </tr>
                <tr>
                  <th class="w15p"><em>※</em> 은행</th>
                  <td>
                    <input type="text" name="bank_name" style="width: 100%;" value="<?= $bank_name ?>" placeholder="작성자" readonly />
                  </td>
                  <th class="w15p"><em>※</em> 계좌번호</th>
                  <td>
                    <input type="text" name="bank_acct_num" style="width: 100%;" value="<?= $bank_acct_num ?>" readonly />
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="btn-cart mt30 al-center">
              <button type="submit" name="modify" class="btn-comm btn-dpk">수정하기</button>
              <a href="home.php" class="btn-comm btn-dpk cancel">취소</a>
            </div>
          </form>
        </div>
      <?php
      }
      ?>

    </div>


  </div>
</section>

<?php include "./includes/footer.php"; ?>