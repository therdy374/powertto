<?php
  include "../includes/connect.php";
  date_default_timezone_set('Asia/Seoul');

if (isset($_POST['search'])) {
    $selectedDate = $_POST['selected-date'];
} else {
    $selectedDate = date('Y-m-d');
}

?>