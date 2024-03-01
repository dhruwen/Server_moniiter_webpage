<?php

// Connection to Database (Server Monitor)


$host = "mysql-99212-0.cloudclusters.net";
$username = "admin";
$pass = "75Qnflt1";
$db = "monnit1";
$dbServerPort = 10007;
$conn = mysqli_connect($host, $username, $pass, $db,$dbServerPort);

if(!$conn){
    echo "Unable to Connect to Database";
}
else{
}
?>