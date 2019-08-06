<?php
include 'header.php';
?>


<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
        <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
        </div>
        <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
        </div>
    </div>

    <div style="margin-top:15px;margin-bottom:15px;">
        <h2>Edit barang penjualan</h2>
    </div>
    <div class="row">
        <div class="col-md-1">
            <a href="dashboard.php"><button type="button" class="btn btn-primary" style="margin-bottom:20px;"><span class="oi oi-arrow-left" style="margin-right:5px;"></span>Kembali</button></a>
        </div>
    </div>

    <?php
    $id_brg = mysqli_real_escape_string($con, $_GET['id']);
    $det = mysqli_query($con, "select * from cart where id='$id_brg'");
    while ($d = mysqli_fetch_array($det)) {
        ?>
        <form action="update_cart.php" method="post">
        <div class="form-group row">
                <input type="hidden" name="id_barang" value="<?php echo $id_brg ?>">
            </div>
            <div class="form-group row">
                <input type="hidden" name="id" value="<?php echo $d['id'] ?>">
            </div>
            <div class="form-group row">
                <input type="hidden" name="tipe_harga" value="<?php echo $d['tipe_harga'] ?>">
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-2">
                    <input type="text" readonly class="form-control" name="nama" value="<?php echo $d['nama_barang'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-2">
                    <input type="number" readonly class="form-control" name="harga" value="<?php echo $d['harga'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">banyak</label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" name="banyak" value="<?php echo number_format($d['banyak']) ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-2">
                    <input type="submit" class="btn btn-info" value="Simpan">
                </div>
            </div>
        </form>

    <?php
    }
    ?>

</main>
<?php
include 'footer.php';
?>