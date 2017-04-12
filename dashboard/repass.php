<?php
require_once('sidebar.php');
if($status!='petugas'){
	header('Location:./');
}

function acakpassword(){
	$karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
    $string = '';
    for ($i = 0; $i < 8; $i++) {
	  $pos = rand(0, strlen($karakter)-1);
	  $string .= $karakter{$pos};
    }
    return $string;
}

// Password anggota Aditia : lCXz6u4G

$pass = acakpassword();
$password = md5("sip".$pass."pis");

if(isset($_GET['data'])){
	if($_GET['data']=='anggota'){
		if($_GET['nim']==''){
			echo 'Tidak ada data password yang di reset.';
		}else{
			$nim = $_GET['nim'];
			$query = "UPDATE anggota SET password='$password' WHERE nim='".$nim."'";
			$result = $con->query( $query );
			$query1 = "SELECT * FROM anggota WHERE nim='".$nim."'";
			$result1 = $con->query( $query1 );
			$result1 = $result1->fetch_object();
			echo '<b>Selamat!</b><br/>Password berhasil di reset.<br/><br/>';
			echo '<b>Status : </b>'.$status.'<br />';
			echo '<b>NIM :</b> <span class="label label-success">'.$nim.'</span><br />';
			echo '<b>Email :</b> <span class="label label-success">'.$result1->email.'</span><br />';
			echo '<b>Password :</b> <span style="font-size:15px;" class="label label-success">'.$pass.'</span><br/><br/>';
			echo '<a href="daftar_anggota.php" class="btn btn-info square-btn-adjust"> << Daftar Anggota</a>';
		}
	}elseif($_GET['data']=='petugas'){
		if($_GET['id']==''){
			echo 'Tidak ada data password yang di reset.';
		}else{
			$id = $_GET['id'];
			$query = "UPDATE petugas SET password='$password' WHERE idpetugas='".$id."'";
			$result = $con->query( $query );
			$query1 = "SELECT * FROM petugas WHERE idpetugas='".$id."'";
			$result1 = $con->query( $query1 );
			$result1 = $result1->fetch_object();
			echo '<b>Selamat!</b><br/>Password berhasil di reset.<br/><br/>';
			echo '<b>Status : </b>'.$status.'<br />';
			echo '<b>ID :</b> <span class="label label-success">'.$id.'</span><br />';
			echo '<b>Email :</b> <span class="label label-success">'.$result1->email.'</span><br />';
			echo '<b>Password :</b> <span style="font-size:15px;" class="label label-success">'.$pass.'</span><br/><br/>';
			echo '<a href="daftar_petugas.php" class="btn btn-info square-btn-adjust"> << Daftar Petugas</a>';
		}
	}else{
		echo 'Terjadi kesalahan. Gagal melakukan reset password.<br/>';
		echo '<a href="index.php" class="btn btn-info square-btn-adjust"> << Dashboard</a>';
	}
}else{
	echo 'Tidak ada password yang di reset. Data tidak dikenali.<br/>';
	echo '<a href="index.php" class="btn btn-info square-btn-adjust"> << Dashboard</a>';
}

$con->close();
include_once('footer.php');
?>