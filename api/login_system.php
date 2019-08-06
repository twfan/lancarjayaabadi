<?php 
// session_start();

include '../config.php';

$uname=$_POST['username'];
$pass=$_POST['password'];
$pas=md5($pass);
$query=mysqli_query($con, "select * from admin where uname='$uname' and pass='$pas'");
if(mysqli_num_rows($query)==1){
	$arrData = array(
		'message' => 'success',
	);
	echo "success";
}else{
	$arrData = array(
		'message' => 'failed',
	);
	echo "failed";
}
// echo $pas;
 ?>