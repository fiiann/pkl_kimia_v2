<?php
$nim = $_GET['nim'];
include_once('sidebar.php');
$id=$_SESSION['sip_masuk_aja'];
// Assign the query
$query = " SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim WHERE p.nim='".$nim."'";
// Execute the query
$result = $con->query($query);
$row = $result->fetch_object();

		echo '<table border="0">';
			echo '<tr>';
				echo '<td>NIM</td>';
				echo '<td> : '.$row->nim.'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Nama</td>';
				echo '<td> : '.$row->nama.'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Pilihan</td>';
				echo '<td> : '.$row->pilihan_lab1.'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Pilihan3</td>';
				echo '<td> : '.$row->pilihan_lab2.'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Pilihan3</td>';
				echo '<td> : '.$row->pilihan_lab3.'</td>';
			echo '</tr>';
		echo '</table>';
		echo '<br />';
		echo 'Apakah anda yakin ingin nilai mahasiswa ini? <a href="delete.php?data=pkt&nim='.$nim.'">YA</a> / <a href="daftar_pkt.php">TIDAK</a>';
		$con->close();
?>
<?php
	include_once('footer.php');
?>
