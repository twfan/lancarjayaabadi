<?php
session_start();

if (isset($_GET["tipeHarga"])) {
    $tipe_harga  = $_GET["tipeHarga"];
    $_SESSION["tipeHarga"] = $tipe_harga;
    // include 'remove_item_cart.php';
} else {
    header('Location:pilihan_harga.php');
};




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
        <h2>Data Penjualan - <?php echo $_GET["tipeHarga"]; ?></h2> <a href="pilihan_harga.php" style="padding-top:5px;">+ Transaksi baru</a>
    </div>
    <div></div>

    <div class="row">
        <div class="col-sm-4" style="margin-bottom: 10px; padding:10px;">
            <form action="add_to_cart.php" method="post">

                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Barang</label>
                    <input type="text" class="form-control" name="namaBarang" aria-describedby="nama" placeholder="Nama Barang">
                    <small id="emailHelp" class="form-text text-muted">Ketik nama barang dengan lengkap dan benar</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Banyak</label>
                    <input type="number" class="form-control" name="banyak" placeholder="Banyak">
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top:10px;">Tambah keranjang</button>
                <?php
                if (isset($_SESSION["message"])) {
                    ?>
                    <div class="alert alert-danger" style="margin-top:10px;" role="alert">
                        <?php echo $_SESSION["message"]   ?>
                    </div>
                    <?php
                    unset($_SESSION["message"]);
                } else {
                    // echo "tidak ada";
                }
                ?>
            </form>
        </div>
        <div class="col-md-5 offset-md-1">
            <div class="row">
                <?php

                $query = mysqli_query($con, "select SUM(`jumlah`) as 'total', SUM(`banyak`) as 'total_barang' from cart order by id DESC");
                $no = 1;
                while ($x = mysqli_fetch_array($query)) {
                    $total_transaksi = $x['total'];
                    $total_barang = $x['total_barang'];

                    ?>
                    <h4 style="margin-bottom:40px;">Jumlah Pembayaran <?php echo "Rp. " . number_format($x['total']) . ",-" ?> </h4>
                    <button type="submit" class="btn btn-primary" style="height:40px;width:130px;margin-left:20px;" data-toggle="modal" data-target="#modalCheckoutPembayaran"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg> Pembayaran</button>


                <?php
                }
                ?>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width=20%;>Nama Barang</th>
                                <th>Banyak</th>
                                <th width=20%;>Harga <?php echo $_GET["tipeHarga"]; ?></th>
                                <th width=25%;>Jumlah</th>
                                <th width=40%;>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $brg = mysqli_query($con, "select * from cart order by id DESC");
                            $no = 1;
                            while ($b = mysqli_fetch_array($brg)) {

                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $b['nama_barang'] ?></td>
                                    <td><?php echo $b['banyak'] ?></td>
                                    <td><?php echo "Rp. " . number_format($b['harga']) . ",-" ?></td>
                                    <td><?php echo "Rp. " . number_format($b['jumlah']) . ",-" ?></td>
                                    <td>
                                        <!-- <a href="det_barang.php?id=<?php echo $b['id']; ?>" class="btn btn-info">Detail</a> -->
                                        <a href="edit_barang_transaction.php?id=<?php echo $b['id']; ?>" class="btn btn-warning">Edit</a>
                                        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahBarang" style="margin-bottom:20px;"><span class="oi oi-plus" style="margin-right:5px;"></span>Tambah barang</button> -->
                                        <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_item_cart.php?id=<?php echo $b['id']; ?>' }" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>



        </div>
    </div>


    <div class="row">
        <div class="col-md-5">

        </div>
    </div>
</main>






<!-- Modal index.php -->
<!-- ====================================================== -->


<!-- Modal Tambah barang -->
<!-- =============================================================== -->
<div class="modal fade bd-example-modal-sm" id="modalCheckoutPembayaran" role="dialog" aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail pembeli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="transaksi_checkout.php" method="post" target="_blank" action="">
                    <div class="form-group ">
                        <label>Nama Toko</label>
                        <input name="toko" type="text" class="form-control" placeholder="Nama Toko">
                    </div>
                    <div class="form-group ">
                        <label>Nama Pembeli</label>
                        <input name="nama" type="text" class="form-control" placeholder="Nama Pembeli">
                    </div>
                    <div class="form-group ">
                        <input name="totalTransaksi" type="hidden" class="form-control" placeholder="Nama Pembeli" value="<?php echo $total_transaksi; ?>">
                    </div>
                    <div class="form-group ">
                        <input name="totalBarang" type="hidden" class="form-control" placeholder="Nama Pembeli" value="<?php echo $total_barang; ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <a href="pilihan_harga.php" style="margin-right:30px;">+ Transaksi baru</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a href="pilihan_harga.php"><input type="submit" class="btn btn-primary" value="Simpan"></a>
            </div>
            </form>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>