<?php 
include 'config.php';



$nama=$_POST['nama'];
$modal=$_POST['modal'];
$jumlah=$_POST['jumlah'];
$sisa=$_POST['jumlah'];

$discount_data = mysqli_query($con, "select * from settings");
$discount_percent = mysqli_fetch_array($discount_data);

$grosir_percent = $discount_percent['grosir'];
$semi_grosir_percent = $discount_percent['semi_grosir'];
$ecer_percent = $discount_percent['ecer'];
$pkp1_percent = $discount_percent['pkp1'];
$pkp2_percent = $discount_percent['pkp2'];

// jenis_pembelian = harga modal * persentase_jenis_pembelian
// harga jual = [jenis_pembelian] + harga modal

$grosir_price = ($grosir_percent/100 * $modal) +  $modal;
$semi_grosir_price = ($semi_grosir_percent/100 * $modal) +  $modal;
$ecer_price = ($ecer_percent/100 * $modal) +  $modal;
$pkp1_price = ceil(($pkp1_percent/100 * $ecer_price)) +  $modal;
$pkp2_price = ceil(($pkp2_percent/100 * $ecer_price)) +  $modal;


echo " harga grosir = ".$grosir_price. " harga semi_grosir = ".$semi_grosir_price. " harga ecer = ".$ecer_price. " harga pkp1 = ".$pkp1_price." harga pkp2 = ".$pkp2_price ; 



$result = mysqli_query($con, "insert into barang values('','$nama','$modal','$grosir_price','$semi_grosir_price','$ecer_price','$pkp1_price','$pkp2_price','$jumlah','$sisa')");
if (!$result) {
    throw new Exception(mysqli_error($con));
}else{
    header("location:barang.php");
}

 ?>