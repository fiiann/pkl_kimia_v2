<!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#page-top"><i class="fa fa-thumbs-o-up">SIP</i></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                     <li class="page-scroll">
                        <a href="<?php if(isset($_GET['isbn'])) echo 'index.php'; else echo '#home'?>">Home</a>
                    </li>
                    <li class="page-scroll">
                        <a href="<?php if(isset($_GET['isbn'])) echo 'index.php#koleksi'; else echo '#koleksi'?>">Koleksi</a>
                    </li>
                    <li class="page-scroll">
                        <a href="<?php if(isset($_GET['isbn'])) echo 'index.php#about'; else echo '#about'?>">About</a>
                    </li>
                    <li class="page-scroll <?php if(isset($_SESSION['sip_masuk_aja'])) echo 'signed' ?>">
                        <a href="dashboard">
						<?php 
							if(isset($_SESSION['sip_masuk_aja'])){
								if($status=='petugas')
									echo $petugas->nama;
								else
									echo $anggota->nama;
							}else
								echo 'LOGIN';
						?></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>