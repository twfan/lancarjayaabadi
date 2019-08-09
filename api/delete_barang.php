<?php 
include '../config.php';
$id=$_POST['id'];
mysqli_query($con,"delete from barang where id='$id'");
echo "sukses";

?>