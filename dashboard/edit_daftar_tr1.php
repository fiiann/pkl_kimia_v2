<?php
	require_once('sidebar.php');
	$id=$_SESSION['sip_masuk_aja'];
	if($con->connect_errno){
		die("Could not connect to the database: <br />".$con->connect_error);
	}
	// if($status=="anggota"){
	// 	header('Location:./index.php');
	// }
		$db=new mysqli($db_host, $db_username, $db_password, $db_database);


	$sukses=TRUE;
	$errorNama='';
	$errorNim='';
	$errorKumulatif='';
	$errorSks='';
	$errorKrs='';
	$errorDaftar='';
	$errorFisik='';
	$errorAnalitik='';
	$errorOrganik='';
	$errorAnorganik='';
	$errorBiokimia='';
	// eksekusi tombol daftar
	if (isset($_POST['edit'])) {

		if($_GET['nim']==""){
			header('Location:./daftar_pkt.php');
		}
		$nim=$_GET['nim'];
		$query = " SELECT * FROM daftar_pkt WHERE nim='".$nim."'";
		// Execute the query
		$result = $con->query( $query );

		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				 $nim=$row->nim;
				$pilihan1 = $row->pilihan1;
				$pilihan2 = $row->pilihan2;
				$pilihan3 = $row->pilihan3;
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
			$query = " SELECT * FROM daftar_tr1 WHERE nim='".$nim."'";
			$result = $con->query( $query );
			if($result->num_rows!=0){
				$errorNim="NIM sudah pernah digunakan, harap masukkan NIM lain";
				$validNim=FALSE;
			}
			else{
				$validNim = TRUE;
			}
		}
		
		$kumulatif=test_input($_POST['kumulatif']);
		if ($kumulatif=='') {
			$errorKumulatif='wajib diisi';
			$validKumulatif=FALSE;
		}else{
			$validKumulatif=TRUE;
		}

		$sks=test_input($_POST['sks']);
		if ($sks=='') {
			$errorSks='wajib diisi';
			$validSks=FALSE;
		}else{
			$validSks=TRUE;
		}		

		$krs=test_input($_POST['krs']);
		if ($krs=='') {
			$errorKrs='wajib diisi';
			$validKrs=FALSE;
		}else{
			$validKrs=TRUE;
		}

		$daftar=test_input($_POST['daftar']);
		if ($daftar=='') {
			$errorDaftar='wajib diisi';
			$validDaftar=FALSE;
		}else{
			$validDaftar=TRUE;
		}

		$nama=test_input($_POST['nama']);
		if ($nama=='') {
			$errorNama='wajib diisi';
			$validNama=FALSE;
		}elseif (!preg_match("/^[a-zA-Z ]*$/",$nama)) {
			$errorNama='hanya mengizinkan huruf dan spasi';
			$validNama=FALSE;
		}else{
			$validNama=TRUE;
		}

		$fisik=test_input($_POST['fisik']);
		if ($fisik=='') {
			$errorFisik='wajib diisi';
			$validFisik=FALSE;
		}else{
			$validFisik=TRUE;
		}

		$analitik=test_input($_POST['analitik']);
		if ($analitik=='') {
			$errorAnalitik='wajib diisi';
			$validAnalitik=FALSE;
		}else{
			$validAnalitik=TRUE;
		}

		$organik=test_input($_POST['organik']);
		if ($organik=='') {
			$errorOrganik='wajib diisi';
			$validOrganik=FALSE;
		}else{
			$validOrganik=TRUE;
		}

		$anorganik=test_input($_POST['anorganik']);
		if ($anorganik=='') {
			$errorAnorganik='wajib diisi';
			$validAnorganik=FALSE;
		}else{
			$validAnorganik=TRUE;
		}

		$biokimia=test_input($_POST['biokimia']);
		if ($biokimia=='') {
			$errorBiokimia='wajib diisi';
			$validBiokimia=FALSE;
		}else{
			$validBiokimia=TRUE;
		}

		// jika tidak ada kesalahan input
		if ($validNim && $validKumulatif && $validSks && $validKrs && $validDaftar && $validFisik && $validAnalitik && $validOrganik && $validAnorganik && $validBiokimia) {
			$nim=$con->real_escape_string($nim);
			$nama=$con->real_escape_string($nama);
			$fisik=$con->real_escape_string($fisik);	
			$analitik=$con->real_escape_string($analitik);
			$organik=$con->real_escape_string($organik);
			$anorganik=$con->real_escape_string($anorganik);
			$biokimia=$con->real_escape_string($biokimia);
			$kumulatif=$con->real_escape_string($kumulatif);
			$sks=$con->real_escape_string($sks);
			$krs=$con->real_escape_string($krs);
			$darftar=$con->real_escape_string($daftar);
			$qury = "UPDATE daftar_tr1 SET komulatif='".$kumulatif."', sks='".$sks."', krs='".$krs."', daftar='".$daftar."', fisik='".$fisik."', analitik='".$analitik."', organik='".$organik."', anorganik='".$anorganik."', biokimia='".$biokimia."' WHERE nim='".$nim."'";
			

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
								<input class="form-control" type="text" name="nim" maxlength="14" size="30" placeholder="nim 14 digit angka" required autofocus value="<?php if(!$sukses&&$validNim){echo $nim;} ?>">
							</div>
							
							<!-- <div class="form-group" hidden>
								<label>Nama</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNama)) echo $errorNama;?></span>
								<input class="form-control" type="text" name="nama" maxlength="50" size="30" placeholder="masukan nama" required value="<?php if(!$sukses&&$validNama){echo $nama;} ?>">
							</div>
 -->
							<div class="form-group">
								<label>Nilai Komulatif</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorKumulatif)) echo $errorKumulatif;?></span>
								<input class="form-control" type="text" name="kumulatif" maxlength="50" size="30" placeholder="masukan IPK" required value="<?php if(!$sukses&&$validKumulatif){echo $kumulatif;} ?>">
							</div>

							<div class="form-group">
								<label>Nilai SKS</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorSks)) echo $errorSks;?></span>
								<input class="form-control" type="text" name="sks" maxlength="50" size="30" placeholder="Masukan Nilai SKS" required value="<?php if(!$sukses&&$validSks){echo $sks;} ?>">
							</div>

							<div class="form-group">
								<label>Tanggal KRS</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorKrs)) echo $errorKrs;?></span>
								<input class="form-control" type="text" name="krs" maxlength="50" size="30" placeholder="masukan tanggal KRS" required value="<?php if(!$sukses&&$validKrs){echo $krs;} ?>">
							</div>

							<div class="form-group">
								<label>Tanggal Daftar</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorDaftar)) echo $errorDaftar;?></span>
								<input class="form-control" type="text" name="daftar" maxlength="50" size="30" placeholder="masukan tanggal daftar TR1" required value="<?php if(!$sukses&&$validDaftar){echo $daftar;} ?>">
							</div>

							<div class="form-group">
								<label>Prioritas Laboratorium (0-5)</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorDaftar)) echo $errorDaftar;?></span><br>
								<table>
									<tr>
										<td><p>Laboratorium Kimia Fisik</p></td>
										<td>:</td>
										<td>
										<select id="fisik" name="fisik" required>
											<option value="none">Pilih Prioritas</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select></td>
									</tr>
									<tr>
										<td><p>Laboratorium Kimia Analitik</p></td>
										<td>:</td>
										<td><select id="analitik" name="analitik" required>
											<option value="none">Pilih Prioritas</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select></td>
											</tr>
									<tr>
										<td><p>Laboratorium Kimia Organik</p></td>
										<td>:</td>
										<td><select id="organik" name="organik" required>
											<option value="none">Pilih Prioritas</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select></td>
									</tr>

									<tr>
										<td><p>Laboratorium Kimia Anorganik</p></td>
										<td>:</td>
										<td><select id="anorganik" name="anorganik" required>
											<option value="none">Pilih Prioritas</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
									</select></td>
									</tr>
									<tr>
										<td><p>Laboratorium Kimia Biokimia</p></td>
										<td>:</td>
										<td><select id="biokimia" name="biokimia" required>
											<option value="none">Pilih Prioritas</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select></td>
									</tr>
								</table>
							</div>
							<div class="form-group">
								<input class="form-control" type="submit"  name="edit" value="Daftar">
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