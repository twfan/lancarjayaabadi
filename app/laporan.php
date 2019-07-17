<?php

include 'header.php';

//set page session product
// ==================================
if (isset($_GET["id"])) {
  $idFaktur  = $_GET["id"];
} else {
  $idFaktur = "";
};




$per_hal = 10;
$jumlah_record = mysqli_query($con, "SELECT COUNT(*) as 'total' from barang");
$jum = mysqli_fetch_array($jumlah_record);
$halaman = ceil($jum['total'] / $per_hal);
// var_dump($halaman);
$page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
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
    <h2>Laporan Penjualan</h2>
  </div>

  <div class="row">
        <div class="col-sm-4" style="margin-bottom: 10px; padding:10px;">
            <form action="laporan_per_id.php" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nomor Faktur</label>
                    <input type="text" class="form-control" name="id" aria-describedby="nama" placeholder="Nomor faktur">
                    <small id="emailHelp" class="form-text text-muted">Ketik nomor faktur dengan lengkap dan benar</small>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top:10px;">Cek Detail</button>
            </form>
        </div>
    </div>
  
</main>




<?php
include 'footer.php';
?>