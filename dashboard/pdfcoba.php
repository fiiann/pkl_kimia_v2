<?php

	require_once('connect.php');
	require_once('functions.php');
	// $id=$_SESSION['sip_masuk_aja'];
	
	
	$db=new mysqli($db_host, $db_username, $db_password, $db_database);

	if($db->connect_errno){
		die("Could not connect to the database : <br/>". $db->connect_error);
	}

	//ambil data
	$query = "SELECT d.nim, a.nama, d.pilihan1,d.pilihan2,d.pilihan3,d.ttd FROM daftar_pkt d INNER JOIN anggota a ON d.nim=a.nim ORDER BY nama LIMIT 10";
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
				 
				 array('label' => 'NIM', 'length' => '30', 'align' =>  'C' ),
				 array('label' => 'NAMA', 'length' => '30', 'align' =>  'C' ),
				 array('label' => 'Pilihan1', 'length' => '30', 'align' =>  'C' ),
				 array('label' => 'Pilihan2', 'length' => '30', 'align' =>  'C' ),
				 array('label' => 'Pilihan3', 'length' => '30', 'align' =>  'C' ),
				 array('label' => 'TTD', 'length' => '20', 'align' =>  'C' )
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


	#buat header tabel
	$pdf->SetFont('Arial','','10');
	$pdf->SetFillColor(0,9,255);
	$pdf->SetTextColor(255);
	$pdf->SetDrawColor(128,0,0);
	foreach ($header as $kolom) {
		$pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], true);
	}
	$pdf->Ln();

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