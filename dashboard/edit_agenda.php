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
	
	$errorKategori='';
	$errorAgenda='';
	$errorWaktu='';
	$errorKeterangan='';
	
	
	$sukses=TRUE;

	// eksekusi tombol edit
	if(!isset($_POST['edit'])){
		if($_GET['id_jadwal']==""){
			header('Location:./daftar_jadwal.php');
		}
		$id_jadwal=$_GET['id_jadwal'];
		$query = " SELECT * FROM jadwal WHERE id_jadwal='".$id_jadwal."'";
		// Execute the query
		$result = $con->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $con->error);
		}else{
			while ($row = $result->fetch_object()){
				// $nim=$row->nim;
				$kategori = $row->kategori;
				$agenda = $row->agenda;
				$waktu = $row->waktu;
				$keterangan = $row->keterangan;
			}
		}
	}else{
		
		$id_jadwal=test_input($_POST['id_jadwal']);
		
		// Cek kategori
		$kategori=test_input($_POST['kategori']);
		if ($kategori=='') {
			$errorKategori='wajib diisi';
			$validKategori=FALSE;
		}else{
			$validKategori=TRUE;
		}
		//cek agenda
		$agenda=test_input($_POST['agenda']);
		if ($agenda=='') {
			$errorAgenda='wajib diisi';
			$validAgenda=FALSE;
		}else{
			$validAgenda=TRUE;
		}
		

		// Cek waktu	
		$waktu=test_input($_POST['waktu']);
		if ($waktu=='') {
			$errorWaktu='wajib diisi';
			$validWaktu=FALSE;
		}else{
			$validWaktu=TRUE;
		}
		//cek keterangan
		$keterangan=test_input($_POST['keterangan']);
		if ($keterangan=='') {
			$errorKeterangan='wajib diisi';
			$validKeterangan=FALSE;
		}else{
			$validKeterangan=TRUE;
		}

		// jika tidak ada kesalahan input
		if ($validKategori && $validAgenda && $validWaktu && $validKeterangan) {
			
			$kategori=$con->real_escape_string($kategori);
			$agenda=$con->real_escape_string($agenda);
			$waktu=$con->real_escape_string($waktu);
			$keterangan=$con->real_escape_string($keterangan);

			$query = "UPDATE jadwal SET  kategori='".$kategori."', agenda='".$agenda."',waktu='".$waktu."',keterangan='".$keterangan."' WHERE id_jadwal='".$id_jadwal."'";

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
				Update jadwal
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" role="form" autocomplete="on" action="">
							<div class="form-group" hidden>
								<label>No</label>
								<input class="form-control" type="text" name="id_jadwal" maxlength="14" size="30" value="<?php echo $id_jadwal; ?>">
							</div>
							
							<div class="form-group">
								<label>Kategori</label>&nbsp; <span class="label label-warning">*<?php if(isset($errorKategori)) echo $errorKategori;?></span>
								<input class="form-control" type="text" name="kategori" maxlength="50" size="30" placeholder="edit kategori" required value="<?php if(isset($kategori)){echo $kategori;} ?>">
							</div>
							
							<div class="form-group">
								<label>Agenda</label>&nbsp; <span class="label label-warning">*<?php if(isset($errorAgenda)) echo $errorAgenda;?></span>
								<input class="form-control" type="text" name="agenda" maxlength="50" size="30" placeholder="edit agenda" required value="<?php if(isset($agenda)){echo $agenda;} ?>">
							</div>
							
							<div class="form-group">
								<label>Waktu</label>&nbsp; <span class="label label-warning">*<?php if(isset($errorWaktu)) echo $errorWaktu;?></span>
								<input class="form-control" type="text" name="waktu" maxlength="50" size="30" placeholder="edit waktu" required value="<?php if(isset($waktu)){echo $waktu;} ?>">
							</div>
							
							<div class="form-group">
								<label>Keterangan</label>&nbsp; <span class="label label-warning">*<?php if(isset($errorKet)) echo $errorKet;?></span>
								<input class="form-control" type="text" name="keterangan" maxlength="50" size="30" placeholder="edit keterangan" required value="<?php if(isset($keterangan)){echo $keterangan;} ?>">
							</div>
							
							<div class="form-group">
								<input class="form-control" type="submit" name="edit" value="Update Data">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<a href="nilai_pkt.php"><button class="btn btn-info">Kembali ke Nilai PKT</button></a>
	</div>

</div>

<?php
include_once('footer.php');
$con->close();
?>