<?php
$nim = $_GET['nim'];
include_once('sidebar.php');
if($status=="anggota"){
		header('Location:./index.php');
	}
// Assign the query
$query = " SELECT * FROM anggota WHERE nim='".$nim."'";
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
				echo '<td>Email</td>';
				echo '<td> : '.$row->email.'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Alamat</td>';
				echo '<td> : '.$row->alamat.'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Kota</td>';
				echo '<td> : '.$row->kota.'</td>';
			echo '</tr>';
		echo '</table>';
		echo '<br />';
		echo 'Apakah anda yakin ingin menghapus data buku ini? <a href="del.php?data=anggota&nim='.$row->nim.'">YA</a> / <a href="daftar_anggota.php">TIDAK</a>';
		$con->close();
?>
<?php
	include_once('footer.php');
?>