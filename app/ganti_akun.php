<?php 

include 'config.php';

$username=$_POST['username'];
$password=$_POST['password'];
$konf_password=$_POST['konf_password'];
if($password == $konf_password){
    $password_encrypt = md5($password);
}

$result = mysqli_query($con, "update admin set  uname='$username', pass='$password_encrypt' ");

if (!$result) {
    throw new Exception(mysqli_error($con));
}else{
    header("location:index.php");
    // echo "Sukses";
}
 ?>