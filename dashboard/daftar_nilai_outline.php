<?php
	include_once('sidebar.php');
	// if($status=="anggota"){
	// 	header('Location:./index.php');
	// }
	$id=$_SESSION['sip_masuk_aja'];
	if($con->connect_errno){
		die("Could not connect to the database: <br />".$con->connect_error);
	}
?>
<script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		$('#page').change(function(){
			if($("#page").val()==undefined){
				var page="";
			}else{
				var page= $("#page").val();
			}
			$.ajax({
				url:"ajax_func/list_anggota.php?page="+page,
				type:"GET",
				dataType:"html",

				beforeSend: function(){
					$("#hasil_anggota").html('<img src="assets/img/loader.gif" height="20px"/>');
				},
				success: function(data){
					$("#hasil_anggota").html(data);
				},
				error: function(){
					$("#hasil_anggota").html("The page can't be loaded");
				}
			});
		});
	});
</script>
<div class="row" >
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-md-2 col-sm-12 col-xs-12">
					Page :
				<select class='form-control' id='page'>
				<?php
					$query = "SELECT count(nim) as jml_data FROM outline";
					// Execute the query
					$result = $con->query( $query );
					$row = $result->fetch_object();
					$jml_data=$row->jml_data;
					$total_page=ceil($jml_data/10);
					for($i=1;$i<=$total_page;$i++){
						echo "<option value='".$i."'>".$i."</option>";
					}
				?>
				</select>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /. ROW  -->
<div class="row" >
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php
					if ($status=="petugas") {
						echo "Daftar Nilai Outline";
					}else {
						echo "Nilai Outline";
					}
				 ?>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>NIM</th>
								<th>Nama</th>
								<th>Nilai Akhir</th>
								<?php
									if (($status=="petugas")|| ($status=="dosen")) {
										echo "<th>Action</th>";
									}
								?>
							</tr>
						</thead>
						<tbody id="hasil_anggota">
						<?php
							// Assign a query
							if ($status=="petugas") {
								$query = "SELECT * FROM outline o INNER JOIN mahasiswa m ON o.nim=m.nim ORDER BY nama LIMIT 10";
							}elseif ($status=="anggota"){
								$query = "SELECT * FROM outline o INNER JOIN mahasiswa m ON o.nim=m.nim WHERE outline.nim='".$anggota->nim."'";
							}elseif ($status=="dosen"){
								$query = "SELECT * FROM outline o INNER JOIN mahasiswa m ON o.nim=m.nim INNER JOIN dosen ON m.id_dosen=dosen.nip WHERE m.id_dosen='".$dosen->nip."'";
							}elseif ($status=="lab"){
								$query = "SELECT * FROM outline o INNER JOIN mahasiswa m ON o.nim=m.nim INNER JOIN tr1 ON m.nim=tr1.nim INNER JOIN lab ON tr1.idlab=lab.nama_lab WHERE m.id_dosen='".$dosen->nip."'";
							}

							// Execute the query
							$result = $con->query( $query );
							if(!$result){
								die('Could not connect to database : <br/>'.$con->error);
							}
							$i=1;
							while($row = $result->fetch_object()){
								echo "<tr align='center'>";
								echo "<td>".$i."</td>";$i++;
								echo "<td>".$row->nim."</td>";
								echo "<td>".$row->nama."</td>";
								echo "<td>".$row->nilai_total."</td>";
								if (($status=="petugas")|| ($status=="dosen")) {
									echo "<td align='center'>
										<a href='edit_nilai_outline.php?nim=".$row->nim."'><i class='fa fa-edit'></i></a>&nbsp;
										<a href='delete_nilai_outline.php?nim=".$row->nim."'><i class='fa fa-trash-o'></i></a>&nbsp;
									 </td>";
								}
								echo "</tr>";
							}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	mysqli_close($con);
	include_once('footer.php');
?>
