<?php
$nim = $_GET['nim'];
include_once('sidebar.php');
if($status=="anggota"){
		header('Location:./index.php');
	}
// Assign the query
$query = " SELECT * FROM nilai_pkt WHERE nim='".$nim."'";
// Execute the query
$result = $con->query($query);
$row = $result->fetch_object();

		echo '<table border="0">';
			echo '<tr>';
				echo '<td>NIM</td>';
				echo '<td> : '.$row->nim.'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Nilai</td>';
				echo '<td> : '.$row->nilai_pkt.'</td>';
			echo '</tr>';
		echo '</table>';
		echo '<br />';
		echo "Apakah anda yakin ingin nilai mahasiswa ini?";
		echo '<a href="delete.php?data=nilai_pkt&nim='.$nim.'"><button class="btn btn-info">YA</button></a>&nbsp;&nbsp;<a href="nilai_pkt.php"><button class="btn btn-info">TIDAK</button></a>';
		// echo 'Apakah anda yakin ingin nilai mahasiswa ini? <a href="delete.php?data=anggota&nim='.$nim.'">YA</a> / <a href="nilai_pkt.php">TIDAK</a>';
		$con->close();
?>
<?php
	include_once('footer.php');
?>