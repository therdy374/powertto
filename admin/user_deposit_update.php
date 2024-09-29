<?php
include "./inc/connect.php";

if (isset($_GET['user_deposit_update'])) {

    $user_id = $_GET['user_deposit_update'];

    $select_query = "Select * from `deposit_mgt` where id='$user_id'";
    $result_query = mysqli_query($conn, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);

    $name = $row_fetch['name'];
    $user_id1 = $row_fetch['user_id'];
    $amount_deposit = $row_fetch['amount_deposit'];

    if (isset($_POST['user_updated'])) {

        $admin_id = $_SESSION['id'];

        $name = $_POST['name'];
        $user_id1 = $_POST['user_id'];
        $amount_deposit = $_POST['amount_deposit'];

        $amount_deposit = preg_replace('/[^\d.]/', '', $amount_deposit);

        if ($name == '' || $amount_deposit == '') {
            echo "<script>alert('Please fill all the fields requierd')</script>";
        } 
        else {
            // user query
            $sql2 = "UPDATE `users` SET `credit` = '$amount_deposit' WHERE `id` = $user_id1";
            $res_query = mysqli_query($conn, $sql2);

            $user_update = "INSERT INTO deposit_mgt (name, user_id, amount_deposit) VALUES ( '$name','$user_id1','$amount_deposit')";
            $result_query_update = mysqli_query($conn, $user_update);

    
            if ($result_query_update) {

                // echo '<script>alert("Users deposit completed!\n Admin Balance!\n ' . $finalBalance . ' ")</script>';
                echo "<script>window.open('index.php?deposit_users','_self')</script>";
            }
            else{
                echo "<script>alert('Oppss may mali!')</script>";
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
    <title>Edit Account</title>
</head>

<body>
    <div class="col-md-12 col-xl-12">
        <div class="bg-secondary rounded h-100 p-4">
            <!-- <h6 class="mb-4 text-center">Users Update Deposit</h6> -->
            <div>
                <h6 class="mb-4 text-primary">USERS UPDATE DEPOSIT
                    <a href="index.php?deposit_users" class="btn btn-primary btn-sm float-end">Back</a>
                </h6>
            </div>
            <form action="" method="POST" class="mb-2">
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo $user_id; ?>" class="form-control" />
                    <input type="hidden" name="user_id" value="<?php echo $user_id1; ?>" class="form-control" />
                    <div class="col-md-6 mb-3">
                        <label for="">Name *</label>
                        <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Deposit Amount *</label>
                        <input type="text" name="amount_deposit" value="<?php echo $amount_deposit; ?>" oninput="formatNumber(this)" class="form-control" />
                    </div>
                    <script>
                        function formatNumber(input) {
                            let value = input.value.replace(/\D/g, '');
                            let formattedValue = Number(value).toLocaleString();
                            input.value = formattedValue;
                        }
                    </script>
                </div>
                <!-- <button type="submit" name="user_update" class="btn btn-primary">Save</button> -->
                <input type="submit" value="Update deposit" name="user_updated" class="bg-primary border-0 rounded py-2 px-3 text-light">
            </form>
        </div>
    </div>
</body>

</html>