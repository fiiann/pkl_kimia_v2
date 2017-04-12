<?php
	require_once('sidebar.php');
	if($status=="anggota"){
		header('Location:./index.php');
	}
	
	$sukses=TRUE;

	// eksekusi tombol daftar
	if (!isset($_POST['daftar'])) {

		if($_GET['nim']==""){
			header('Location:./daftar_nilai_progress.php');
		}
		
		$nim=$_GET['nim'];
		$nama = $_GET['nama'];
	
		
		$query = " SELECT * FROM anggota WHERE anggota.nim='".$nim."'";
		// Execute the query
		$result = $con->query( $query );

		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				$nim=$row->nim;
				$nama=$row->nama;
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
			$query = " SELECT * FROM nilai_pkt WHERE nim='".$nim."'";
			$result = $con->query( $query );
			if($result->num_rows!=0){
				$errorNim="NIM sudah pernah digunakan, harap masukkan NIM lain";
				$validNim=FALSE;
			}
			else{
				$validNim = TRUE;
			}
		}
		
		
		// Cek Judul
		$judul=test_input($_POST['judul']);
		if ($judul=='') {
			$error_judul='wajib diisi';
			$valid_judul=FALSE;
		}else{
				$valid_judul = TRUE;
			 }

		// Cek tanggal
		$tanggal=test_input($_POST['tanggal']);
		if ($tanggal=='') {
			$error_tanggal='wajib diisi';
			$valid_tanggal=FALSE;
		}else{
				$valid_tanggal = TRUE;
			 }


		// cek nilai identifikasi permasalahan
		$bahasa=test_input($_POST['bahasa']);
		if ($bahasa=='') {
			$error_bahasa='wajib diisi';
			$valid_bahasa=FALSE;
		}else{
				$valid_bahasa = TRUE;
			 }
		
		// cek rumusan masalah
		$substansi=test_input($_POST['substansi']);
		if ($substansi=='') {
			$error_substansi='wajib diisi';
			$valid_substansi=FALSE;
		}else{
				$valid_substansi = TRUE;
			 }

		// cek nilai identifikasi permasalahan
		$penyajian=test_input($_POST['penyajian']);
		if ($penyajian=='') {
			$error_penyajian='wajib diisi';
			$valid_penyajian=FALSE;
		}else{
				$valid_penyajian = TRUE;
			 }


		$penguasaan_materi=test_input($_POST['penguasaan_materi']);
		if ($penguasaan_materi=='') {
			$error_penguasaan_materi='wajib diisi';
			$valid_penguasaan_materi=FALSE;
		}else{
				$valid_penguasaan_materi = TRUE;
			 }


		$analisis=test_input($_POST['analisis']);
		if ($analisis=='') {
			$error_analisis='wajib diisi';
			$valid_analisis=FALSE;
		}else{
				$valid_analisis = TRUE;
			 }


		$penguasaan_pengetahuan=test_input($_POST['penguasaan_pengetahuan']);
		if ($penguasaan_pengetahuan=='') {
			$error_penguasaan_pengetahuan='wajib diisi';
			$valid_penguasaan_pengetahuan=FALSE;
		}else{
				$valid_penguasaan_pengetahuan = TRUE;
			 }

		// jika tidak ada kesalahan input
		if ($validNim && $valid_bahasa && $valid_substansi && $valid_penyajian && $valid_penguasaan_materi && $valid_penguasaan_pengetahuan && $valid_analisis && $valid_tanggal) {
			$nim=$con->real_escape_string($nim);
			// $judul=$con->real_escape_string($judul);
			$tanggal=$con->real_escape_string($tanggal);
			$bahasa=$con->real_escape_string($bahasa);
			$substansi=$con->real_escape_string($substansi);
			$penyajian=$con->real_escape_string($penyajian);
			$penguasaan_materi=$con->real_escape_string($penguasaan_materi);
			$penguasaan_pengetahuan=$con->real_escape_string($penguasaan_pengetahuan);
			$analisis=$con->real_escape_string($analisis);
			// $tanggal=$con->real_escape_string($tanggal);
			$jumlah_bahasa = 10/100*$bahasa;
			$jumlah_substansi = 30/100*$substansi;
			$jumlah_1 = $jumlah_bahasa+$jumlah_substansi;
			$jumlah_2 = 10/100*$penyajian;
			$jumlah_penguasaan_materi = 30/100*$penguasaan_materi;
			$jumlah_analisis = 15/100*$analisis;
			$jumlah_penguasaan_pengetahuan = 5/100*$penguasaan_pengetahuan;
			$jumlah_3 = $jumlah_penguasaan_materi+$jumlah_penguasaan_pengetahuan+$jumlah_analisis;
			$jumlah_total = $jumlah_1+$jumlah_2+$jumlah_3;
			
			$query = "INSERT INTO nilai_progress (nim, bahasa, substansi, penyajian, penguasaan_materi, penguasaan_pengetahuan, analisis,tanggal, jumlah_total) VALUES ('".$nim."',$bahasa,$substansi,$penyajian,$penguasaan_materi, $penguasaan_pengetahuan, $analisis, '".$tanggal."', $jumlah_total)";

			$query2 = "UPDATE nilai_tr1 SET  progress=$jumlah_total WHERE nim='".$nim."'";

			$hasil=$con->query($query);
			$hasil2=$con->query($query2);
			if (!($hasil && $hasil2)) {
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
	<title>Form Input nilai Progress</title>
</head>
<body>
<div class="row">
	<div class="col-md-6">
		<!-- Form Elements -->
		<div class="panel panel-default">
			<div class="panel-heading">
				Nilai Outline
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
							<div class="form-group">
								<label>NIM</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" type="text" name="nim" maxlength="14" readonly size="30" placeholder="nim 14 digit angka" required autofocus value="<?php if(isset($nim)){echo $nim;} ?>">
							</div>
							<div class="form-group">
								<label>Nama</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" readonly type="text" name="nama" maxlength="14" size="30" placeholder="" required autofocus value="<?php if(isset($nama)){echo $nama;} ?>">
							</div>
							<div class="form-group">
								<label>Bahasa dan Format</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_bahasa)) echo $error_bahasa;?></span>
								<input class="form-control" type="text" name="bahasa" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(!$sukses&&$valid_bahasa){echo $bahasa;} ?>">
							</div>
							<div class="form-group">
								<label>Substansi</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_substansi)) echo $error_substansi;?></span>
								<input class="form-control" type="text" name="substansi" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(!$sukses&&$valid_substansi){echo $substansi;} ?>">
							</div>
							<div class="form-group">
								<label>Penyajian, Penggunaan Median dan Ketepatan Waktu</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_penyajian)) echo $error_penyajian;?></span>
								<input class="form-control" type="text" name="penyajian" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(!$sukses&&$valid_penyajian){echo $penyajian;} ?>">
							</div>
							
							<div class="form-group">
								<label>Penguasaan Materi</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_penguasaan_materi)) echo $error_penguasaan_materi;?></span>
								<input class="form-control" type="text" name="penguasaan_materi" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(!$sukses&&$valid_penguasaan_materi){echo $penguasaan_materi;} ?>">
							</div>

							<div class="form-group">
								<label>Kemampuan Analisis</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_analisis)) echo $error_analisis;?></span>
								<input class="form-control" type="text" name="analisis" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(!$sukses&&$valid_analisis){echo $analisis;} ?>">
							</div>

							<div class="form-group">
								<label>Penguasaan Pengetahuan Penunjang</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_penguasaan_pengetahuan)) echo $error_penguasaan_pengetahuan;?></span>
								<input class="form-control" type="text" name="penguasaan_pengetahuan" maxlength="3" size="30" placeholder="0-100" required autofocus value="<?php if(!$sukses&&$valid_penguasaan_pengetahuan){echo $penguasaan_pengetahuan;} ?>">
							</div>

							<div class="form-group">
								<label>Tanggal</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_tanggal)) echo $error_tanggal;?></span>
								<input class="form-control" type="text" name="tanggal" maxlength="30" size="30" placeholder="ex : 2017-02-18" required autofocus value="<?php if(!$sukses&&$valid_tanggal){echo $tanggal;} ?>">
							</div>

							<div class="form-group">
								<input class="form-control" type="submit" name="daftar" value="Input">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<a href="daftar_nilai_progress.php"><button class="btn btn-info">Kembali ke Nilai Progress</button></a>
	</div>
</div>
</body>
</html>

<?php
include_once('footer.php');
$con->close();
?>