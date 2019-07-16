<?php
include 'config.php';

$toko = $_POST['toko'];
$nama = $_POST['nama'];
$total_transaksi = $_POST['totalTransaksi'];

$discount_data = mysqli_query($con, "select * from settings");
$discount_percent = mysqli_fetch_array($discount_data);

$grosir_percent = $discount_percent['grosir'];
$semi_grosir_percent = $discount_percent['semi_grosir'];
$ecer_percent = $discount_percent['ecer'];
$pkp1_percent = $discount_percent['pkp1'];
$pkp2_percent = $discount_percent['pkp2'];

// jenis_pembelian = harga modal * persentase_jenis_pembelian
// harga jual = [jenis_pembelian] + harga modal

$grosir_price = ($grosir_percent / 100 * $modal) +  $modal;
$semi_grosir_price = ($semi_grosir_percent / 100 * $modal) +  $modal;
$ecer_price = ($ecer_percent / 100 * $modal) +  $modal;
$pkp1_price = ceil(($pkp1_percent / 100 * $ecer_price)) +  $ecer_price;
$pkp2_price = ceil(($pkp2_percent / 100 * $ecer_price)) +  $ecer_price;

$cari = mysqli_real_escape_string($con,$nama);
$brg = mysqli_query($con, "select * from barang where nama = '$cari' ");
if ($brg) {
    while ($b = mysqli_fetch_array($brg)) {
        $id = $b["id"];
        $stock_sisa = $b["sisa"];
        $stock_akhir = $stock_sisa + $jumlah;

        $result = mysqli_query($con, "UPDATE `barang` SET `modal` = $modal, `sisa` = $stock_akhir WHERE `barang`.`id` = $id");
        if (!$result) {
            throw new Exception(mysqli_error($con));
        } else {
            header("location:dashboard.php");
        }
    }
} else {
    $result = mysqli_query($con, "insert into barang values('','$nama','$modal','$grosir_price','$semi_grosir_price','$ecer_price','$pkp1_price','$pkp2_price','$jumlah')");
    if (!$result) {
        throw new Exception(mysqli_error($con));
    } else {
        header("location:dashboard.php");
    }
}
?>