<?php
$id = $_GET['id'];
include_once('sidebar.php');
if($status=="anggota"){
		header('Location:./index.php');
	}
// Assign the query
$query = " SELECT * FROM petugas WHERE idpetugas='".$id."'";
// Execute the query
$result = $con->query($query);
$row = $result->fetch_object();

		echo '<table border="0">';
			echo '<tr>';
				echo '<td>Nama</td>';
				echo '<td> : '.$row->nama.'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Email</td>';
				echo '<td> : '.$row->email.'</td>';
			echo '</tr>';
		echo '</table>';
		echo '<br />';
		echo 'Apakah anda yakin ingin menghapus data buku ini? <a href="del.php?data=petugas&id='.$id.'">YA</a> / <a href="daftar_petugas.php">TIDAK</a>';
		$con->close();
?>
<?php
	include_once('footer.php');
?>