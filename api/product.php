<?php 

$con = mysqli_connect("localhost","root","","lancarjaya");
$arrData = array();
$arrData = array();
$query=mysqli_query($con, "select * from barang");
while($row = mysqli_fetch_object($query)){
    array_push($arrData, $row);
}

echo json_encode($arrData);

 ?>