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
$CpuUtilization=array();
$t=array();

$query="(SELECT * FROM resources ORDER BY id DESC LIMIT 5) ORDER BY id ASC";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {

        array_push($CpuUtilization, (float) $row["cpu_util"]);
  array_push($t, (string)($row["time"]));
    
}

      //print_r($CpuUtilization);
 $query="(SELECT * FROM resources ORDER BY id DESC LIMIT 1) ORDER BY id ASC";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {

$use_ram=$row['use_ram'];
 $total_ram=$row['total_ram'];
$ava_ram=$row['ava_ram'];     
    $use_store=$row['use_store'];
 $total_store=$row['total_store'];
$ava_store=$row['ava_store'];     
}
 $query="SELECT * FROM network";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {

$sent=$row['sent'];    
$received=$row['received'];
    $loss=$row['loss'];
    $maximum=$row['maximum'];
    $minimum=$row['minimum'];
    $average=$row['average'];
                $val1 =$row['val1'];                    //latency value 
                $val2 = $row['val2'];  
                $val3 = $row['val3']; 
                $val4 = $row['val4']; 
                $val5 = $row['val5']; 
                $val6 = $row['val6']; 
                $val7 = $row['val7']; 
                $val8 = $row['val8']; 
                $val9 = $row['val9']; 
                $val10 = $row['val10']; 
}

// To execute code again and again 
echo("<meta http-equiv='refresh' content='1'>");






?>


