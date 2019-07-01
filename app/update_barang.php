<?php 
include 'config.php';
$id=$_POST['id'];
$nama=$_POST['nama'];
$modal=$_POST['modal'];
$jumlah=$_POST['jumlah'];
$sisa=$_POST['sisa'];



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
$pkp1_price = ceil(($pkp1_percent/100 * $ecer_price)) +  $ecer_price;
$pkp2_price = ceil(($pkp2_percent/100 * $ecer_price)) +  $ecer_price;


$update = mysqli_query($con, "UPDATE barang SET nama='$nama', modal='$modal', grosir='$grosir_price', semi='$semi_grosir_price', ecer='$ecer_price', pkp1='$pkp1_price', pkp2='$pkp2_price', jumlah='$jumlah', sisa='$sisa' WHERE id='$id'");

if (!$update) {
    // echo "MASUK BAWAH";
    throw new Exception(mysqli_error($con));
}else{
    // echo $id;
    // echo "MASUK SINI";
    header("location:dashboard.php");
}

?>