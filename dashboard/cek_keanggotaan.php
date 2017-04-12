<?php
	
	require_once('functions.php');
	if($status=="anggota"){
		header('Location:./index.php');
	}
	$nim=$_GET['nim'];
	$ceknim=$con->query("SELECT nim FROM anggota WHERE nim='".$nim."'");
	if(mysqli_num_rows($ceknim)==0){
		echo '<span class="error">NIM belum Terdaftar. </span>';
		echo '<a href="tambah_anggota.php"><span class="label label-success">Tambahkan Sebagai Anggota</span></a>';
	}
?>