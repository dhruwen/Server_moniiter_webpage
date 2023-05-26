<?php

// Connection to Database (Server Monitor)


$host = "mysql-100425-0.cloudclusters.net";
$username = "admin";
$pass = "9AAL1aRk";
$db = "monnit";
$dbServerPort = 10126;
$conn = mysqli_connect($host, $username, $pass, $db,$dbServerPort);

if(!$conn){
    echo "Unable to Connect to Database";
}
else{
}
?>