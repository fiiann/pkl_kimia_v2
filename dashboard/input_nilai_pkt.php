<?php
	require_once('sidebar.php');
	if($status=="anggota"){
		header('Location:./index.php');
	}

	$sukses=TRUE;

	// eksekusi tombol daftar
	if (!isset($_POST['daftar'])) {

		if($_GET['nim']==""){
			header('Location:./input_nilai_pkt1.php');
		}

		$nim=$_GET['nim'];
		$nilai_total = $_GET['nilai_total'];
		// $jumlah_total = $_GET['jumlah_total'];
		$nilai_laporan = $_GET['nilai_laporan'];
		$nilai_presentasi = $_GET['nilai_presentasi'];
		$nilai_praktikum = $_GET['nilai_praktikum'];

		$query = " SELECT * FROM pkt INNER JOIN mahasiswa ON pkt.nim=mahasiswa.nim WHERE pkt.nim='".$nim."'";
		// Execute the query
		$result = $con->query( $query );

		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				$nim=$row->nim;
				$nama=$row->nama;
				$nilai_total = $row->nilai;
				// $laporanumlah_total = $row->jumlah_total;
				$nilai_laporan = $row->nilai_laporan;
				$nilai_praktikum = $row->nilai_praktikum;
				$nilai_presentasi = $row->nilai_presentasi;
			}
		}
	}else{
		// Cek Nim
		$nim=test_input($_POST['nim']);
		if ($nim=='') {
			$errorNim='wajib diisi';
			$validNim=FALSE;
		}elseif (!preg_match("/^[0-9]{14}$/",$nim)) {
			$errorNim='NIM harus terdiri dari 14 digit angka';
			$validNim=FALSE;
		}else{
				$validNim = TRUE;

		}


		$nilai_praktikum=test_input($_POST['nilai_praktikum']);
		if ($nilai_praktikum=='') {
			$errornilai_praktikum='wajib diisi';
			$validnilai_praktikum=FALSE;
		}else{
				$validnilai_praktikum = TRUE;
			 }

		// Cek Nilai praktikum
		$nilai_laporan=test_input($_POST['nilai_laporan']);
		if ($nilai_laporan=='') {
			$errornilai_laporan='wajib diisi';
			$validnilai_laporan=FALSE;
		}else{
				$validnilai_laporan = TRUE;
			 }


		$nilai_presentasi=test_input($_POST['nilai_presentasi']);
		if ($nilai_presentasi=='') {
			$errornilai_presentasi='wajib diisi';
			$validnilai_presentasi=FALSE;
		}else{
				$validnilai_presentasi = TRUE;
			 }
		// Cek Nilai praktikum



		// jika tidak ada kesalahan input
		if ($validNim && $validnilai_praktikum && $validnilai_laporan && $validnilai_laporan ) {
			$nim=$con->real_escape_string($nim);
			$nilai_praktikum=$con->real_escape_string($nilai_praktikum);
			$nilai_laporan=$con->real_escape_string($nilai_laporan);
			$nilai_presentasi=$con->real_escape_string($nilai_presentasi);
			$nilai_total = (60/100*$nilai_praktikum)+(30/100*$nilai_laporan)+(10/100*$nilai_presentasi);
			if ($nilai_total <= 100 && $nilai_total >= 80) {
				$huruf = "A";
			}elseif ($nilai_total < 80 && $nilai_total >= 60) {
				$huruf = "B";
			}elseif ($nilai_total < 60 && $nilai_total >= 40) {
				$huruf = "C";
			}elseif ($nilai_total < 40) {
				$huruf = "D";
			}else {
				$huruf ="N/A";
			}

			// $query = "INSERT INTO nilai_pkt (nim, nilai_praktikum, nilai_laporan, nilai_presentasi, nilai_pkt,nilai_huruf) VALUES ('".$nim."',$nilai_praktikum,$nilai_laporan,$nilai_presentasi,$nilai_total,'".$huruf."')";
			$query = "UPDATE pkt SET nilai='".$nilai_total."',nilai_huruf='".$huruf."',nilai_praktikum='".$nilai_praktikum."',nilai_laporan='".$nilai_laporan."', nilai_presentasi='".$nilai_presentasi."' WHERE nim='".$nim."'";
			$hasil=$con->query($query);
			if (!$hasil) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
			}
			$pesan_sukses="Berhasil menambahkan data.";

		}
		else{
			$sukses=FALSE;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Form Pendaftaran</title>
</head>
<body>
<div class="row">
	<div class="col-md-6">
		<!-- Form Elements -->
		<div class="panel panel-default">
			<div class="panel-heading">
				Nilai PKT
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
							<div class="form-group">
								<label>NIM</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" type="text" name="nim" maxlength="14" size="30" readonly placeholder="nim 14 digit angka" required autofocus value="<?php if(isset($nim)){echo $nim;} ?>">
							</div>
							<div class="form-group">
								<label>Nilai Praktikum (60%)</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_praktikum)) echo $errornilai_praktikum;?></span>
								<input class="form-control" type="text" name="nilai_praktikum" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(isset($nilai_praktikum)){echo $nilai_praktikum;} if(!$sukses&&$validnilai_praktikum){echo $nilai_praktikum;} ?>">
							</div>
							<div class="form-group">
								<label>Nilai Laporan (30%)</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_laporan)) echo $errornilai_laporan;?></span>
								<input class="form-control" type="text" name="nilai_laporan" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(isset($nilai_laporan)){echo $nilai_laporan;} if(!$sukses&&$validnilai_laporan){echo $nilai_laporan;} ?>">
							</div>
							<div class="form-group">
								<label>Nilai Presentasi (10%)</label>&nbsp;<span class="label label-warning">* <?php if(isset($errornilai_presentasi)) echo $errornilai_presentasi;?></span>
								<input class="form-control" type="text" name="nilai_presentasi" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(isset($nilai_presentasi)){echo $nilai_presentasi;}if(!$sukses&&$validnilai_presentasi){echo $nilai_presentasi;} ?>">
							</div>
							<div class="form-group">
								<input class="form-control" type="submit" name="daftar" value="Input">
							</div>

						</form>
						<div class="form-group">
								<a href="nilai_pkt.php"><button class="btn btn-info">Kembali ke Daftar Nilai PKT</button></a>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include_once('footer.php');
$con->close();
?>
