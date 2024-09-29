<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 p-4">
                <div>
                    <h6 class="mb-4">Winners Participants
                        <a href="index.php" class="btn btn-primary btn-sm float-end">Back</a>
                    </h6>
                </div>

                <?php include_once("./data/create_winners.php"); ?>
                <div class="d-flex">
                    <a href="#addnewwinner" class="btn btn-primary text-light btn-sm my-2 mx-0" data-bs-toggle="modal"><i class="bi bi-plus-square me-2"></i>New Winners</a>
                </div>
                <div class="table-responsive my-2">
                    <table class="table text-white text-center my-3" style="font-size: small;" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center">SI No</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">User ID</th>
                                <th class="text-center">Winning Amount</th>
                                <th class="text-center">Whiteballs</th>
                                <th class="text-center">Powerballs</th>
                                <th class="text-center">Matched Numbers</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">View</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            include "./inc/connect.php";

                            $get_users = "Select * from `winners_participants` order by `winner_date` DESC";
                            $result_query = mysqli_query($conn, $get_users);

                            while ($run_query = mysqli_fetch_array($result_query)) {

                                $id = $run_query['id'];
                                $name = $run_query['name'];
                                $user_id = $run_query['userid'];
                                $winning_amount = $run_query['winning_amount'];
                                $whiteballs = $run_query['whiteballs'];
                                $powerballs = $run_query['powerballs'];
                                $match_numbers = $run_query['match_numbers'];
                                $winner_date = date('Y.m.d (D) h:m:s (a)', strtotime($run_query['winner_date']))

                            ?>

                                <tr class='text-center'>
                                    <td><?php echo $id ?></td>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $user_id ?></td>
                                    <td>₩ <?php echo number_format($winning_amount) ?></td>
                                    <td><?php echo ($whiteballs) ?></td>
                                    <td><?php echo ($powerballs) ?></td>
                                    <td><?php echo ($match_numbers) ?></td>
                                    <td> <?php echo $winner_date?></td>
                                    <td><a href='index.php?view_winners_update=<?php echo $id ?>' class='text-success'><i class='fa-solid fa-pen-to-square'></i></a></td>
                                    <td><a href='index.php?view_winners_del=<?php echo $id ?>' class='text-danger'><i class='fa-solid fa-trash-can'></i></a></td>

                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Table End -->