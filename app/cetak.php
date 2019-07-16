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

<body>
    <table style="font-size: 10px;margin-bottom:20px;margin-top:20px;">
        <tr>
            <td style="font-size:20px;">LANCAR JAYA ABADI</td>
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
                    <td colspan="2" style="font-size:10px;" width="210px;">Nota pembelian <br> Nomor faktur : <span style="font-weight:bold;">00012</span> <br>dibawa oleh pembeli     </td>
                    <!-- <td colspan="2"></td> -->
                    <td colspan="2" style="font-size:10px;">Yang terhormat <br>TOKO: SEMOGA JAYA <br> TUAN: BOYOLALI </td>
                </tr>
            </table>
        </div>

    </div>



    <?php
    include 'config.php';
    ?>

    <table border="1" style="width: 100%;font-size: 12px;">
        <tr>
            <th>No</th>
            <th width="5%">Banyak</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>

        </tr>
        <?php
        $no = 1;
        $sql = mysqli_query($con, "select `nama_barang`, `banyak`, `harga` from cart ");
        while ($data = mysqli_fetch_array($sql)) {
            ?>
            <tr>
                <td style="text-align:center; "><?php echo $no++; ?></td>
                <td style="text-align:center; "><?php echo $data['banyak']; ?></td>
                <td><?php echo $data['nama_barang']; ?></td>
                <td><?php echo "Rp. " . number_format($data['harga']); ?></td>
                <td><?php echo "Rp. " . number_format($data['harga'] * $data['banyak']); ?></td>
            </tr>
        <?php
        }
        ?>
    </table>

    <div style=page-break-before:always align="center"><span style="visibility: hidden;">-</span></div>


    <center>

        <h2>DATA LAPORAN BARANG</h2>
        <h4>WWW.MALASNGODING.COM</h4>

    </center>

    <?php
    include 'config.php';
    ?>

    <table border="1" style="width: 100%">
        <tr>
            <th width="1%">No</th>
            <th>Nama</th>
            <th>Modal</th>
            <th width="5%">Jumlah</th>

        </tr>
        <?php
        $no = 1;
        $sql = mysqli_query($con, "select * from barang");
        while ($data = mysqli_fetch_array($sql)) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['modal']; ?></td>
                <td><?php echo $data['jumlah']; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>


    <script>
        window.print();
        window.close();
    </script>

</body>

</html>