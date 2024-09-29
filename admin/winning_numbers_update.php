<?php
include "./inc/connect.php";

$generated_at = '';

if (isset($_GET['winning_numbers_update'])) {

    $user_id = $_GET['winning_numbers_update'];

    $select_query = "SELECT * FROM `generate_numbers` WHERE gen_id='$user_id'";
    $result_query = mysqli_query($conn, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);

    $whiteballs = $row_fetch['main_numbers'];
    $powerballs = $row_fetch['powerball_number'];
    $winning_amount = $row_fetch['winning_price'];
    $generated_at = $row_fetch['generated_at'];

    if (isset($_POST['numbers_update'])) {

        date_default_timezone_set('Asia/Seoul');
        $current_date_time = date('Y-m-d H:i:s');

        $whiteballs = mysqli_real_escape_string($conn, $_POST['main_numbers']);
        $powerballs = mysqli_real_escape_string($conn, $_POST['powerball_number']);
        $winning_amount = mysqli_real_escape_string($conn, $_POST['winning_price']);
        $generated_at = mysqli_real_escape_string($conn, $_POST['generated_at']); // Add this line to retrieve generated_at

        $winning_amount = preg_replace('/[^\d.]/', '', $winning_amount);

        if ($whiteballs == '' || $powerballs == '' || $winning_amount == '') {
            echo "<script>alert('Please fill all the required fields')</script>";
        } else {

            $user_update = "UPDATE `generate_numbers` SET main_numbers = '$whiteballs', powerball_number = '$powerballs', winning_price = '$winning_amount', generated_at = '$generated_at' WHERE gen_id ='$user_id'";

            $result_query_update = mysqli_query($conn, $user_update);

            if ($result_query_update) {

                echo "<script>alert('Data updated successfully!')</script>";
                echo "<script>window.open('index.php?winning_numbers','_self')</script>";
            } else {
                echo "<script>alert('Oops, something went wrong!')</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winners Update</title>
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body>
    <div class="col-md-12 col-xl-12">
        <div class="bg-secondary rounded h-100 p-4">

            <div>
                <h6 class="mb-4 text-primary">Winners Update
                    <a href="index.php?winning_numbers" class="btn btn-primary btn-sm float-end">Back</a>
                </h6>
            </div>
            <form action="" method="POST" class="mb-2" onsubmit="return validateForm()">
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo $user_id; ?>" class="form-control" />

                    <div class="col-md-6 mb-3">
                        <label for="">Whiteballs *</label>
                        <input type="text" name="main_numbers" value="<?php echo $whiteballs; ?>" class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Powerballs *</label>
                        <input type="text" name="powerball_number" value="<?php echo $powerballs; ?>" class="form-control" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Winning Prize*</label>
                        <input type="text" name="winning_price" value="<?php echo number_format($winning_amount); ?>" class="form-control" oninput="formatNumber(this)" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Date*</label>
                        <input type="text" name="generated_at" value="<?php echo $generated_at; ?>" class="form-control" required />
                    </div>

                </div>

                <input type="submit" value="Winners Update" name="numbers_update" class="bg-primary border-0 rounded py-2 px-3 text-light">
            </form>
        </div>
    </div>


    <script>
        // Initialize Flatpickr datetime picker
        flatpickr("[name='generated_at']", {
            enableTime: false,
            dateFormat: "Y-m-d",
        });

        function formatNumber(input) {
            let value = input.value.replace(/\D/g, '');
            let formattedValue = Number(value).toLocaleString();
            input.value = formattedValue;
        }

        function validateMainNumbers() {
            let mainNumbersInput = document.querySelector('input[name="main_numbers"]').value;
            let mainNumbers = mainNumbersInput.split(',').map(num => parseInt(num.trim(), 10));

            // Check if exactly 5 numbers are provided
            if (mainNumbers.length !== 5) {
                alert("Please input exactly 5 regular numbers.");
                return false;
            }

            // Check if each number is in the range 1 to 28
            for (let num of mainNumbers) {
                if (isNaN(num) || num < 1 || num > 28) {
                    alert("Input the regular numbers from 1 to 28 only.");
                    return false;
                }
            }

            // Check for duplicate numbers
            let uniqueNumbers = new Set(mainNumbers);
            if (uniqueNumbers.size !== mainNumbers.length) {
                alert("Numbers should not be repeated.");
                return false;
            }

            return true;
        }

        function validatePowerballNumber() {
            let powerballInput = document.querySelector('input[name="powerball_number"]').value;
            let powerballNumbers = powerballInput.split(',').map(num => parseInt(num.trim(), 10));

            // Check if exactly 1 number is provided
            if (powerballNumbers.length !== 1) {
                alert("Please input exactly 1 powerball number.");
                return false;
            }

            // Check if the number is in the range 1 to 9
            let powerballNumber = powerballNumbers[0];
            if (isNaN(powerballNumber) || powerballNumber < 0 || powerballNumber > 9) {
                alert("Input the powerball numbers from 0 to 9 only.");
                return false;
            }

            return true;
        }

        function validateForm() {
            return validateMainNumbers() && validatePowerballNumber();
        }
    </script>
</body>

</html>