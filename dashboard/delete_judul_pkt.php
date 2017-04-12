<?php
$nim = $_GET['nim'];
include_once('sidebar.php');
if($status=="anggota"){
		header('Location:./index.php');
	}
// Assign the query
$query = " SELECT * FROM pkt WHERE nim='".$nim."'";
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
				echo '<td>Judul</td>';
				echo '<td> : '.$row->judul.'</td>';
			echo '</tr>';
		echo '</table>';
		echo '<br />';
		echo 'Apakah anda yakin ingin menghapus judul mahasiswa ini? <a href="delete.php?data=judul_pkt&nim='.$nim.'"><button class="btn btn-info">Ya</button></a> / <a href="daftar_judul.php"><button class="btn btn-info">Tidak</button></a>';
		$con->close();
?>
<?php
	include_once('footer.php');
?>