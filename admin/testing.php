<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Data Update</title>
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="table-responsive my-2">
        <form id="search-form" method="POST" action="">
            <label for="" class="me-5">Date*</label>
            <div class="d-flex col-md-3 mb-2">
                <input type="text" id="date-picker" name="selected-date" value="<?php echo isset($_POST['selected-date']) ? $_POST['selected-date'] : 'Select Date'; ?>" class="form-control" required />
                <button type="submit" id="search-btn" name="search" class="btn btn-primary">Search</button>
            </div>
        </form><br>

        <div id="table-container">
            <?php include "update_data.php"; ?>
        </div>

        <div>
            <h6 class="mb-4">
                <a href="../home.php" class="btn btn-primary btn-sm float-end">메인에 게시 hoem</a>
            </h6>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Initialize flatpickr
            flatpickr("#date-picker", {
                enableTime: false,
                dateFormat: "Y-m-d",
                onChange: function (selectedDates, dateStr, instance) {
                    // When the date changes, trigger the AJAX request
                    updateData(dateStr);
                }
            });

            // Function to update data via AJAX
            function updateData(selectedDate) {
                $.ajax({
                    type: "POST",
                    url: "update_data.php", // Replace with your PHP script URL
                    data: {
                        selectedDate: selectedDate
                    },
                    success: function (response) {
                        // Update the table container with the new data
                        $('#table-container').html(response);
                    }
                });
            }
        });
    </script>
</body>
</html>
