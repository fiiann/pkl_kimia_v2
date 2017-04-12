<?php		
	include_once('sidebar.php');
	if($status=="anggota"){
		header('Location:./index.php');
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
				url:"ajax_func/list_petugas.php?page="+page,
				type:"GET",
				dataType:"html",
				
				beforeSend: function(){
					$("#hasil").html('<img src="assets/img/loader.gif" height="20px"/>');
				},
				success: function(data){
					$("#hasil").html(data);
				},
				error: function(){
					$("#hasil").html("The page can't be loaded");
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
				<?php
					$query = "SELECT count(idpetugas) as jml_data FROM petugas";
					// Execute the query
					$result = $con->query( $query );
					$row = $result->fetch_object();
					$jml_data=$row->jml_data;
					$total_page=ceil($jml_data/10);
					echo "<select class='form-control' id='page'>";
					for($i=1;$i<=$total_page;$i++){
						echo "<option value='".$i."'>".$i."</option>";
					}
					echo "</select>";
				?>
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
			   Daftar Petugas
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="hasil">
						<?php
						// Assign a query
							$query = "SELECT * FROM petugas ORDER BY nama LIMIT 10";
							// Execute the query
							$result = $con->query( $query );
							if(!$result){
								die('Could not connect to database : <br/>'.$con->error);
							}
							$i=1;
							while($row = $result->fetch_object()){
								echo "<tr>";
								echo "<td>".$i."</td>";$i++;
								echo "<td>".$row->nama."</td>";
								echo "<td>".$row->email."</td>";
								echo "<td>
										<a href='edit_petugas.php?id=".$row->idpetugas."'><i class='fa fa-edit'></i></a>&nbsp;
										<a href='delete_petugas.php?id=".$row->idpetugas."'><i class='fa fa-trash-o'></i></a>&nbsp;
										<a href='repass.php?data=petugas&id=".$row->idpetugas."'><i class='fa fa-lock'></i></a>
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