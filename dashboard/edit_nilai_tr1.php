<?php
	require_once('sidebar.php');
	if($status=="anggota"){
			header('Location:./index.php');
		}

	$sukses=TRUE;

	// eksekusi tombol daftar
	if (!isset($_POST['daftar'])) {

		if($_GET['nim']==""){
			header('Location:./daftar_nilai_tr1.php');
		}
		
		$nim=$_GET['nim'];
		$nama=$_GET['nama'];
		$laporan = $_GET['laporan'];
		$kinerja = $_GET['kinerja'];
		$nilai_total = $_GET['nilai_total'];
		$jumlah_total = $_GET['jumlah_total'];
		
		$query = " SELECT * FROM nilai_outline INNER JOIN nilai_progress ON nilai_outline.nim=nilai_progress.nim INNER JOIN anggota ON nilai_outline.nim=anggota.nim INNER JOIN nilai_tr1 ON anggota.nim=nilai_tr1.nim WHERE nilai_outline.nim='".$nim."'";
		// Execute the query
		$result = $con->query( $query );

		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				$nim=$row->nim;
				$nama=$row->nama;
				$laporan1 = $row->laporan;
				$kinerja1 = $row->kinerja;
				$nilai_total = $row->nilai_total;
				$jumlah_total = $row->jumlah_total;
			}
		}
	}else{
		// Cek Nim
		$nim=test_input($_POST['nim']);
		if ($nim=='') {
			$errorNim='wajib diisi';
			$validNim=FALSE;
		}else{
				$validNim = TRUE;
			}
		}
		

		$laporan=test_input($_POST['laporan']);
		if ($laporan=='') {
			$errorLaporan='wajib diisi';
			$validLaporan=FALSE;
		}else{
			$validLaporan=TRUE;
		}

		$kinerja=test_input($_POST['kinerja']);
		if ($kinerja=='') {
			$errorKinerja='wajib diisi';
			$validKinerja=FALSE;
		}else{
			$validKinerja=TRUE;
		}

		

		// jika tidak ada kesalahan input
		if ($validNim && $validLaporan && $validKinerja) {
			$nim=$con->real_escape_string($nim);
			$laporan=$con->real_escape_string($laporan);
			$kinerja=$con->real_escape_string($kinerja);
			$nilai_akhir = (10/100*$outline)+(10/100*$progress)+(80/100*$laporan);
			// $huruf = "";
			if ($kinerja >= 70){
				if ($nilai_akhir <= 100 && $nilai_akhir >= 80) {
					$huruf = "A";
				}elseif ($nilai_akhir < 80 && $nilai_akhir >= 70) {
					$huruf = "B";
				}elseif ($nilai_akhir < 70 && $nilai_akhir >= 60) {
					$huruf = "C";
				}elseif ($nilai_akhir < 60 && $nilai_akhir >= 50) {
					$huruf = "D";
				}elseif ($nilai_akhir < 50 && $nilai_akhir >= 0) {
					$huruf = "E";
				}else {
					$huruf ="N/A";
				}
			}elseif ($kinerja < 70) {
				if ($nilai_akhir <= 100 && $nilai_akhir >= 80) {
					$huruf = "B";
				}elseif ($nilai_akhir < 80 && $nilai_akhir >= 70) {
					$huruf = "C";
				}elseif ($nilai_akhir < 70 && $nilai_akhir >= 60) {
					$huruf = "D";
				}elseif ($nilai_akhir < 60 && $nilai_akhir >= 0) {
					$huruf = "E";
				}else {
					$huruf ="N/A";
				}
			}else {
				$huruf = "Nilai kinerja harus diantara 1-100";
			}

			$query = "UPDATE nilai_tr1 SET  laporan=$laporan, kinerja=$kinerja, huruf='".$huruf."',nilai_akhir=$nilai_akhir WHERE nim='".$nim."'";

			$query2 = "UPDATE daftar_tr1 SET nilai_akhir=$nilai_akhir WHERE nim='".$nim."'";
			
			

			$hasil=$con->query($query);
			$hasil2=$con->query($query2);
			if (!($hasil && $hasil2)) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
			}
			$pesan_sukses="Berhasil edit data.";
		}
		else{
			$sukses=FALSE;
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
				<!-- <?php //echo "row->nim"; ?> -->
				<?php echo $kinerja; ?>
				Daftar TR 1
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>

							<!-- NIM -->
							<div class="form-group">
								<label>NIM</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" type="text" name="nim" maxlength="14" size="30" readonly placeholder="nim 14 digit angka" required value="<?php if(isset($nim)){echo $nim;} ?>">
							</div>
							
							<div class="form-group" >
								<label>Nama</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNama)) echo $errorNama;?></span>
								<input class="form-control" type="text" readonly name="nama" maxlength="50" size="30" placeholder="masukan nama" required value="<?php if(isset($nama)){echo $nama;} ?>">
							</div>

							<div class="form-group">
								<label>Nilai Outline</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorOutline)) echo $errorOutline;?></span>
								<input class="form-control" type="text" name="outline" readonly maxlength="50" size="30" placeholder="nilai outline" required value="<?php if(isset($nilai_total)){echo $nilai_total;} ?>">
							</div>

							<div class="form-group">
								<label>Nilai Progress</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorProgress)) echo $errorProgress;?></span>
								<input class="form-control" type="text" name="progress" readonly maxlength="50" size="30" placeholder="nilai progress" required value="<?php if(isset($jumlah_total)){echo $jumlah_total;} ?>">
							</div>

							<div class="form-group">
								<label>Laporan TR 1</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorLaporan)) echo $errorLaporan;?></span>
								<input class="form-control" type="text" name="laporan" maxlength="50" size="30" placeholder="Ketercapaian indikator pada kontrak TR" required value="<?php if(isset($laporan1)){echo $laporan1;} ?>">
							</div>

							<div class="form-group">
								<label>Kinerja TR1</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorKinerja)) echo $errorKinerja;?></span>
								<input class="form-control" type="text" name="kinerja" maxlength="50" size="30" placeholder="Ketercapaian indikator pada kontrak TR" required value="<?php if(isset($kinerja1)){echo $kinerja1;} ?>">
							</div>


							<div class="form-group">
								<input class="form-control" type="submit"  name="daftar" value="Edit Data">
							</div>
						</form>
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