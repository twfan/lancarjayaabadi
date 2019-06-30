<?php 
session_start();
include 'config.php';
$uname=$_POST['uname'];
$pass=$_POST['pass'];
$pas=md5($pass);

// echo $uname;
// echo $pas;

// echo "select * from admin where uname='$uname' AND pass='$pas'";

$query=mysqli_query($con, "select * from admin where uname='$uname' AND pass='$pas'");
// echo var_dump($query);

if(mysqli_num_rows($query)==1){
	$_SESSION['uname']=$uname;
	header("location:index.php");
	// echo "masuk sini";
}else{
	// echo "masuk bawah";
	header("location:login.php?pesan=gagal")or die(mysql_error());
	// mysql_error();
}


// echo $pas;
 ?>