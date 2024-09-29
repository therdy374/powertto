<?php
include "./inc/connect.php";

if (isset($_GET['list_edit_user'])) {

    $user_id = $_GET['list_edit_user'];

    $select_query = "Select * from `user_purchases` where id='$user_id'";
    $result_query = mysqli_query($conn, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);

    $user_username = $row_fetch['username'];
    $user_id2 = $row_fetch['user_id'];
    $selected_numbers = $row_fetch['selected_numbers'];
    $powerballs = $row_fetch['powerballs'];
    $winning_amount = $row_fetch['winning_amount'];
    $winning_match_numbers = $row_fetch['winning_match_numbers'];
    $is_ban = isset($row_fetch['is_ban']) == true ? 1 : 0;

    if (isset($_POST['user_updated'])) {

        $user_username = $_POST['username'];
        $user_id2 = $user_id;
        $selected_numbers = $_POST['selected_numbers'];
        $powerballs = $_POST['powerballs'];
        $winning_amount = $_POST['winning_amount'];
        $winning_match_numbers = $_POST['winning_match_numbers'];
        $is_ban = isset($_POST['is_ban']) == true ? 1 : 0;

        if ($user_username == '' || $selected_numbers == '' || $powerballs == '' || $winning_amount == '' || $winning_match_numbers == '') {
            echo "<script>alert('Please fill all the fields requierd')</script>";
        } else {

            $user_update = "UPDATE `user_purchases` SET `user_id`='$user_id2',`username`='$user_username',`selected_numbers`='$selected_numbers',`powerballs`='$powerballs',`winning_amount`='$winning_amount',`winning_match_numbers`='$winning_match_numbers',`is_ban`='$is_ban' WHERE `id`='$user_id'";

            $result_query_update = mysqli_query($conn, $user_update);

            if ($result_query_update) {

                echo "<script>alert('Data updated successfully!')</script>";
                echo "<script>window.open('index.php?list_user_purchase','_self')</script>";
            } else {
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
            <div>
                <h6 class="mb-4 text-primary">UPDATE LIST PURCHASE
                    <a href="index.php?list_user_purchase" class="btn btn-primary btn-sm float-end">Back</a>
                </h6>
            </div>

            <form action="" method="POST" class="mb-2">
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo $user_id; ?>" class="form-control" />

                    <input type="hidden" name="user_id" value="<?php echo $user_id2; ?>" class="form-control" />

                    <div class="col-md-12 mb-3">
                        <label for="">Name *</label>
                        <input type="text" name="username" value="<?php echo $user_username; ?>" class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Selected Numbers *</label>
                        <input type="text" name="selected_numbers" value="<?php echo $selected_numbers; ?>" class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Powerballs *</label>
                        <input type="text" name="powerballs" value="<?php echo $powerballs; ?>" class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Winning Amount *</label>
                        <input type="text" name="winning_amount" value="<?php echo $winning_amount; ?>" class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Macthed Number *</label>
                        <input type="text" name="winning_match_numbers" value="<?php echo $winning_match_numbers; ?>" class="form-control" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">Is Ban</label>
                        <br />
                        <input type="checkbox" name="is_ban" value="<?php echo $is_ban; ?>" style="width:20px;height:20px" />
                    </div>
                </div>

                <!-- <button type="submit" name="user_update" class="btn btn-primary">Save</button> -->
                <input type="submit" value="Update Profile" name="user_updated" class="bg-primary border-0 rounded py-2 px-3 text-light">
            </form>
        </div>
    </div>
</body>

</html>