<?php
	require_once('functions.php');
	if(!isset($_SESSION['sip_masuk_aja'])){
		if(isset($_POST['login'])){
		  if((!empty($_POST['email']))&&(!empty($_POST['password']))){
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$password = mysqli_real_escape_string($con, $_POST['password']);
			$password = md5("sip".$password."pis");

			$cekLoginPetugas = mysqli_query($con, "SELECT idpetugas FROM petugas WHERE email = '$email' AND password = '$password'");
			$cekLoginAnggota = mysqli_query($con, "SELECT nim FROM mahasiswa WHERE email = '$email' AND password = '$password'");
			$cekLoginDosen = mysqli_query($con, "SELECT nip FROM dosen WHERE email = '$email' AND password = '$password'");
			$cekLoginLab = mysqli_query($con, "SELECT idlab FROM lab WHERE admin = '$email' AND password = '$password'");

			if(mysqli_num_rows($cekLoginPetugas)!=0){
			  $fetch_user_id = mysqli_fetch_assoc($cekLoginPetugas);
			  $_SESSION['sip_masuk_aja'] = $fetch_user_id['idpetugas'];
			  $_SESSION['sip_status'] = "petugas";
			  header("Location:./");
			}elseif(mysqli_num_rows($cekLoginAnggota)!=0){
			  $fetch_user_id = mysqli_fetch_assoc($cekLoginAnggota);
			  $_SESSION['sip_masuk_aja'] = $fetch_user_id['nim'];
			  $_SESSION['sip_status'] = "anggota";
			  header("Location:./");
			}elseif(mysqli_num_rows($cekLoginDosen)!=0){
			  $fetch_user_id = mysqli_fetch_assoc($cekLoginDosen);
			  $_SESSION['sip_masuk_aja'] = $fetch_user_id['nip'];
			  $_SESSION['sip_status'] = "dosen";
			  header("Location:./");
			}elseif(mysqli_num_rows($cekLoginLab)!=0){
			  $fetch_user_id = mysqli_fetch_assoc($cekLoginLab);
			  $_SESSION['sip_masuk_aja'] = $fetch_user_id['idlab'];
			  $_SESSION['sip_status'] = "lab";
			  header("Location:./");
			}else{
			  $gagal = "Tidak dapat login. Silahkan cek email dan password anda kembali";
			}
		  }else{
			$gagal = "email dan password harus di isi!";
			if(!empty($_POST['email'])){
				$email = mysqli_real_escape_string($con, $_POST['email']);
			}
		  }
		}
    }else{
		header("Location:./");
		exit;
	}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php $site_name ?></title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <style>
	body{
		background-color: #076960;
	}

	.vertical-offset-100{
		padding-top:100px;
	}
	</style>
</head>
<body>
<div class="container">
    <div class="row vertical-offset-100">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Silakan Masuk</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form accept-charset="UTF-8" role="form" method="POST">
                    <fieldset>
						<?php if(isset($gagal)) echo '<div class="form-group"><span class="label label-warning">'.$gagal.'</span></div>' ?>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="E-mail" name="email" type="text" value="<?php if(isset($email)) echo $email; ?>"/>
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Password" name="password" type="password"/>
			    		</div>
			    		<input class="btn btn-lg btn-success btn-block" type="submit" name="login" value="Login"/>
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
