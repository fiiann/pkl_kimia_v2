<?php
	require_once('sidebar.php');
	if($status=="anggota"){
		header('Location:./index.php');
	}
	// 	$db=new mysqli($db_host, $db_username, $db_password, $db_database);

	// if($db->connect_errno){
	// 	die("Could not connect to the database : <br/>". $db->connect_error);
	// }

	$sukses=TRUE;

	// eksekusi tombol daftar
	if (isset($_POST['daftar'])) {
		// Cek Nim
		
		$kategori=test_input($_POST['kategori']);
		if ($kategori=='') {
			$errorKategori='wajib diisi';
			$validKategori=FALSE;
		}else{
			$validKategori=TRUE;
		}

		$agenda=test_input($_POST['agenda']);
		if ($agenda=='') {
			$errorAgenda='wajib diisi';
			$validAgenda=FALSE;
		}elseif (!preg_match("/^[a-zA-Z0-9 ]*$/",$agenda)) {
			$errorAgenda='hanya mengizinkan huruf dan spasi';
			$validAgenda=FALSE;
		}else{
			$validAgenda=TRUE;
		}

		$waktu=test_input($_POST['waktu']);
		if ($waktu=='') {
			$errorWaktu='wajib diisi';
			$validWaktu=FALSE;
		}else{
			$validWaktu=TRUE;
		}

		$keterangan=test_input($_POST['keterangan']);
		if ($keterangan=='') {
			$errorKet='wajib diisi';
			$validKet=FALSE;
		}else{
			$validKet=TRUE;
		}

		

	
		// jika tidak ada kesalahan input
		if ($validKategori && $validAgenda && $validWaktu && $validKet) {
			$kategori=$con->real_escape_string($kategori);
			$agenda=$con->real_escape_string($agenda);
			$waktu=$con->real_escape_string($waktu);
			$keterangan=$con->real_escape_string($keterangan);
			$query = "INSERT INTO jadwal (kategori, agenda, waktu, keterangan) VALUES ('".$kategori."','".$agenda."','".$waktu."','".$keterangan."')";

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
								<label>Kategori</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorKategori)) echo $errorKategori;?></span>
								<input class="form-control" type="text" name="kategori" maxlength="50" size="30" placeholder="contoh : PKT" required autofocus value="<?php if(!$sukses&&$validKategori){echo $kategori;} ?>">
							</div>
							
							<div class="form-group">
								<label>Agenda</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorAgenda)) echo $errorAgenda;?></span>
								<input class="form-control" type="text" name="agenda" maxlength="50" size="30" placeholder="masukan agenda" required value="<?php if(!$sukses&&$validAgenda){echo $agenda;} ?>">
							</div>
							<div class="form-group">
								<label>Waktu</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorWaktu)) echo $errorWaktu;?></span>
								<input class="form-control" type="text" name="waktu" maxlength="50" size="30" placeholder="ex : 2017-01-17" required value="<?php if(!$sukses&&$validWaktu){echo $waktu;} ?>">
							</div>
							<div class="form-group">
								<label>Keterangan</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorKet)) echo $errorKet;?></span>
								<input class="form-control" type="text" name="keterangan" maxlength="50" size="30" placeholder="masukan keterangan" required value="<?php if(!$sukses&&$validKet){echo $keterangan;} ?>">
							</div>

							<div class="form-group">
								<input class="form-control" type="submit"  name="daftar" value="Daftar">
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