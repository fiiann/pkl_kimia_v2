<?php		
	include_once('connect.php');
	include_once('functions.php');
	$id=$_SESSION['sip_masuk_aja'];
?>
<script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<!-- <script>
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
				url:"ajax_func/search_daftar_pkt.php?search="+search,
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
				url:"ajax_func/search_daftar_pkt.php?search="+search,
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
				url:"ajax_func/ajax_func.php?pkt=pkt&search="+search,
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
				window.history.pushState("object or string", "Daftar PKT : "+search, "daftar_pkt.php");				
			}else{
				window.history.pushState("object or string", "Daftar PLT : "+search, "daftar_pkt.php?search="+search);	
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
				url:"ajax_func/search_daftar_pkt.php?search="+search+"&page="+page,
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
</script> -->
<!DOCTYPE html>
<html>
<head>
	<title>Laporan</title>
	 <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body onload="window.print()">
<!-- 	<div class="row"  >
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-md-9 col-sm-12 col-xs-12">
					Search : <input class="form-control" type="text" name="search" placeholder="Masukkan nama, nim," id="search" autofocus value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>"/>
				</div>
				<div class="col-md-2 col-sm-12 col-xs-12">
					Page :
				<select class='form-control' id='page'>
				<?php
					$query = "SELECT count(nim) as jml_data FROM daftar_pkt";
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
</div> -->
<!-- /. ROW  -->
<div class="row" >
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
			   Daftar Mahasiswa yang mendaftar PKT
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead align="center">
							<tr align="center">
								<th rowspan="2">No</th>
								<th rowspan="2">Nama</th>
								<th rowspan="2">NIM</th>
								<!-- <th>Wali</th>
								<th>Angkatan</th> -->
								<th colspan="3" align="center">Laboratorium</th>
								<th rowspan="2">Ttd</th>
							</tr>
							<tr>
								<!-- <th>Wali</th>
								<th>Angkatan</th> -->
								<th>Pilihan 1</th>
								<th>Pilihan 2</th>
								<th>Pilihan 3</th>
							</tr>
						</thead>
						<tbody id="hasil_cari">
						<?php
							// Assign a query
							$query = "SELECT * FROM daftar_pkt INNER JOIN anggota ON daftar_pkt.nim=anggota.nim ORDER BY nama LIMIT 10";
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
								echo "<td>".$row->nim."</td>";
								// echo "<td>".$row->nama_wali."</td>";
								// echo "<td>".$row->angkatan."</td>";
								echo "<td>".$row->pilihan1."</td>";
								echo "<td>".$row->pilihan2."</td>";
								echo "<td>".$row->pilihan3."</td>";
							
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

</body>
</html>
<?php 
	mysqli_close($con);
	include_once('footer.php');
?>