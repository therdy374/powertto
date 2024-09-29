<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: signin.php");
}
include_once "../includes/sidebar.php"
?>

<div class="content">
  <!-- topbar Start -->
  <?php include_once "../includes/topbar.php" ?>
  <!-- topbar end -->

    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Today Sale</p>
                        <h6 class="mb-0">$1234</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Sale</p>
                        <h6 class="mb-0">$1234</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Today Revenue</p>
                        <h6 class="mb-0">$1234</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Revenue</p>
                        <h6 class="mb-0">$1234</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- Table Start -->
  <div class="container-fluid pt-4 px-4">
    <div class="row g-4">
      <div class="col-sm-6">
        <div class="bg-secondary rounded h-100 p-4">
          <h6 class="mb-4">Admin Table</h6>
          <?php include_once("admin_new_modal.php"); ?>
          <div class="d-flex">
            <a href="#addnew" class="btn btn-warning text-dark btn-sm mx-0 my-2" data-bs-toggle="modal"><i class="ft-credit-card"></i>>Add new admin</a>
          </div>
          <div class="table-responsive">
            <table class="table text-white" id="myTable">
              <thead>
                <tr>
                  <th scope="col">ID #</th>
                  <th scope="col">Firstname</th>
                  <th scope="col">Lastname</th>
                  <th scope="col">Username</th>
                  <th scope="col">Password</th>
                  <th scope="col">Email</th>
                  <th scope="col">Action</th>
                </tr>
                </tr>
              </thead>
              <tbody>

                <?php
                include_once('../includes/pdocon.php');

                $database = new Connection();
                $db = $database->open();
                try {
                  $sql = 'SELECT * FROM tb_admin';
                ?>
                  <?php 
                  foreach ($db->query($sql) as $row) {
                  ?>
                    <tr>
                      <td><?php echo $row['admin_id']; ?></td>
                      <td><?php echo $row['firstname']; ?></td>
                      <td><?php echo $row['lastname']; ?></td>
                      <td><?php echo $row['admin_username']; ?></td>
                      <td><?php echo $row['password']; ?></td>
                      <td><?php echo $row['email']; ?></td>

                      <td>
                        <a href="#edit_<?php echo $row['admin_id']; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit_<?php echo $row['admin_id']; ?>">
                          <i class="bi bi-pencil-square me-1"></i> Edit</a>

                        <a href="#delete_<?php echo $row['admin_id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_<?php echo $row['admin_id']; ?>">
                          <i class="bi bi-trash me-1"></i>Delete</a>

                      </td>
                      <?php include('admin_edit_delete_modal.php'); ?>
                    </tr>
                <?php
                  }
                } catch (PDOException $e) {
                  echo "There is some problem in connection: " . $e->getMessage();
                }
                $database->close();
                ?>
              </tbody>

            </table>
          </div>

        </div>
      </div>
      
      <div class="col-sm-6">
        <div class="bg-secondary rounded h-100 p-4">
          <h6 class="mb-4">Admin Table</h6>
          <?php include_once("admin_new_modal.php"); ?>
          <div class="d-flex">
            <a href="#addnew" class="btn btn-warning text-dark btn-sm mx-0 my-2" data-bs-toggle="modal"><i class="bi bi-plus-square me-2"></i>Add new admin</a>
          </div>
          <div class="table-responsive">
            <table class="table text-white" id="myTable">
              <thead>
                <tr>
                  <th scope="col">ID #</th>
                  <th scope="col">Firstname</th>
                  <th scope="col">Lastname</th>
                  <th scope="col">Username</th>
                  <th scope="col">Password</th>
                  <th scope="col">Email</th>
                  <th scope="col">Action</th>
                </tr>
                </tr>
              </thead>
              <tbody>

                <?php
                include_once('../includes/pdocon.php');

                $database = new Connection();
                $db = $database->open();
                try {
                  $sql = 'SELECT * FROM tb_admin';
                ?>
                  <?php 
                  foreach ($db->query($sql) as $row) {
                  ?>
                    <tr>
                      <td><?php echo $row['admin_id']; ?></td>
                      <td><?php echo $row['firstname']; ?></td>
                      <td><?php echo $row['lastname']; ?></td>
                      <td><?php echo $row['admin_username']; ?></td>
                      <td><?php echo $row['password']; ?></td>
                      <td><?php echo $row['email']; ?></td>

                      <td>
                        <a href="#edit_<?php echo $row['admin_id']; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit_<?php echo $row['admin_id']; ?>">
                          <i class="bi bi-pencil-square me-1"></i> Edit</a>

                        <a href="#delete_<?php echo $row['admin_id']; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_<?php echo $row['admin_id']; ?>">
                          <i class="bi bi-trash me-1"></i>Delete</a>

                      </td>
                      <?php include('admin_edit_delete_modal.php'); ?>
                    </tr>
                <?php
                  }
                } catch (PDOException $e) {
                  echo "There is some problem in connection: " . $e->getMessage();
                }
                $database->close();
                ?>
              </tbody>

            </table>
          </div>

        </div>
      </div> 
    </div>
  </div>
  
  <!-- Table End -->

  <?php include_once "../includes/footer.php" ?>