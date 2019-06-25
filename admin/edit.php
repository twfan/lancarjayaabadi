<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Barang</h3>
<a class="btn" href="barang.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$id_brg=mysqli_real_escape_string($con,$_GET['id']);
$det=mysqli_query($con,"select * from barang where id='$id_brg'");
while($d=mysqli_fetch_array($det)){
?>					
	<form action="update.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id" value="<?php echo $d['id'] ?>"></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" class="form-control" name="nama" value="<?php echo $d['nama'] ?>"></td>
			</tr>
			<tr>
				<td>Modal</td>
				<td><input type="number" class="form-control" name="modal" value="<?php echo $d['modal'] ?>"></td>
			</tr>
			<tr>
				<td>Grosir</td>
				<td><input type="number" class="form-control" name="grosir" disabled value="<?php echo $d['grosir'] ?>"></td>
			</tr>
			<tr>
				<td>Semi grosir</td>
				<td><input type="number" class="form-control" name="semi_grosir"disabled value="<?php echo $d['semi'] ?>"></td>
			</tr>
			<tr>
				<td>Ecer</td>
				<td><input type="number" class="form-control" name="ecer"disabled value="<?php echo $d['ecer'] ?>"></td>
			</tr>
			<tr>
				<td>pkp1</td>
				<td><input type="number" class="form-control" name="pkp1"disabled value="<?php echo $d['pkp1'] ?>"></td>
			</tr>
			<tr>
				<td>pkp2</td>
				<td><input type="number" class="form-control" name="pkp2"disabled value="<?php echo $d['pkp2'] ?>"></td>
			</tr>
			<tr>
				<td>Jumlah</td>
				<td><input type="number" class="form-control" name="jumlah" value="<?php echo $d['jumlah'] ?>"></td>
			</tr>
			<tr>
				<td>Sisa</td>
				<td><input type="number" class="form-control" name="sisa" value="<?php echo $d['sisa'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
		</table>
	</form>
	<?php 
}
?>
<?php include 'footer.php'; ?>