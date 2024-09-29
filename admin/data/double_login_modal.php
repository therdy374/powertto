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

<div class="modal fade" id="double_logs<?php echo $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-secondary">
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center text-warning">
                        <i class="bi bi-person-fill-add me-2"></i>Double Login Details
                    </h5>
                    <button type="reset" class="btn-close shadow-none text-warning" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <span class="badge rounded-pill bg-secondary text-danger mb-3 text-wrap lh-base text-center">
                        Note: This is the double login information details!
                    </span>

                    <div class="container-fluid text-center">
                        <div class="row">

                            <input type="hidden" name="id" value="<?php echo $id ?>">

                            <div class="col-md-12 ps-0 mb-3 text-white">
                                <label class="form-label">User ID: <span><?php echo $userid ?></span></label>
                            </div>
                            <div class="col-md-12 ps-0 mb-3 text-white">
                                <label class="form-label">IP Address: <span><?php echo $ip_address ?></span></label>
                            </div>
                            <div class="col-md-12 ps-0 mb-3 text-white">
                                <label class="form-label">Device Use: <span><?php echo $device_use ?></span></label>
                            </div>
                            <div class="col-md-12 ps-0 mb-3 text-white">
                                <label class="form-label">Logs Problem: <span><?php echo $logs_prob ?></span></label>
                            </div>
                            <div class="col-md-12 ps-0 mb-3 text-white">
                                <label class="form-label">Date Logged Attempt: <span><?php echo $date_logs ?></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="memo">Message for User*</label>
                        <textarea name="memo" id="memo" class="form-control text-primary summernote" placeholder="Enter your message"></textarea>
                    </div>
                    <br>

                    <div class="text-center my-1">
                        <button type="submit" name="admin_message" class="btn btn-sm btn-warning rounded py-1 px-1 me-2"><i class="bi bi-person-fill-add me-1"></i>Send Message</button>
                        <button type="button" class="btn btn-sm btn-info rounded py-1 px-1 me-2" data-bs-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span> Back
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include "./inc/connect.php";

if (isset($_POST['admin_message'])) {
    $id = $_POST['id'];
    $memo = mysqli_real_escape_string($conn, $_POST['memo']);

    if (empty($memo)) {
        echo "<script>alert('Please fill all the available fields')</script>";
        echo "<script>window.open('index.php?double_login','_self')</script>";
    } else {
        $sql =  "UPDATE `login_double` SET `memo`='$memo' WHERE `id` = $id";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('The memo has been updated successfully!')</script>";
            echo "<script>window.open('index.php?double_login','_self')</script>";
        } else {
            echo "<script>alert('Error updating memo: " . mysqli_error($conn) . "')</script>";
        }
    }
}
?>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 150, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: true, // set focus to editable area after initializing summernote
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']], // Add font size dropdown
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '22', '24', '28', '36', '48', '64', '82', '150']
        });
    });
</script>