<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$database = "u245217918_lottocamp";

$conn = mysqli_connect($host, $user, $pass, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["manual_submit"])) {
        handleManualButtonClick($conn);
    } elseif (isset($_POST["automatic_submit"])) {
        handleAutomaticButtonClick($conn);
    }
}


function handleManualButtonClick($conn)
{
    date_default_timezone_set('Asia/Seoul');
    $currentDateTime = date('Y-m-d H:i:s');

    // $selectedNumbers = isset($_POST["selected_numbers"]) && is_array($_POST["selected_numbers"]) ? implode(",", $_POST["selected_numbers"]) : "";
    // $selectedSingleNumber = isset($_POST["selected_single_number"]) ? $_POST["selected_single_number"] : "";

    $selectedNumbers = $_POST["selected_numbers"];
    $selectedSingleNumber = $_POST["selected_single_number"];

    $name = validate($_POST['name']);
    $user_id = validate($_POST['user_id']);
    $payment = validate($_POST['payment']);
    $winning_amount = validate($_POST['winning_amount']);

    $credit = getUserCredit($conn, $user_id);
    $initialBalance = $credit;
    $finalBalance = $initialBalance - $payment;

    if ($credit == 0 || $credit <= 50000) {
        showError("Sorry! Please Reload your balance!");
    }

    updateCredit($conn, $user_id, $finalBalance);
    updateAdminCredit($conn);

    $query = "INSERT INTO user_purchases (username, user_id, selected_numbers, powerballs, payment, winning_amount, modes, date_purchase)
    VALUES (?, ?, ?, ?, ?, ?, 'Manual', ?)";

    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        die("Error in SQL query preparation: " . mysqli_error($conn));
    }

    // Bind parameters with types
    mysqli_stmt_bind_param($stmt, 'ssssdss', $name, $user_id, $selectedNumbers, $selectedSingleNumber, $payment, $winning_amount, $currentDateTime);


    if (!mysqli_stmt_execute($stmt)) {
        die("Error executing SQL query: " . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);

    // Show success message and redirect
    showSuccess("Your lucky numbers inserted successfully! $selectedNumbers $selectedSingleNumber\\n Your Balance now is ₩ " . htmlspecialchars($finalBalance));
}

function getUserCredit($conn, $user_id)
{
    $query = "SELECT credit FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['credit'];
    } else {
        die("Error in SQL query: " . mysqli_error($conn));
    }
}

function updateCredit($conn, $user_id, $finalBalance)
{
    $sql = "UPDATE `users` SET `credit` = $finalBalance WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error in SQL query: " . mysqli_error($conn));
    }
}

function updateAdminCredit($conn)
{
    $query = "SELECT * FROM admins";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $num = mysqli_fetch_assoc($result);
        $admin_credit = $num['admin_credit'];

        $tot = $admin_credit + 15000;
        $sql = "UPDATE `admins` SET `admin_credit`= $tot";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Error in SQL query: " . mysqli_error($conn));
        }
    } else {
        die("Error in SQL query: " . mysqli_error($conn));
    }
}

function insertUserPurchaseData($conn, $name, $user_id, $selectedNumbers, $selectedSingleNumber, $payment, $winning_amount, $mode, $currentDateTime)
{
    $sql = "INSERT INTO user_purchases (username, user_id, selected_numbers, powerballs, payment, winning_amount, modes, date_purchase)
    VALUES ('$name', '$user_id', '$selectedNumbers', '$selectedSingleNumber', '$payment', '$winning_amount', '$mode', '$currentDateTime')";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    return $result;
}

function showError($message)
{
    echo "<script> alert('$message');</script>";
    echo ("<script>location.href='new.php'</script>");
    exit;
}

function showSuccess($message)
{
    echo "<script>
            alert('$message');
            location.href='list_purchase.php';
        </script>";
    exit;
}

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!--betting -->
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input type="hidden" name="name" value="<?= $_SESSION['loggedInUser']['name']; ?>" required>
    <input type="hidden" name="user_id" value="<?= $_SESSION['loggedInUser']['user_id']; ?>">
    <input type="hidden" name="payment" value="50000">
    <input type="hidden" name="winning_amount" value="35000">
    <input type="text" name="selected_numbers" id="selectedNumbersInput">
    <input type="text" name="selected_single_number" id="selectedSingleNumberInput">

    <div class="lotto-buy-w">
        <div class="number-select-w">
            <h3 class="tit-h3">5 개의 번호를 선택하세요.</h3>
            <!-- 5 numbers -->
            <?php if (isset($_POST["manual"])) : ?>
                <div class="number-select">
                    <?php for ($i = 1; $i <= 28; $i++) : ?>
                        <button type="button" class="number-button" data-number="<?php echo $i; ?>"><?php echo $i; ?></button>
                    <?php endfor; ?>
                </div>
                <br>
                <h3 class="tit-h3 mt30">1개의 파워볼을 선택하세요.</h3>
                <div class="number-select num-power">
                    <?php for ($i = 0; $i <= 9; $i++) : ?>
                        <button type="button" class="single-number-button" data-number="<?php echo $i; ?>"><?php echo $i; ?></button>
                    <?php endfor; ?>
                    <br>
                </div>
            <?php endif; ?>

        </div>
        <div class="number-selected-w">

            <?php if (isset($_POST["manual"])) : ?>
                <h3 class="tit-h3 p-l">선택한 번호</h3>
                <div class="message-box-gy">
                    <div class="general-num" id="selected_numbers">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <span class="selected-number" name="selected_numbers" data-index="<?= $i - 1 ?>"></span>
                        <?php endfor; ?>
                    </div>
                    <span class="selected-single-number bg-pk" name="selectedSingleNumberSpan" id="selectedSingleNumberSpan"></span>
                </div>
            <?php endif; ?>

            <div class="btn-number">
                <button type="submit" name="manual" class="btn-comm-mid btn-gy">Manual</button>
            </div>

            <?php if (isset($_POST["manual"])) : ?>
                <div class="btn-cart">
                    <button type="submit" name="manual_submit" class="btn-comm btn-dpk"><img src="asset/images/ico_in_cart.png" alt="icon" class="mr5">Manual</button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</form>

<script>
    // JavaScript code to handle number button clicks and update selected numbers
    const numberButtons = document.querySelectorAll('.number-button');
    const singleNumberButtons = document.querySelectorAll('.single-number-button');
    const selectedNumbersSpans = document.querySelectorAll('.selected-number');
    const selectedSingleNumberSpan = document.getElementById('selectedSingleNumberSpan');

    let selectedNumbers = [];
    let selectedSingleNumber = '';

    numberButtons.forEach(button => {
        button.addEventListener('click', () => {
            const selectedNumber = button.getAttribute('data-number');

            if (selectedNumbers.includes(selectedNumber)) {
                selectedNumbers = selectedNumbers.filter(number => number !== selectedNumber);
                button.style.backgroundColor = '';
            } else if (selectedNumbers.length < 5) {
                selectedNumbers.push(selectedNumber);
                button.style.backgroundColor = 'lightblue';
            } else {
                alert("You can only select up to 5 numbers.");
            }

            updateSelectedNumbers();
        });
    });

    singleNumberButtons.forEach(button => {
        button.addEventListener('click', () => {
            const selectedNumber = button.getAttribute('data-number');

            if (selectedSingleNumber === selectedNumber) {
                selectedSingleNumber = '';
                button.style.backgroundColor = '';
            } else {
                selectedSingleNumber = selectedNumber;
                singleNumberButtons.forEach(btn => {
                    btn.style.backgroundColor = '';
                });
                button.style.backgroundColor = 'lightblue';
            }

            updateSelectedSingleNumber();
        });
    });

    function updateSelectedNumbers() {
        selectedNumbersSpans.forEach((span, index) => {
            span.textContent = selectedNumbers[index] || '';
        });
        document.getElementById('selectedNumbersInput').value = selectedNumbers.join(',');

    }

    function updateSelectedSingleNumber() {
        selectedSingleNumberSpan.textContent = selectedSingleNumber;

        document.getElementById('selectedSingleNumberInput').value = selectedSingleNumber;
    }
</script>