<!-- 
	Proses menampilkan data dari tabel peminjaman. Belum dikembalikan.
 -->

<?php

include 'connection.php';

$query = "SELECT anggota.nama, anggota.nim, buku.judul, peminjaman.tgl_pinjam, detail_transaksi.denda, detail_transaksi.idtransaksi FROM peminjaman
			INNER JOIN anggota ON peminjaman.nim = anggota.nim
			INNER JOIN detail_transaksi ON detail_transaksi.idtransaksi = peminjaman.idtransaksi 
			INNER JOIN buku ON detail_transaksi.idbuku = buku.idbuku";
$hasil = mysqli_query($db, $query);
mysqli_connect_error();
// ... menampung semua data kategori
$data_kembali = array();

// ... tiap baris dari hasil query dikumpulkan ke $data_buku
while ($row = mysqli_fetch_assoc($hasil)) {
    $data_kembali[] = $row;
}
// ... lanjut di tampilan
