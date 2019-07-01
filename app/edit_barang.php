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
        <h2>Edit barang</h2>
    </div>
    <div class="row">
        <div class="col-md-1">
            <a href="dashboard.php"><button type="button" class="btn btn-primary" style="margin-bottom:20px;"><span class="oi oi-arrow-left" style="margin-right:5px;"></span>Kembali</button></a>
        </div>
    </div>

    <?php
    $id_brg = mysqli_real_escape_string($con, $_GET['id']);
    $det = mysqli_query($con, "select * from barang where id='$id_brg'");
    while ($d = mysqli_fetch_array($det)) {
        ?>

        <form action="update_barang.php" method="post">
            <div class="form-group row">
                <input type="hidden" name="id" value="<?php echo $d['id'] ?>">
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="nama" value="<?php echo $d['nama'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Harga Modal</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="modal" value="<?php echo number_format($d['modal']) ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Jumlah barang</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="jumlah" value="<?php echo number_format($d['jumlah']) ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Sisa barang</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="sisa" value="<?php echo number_format($d['sisa']) ?>">
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