<!--
	Tanggal		: 25 November 2016
	Program		: pendaftaran_petugas.php
	Deskripsi	: menambah data anggota pada database
-->
<?php
	require_once('sidebar.php');
	if($status=="anggota"){
		header('Location:./index.php');
	}
	
	$errorNama='';
	$errorEmail='';
	
	$sukses=TRUE;

	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		if($_GET['id']==""){
			header('Location:./daftar_petugas.php');
		}	
		$id=$_GET['id'];
		$query = " SELECT * FROM petugas WHERE idpetugas='".$id."'";
		// Execute the query
		$result = $con->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				$nama=$row->nama;
				$email = $row->email;
			}
		}
	}else{
		// Cek Nama
		$id=test_input($_POST['id']);
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
		
		// cek email
		$email=test_input($_POST['email']);
		if ($email=='') {
			$errorEmail='wajib diisi';
			$validEmail=FALSE;
		}else{
			$query = " SELECT * FROM petugas WHERE email='".$email."'";
			$result = $con->query( $query );
			$query1 = " SELECT email FROM petugas WHERE idpetugas='".$id."'";
			$result1 = $con->query( $query1 );
			$ceknim = $result1->fetch_object();
			$email_lawas = $result->email;
			if($result->num_rows!=0 && $email=$email_lawas){
				$errorEmail="email sudah pernah digunakan, harap masukkan email lain";
				$validEmail=FALSE;
			}
			else{
				$validEmail = TRUE;
			}
		}
		
		// jika tidak ada kesalahan input
		if ($validNama && $validEmail) {
			$nama=$con->real_escape_string($nama);
			$email=$con->real_escape_string($email);

			$query = "UPDATE petugas SET nama='".$nama."', email='".$email."' WHERE idpetugas='".$id."'";

			$hasil=$con->query($query);
			if (!$hasil) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
				echo "<br/>Berhasil";
			}
		}
		else{
			$sukses=FALSE;
		}
	}
?>
<div class="row">
	<div class="col-md-6">
		<!-- Form Elements -->
		<div class="panel panel-default">
			<div class="panel-heading">
				Update Data Petugas
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">
							<div class="form-group" hidden>
								<label>ID Petugas</label>
								<input class="form-control" type="text" name="id" maxlength="14" size="30" value="<?php echo $id; ?>">
							</div>
							<div class="form-group">
								<label>Nama</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorNama)) echo $errorNama;?></span>
								<input class="form-control" type="text" name="nama" maxlength="50" size="30" placeholder="masukan nama" required value="<?php if(isset($nama)){echo $nama;} ?>">
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