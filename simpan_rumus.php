<?php 

include 'config.php';

$grosir=$_POST['grosir'];
$semi_grosir=$_POST['semi'];
$ecer=$_POST['ecer'];
$pkp1=$_POST['pkp1'];
$pkp2=$_POST['pkp2'];

$result = mysqli_query($con, "update settings set  grosir='$grosir', semi_grosir='$semi_grosir', ecer='$ecer', pkp1='$pkp1', pkp2='$pkp2' ");

if (!$result) {
    throw new Exception(mysqli_error($con));
}else{
    header("location:settings.php");
}
 ?>