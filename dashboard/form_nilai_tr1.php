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
	$pdf->Cell(0,5,'UNIVERSITAS DIPONEGORO',0,0,'L');$pdf -> SetFont("Times", "B", 10);$pdf->Cell(0,5,'Form Pembimbing I/II *',0,1,'R');	
	$pdf -> SetFont("Times", "B", 12);
	$pdf->Cell(0,5,'FAKULTAS SAINS DAN MATEMATIKA',0,1,'L');
	$pdf->Cell(0,5,'DEPARTEMEN KIMIA',0,1,'L');
	$pdf->Line(10,27,200,27);$pdf->Ln();
	$pdf -> SetFont("Times", "B", 14);
	$pdf->Cell(0,4,'NILAI TUGAS RISET I',0,1,'C');
	$pdf->Ln();	
	$pdf -> SetFont("Times", "", 12);
	$pdf->Cell(0,5,'Yang bertanda tangan di bawah ini menyatakan bahwa mahasiswa Departemen Kimia Fakultas Sains dan',0,1,'L');
	$pdf->Cell(0,5,'Matematika Universitas Diponegoro Semarang:',0,1,'L'); 
	$pdf->Cell(50,5,'Nama Mahasiswa',0,0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->Cell(135,5,'.................',0,1,'L');
	$pdf->Cell(50,5,'NIM',0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->Cell(135,5,'.................',0,1,'L');
	$pdf->Cell(0,5,'telah menyelesaikan Tugas Riset I',0,1,'L'); 
	//$pdf->Cell(50,5,'JUDUL',0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->Cell(135,5,'..............................................................',0,1,'L');
	//$pdf->Cell(50,5,'JUDUL',0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->Cell(5,5,'1.',0,'C');$pdf->Cell(130,5,'',0,1,'L');
	//$pdf->Cell(50,5,'',0,'L');$pdf->Cell(5,5,'',0,'C');$pdf->Cell(5,5,'2.',0,'C');$pdf->Cell(130,5,'',0,1,'L');
	$pdf->Cell(50,5,'Judul Tugas Riset',0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->MultiCell(135,5,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',0,'L');
	$pdf->Cell(0,5,'telah disetujui dan disahkan oleh Pembimbing I/II*',0,1,'L'); 
	$pdf->Cell(50,5,'Tanggal',0,'L');$pdf->Cell(5,5,':',0,'C');$pdf->Cell(135,5,'.................',0,1,'L');


	$pdf->Cell(0,5,'',0,1,'L');
	$pdf -> SetFont("Times", "B", 12);
	$pdf->Cell(50,8,'Komponen Penilaian',1,0,'C');$pdf->Cell(70,8,'Kriteria',1,0,'C');$pdf->Cell(20,8,'Bobot (B)',1,0,'C');$pdf->Cell(20,8,'Skor(S)',1,0,'C');$pdf->Cell(30,8,'Bobot x Nilai',1,1,'C');
	$pdf->Cell(5,6,'1.','L,B',0,'C');$pdf->Cell(0,6,'Substantif','R',1,'L');
	$pdf -> SetFont("Times", "", 10);

	$pdf->Cell(5,6,'a.','L,B',0,'C');$pdf->Cell(45,6,'Outline (audiens)','B,R,T',0,'L');$pdf->Cell(70,6,'Rata - rata nilai seminar','B,R,T',0,'L');$pdf->Cell(20,6,'10%',1,0,'C');$pdf->Cell(20,6,'',1,0,'C');$pdf->Cell(30,6,'...',1,1,'C');
	$pdf->Cell(5,6,'b.','L,B',0,'C');$pdf->Cell(45,6,'Progress Report (audiens)','B,R,T',0,'L');$pdf->Cell(70,6,'Rata - rata nilai seminar','B,R,T',0,'L');$pdf->Cell(20,6,'10%',1,0,'C');$pdf->Cell(20,6,'',1,0,'C');$pdf->Cell(30,6,'...',1,1,'C');
	// $pdf->Cell(5,6,'c.','L,B',0,'C');$pdf->Cell(45,6,'Laporan TR1 (pembimbing I/II)','B,R,T',0,'L');$pdf->MultiCell(70,6,'Kejelasan, Latar Belakang, Perumusan, Tujuan, Pendekatan, Format sebagaimana skripsi (Bab I,II,III, dan hasil (hasil final atau sementara), pembahasan, kesimpulan serta rencana penelitian selanjutnya), Penggunaan bahasa ilmiah dan kemutahiran referensi','B,R,T',0,'L');$pdf->Cell(20,6,'10%',1,0,'C');$pdf->Cell(20,6,'',1,0,'C');;$pdf->Cell(30,6,'...',1,1,'C');
	$pdf->Cell(5,6,'c.','L',0,'C');$pdf->Cell(45,6,'Laporan TR1','R,T',0,'L');$pdf->Cell(70,6,'Kejelasan, Latar Belakang, Perumusan, Tujuan,','R,T',0,'L');$pdf->Cell(20,6,'10%','L,R',0,'C');$pdf->Cell(20,6,'','L,R',0,'C');$pdf->Cell(30,6,'...','L,R',1,'C');
	$pdf->Cell(5,6,'','L','L,R','C');$pdf->Cell(45,6,'(pembimbing I/II)','R',0,'L');$pdf->Cell(70,6,'Pendekatan, Format sebagaimana skripsi(Bab I,','R,L',0,'L');$pdf->Cell(20,6,'','R,L',0,'C');$pdf->Cell(20,6,'','R,L',0,'C');$pdf->Cell(30,6,'','R,L',1,'C');
	$pdf->Cell(5,6,'','L',0,'C');$pdf->Cell(45,6,'','R',0,'L');$pdf->Cell(70,6,'II,III, dan hasil (hasil final atau sementara','R',0,'L');$pdf->Cell(20,6,'','R,L',0,'C');$pdf->Cell(20,6,'','R,L',0,'C');$pdf->Cell(30,6,'','R,L',1,'C');
	$pdf->Cell(5,6,'','L',0,'C');$pdf->Cell(45,6,'','R',0,'L');$pdf->Cell(70,6,'pembahasan, kesimpulan serta rencana penelitian','R',0,'L');$pdf->Cell(20,6,'','R,L',0,'C');$pdf->Cell(20,6,'','R,L',0,'C');$pdf->Cell(30,6,'','R,L',1,'C');
	$pdf->Cell(5,6,'','L',0,'C');$pdf->Cell(45,6,'','R',0,'L');$pdf->Cell(70,6,'selanjutnya), Penggunaan bahasa ilmiah dan','R',0,'L');$pdf->Cell(20,6,'','R,L',0,'C');$pdf->Cell(20,6,'','R,L',0,'C');$pdf->Cell(30,6,'','R,L',1,'C');
	$pdf->Cell(5,6,'','L,B',0,'C');$pdf->Cell(45,6,'','B,R',0,'L');$pdf->Cell(70,6,'kemutahiran referensi','B,R',0,'L');$pdf->Cell(20,6,'','R,L,B',0,'C');$pdf->Cell(20,6,'','R,L,B',0,'C');$pdf->Cell(30,6,'','R,L,B',1,'C');
	// $pdf->Cell(5,6,'c.','L,B',0,'C');$pdf->Cell(45,6,'Pendekatan, Format sebagaimana skripsi (Bab I,II,III, dan hasil (hasil final atau sementara), pembahasan, kesimpulan serta rencana penelitian selanjutnya), Penggunaan bahasa ilmiah dan kemutahiran referensi','B,R,T',0,'L');$pdf->Cell(20,6,'10%',1,0,'C');$pdf->Cell(20,6,'',1,0,'C');$pdf->Cell(30,6,'...',1,1,'C');
	$pdf -> SetFont("Times", "B", 12);
	//$pdf->Cell(5,6,'','L,B',0,'C');$pdf->Cell(0,6,'','R',1,'L');
	$pdf->Cell(160,6,'Rata - rata Nilai',1,0,'C');$pdf->Cell(30,6,'...','L,B,R',1,'C');$pdf -> Ln();
	$pdf->Cell(5,6,'2.','T,L',0,'C');$pdf->Cell(45,6,'Kinerja TR I','R,T',0,'L');$pdf -> SetFont("Times", "", 10);$pdf->Cell(70,6,'Ketercapaian indikator kinerja yang tertulis','R,T',0,'L');$pdf->Cell(70,6,'< 70%','L,R,T',1,'C');
	$pdf->Cell(5,6,'','L,B','0','C');$pdf->Cell(45,6,'','R,B',0,'L');$pdf -> SetFont("Times", "", 10);$pdf->Cell(70,6,'pada Kontrak TR1','B,R,L',0,'L');$pdf->Cell(70,6,'>= 70 %  *','R,L,B',1,'C');
	$pdf->Ln();
	$pdf->Cell(0,6,'Nilai Akhir (jika nilai komponen 2 >= 70 %):',1,1,'L');
	$pdf->Cell(38,6,'A:80<=100',1,0,'C');$pdf->Cell(38,6,'B:70<=80',1,0,'C');$pdf->Cell(38,6,'C:60<=70',1,0,'C');$pdf->Cell(38,6,'D:50<=60',1,0,'C');$pdf->Cell(38,6,'E: X<50',1,1,'C');
	$pdf->Cell(0,6,'Nilai Akhir (jika nilai komponen 2 < 70 %):',1,1,'L');
	$pdf->Cell(38,6,'B:70<=80',1,0,'C');$pdf->Cell(38,6,'C:60<=70',1,0,'C');$pdf->Cell(38,6,'D:50<=60',1,0,'C');$pdf->Cell(38,6,'E: X<50',1,0,'C');$pdf->Cell(38,6,'',1,1,'C');$pdf->Ln();
	$pdf->Cell(0,5,'Mahasiswa tersebut dinyatakan LULUS / TIDAK LULUS TR 1 * dengan nilai HURUF ..............',0,1,'L'); 

	

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
	$pdf->Cell(10,5,'*) coret yang tidak perlu',0,0,'FJ');$pdf->Cell(55,5,'',0,0,'FJ');$pdf->Cell(45,5,'',0,0,'FJ');$pdf->Cell(10,5,'NIP.',0,0,'FJ');$pdf->Cell(70,5,'NIP penguji',0,1,'FJ');

	$pdf ->Output();

?>
<