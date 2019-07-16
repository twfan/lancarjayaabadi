<?php

include 'header.php';

//set page session product
// ==================================
if (isset($_GET["page"])) {
  $page  = $_GET["page"];
} else {
  $page = 1;
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
    <?php 
       echo "<script>";
        echo "swal('Good job!', 'You clicked the button!', 'success')";
        echo "</script>";
    ?>
    <h2>Data barang</h2>
    <a href="cetak.php" target="_blank">CETAK</a>
  </div>
  <div class="row">
    <div class="col-md-1">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahBarang" style="margin-bottom:20px;"><span class="oi oi-plus" style="margin-right:5px;"></span>Tambah barang</button>
    </div>
    <div class="col-md-4 offset-md-7">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="?page=<?php echo  $page == 1 ? $page = 1 : $page - 1 ?>">Previous</a></li>
          <?php
          for ($x = 1; $x <= $halaman; $x++) {
            if ($page == $x) {
              ?>
              <li class="page-item active"><a class="page-link" href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
            <?php
            } else {
              ?>
              <li class="page-item"><a class="page-link" href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
            <?php
            }
          }
          ?>
          <li class="page-item"><a class="page-link" href="?page=<?php echo  $page == $halaman ? $page = $halaman : $page + 1 ?>">Next</a></li>
        </ul>
      </nav>
    </div>
  </div>


  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Modal</th>
          <th>Grosir</th>
          <th>Semi Grosir</th>
          <th>Ecer</th>
          <th>Pkp1</th>
          <th>Pkp2</th>
          <th>Stock</th>
          <th>Opsi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (isset($_GET['cari'])) {
          $cari = mysqli_real_escape_string($con, $_GET['cari']);
          $brg = mysqli_query($con, "select * from barang where nama like '%$cari%'");
          if (!$brg) {
            printf("Error: %s\n", mysqli_error($con));
            exit();
          }
        } else {
          $brg = mysqli_query($con, "select * from barang order by id DESC limit $start, $per_hal");
        }
        $no = 1;
        while ($b = mysqli_fetch_array($brg)) {

          ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $b['nama'] ?></td>
            <td>Rp.<?php echo number_format($b['modal']) ?>,-</td>
            <td>Rp.<?php echo number_format($b['grosir']) ?>,-</td>
            <td>Rp.<?php echo number_format($b['semi']) ?>,-</td>
            <td>Rp.<?php echo number_format($b['ecer']) ?>,-</td>
            <td>Rp.<?php echo number_format($b['pkp1']) ?>,-</td>
            <td>Rp.<?php echo number_format($b['pkp2']) ?>,-</td>
            <td><?php echo $b['sisa'] ?></td>
            <td>
              <!-- <a href="det_barang.php?id=<?php echo $b['id']; ?>" class="btn btn-info">Detail</a> -->
              <a href="edit_barang.php?id=<?php echo $b['id']; ?>" class="btn btn-warning">Edit</a>
              <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahBarang" style="margin-bottom:20px;"><span class="oi oi-plus" style="margin-right:5px;"></span>Tambah barang</button> -->
              <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus.php?id=<?php echo $b['id']; ?>' }" class="btn btn-danger">Hapus</a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</main>






<!-- Modal index.php -->
<!-- ====================================================== -->


<!-- Modal Tambah barang -->
<!-- =============================================================== -->
<div class="modal fade bd-example-modal-sm" id="modalTambahBarang" role="dialog" aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="tmb_brg_act.php" method="post">
          <div class="form-group ">
            <label>Nama Barang</label>
            <input name="nama" type="text" class="form-control" placeholder="Nama Barang ..">
          </div>
          <div class="form-group ">
            <label>Harga Modal</label>
            <input name="modal" type="number" class="form-control" placeholder="Modal per unit">
          </div>
          <div class="form-group">
            <label>Jumlah</label>
            <input name="jumlah" type="number" class="form-control" placeholder="Jumlah">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <input type="submit" class="btn btn-primary" value="Simpan">
      </div>
      </form>
    </div>
  </div>
</div>

<?php
include 'footer.php';
?>