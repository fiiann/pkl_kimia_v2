<?php

	require_once('connect.php');
	require_once('functions.php');
	// $id=$_SESSION['sip_masuk_aja'];
	
	
	$db=new mysqli($db_host, $db_username, $db_password, $db_database);

	if($db->connect_errno){
		die("Could not connect to the database : <br/>". $db->connect_error);
	}

	//ambil data
	$query = "SELECT d.no_pkt,a.nama,d.nim,  d.pilihan1,d.pilihan2,d.pilihan3,d.ttd FROM daftar_pkt d INNER JOIN anggota a ON d.nim=a.nim ORDER BY no_pkt";
	$result=$con->query($query);
	if(!$result){
		die('Could not connect to database : <br/>'.$con->error);
	}
	$data=array();
	while ($row = $result->fetch_object()) {
		array_push($data, $row);
	}
	
	#setting judul dan header tabel
	$judul = "PENDAFTARAN PRAKTIKUM KIMIA TERPADU";
	$judul1 = "SEMESTER GENAP TAHUN AKADEMIK 2016/2017";
	$judul2 = "DEPARTEMEN KIMIA FAKULTAS SAINS DAN MATEMATIKA";
	$judul3 = "UNIVERSITAS DIPONEGORO SEMARANG";
	$header = array(
				 
				 // array('label' => '', 'length' => '9', 'align' =>  'C' ),
				 array('label' => '', 'length' => '9', 'align' =>  'C' ),
				 array('label' => '', 'length' => '45', 'align' =>  'C' ),
				 array('label' => '', 'length' => '40', 'align' =>  'C' ),
				 array('label' => '', 'length' => '26', 'align' =>  'C' ),
				 array('label' => '', 'length' => '26', 'align' =>  'C' ),
				 array('label' => '', 'length' => '26', 'align' =>  'C' ),
				 array('label' => '', 'length' => '20', 'align' =>  'C' )
			);

	#sertakan library FPDF dan bentuk objek
	require_once ("assets/fpdf/fpdf.php");
	$pdf = new FPDF();
	$pdf->AddPage();

	#tampilkan judul laporan
	$pdf->SetFont('Arial','B','12');
	$pdf->Cell(0,5, $judul, '0', 1, 'L');
	$pdf->Cell(0,5, $judul1, '0', 1, 'L');
	$pdf->Cell(0,5, $judul2, '0', 1, 'L');
	$pdf->Cell(0,5, $judul3, '0', 1, 'L');
	$pdf->Ln();

	$pdf->Cell(9,5,'','T,R,L',0,'C');
	$pdf->Cell(45,5,'','T,R,L',0,'C');$pdf->Cell(40,5,'','T,R,L',0,'C');$pdf->Cell(78,5,'','T,R,L',0,'C');$pdf->Cell(20,5,'','T,R,L',1,'C');

	  $pdf->Cell(9,7,'NO','R,L',0,'C');
	  $pdf->Cell(45,7,'NAMA','R,L',0,'C');$pdf->Cell(40,7,'NIM','R,L',0,'C');$pdf->Cell(78,7,'PILIHAN LABORATORIUM','B,R,L',0,'C');$pdf->Cell(20,7,'TTD','R,L',1,'C');

	 $pdf->Cell(9,5,'','R,L,B',0,'C');
	 $pdf->Cell(45,5,'','R,L,B',0,'C');$pdf->Cell(40,5,'','R,L,B',0,'C');$pdf->Cell(26,5,'1','R,L,B',0,'C');$pdf->Cell(26,5,'2','R,L,B',0,'C');$pdf->Cell(26,5,'3','R,L,B',0,'C');$pdf->Cell(20,5,'','R,L,B',1,'C');
	#buat header tabel
	 $pdf->SetFont('Times','','10');
	// $pdf->SetFillColor(0,9,255);
	// $pdf->SetTextColor(255);
	 // $pdf->SetDrawColor(128,0,0);
	// foreach ($header as $kolom) {
	// 	$pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], true);
	// }
	 // $pdf->Ln();

	#tampilkan data tabelnya
	$pdf->SetFillColor(224,235,255);
	$pdf->SetTextColor(0);
	$pdf->SetFont('');
	$fill=false;
	foreach ($data as $baris) {
		$i = 0;
		foreach ($baris as $cell) {
			$pdf->Cell($header[$i]['length'], 5, $cell, 1, '0', $kolom['align'], $fill);
			$i++;
		}
		$fill = !$fill;
		$pdf->Ln();
	}
	 
	#output file PDF
	$pdf->Output();
?>