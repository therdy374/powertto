<div class="modal fade" id="view_users_modal<?php echo $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-secondary">
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center text-warning">
                        <i class="bi bi-person-fill-add me-2"></i>Users Details
                    </h5>
                    <button type="reset" class="btn-close shadow-none text-warning" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <span class="badge rounded-pill bg-secondary text-danger mb-3 text-wrap lh-base ">
                        Note: This is the users information details!
                    </span>

                    <div class="container-fluid text-center">
                        <div class="row">
                            <div class="col-md-12 ps-0 mb-3 text-white">
                                <label class="form-label">User ID: <span><?php echo $userid ?></span>
                                </label>
                                <div class="col-md-12 ps-0 mb-3 text-white">
                                    <label class="form-label">Full Name: <span><?php echo $name ?></span></label>|
                               
                                    <label class="form-label">Contact No: <span><?php echo $phone ?></span></label> |
                              
                                    <label class="form-label">Date of Birth: <span>
                                            <?php
                                            echo $bod
                                            ?></span>
                                    </label>
                                
                            </div>


                            <div class="col-md-12 ps-0 mb-3 text-white">
                                <label class="form-label">Current Balance: <span><?php echo number_format($credit) ?> ₩</span></label>
                            </div>

                            <div class="col-md-12 ps-0 mb-3 text-white">
                                <label class="form-label">User Deposit: <span><?php echo number_format($total_deposit) ?> ₩</span></label>
                            </div>

                            <div class="col-md-12 ps-0 mb-3 text-white">
                                <label class="form-label">User Withdrawal: <span><?php echo number_format($total_withdrawal) ?> ₩</span></label>
                            </div>

                            <div class="col-md-12 ps-0 mb-3 text-white">
                                <label class="form-label">Calcuted Amount: <span><?php echo number_format($calculated_amount) ?> ₩</span></label>
                            </div>

                            <div class="col-md-12 ps-0 mb-3 text-white">
                                <label class="form-label">Accout Status:
                                    <span>
                                        <?php

                                        if ($run_query['is_ban'] == 1) {
                                            echo '<span class="badge bg-danger">Banned</span>';
                                        } else {
                                            echo '<span class="badge bg-success">Active</span>';
                                        }

                                        ?>
                                    </span>
                                </label>
                            </div>

                            <div class="col-md-12 ps-0 mb-3 text-white">
                                <label class="form-label">Join Date: <span><?php echo $created_at ?></span></label>
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