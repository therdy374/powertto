<!-- Add -->
<!-- Summernote CSS - CDN Link -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<style>
    .note-editor.note-airframe .note-editing-area .note-editable,
    .note-editor.note-frame .note-editing-area .note-editable {
        padding: 10px;
        overflow: auto;
        word-wrap: break-word;
        color: #191c24;
        background: white;
    }
</style>

<div class="modal fade" id="announcement" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark">
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center text-warning">
                        <i class="bi bi-person-fill-add me-2"></i>Add Announcement
                    </h5>
                    <button type="reset" class="btn-close shadow-none text-warning" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <hr>
                <div class="modal-body">
                    <span class="badge rounded-pill bg-dark text-danger mb-3 text-wrap lh-base">
                        Note: This is required field of user to make an add! Please fill the all field required!
                    </span>
                    <div class="container-fluid">
                        <div class="row">
                            <input type="hidden" name="name" value="관리자" class="form-control" readonly />

                            <div class="col-md-12 ps-0 mb-3 text-white">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>

                            <div class="col-md-12 p-0 text-white">
                                <label for="">Announcement Content *</label>
                                <textarea name="content" value="" class="form-control text-primary" id="summernote" required></textarea>
                            </div>

                        </div>
                        <div class="text-center my-1">
                            <button type="submit" name="add_Announcement" class="btn btn-sm btn-warning rounded py-1 px-1 me-2"><i class="bi bi-person-fill-add me-1"></i>Save</button>
                            <button type="button" class="btn btn-sm btn-secondary rounded py-1 px-1 me-2" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<?php

include "./inc/connect.php";

if (isset($_POST['add_Announcement'])) {
    date_default_timezone_set('Asia/Seoul');
    $currentDateTime = date('Y-m-d H:i:s');

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $status = 0;

    if ($name == '' || $title == '' || $content == '') {
        echo "<script>alert('Please fill all the available fields')</script>";
        exit();
    }

    $sql = "INSERT INTO announcement (name, title, content, status, date_content) VALUES ('$name', '$title', '$content', '$status', '$currentDateTime')";

    $res_query = mysqli_query($conn, $sql);

    if ($res_query) {
        echo "<script>alert('Announcement is save successfully!')</script>";
        echo "<script>window.open('index.php?announcement','_self')</script>";
    }
}
