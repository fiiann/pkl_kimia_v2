<?php
	require_once('functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <title>Perpustakaan Kita</title>
<link rel="stylesheet" type="text/css" href="assets/css/table.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="assets/css/main.css" type="text/css">
    <link rel="stylesheet" href="assets/extras/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/extras/owl.theme.css" type="text/css">    
    <!-- Responsive CSS Styles -->
    <link rel="stylesheet" href="assets/css/responsive.css" type="text/css">
    <!-- Bootstrap Select -->
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Theme CSS -->
    <link href="assets/css/freelancer.min.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script>
    $(document).ready(function(){
		$("#pengarang").change(function(){
            var search = $("#search").val();
            var pengarang = $("#pengarang").val();
      
            $.ajax({
                url: "search.php?search="+search+"&pengarang="+pengarang,
                type: "GET",
                dataType: 'html',
                beforeSend: function(){
                    $("#hasil_cari").html('<img src="images/ajax_loader.png"/>');
                },
                success: function(data){
                    $("#hasil_cari").html(data);
                },
                error: function(){
                    $("#hasil_cari").html("The page can't be loaded");
                }   
            });
        });
		$("#search").change(function(){
            var search = $("#search").val();
            var pengarang = $("#pengarang").val();
      
            $.ajax({
                url: "search.php?search="+search+"&pengarang="+pengarang,
                type: "GET",
                dataType: 'html',
                beforeSend: function(){
                    $("#hasil_cari").html('<img src="images/ajax_loader.png"/>');
                },
                success: function(data){
                    $("#hasil_cari").html(data);
                },
                error: function(){
                    $("#hasil_cari").html("The page can't be loaded");
                }   
            });
        });
        $("#submit").click(function(){
            var search = $("#search").val();
            var pengarang = $("#pengarang").val();
      
            $.ajax({
                url: "search.php?search="+search+"&pengarang="+pengarang,
                type: "GET",
                dataType: 'html',
                beforeSend: function(){
                    $("#hasil_cari").html('<img src="images/ajax_loader.png"/>');
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
</head>

<body id="page-top" class="index">

    <?php
		include_once('header.php');
	?>

    <!-- Header -->
    <header id='home'>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <i class="fa fa-thumbs-o-up fa-5x"></i>
                    <div class="intro-text">
						<span class="name">Sistem Perpustakaan</span>
						<span class="name">Punya Kita</span>
						<hr class="star-light">

                        <div class="col-md-4 col-sm-6 search-col">
							<div class="form-group is-empty">
							<select id="pengarang" name="pengarang" class="form-control keyword">
								<option value="all">Semua Pengarang</option>
								<?php
									$query = "SELECT pengarang FROM buku GROUP BY pengarang";
									$result = $con->query($query);
									if ($result){
										while ($row = $result->fetch_object()){
											echo '<option value="'.$row->pengarang.'">'.$row->pengarang.'</option>';
										}
									}
								?>
							</select>
							<span class="material-input"></span>
							</div>
						</div>
						<div class="col-md-5 col-sm-6 search-col">
							<div class="form-group is-empty">
							<input id="search" name="search" class="form-control keyword" placeholder="Enter Keyword" type="text"><span class="material-input"></span></div>
						</div>
						<div class="col-md-3 col-sm-6 search-col">
							<a class="page-scroll" href="#koleksi"><button id="submit" class="btn btn-common btn-search btn-block"><strong>Search</strong></button></a>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <div id="koleksi" class="wrapper">
      <!-- Featured Listings Start -->
      <section class="featured-lis" >
        <div class="container">
          <div class="row">
            <div id="hasil_cari" class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
                <div class="row">
					<div class="col-lg-12 text-center">
						<h2>Buku Terbaru</h2>
						<hr class="star-light">
					</div>
				</div>
              <?php include 'list_buku.php' ?>
            </div> 
          </div>
        </div>
      </section>
      <!-- Featured Listings End -->
    </div>

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row" align="justify">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>Sistem Informasi Perpustakaan adalah sistem yang dibuat untuk memudahkan petugas perpustakaan dalam mengelola suatu perpustakaan. Semua di proses secara komputerisasi yaitu digunakannya suatu software tertentu seperti software pengolah database. Petugas perpustakaan dapat selalu memonitor tentang ketersediaan buku,</p>
                </div>
                <div class="col-lg-4" >
                    <p> daftar buku baru, peminjaman buku dan pengembalian buku. Dengan sistem ini, peminjam buku maupun yang mengembalikan buku tidak perlu menunggu lama untuk proses peminjaman/pengembalian buku. Petugas perpustakaan pun tifdak akan mengalami kesulitan dalam proses pelaporan kepada kepala perpustakaan</p>
                </div>
                <!-- <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="#" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Download Theme
                    </a>
                </div> -->
            </div>
        </div>
    </section>

   

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Location</h3>
                        <p>Dekanat FSM
                            <br>UNDIP</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Around the Web</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-github"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>About SIP</h3>
                        <p>script is create with Bootstrap theme <a href="http://startbootstrap.com">Start Bootstrap</a> and Modified by <a href="#">SIP Team</a>.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; SIP
                    </div>
                </div>
            </div>
        </div>
    </footer>

   
    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="assets/js/jquery.easing.min.js"></script>
    <!-- Theme JavaScript -->
    <script src="assets/js/freelancer.min.js"></script>
    <script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="assets/js/wow.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>
