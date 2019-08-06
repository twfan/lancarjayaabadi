<?php 
include 'config.php';
session_start();

$idBrg=$_POST['id_barang'];
$id=$_POST['id'];
$nama=$_POST['nama'];
$harga=$_POST['harga'];
$banyak=$_POST['banyak'];

$jumlah= $banyak * $harga;
$tipe_harga=$_POST['tipe_harga'];



$result = mysqli_query($con, "update cart set id_barang='$idBrg', nama_barang='$nama', banyak='$banyak', harga='$harga', jumlah='$jumlah', tipe_harga='$tipe_harga' where id='$id'");

if (!$result) {
    // echo "MASUK BAWAH";
    throw new Exception(mysqli_error($con));
}else{
    // echo $id;
    // echo "MASUK SINI";
    header("location:penjualan.php?tipeHarga=".$_SESSION["tipeHarga"]);
}

?>