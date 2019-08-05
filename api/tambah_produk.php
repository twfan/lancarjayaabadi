<?php 
// session_start();
// include 'admin/config.php';

$con = mysqli_connect("localhost","root","","lancarjaya");
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

// echo $grosir_price ." ". round($grosir_price, -3);
// echo "<br>";
// echo $semi_grosir_price ." ". round($semi_grosir_price, -3);
// echo "<br>";
// echo $ecer_price ." ".round($ecer_price, -3);
// echo "<br>";
// echo $pkp1_price ." ".round($pkp1_price, -3);
// echo "<br>";
// echo $pkp2_price ." ".round($pkp2_price, -3);
// echo "<br>";

$cekNamaBarang = mysqli_query($con, "select * from barang where nama='$nama'");
if(mysqli_num_rows($cekNamaBarang)>0){
    $row = mysqli_fetch_array($cekNamaBarang);
    $id = $row["id"];
    $jumlahSekarang = $row["jumlah"] + $jumlah;
    $sisaSekarang = $row["sisa"] + $sisa;
    $result = mysqli_query($con, "update barang set  nama='$nama', modal='$modal', grosir='$grosir_price', semi='$semi_grosir_price', ecer='$ecer_price', pkp1='$pkp1_price' , pkp2='$pkp2_price' , jumlah='$jumlahSekarang' , sisa='$sisaSekarang' where id='$id'");
}else{
    $result = mysqli_query($con, "insert into barang values('','$nama','$modal','$grosir_price','$semi_grosir_price','$ecer_price','$pkp1_price','$pkp2_price','$jumlah','$sisa')");
}

if (!$result) {
    throw new Exception(mysqli_error($con));
}else{
    echo "sukses";
}
 ?>