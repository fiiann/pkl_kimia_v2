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
					$query = "SELECT count(nim) as jml_data FROM daftar_tr1";
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
			   Nilai TR1
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>NIM</th>
								<th>Nama</th>
								<th>NILAI</th>
								<?php if(($status=="petugas")||($status=="dosen")){
									echo "<th>Action</th>";
								}
								?>
								
							</tr>
						</thead>
						<tbody id="hasil_anggota">
						<?php
							// Assign a query
							if ($status=="petugas") {
								$query = "SELECT * FROM daftar_tr1 INNER JOIN anggota ON daftar_tr1.nim=anggota.nim ORDER BY nama LIMIT 10";	
							}elseif ($status=="anggota") {
								$query = "SELECT * FROM daftar_tr1 INNER JOIN anggota ON daftar_tr1.nim=anggota.nim WHERE daftar_tr1.nim='".$anggota->nim."'";
							}elseif ($status=="dosen") {
								$query = "SELECT * FROM daftar_tr1 INNER JOIN anggota ON daftar_tr1.nim=anggota.nim INNER JOIN dosen ON anggota.id_wali=dosen.id_wali WHERE anggota.id_wali='".$dosen->id_wali."'";
							}else {
								$query = "SELECT * FROM daftar_tr1 INNER JOIN anggota ON daftar_tr1.nim=anggota.nim INNER JOIN dosen ON anggota.id_wali=dosen.id_wali WHERE anggota.idlab='".$lab->idlab."'";
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
								echo "<td>".$row->nilai_akhir."</td>";
								if(($status=="petugas")||($status=="dosen")){
								echo "<td align='center'>
										<a href='edit_nilai_tr1.php?nim=".$row->nim."'><i class='fa fa-edit'></i></a>&nbsp;
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