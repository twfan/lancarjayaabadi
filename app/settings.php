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
        <h2>Setting</h2>
    </div>

    <div class="row">
        <div class="col-sm-4" style="margin-bottom: 10px; padding:10px;">
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Akun Login</label>
                <div class="col-sm-8">
                    <button type="button" data-toggle="modal" data-target="#modalGantiPassword" class="btn btn-primary mb-2">Ganti akun</button>
                </div>
            </div>

            <div class="col-sm-12">
                <hr>
            </div>
            <form action="simpan_rumus.php" method="post">
                <?php
                $brg = mysqli_query($con, "select * from settings ");
                while ($b = mysqli_fetch_array($brg)) {
                    ?>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">grosir</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" min="1" max="99" name="grosir"  placeholder="Angka persentase" value="<?php echo $b['grosir'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">semi grosir</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" min="1" max="99" name="semi" placeholder="Angka persentase" value="<?php echo $b['semi_grosir'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">ecer</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" min="1" max="99" name="ecer" placeholder="Angka persentase" value="<?php echo $b['ecer'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">pkp1</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" min="1" max="99" name="pkp1" placeholder="Angka persentase" value="<?php echo $b['pkp1'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">pkp2</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" min="1" max="99" name="pkp2" placeholder="Angka persentase" value="<?php echo $b['pkp2'] ?>">
                        </div>
                    </div>
                <?php
                }
                ?>

                <div class="form-group">
                    <label for="inputPassword" class="col-sm-3 col-form-label"></label>
                    <button type="submit" class="btn btn-primary mb-2">Simpan rumus</button>
                </div>
            </form>
        </div>
    </div>

</main>


<!-- Modal Tambah barang -->
<!-- =============================================================== -->
<div class="modal fade bd-example-modal-sm" id="modalGantiPassword" role="dialog" aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ganti Akun login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="ganti_akun.php" method="post">
                    <div class="form-group ">
                        <label>Username</label>
                        <input name="username" type="text" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group ">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group ">
                        <label>Konfirmasi Password</label>
                        <input name="konf_password" type="password" class="form-control" placeholder="Konfirmasi password">
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