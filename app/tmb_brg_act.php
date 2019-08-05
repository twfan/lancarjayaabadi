<?php
include 'config.php';

$nama = $_POST['nama'];
$modal = $_POST['modal'];
$jumlah = $_POST['jumlah'];

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

$cekNamaBarang = mysqli_query($con, "select * from barang where nama='$nama'");
if(mysqli_num_rows($cekNamaBarang)>0){
    $row = mysqli_fetch_array($cekNamaBarang);
    $id = $row["id"];
    $jumlahSekarang = $row["jumlah"] + $jumlah;
    $sisaSekarang = $row["sisa"] + $sisa;
    $result = mysqli_query($con, "update barang set  nama='$nama', modal='$modal', grosir='$grosir_price', semi='$semi_grosir_price', ecer='$ecer_price', pkp1='$pkp1_price' , pkp2='$pkp2_price' , jumlah='$jumlahSekarang' , sisa='$sisaSekarang' where id='$id'");
    header("location:dashboard.php");
}else{
    $result = mysqli_query($con, "insert into barang values('','$nama','$modal','$grosir_price','$semi_grosir_price','$ecer_price','$pkp1_price','$pkp2_price','$jumlah','$sisa')");
    header("location:dashboard.php");
}

if (!$result) {
    throw new Exception(mysqli_error($con));
}else{
    header("location:dashboard.php");
}




// $cari = mysqli_real_escape_string($con,$nama);
// $brg = mysqli_query($con, "select * from barang where nama = '$cari' ");
// // var_dump($brg);
// if ($brg) {
//     echo "masuk atas";
//     while ($b = mysqli_fetch_array($brg)) {
//         $id = $b["id"];
//         $stock_sisa = $b["sisa"];
//         $stock_akhir = $stock_sisa + $jumlah;

//         $result = mysqli_query($con, "UPDATE `barang` SET `modal` = $modal, `sisa` = $stock_akhir WHERE `barang`.`id` = $id");
//         if (!$result) {
//             throw new Exception(mysqli_error($con));
//         } else {
//             header("location:dashboard.php");
//         }
//     }
// } else {
    
//     echo "masuk bawah";
//     $result = mysqli_query($con, "insert into barang values('','$nama','$modal','$grosir_price','$semi_grosir_price','$ecer_price','$pkp1_price','$pkp2_price','$jumlah')");
//     if (!$result) {
//         throw new Exception(mysqli_error($con));
//     } else {
//         header("location:dashboard.php");
//     }
// }
