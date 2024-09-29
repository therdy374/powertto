<?php
include "./inc/connect.php";

if (isset($_GET['users_process_inquiries'])) {

    $user_id = $_GET['users_process_inquiries'];

    $select_query = "SELECT * FROM `customer_service` WHERE id='$user_id'";
    $result_query = mysqli_query($conn, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);

    $name = $row_fetch['name'];
    $user_id1 = $row_fetch['user_id'];
    $message = $row_fetch['message'];

    if (isset($_POST['reply_inquiries'])) {

        $rep_message = mysqli_real_escape_string($conn, $_POST['reply_message']);
        $user_req = mysqli_real_escape_string($conn, $_POST['user_request']);
        $status = "답변완료";

        if ($rep_message == '') {
            echo "<script>alert('Please fill the reply field.')</script>";
        } else {
            $sql2 = "UPDATE `customer_service` SET `reply_message`='$rep_message', `user_request`='$user_req', `status`='$status' WHERE `id` = '$user_id'";
            $res_query = mysqli_query($conn, $sql2);

            // $user_update = "INSERT INTO deposit_mgt (name, user_id, amount_deposit) VALUES ('$name','$user_id1','$message')";
            // $result_query_update = mysqli_query($conn, $user_update);

            if ($res_query) {
                echo '<script>alert("User inquiry has been replied!")</script>';
                echo "<script>window.open('index.php?users_inquiries','_self')</script>";
            } else {
                echo "<script>alert('Oops! Something went wrong.')</script>";
            }
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Announcement</title>

    <!-- Summernote CSS - CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">


    <style>
        .note-editor.note-airframe .note-editing-area .note-editable,
        .note-editor.note-frame .note-editing-area .note-editable {
            padding: 10px;
            overflow: auto;
            word-wrap: break-word;
            color: black;
            background: white;
        }
    </style>

</head>

<body>

    <div class="col-md-12 col-xl-12">
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">User Inquiry
                <a href="index.php?users_inquiries" class="btn btn-primary btn-sm float-end">Back</a>
            </h6>

            <form action="" method="POST" class="mb-2">
                <div class="row">
                    <input type="hidden" name="user_id" value="<?php echo $user_id1; ?>" class="form-control" />
                    <input type="text" name="user_request" value="[입금계좌문의]" class="form-control" readonly />
                    <input type="hidden" name="status" value="입금처리완료" />

                    <div class="col-md-6 mb-3">
                        <label for="">Name *</label>
                        <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" readonly />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">User Inquiry *</label>
                        <input type="text" name="message" value="<?php echo $message; ?>" class="form-control" readonly />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Reply to Inquiry *</label>
                        <textarea name="reply_message" class="form-control text-primary" id="summernote" required></textarea>
                    </div>
                </div>
                <input type="submit" value="Reply to Inquiry" name="reply_inquiries" class="bg-primary border-0 rounded py-2 px-3 text-light">
            </form>
        </div>
    </div>

  

</body>

</html>