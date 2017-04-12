<!--
	Tanggal		: 25 November 2016
	Program		: pendaftaran_anggota.php
	Deskripsi	: menambah data anggota pada database
-->
<?php
	require_once('sidebar.php');
	if($status=="anggota"){
			header('Location:./index.php');
		}
		
		
	$errorNim='';
	$errorNama='';
	$errorTlp='';
	$errorPass='';
	$errorAlamat='';
	$errorKota='';
	$errorEmail='';
	$validNama='';
	$sukses=TRUE;

	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		if($_GET['nim']==""){
			header('Location:./daftar_anggota.php');
		}
		$nim=$_GET['nim'];
		$query = " SELECT * FROM anggota WHERE nim='".$nim."'";
		// Execute the query
		$result = $con->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				$nama=$row->nama;
				$alamat = $row->alamat;
				$kota = $row->kota;
				$email = $row->email;
				$noTlp = $row->no_telp;
			}
		}
	}else{
		$nimlawas = test_input ($_POST['nim']);
		
		$nim = test_input($_POST['nim_new']);
		if ($nim == ''){
			$errorNim = "nim wajib diisi";
			$valid_nim = FALSE;
		}elseif(!preg_match("/^[0-9]{14}$/",$nim)){
			$errorNim = "NIM harus terdiri dari 14 digit angka";
			$valid_nim = FALSE;
		}else{
			$query = " SELECT * FROM anggota WHERE nim='".$nim."'";
			$result = $con->query( $query );
			if($result->num_rows!=0 && $nim!=$_POST['nim']){
				$errorNim="nim sudah pernah digunakan, harap masukkan nim lain";
				$valid_nim=FALSE;
			}
			else{
				$valid_nim = TRUE;
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
			$query = " SELECT * FROM anggota WHERE email='".$email."'";
			$result = $con->query( $query );
			$query1 = " SELECT email FROM anggota WHERE nim='".$nimlawas."'";
			$result1 = $con->query( $query1 );
			$ceknim = $result1->fetch_object();
			$email_lawas = $result->email;
			if($result->num_rows!=0 && $email!=$email_lawas){
				$errorEmail="email sudah pernah digunakan, harap masukkan email lain";
				$validEmail=FALSE;
			}
			else{
				$validEmail = TRUE;
			}
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
		
		// jika tidak ada kesalahan input
		if ($valid_nim && $validNama && $validAlamat && $validKota && $validEmail && $validTlp) {
			$nim=$con->real_escape_string($nim);
			$nama=$con->real_escape_string($nama);
			$alamat=$con->real_escape_string($alamat);
			$kota=$con->real_escape_string($kota);
			$email=$con->real_escape_string($email);
			$noTlp=$con->real_escape_string($noTlp);

			$query = "UPDATE anggota SET nim='".$nim."', nama='".$nama."', alamat='".$alamat."', kota='".$kota."', email='".$email."', no_telp='".$noTlp."' WHERE nim='".$nimlawas."'";

			$hasil=$con->query($query);
			if (!$hasil) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$berhasil = "Berhasil";
			}
		}
	}
?>
<div class="row">
	<div class="col-md-6">
		<!-- Form Elements -->
		<div class="panel panel-default">
			<div class="panel-heading">
				Update Data Anggota <span class="label label-success"><?php if(isset($berhasil)) echo $berhasil;?></span>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">
							<div class="form-group" hidden>
								<label>NIM</label>
								<input class="form-control" type="text" name="nim" maxlength="14" size="30" placeholder="nim 14 digit angka" required autofocus value="<?php if(isset($nim)) echo $nim; else echo $_POST['nim_new']; ?>" />
							</div>
							<div class="form-group">
								<label>NIM</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorNim)) echo $errorNim;?></span>
								<input class="form-control" type="text" name="nim_new" maxlength="14" size="30" placeholder="nim 14 digit angka" required autofocus value="<?php if(isset($nim)) echo $nim; else echo $_POST['nim_new']; ?>">
							</div>
							<div class="form-group">
								<label>Nama</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorNama)) echo $errorNama;?></span>
								<input class="form-control" type="text" name="nama" maxlength="50" size="30" placeholder="masukan nama" required value="<?php if(isset($nama)){echo $nama;} ?>">
							</div>
							<div class="form-group">
								<label>Alamat</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorAlamat)) echo $errorAlamat;?></span>
								<textarea required class="form-control" name="alamat" placeholder="masukan alamat rumah" cols="26" rows="5" maxlength="150"><?php if(isset($alamat)){echo $alamat;} ?></textarea>
							</div>
							<div class="form-group">
								<label>Kota</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorKota)) echo $errorKota;?></span>
								<input class="form-control" type="text" name="kota" maxlength="50" size="30" placeholder="kota asal" required value="<?php if(isset($kota)){echo $kota;} ?>">
							</div>
							<div class="form-group">
								<label>Telp/HP</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorTlp)) echo $errorTlp;?></span>
								<input class="form-control" type="text" name="telpon" maxlength="15" size="30" placeholder="nomor telpon HP aktif" required value="<?php if(isset($noTlp)){echo $noTlp;} ?>">
							</div>
							<div class="form-group">
								<label>Email</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorEmail)) echo $errorEmail;?></span>
								<input class="form-control" type="email" name="email" size="30" placeholder="example@email.com" required value="<?php if(isset($email)){echo $email;} ?>">
							</div>
							<div class="form-group">
								<input class="form-control" type="submit" name="edit" value="Update Data">
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