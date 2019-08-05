<?php 
session_start();
include 'admin/config.php';

$con = mysqli_connect("localhost","root","","lancarjaya");
// $con = mysqli_connect("localhost","u112715437_root","taufan1204","u112715437_store");
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


// echo "modal ".$modal."<br>";
// echo "grosir ".cekHarga($grosir_price)."<br>";
// echo "semi grosir ".cekHarga($semi_grosir_price)."<br>";

// echo "ecer grosir ".cekHarga($ecer_price)."<br>";


// $pkp1_price = ceil(($pkp1_percent/100 * $hargaEcertemp)) +  $hargaEcertemp;
// $pkp2_price = ceil(($pkp2_percent/100 * $hargaEcertemp)) +  $hargaEcertemp;

// echo "pkp1 grosir ".cekHarga($pkp1_price)."<br>";
// echo "pkp2 grosir ".cekHarga($pkp2_price)."<br>";


$grosirFinal = cekHarga($grosir_price);
$semiFinal = cekHarga($semi_grosir_price);
$ecerFinal = cekHarga($ecer_price);
$pkp1_price = ceil(($pkp1_percent/100 * $ecerFinal)) +  $ecerFinal;
$pkp2_price = ceil(($pkp2_percent/100 * $ecerFinal)) +  $ecerFinal;

$pkp1Final = cekHarga($pkp1_price);
$pkp2Final = cekHarga($pkp2_price);



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

// $angkaTemp = ceil((7200 /1000))*1000;
// echo $angkaTemp;



// echo "7200" ." ".round(7200, -3, PHP_ROUND_HALF_EVEN);
// echo "<br>";

$cekNamaBarang = mysqli_query($con, "select * from barang where nama='$nama'");
if(mysqli_num_rows($cekNamaBarang)>0){
    $row = mysqli_fetch_array($cekNamaBarang);
    $id = $row["id"];
    $jumlahSekarang = $row["jumlah"] + $jumlah;
    $sisaSekarang = $row["sisa"] + $sisa;
    $result = mysqli_query($con, "update barang set  nama='$nama', modal='$modal', grosir='$grosirFinal', semi='$semiFinal', ecer='$ecerFinal', pkp1='$pkp1Final' , pkp2='$pkp2Final' , jumlah='$jumlahSekarang' , sisa='$sisaSekarang' where id='$id'");
}else{
    $result = mysqli_query($con, "insert into barang values('','$nama','$modal','$grosirFinal','$semiFinal','$ecerFinal','$pkp1Final','$pkp2Final','$jumlah','$sisa')");
}

if (!$result) {
    throw new Exception(mysqli_error($con));
}else{
    echo "sukses";
}
 ?>