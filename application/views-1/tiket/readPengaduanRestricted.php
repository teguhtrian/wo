<center><h3><strong>Pesan Pengaduan <br> #<?php echo $pesan['noTiket'];?></strong></h3></center>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4><strong>Detail Pengiriman</strong></h4>
	</div>
	<div class="panel-body">
		<table class="table table-hover table-bordered table-striped table-condensed">
		<tr>
			<th colspan="2"><h4><strong>Sumber</strong></h4></th>
			<th colspan="2"><h4><strong>Tujuan</strong></h4></th>
		</tr>
		<tr>
			<th>Dari :</th>
				<td colspan="3"><?php echo $pesan['dari'];?></td>
		</tr>
		<tr>
			<th>Unit Asal :</th>
				<td><?php echo $pesan['unitAsal'];?></td>
			<th>Unit Tujuan :</th>
				<td><?php echo $pesan['unitTujuan'];?></td>
		</tr>
		<tr>
			<th>Departmen Asal :</th>
				<td><?php echo $pesan['departemenAsal'];?></td>
			<th>Departmen Tujuan :</th>
				<td><?php echo $pesan['departemenTujuan'];?></td>
		</tr>
		<tr>
			<th>Status :</th>
				<td><?php echo $pesan['keterangan']?></td>
		</tr>
		<tr>
			<th colspan="4">&nbsp;</th>
		</tr>
		<tr>
			<th>Waktu Buat :</th>
				<td><?php echo $pesan['waktuBuat']?></td>
			<th>Waktu Tutup :</th>
				<td><?php echo $pesan['waktuTutup']!='0000-00-00 00:00:00'? $pesan['waktuTutup']:'';?></td>
		</tr>
		<tr>
			<th>Respon Terakhir :</th>
				<td><?php echo $pesan['responAkhir']!='0000-00-00 00:00:00'? $pesan['responAkhir']:'';?></td>
			<th>Lama Respon :</th>
				<td><?php
					//hitung selisih waktu 
					if($pesan['waktuTutup']!='0000-00-00 00:00:00'){
						$time1=new DateTime($pesan['waktuBuat']);
						$time2=new DateTime($pesan['waktuTutup']);
						$interval=$time1->diff($time2);
						//print_r($interval);
						echo $interval->d.' hari, '.$interval->h.' jam '.$interval->i.' menit '.$interval->s.' detik';
					}else{
						echo '';
					}
				?></td>
		</tr>
		</table>
	</div>
	<div class="panel-heading">
		<h4><strong>Data Pelapor</strong></h4>
	</div>
	<div class="panel-body">
	<table class="table table-hover table-striped table-condensed">
	<tr>
		<th width="22%">Nama Pelapor :</th>
			<td><?php echo $pesan['namaPelapor'];?></td>
	</tr>
	<tr>
		<th>Nomor Telepon / Handphone :</th>
			<td><?php echo $pesan['noTelpon'];?></td>
	</tr>
	<tr>
		<th>NPA :</th>
			<td colspan="3"><?php echo $pesan['npa'];?></td>
	</tr>
	<tr>
		<th>Nama Pelanggan :</th>
			<td><?php echo $pesan['namaPelanggan'];?></td>
	</tr>
	<tr>
		<th>Alamat :</th>
			<td><?php echo $pesan['alamat'];?></td>
	</tr>
	</table>
	</div>
	<div class="panel-heading">
		<h4><strong>Detail Pengaduan</strong></h4>
	</div>
	<div class="panel-body">
		<table class="table table-hover table-striped">
			<tr>
				<th width="22%">Subjek :</th>
					<td><?php echo $pesan['subjek'];?></td>
			</tr>
			<tr>
				<th>Pesan :</th>
					<td><p><?php echo nl2br($pesan['detail']);?></p></td>			
			</tr>
		</table>
		<button class="btn btn-danger" onclick="history.go(-1)">Kembali</button>
	</div>
</div>