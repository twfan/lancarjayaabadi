<?php 
include 'config.php';
$id=$_GET['id'];
mysqli_query($con,"delete from cart where id='$id'");
header("location:penjualan.php?tipeHarga".$_SESSION["tipeHarga"]);

?>