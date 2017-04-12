<?php		
	include_once('sidebar.php');
	$id=$_SESSION['sip_masuk_aja'];
?>
<script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<?php

		if ($status=="petugas") {
								$query = "SELECT * FROM nilai_outline INNER JOIN anggota ON nilai_outline.nim=anggota.nim ";
							}
							$result = $con->query( $query );
							if(!$result){
								die('Could not connect to database : <br/>'.$con->error);
							}
							// $i=1;
							$row = $result->fetch_object()
?>

<!-- /. ROW  -->
<div class="row" >
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div align='center' class="panel-heading">
			   FORM PENILAIAN SEMINAR OUTLINE
			</div>
			<div class="panel-body">
				<h5>Yang bertanda tangan di bawah ini menyatakan bahwa mahasiswa Departemen Kimia Fakultas Sains dan Matematika Universitas Diponegoro Semarang:</h5>
				<table>
					<tr>
						<td>Nama</td>
						<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
						<td>: </td>
						<td> &nbspNama Mahasiswa</td>
					</tr>
					<tr>
						<td>NIM</td>
						<td></td>
						<td>: </td>
						<td> &nbspNomor Induk Mahasiswa</td>
					</tr>
				</table>

					<h5>telah mempresentasikan rencana penelitian Tugas Riser pada seminar outline, dengan :</h5>
				<table>
					<tr>
						<td>Judul</td>
						<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
						<td>: </td>
						<td> &nbspJudul Mahasiswa</td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td></td>
						<td>: </td>
						<td> &nbspTanggal Mahasiswa</td>
					</tr>
				</table>
				<br>
				<h5>Penilaian [0 smapai dengan 100]</h5>
				<br>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>Komponen Penilaian</th>
								<th>Kriteria</th>
								<th>Bobot (B)</th>
								<th>Skor (S)</th>
								<th align="center">Nilai (B x S)</th>
							</tr>
						</thead>
						<tbody id="hasil_anggota">
							<tr>
								<td colspan="5">1. Substantif</td>
							</tr>
							<tr>
								<td>a. Outline (audiens)</td>
								<td>Rata-rata seminar</td>
								<td align="center">10%</td>
								<td align="center"></td>
								<td align="center"></td>
							</tr>
							<tr>
								<td>b. Progress Report (audiens)</td>
								<td>Rata-rata seminar</td>
								<td align="center">10%</td>
								<td align="center"></td>
								<td align="center"></td>
							</tr>
							<tr>
								<td>c. Laporan TR1 (pembimbing I/II)</td>
								<td>Kejelasan, Latar Belakang, Perumusan, Tujuan, Pendekatan, Format sebagaimana skripsi (Bab I,II,III, dan hasil (Hasil final atau sementara), pembahasan, kesimpulan serta rencana penelitian selanjutnya),Penggunaan bahasa ilmiah dan kemutahiran referensi</td>
								<td align="center">80%</td>
								<td align="center"></td>
								<td align="center"> </td>
							</tr>
							<tr>
								<td align='center' colspan="4">Rata-rata nilai</td>
								<td></td>
							</tr>
						</tbody>
					</table>
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<td>2. Kinerja TR1</td>
							<td>Ketercapaian indikator kinerja yang tertulis pada kontrak TR1</td>
							<td align='center' 	colspan="3"> <70% &nbsp&nbsp >=70% &nbsp&nbsp*)</td>
						</tr>
					</table>
					<table class="table table-striped table-bordered table-hover">
						<tr>
							<td colspan="5">Nilai Akhir (jika nilai komponen 2 >= 70%) :</td>
						</tr>
						<tr align="center">
							<td>A: 80 <= X <= 100</td>
							<td>B: 70 <= X < 80</td>
							<td>C: 60 <= X < 70</td>
							<td>D: 50 <= X < 60</td>
							<td>E: X < 50</td>
						</tr>
						<tr>
							<td colspan="5">Nilai Akhir (jika nilai komponen 2 < 70%) :</td>
						</tr>
						<tr align="center">
							<td>B: 80 <= X <= 100</td>
							<td>C: 70 <= X < 80</td>
							<td>D: 60 <= X < 70</td>
							<td>E: 50 <= X < 60</td>
						</tr>
					</table>
					<h5>Mahasiswa tersebut dinyatakan LULUS / TIDAK LULUS TR1 *) dengan nilai HURUF </h5>
				</div>
			</div>
		</div>
	</div> 
</div>
<?php 
	mysqli_close($con);
	include_once('footer.php');
?>