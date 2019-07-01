<!DOCTYPE html>
<!-- saved from url=(0053)https://getbootstrap.com/docs/4.1/examples/dashboard/ -->
<html lang="en">
<script type="text/javascript" charset="utf-8" id="zm-extension" src="chrome-extension://fdcgdnkidjaadafnichfpabhfomcebme/scripts/webrtc-patch.js" async=""></script>

<head>
  <?php
  session_start();
  include 'config.php';
  ?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- <link rel="icon" href="https://getbootstrap.com/docs/4.1/assets/img/favicons/favicon.ico"> -->

  <title>Lancar Jaya Abadi</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/dashboard/">

  <!-- Bootstrap core CSS -->
  <link href="./tes_files/bootstrap.min.css" rel="stylesheet">
  <link href="./tes_files/font-awesome.css" rel="stylesheet">
  <!-- <link href="./open-iconic/font/css/open-iconic.css" rel="stylesheet"> -->
  <link href="./open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="./tes_files/dashboard.css" rel="stylesheet">
  <style type="text/css">
    /* Chart.js */
    @-webkit-keyframes chartjs-render-animation {
      from {
        opacity: 0.99
      }

      to {
        opacity: 1
      }
    }

    @keyframes chartjs-render-animation {
      from {
        opacity: 0.99
      }

      to {
        opacity: 1
      }
    }

    .chartjs-render-monitor {
      -webkit-animation: chartjs-render-animation 0.001s;
      animation: chartjs-render-animation 0.001s;
    }
  </style>
</head>

<body cz-shortcut-listen="true">
  <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="https://getbootstrap.com/docs/4.1/examples/dashboard/#">Lancar Jaya Abadi</a>
    <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="https://getbootstrap.com/docs/4.1/examples/dashboard/#">Sign out</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="https://getbootstrap.com/docs/4.1/examples/dashboard/#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                  <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                Data Barang <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://getbootstrap.com/docs/4.1/examples/dashboard/#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                  <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                  <polyline points="13 2 13 9 20 9"></polyline>
                </svg>
                Penjualan
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <?php

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
          <h2>Edit barang</h2>
        </div>
        <div class="row">
          <div class="col-md-1">
            <button type="button" class="btn btn-primary" style="margin-bottom:20px;"><span class="oi oi-plus" style="margin-right:5px;"></span>Kembali</button>
          </div>
          <div class="col-md-4 offset-md-7">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1 ?>">Previous</a></li>
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
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1 ?>">Next</a></li>
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
                <th>Grosir</th>
                <th>Semi Grosir</th>
                <th>Ecer</th>
                <th>Pkp1</th>
                <th>Pkp2</th>
                <th>Jumlah</th>
                <th>Sisa</th>
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
                  <td>Rp.<?php echo number_format($b['grosir']) ?>,-</td>
                  <td>Rp.<?php echo number_format($b['semi']) ?>,-</td>
                  <td>Rp.<?php echo number_format($b['ecer']) ?>,-</td>
                  <td>Rp.<?php echo number_format($b['pkp1']) ?>,-</td>
                  <td>Rp.<?php echo number_format($b['pkp2']) ?>,-</td>
                  <td><?php echo $b['jumlah'] ?></td>
                  <td><?php echo $b['sisa'] ?></td>
                  <td>
                    <!-- <a href="det_barang.php?id=<?php echo $b['id']; ?>" class="btn btn-info">Detail</a> -->
                    <a href="edit.php?id=<?php echo $b['id']; ?>" class="btn btn-warning" data-toggle="modal" data-target="#modalEditBarang">Edit</a>
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
    </div>
  </div>






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



    <!-- Bootstrap core JavaScript
      ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./tes_files/jquery-3.3.1.slim.min.js.download" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>
      window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="./tes_files/popper.min.js.download"></script>
    <script src="./tes_files/bootstrap.min.js.download"></script>

    <!-- Icons -->
    <script src="./tes_files/feather.min.js.download"></script>
    <script>
      feather.replace()
    </script>



  </body>

  </html>