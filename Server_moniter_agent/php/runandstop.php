
<?php require"runstop.php"; ?>


<?php
session_start();
require "conn.php";
// Code to fetch RAM Usage
        // Command to get available Physical Memory

        $cmd1 = shell_exec("systeminfo | find \"Available Physical Memory\"");

        // Command to get Total Physical Memory
        $cmd2 = shell_exec("systeminfo | findstr \"Total Physical Memory\"");
        $pattern = '!\d+!';

        if (preg_match_all($pattern, $cmd1, $matches)) {            
            $elems = count($matches[0]);
            if($elems == 2){
                $v1 = $matches[0][0];
                $v2 = $matches[0][1];
                $freeSpace = $v1 . $v2;
            }
            else{
                $freeSpace = $matches[0][0];
            }
        }

        if (preg_match_all($pattern, $cmd2, $matche)) {

            $v3 = $matche[0][0];
            $v4 = $matche[0][1];

            $totalSpace = $v3 . $v4;

            $usedSpace = $totalSpace - $freeSpace;
        }

        // Code to fetch Disk Storage
        // Command to Get Full Disk Storage
        $st = shell_exec("wmic diskdrive get size");

        // Command to Get Free Disk Storage
        $sk = shell_exec("wmic logicaldisk get freespace");

        $pattern = '!\d+!';

        if (preg_match_all($pattern, $st, $matches)) {
            $TotalStorage = $matches[0][0]; // Free Storage -- //38 for sent reciev loss data pack multiple line
            $TotalStorage = $TotalStorage / (1000 * 1000 * 1000);
        }

        if (preg_match_all($pattern, $sk, $matche)) {
            $availableStorage = $matche[0][0]; //38 for sent reciev loss data pack multiple line
            $availableStorage = $availableStorage / (1024 * 1024 * 1024);
        }

        $usedStorage = $TotalStorage - $availableStorage;

        // CPU Utilization Current Data Code
        $st = shell_exec("typeperf  \"\Processor(_Total)\% Processor Time\" -sc 1");

        $pattern = "/\d+\.[0-9][0-9][0-9][0-9]\d+/i";
        $patern1 = "/(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?/";

        if (preg_match_all($pattern, $st, $matches)) {

            // CPU Utilization Values  

            $CpuUtilVal1 = $matches[0][0];
            
        }

        if (preg_match_all($patern1, $st, $matches)) {

            // Time Intervals 

            $t1 = $matches[0][0];
           
        }
//network matrices
 $name = "www.google.com";
            $st = shell_exec("ping  -n 10 " . $name);

            $patternerror = "/Request timed out/i";
            $snew = preg_replace($patternerror, 'time=0ms', $st);

            $pattern = "/time=\d+|Sent = \d+| Received = \d+|Lost = \d+|Minimum = \d+|Maximum = \d+|Average = \d+/i";

            if (preg_match_all($pattern, $snew, $matches)) {
            }


            $timestr = $matches[0][0] . $matches[0][1] . $matches[0][2] . $matches[0][3] . $matches[0][4] . $matches[0][5] . $matches[0][6] . $matches[0][7] . $matches[0][8] . $matches[0][9] . $matches[0][10] . $matches[0][11] . $matches[0][12] . $matches[0][13] . $matches[0][14] . $matches[0][15];    //array string pass to next sorting no pattern
            $patern1 = '!\d+!';

            if (preg_match_all($patern1, $timestr, $match1)) {
                $val = $match1[0][0];         //latency value 
                $val1 = $match1[0][1];
                $val2 = $match1[0][2];
                $val3 = $match1[0][3];
                $val4 = $match1[0][4];
                $val5 = $match1[0][5];
                $val6 = $match1[0][4];
                $val7 = $match1[0][7];
                $val8 = $match1[0][8];
                $val9 = $match1[0][9];         //latency value 
                $sent = $match1[0][10];        //sent packet
                $received = $match1[0][11];    //rec packet
                $lost = $match1[0][12];        //lost packet
                $minimum = $match1[0][13];     //minimum latency
                $maximum = $match1[0][14];     //maximum
                $average = $match1[0][15];     //average
            }

//            $s = shell_exec(" tracert -h 5 ". $name);
//
//            $pattern1 = "/\*/i";
//            $snew = preg_replace($pattern1, '0 ms', $s);
//            $pattern2 = "/\d+ ms/i";
//
//            if (preg_match_all($pattern2, $snew, $matches)) {
//            }
//
//            $newstring = $matches[0][0] . $matches[0][1] . $matches[0][2] . $matches[0][3] . $matches[0][4] . $matches[0][5] . $matches[0][6] . $matches[0][7] . $matches[0][8] . $matches[0][9] . $matches[0][10] . $matches[0][11] . $matches[0][12] . $matches[0][13] . $matches[0][14];
//            $pattern3 = "/\d+/i";
//
//            if (preg_match_all($pattern3, $newstring, $matches2)) {
//                $r11 = $matches2[0][0];
//                $r12 = $matches2[0][3];
//                $r13 = $matches2[0][6];
//                $r14 = $matches2[0][9];
//                $r15 = $matches2[0][12];
//                $r21 = $matches2[0][1];
//                $r22 = $matches2[0][4];
//                $r23 = $matches2[0][7];
//                $r24 = $matches2[0][10];
//                $r25 = $matches2[0][13];
//                $r31 = $matches2[0][2];
//                $r32 = $matches2[0][5];
//                $r33 = $matches2[0][8];
//                $r34 = $matches2[0][11];
//                $r35 = $matches2[0][14];
//            }





// To Fetch any critical contidion of Server (for storing in alert table)
$CpuAlert = 0;
$RamAlert = 0;
$diskStorageAlert = 0;

if ((int) $CpuUtilVal1 >  90) {
  $CpuAlert = 1;
}
if ($usedSpace > (0.9 * $totalSpace)) {
  $RamAlert = 1;
}
if ($usedStorage > (0.9 * $TotalStorage)) {
  $diskStorageAlert = 1;
}

// Inserting Data in Database

$system_id=$_SESSION['system_id'];
echo $system_id;
$query = " INSERT INTO resources(cpu_util, time, total_ram, ava_ram, use_ram, total_store, ava_store, use_store, system_id) values('$CpuUtilVal1', '$t1','$totalSpace','$freeSpace','$usedSpace','$TotalStorage','$availableStorage','$usedStorage','$system_id' )";

if (mysqli_query($conn, $query)) {
} else {
  echo 'Unable to Not Inserted';
}//

$query1 = "update network set system_id='$system_id',sent='$sent',received='$received',loss='$lost',maximum='$maximum',minimum='$minimum',average='$average',val1='$val',val2='$val1',val3='$val2',val4='$val3',val5='$val4',val6='$val5',val7='$val6',val8='$val7',val9='$val8',val10='$val9' where system_id='$system_id'";

if (mysqli_query($conn, $query1)) {
} else {
  echo 'Unable to Not Inserted';
}//

if ($CpuAlert == 1 || $RamAlert == 1 || $diskStorageAlert == 1) {
  $query3 = "INSERT INTO logs (cpu_log, ram_log, store_log, time, system_id) values('$CpuUtilVal1','$usedSpace','$usedStorage', '$t1','$system_id' )"; 
  
  if (mysqli_query($conn, $query3)) {
  } else {
    echo 'Unable to Not Inserted';
  }
}







// To execute code again and again 
echo("<meta http-equiv='refresh' content='1'>");


 
// mysqli_close($conn);
?>