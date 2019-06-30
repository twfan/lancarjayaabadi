<?php include 'header.php';	?>

<h3><span class="glyphicon glyphicon-usd"></span> Transaksi penjualan</h3>

<form class="form-container-cashier">
	<div class="form-row">
		<div class="form-group row">
			<label class="col-sm-2" for="dataInputNamaBarang">Nama barang</label>
			<div class="col-sm-3">
				<input type="text" class="form-control col-sm-2" id="dataInputNamaBarang" placeholder="Nama barang. .">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2" for="dataInputBanyak">Jenis harga</label>
			<div class="col-sm-2">
				<select class="custom-select">
					<option selected>Open this select menu</option>
					<option value="1">One</option>
					<option value="2">Two</option>
					<option value="3">Three</option>
				</select>
			</div>

		</div>
		<div class="form-group row">
			<label class="col-sm-2" for="dataInputBanyak">Banyak</label>
			<div class="col-sm-2">
				<input type="number" class="form-control col-sm-2" id="dataInputBanyak" placeholder="Banyak . .">
			</div>
		</div>
	</div>
	<!-- <div class="form-row">
		<div class="form-group row col-md-2">
			<label for="exampleInputPassword1">Password</label>
		</div>
		<div class="form-group col-md-2">
		<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
		</div>
	</div> -->


	<!-- <div class="form-check">
		<input type="checkbox" class="form-check-input" id="exampleCheck1">
		<label class="form-check-label" for="exampleCheck1">Check me out</label>
	</div> -->
	<button type="submit" class="btn btn-primary">Submit</button>
</form>


<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span> Entry</button>

<br />
<?php
if (isset($_GET['tanggal'])) {
	$tanggal = mysql_real_escape_string($_GET['tanggal']);
	$tg = "lap_barang_laku.php?tanggal='$tanggal'";
	?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span> Cetak</a><?php
																																											} else {
																																												$tg = "lap_barang_laku.php";
																																											}
																																											?>

<br />
<?php
if (isset($_GET['tanggal'])) {
	echo "<h4> Data Penjualan Tanggal  <a style='color:blue'> " . $_GET['tanggal'] . "</a></h4>";
}
?>
<table class="table">
	<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>Nama Barang</th>
		<th>Harga Terjual /pc</th>
		<th>Total Harga</th>
		<th>Jumlah</th>
		<th>Laba</th>
		<th>Opsi</th>
	</tr>
	<?php
	if (isset($_GET['tanggal'])) {
		$tanggal = mysql_real_escape_string($_GET['tanggal']);
		$brg = mysqli_query($con, "select * from barang_laku where tanggal like '$tanggal' order by tanggal desc");
	} else {
		$brg = mysqli_query($con, "select * from barang_laku order by tanggal desc");
	}
	$no = 1;
	while ($b = mysqli_fetch_array($brg)) {

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['tanggal'] ?></td>
			<td><?php echo $b['nama'] ?></td>
			<td>Rp.<?php echo number_format($b['harga']) ?>,-</td>
			<td>Rp.<?php echo number_format($b['total_harga']) ?>,-</td>
			<td><?php echo $b['jumlah'] ?></td>
			<td><?php echo "Rp." . number_format($b['laba']) . ",-" ?></td>
			<td>
				<a href="edit_laku.php?id=<?php echo $b['id']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_laku.php?id=<?php echo $b['id']; ?>&jumlah=<?php echo $b['jumlah'] ?>&nama=<?php echo $b['nama']; ?>' }" class="btn btn-danger">Hapus</a>
			</td>
		</tr>

	<?php
	}
	?>
	<tr>
		<td colspan="7">Total Pemasukan</td>
		<?php
		if (isset($_GET['tanggal'])) {
			$tanggal = mysql_real_escape_string($_GET['tanggal']);
			$x = mysql_query("select sum(total_harga) as total from barang_laku where tanggal='$tanggal'");
			$xx = mysql_fetch_array($x);
			echo "<td><b> Rp." . number_format($xx['total']) . ",-</b></td>";
		} else { }

		?>
	</tr>
	<tr>
		<td colspan="7">Total Laba</td>
		<?php
		if (isset($_GET['tanggal'])) {
			$tanggal = mysql_real_escape_string($_GET['tanggal']);
			$x = mysql_query("select sum(laba) as total from barang_laku where tanggal='$tanggal'");
			$xx = mysql_fetch_array($x);
			echo "<td><b> Rp." . number_format($xx['total']) . ",-</b></td>";
		} else { }

		?>
	</tr>
</table>

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Penjualan
			</div>
			<div class="modal-body">
				<form action="barang_laku_act.php" method="post">
					<div class="form-group">
						<label>Tanggal</label>
						<input name="tgl" type="text" class="form-control" id="tgl" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Nama Barang</label>
						<select class="form-control" name="nama">
							<?php
							$brg = mysqli_query($con, "select * from barang");
							var_dump($brg);
							while ($b = mysqli_fetch_array($brg)) {
								?>
								<option value="<?php echo $b['nama']; ?>"><?php echo $b['nama'] ?></option>
							<?php
							}
							?>
						</select>

					</div>
					<div class="form-group">
						<label>Harga Jual / unit</label>
						<input name="harga" type="text" class="form-control" placeholder="Harga" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Jumlah</label>
						<input name="jumlah" type="text" class="form-control" placeholder="Jumlah" autocomplete="off">
					</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<input type="reset" class="btn btn-danger" value="Reset">
				<input type="submit" class="btn btn-primary" value="Simpan">
			</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#tgl").datepicker({
			dateFormat: 'yy/mm/dd'
		});
	});
</script>
<?php include 'footer.php'; ?>