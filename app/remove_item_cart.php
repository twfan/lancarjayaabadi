<?php 
session_start();
include 'config.php';
mysqli_query($con,"delete from cart");
// header("location:penjualan.php?tipeHarga=".$_SESSION["tipeHarga"]);
?>