<?php

require "conn.php";
    $username=$_POST['email'];
 $password=$_POST['pass']; 
$system_id=$_POST['system_id'];


$cpuname=shell_exec("wmic cpu get name /value");


$cpuvolt=shell_exec("wmic cpu get currentvoltage /value");


$cpumaxclockspeed=shell_exec("wmic cpu get maxclockspeed /value ");


// Inserting Data in Database
$query = "insert into cpu_info values('$cpuname','$cpumaxclockspeed','$cpuvolt','$system_id')";

if (mysqli_query($conn, $query)) {
} else {
  echo 'Unable to Not Inserted';
}//
$query1 = "insert into user values('$username','$password','$system_id')";

if (mysqli_query($conn, $query1)) {
} else {
  echo 'Unable to Not Inserted';
}//
$query2 = "insert into network values('$system_id','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1' )";

if (mysqli_query($conn, $query2)) {
} else {
  echo 'Unable to Not Inserted';
}



header("Location:index.html",true,301);

?>