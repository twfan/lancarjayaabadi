<?php
include 'config.php';

$nama = $_POST['nama'];
$modal = $_POST['modal'];
$jumlah = $_POST['jumlah'];
$sisa = $_POST['jumlah'];

$discount_data = mysqli_query($con, "select * from settings");
$discount_percent = mysqli_fetch_array($discount_data);

$grosir_percent = $discount_percent['grosir'];
$semi_grosir_percent = $discount_percent['semi_grosir'];
$ecer_percent = $discount_percent['ecer'];
$pkp1_percent = $discount_percent['pkp1'];
$pkp2_percent = $discount_percent['pkp2'];

$grosir_price = ($grosir_percent / 100 * $modal) +  $modal;
$semi_grosir_price = ($semi_grosir_percent / 100 * $modal) +  $modal;
$ecer_price = ($ecer_percent / 100 * $modal) +  $modal;

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

$cekNamaBarang = mysqli_query($con, "select * from barang where nama='$nama'");
if(mysqli_num_rows($cekNamaBarang)>0){
    $row = mysqli_fetch_array($cekNamaBarang);
    $id = $row["id"];
    $jumlahSekarang = $row["jumlah"] + $jumlah;
    $sisaSekarang = $row["sisa"] + $sisa;
    $result = mysqli_query($con, "update barang set  nama='$nama', modal='$modal', grosir='$grosirFinal', semi='$semiFinal', ecer='$ecerFinal', pkp1='$pkp1Final' , pkp2='$pkp2Final' , jumlah='$jumlahSekarang' , sisa='$sisaSekarang' where id='$id'");
    header("location:dashboard.php");
}else{
    $result = mysqli_query($con, "insert into barang values('','$nama','$modal','$grosirFinal','$semiFinal','$ecerFinal','$pkp1Final','$pkp2Final','$jumlah','$sisa')");
    header("location:dashboard.php");
}

if (!$result) {
    throw new Exception(mysqli_error($con));
}else{
    header("location:dashboard.php");
}
