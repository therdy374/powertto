<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "u245217918_powertto";
 
 $conn = mysqli_connect($servername, $username, $password, $dbname);

 if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
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