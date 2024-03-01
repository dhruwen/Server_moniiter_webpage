<?php 
session_start();
require "conn.php";
    $username=$_POST['email'];
 $password=$_POST['pass']; 
$system_id=$_POST['system_id'];

$sql ="select *from user where email ='$username' and password ='$password'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count= mysqli_num_rows($result);
if($count == 1){
 
$_SESSION['system_id']=$system_id;
     header("Location:runstop.php",true,301);
}
else{
 echo "<script>alert('check your password and username')</script>";

}  ?>