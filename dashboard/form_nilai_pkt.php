<?php

	require_once('connect.php');
	require_once('functions.php');
	// $id=$_SESSION['sip_masuk_aja'];
	
	
	$db=new mysqli($db_host, $db_username, $db_password, $db_database);

	if($db->connect_errno){
		die("Could not connect to the database : <br/>". $db->connect_error);
	}

	//ambil data
	$query = "SELECT d.no_pkt,d.nim,a.nama FROM daftar_pkt d INNER JOIN anggota a ON d.nim=a.nim ORDER BY no_pkt";
	$result=$con->query($query);
	if(!$result){
		die('Could not connect to database : <br/>'.$con->error);
	}
	$data=array();
	while ($row = $result->fetch_object()) {
		array_push($data, $row);
	}
	
	#setting judul dan header tabel
	$judul = "Daftar Peserta dan Nilai";
	$judul1 = "Mata Kuliah";
	$judul2 = "Pembimbing";
	$judul3 = "Tahun Akademik";
	$judul4 = "Semester";
	$header = array(
				 
				 // array('label' => '', 'length' => '9', 'align' =>  'C' ),
				 array('label' => '', 'length' => '9', 'align' =>  'C' ),
				 array('label' => '', 'length' => '30', 'align' =>  'C' ),
				 array('label' => '', 'length' => '35', 'align' =>  'C' ),
				 array('label' => '', 'length' => '20', 'align' =>  'C' ),
				 array('label' => '', 'length' => '20', 'align' =>  'C' ),
				 array('label' => '', 'length' => '20', 'align' =>  'C' ),
				 array('label' => '', 'length' => '15', 'align' =>  'C' ),
				 array('label' => '', 'length' => '20', 'align' =>  'C' )
			);

	#sertakan library FPDF dan bentuk objek
	require_once ("assets/fpdf/fpdf.php");
	$pdf = new FPDF();
	$pdf->AddPage();

	#tampilkan judul laporan
	$pdf->SetFont('Arial','B','9');
	$pdf->Cell(0,5, $judul, '0', 1, 'C');
	$pdf->Ln();
	$pdf->SetFont('Arial','','8');
	$pdf->Cell(20,5,$judul1,'',0,'L');$pdf->Cell(10,5,':','',0,'C');$pdf->Cell(35,5,'Praktikum Kimia Terpadu (1SKS)','',0,'L');

	$pdf->Ln();
	$pdf->Cell(20,5,$judul2,'',0,'L');
	$pdf->Cell(10,5,':','',0,'C');$pdf->Cell(35,5,'Dosen','',0,'L');

	$pdf->Ln();
	$pdf->Cell(20,5,$judul3,'',0,'L');
	$pdf->Cell(10,5,':','',0,'C');$pdf->Cell(35,5,'2014/2015','',0,'L');


	$pdf->Ln();
	$pdf->Cell(20,5,$judul4,'',0,'L');
	$pdf->Cell(10,5,':','',0,'C');$pdf->Cell(35,5,'Genap','',0,'L');

	
	$pdf->Ln();$pdf->Ln();

	$pdf->Cell(9,5,'','T,R,L',0,'C');
	$pdf->Cell(30,5,'','T,R,L',0,'C');$pdf->Cell(35,5,'','T,R,L',0,'C');$pdf->Cell(105,5,'','T,R,L',0,'C');$pdf->Cell(20,5,'','',1,'C');

	  $pdf->Cell(9,7,'NO','R,L',0,'C');
	  $pdf->Cell(30,7,'NIM','R,L',0,'C');$pdf->Cell(35,7,'Nama Mahasiswa','R,L',0,'C');$pdf->Cell(105,7,'Nilai','B,R,L',0,'C');$pdf->Cell(20,7,'','',1,'C');

	 $pdf->Cell(9,5,'','R,L,B',0,'C');
	 $pdf->Cell(30,5,'','R,L,B',0,'C');$pdf->Cell(35,5,'','R,L,B',0,'C');$pdf->Cell(21,5,'Praktikum(60%)','R,L,B',0,'C');$pdf->Cell(21,5,'Laporan(30%)','R,L,B',0,'C');$pdf->Cell(21,5,'Presentasi(10%)','R,L,B',0,'C');$pdf->Cell(21,5,'Akhir(100%)','R,L,B',0,'C');$pdf->Cell(21,5,'Huruf','R,L,B',1,'C');
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
	$pdf->SetFont('Times','','8');
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
	 
	$pdf->SetFont('Arial','','8');
	$pdf->Ln();
	$pdf->Cell(180,1, 'Semarang, 12 Februari 2017', '0', 1, 'R');
	$pdf->Ln();

	$pdf->Cell(163,5, 'Dosen Penguji,', '0', 1, 'R');
	$pdf->Ln();$pdf->Ln();$pdf->Ln();$pdf->Ln();

	$pdf->Cell(178,1, 'Nama Dosen pembimbing,', '0', 1, 'R');

	$pdf->Ln();
	$pdf->Cell(149.4,5, 'NIP', '0', 1, 'R');
	
	#output file PDF
	$pdf->Output();
?>