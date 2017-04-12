<?php
    require_once('sidebar.php');
	if($status=="anggota"){
		header('Location:./index.php');
	}
    if($con->connect_errno){
        die("Couldnt connect to the  database: </br>". $con->connect_errno);
    }
    
        $tgl_kembali = $_POST['tgl_kembali'];
        $selisih = $_POST['denda'];
        $pinjam_id = $_POST['idtransaksi'];
        $idbuku = $_POST['idbuku'];
        
		$con->autocommit(false);
		$flag = true;

		// Assign the query
		$query = "UPDATE detail_transaksi SET tgl_kembali='".$tgl_kembali."', denda=$selisih WHERE idtransaksi=$pinjam_id AND idbuku=$idbuku";
        $query2 = "UPDATE buku SET stok_tersedia = stok_tersedia + 1 WHERE idbuku = $idbuku";
        
		$pesan="";
		$result1 = $con->query($query);
		if (!$result1) {
			$flag = false;
			$pesan. = "Proses 1 gagal. ";
		}
		$result2 = $con->query($query2);
		if (!$result2) {
			$flag = false;
			$pesan.= "Proses 2 gagal. ";
		}

		if ($flag) {
			$con->commit();
			$pesan.= "Buku berhasil dikembalikan. <br/>";
			$pesan.= '<a href="pengembalian_tampil.php">Kembali ke halaman pengembalian</a>';
		} else {
			$con->rollback();
			$pesan.= "Proses pengembalian dibatalkan.<br/>";
			$pesan.= '<a href="pengembalian_tampil.php">Kembali ke halaman pengembalian</a>';
		}
		
	echo $pesan;
	
    $con->close();
	include_once('footer.php');
?>