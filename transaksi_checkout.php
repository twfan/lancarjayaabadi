<?php
include 'config.php';

$toko = $_POST['toko'];
$nama = $_POST['nama'];
$total_transaksi = $_POST['totalTransaksi'];
$total_barang = $_POST['totalBarang'];
$tanggalSekarang = date("Y-m-d");

$result = mysqli_query($con, "insert into transaksi values('','$toko','$nama','$total_transaksi','$total_barang','$tanggalSekarang')");
if (!$result) {
    throw new Exception(mysqli_error($con));
} else {

    // var_dump($result);

    $data = mysqli_query($con, "select * from transaksi ORDER BY id DESC LIMIT 1");
    
    if($data){
        while ($x = mysqli_fetch_array($data)) {
            $idTransaksi = $x["id"];
        }
    }

    // var_dump($idTransaksi);

    $cari = mysqli_real_escape_string($con, $nama);
    $brg = mysqli_query($con, "select * from cart");
    if ($brg) {
        while ($b = mysqli_fetch_array($brg)) {

            $idBarang = $b["id_barang"];
            $namaBarang = $b["nama_barang"];
            $banyak = $b["banyak"];
            $harga = $b["harga"];
            $jumlah = $b["jumlah"];
            $tipeHarga = $b["tipe_harga"];

            $barang = mysqli_query($con, "select * from barang where id='$idBarang' ");
            $dataBarang = mysqli_fetch_assoc($barang);
            $stock_akhir = $dataBarang["sisa"] - $banyak;

            $result = mysqli_query($con, "insert into transaksi_detail values('','$idTransaksi','$idBarang','$namaBarang','$banyak','$harga','$jumlah','$tipeHarga')");
            $update_barang_stock = mysqli_query($con, "UPDATE `barang` SET `jumlah` = $stock_akhir, `sisa` = $stock_akhir WHERE `barang`.`id` = $idBarang");
        }

        include 'remove_item_cart.php';
        header("Refresh:0; url=cetak.php?idTransaksi=". $idTransaksi);
    }
}

?>