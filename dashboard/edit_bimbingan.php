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
	
	$errorNilai='';
	
	
	$sukses=TRUE;

	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		if($_GET['nim']==""){
			header('Location:./daftar_bimbingan.php');
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
				$nip = $row->nip;
			}
		}
	}else{
		// Cek Nama
		
		$nim=test_input($_POST['nim']);
		$nip=test_input($_POST['nip']);
		if ($nip=='') {
			$errorNip='wajib diisi';
			$validNip=FALSE;
		}else{
			$validNip=TRUE;
		}
		
	
		
		// jika tidak ada kesalahan input
		if ($validNip) {
			
			$nip=$con->real_escape_string($nip);

			$query = "UPDATE pkt SET  nip='".$nip."' WHERE nim='".$nim."'";

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
				Update Data Bimbingan
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">
							<div class="form-group" hidden>
								<label>NIM</label>
								<input class="form-control" type="text" name="nim" maxlength="14" size="30" value="<?php echo $nim; ?>">
							</div>
							<div class="form-group">
								<label>Pembimbing</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorNip)) echo $errorNip;?></span>
								<input class="form-control" type="text" name="nip" maxlength="50" size="30" placeholder="edit nip" required value="<?php if(isset($nip)){echo $nip;} ?>">
							</div>
							
							<div class="form-group">
								<input class="form-control" type="submit" name="edit" value="Update Data">-
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<a href="daftar_bimbingan.php"><button class="btn btn-info">Kembali ke daftar bimbingan</button></a>
	</div>
</div>

<?php
include_once('footer.php');
$con->close();
?>