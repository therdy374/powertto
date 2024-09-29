<?php
include "./inc/connect.php";

if (isset($_GET['update_announcement'])) {

    $user_id = $_GET['update_announcement'];
   

    $select_query = "SELECT * FROM `announcement` WHERE id = $user_id";
    $result_query = mysqli_query($conn, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);

    $name = $row_fetch['name'];
    $title = $row_fetch['title'];
    $content = $row_fetch['content'];
    // $user_id1 = $row_fetch['user_id'];

    if (isset($_POST['announcement_update'])) {

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $content = mysqli_real_escape_string($conn, $_POST['content']);
        $status = "Completed";

        if ($content == '') {
            echo "<script>alert('Please fill the reply field.')</script>";
        } else {
            $sql2 = "UPDATE `announcement` SET `name`='$name', `title`='$title', `content`='$content', `status`='$status' WHERE `id` = '$user_id'";
            $res_query = mysqli_query($conn, $sql2);

            if ($res_query) {
                echo '<script>alert("The content announcement is now updated!")</script>';
                echo "<script>window.open('index.php?announcement','_self')</script>";
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
            <h6 class="mb-4">Update Announcement
                <a href="index.php?announcement" class="btn btn-primary btn-sm float-end">Back</a>
            </h6>

            <form action="" method="POST" class="mb-2">
                <div class="row">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" class="form-control" />
                    <input type="hidden" name="name" value="관리자" class="form-control" readonly />
                    <input type="hidden" name="status" value="Completed" />

                    <div class="col-md-6 mb-3">
                        <label for="">Title *</label>
                        <input type="text" name="title" value="<?php echo $title; ?>" class="form-control text-white"  />
                    </div>
                 
                    <div class="col-md- mb-3">
                        <label for="">Update Content *</label>
                        <textarea name="content" value="" class="form-control text-primary" id="summernote" required><?php echo $content; ?></textarea>
                    </div>
                </div>
                <input type="submit" value="Update Announcement" name="announcement_update" class="bg-primary border-0 rounded py-2 px-3 text-light">
            </form>
        </div>
    </div>


</body>

</html>