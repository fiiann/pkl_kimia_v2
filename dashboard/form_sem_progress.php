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
	$pdf->Cell(0,4,'FORM PENILAIAN SEMINAR PROGRESS REPORT',0,1,'C');
	$pdf->Ln();	
	$pdf -> SetFont("Times", "", 12);
	$pdf->Cell(0,5,'Yang bertanda tangan di bawah ini menyatakan bahwa mahasiswa Departemen Kimia Fakultas Sains dan',0,1,'L');
	$pdf->Cell(0,5,'Matematika Universitas Diponegoro Semarang:',0,1,'L'); 
	$pdf->Cell(50,5,'Nama Mahasiswa',0,0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->Cell(135,5,'.................',0,1,'L');
	$pdf->Cell(50,5,'NIM',0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->Cell(135,5,'.................',0,1,'L');
	$pdf->Cell(0,5,'telah mempresentasikan rencana penelitian Tugas Riset pada seminar Progress Report, dengan',0,1,'L'); 
	//$pdf->Cell(50,5,'JUDUL',0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->Cell(135,5,'..............................................................',0,1,'L');
	//$pdf->Cell(50,5,'JUDUL',0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->Cell(5,5,'1.',0,'C');$pdf->Cell(130,5,'',0,1,'L');
	//$pdf->Cell(50,5,'',0,'L');$pdf->Cell(5,5,'',0,'C');$pdf->Cell(5,5,'2.',0,'C');$pdf->Cell(130,5,'',0,1,'L');
	$pdf->Cell(50,5,'Judul',0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->MultiCell(135,5,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',0,'L');
	$pdf->Cell(50,5,'Tanggal',0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->Cell(135,5,'.................',0,1,'L');


	$pdf->Cell(0,5,'',0,1,'L');
	$pdf -> SetFont("Times", "B", 12);
	$pdf->Cell(100,8,'Komposisi Penilaian',1,0,'L');$pdf->Cell(30,8,'Bobot',1,0,'C');$pdf->Cell(30,8,'Bobot x Nilai',1,0,'C');;$pdf->Cell(30,8,'Jumlah',1,1,'C');
	$pdf->Cell(5,6,'I.','L,B',0,'C');$pdf->Cell(0,6,'Naskah Laporan TR 1 (40%)','R',1,'L');
	$pdf -> SetFont("Times", "", 10);

	$pdf->Cell(5,6,'1.','L,B',0,'C');$pdf->Cell(95,6,'Bahasa dan Format (1-100)','B,R,T',0,'L');$pdf->Cell(30,6,'10%',1,0,'C');$pdf->Cell(30,6,'10% x ...',1,0,'C');;$pdf->Cell(30,6,'...',1,1,'C');
	$pdf->Cell(5,6,'2.','L,B',0,'C');$pdf->Cell(95,6,'Substansi (1-100)','B,R,T',0,'L');$pdf->Cell(30,6,'30%',1,0,'C');$pdf->Cell(30,6,'30% x ...',1,0,'C');;$pdf->Cell(30,6,'...',1,1,'C');
	$pdf -> SetFont("Times", "B", 12);
	$pdf->Cell(160,6,'Jumlah I','R,L,B',0,'R');$pdf->Cell(30,6,'...','L,B,R',1,'C');

	$pdf->Cell(5,6,'II.','L,B',0,'C');$pdf->Cell(0,6,'Presentasi(10%)','R',1,'L');
	$pdf -> SetFont("Times", "", 10);
	$pdf->Cell(5,6,'3.','L,B',0,'C');$pdf->Cell(95,6,'Penyajian Penggunaan Media, dan Ketepatan Waktu (1-100)','B,R,T',0,'L');$pdf->Cell(30,6,'10%',1,0,'C');$pdf->Cell(30,6,'10% x ...',1,0,'C');;$pdf->Cell(30,6,'...',1,1,'C');
	$pdf -> SetFont("Times", "B", 12);
	$pdf->Cell(160,6,'Jumlah II','R,L,B',0,'R');$pdf->Cell(30,6,'...','L,B,R',1,'C');

	$pdf->Cell(5,6,'III.','L,B',0,'C');$pdf->Cell(0,6,'Diskusi (50%)','R',1,'L');
	$pdf -> SetFont("Times", "", 10);
	$pdf->Cell(5,6,'4.','L,B',0,'C');$pdf->Cell(95,6,'Penguasaan Materi (1-100)','B,R,T',0,'L');$pdf->Cell(30,6,'30%',1,0,'C');$pdf->Cell(30,6,'30% x ...',1,0,'C');;$pdf->Cell(30,6,'...',1,1,'C');
	$pdf->Cell(5,6,'5.','L,B',0,'C');$pdf->Cell(95,6,'Penguasaan Analisis (1-100)','B,R,T',0,'L');$pdf->Cell(30,6,'15%',1,0,'C');$pdf->Cell(30,6,'15% x ...',1,0,'C');;$pdf->Cell(30,6,'...',1,1,'C');
	$pdf->Cell(5,6,'6.','L,B',0,'C');$pdf->Cell(95,6,'Penguasaan Pengetahuan Penunjang (1-100)','B,R,T',0,'L');$pdf->Cell(30,6,'5%',1,0,'C');$pdf->Cell(30,6,'5% x ...',1,0,'C');;$pdf->Cell(30,6,'...',1,1,'C');
	$pdf -> SetFont("Times", "B", 12);
	$pdf->Cell(160,6,'Jumlah III','R,L,B',0,'R');$pdf->Cell(30,6,'...','L,B,R',1,'C');

	$pdf->Cell(0,5,'',0,1,'L');

	$pdf->Cell(160,6,'Jumlah Total (I + II + III)',1,0,'R');$pdf->Cell(30,6,'...',1,1,'C');
	$pdf->Cell(160,6,'Konversi Nilai Angka ke Huruf','R,L,B',0,'R');$pdf->Cell(30,6,'...','L,B,R',1,'C');
	$pdf->Cell(0,10,'Nilai Huruf dan Kisaran Rerata Nilai Angka',1,1,'C');

	$pdf->Cell(0,5,'',0,1,'L');

	$pdf->Cell(38,6,'A',1,0,'C');$pdf->Cell(38,6,'B',1,0,'C');$pdf->Cell(38,6,'C',1,0,'C');$pdf->Cell(38,6,'D',1,0,'C');$pdf->Cell(38,6,'E',1,1,'C');
	$pdf -> SetFont("Times", "", 12);
	$pdf->Cell(38,6,'80 <= x <= 100',1,0,'C');$pdf->Cell(38,6,'70 <= X < 80',1,0,'C');$pdf->Cell(38,6,'60 <= X < 70',1,0,'C');$pdf->Cell(38,6,'50 <= X < 60',1,0,'C');$pdf->Cell(38,6,'X < 50',1,1,'C');

	$pdf->Cell(0,7,'',0,1,'L');

	$pdf->Cell(110,5,'',1,'FJ');$pdf->Cell(20,5,'Semarang,',1,'FJ');$pdf->Cell(60,5,'TANGGAL',1,1,'FJ');
	$pdf->Cell(65,5,'Menyetujui,',1,'FJ');$pdf->Cell(45,5,'',1,'FJ');$pdf->Cell(80,5,'Penguji ...',1,1,'FJ');
	$pdf->Cell(65,5,'Panitia Sidang Ujian',1,'FJ');$pdf->Cell(45,5,'',1,'FJ');$pdf->Cell(80,5,'',1,1,'FJ');
	$pdf->Cell(65,5,'Ketua,',1,'FJ');$pdf->Cell(45,5,'',1,'FJ');$pdf->Cell(80,5,'',1,1,'FJ');
	$pdf->Cell(0,20,'',1,1,'FJ');
	$pdf -> SetFont("Times", "U", 12);	
	$pdf->Cell(65,5,'<ketua>',1,'FJ');$pdf->Cell(45,5,'',1,'FJ');$pdf->Cell(80,5,'<pnguji>',1,1,'FJ');
	$pdf -> SetFont("Times", "", 12);
	$pdf->Cell(10,5,'NIP.',1,'FJ');$pdf->Cell(55,5,'nip ketua',1,'FJ');$pdf->Cell(45,5,'',1,'FJ');$pdf->Cell(10,5,'NIP.',1,'FJ');$pdf->Cell(70,5,'NIP penguji',1,1,'FJ');

	$pdf ->Output();

?>
<