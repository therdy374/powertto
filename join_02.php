<?php
require 'includes/header.php';

?>
  <style>
    .container .contents {
      max-width: 1100px;
      margin: 0 auto;
      padding: 20px 20px 30px 20px;
      border: 1px solid #bfbfbf;
      /* background-color: #ffffff; */
      border-radius: 10px;
    }

    .table-col th {
      /* background: #f6f6f6; */
      padding-left: 28px;
      font-size: 16px;
      font-weight: 300;
      text-align: left;
      vertical-align: middle;
      letter-spacing: -0.05em;
    }

    input {
      border: 1px solid #87929d;
      box-sizing: border-box;
      height: 40px;
      outline: none;
      /* background-color: #ffffff; */
    }

    select {
      height: 40px;
      border: 1px solid #87929d;
      box-sizing: border-box;
      outline: none;
      /* background-color: #ffffff; */
    }
  </style>

<section class="container">
  <h1 class="content-tit visual06"><span>회원가입</span></h1>
  <div class="header">
    <h2>가입정보 입력</h2>
  </div>

  
  <form action="reg-code.php" method="POST" name="join_form" enctype="multipart/form-data">

    <div class="contents">
      <div class="inner-contents">
        <h3 class="tit-h3 tit-h3-sub mt50 mo-mt0">
          기본정보
        </h3>
        <?php alertMessage(); ?>

        <table cellpadding="0" cellspacing="0" class="table-col">
          <colgroup>
            <col style="width:200px" class="mw80" />
            <col style="width:auto" />
          </colgroup>


          <tbody>

            <?php

            $userid_value = isset($_GET['userid']) ? $_GET['userid'] : '';

            if (!empty($userid_value)) {
             

              $userid = mysqli_real_escape_string($conn, $userid_value);

              $check_userid = "SELECT * FROM users WHERE userid = '$userid'";
              $check_result = mysqli_query($conn, $check_userid);


              if (mysqli_num_rows($check_result) > 0) {
                $_SESSION['status'] = "이미 사용중인 아이디입니다."; 
              } else {
                $_SESSION['status'] = "사용 가능한 아이디입니다."; 
              }
            }

            ?>

            <tr>
              <th><em>*</em> 아이디</th>
              <td class="m-flex">
                <input type="text" name="userid" class="w250 mw30p" value="<?php echo htmlspecialchars($userid_value); ?>" />
                
                <button type="submit" name="uname" class="btn-comm btn-k mw70 ml5">중복확인</button>
                <br>
                <?php if (isset($_SESSION['status'])) : ?>
                  <span class="form-sub-desc-r ml10"><?php echo $_SESSION['status']; ?></span>
                  <?php unset($_SESSION['status']); ?>
                <?php endif; ?>
              </td>
            </tr>


            <tr>
              <th><em>*</em> 비밀번호</th>
              <td>
                <input type="password" name="password" class="w250 mw100p" />
                <span class="form-sub-desc-r ml10">※ 6~20자리 알파벳+숫자를 혼용하세요, 띄워쓰기금지
                  띄워쓰기금지</span>
              </td>
            </tr>
            <tr>
              <th><em>*</em> 비밀번호 확인</th>
              <td>
                <input type="password" name="con_password" class="w250 mw100p" />
              </td>
            </tr>
          </tbody>
        </table>

        <h3 class="tit-h3 mt80 mo-mt20">회원정보</h3>
        <table cellpadding="0" cellspacing="0" class="table-col">
          <colgroup>
            <col style="width:200px" class="mw80" />
            <col style="width:auto" />
          </colgroup>
          <tbody>

            <tr>
              <th><em>*</em> 이름</th>
              <td>
                <input type="text" name="name" class="w250 mw100p" />
                <span class="form-sub-desc-r ml10">※ 이름은 한글입니다</span>
              </td>
            </tr>

            <tr>
              <th><em>*</em> 출생의 날짜</th>
              <td>
                <input type="text" name="bod" placeholder="MM/DD/YYYY" onfocus="(this.type='date')">
                <span class="form-sub-desc-r ml10">※ 예시: 02/07/2024 (※ 미성년자는 이용할 수 없습니다.)</span>
              </td>
            </tr>

            <tr>
              <th><em>*</em> 전화번호</th>
              <td class="m-flex m-justify-space">
                <span class="tel mw32p"><input type="text" name="phone1" class="w150 mw100p" /></span>
                <span class="tel mw32p"><input type="text" name="phone2" class="w150 mw100p" /></span>
                <input type="text" name="phone3" class="w150 mw32p tel" />
              </td>
            </tr>

            <tr>
              <th><em>*</em> 은행명</th>
              <td>
                <select name="bank_name">
                  <option name="bank" value=""> Select Option</option>
                  <option name="bank" value="농협은행">농협은행</option>
                  <option name="bank" value="국민은행">국민은행</option>
                  <option name="bank" value="기업은행">기업은행</option>
                  <option name="bank" value="하나은행">하나은행</option>
                  <option name="bank" value="신한은행">신한은행</option>
                  <option name="bank" value="우리은행">우리은행</option>
                  <option name="bank" value="상업은행">상업은행</option>
                  <option name="bank" value="카카오뱅크">카카오뱅크</option>
                  <option name="bank" value="토스뱅크">토스뱅크</option>
                  <option name="bank" value="저축은행">저축은행</option>
                  <option name="bank" value="신협">신협</option>
                  <option name="bank" value="새마을금고">새마을금고</option>
                  <option name="bank" value="우체국">우체국</option>
                  <option name="bank" value="수협은행">수협은행</option>
                  <option name="bank" value="경남은행">경남은행</option>
                  <option name="bank" value="부산은행">부산은행</option>
                  <option name="bank" value="대구은행">대구은행</option>
                  <option name="bank" value="전북은행">전북은행</option>
                  <option name="bank" value="광주은행">광주은행</option>
                  <option name="bank" value="제주은행">제주은행</option>
                  <option name="bank" value="SC제일은행">SC제일은행</option>
                  <option name="bank" value="한국씨티은행">한국씨티은행</option>
                  <option name="bank" value="도이치은행">도이치은행</option>
                  <option name="bank" value="게이뱅크">게이뱅크</option>

                </select>
                <span class="form-sub-desc-r ml10">※ 이 필드는 필수 항목입니다 </span>
              </td>
            </tr>
            
            <tr>
              <th><em>*</em>은행계좌번호</th>
              <td>
                <input type="number" name="bank_acct_num" class="w250 mw100p" />
                <span class="form-sub-desc-r ml10">※ 예시: (※ 633-xxxxxx-xxxxx.)</span>
              </td>
            </tr>
            
            <tr>
              <th><em>*</em>코드</th>
              <td>
                <input type="text" name="referal_code" class="w250 mw100p" id="refercode"
                  oninput="updateAffiliatedAgentCode()" />
                <input type="hidden" name="affiliated_agent_code" class="w250 mw100p" id="master" readonly />
                <span class="form-sub-desc-r ml10">※ 없으면 무시합니다</span>
              </td>
            </tr>

          </tbody>
        </table>

        <div class="mt50 al-center mo-mt20">
          <button type="submit" name="register_btn" class="btn-comm btn-bl w100p max-w-5">가입하기</button>
        </div>
      </div>
    </div>
  </form>
</section><br>

<script>
  function updateAffiliatedAgentCode() {
    var referalCode = document.getElementById('refercode').value;

    if (referalCode.length > 0) {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'fetch-agent-code.php?referal_code=' + encodeURIComponent(referalCode), true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {
            try {
              var response = JSON.parse(xhr.responseText);
              if (response.success) {
                document.getElementById('master').value = response.agent_code;
              } else {
                document.getElementById('master').value = ''; // Clear if no match found
                console.error('No agent found for the given referral code.');
              }
            } catch (e) {
              console.error('Failed to parse JSON response:', e);
              document.getElementById('master').value = ''; // Clear if parsing fails
            }
          } else {
            console.error('Request failed with status:', xhr.status);
            document.getElementById('master').value = ''; // Clear on request failure
          }
        }
      };
      xhr.onerror = function () {
        console.error('Request error occurred.');
        document.getElementById('master').value = ''; // Clear on error
      };
      xhr.send();
    } else {
      document.getElementById('master').value = ''; // Clear if input is empty
    }
  }
</script>


<?php
require 'includes/footer.php';

?>