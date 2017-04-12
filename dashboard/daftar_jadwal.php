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
				<select class='form-control' ja='page'>
				<?php
					$query = "SELECT count(agenda) as jml_data FROM jadwal";
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
			   Daftar Agenda
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<!-- <th>No</th> -->
								<th>Kategori</th>
								<th>Agenda</th>
								<th>Waktu</th>
								<th>Keterangan</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="hasil_anggota">
						<?php
							// Assign a query
						
							$query = "SELECT * FROM jadwal ORDER BY agenda LIMIT 10";
							// Execute the query
							$result = $con->query( $query );
							if(!$result){
								die('Could not connect to database : <br/>'.$con->error);
							}
							$i=1;
							while($row = $result->fetch_object()){
								echo "<tr>";
								echo "<td>".$i."</td>";$i++;
								//echo "<td>".$row->id_jadwal."</td>";//$no++;
								echo "<td>".$row->kategori."</td>";
								echo "<td>".$row->agenda."</td>";
								echo "<td>".$row->waktu."</td>";								
								echo "<td>".$row->keterangan."</td>";
								echo "<td>
										<a href='edit_agenda.php?id_jadwal=".$row->id_jadwal."'><i class='fa fa-edit'></i></a>&nbsp;
										<a href='delete_anggota.php?nim=".$row->nim."'><i class='fa fa-trash-o'></i></a>&nbsp;
										<a href='repass.php?data=anggota&nim=".$row->nim."'><i class='fa fa-lock'></i></a>
									 </td>";
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