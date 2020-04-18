<head>
<script type="text/javascript">
	$(function(){
	    $("#example").dataTable({
	    "responsive":true,
	    "ordering": false,
	    "info": false,
	    "searching":false,
	    "fixedColumns":true,
	    "lengthMenu":[3,5,10,"All"],
	    "columnDefs":[	
	    	{ "width": "1", "targets":0 },
	    	{ "width": "20%", "targets":1 },
	    	{ "width": "20%", "targets":2 },
	    	{ "width": "20%", "targets":3 },
	    	{ "width": "60%", "targets":4 }
	    ],
	    //"scrollY": "100px",
    	"scrollX": false,
        "language":{
          "sProcessing":   "Sedang memproses...",
          "sLengthMenu":   "Tampilkan _MENU_ entri",
          "sZeroRecords":  "Tidak ditemukan data yang sesuai",
          "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
          "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
          "sInfoPostFix":  "",
          "sSearch":       "Cari:",
          "sUrl":          "",
          "oPaginate": {
              "sFirst":    "Pertama",
              "sPrevious": "Sebelumnya",
              "sNext":     "Selanjutnya",
              "sLast":     "Terakhir"
          }
      	}});

	    $("#example2").dataTable({
	    "ordering": false,
	    "info": false,
	    "searching":false,
	    "fixedColumns":true,
	    "columnDefs":[	
	    	{ "width": "1%", "targets":0 },
	    	{ "width": "20%", "targets":1 },
	    	{ "width": "59%", "targets":2 },
	    	{ "width": "13%", "targets":3 },
	    	{ "width": "7%", "targets":4 }
	    ],
	    //"scrollY": "100px",
    	//"scrollX": false,
        "language":{
          "sProcessing":   "Sedang memproses...",
          "sLengthMenu":   "Tampilkan _MENU_ entri",
          "sZeroRecords":  "Tidak ditemukan data yang sesuai",
          "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
          "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
          "sInfoPostFix":  "",
          "sSearch":       "Cari:",
          "sUrl":          "",
          "oPaginate": {
              "sFirst":    "Pertama",
              "sPrevious": "Sebelumnya",
              "sNext":     "Selanjutnya",
              "sLast":     "Terakhir"
          }
      	}});

      	$("#example3").dataTable({
      	"responsive":true,
	    "ordering": false,
	    "info": false,
	    "searching":false,
	    "fixedColumns":true,
	    "lengthMenu":[3,5,10,"All"],
	    "columnDefs":[	
	    	{ "width": "1%", "targets":0 },
	    	{ "width": "20%", "targets":1 },
	    	{ "width": "30%", "targets":2 },
	    	{ "width": "25%", "targets":3 },
	    	{ "width": "10%", "targets":4 },
	    	{ "width": "14%", "targets":5 }
	    ],
	    //"scrollY": "100px",
    	"scrollX": false,
        "language":{
          "sProcessing":   "Sedang memproses...",
          "sLengthMenu":   "Tampilkan _MENU_ entri",
          "sZeroRecords":  "Tidak ditemukan data yang sesuai",
          "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
          "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
          "sInfoPostFix":  "",
          "sSearch":       "Cari:",
          "sUrl":          "",
          "oPaginate": {
              "sFirst":    "Pertama",
              "sPrevious": "Sebelumnya",
              "sNext":     "Selanjutnya",
              "sLast":     "Terakhir"
          }
      	}});
	});
</script>
</head>
<center><h3><strong>Order <br><?php echo $order['noTiket'];?></strong></h3></center>
<div class="panel panel-default">
<div class="panel-heading">
	<h4><strong>Detail Order</strong></h4>
</div>
<div class="panel-body">
	<table class="table table-hover table-bordered table-striped table-condensed" width="100%">
	<tr>
		<th>Dibuat Oleh:</th>
			<td><?php echo $order['nama'];?></td>
		<th>Dasar Perintah:</th>
			<td><a href="<?php echo $order['jenisInformasi']==1?base_url().'tiket/bacaInfoOnOrderById/'.$order['idLi']:base_url().'tiket/bacaPengaduanOnOrderById/'.$order['idLi']?>"><?php echo $order['noLi'];?></a></td>
	</tr>
	<tr>
		<th>Unit Asal:</th>
			<td><?php echo $order['unitAsal']?></td>
		<th>Divisi/Bagian Asal:</th>
			<td><?php echo $order['departemenAsal']?></td>
	</tr>
	<tr>
		<th>SOP :</th>
			<td colspan="3"><?php echo $order['namaSop'];?></td>
	</tr>
	<tr>
		<th>Work Order:</th>
			<td colspan="3"><?php echo $order['namaWo'];?></td>
	</tr>
	<tr>
		<th>Lama SLA:</th>
			<td colspan="3"><?php echo $order['namaSla'];?></td>
	</tr>
	<tr>
		<th>Waktu Buat:</th>
			<td><?php echo $order['waktuBuat']!='0000-00-00 00:00:00'?$order['waktuBuat']:'';?></td>
		<th>Waktu Tutup:</th>
			<td><?php echo $order['waktuTutup']!='0000-00-00 00:00:00'?$order['waktuTutup']:'';?></td>
	</tr>
	<tr>
		<th>Respon Akhir:</th>
			<td><?php echo $order['responAkhir']!='0000-00-00 00:00:00'?$order['responAkhir']:'';?></td>
		<th>Lama Waktu:</th>
			<td><?php
					//hitung selisih waktu 
					if($order['waktuTutup']!='0000-00-00 00:00:00'){
						$time1=new DateTime($order['waktuBuat']);
						$time2=new DateTime($order['waktuTutup']);
						$interval=$time1->diff($time2);
						//print_r($interval);
						if ($interval->m != 0){
							echo $interval->m.' bulan, '.$interval->d.' hari, '.$interval->h.' jam '.$interval->i.' menit '.$interval->s.' detik';
						}else{
							echo $interval->d.' hari, '.$interval->h.' jam '.$interval->i.' menit '.$interval->s.' detik';
						}
					}else{
						echo '';
					}
				?></td>
	</tr>
	<tr>
		<th>Status:</th>
			<td colspan="3"><?php echo $order['namaStatus']?></td>
	</tr>
</table>
	<div class="btn-group">
		<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ubahOrder">Ubah Status Order</button>-->
		<?php
			if(($this->session->userdata('role')=='kbag' || $this->session->userdata('role')=='kbid')
				&& $order['idDepartemenTujuan']==$this->session->userdata('idDepartemen') 
				&& $order['idTiketStatus']==2){
				echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#teruskanOrder" onClick="resetPilihan()">Teruskan Sebagai Order</button>';
			}
		?>
		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#tutupOrder" 
		<?php 
			//close order dilakukan oleh peg dan jika status order dalam tahap diteruskan
			// echo $order['idTiketStatus']==3
			// &&$this->session->userdata('idRole')==8 || 
			// $order['idTiketStatus']==2
			// &&$this->session->userdata('idRole')==7 || 
			// $order['idTiketStatus']==3
			// &&$tutupKbag['dari']==$tutupKbag['kepada']
			// &&$this->session->userdata('idRole')==7?'':'style="display:none"';
			//cek apakah user masuk dalam tujuan nipp tiket
			if (!empty($kepadaOrder)) {
				$cek=0;
				foreach ($kepadaOrder as $k) {
					if ($k->kepada==$this->session->userdata('nipp')) {
						$cek=$cek+1; 
						// echo 'ada';
					}
				}

				echo $cek>=1?'':'style="display:none"';
				// echo "tidak kosong $cek=".$cek;
				// print_r($this->session->all_userdata());
			}else{
				// echo "kosong";
				// print_r($kepadaOrder);
				echo 'style="display:none"';
			}
		?>>Tutup Order</button>
		<!-- tombol kabag -->
		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#verifOrder" 
		<?php //verifikasi dilakukan oleh kbag dan jika status order sudah close
			//diganti tanggal 10-04-2017
			echo $order['idTiketStatus']==4
			&&($this->session->userdata('idRole')==7 || $this->session->userdata('idRole')==6)
			&&$order['idDepartemenTujuan']==$this->session->userdata('idDepartemen')?'':'style="display:none"'; 
		?>>Verifikasi Order</button>
		<!--
		if(!empty($disposisi)){
			$no=1;
			foreach ($disposisi as $row) {
				$creator=$row->dari;
				$no++;
			}
		}
		echo $order['idTiketStatus']==4&&$this->session->userdata('idRole')==7&&$order['nama']==$creator?'':'style="display:none"';?> >Verifikasi Order</button>
		-->
	</div>
<hr>

<!-- Modal -->
<div class="modal fade" id="teruskanOrder" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<?php echo form_open('tiket/compOrderFwd/'.$order['id'], array('onSubmit'=>'return valOrderFwd()'));?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Teruskan Sebagai Order</h3>
			</div>
			<div class="modal-body">
				<h4>Detail Order</h4>
					<label>SOP :</label><br>
					<select class="form-control" id="sop" name="sop" onchange="tampilWO();tampilSla()">
						<option value="0">-- Pilih SOP --</option>
						<?php
							$no=1;
							foreach ($sop as $row) {
								echo'
								<option value="'.$row->id.'">'.$row->namaSop.'</option>
								';
								$no++;
							}
						?>
					</select>
					<label>Work Order :</label><br>
					<select class="form-control" id="wo" name="wo">
						<option value="0">-- Pilih Work Order --</option>
					</select>
					<label>Sla :</label><br>
					<select class="form-control" id="sla" name="sla">
						<option value="0">-- Pilih SLA --</option>
					</select>
				<br><hr>
				<h4>Pilih Pegawai</h4>
					<div id="peg-0">
					<label>Pegawai ke-1 :</label><br>
					<select class="form-control" id="peg0" name="pegawai[]">
						<option value="0">-- Pilih Petugas --</option>
						<?php
							$no=1;
							foreach ($pegawai as $row) {
								echo'
								<option value="'.$row->nipp.'">'.$row->nama.'</option>
								';
								$no++;
							}
						?>
					</select>
					</div>
					<div id="peg-1" hidden>
					<label>Pegawai ke-2 :</label><br>
					<select class="form-control" name="pegawai[]" id="peg1" disabled>
						<option value="0">-- Pilih Petugas --</option>
						<?php
							$no=1;
							foreach ($pegawai as $row) {
								echo'
								<option value="'.$row->nipp.'">'.$row->nama.'</option>
								';
								$no++;
							}
						?>
					</select>
					</div>
					<div id="peg-2" hidden>
					<label>Pegawai ke-3 :</label><br>
					<select class="form-control" name="pegawai[]" id="peg2" disabled>
						<option value="0">-- Pilih Petugas --</option>
						<?php
							$no=1;
							foreach ($pegawai as $row) {
								echo'
								<option value="'.$row->nipp.'">'.$row->nama.'</option>
								';
								$no++;
							}
						?>
					</select>
					</div>
					<div id="peg-3" hidden>
					<label>Pegawai ke-4 :</label><br>
					<select class="form-control" name="pegawai[]" id="peg3" disabled>
						<option value="0">-- Pilih Petugas --</option>
						<?php
							$no=1;
							foreach ($pegawai as $row) {
								echo'
								<option value="'.$row->nipp.'">'.$row->nama.'</option>
								';
								$no++;
							}
						?>
					</select>
					</div>
					<div id="peg-4" hidden>
					<label>Pegawai ke-5 :</label><br>
					<select class="form-control" name="pegawai[]" id="peg4" disabled>
						<option value="0">-- Pilih Petugas --</option>
						<?php
							$no=1;
							foreach ($pegawai as $row) {
								echo'
								<option value="'.$row->nipp.'">'.$row->nama.'</option>
								';
								$no++;
							}
						?>
					</select>
					</div>
					<br>
				<input class="btn btn-success" type="button" class="btn btn-default" value="Tambah Pegawai" onClick="addPegawai()" />
				<input class="btn btn-default" type="button" value="Reset Pilihan" onClick="resetPilihan()" />
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Tambah</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
			</div>
		<?php echo form_close();?>	
		</div>
	</div>
</div>

<div class="modal fade" id="tutupOrder" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<?php 
			/*
			if($this->session->userdata('nipp')==$order['createdBy']){
				echo form_open('tiket/closeOrder/'.$order['id']);
			}elseif($this->session->userdata('role')=='kbag'&&$order['idTiketStatus']==4){
				echo form_open('tiket/verifiedOrder/'.$order['id']);
			}elseif($this->session->userdata('role')=='staf'){
				echo form_open('tiket/reportingOrder/'.$order['id']);
			}
			*/
			echo form_open('tiket/closeOrder/'.$order['id']);
		?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Tutup Order</h3>
			</div>
			<div class="modal-body">
				Anda menutup order pada waktu: <br>
				<label>Tanggal : </label><br>
				<input class="form-control" type="text" name="tglClose" value="<?php echo date("Y-m-d");?>" readonly><br>
				<label>Jam : </label><br>
				<input class="form-control" type="text" name="jamClose" value="<?php echo date("H:i:s");?>" readonly>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Konfirmasi</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			</div>
		<?php echo form_close();?>
		</div>
	</div>
</div>

<div class="modal fade" id="tutupOrderKbag" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<?php 
			/*
			if($this->session->userdata('nipp')==$order['createdBy']){
				echo form_open('tiket/closeOrder/'.$order['id']);
			}elseif($this->session->userdata('role')=='kbag'&&$order['idTiketStatus']==4){
				echo form_open('tiket/verifiedOrder/'.$order['id']);
			}elseif($this->session->userdata('role')=='staf'){
				echo form_open('tiket/reportingOrder/'.$order['id']);
			}
			*/
			echo form_open('tiket/closeOrder/'.$order['id']);
		?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Tutup Order</h3>
			</div>
			<div class="modal-body">
				Anda menutup order pada waktu: <br>
				<label>Tanggal : </label><br>
				<input class="form-control" type="text" name="tglClose" value="<?php echo date("Y-m-d");?>" readonly><br>
				<label>Jam : </label><br>
				<input class="form-control" type="text" name="jamClose" value="<?php echo date("H:i:s");?>" readonly>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Konfirmasi</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			</div>
		<?php echo form_close();?>
		</div>
	</div>
</div>

<div class="modal fade" id="verifOrder" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<?php 
			/*
			if($this->session->userdata('nipp')==$order['createdBy']){
				echo form_open('tiket/closeOrder/'.$order['id']);
			}elseif($this->session->userdata('role')=='kbag'&&$order['idTiketStatus']==4){
				echo form_open('tiket/verifiedOrder/'.$order['id']);
			}elseif($this->session->userdata('role')=='staf'){
				echo form_open('tiket/reportingOrder/'.$order['id']);
			}
			*/
			echo form_open('tiket/verifiedOrder/'.$order['id']);
		?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Verifikasi Order</h3>
			</div>
			<div class="modal-body">
				Verifikasi order pada waktu: <br>
				<label>Tanggal : </label><br>
				<input class="form-control" type="text" name="tglClose" value="<?php echo date("Y-m-d");?>" readonly><br>
				<label>Jam : </label><br>
				<input class="form-control" type="text" name="jamClose" value="<?php echo date("H:i:s");?>" readonly>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Konfirmasi</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			</div>
		<?php echo form_close();?>
		</div>
	</div>
</div>
<!-- Modal End -->

<strong><h4><strong>Riwayat Order</strong></h4></strong>
			<table align="left" id="example" class="display compact nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
			        <th>No</th>
			        <th>Tanggal</th>
			        <th>Dari</th> 
			        <th>Kepada</th>
			        <th>Keterangan</th>	
				</tr>
			</thead>
			<tbody>
				<?php
					if(!empty($disposisi)){
						$no=1;
						foreach ($disposisi as $row) {
							echo '<tr>';
							echo '<td>'.$no.'</td>';
							echo '<td>'.$row->waktuBuat.'</td>';
							echo '<td>'.$row->dari.'</td>';
							echo '<td>'.$row->kepada.'</td>';
							echo '<td>'.$row->keterangan.'</td>';
							echo '</tr>';
							$no++;
						}
					}
				?>
			</tbody>
			</table>
</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4><strong>Respon Order</strong></h4>
	</div>
	<div class="panel-body">
	<table id="example2" class="display" width="100%">
		<thead>
			<th>No</th>
			<th>Pengirim</th>
			<th>Pesan</th>
			<th>Lampiran</th>
			<th></th>
		</thead>
		<tbody>
		<?php
			if(!empty($respon)){
				$no=1;
				foreach ($respon as $row) {
					echo '<tr>';
					echo '<td>'.$no.'</td>';
					echo '<td>'.$row->nama.'<br>'.$row->waktuBuat.'</td>';
					echo '<td>'.nl2br($row->pesan).'</td>';
					if(!empty($row->lampiran)){
						echo '<td><center><a href="'.base_url($row->lampiran).'"><img width="100%" height="100%" src="'.base_url($row->lampiran).'"><br></a></center></td>';
						echo '<td><a href="'.base_url('tiket/download_gbr/'.str_replace("/", "-", $row->lampiran)).'"><span class="glyphicon glyphicon-download-alt"></span></a> <a href="'.base_url('tiket/hapus_respon/'.$row->id).'"><span class="glyphicon glyphicon-trash"></span></a></td>';
						echo '</tr>';
					}else{
						echo '<td><center>Kosong<center></td>';
						echo '<td><a href="'.base_url('tiket/hapus_respon/'.$row->id).'"><span class="glyphicon glyphicon-trash"></span></a></td>';
						echo '</tr>';
					}
					$no++;
				}
			}
		?>
	<!--		<tr>
				<td>1</td>
				<td>Budi<br>29/08/2016 07:59:13</td>
				<td>Pesan apa Bro!?</td>
				<td><center><button><span class="glyphicon glyphicon-download-alt"></span></button></center></td>			
				<td><a href="<?php?>"><span class="glyphicon glyphicon-trash"></span></a></td>
			</tr>
			<tr>
				<td>2</td>
				<td>Me<br>29/08/2016 07:59:13</td>
				<td>You know the closer you get to something, the tougher it is to see it!
				<br>and I never take it for granted!</td>
				<td><center><button><span class="glyphicon glyphicon-download-alt"></span></button></center></td>
				<td><a href="<?php?>"><span class="glyphicon glyphicon-trash"></span></a></td>			
			</tr>
			<tr>
				<td>3</td>
				<td>Me<br>29/08/2016 07:59:13</td>
				<td>You know the closer you get to something, the tougher it is to see it!
				<br>and I never take it for granted!</td>
				<td><center><a href="<?php echo base_url('uploads/1.jpg');?>"><img width="50%" height="50%" src="<?php echo base_url('uploads/1.jpg');?>"><br></a><button><span class="glyphicon glyphicon-download-alt"></span></button></center></td>		
				<td><a href="<?php?>"><span class="glyphicon glyphicon-trash"></span></a></td>		
			</tr> -->
		</tbody>
	</table>
	</div>
</div>

<div class="panel panel-default" <?php echo $order['idJenisWo']==1?'':'style="display:none"'?>>
	<div class="panel-heading">
		<h4><strong>Laporan Volume Kerja</strong></h4>
	</div>
	<div class="panel-body">
	<table id="example3" class="display compact nowrap" cellspacing="0" width="100%">
		<thead>
			<th>No</th>
			<th>Waktu Buat</th>
			<th>Pelapor</th>
			<th>Nama Item</th>
			<th>Jumlah</th>
			<th>Nama Satuan</th>
			<th></th>
		</thead>
		<tbody>
		<?php
			if(!empty($volKerja)){
				$no=1;
				foreach ($volKerja as $row) {
					echo '<tr>';
					echo '<td>'.$no.'</td>';
					echo '<td>'.$row->waktuBuat.'</td>';
					echo '<td>'.$row->nama.'</td>';
					echo '<td>'.$row->namaItem.'</td>';
					echo '<td>'.$row->jumlah.'</td>';
					echo '<td>'.$row->namaSatuan.'</td>';
					echo '</tr>';
					$no++;
				}
			}
		?>
		</tbody>
	</table>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="tabbable" id="tab1">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#panel1" data-toggle="tab">Respon Tiket</a>
					</li>
					<li>
						<a href="#panel2" data-toggle="tab" <?php echo $order['idJenisWo']==1?'':'style="display:none"'?>>Laporkan Volume Pekerjaan</a>
					</li>
					<!--
					<li>
						<a href="#panel3" data-toggle="tab">Teruskan ke Divisi/Bagian Lain</a>
					</li>
					-->
				</ul>
				
				<div class="tab-content">
					<div class="tab-pane active" id="panel1">
						<div class="form">
							<h3><strong>Respon Tiket</strong></h3><hr/>
							<div class="col-md-6">
							<?php echo form_open_multipart('tiket/tambahResponById/'.$this->uri->segment(3), array('onSubmit'=>'return validasiRespon()','name'=>'formRespon'));?>
							<div class="form-group">
								<label for="inputDetail">
									Pesan
								</label>
								<textarea class="form-control" name="pesan" id="pesan" type="text" cols="100" rows="10"></textarea>
							</div>
							<div class="form-group">
								<label for="inputFile">
									Upload File
								</label>
								<input name="uploadFile" id="uploadFile" type="file" onclick="notice()" />
								<?php
									echo '<h3 style="color:red">'.$this->session->flashdata('error').'</h3>';
								?>
								*File Foto yang lebih dari 5MB, tidak akan disimpan oleh sistem
							</div>
							<!--
							<div class="checkbox">
								<label>
									<input type="checkbox" name="cb_close" value="yes" onclick="cekClose(this)">Closed Tiket</input>
								</label>
							</div>
							<div class="form-group" id="date" hidden>
							<label><strong>Waktu (Tanggal dan Jam):</strong></label>
					            <div class='input-group date' id='datetimepicker1'>
					            	<input type='text' name="tanggal" id='tanggal' class="form-control" />
					                <span class="input-group-addon">
					                <span class="glyphicon glyphicon-calendar"></span>
					                </span>
					            </div>
					        </div>
					        -->
							<button type="submit" class="btn btn-primary">
								Submit
							</button>
							<button type="button" class="btn btn-danger">
								Cancel
							</button><br><br>
							<?php echo form_close();?>
							</div>
						</div>
					</div>

					<div class="tab-pane" id="panel2">
						<div class="form">
							<h3><strong>Lampirkan Volume Pekerjaan</strong></h3><hr/>
							<div class="col-md-6">
							<?php echo form_open('tiket/tambahVolKerjaByIdOrder/'.$this->uri->segment(3), array('onSubmit'=>'return validasiResponVolume()','name'=>'formVolume'));?>
							<table class="table">
								<tbody id="dynamicInput">
									<tr>
										<th>Nama Item</th>
										<th>Jumlah</th>
										<th>Nama Satuan</th>
									</tr>
									<tr>
										<td><input class="form-control" type="text" id="nama0" name="namaItem[]"></td>
										<td><input class="form-control" type="text" id="jumlah0" name="jumlahItem[]"></td>
										<td><input class="form-control" type="text" id="satuan0" name="satuanItem[]"></td>
									</tr>
								</tbody>
							</table>
							<input type="button" class="btn btn-success" value="Tambah Item" onClick="addInput('dynamicInput')" />
							<input type="button" class="btn btn-default" value="Reset Item" onClick="resetItem()" />
							<hr/>
							<button type="submit" class="btn btn-primary">
								Submit
							</button>
							<button type="button" class="btn btn-danger">
								Cancel
							</button>
							<?php echo form_close();?>
							</div>
						</div>
					</div>

					<div class="tab-pane" id="panel3">
						<div class="form">
							<h3><strong>Teruskan ke Divisi/Bagian Lain</strong></h3><hr/>
							<div class="col-md-6">
							<?php echo form_open('tiket/addKomentar');?>
							<div class="form-group">
								<label for="inputSubjek">
									Pilih Unit
								</label>
								<select class="form-control" id="id_unit" required>
								<option value="-1">-- Pilih Unit --</option>
								<?php
									foreach($unit as $b){
										echo '<option value="'.$b->kode_unit.'">'.$b->nama_unit.'</option>';
									}
								?>
								</select>
							</div>
							<div class="form-group">
								<label for="inputDetail">
									Pilih Divisi / Bagian
								</label>
								<select class="form-control" id="id_dept">
								<option value="-1">-- Pilih Bagian --</option>
								<?php
									foreach($dept as $b){
										echo '<option value="'.$b->id_dept.'">'.$b->nama_dept.'</option>';
									}
								?>
								</select>
							</div>
							<div class="form-group">
								<label for="inputDetail">
									Pilih Pegawai
								</label>
								<select class="form-control" id="id_dept">
								<option value="-1">-- Pilih Pegawai --</option>
								<?php
									foreach($pegt as $b){
										echo '<option value="'.$b->id_peg.'">'.$b->nama_peg.'</option>';
									}
								?>
								</select>
							</div>
							<div class="form-group">
								<label for="inputDetail">
								Pesan
								</label>
								<textarea class="form-control" id="pesan" type="text" cols="100" rows="10"></textarea>
							</div>
							<hr/>
							<button type="submit" class="btn btn-primary">
								Submit
							</button>
							<button type="button" class="btn btn-danger">
								Cancel
							</button>
							<?php echo form_close();?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Pilih Detail WO</h3>
			</div>
			<div class="modal-body form">
				<?php echo form_open($this->session->userdata('role').'/tiket/perbarui_uorder/'.str_replace('/', '-', $notiket),array('onSubmit'=>'return validasi()','class'=>'form-horizontal', 'id'=>'form'));?>
				<input type="hidden" value="" name="id"></input>
				<div class="form-body">
					<div class="form-group">
						<label class="control-label col-md-3">Petugas :</label>
						<div class="col-md-9">
							<select class="form-control" name="petugas" id="petugas" onchange="tampilSOP()">
								<option value="0">-- Pilih Pegawai --</option>
								</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">SOP :</label>
						<div class="col-md-9">
							<select class="form-control" name="sop" id="sop" onchange="tampilWO()">
								<option value="0">-- Pilih SOP --</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Work Order :</label>
						<div class="col-md-9">
							<select class="form-control" name="wo" id="wo">
								<option value="0">-- Pilih Work Order --</option>
							</select>
						</div>
					</div>
					<div class="form">
					<div class="form-group">
						<label class="control-label col-md-3">Pesan :</label>
						<div class="col-md-9">
						<textarea class="form-control" name="pesan2" id="pesan2" type="text" cols="100" rows="10"></textarea>
						</div>
					</div>
					</div>											
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id="btnSave" class="btn btn-primary">Tugaskan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="cancelbtn()">Cancel</button>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>
</body>
<script type="text/javascript">
//pilihan dengan role: kcab dan kdiv
	var countera=1;
	var counterb=1;
	var limit=5;

function addInput(divName){
	if(countera==limit){
		alert("Melebihi batas maksimum.");
	}else{
		var newtr=document.createElement('tr');
		newtr.id='add';
		newtr.innerHTML='<td><input class="form-control" type="text" id="nama'+countera+'" name="namaItem[]"></td><td><input class="form-control" type="text" id="jumlah'+countera+'" name="jumlahItem[]"></td><td><input class="form-control" type="text" id="satuan'+countera+'" name="satuanItem[]"></td>';
		document.getElementById(divName).appendChild(newtr);
		countera++;
	}
}

function resetItem(){
	countera=1;
	$("#nama1").remove();$("#jumlah1").remove();$("#satuan1").remove();
	$("#nama2").remove();$("#jumlah2").remove();$("#satuan2").remove();
	$("#nama3").remove();$("#jumlah3").remove();$("#satuan3").remove();
	$("#nama4").remove();$("#jumlah4").remove();$("#satuan4").remove();
	$("#nama5").remove();$("#jumlah5").remove();$("#satuan5").remove();
	$("#add").empty();
	$("#nama0").val("");;$("#jumlah0").val("");;$("#satuan0").val("");
}

function resetPilihan(){
	$("#sop").prop('selectedIndex',0);
	$("#wo").prop('selectedIndex',0);
	$("#sla").prop('selectedIndex',0);
	$("#pegawai").prop('selectedIndex',0);
	$("#peg0").prop('selectedIndex',0);

	counterb=1;
	var loop=1;
	while(loop<5){
		//alert('apaajaboyeh');
		$("#peg-"+loop+"").hide();
		$("#peg"+loop+"").prop("disabled", true);
		$("#peg"+loop).prop('selectedIndex',0);
		loop++;
	}
}

function addPegawai(){
	if(counterb==limit){
		alert("Jumlah maksimum sebanyak 5");
	}else{
		//alert('jumlah '+counterb);
		$("#peg-"+counterb).show();
		$("#peg"+counterb).prop("disabled", false);
		counterb++;
	}
}

/*
function addPegawai(pegawai){
	var template="<?php echo form_dropdown('pegawai[]',$pegawai,'') ?>";
	if(counterb==limit){
		alert("Melebihi batas maksimum.");
	}else{
		var pgw=document.createElement('div');
		pgw.innerHTML='<label>Pegawai Ke-'+ (counterb+1) +' :</label><br>'+template;
		//<select class="form-control" name="petugas[]"><option value="0">-- Pilih Petugas --</option>''</select>';
		document.getElementById(pegawai).appendChild(pgw);
		counterb++;
	}
}
*/
function notice(){
	alert("Foto tidak boleh melebihi 5 MB");
}

function cekClose(checkbox){
	var role=<?php echo $role="'".$this->session->userdata('role')."'"?>;
	if(checkbox.checked && role!='staf'){
		$("#date").show();
		//$("#tanggal").val('');
	}else{
		$("#date").hide();
		//$("#tanggal").val('');
	}
}

$(function(){
   $('#datetimepicker1').datetimepicker({
    	format: 'DD-MM-YYYY HH:mm:ss',
    	"defaultDate": new Date(),
    	//"autoclose": true
      });
});

function tampilPegawai(){
	$("#sop").prop('selectedIndex',0);
	$("#wo").prop('selectedIndex',0);
	$("#inputSubjek2").val("");
	$("#inputDetail2").val("");
	//var idDept = <?php echo $this->session->userdata('id_departemen')?>;
	//var role = <?php echo $role="'".$this->session->userdata('role')."'"?>;
	//alert(role);
	$.ajax({
		url:"<?php echo base_url();?>"+role+"/tiket/pilih_petugas/"+idDept,
		success: function(html){
			$("#petugas").html(html);
		},
		dataType:"html"
	})
}

function tampilSla(){
	var idDept = <?php echo $role="'".$this->session->userdata('idDepartemen')."'"?>;
	//alert(idDept);
	$.ajax({
		url:"<?php echo base_url();?>tiket/pilihSlaByDept/"+idDept+"",
		success: function(html){
			$("#sla").html(html);
		},
		dataType:"html"
	})
}

function tampilWO(){
	var idsop = $('#sop').val();
	//alert(idsop);
	$.ajax({
		url:"<?php echo base_url();?>/tiket/pilih_wo/"+idsop+"",
		success: function(html){
			$("#wo").html(html);
		},
		dataType:"html"
	})
}

function validasi(){
	var petugas=$("#petugas").val();
	var sop=$("#sop").val();
	var wo=$("#wo").val();
	var pesan=$("#pesan2").val();

	if(petugas=='0'){
		alert('Lengkapi pilihan petugas');
		return false;
	}else if(sop=='0'||sop==null||wo=='0'||wo==null){
		alert('Lengkapi detail Order anda');
		return false;
	}else if(pesan==''){
		alert('Lengkapi kolom pesan');
		return false;
	}
}

function validasiRespon(){
	var pesan=$('#pesan').val();
	var file=$("#uploadFile")[0]; //lihat ukuran file dari array ke-0 (HTML DOM Object = document.getElementById('IdHTML'))

	if(pesan==''||pesan==null){
		alert('Silahkan mengisi pesan respon');
		return false;
	}else if(file.files[0].size>'5000000'){
		//cek size file > 5MB?
		alert('File tidak boleh melebihi 5 MB');
		return false;
	}
}

Array.prototype.allValuesSame = function(){
	for(var i=1; i<this.length;i++){
		if(this[i]!==this[0]){
			return false;
		}
	}
	return true;
}

function validasiResponVolume(){
	//for(i=0;i<$(#))
	var item = $('input[name="namaItem[]"]').length;
	//alert(item);return false;
	for (var i = 0; i<item; i++) {
		if($("#nama"+i).val()==''||$("#jumlah"+i).val()==''||$("#satuan"+i).val()==''){
			alert('Lengkapi data volume!');return false;
		}
	}
}

function valOrderFwd(){
	var sop=$('#sop').val();
	var wo=$('#wo').val();
	var sla=$('#sla').val();
	var pegawai = [];
	for (i=0; i<5; i++) {
		if($("#peg"+i).val()!="0"){
			pegawai.push($("#peg"+i).val());
		}
	}

	//check duplicate nipp on entry process
	var peg_sort = pegawai.slice().sort();
	var results = [];
	for (var i=0; i<pegawai.length-1; i++) {
	    if (peg_sort[i + 1] == peg_sort[i]) {
	        results.push(peg_sort[i]);
	    }
	}
	//alert(results.length);//return false;

	//alert(pegawai);return false;
	if(sop=='0'||wo=='0'||sla=='0'){
		alert('Lengkapi detail order!');
		resetPilihan();
		return false;
	}else if(pegawai=='0'||pegawai==''){
		alert('Silahkan pilih pegawai!');
		resetPilihan();
		return false;
	}else if(results!=''){ //cek apakah hasil duplicate kosong?
		alert('Tidak dapat memilih pegawai yang sama!');
		resetPilihan();
		return false;
	}
}

</script>