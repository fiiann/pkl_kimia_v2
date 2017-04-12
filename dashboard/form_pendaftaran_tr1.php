<?php
	require_once('connect.php');
	
	$con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
	if(mysqli_connect_errno()){
		die('Could not connect to database : <br/>'.$mysqli_connect_error());
	}
	$query = "SELECT * FROM anggota INNER JOIN daftar_tr1 ON anggota.nim = daftar_tr1.nim ";
	$result = $con->query($query);
	if(!$result){
		die("Query tidak terkoneksi dengan database: </br>" .$con->error);
	}
	$result = $result->fetch_object();

	require('assets/fpdf/fpdf.php');
	
	$pdf = new FPDF("p", "mm", "A4");
	$pdf -> AddPage();
	$pdf -> SetFont("Times", "B", 9);
	$pdf->Cell(0,5,'No. Reg: ....../PTR-1/20......',0,1,'R');
	
	$pdf->Line(10,15,200,15);$pdf->Ln();
	$pdf -> SetFont("Times", "B", 12);
	$pdf->Cell(0,5,'PENDAFTARAN TUGAS RISET I',0,1,'C');	
	$pdf->Cell(0,5,'DEPARTEMEN KIMIA FSM UNDIP',0,1,'C');
	$pdf -> SetFont("Times", "", 12);
	$pdf->Ln();
	$pdf->Cell(0,5,'SEMESTER........TAHUN AKADEMIK...........',0,1,'C');$pdf->Ln();
	$pdf->Line(10,45,200,45);
	$pdf -> SetFont("Times", "B", 12);
	$pdf->Cell(0,8,'',0,1,'L');
	$pdf->Cell(95,10,'NAMA',1,0,'C');$pdf->Cell(95,10,'NOMOR INDUK MAHASISWA',1,1,'C');
	$pdf -> SetFont("Times", "", 12);
	$pdf->Cell(95,8,'',1,0,'C');$pdf->Cell(95,8,'',1,0,'C');$pdf->Ln();
	$pdf -> SetFont("Times", "B", 12);
	$pdf->Cell(190,15,'LABORATORIUM (urutan pilihan dengan angka)',1,1,'C');
	$pdf->Cell(38,8,'K. FISIK',1,0,'L');$pdf->Cell(38,8,'K. ANALITIK',1,0,'C');$pdf->Cell(38,8,'K. ORGANIK',1,0,'C');$pdf->Cell(38,8,'K. ANORGANIK',1,0,'C');$pdf->Cell(38,8,'BIOKIMIA',1,1,'C');
	$pdf -> SetFont("Times", "", 12);
	$pdf->Cell(38,8,'',1,0,'L');$pdf->Cell(38,8,'',1,0,'C');$pdf->Cell(38,8,'',1,0,'C');$pdf->Cell(38,8,'',1,0,'C');$pdf->Cell(38,8,'',1,1,'C');
	$pdf -> SetFont("Times", "B", 12);$pdf->Cell(38,8,'NILAI','R,L,T',0,'L');$pdf->Cell(38,8,'KUMULATIF',1,0,'L');$pdf -> SetFont("Times", "", 12);$pdf->Cell(114,8,'',1,1,'L');
	$pdf -> SetFont("Times", "B", 12);$pdf->Cell(38,8,'','R,L,B',0,'L');$pdf->Cell(38,8,'SKS',1,0,'L');$pdf->Cell(114,8,'',1,1,'L');
	$pdf -> SetFont("Times", "B", 12);$pdf->Cell(38,8,'TANGGAL','R,L,T',0,'L');$pdf->Cell(38,8,'KRS',1,0,'L');$pdf->Cell(114,8,'',1,1,'L');
	$pdf -> SetFont("Times", "B", 12);$pdf->Cell(38,8,'','R,L,B',0,'L');$pdf->Cell(38,8,'DAFTAR',1,0,'L');$pdf->Cell(114,8,'',1,1,'L');
	$pdf->Ln();
	// end of table

	$pdf -> SetFont("Times", "", 11);
	$pdf->Cell(150,5,'',0,0,'L');$pdf->Cell(40,5,'Semarang, ...............',0,1,'L');
	$pdf->Cell(150,5,'',0,0,'L');$pdf->Cell(40,5,'Mahasiswa,',0,1,'L');
	$pdf->Ln();$pdf->Ln();$pdf->Ln();
	$pdf->Line(160,170,200,170);$pdf->Ln();
	$pdf->Cell(150,5,'',0,0,'L');$pdf->Cell(40,5,'NIM',0,1,'L');
	$pdf->Line(10,185,200,185);$pdf->Ln();$pdf->Ln();
	$pdf -> SetFont("Times", "", 9);
	$pdf->Cell(150,2,'DEPARTEMEN KIMIA FSM UNDIP',0,1,'L');
	$pdf ->Output();

?>
