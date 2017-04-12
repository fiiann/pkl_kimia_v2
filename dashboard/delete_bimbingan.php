<?php
$nim = $_GET['nim'];
include_once('sidebar.php');
if($status=="anggota"){
		header('Location:./index.php');
	}
// Assign the query
$query = " SELECT * FROM bimbingan  WHERE nim='".$nim."'";
// Execute the query
$result = $con->query($query);
$row = $result->fetch_object();

		echo '<table border="0">';
			echo '<tr>';
				echo '<td>NIM</td>';
				echo '<td> : '.$row->nim.'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Pembimbing</td>';
				echo '<td> : '.$row->nip.'</td>';
			echo '</tr>';
		echo '</table>';
		echo '<br />';
		echo 'Apakah anda yakin ingin menghapus data bimbingan mahasiswa ini? <a href="delete.php?data=bimbingan&nim='.$nim.'">YA</a> / <a href="daftar_bimbingan.php">TIDAK</a>';
		$con->close();
?>
<?php
	include_once('footer.php');
?>
<!-- INNER JOIN anggota ON bimbingan.nim=anggota.nim INNER JOIN dosen ON bimbingan.nip=dosen.nip -->