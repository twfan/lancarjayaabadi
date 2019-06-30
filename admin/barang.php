<?php include 'header.php'; ?>

<h3><span class="glyphicon glyphicon-briefcase"></span> Data Barang</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Barang</button>
<br />
<br />

<?php
$per_hal = 10;
$jumlah_record = mysqli_query($con, "SELECT COUNT(*) as 'total' from barang");
$jum = mysqli_fetch_array($jumlah_record);
$halaman = ceil($jum['total'] / $per_hal);
// var_dump($halaman);
$page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-12">

	<a style="margin-bottom:10px" href="lap_barang.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span> Cetak</a>
</div>
<form action="cari_act.php" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari barang di sini .." aria-describedby="basic-addon1" name="cari">
	</div>
</form>
<br />
<table class="table table-hover">
	<tr>
		<th class="col-md-1">No</th>
		<th class="col-md-2">Nama Barang</th>
		<th class="col-md-1">Grosir</th>
		<th class="col-md-1">Semi Grosir</th>
		<th class="col-md-1">Ecer</th>
		<th class="col-md-1">Pkp1</th>
		<th class="col-md-1">Pkp2</th>
		<!-- <th class="col-md-3">Harga Jual</th> -->
		<th class="col-md-1">Jumlah</th>
		<th class="col-md-1">Sisa</th>
		<!-- <th class="col-md-1">Sisa</th>		 -->
		<th class="col-md-3">Opsi</th>
	</tr>
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
				<a href="edit.php?id=<?php echo $b['id']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus.php?id=<?php echo $b['id']; ?>' }" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
	<?php
	}
	?>

</table>
<ul class="pagination">
	<?php
	for ($x = 1; $x <= $halaman; $x++) {
		?>
		<li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
	<?php
	}
	?>
</ul>
<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Barang Baru</h4>
			</div>
			<div class="modal-body">
				<form action="tmb_brg_act.php" method="post">
					<div class="form-group">
						<label>Nama Barang</label>
						<input name="nama" type="text" class="form-control" placeholder="Nama Barang ..">
					</div>
					<div class="form-group">
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