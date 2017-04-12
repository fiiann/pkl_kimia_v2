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

	$errorLab='';
	
	
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
				$lab = $row->flag_lab;
			}
		}
	}else{
		// Cek Nama
		$nim=test_input($_POST['nim']);
		$lab=test_input($_POST['lab']);
		if ($lab=='') {
			$errorLab='wajib diisi';
			$validLab=FALSE;
		}else{
			$validLab=TRUE;
		}
		
	
		
		// jika tidak ada kesalahan input
		if ($validLab) {
			
			$lab=$con->real_escape_string($lab);

			$query = "UPDATE pkt SET  flag_lab='".$lab."' WHERE nim='".$nim."'";

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
								<!-- <label>Laboratorium</label>&nbsp;* <span class="label label-warning"><?php if(isset($errorLab)) echo $errorLab;?></span>
								<input class="form-control" type="text" name="id_lab" maxlength="50" size="30"  required value="<?php if(isset($id_lab)){echo $id_lab;} ?>">
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
								<input class="form-control" type="submit" name="edit" value="Update Data">-
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	&nbsp;&nbsp;&nbsp;<a href="daftar_penempatan.php"><button class="btn btn-info">Kembali ke Daftar Penempatan</button></a>
</div>

<?php
include_once('footer.php');
$con->close();
?>