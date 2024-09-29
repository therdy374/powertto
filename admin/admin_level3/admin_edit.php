<?php
include "./inc/connect.php";

$generated_at = ''; // Initialize $generated_at variable

if (isset($_GET['admin_edit'])) {

    $user_id = $_GET['admin_edit'];

    $select_query = "SELECT * FROM `admins` WHERE id='$user_id'";
    $result_query = mysqli_query($conn, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);

    $name = $row_fetch['name'];
    $username = $row_fetch['username'];
    $phone = $row_fetch['phone'];
	$password = $row_fetch['password'];
    $percentage = $row_fetch['percentage'];
	$admin_level = $row_fetch['admin_level'];

    $referal_code = $row_fetch['referal_code'];
    $parent_name = $row_fetch['parent_name'];


	if (isset($_POST['agent_update'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $new_password = $_POST['password']; // New password input
        $phone = $_POST['phone'];
		$percentage = $_POST['percentage'];
		$admin_level = $_POST['admin_level'];

        
        if ($name == '' || $username == '' || $phone == '' || $percentage == '' || $admin_level == '') {
            echo "<script>alert('Please fill all the required fields')</script>";
        } else {
            // Removed unnecessary password update check
            if (!empty($new_password)) {
                $bycrypt_password = password_hash($new_password, PASSWORD_BCRYPT);
                $password_update = "`password`='$bycrypt_password', ";
            } else {
                $password_update = "";
            }
    
            // Corrected SQL query by removing quotes around $password_update variable
            $user_update = "UPDATE `admins` SET `name`='$name', `username`='$username', $password_update `phone`='$phone', `admin_level`='$admin_level', `percentage`='$percentage' WHERE `id`='$user_id'";
    
            $result_query_update = mysqli_query($conn, $user_update);
    
            if ($result_query_update) {
                echo "<script>alert('Data updated successfully!')</script>";
                echo "<script>window.open('index_L3.php?view_admin_L3','_self')</script>";
            } else {
                echo "<script>alert('Oops! Something went wrong!')</script>";
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
    <title>Agents Update</title>
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body>
    <div class="col-md-12 col-xl-12">
        <div class="bg-secondary rounded h-100 p-4">

            <div>
                <h6 class="mb-4 text-primary">Agents Update
                    <a href="index_L3.php?view_admin_L3" class="btn btn-primary btn-sm float-end">Back</a>
                </h6>
            </div>
            <form action="" method="POST" class="mb-2">
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo $user_id; ?>" class="form-control" />

                    <div class="col-md-6 mb-3">
                        <label for="">Creator code*</label>
                        <input type="text" name="name" value="<?php echo $parent_name; ?>" class="form-control" readonly/>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Referal code*</label>
                        <input type="text" name="name" value="<?php echo $referal_code; ?>" class="form-control" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Agent Name*</label>
                        <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" />
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="">Username *</label>
                        <input type="text" name="username" value="<?php echo $username; ?>" class="form-control" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Phone Number*</label>
                        <input type="text" name="phone" value="<?php echo $phone ?>" class="form-control"  />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Password*</label>
                        <input type="password" name="password" value="" class="form-control" />
                    </div>

					<div class="col-md-6 mb-3 text-white">
								<label class="form-label">User level</label>
								<select class="form-select form-select-md bg-light text-dark" aria-label=".form-select-md example" name="admin_level" required>
									<option selected disabled>User Level</option>
									<option value="1"<?php if ($admin_level == "1") echo " selected"; ?>>One</option>
									<option value="2"<?php if ($admin_level == "2") echo " selected"; ?>>Two</option>
									<option value="3"<?php if ($admin_level == "3") echo " selected"; ?>>Three</option>
									<!-- <option value="4"<?php if ($admin_level == "4") echo " selected"; ?>>Four</option>
									<option value="5"<?php if ($admin_level == "5") echo " selected"; ?>>Five</option> -->
								</select>
							</div>

							<div class="col-md-6 mb-3 text-white">
								<label class="form-label">Percentage</label>
								<select class="form-select form-select-md bg-light text-dark" aria-label=".form-select-md example" name="percentage" required>
									<option selected disabled>Percentage</option>
									<option value="10%"<?php if ($percentage == "10%") echo " selected"; ?>>10%</option>
									<option value="20%"<?php if ($percentage == "20%") echo " selected"; ?>>20%</option>
									<option value="30%"<?php if ($percentage == "30%") echo " selected"; ?>>30%</option>
									<!-- <option value="40%"<?php if ($percentage == "40%") echo " selected"; ?>>40%</option>
									<option value="50%"<?php if ($percentage == "50%") echo " selected"; ?>>50%</option>
                                    <option value="60%"<?php if ($percentage == "60%") echo " selected"; ?>>60%</option>
									<option value="70%"<?php if ($percentage == "70%") echo " selected"; ?>>70%</option>
									<option value="80%"<?php if ($percentage == "80%") echo " selected"; ?>>80%</option>
									<option value="90%"<?php if ($percentage == "90%") echo " selected"; ?>>90%</option>
									<option value="100%"<?php if ($percentage == "100%") echo " selected"; ?>>100%</option> -->
								</select>
							</div>

                </div>

                <input type="submit" value="Agent Update" name="agent_update" class="bg-primary border-0 rounded py-2 px-3 text-light">
            </form>
        </div>
    </div>


    <script>
        // Initialize Flatpickr datetime picker
        flatpickr("[name='generated_at']", {
            enableTime: false,
            dateFormat: "Y-m-d", // Adjust date format as per your requirement
            // Add any additional options as needed
        });

        function formatNumber(input) {

            let value = input.value.replace(/\D/g, '');
            let formattedValue = Number(value).toLocaleString();

            input.value = formattedValue;
        }
    </script>
</body>

</html>
