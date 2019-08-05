<?php 
// session_start();
// include 'admin/config.php';

// $con = mysqli_connect("localhost","u112715437_root","taufan1204","u112715437_store");
$con = mysqli_connect("localhost","root","","lancarjaya");
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