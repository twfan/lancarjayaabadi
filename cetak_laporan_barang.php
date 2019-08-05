<?php
include 'config.php';
require('./assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->Image('./assets/ljaBlankLogo.png',1,1,3,2);
$pdf->SetX(4);            
$pdf->MultiCell(19.5,0.5,'LANCAR JAYA ABADI',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Telp 082231772977, 083857133999',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Jl. Kedung Anyar 9/21 Surabaya (60251)',0,'L');
$pdf->SetX(4);
// $pdf->MultiCell(19.5,0.5,'website : www.malasngoding.com email : malasngoding@gmail.com',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.5,0.7,"Laporan Data Barang",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Modal', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Grosir', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Semi Grosir', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Ecer', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Pkp1', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Pkp2', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Sisa', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$query=mysqli_query($con, "select * from barang");
while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['nama'],1, 0, 'C');
	$pdf->Cell(3, 0.8, "Rp. ".number_format($lihat['modal']), 1, 0,'C');
	$pdf->Cell(3, 0.8, "Rp. ".number_format($lihat['grosir']),1, 0, 'C');
	$pdf->Cell(3, 0.8,"Rp. ".number_format($lihat['semi']), 1, 0,'C');
	$pdf->Cell(3, 0.8,"Rp. ".number_format($lihat['ecer']),1, 0, 'C');
	$pdf->Cell(3, 0.8,"Rp. ".number_format($lihat['pkp1']), 1, 0,'C');
	$pdf->Cell(3, 0.8,"Rp. ".number_format($lihat['pkp2']), 1, 0,'C');
	$pdf->Cell(3, 0.8,$lihat['sisa'], 1, 1,'C');
	$no++;
}

$pdf->Output("laporan_barang.pdf","I");

?>

