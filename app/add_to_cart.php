<?php
include 'config.php';

session_start();

$stock_cart_akhir = 0;
$grosir = 0;
$semi = 0;
$ecer = 0;
$pkp1 = 0;
$pkp2 = 0;
$harga = 0;
$total_harga_sementara =


$nama = $_POST['namaBarang'];
$jumlah = $_POST['banyak'];

$cari = mysqli_real_escape_string($con, $nama);
$brgData = mysqli_query($con, "select * from barang where nama='$cari'");
if (!$brgData) {
    // var_dump($brgData);
    header("location:penjualan.php?tipeHarga=" . $_SESSION["tipeHarga"]);
} else {
    // echo "masuk bawah";
    // var_dump($brgData);
    while ($data = mysqli_fetch_array($brgData)) {
        $id_barang = $data['id'];
        $nama_barang = $data['nama'];
        $stock = $data['sisa'];
        $grosir = $data['grosir'];
        $semi = $data['semi'];
        $ecer = $data['ecer'];
        $pkp1 = $data['pkp1'];
        $pkp2 = $data['pkp2'];
    }

    // $query_join = "SELECT `cart`.`id_barang`, `cart`.`nama_barang`, `cart`.`banyak`, `barang`.`grosir`, `barang`.`semi`, `barang`.`ecer`, `barang`.`pkp1`, `barang`.`pkp2` FROM `cart` INNER JOIN `barang` ON `cart`.`id_barang` = `barang`.`id` WHERE `cart`.`id_barang`=$id_barang";
    // $hargaBarang = mysqli_query($con, $query_join);

    // while ($data = mysqli_fetch_array($hargaBarang)) {
    //     $grosir = $data['grosir'];
    //     $semi = $data['semi'];
    //     $ecer = $data['ecer'];
    //     $pkp1 = $data['pkp1'];
    //     $pkp2 = $data['pkp2'];
    // }

    if ($jumlah > $stock) {
        $_SESSION["stock"] = "kurang";
        header("location:penjualan.php?tipeHarga=" . $_SESSION["tipeHarga"]);
    } else {
        // echo $id_barang;
        // $cart_cari_data_id = mysqli_real_escape_string($con, $id_barang);
        if($_SESSION["tipeHarga"]=="grosir"){
            $harga = $grosir;
            $total_harga_sementara = $jumlah * $harga;
        }else if($_SESSION["tipeHarga"]=="semi"){
            $harga = $semi;
            $total_harga_sementara = $jumlah * $harga;
        }else if($_SESSION["tipeHarga"]=="ecer"){
            $harga = $ecer;
            $total_harga_sementara = $jumlah * $harga;
        }else if($_SESSION["tipeHarga"]=="pkp1"){
            $harga = $pkp1;
            $total_harga_sementara = $jumlah * $harga;
        }else if($_SESSION["tipeHarga"]=="pkp2"){
            $harga = $pkp2;
            $total_harga_sementara = $jumlah * $harga;
        }
        
        
        $cart_data = mysqli_query($con, "select * from cart where id_barang='$id_barang'");
        if (mysqli_num_rows($cart_data) > 0) {
            // echo"ada data";
            while ($x = mysqli_fetch_array($cart_data)) {
                $stock_cart_akhir = $x["banyak"] + $jumlah;
                $id_barang = $x["id_barang"];
                $total_harga_sementara = $stock_cart_akhir * $harga;
            }
            // "UPDATE `barang` SET `modal` = $modal, `sisa` = $stock_akhir WHERE `barang`.`id` = $id"
            // "UPDATE `cart` SET `banyak` = $modal, `sisa` = $stock_akhir WHERE `barang`.`id` = $id"
            $update_cart = mysqli_query($con, "UPDATE `cart` SET `banyak` = $stock_cart_akhir, `harga` = $harga, `jumlah`=$total_harga_sementara WHERE `cart`.`id_barang` = $id_barang");
            if (!$update_cart) {
                throw new Exception(mysqli_error($con));
            } else {
                // echo $_SESSION["tipeHarga"];
                header("location:penjualan.php?tipeHarga=" . $_SESSION["tipeHarga"]);
            }
        } else {
            // echo "$nama_barang";
            // echo"tidak ada data";

            $insert_cart = mysqli_query($con, "insert into cart values('','$id_barang','$nama','$jumlah','$harga', '$total_harga_sementara', '$_SESSION[tipeHarga]' )");
            if (!$insert_cart) {
                throw new Exception(mysqli_error($con));
            } else {
                // echo $_SESSION["tipeHarga"];
                header("location:penjualan.php?tipeHarga=" . $_SESSION["tipeHarga"]);
            }
        }




        // if ($cart_data==null) {
        //     echo"masuk sini";
        // $insert_cart = mysqli_query($con, "insert into cart values('','$id_barang','$nama','$jumlah','$grosir', '$semi', '$ecer', '$pkp1', '$pkp2')");
        // if (!$insert_cart) {
        //     throw new Exception(mysqli_error($con));
        // } else {
        //     // echo $_SESSION["tipeHarga"];
        //     header("location:penjualan.php?tipeHarga=" . $_SESSION["tipeHarga"]);
        // }
        // } else {
        //     echo $nama_barang;
        //     var_dump($cart_data);
        //     echo"masuk bawah";
        // while ($x = mysqli_fetch_array($cart_data)) {
        //     $stock_cart_akhir = $x["banyak"] + $jumlah;
        //     $id_barang = $x["id_barang"];
        // }    
        // // "UPDATE `barang` SET `modal` = $modal, `sisa` = $stock_akhir WHERE `barang`.`id` = $id"
        // // "UPDATE `cart` SET `banyak` = $modal, `sisa` = $stock_akhir WHERE `barang`.`id` = $id"
        // $update_cart = mysqli_query($con, "UPDATE `cart` SET `banyak` = $stock_cart_akhir, `grosir` = $grosir, `semi` = $semi, `ecer` = $ecer, `pkp1` = $pkp1, `pkp2` = $pkp2 WHERE `cart`.`id_barang` = $id_barang");

        // if (!$update_cart) {
        //     throw new Exception(mysqli_error($con));
        // } else {
        //     // echo $_SESSION["tipeHarga"];
        //     header("location:penjualan.php?tipeHarga=" . $_SESSION["tipeHarga"]);
        // }
        // }
    }
}
