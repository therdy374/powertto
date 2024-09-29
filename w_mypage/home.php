<?php
session_start(); //we need session for the log in thingy XD 
// include("functions.php");
// if ($_SESSION['login'] !== true) {
//   header('location:login.php');
// }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pending Request System in PHP and MySql</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>

    <header>
        <div class="navbar navbar-dark bg-dark box-shadow">
            <div class="container d-flex justify-content-between">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <strong>Hi, <?= $_SESSION['loggedInUser']['name']; ?></strong>
                </a>
                <div class="pull-right">
                    <?php
                    if (isset($_POST['logout'])) {
                        session_destroy();
                        header('location:../index.php');
                    }

                    ?>
                    <form method="post">
                        <button name="logout" class="btn btn-danger my-2">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <?php
                include "../includes/connect.php";

                $query = "select * from `users_request_deposit`;";
                $res = mysqli_query($conn, $query);


                while ($run_query = mysqli_fetch_array($res)) {
                ?>

                    <h1 class="jumbotron-heading"><?php echo $run_query['name'] ?></h1>
                    <p class="lead text-muted"><?php echo $run_query['message'] ?></p>
                    <p>
                        <a href="accept.php?id=<?php echo $run_query['id'] ?>" class="btn btn-primary my-2">Accept</a>
                        <a href="reject.php?id=<?php echo $run_query['id'] ?>" class="btn btn-secondary my-2">Reject</a>
                    </p>
                    <small><i><?php echo $run_query['date_request'] ?></i></small>
                <?php
                }
                
                ?>

            </div>

        </section>

    </main>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>