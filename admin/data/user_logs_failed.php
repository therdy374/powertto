<div class="modal fade" id="view_logs<?php echo $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-secondary">
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center text-warning">
                        <i class="bi bi-person-fill-add me-2"></i>Login Failed Details
                    </h5>
                    <button type="reset" class="btn-close shadow-none text-warning" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <span class="badge rounded-pill bg-secondary text-danger mb-3 text-wrap lh-base">
                        Note: This is the logs information details!
                    </span>

                    <div class="container-fluid">
                        <div class="row">
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
                                <label class="form-label">Logs Problem: <span>
                                        <?php
                                        echo $logs_prob
                                        ?></span>
                                </label>
                            </div>
                            <div class="col-md-12 ps-0 mb-3 text-white">
                                <label class="form-label">Date Logged Attempt: <span><?php echo $date_logs ?></span></label>
                            </div>
                            
                        </div>
                        <div class="text-center my-1">
                            <button type="button" class="btn btn-sm btn-info rounded py-1 px-1 me-2" data-bs-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span> Back
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>