<?php

$currentDate = new DateTime();
$yesterday = $currentDate->modify('-1 day');


$formattedYesterday = $yesterday->format('Y-m-d');


echo "Yesterday's date: $formattedYesterday";
?>