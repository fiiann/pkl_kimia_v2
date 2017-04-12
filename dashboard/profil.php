<?php
	include_once('sidebar.php');
	if(isset($_POST["ubah"])){
		$pl = test_input ($_POST['password_lama']);
		$pl = md5("sip".$pl."pis");
		$pb = test_input ($_POST['password_baru']);
		$pb = md5("sip".$pb."pis");
		
		if($status=='anggota'){
			$nim = $anggota->nim;
			$cekPassword = mysqli_query($con, "SELECT nim FROM anggota WHERE nim = '$nim' AND password = '$pl'");
			if(mysqli_num_rows($cekPassword)!=0){
				$valid_pl = TRUE;
			}else{
				$valid_pl = FALSE;
			}
			if ($valid_pl){
				$pb = $con->real_escape_string($pb);
				$query = " UPDATE anggota SET password='".$pb."' WHERE nim='$nim' AND password = '$pl'";
				$result = $con->query( $query );
				if (!$result){
				   die ("Could not query the database:". $con->error);
				}else{
					$berhasil = 'Password anda berhasil diubah.';
				}
			}else{
				$gagal = 'Password anda salah. Silakan cek kembali.';
			}
		}else{
			$id = $petugas->idpetugas;
			$cekPassword = mysqli_query($con, "SELECT idpetugas FROM petugas WHERE idpetugas = '$id' AND password = '$pl'");
			if(mysqli_num_rows($cekPassword)!=0){
				$valid_pl = TRUE;
			}else{
				$valid_pl = FALSE;
			}
			if ($valid_pl){
				$pb = $con->real_escape_string($pb);
				$query = " UPDATE petugas SET password='".$pb."' WHERE idpetugas='$id' AND password = '$pl'";
				$result = $con->query( $query );
				if (!$result){
				   die ("Could not query the database:". $con->error);
				}else{
					$berhasil = 'Password anda berhasil diubah.';
				}
			}else{
				$gagal = 'Password anda salah. Silakan cek kembali.';
			}
		}
	}
?>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Edit Password <?php if(isset($berhasil)) echo '<span class="label label-success">'.$berhasil.'</span>'; ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<form id="formpassword" method="POST" role="form" autocomplete="on">
							<div class="form-group">
								<label>Password&nbsp;</label><?php if(isset($gagal)) echo '<span class="label label-warning">'.$gagal.'</span>'; ?>
								<input class="form-control" type="password" id="password_lama" name="password_lama" minlength="8" autofocus placeholder="Masukkan password lama anda" required />
							</div>
							<div class="form-group">
								<label>Password Baru</label>
								<input class="form-control" type="password" pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$" id="password_baru" name="password_baru" minlength="8" placeholder="Masukkan Password baru anda" required />
							</div>
							<div class="form-group">
								<input class="form-control" type="submit" id="ubah" name="ubah" value="Ubah"/>
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
?>