<?php 
include 'header.php';
?>

<?php
$a = mysqli_query($con, "select * from barang_laku");
// var_dump($a);
?>

<div class="col-md-10">
	<h3>Selamat datang</h3>	
    <h3>Aplikasi Penjualan</h3>
</div>
<!-- kalender -->
<div class="pull-right">
	<div id="kalender"></div>
</div>

<?php 
include 'footer.php';

?>