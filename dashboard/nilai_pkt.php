<?php
	include_once('sidebar.php');
	$id=$_SESSION['sip_masuk_aja'];
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
					$query = "SELECT count(nim) as jml_data FROM pkt";
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
			   Nilai PKT
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th rowspan="2">No</th>
								<th rowspan="2">NIM</th>
								<th rowspan="2">Nama</th>
								<th colspan="5">Nilai</th>
								<?php if ($status=="petugas"||$status=="dosen") {
									echo "<th rowspan='2'>Action</th>";
								} ?>

							</tr>
							<tr>
								<th>Praktikum (60%)</th>
								<th>Laporan (30%)</th>
								<th>Presentasi (10%)</th>
								<th>Akhir (100%)</th>
								<th>Huruf</th>
							</tr>
						</thead>
						<tbody id="hasil_anggota">
						<?php
							// Assign a query
							if ($status=="petugas") {
								$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim ORDER BY nama LIMIT 10";
							}elseif ($status=="dosen"){
								$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim  WHERE p.nip='".$dosen->nip."'";
							}elseif ($status=="lab"){
								$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim INNER JOIN lab  l ON p.flag_lab=l.nama_lab WHERE p.flag_lab='".$lab->nama_lab."'";
							}else{
								$query = "SELECT * FROM pkt p INNER JOIN mahasiswa m ON p.nim=m.nim WHERE p.nim='".$anggota->nim."'";
							}

							// Execute the query
							$result = $con->query( $query );
							if(!$result){
								die('Could not connect to database : <br/>'.$con->error);
							}
							$i=1;
							// $row=$result->fetch_object();
							// $nilai_akhir=$row->nilai_praktikum;
							while($row = $result->fetch_object()){
								echo "<tr>";
								echo "<td>".$i."</td>";$i++;
								echo "<td>".$row->nim."</td>";
								echo "<td>".$row->nama."</td>";
								echo "<td align='center'>".$row->nilai_praktikum."</td>";
								echo "<td align='center'>".$row->nilai_laporan."</td>";
								echo "<td align='center'>".$row->nilai_presentasi."</td>";
								echo "<td align='center'>".$row->nilai."</td>";
								echo "<td align='center'>".$row->nilai_huruf."</td>";
								if ($status=="petugas"||$status=="dosen"){
									echo "<td align='center'>
											<a href='edit_nilaipkt.php?nim=".$row->nim."'><i class='fa fa-edit'></i></a>&nbsp;</td>";
								}

								echo "</tr>";
								// <a href='delete_nilaipkt.php?nim=".$row->nim."'><i class='fa fa-trash-o'></i></a>&nbsp;
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
