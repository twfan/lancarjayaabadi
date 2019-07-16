<?php

include 'header.php';
include 'remove_item_cart.php';
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
        <h2>Penjualan - Pilihan Harga</h2>
    </div>
    <div>
        <ul class="nav nav-pills">
            <li class="nav-item pilihan-harga">
                <a class="nav-link active" href="penjualan.php?tipeHarga=<?php echo "grosir";   ?>">Grosir</a>
            </li>
            <li class="nav-item pilihan-harga">
                <a class="nav-link active" href="penjualan.php?tipeHarga=<?php echo "semi";   ?>">Semi </a>
            </li>
            <li class="nav-item pilihan-harga">
                <a class="nav-link active" href="penjualan.php?tipeHarga=<?php echo "ecer";   ?>">Ecer </a>
            </li>
            <li class="nav-item pilihan-harga">
                <a class="nav-link active" href="penjualan.php?tipeHarga=<?php echo "pkp1";   ?>">PKP 1</a>
            </li>
            <li class="nav-item pilihan-harga">
                <a class="nav-link active" href="penjualan.php?tipeHarga=<?php echo "pkp2";   ?>">PKP 2</a>
            </li>
        </ul>
    </div>

</main>




<?php
include 'footer.php';
?>