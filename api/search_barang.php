<?php 
include '../config.php';

$nama=$_POST['nama'];
$arrData = array();
$query=mysqli_query($con, "select * from barang where nama='$nama'");
while($row = mysqli_fetch_object($query)){
    array_push($arrData, $row);
}

echo json_encode($arrData);

?>