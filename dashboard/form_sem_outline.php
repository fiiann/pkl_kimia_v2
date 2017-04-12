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
	$pdf -> SetFont("Times", "B", 12);
	$pdf->Cell(0,5,'UNIVERSITAS DIPONEGORO',0,0,'L');$pdf -> SetFont("Times", "B", 10);$pdf->Cell(0,5,'Pembimbing .../Reviewer *',0,1,'R');	
	$pdf -> SetFont("Times", "B", 12);
	$pdf->Cell(0,5,'FAKULTAS SAINS DAN MATEMATIKA',0,1,'L');
	$pdf->Cell(0,5,'DEPARTEMEN KIMIA',0,1,'L');
	$pdf->Line(10,27,200,27);$pdf->Ln();
	$pdf -> SetFont("Times", "B", 14);
	$pdf->Cell(0,4,'FORM PENILAIAN SEMINAR OUTLINE',0,1,'C');
	$pdf->Ln();	
	$pdf -> SetFont("Times", "", 12);
	$pdf->Cell(0,5,'Yang bertanda tangan di bawah ini menyatakan bahwa mahasiswa Departemen Kimia Fakultas Sains dan',0,1,'L');
	$pdf->Cell(0,5,'Matematika Universitas Diponegoro Semarang:',0,1,'L'); 
	$pdf->Cell(50,5,'Nama Mahasiswa',0,0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->Cell(135,5,'.................',0,1,'L');
	$pdf->Cell(50,5,'NIM',0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->Cell(135,5,'.................',0,1,'L');
	$pdf->Cell(0,5,'telah mempresentasikan rencana penelitian Tugas Riset pada seminar Outline, dengan',0,1,'L'); 
	//$pdf->Cell(50,5,'JUDUL',0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->Cell(135,5,'..............................................................',0,1,'L');
	//$pdf->Cell(50,5,'JUDUL',0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->Cell(5,5,'1.',0,'C');$pdf->Cell(130,5,'',0,1,'L');
	//$pdf->Cell(50,5,'',0,'L');$pdf->Cell(5,5,'',0,'C');$pdf->Cell(5,5,'2.',0,'C');$pdf->Cell(130,5,'',0,1,'L');
	$pdf->Cell(50,5,'Judul',0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->MultiCell(135,5,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',0,'L');
	$pdf->Cell(50,5,'Tanggal',0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->Cell(135,5,'.................',0,1,'L');


	$pdf->Cell(0,5,'',0,1,'L');
	$pdf -> SetFont("Times", "B", 12);
	$pdf->Cell(50,8,'Aspek',1,0,'C');$pdf->Cell(70,8,'Kisi-kisi/Indikator',1,0,'C');$pdf->Cell(20,8,'Bobot (B)',1,0,'C');$pdf->Cell(20,8,'Skor(S)',1,0,'C');$pdf->Cell(30,8,'Bobot x Nilai',1,1,'C');
	$pdf->Cell(5,6,'I.','L,B',0,'C');$pdf->Cell(0,6,'Permasalahan','R',1,'L');
	$pdf -> SetFont("Times", "", 10);

	$pdf->Cell(5,6,'a.','L,B',0,'C');$pdf->Cell(45,6,'Identifikasi Permasalahan','B,R,T',0,'L');$pdf->Cell(70,6,'Kejelasan permasalahan dan latar belakang','B,R,T',0,'L');$pdf->Cell(20,6,'30%',1,0,'C');$pdf->Cell(20,6,'',1,0,'C');;$pdf->Cell(30,6,'...',1,1,'C');
	$pdf->Cell(5,6,'b.','L,B',0,'C');$pdf->Cell(45,6,'Rumusan Masalah','B,R,T',0,'L');$pdf->Cell(70,6,'Kejelasan pendefinisian masalah','B,R,T',0,'L');$pdf->Cell(20,6,'10%',1,0,'C');$pdf->Cell(20,6,'',1,0,'C');;$pdf->Cell(30,6,'...',1,1,'C');
	$pdf->Cell(5,6,'c.','L,B',0,'C');$pdf->Cell(45,6,'Tujuan','B,R,T',0,'L');$pdf->Cell(70,6,'Liniearitas tujuan dengan latar belakang','B,R,T',0,'L');$pdf->Cell(20,6,'10%',1,0,'C');$pdf->Cell(20,6,'',1,0,'C');;$pdf->Cell(30,6,'...',1,1,'C');
	$pdf -> SetFont("Times", "B", 12);
	//$pdf->Cell(5,6,'','L,B',0,'C');$pdf->Cell(0,6,'','R',1,'L');

	$pdf->Cell(5,6,'2.','L,B',0,'C');$pdf->Cell(0,6,'Rancangan Riset','R',1,'L');
	$pdf -> SetFont("Times", "", 10);
	$pdf->Cell(5,6,'a.','L,T',0,'C');$pdf->Cell(45,6,'Metodologi','R,T',0,'L');$pdf->Cell(70,6,'Kejelasan dan Ketepatan metode','L,R,T',0,'L');$pdf->Cell(20,6,'10%','R,L,T',0,'C');$pdf->Cell(20,6,'','R,L,T',0,'C');$pdf->Cell(30,6,'...','R,L,T',1,'C');
	$pdf->Cell(5,6,'','L,B',0,'C');$pdf->Cell(45,6,'','B,R',0,'L');$pdf->Cell(70,6,' atau pendekatan yang digunakan','L,R,B',0,'L');$pdf->Cell(20,6,'','R,L,B',0,'C');$pdf->Cell(20,6,'','R,L,B',0,'C');$pdf->Cell(30,6,'','R,L,B',1,'C');
	$pdf->Cell(5,6,'b.','L,B',0,'C');$pdf->Cell(45,6,'Hipotesis','B,R,T',0,'L');$pdf->Cell(70,6,'Rencana Hasil (eksplisit/implisit)','B,R,T',0,'L');$pdf->Cell(20,6,'10%',1,0,'C');$pdf->Cell(20,6,'',1,0,'C');$pdf->Cell(30,6,'...',1,1,'C');
	$pdf->Cell(5,6,'c.','L,T',0,'C');$pdf->Cell(45,6,'Analisis','R,T',0,'L');$pdf->Cell(70,6,'Rencana analisis klasik/instrumental/statistik dan','L,R,T',0,'L');$pdf->Cell(20,6,'20%','R,L,T',0,'C');$pdf->Cell(20,6,'','R,L,T',0,'C');$pdf->Cell(30,6,'...','R,L,T',1,'C');
	$pdf->Cell(5,6,'','L,B',0,'C');$pdf->Cell(45,6,'','B,R',0,'L');$pdf->Cell(70,6,'interpretasi untuk memverifikasi rencana hasil','L,R,B',0,'L');$pdf->Cell(20,6,'','R,L,B',0,'C');$pdf->Cell(20,6,'','R,L,B',0,'C');$pdf->Cell(30,6,'','R,L,B',1,'C');

	$pdf -> SetFont("Times", "B", 12);
	//$pdf->Cell(160,6,'Jumlah II','R,L,B',0,'R');$pdf->Cell(30,6,'...','L,B,R',1,'C');

	$pdf->Cell(5,6,'3.','L,B',0,'C');$pdf->Cell(45,6,'Kontrak TR1','R',0,'L');$pdf -> SetFont("Times", "", 10);$pdf->Cell(70,6,'Kejelasan timeline rencana TR','B,R,T',0,'L');$pdf->Cell(20,6,'20%',1,0,'C');$pdf->Cell(20,6,'',1,0,'C');;$pdf->Cell(30,6,'...',1,1,'C');
	$pdf -> SetFont("Times", "B", 12);
	$pdf->Cell(160,6,'Nilai Total',1,0,'C');$pdf->Cell(30,6,'...','L,B,R',1,'C');

	

	$pdf->Cell(0,7,'',0,1,'L');
	$pdf -> SetFont("Times", "", 10);
	$pdf->Cell(110,5,'',0,0,'FJ');$pdf->Cell(20,5,'Semarang,',0,0,'FJ');$pdf->Cell(60,5,'TANGGAL',0,1,'FJ');
	$pdf->Cell(65,5,'',0,0,'FJ');$pdf->Cell(45,5,'',0,0,'FJ');$pdf->Cell(80,5,'Penguji ...',0,1,'FJ');
	$pdf->Cell(65,5,'',0,0,'FJ');$pdf->Cell(45,5,'',0,0,'FJ');$pdf->Cell(80,5,'',0,1,'FJ');
	$pdf->Cell(65,5,'',0,0,'FJ');$pdf->Cell(45,5,'',0,0,'FJ');$pdf->Cell(80,5,'',0,1,'FJ');
	$pdf->Cell(0,20,'',0,0,'FJ');
	$pdf -> SetFont("Times", "U", 12);	
	$pdf->Cell(65,5,'',0,0,'FJ');$pdf->Cell(45,5,'',0,0,'FJ');$pdf->Cell(80,5,'<pnguji>',1,1,'FJ');
	$pdf -> SetFont("Times", "", 12);
	$pdf->Cell(10,5,'',0,0,'FJ');$pdf->Cell(55,5,'',0,0,'FJ');$pdf->Cell(45,5,'',0,0,'FJ');$pdf->Cell(10,5,'NIP.',0,0,'FJ');$pdf->Cell(70,5,'NIP penguji',0,1,'FJ');

	$pdf ->Output();

?>
<