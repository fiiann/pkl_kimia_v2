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
	$errorPilihan1='';
	$errorPilihan2='';
	$errorPilihan3='';
	$errorPilihan4='';
	$errorPilihan5='';
	// eksekusi tombol daftar
	if (isset($_POST['submit'])) {
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

		$pilihan1=test_input($_POST['pilihan1']);
		if ($pilihan1=='') {
			$errorPilihan1='wajib diisi';
			$validPilihan1=FALSE;
		}else{
			$validPilihan1=TRUE;
		}

		$pilihan2=test_input($_POST['pilihan2']);
		if ($pilihan2=='') {
			$errorPilihan2='wajib diisi';
			$validPilihan2=FALSE;
		}else{
			$validPilihan2=TRUE;
		}

		$pilihan3=test_input($_POST['pilihan3']);
		if ($pilihan3=='') {
			$errorPilihan3='wajib diisi';
			$validPilihan3=FALSE;
		}else{
			$validPilihan3=TRUE;
		}

		$pilihan4=test_input($_POST['pilihan4']);
		if ($pilihan4=='') {
			$errorPilihan4='wajib diisi';
			$validPilihan4=FALSE;
		}else{
			$validPilihan4=TRUE;
		}

		$pilihan5=test_input($_POST['pilihan5']);
		if ($pilihan5=='') {
			$errorPilihan5='wajib diisi';
			$validPilihan5=FALSE;
		}else{
			$validPilihan5=TRUE;
		}

		// jika tidak ada kesalahan input
		if ($validNim && $validKumulatif && $validSks && $validKrs && $validDaftar && $validPilihan1 && $validPilihan2 && $validPilihan3 && $validPilihan4 && $validPilihan5) {
			$nim=$con->real_escape_string($nim);
			// $nama=$con->real_escape_string($nama);
			$pilihan1=$con->real_escape_string($pilihan1);
			$pilihan2=$con->real_escape_string($pilihan2);
			$pilihan3=$con->real_escape_string($pilihan3);
			$pilihan4=$con->real_escape_string($pilihan4);
			$pilihan5=$con->real_escape_string($pilihan5);
			$kumulatif=$con->real_escape_string($kumulatif);
			$sks=$con->real_escape_string($sks);
			$krs=$con->real_escape_string($krs);
			$daftar=$con->real_escape_string($daftar);
			$query = "INSERT INTO tr1 (nim, ipk, sks, tanggal_krs, tanggal_daftar, pilihan1, pilihan2, pilihan3, pilihan4, pilihan5) VALUES ('".$nim."','".$kumulatif."','".$sks."','".$krs."','".$daftar."','".$pilihan1."','".$pilihan2."','".$pilihan3."','".$pilihan4."','".$pilihan5."')";

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
								<input class="form-control" type="text" name="nim" <?php if ($status=='anggota') {echo 'readonly';} ?> maxlength="14" size="30" placeholder="nim 14 digit angka" required autofocus value="<?php if($status=="anggota"){echo $anggota->nim;} ?>">
							</div>


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
										<td><p>Prioritas 1</p></td>
										<td>:</td>
										<td>
											<select id="pilihan1" name="pilihan1" required>
							<option value="none">--Pilih lab 1--</option>
							<?php
								$querykat = "select * from lab";
								$resultkat = $db->query($querykat);
								if(!$resultkat){
									die("Could not connect to the database : <br/>". $db->connect_error);
								}
								while ($row = $resultkat->fetch_object()){
									$sid = $row->nama_lab;
									$sname = $row->nama_lab;
									echo '<option value='.$sid.' ';
									if(isset($pilihan2) && $pilihan2==$sid)
									echo 'selected="true"';
									echo '>'.$sname.'<br/></option>';
									echo "cek";
								}
							?></select></td>
									</tr>
									<!--  -->
									<!-- <div class="form-group">
										<label>Pilihan 2</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_pilihan2)) echo $error_pilihan2;?></span>&nbsp;
										<select id="pilihan2" name="pilihan2" required>
						<option value="none">--Pilih lab 2--</option>
						<?php
							$querykat = "select * from lab";
							$resultkat = $db->query($querykat);
							if(!$resultkat){
								die("Could not connect to the database : <br/>". $db->connect_error);
							}
							while ($row = $resultkat->fetch_object()){
								$sid = $row->nama_lab;
								$sname = $row->nama_lab;
								echo '<option value='.$sid.' ';
								if(isset($pilihan2) && $pilihan2==$sid)
								echo 'selected="true"';
								echo '>'.$sname.'<br/></option>';
								echo "cek";
							}
						?></select>
					<span class="error">* <?php if(!empty($error_pilihan2)) echo $error_pilihan2; ?></span>
									</div> -->
									<!--  -->
									<tr>
										<td><p>Prioritas 2</p></td>
										<td>:</td>
										<td>
											<select id="pilihan2" name="pilihan2" required>
													<option value="none">--Pilih lab 2--</option>
														<?php
															$querykat = "select * from lab";
															$resultkat = $db->query($querykat);
															if(!$resultkat){
																die("Could not connect to the database : <br/>". $db->connect_error);
															}
															while ($row = $resultkat->fetch_object()){
																$sid = $row->nama_lab;
																$sname = $row->nama_lab;
																echo '<option value='.$sid.' ';
																if(isset($pilihan2) && $pilihan2==$sid)
																echo 'selected="true"';
																echo '>'.$sname.'<br/></option>';
																echo "cek";
															}
															?>
											</select>
										</td>
									</tr>
									<tr>
										<td><p>Prioritas 3</p></td>
										<td>:</td>
										<td>
											<select id="pilihan3" name="pilihan3" required>
													<option value="none">--Pilih lab 3--</option>
														<?php
															$querykat = "select * from lab";
															$resultkat = $db->query($querykat);
															if(!$resultkat){
																die("Could not connect to the database : <br/>". $db->connect_error);
															}
															while ($row = $resultkat->fetch_object()){
																$sid = $row->nama_lab;
																$sname = $row->nama_lab;
																echo '<option value='.$sid.' ';
																if(isset($pilihan2) && $pilihan2==$sid)
																echo 'selected="true"';
																echo '>'.$sname.'<br/></option>';
																echo "cek";
															}
															?>
											</select>
										</td>
									</tr>

									<tr>
										<td><p>Prioritas 4</p></td>
										<td>:</td>
										<td>
											<select id="pilihan4" name="pilihan4" required>
													<option value="none">--Pilih lab 4--</option>
														<?php
															$querykat = "select * from lab";
															$resultkat = $db->query($querykat);
															if(!$resultkat){
																die("Could not connect to the database : <br/>". $db->connect_error);
															}
															while ($row = $resultkat->fetch_object()){
																$sid = $row->nama_lab;
																$sname = $row->nama_lab;
																echo '<option value='.$sid.' ';
																if(isset($pilihan2) && $pilihan2==$sid)
																echo 'selected="true"';
																echo '>'.$sname.'<br/></option>';
																echo "cek";
															}
															?>
											</select>
										</td>
									</tr>

									<tr>
										<td><p>Prioritas 5</p></td>
										<td>:</td>
										<td>
											<select id="pilihan5" name="pilihan5" required>
													<option value="none">--Pilih lab 5--</option>
														<?php
															$querykat = "select * from lab";
															$resultkat = $db->query($querykat);
															if(!$resultkat){
																die("Could not connect to the database : <br/>". $db->connect_error);
															}
															while ($row = $resultkat->fetch_object()){
																$sid = $row->nama_lab;
																$sname = $row->nama_lab;
																echo '<option value='.$sid.' ';
																if(isset($pilihan2) && $pilihan2==$sid)
																echo 'selected="true"';
																echo '>'.$sname.'<br/></option>';
																echo "cek";
															}
															?>
											</select>
										</td>
									</tr>

								</table>
							</div>
							<div class="form-group">
								<input class="form-control" type="submit"  name="submit" value="Daftar">
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
