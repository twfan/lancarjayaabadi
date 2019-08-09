<?php 
include 'config.php';
session_start();

$id=$_POST['id'];
mysqli_query($con,"delete from barang where id='$id'");
header("location:penjualan.php?tipeHarga=".$_SESSION["tipeHarga"]);
?>