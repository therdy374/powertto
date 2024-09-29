<?php

$host = "localhost";
$user = "root";
$pass = "";
$database = "u245217918_powertto";

$conn = mysqli_connect("$host", "$user", "$pass", "$database");

if(empty(session_id()) && !headers_sent()){
    session_start();
}


// $host = "localhost";
// $user = "u245217918_powertto";
// $pass = "QdI+UUy[5g";
// $database = "u245217918_powertto";

// $conn = mysqli_connect("$host", "$user", "$pass", "$database");

// if(empty(session_id()) && !headers_sent()){
//     session_start();
// }


?>