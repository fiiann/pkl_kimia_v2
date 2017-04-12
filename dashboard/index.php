<?php 
	include_once('sidebar.php'); 
	if($status=='petugas'){
			$pesanWelcome='"Mari berikan layanan yang SIP bagi setiap pengunjung"';
	}elseif($status=='dosen'){
			$pesanWelcome='Selamat datang Dosen Kimia';
	}else{
			$pesanWelcome='"Banyak baca buku biar makin SIP"';
	}

	$query1="SELECT count(nim) as counter FROM pkt";
	// $result1 = $con->query($query1);
	$row=$result1->fetch_object();
	$jml_pkt=$row->counter;

	$query="SELECT count(nim) as counter FROM tr1";
	$result = $con->query($query);
	// $row=$result->fetch_object();
	// $jml_tr1=$row->counter;

	$query="SELECT count(nim) as counter FROM mahasiswa";
	$result = $con->query($query);
	// $row=$result->fetch_object();
	// $jml_anggota=$row->counter;
	// $query="SELECT count(idtransaksi) as counter FROM detail_transaksi WHERE tgl_kembali='0000-00-00'";
?>
<div class="row">
    <div class="col-md-12">
        <h2>Dashboard</h2>   
        <h5>Selamat datang <b><?php if($status=="petugas") echo $petugas->nama; elseif($status=="dosen") echo $dosen->nama_dosen;elseif($status=="lab") echo $lab->nama_lab; else echo $anggota->nama; ?></b>. <small><i><?php echo $pesanWelcome ?></i></small></h5>
    </div>
</div><hr />
 <div class="row">
					<div class="col-md-3 col-sm-6 col-xs-6">           
						<div class="panel panel-back noti-box">
							<span class="icon-box bg-color-green set-icon">
								<i class="fa fa-book"></i>
							</span>
							<div class="text-box" >
								<div class="main-text"><?php echo $jml_pkt ?></div>
								<div class="text-muted">Mahasiswa PKT</div>
							</div>
						</div>
					</div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
						<div class="panel panel-back noti-box">
							<span class="icon-box bg-color-blue set-icon">
								<i class="fa fa-book"></i>
							</span>
							<div class="text-box" >

								<div class="main-text"><?php if(($status=='anggota')||($status=='lab')) echo $jml_tr1;else echo $jml_tr1; ?></div>
								<div class="text-muted"><?php if($status=='anggota') echo 'Pernah dipinjam'; else echo 'Mahasiswa TR1'; ?></div>
							</div>
						 </div>
					</div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
						<div class="panel panel-back noti-box">
							<span class="icon-box bg-color-red set-icon">
								<?php if($status=='anggota') echo '<i class="fa fa-book"></i>'; else echo '<i class="fa fa-users"></i>'; ?>
							</span>
							<div class="text-box" >
								<div class="main-text"><?php if($status=='anggota') echo $belum_kembali; else echo $jml_anggota; ?></div>
								<div class="text-muted"><?php if($status=='anggota') echo 'Belum kembali'; elseif ($status=='dosen') echo 'apa ini'; else echo 'Anggota'; ?></div>
							</div>
						 </div>
					</div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
						<div class="panel panel-back noti-box">
							<span class="icon-box bg-color-brown set-icon">
								<i class="fa fa-money"></i>
							</span>
							<div class="text-box" >
								<div class="main-text"> <?php echo $jml_denda ?></div>
								<div class="text-muted">TR2<?php if($status=='anggota') echo 'Total Denda Anda'; else echo ' Mahasiswa '; ?></div>
							</div>
						 </div>
					</div>
				</div>

				<hr />                
                 <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
						<div class="panel panel-default">
							<div class="panel-heading">
							   Kategori Topik
							</div>
							<div class="panel-body">
								<a href='daftar_buku.php?search=Uncategories'><span class='label label-warning'>Uncategories</span></a>&nbsp;
								<?php
									// Assign a query
									$query = "SELECT * FROM dosen";
									// Execute the query
									$result = $con->query( $query );
									if(!$result){
										die('Could not connect to database : <br/>'.$con->error);
									}
									while($row = $result->fetch_object()){
										echo "<a href='daftar_buku.php?search=".$row->nama."'><span class='label label-success'>".$row->nama."</span></a> ";
									}		
								?>
							</div>
						</div>
                    </div>
                </div>     