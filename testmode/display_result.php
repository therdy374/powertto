<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual and Automatic Button</title>
</head>

<body>

    <?php
    // Define your database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pos_mgt_system";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Initialize $randomNumbers variable
    $randomNumbers = [];
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["manual_submit"])) {
            $randomNumbers = handleManualButtonClick($conn);
        } elseif (isset($_POST["automatic_submit"])) {
            $randomNumbers = handleAutomaticButtonClick($conn);
        }
    }

    // Close the database connection
    $conn->close();

    function handleManualButtonClick($conn)
    {
        $randomNumbers = [];

        if (
            isset($_POST["selected_numbers"]) &&
            is_array($_POST["selected_numbers"]) &&
            count($_POST["selected_numbers"]) === 5 &&
            isset($_POST["selected_single_number"]) &&
            is_numeric($_POST["selected_single_number"])
        ) {
            $selectedNumbers = implode(",", $_POST["selected_numbers"]);
            $selectedSingleNumber = $_POST["selected_single_number"];

            $sql = "INSERT INTO lottery_numbers (type, numbers, powerballs) VALUES ('manual', '$selectedNumbers', '$selectedSingleNumber')";

            if ($conn->query($sql) !== TRUE) {
                echo "<br>Error inserting data: " . $conn->error;
            } else {
                echo "<script>alert('Data inserted successfully!');</script>";
            }

            $randomNumbers = $_POST["selected_numbers"];
        } else {
            echo "<script>alert('Invalid input!');</script>";
        }

        return $randomNumbers;
    }

    function generateRandomNumbers($count)
    {
        $numbers = range(1, 28);
        shuffle($numbers);
        return array_slice($numbers, 0, $count);
    }

    ?>
    <div>
        <div class="container">

            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <button type="submit" name="manual">Manual</button>

                <?php if (isset($_POST["manual"])) : ?>

                    <p>Select 5 numbers:</p>
                    <?php for ($i = 1; $i <= 28; $i++) : ?>
                        <button type="button" class="number-button" data-number="<?php echo $i; ?>"><?php echo $i; ?></button>
                    <?php endfor; ?>
                    <br>
                    <p>Selected 5 Numbers:</p>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <input type="text" name="selected_numbers[]" readonly value="<?php echo isset($randomNumbers[$i - 1]) ? $randomNumbers[$i - 1] : ''; ?>">
                    <?php endfor; ?>

                    <p>Select 1 number:</p>
                    <?php for ($i = 1; $i <= 9; $i++) : ?>
                        <button type="button" class="single-number-button" data-number="<?php echo $i; ?>"><?php echo $i; ?></button>
                    <?php endfor; ?>
                    <br>
                    <p>Selected Number:</p>
                    <input type="text" name="selected_single_number" id="selectedSingleNumberInput" value="<?php echo isset($_POST['selected_single_number']) ? $_POST['selected_single_number'] : ''; ?>">

                    <button type="submit" name="manual_submit">Submit</button>
                <?php endif; ?>

            </form>

        </div>
    </div>

    <script>
        // JavaScript code to handle number button clicks and update selected numbers
        const numberButtons = document.querySelectorAll('.number-button');
        const selectedNumbersInputs = document.querySelectorAll('input[name^="selected_numbers"]');
        const selectedSingleNumberInput = document.getElementById('selectedSingleNumberInput');
        let selectedNumbers = [];

        numberButtons.forEach(button => {
            button.addEventListener('click', () => {
                const selectedNumber = button.getAttribute('data-number');

                // Toggle selection
                if (selectedNumbers.includes(selectedNumber)) {
                    // Deselect the number
                    selectedNumbers = selectedNumbers.filter(number => number !== selectedNumber);
                    button.style.backgroundColor = ''; // Reset background color
                } else if (selectedNumbers.length < 5) {
                    // Select the number
                    selectedNumbers.push(selectedNumber);
                    button.style.backgroundColor = 'lightblue'; // Highlight selected button
                } else {
                    alert("You can only select up to 5 numbers.");
                }

                // Update the display and hidden input
                selectedNumbersInputs.forEach((input, index) => {
                    input.value = selectedNumbers[index] || '';
                });
            });
        });

        const singleNumberButtons = document.querySelectorAll('.single-number-button');

        singleNumberButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Toggle background color
                if (button.style.backgroundColor === 'lightblue') {
                    button.style.backgroundColor = ''; // Deselect the number
                    selectedSingleNumberInput.value = '';
                } else {
                    // Select the number
                    // Reset background color for all buttons
                    singleNumberButtons.forEach(btn => {
                        btn.style.backgroundColor = '';
                    });

                    button.style.backgroundColor = 'lightblue'; // Highlight selected button
                    selectedSingleNumberInput.value = button.getAttribute('data-number');
                }
            });
        });
    </script>

</body>

</html>
