<?php
	require_once('functions.php');
	if(isset($_GET['search']) && isset($_GET['pengarang'])){
		$search=$_GET['search'];
		if($_GET['pengarang']!='all'){
			$pengarang=$_GET['pengarang'];
		}else{
			$pengarang='';
		}
	}
?>
<div class="row">
	<div class="col-lg-12 text-center">
		<h2>Hasil Pencarian</h2>
		<hr class="star-light">
	</div>
	<table border='1' class="table-fill">
		<thead>
			<tr>
				<!-- <th class="text-center">ID_BUKU</th>
				<th class="text-center">ISBN</th> -->
				<th class="text-center">Judul</th>
				<!-- <th class="text-center">Kategori</th> -->
				<th class="text-center">Pengarang</th>
				<!-- <th class="text-center">Penerbit</th>
				<th class="text-center">Kota Terbit</th> -->
				<!-- <th class="text-center">Editor</th> -->
				<th class="text-center">Gambar</th>
			<!-- 	<th class="text-center">Tanggal Update</th>
				<th class="text-center">Stok</th> -->
				<th class="text-center">Stok Tersedia</th>
				</tr>
		</thead>
	<tbody class="table-hover">

<?php
	
if($pengarang!=''){
	$query = "SELECT * FROM buku WHERE pengarang like '%$pengarang%' AND judul like '%$search%'";
}else{
	$query = "SELECT * FROM buku where judul like '%$search%' OR isbn like '%$search%' OR pengarang like '%$search%' OR penerbit like '%$search%' OR tgl_update like '%$search%'";
}
$result = $con->query($query);
while ($row = $result->fetch_object()){
	echo '<tr>';
	// echo '<td class="text-center"><center>'.$row->idbuku.'</center></td>';
	// echo '<td class="text-center">'.$row->isbn.'</td>';
	echo '<td class="text-center">'.$row->judul.'</td>';
	// echo '<td class="text-center">'.$row->idkategori.'</td>';
	 echo '<td class="text-center">'.$row->pengarang.'</td>';
	//echo '<td class="text-center">'.$row->penerbit.'</td>';
	//echo '<td class="text-center">'.$row->kota_terbit.'</td>';
	//echo '<td class="text-center">'.$row->editor.'</td>';
	echo "<td class='text-center'><a href='buku.php?isbn=".$row->isbn."'><img src='dashboard/assets/img/".$row->file_gambar."' height='150px;' /></a></td>";
	//echo '<td class="text-center">'.$row->tgl_update.'</td>';
	//echo '<td class="text-center">'.$row->stok.'</td>';
	echo '<td class="text-center">'.$row->stok_tersedia.'</td>';
	echo '</tr>';
}
echo '</tbody>';
echo '</table>';
echo "<br>";
echo "<h3><center>Hasil pencarian : ".$result->num_rows." Buku</center></h3>";
?>
</div>

