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
	
	$db=new mysqli($db_host, $db_username, $db_password, $db_database);

	if($db->connect_errno){
		die("Could not connect to the database : <br/>". $db->connect_error);
	}

	$errorJudul='';
	
	
	$sukses=TRUE;

	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		if($_GET['nim']==""){
			header('Location:./daftar_penempatan.php');
		}
		$nim=$_GET['nim'];
		$query = " SELECT * FROM pkt WHERE nim='".$nim."'";
		// Execute the query
		$result = $con->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				// $nim=$row->nim;
				$judul = $row->judul;
			}
		}
	}else{
		// Cek Nama
		$nim=test_input($_POST['nim']);
		$judul=test_input($_POST['judul']);
		if ($judul=='') {
			$errorJudul='wajib diisi';
			$validJudul=FALSE;
		}else{
			$validJudul=TRUE;
		}
		
	
		
		// jika tidak ada kesalahan input
		if ($validJudul) {
			
			$judul=$con->real_escape_string($judul);

			$query = "UPDATE pkt SET  judul='".$judul."' WHERE nim='".$nim."'";

			$hasil=$con->query($query);
			if (!$hasil) {
				die("Tidak dapat menjalankan query database: <br>".$con->error);
			}else{
				$sukses=TRUE;
				echo "<br/>Berhasil edit data";
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
				Update Data Laboratorium
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">
							<div class="form-group">
								<label>NIM</label>
								<input class="form-control" type="text" name="nim" maxlength="14" readonly size="30" value="<?php echo $nim; ?>">
							</div>
							
							<div class="form-group">
								<label>Judul</label>&nbsp;<span class="label label-warning">* <?php if(isset($errorJudul)) echo $errorjudul;?></span>
								<!-- <textarea class="form-control" name="judul" rows="5" cols="150" maxlength="1000" size="130" placeholder="Judul PKT" required autofocus value="<?php echo $judul; ?>">
										
								</textarea> -->
								<input class="form-control" type="text" name="judul" maxlength="200" size="200" placeholder="Judul PKT" required autofocus value="<?php if(isset($judul)){echo $judul;} ?>">
							</div>
							
							<div class="form-group">
								<input class="form-control" type="submit" name="edit" value="Update Data">-
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	&nbsp;&nbsp;&nbsp;<a href="daftar_judul.php"><button class="btn btn-info">Kembali ke Daftar Judul</button></a>
</div>

<?php
include_once('footer.php');
$con->close();
?>