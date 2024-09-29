<?php

define('DB_SERVER',"localhost");
define('DB_USERNAME',"root");
define('DB_PASSWORD',"");
define('DB_DATABASE','u245217918_powertto');


$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);


if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}


// define('DB_SERVER',"localhost");
// define('DB_USERNAME',"u245217918_powertto");
// define('DB_PASSWORD',"QdI+UUy[5g");
// define('DB_DATABASE','u245217918_powertto');


// $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);


// if(!$conn){
//     die("Connection failed: " . mysqli_connect_error());
// }




?>