<?php 
include 'config.php';
$id=$_POST['id'];
$nama=$_POST['nama'];
$modal=$_POST['modal'];
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

function cekHarga(int $harga){
    
    $angka = $harga;
    $angkaTemp = round($angka, -3);
    if($angkaTemp<$angka)
    {
        // echo "masuk sini";
        $angkaAkhir = $angkaTemp+=500;
    }else{
        // echo "masuk bawah";
        $angkaAkhir = $angkaTemp;
    }
    return $angkaAkhir;
}

$grosirFinal = cekHarga($grosir_price);
$semiFinal = cekHarga($semi_grosir_price);
$ecerFinal = cekHarga($ecer_price);
$pkp1_price = ceil(($pkp1_percent/100 * $ecerFinal)) +  $ecerFinal;
$pkp2_price = ceil(($pkp2_percent/100 * $ecerFinal)) +  $ecerFinal;

$pkp1Final = cekHarga($pkp1_price);
$pkp2Final = cekHarga($pkp2_price);


$result = mysqli_query($con, "update barang set nama='$nama', modal='$modal', grosir='$grosirFinal', semi='$semiFinal', ecer='$ecerFinal', pkp1='$pkp1Final' , pkp2='$pkp2Final' , jumlah='$sisa' , sisa='$sisa' where id='$id'");

if (!$result) {
    // echo "MASUK BAWAH";
    throw new Exception(mysqli_error($con));
}else{
    // echo $id;
    // echo "MASUK SINI";
    header("location:dashboard.php");
}

?>