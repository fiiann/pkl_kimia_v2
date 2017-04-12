<?php
	require_once('sidebar.php');
	//$id=$_SESSION['sip_masuk_aja'];
	if($status=="anggota"){
		header('Location:./index.php');
	}

	$db=new mysqli($db_host, $db_username, $db_password, $db_database);

	if($db->connect_errno){
		die("Could not connect to the database : <br/>". $db->connect_error);
	}

	$sukses=TRUE;
	//penempatan
	// eksekusi tombol daftar
	if (isset($_POST['daftar'])) {
		// Cek Nim
		$nim=test_input($_POST['nim']);
		if ($nim=='') {
			$errorNim='wajib diisi';
			$validNim=FALSE;
		}elseif (!preg_match("/^[0-9]{14}$/",$nim)) {
			$errorNim='NIM harus terdiri dari 14 digit angka';
			$validNim=FALSE;
		}
			else{
				$validNim = TRUE;
			}

		$lab=test_input($_POST['lab']);
		if($lab=='') {
			$errorLab='wajib diisi';
			$validLab=FALSE;
		}else{
			$validLab=TRUE;
		}



		// jika tidak ada kesalahan input
		if ($validNim && $validLab ) {
			$nim=$con->real_escape_string($nim);
			$lab=$con->real_escape_string($lab);


			// $query = "INSERT INTO penempatan (id_lab, nim) VALUES ('".$lab."','".$nim."')";
			$query2 = "UPDATE tr1 SET idlab='".$lab."' WHERE nim='".$nim."'"	;

			// $hasil=$con->query($query);
			$hasil2=$con->query($query2);
			if (!$hasil2) {
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
				Penempatan laboratorium
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<span class="label label-success"><?php if(isset($pesan_sukses)) echo $pesan_sukses;?></span>
							<div class="form-group">
								<label>NIM</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" type="text" name="nim" maxlength="14" size="30" placeholder="nim 14 digit angka" required autofocus value="<?php if(!$sukses&&$validNim){echo $nim;} ?>">
							</div>
	<!-- 						<div class="form-group">
								<label>Lab</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorLab)) echo $errorLab;?></span>
								<input class="form-control" type="text" name="lab" maxlength="14" size="30" placeholder="ex : A" required autofocus value="<?php if(!$sukses&&$validLab){echo $lab;} ?>">
							</div> -->
							<div class="form-group">
											<label>LABORATORIUM</label>&nbsp;<span class="label label-warning">* <?php if(isset($error_Lab)) echo $error_Lab;?></span>&nbsp;
											<select id="lab" name="lab" required>
							<option value="none">--Pilih lab --</option>
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
									if(isset($lab) && $lab==$sid)
									echo 'selected="true"';
									echo '>'.$sname.'<br/></option>';
									//echo "cek";
								}
							?></select>
							<span class="error">* <?php if(!empty($error_Lab)) echo $error_Lab; ?></span>
							</div>
							<div class="form-group">
								<input class="form-control" type="submit" name="daftar" value="Input">
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
