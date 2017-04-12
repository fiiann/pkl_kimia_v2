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
		}else{
			$query = " SELECT * FROM anggota WHERE nim='".$nim."'";
			$result = $con->query( $query );
			if($result->num_rows!=0){
				$errorNim="NIM sudah pernah digunakan, harap masukkan NIM lain";
				$validNim=FALSE;
			}
			else{
				$validNim = TRUE;
			}
		}

		// Cek Nama
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

		// Cek password
		$password=test_input($_POST['password']);
		$password = md5("sip".$password."pis");
		if ($password=='') {
			$errorPass='wajib diisi';
			$validPass=FALSE;
		}else{
			$validPass=TRUE;
		}

		// cek alamat
		$alamat=test_input($_POST['alamat']);
		if ($alamat=='') {
			$errorAlamat='wajib diisi';
			$validAlamat=FALSE;
		}else{
			$validAlamat=TRUE;
		}

		// cek kota
		$kota=test_input($_POST['kota']);
		if($kota=='') {
			$errorKota='wajib diisi';
			$validKota=FALSE;
		}else{
			$validKota=TRUE;
		}

		// cek email
		$email=test_input($_POST['email']);
		if ($email=='') {
			$errorEmail='wajib diisi';
			$validEmail=FALSE;
		}else{
			$validEmail=TRUE;
		}

		// cek nomor telpon
		$noTlp=test_input($_POST['telpon']);
		if ($noTlp=='') {
			$errorTlp='wajib diisi';
			$validTlp=FALSE;
		}elseif (!preg_match("/^[0-9]*$/",$noTlp)) {
			$errorTlp='hanya mengizinkan angka 0-9';
			$validTlp=FALSE;
		}else{
			$validTlp=TRUE;
		}

		//cek wali
		$id_wali=test_input($_POST['id_wali']);
		if($id_wali=='') {
			$errorWali='wajib diisi';
			$validWali=FALSE;
		}else{
			$validWali=TRUE;
		}

		//cek angkatan
		$angkatan=test_input($_POST['angkatan']);
		if ($angkatan=='') {
			$errorAngkatan='wajib diisi';
			$errorAngkatan=FALSE;
		}elseif (!preg_match("/^[0-9]{4}*$/",$nama)) {
			$errorAngkatan='hanya mengizinkan angka';
			$validAngkatan=FALSE;
		}else{
			$validAngkatan=TRUE;
		}
		// jika tidak ada kesalahan input
		if ($validNim && $validNama && $validPass && $validAlamat && $validKota && $validEmail && $validTlp) {
			$nim=$con->real_escape_string($nim);
			$nama=$con->real_escape_string($nama);
			$password=$con->real_escape_string($password);
			$alamat=$con->real_escape_string($alamat);
			$kota=$con->real_escape_string($kota);
			$email=$con->real_escape_string($email);
			$noTlp=$con->real_escape_string($noTlp);
			$id_wali=$con->real_escape_string($id_wali);
			$anggota=$con->real_escape_string($anggota);

			$query = "INSERT INTO anggota (nim, nama, password, alamat, kota, email, no_telp, id_wali, angkatan) VALUES ('".$nim."','".$nama."','".$password."','".$alamat."','".$kota."','".$email."','".$noTlp."','".$id_wali."','".$angkatan."')";

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
				Tambah Anggota
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
								<label>Nama</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorNama)) echo $errorNama;?></span>
								<input class="form-control" type="text" name="nama" maxlength="50" size="30" placeholder="masukan nama" required value="<?php if(!$sukses&&$validNama){echo $nama;} ?>">
							</div>
							<div class="form-group">
								<label>Alamat</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorAlamat)) echo $errorAlamat;?></span>
								<textarea class="form-control" name="alamat" placeholder="masukan alamat rumah" cols="26" rows="5" required maxlength="150"><?php if(!$sukses&&$validAlamat){echo $alamat;} ?></textarea>
							</div>
							<div class="form-group">
								<label>Kota</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorKota)) echo $errorKota;?></span>
								<input class="form-control" type="text" name="kota" maxlength="50" size="30" placeholder="kota asal" required value="<?php if(!$sukses&&$validKota){echo $kota;} ?>">
							</div>
							<div class="form-group">
								<label>Telp/HP</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorTlp)) echo $errorTlp;?></span>
								<input class="form-control" type="text" name="telpon" maxlength="15" size="30" placeholder="nomor telpon HP aktif" required value="<?php if(!$sukses&&$validTlp){echo $noTlp;} ?>">
							</div>
							<div class="form-group">
								<label>Email</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorEmail)) echo $errorEmail;?></span>
								<input class="form-control" type="email" name="email" size="30" placeholder="example@email.com" required value="<?php if(!$sukses&&$validEmail){echo $email;} ?>">
							</div>
							<div class="form-group">
								<label>ID Wali</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorWali)) echo $errorWali;?></span>
								<input class="form-control" type="text" name="id_wali" size="10" placeholder="ex : 001" required value="<?php if(!$sukses&&$validWali){echo $id_wali;} ?>">
							</div>
							<div class="form-group">
								<label>Angkatan</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorAngkatan)) echo $errorAngkatan;?></span>
								<input class="form-control" type="text" name="angkatan" size="5" placeholder="ex : 2014" required value="<?php if(!$sukses&&$validAngkatan){echo $angkatan;} ?>">
							</div>
							<div class="form-group">
								<label>Password</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorPass)) echo $errorPass;?></span>
								<input class="form-control" type="password" name="password" minlength="8" pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$" maxlength="50" size="30" placeholder="minimal 8 digit" required value="<?php if(!$sukses&&$validPass){echo $_POST['password'];} ?>">
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