<?php
	require_once('sidebar.php');
	if($status=="anggota"){
		header('Location:./index.php');
	}

	$sukses=TRUE;

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
		
		// Cek Nip
		$nip=test_input($_POST['nip']);
		if ($nip=='') {
			$errorNip='wajib diisi';
			$validNip=FALSE;
		}elseif (!preg_match("/^[0-9]{18}$/",$nip)) {
			$errorNip='NIM harus terdiri dari 18 digit angka';
			$validNip=FALSE;
		}else{
				$validNip = TRUE;
			}

		

		// jika tidak ada kesalahan input
		if ($validNim && $validNip ) {
			$nim=$con->real_escape_string($nim);
			$nip=$con->real_escape_string($nip);
			

			$query2 = "UPDATE pkt SET nip='".$nip."' WHERE nim='".$nim."'"	;
			// $query2 = "UPDATE bimbingan SET nip1='".$nip."' WHERE nim='".$nim."'";
			$hasil=$con->query($query2);
			// $hasil2=$con->query($query2);
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
				Bimbingan
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
							<div class="form-group">
								<label>NIP</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNip)) echo $errorNip;?></span>
								<input class="form-control" type="text" name="nip" maxlength="18" size="30" placeholder="nim 18 digit angka" required autofocus value="<?php if(!$sukses&&$validNip){echo $nip;} ?>">
							</div>
							
							<div class="form-group">
								<input class="form-control" type="submit" name="daftar" value="Daftar">
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