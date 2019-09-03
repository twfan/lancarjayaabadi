<!DOCTYPE html>
<html>

<head>
    <title>&nbsp;</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/custom-style.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/jquery-ui/jquery-ui.css">
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</head>

<style type="text/css" media="print">
    /* masukan sintak CSS disini */
</style>

<?php
include 'config.php';
session_start();
?>

<?php
$no = 1;
$idTransaksi = $_GET['idTransaksi'];
$sql = mysqli_query($con, "select `nama_barang`, `banyak`, `harga`, `jumlah` from transaksi_detail where id_transaksi='$idTransaksi' ");
$detailTransaksi = mysqli_query($con, "select * from transaksi where id='$idTransaksi' ");
$dataDetail = mysqli_fetch_assoc($detailTransaksi);
?>

<body>
    <table style="font-size: 10px;margin-bottom:20px;margin-top:20px;">
        <tr>
            <td><img src="assets/ljaBlankLogo.png" width="80 " height="50"></td>
        </tr>
        <tr>
            <td style="font-size:20px;">LANCAR JAYA ABADI - Rekap Nota</td>
        </tr>
        <tr>
            <td>Jl. Kedung Anyar 9/21 Surabaya (60251)</td>
        </tr>
        <tr>
            <td>Telp 082231772977, 083857133999</td>
        </tr>
    </table>

    <div class="row">
        <div class="col-md-2">
            <table style="font-size: 10px;margin-bottom:20px;">
                <tr>
                    <td colspan="2" style="font-size:10px;" width="180px;">Nota pembelian <br> Nomor faktur : <span style="font-weight:bold;"><?php echo $idTransaksi ?></span> <br>dibawa oleh <span style="font-weight:bold;">pembeli</span> </td>
                    <!-- <td colspan="2"></td> -->
                    <td colspan="2" style="font-size:10px;">Yang terhormat <br>Toko: <?php echo strtoupper($dataDetail["nama_toko"]);  ?> <br> Tuan: <?php echo strtoupper($dataDetail["nama_pembeli"]);  ?> </td>
                </tr>
                <tr>
                    <td style="font-size:12px;margin-top:10px;"> Total Pembayaran </td>
                    <td></td>
                    <td></td>

                </tr>
                <tr>
                    <td><span style="font-size:15px;font-weight:bold;"><?php echo  "Rp. " . number_format($dataDetail["total_transaksi"]) ?></span></td>
                    <td></td>
                    <td></td>
                    <td>(...................................)</td>
                </tr>
            </table>
        </div>
    </div>

    <small style="font-size:7px;">*Barang yang sudah dibeli tidak dapat dikembalikan</small>
    <table border="1" style="width: 100%;font-size: 12px;">
        <tr>
            <th>No</th>
            <th width="5%">Banyak</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>

        </tr>

        <?php
        while ($data = mysqli_fetch_array($sql)) {
            ?>
            <tr>
                <td style="text-align:center; "><?php echo $no++; ?></td>
                <td style="text-align:center; "><?php echo $data['banyak']; ?></td>
                <td style="text-align:center; "><?php echo $data['nama_barang']; ?></td>
                <td><?php echo "Rp. " . number_format($data['harga']); ?></td>
                <td><?php echo "Rp. " . number_format($data['harga'] * $data['banyak']); ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <table width="100%" style="font-size: 10px;margin-top:5px;margin-right:20;text-align:right">
        <tr>
            <td><span style="font-size:15px;font-weight:bold;"><?php echo  "Total Pembayaran : Rp. " . number_format($dataDetail["total_transaksi"]) ?></span></td>
        </tr>
    </table>

    <div style=page-break-before:always align="center"><span style="visibility: hidden;">-</span></div>

    <?php
    $no = 1;
    $idTransaksi = $_GET['idTransaksi'];
    $sql = mysqli_query($con, "select `nama_barang`, `banyak`, `harga` from transaksi_detail where id_transaksi='$idTransaksi' ");
    $detailTransaksi = mysqli_query($con, "select * from transaksi where id='$idTransaksi' ");
    $dataDetail = mysqli_fetch_assoc($detailTransaksi);
    ?>

    <table style="font-size: 10px;margin-bottom:20px;margin-top:20px;">
        <tr>
            <td><img src="assets/ljaBlankLogo.png" width="80 " height="50"></td>
        </tr>
        <tr>
            <td style="font-size:20px;">LANCAR JAYA ABADI - Rekap Nota</td>
        </tr>
        <tr>
            <td>Jl. Kedung Anyar 9/21 Surabaya (60251)</td>
        </tr>
        <tr>
            <td>Telp 082231772977, 083857133999</td>
        </tr>
    </table>

    <div class="row">
        <div class="col-md-2">
            <table style="font-size: 10px;margin-bottom:20px;">
                <tr>
                    <td colspan="2" style="font-size:10px;" width="180px;">Nota pembelian <br> Nomor faktur : <span style="font-weight:bold;"><?php echo $idTransaksi ?></span> <br>dibawa oleh <span style="font-weight:bold;">toko</span> </td>
                    <!-- <td colspan="2"></td> -->
                    <td colspan="2" style="font-size:10px;">Yang terhormat <br>Toko: <?php echo strtoupper($dataDetail["nama_toko"]);  ?> <br> Tuan: <?php echo strtoupper($dataDetail["nama_pembeli"]);  ?> </td>
                </tr>

                <tr>
                    <td style="font-size:12px;margin-top:10px;"> Total Pembayaran </td>
                    <td></td>
                    <td></td>

                </tr>
                <tr>
                    <td><span style="font-size:15px;font-weight:bold;"><?php echo  "Rp. " . number_format($dataDetail["total_transaksi"]) ?></span></td>
                    <td></td>
                    <td></td>
                    <td>(...................................)</td>
                </tr>
            </table>
        </div>
    </div>
    <small style="font-size:7px;">*Barang yang sudah dibeli tidak dapat dikembalikan</small>
    <table border="1" style="width: 100%;font-size: 12px;">
        <tr>
            <th>No</th>
            <th width="5%">Banyak</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>

        </tr>

        <?php
        while ($data = mysqli_fetch_array($sql)) {
            ?>
            <tr>
                <td style="text-align:center; "><?php echo $no++; ?></td>
                <td style="text-align:center; "><?php echo $data['banyak']; ?></td>
                <td style="text-align:center; "><?php echo $data['nama_barang']; ?></td>
                <td><?php echo "Rp. " . number_format($data['harga']); ?></td>
                <td><?php echo "Rp. " . number_format($data['harga'] * $data['banyak']); ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <table width="100%" style="font-size: 10px;margin-top:5px;margin-right:20;text-align:right">
        <tr>
            <td><span style="font-size:15px;font-weight:bold;"><?php echo  "Total Pembayaran : Rp. " . number_format($dataDetail["total_transaksi"]) ?></span></td>
        </tr>
    </table>


    <script>
        window.print();
        window.close();
    </script>

</body>

</html>