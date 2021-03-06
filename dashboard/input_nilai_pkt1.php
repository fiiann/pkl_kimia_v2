<?php
	include_once('sidebar.php');
	if($status=="anggota"){
		header('Location:./index.php');
	}
	$id=$_SESSION['sip_masuk_aja'];
?>
<script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script>
	function getQueryVariable(variable)
	{
		   var query = window.location.search.substring(1);
		   var vars = query.split("&");
		   for (var i=0;i<vars.length;i++) {
				   var pair = vars[i].split("=");
				   if(pair[0] == variable){return pair[1];}
		   }
		   return(false);
	}
	$(document).ready(function(){
		if(getQueryVariable("search")!=""){
			var search= getQueryVariable("search");
			$.ajax({
				url:"ajax_func/search_penempatan.php?search="+search,
				type:"GET",
				dataType:"html",

				beforeSend: function(){
					$("#hasil_cari").html('<img src="assets/img/loader.gif" height="20px"/>');

				},
				success: function(data){
					$("#hasil_cari").html(data);
				},
				error: function(){
					$("#hasil_cari").html("The page can't be loaded");
				}
			});
		}
		$('#search').keyup(function(){
			if($("#search").val()==undefined){
				var search="";
			}else{
				var search= $("#search").val();
			}
			$.ajax({
				url:"ajax_func/search_penempatan.php?search="+search,
				type:"GET",
				dataType:"html",

				beforeSend: function(){
					$("#hasil_cari").html('<img src="assets/img/loader.gif" height="20px"/>');
				},
				success: function(data){
					$("#hasil_cari").html(data);
				},
				error: function(){
					$("#hasil_cari").html("The page can't be loaded");
				}
			});
			$.ajax({
				url:"ajax_func/ajax_func.php?=penempatan&penempatan="+search,
				type:"GET",
				dataType:"html",

				beforeSend: function(){
					$("#page").html('<img src="assets/img/loader.gif" height="20px"/>');
				},
				success: function(data){
					$("#page").html(data);
				},
				error: function(){
					$("#page").html("The page can't be loaded");
				}
			});
			if(search==''){
				window.history.pushState("object or string", "Daftar Penempatan : "+search, "daftar_penempatan.php");
			}else{
				window.history.pushState("object or string", "Daftar Penempatan : "+search, "daftar_penempatan.php?search="+search);
			}
		});
		$('#page').change(function(){
			if($("#page").val()==undefined){
				var page="";
			}else{
				var page= $("#page").val();
			}
			if($("#search").val()==undefined){
				var search="";
			}else{
				var search= $("#search").val();
			}
			$.ajax({
				url:"ajax_func/search_penempatan.php?search="+search+"&page="+page,
				type:"GET",
				dataType:"html",

				beforeSend: function(){
					$("#hasil_cari").html('<img src="assets/img/loader.gif" height="20px"/>');
				},
				success: function(data){
					$("#hasil_cari").html(data);
				},
				error: function(){
					$("#hasil_cari").html("The page can't be loaded");
				}
			});
		});
	});
</script>
<div class="row" >
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-md-9 col-sm-12 col-xs-12">
					Search : <input class="form-control" type="text" name="search" placeholder="Masukkan nama, nim," id="search" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>"/>
				</div>
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
			   Penempatan Laboratorium
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<!-- <?php echo "$dosen->nip"; ?> -->
								<th>No</th>
								<th>NIM</th>
								<th>Nama</th>
								<th>Laboratorium</th>
								<th>Input Nilai</th>
								<?php
									if ($status=="petugas") {
										echo "<th>Action</th>";
									}
							    ?>
							</tr>
						</thead>
						<tbody id="hasil_cari">
						<?php
							// Assign a query
							if($status=="petugas"){
								$query = "SELECT * FROM pkt INNER JOIN mahasiswa ON pkt.nim=mahasiswa.nim ORDER BY mahasiswa.nama LIMIT 10";
							}elseif ($status=="dosen") {
								$query = "SELECT * FROM pkt INNER JOIN mahasiswa ON pkt.nim=mahasiswa.nim  WHERE pkt.nip='".$dosen->nip."' LIMIT 10";
							}
							// $query = "SELECT * FROM pkt INNER JOIN mahasiswa ON pkt.nim=mahasiswa.nim ORDER BY mahasiswa.nama LIMIT 10";
							// Execute the query
							$result = $con->query( $query );
							if(!$result){
								die('Could not connect to database : <br/>'.$con->error);
							}
							$i=1;
							while($row = $result->fetch_object()){
								echo "<tr>";
								echo "<td>".$i."</td>";$i++;
								echo "<td>".$row->nim."</td>";
								echo "<td>".$row->nama."</td>";
								echo "<td>".$row->flag_lab."</td>";
								echo "<td>
										<a href='input_nilai_pkt.php?nim=".$row->nim."'><button class='btn btn-info'>Input Nilai</button></a>
									 </td>";
								if ($status=="petugas") {
								echo "<td align='center'>
										<a href='edit_lab.php?nim=".$row->nim."'><i class='fa fa-edit'></i></a>&nbsp;
										<a href='delete_penempatan.php?nim=".$row->nim."'><i class='fa fa-trash-o'></i></a>&nbsp;
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

<?php
	mysqli_close($con);
	include_once('footer.php');
?>
