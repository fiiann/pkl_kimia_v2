<?php
$nim = $_GET['nim'];
include_once('sidebar.php');
if($status=="anggota"){
		header('Location:./index.php');
	}
// Assign the query
$query = " SELECT * FROM penempatan WHERE nim='".$nim."'";
// Execute the query
$result = $con->query($query);
$row = $result->fetch_object();

		echo '<table border="0">';
			echo '<tr>';
				echo '<td>NIM</td>';
				echo '<td> : '.$row->nim.'</td>';
			echo '</tr>';
			// echo '<tr>';
			// 	echo '<td>Nama</td>';
			// 	echo '<td> : '.$row->nama.'</td>';
			// echo '</tr>';
			echo '<tr>';
				echo '<td>Laboratorium</td>';
				echo '<td> : '.$row->id_lab.'</td>';
			echo '</tr>';
		echo '</table>';
		echo '<br />';
		echo 'Apakah anda yakin ingin nilai mahasiswa ini? <a href="delete.php?data=penempatan&nim='.$nim.'"><button class="btn btn-info">Ya</button></a> / <a href="daftar_penempatan.php"><button class="btn btn-info">Tidak</button></a>';
		$con->close();
?>
<?php
	include_once('footer.php');
?>