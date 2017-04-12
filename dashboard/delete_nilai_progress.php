<?php
$nim = $_GET['nim'];
include_once('sidebar.php');
if($status=="anggota"){
		header('Location:./index.php');
	}
// Assign the query
$query = " SELECT * FROM nilai_progress WHERE nim='".$nim."'";
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
				echo '<td> : '.$row->jumlah_total.'</td>';
			echo '</tr>';
		echo '</table>';
		echo '<br />';
		echo "Apakah anda yakin ingin nilai mahasiswa ini?";
		echo '<a href="delete.php?data=nilai_progress&nim='.$nim.'"><button class="btn btn-info">YA</button></a>&nbsp;&nbsp;<a href="daftar_nilai_progress.php"><button class="btn btn-info">TIDAK</button></a>';
		
		$con->close();
?>
<?php
	include_once('footer.php');
?>