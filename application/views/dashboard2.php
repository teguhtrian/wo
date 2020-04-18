<head>
<script type="text/javascript">
$(function(){
	$("#example1").dataTable({
		"responsive":true,
	    "ordering": false,
	    "scrollX":true,
	    "info": false,
	    "searching":true,
	    "fixedColumns":false,
	    "columnDefs":[	
	    	{ "width": "1%", "targets":0 },
	    	{ "width": "15%", "targets":1 },
	    	{ "width": "15%", "targets":2 },
	    	{ "width": "10%", "targets":3 },
	    	{ "width": "25%", "targets":4 },
	    	{ "width": "10%", "targets":5 }
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

	$("#example2").dataTable({
		"responsive":true,
	    "ordering": false,
	    "scrollX":true,
	    "info": false,
	    "searching":true,
	    "fixedColumns":false,
	    "columnDefs":[	
	    	{ "width": "1%", "targets":0 },
	    	{ "width": "15%", "targets":1 },
	    	{ "width": "15%", "targets":2 },
	    	{ "width": "10%", "targets":3 },
	    	{ "width": "25%", "targets":4 },
	    	{ "width": "10%", "targets":5 }
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

    $("#tab1").dataTable({
    	"responsive":true,
	    "ordering": true,
	    "row-border": true,
	    "cell-border": true,
	    "scrollX":true,
	    "info": true,
	    "searching":true,
	    "fixedColumns":true,
	    "columnDefs":[	
	    	{ "width": "1%", "targets":0 },
	    	{ "width": "45%", "targets":1 },
	    	{ "width": "10%", "targets":2, className: 'dt-head-center' },
	    	{ "width": "10%", "targets":3, className: 'dt-head-center' },
	    	{ "width": "10%", "targets":4, className: 'dt-head-center' },
	    	{ "width": "10%", "targets":5, className: 'dt-head-center' },
	    	{ "width": "10%", "targets":6, className: 'dt-head-center' },
	    	{ "width": "10%", "targets":7, className: 'dt-head-center' },
	    	{ "width": "10%", "targets":8, className: 'dt-head-center' },
	    ],
    	"language":{
          "sProcessing":   "Sedang memproses...",
          "sLengthMenu":   "Tampilkan _MENU_ entri",
          "sZeroRecords":  "Tidak ditemukan data yang sesuai",
          "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 Data",
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
<!-- Pemberitahuan JQUERY -->
<!--
	<div id="dialog-message" title="PEMBERITAHUAN">
	  <p align="justify">
	    Sehubungan dengan pengembangan Sistem Database Workorder maka akan dilakukan proses maintenance Sistem untuk <b>Pengembangan dan Migrasi Database</b> pada <b>jam 11:30:00 WIB, tanggal 1 Februari 2017</b>. 
	  </p>
	  <p align="justify">Demikian agar informasi ini dapat diterima. Terimakasih.</p>
	  <p >
	    Salam, Admin.
	  </p>
	</div>
-->
<!-- Tutup Pemberitahuan -->

<div class="col-sm-12">
<h1><strong>Dashboard</strong></h1>
<hr/>
<p>Selamat Datang, <?php $fullname=$this->session->userdata('nama');
$role = $this->session->userdata['namaRole']; 
echo "$fullname </p><p>Anda login sebagai <b>$role</b> &nbsp &nbsp";?></p>
<!--
<p>Anda memiliki <a href="<?php echo site_url('tiket/tiket_saya');?>"><?php echo "$jumlah_tiket";?> tiket</a> untuk diselesaikan.</p>
<br>	
-->

<div class="panel panel-default">
	<div class="panel-heading">
		<h4><strong>Layanan Informasi</strong></h4>
	</div>
	<div class="panel-body">
		<table id="tab1" class="display compact" style="width:100%">
			<thead>
				<tr>
					<th rowspan="3">No</th>
					<th rowspan="3">Nama Kantor</th>
					<th colspan="4">Jenis Layanan Informasi</th>
					<th colspan="3">Jumlah</th>
				</tr>
				<tr>
					<th colspan="2">Pesan Informasi</th>
					<th colspan="2">Pesan Pengaduan</th>
					<th rowspan="2">Buka</th>
					<th rowspan="2">Tutup</th>
					<th rowspan="2">Total</th>
				</tr>
				<tr>
					<th>Buka</th>
					<th>Tutup</th>
					<th>Buka</th>
					<th>Tutup</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					if(!empty($li)){
						foreach ($li as $l) {
							echo '<tr>
							<td class="text-center">'.$no.'</td>';
							if ($l->parentId=='1') {
								echo '
							<td><a href='.base_url('tiket/bacaLiByUnit/'.$l->kodeUnit).'>Kantor Pusat - '.$l->namaUnit.'</a></td>';
							}else{
								echo '
							<td><a href='.base_url('tiket/bacaLiByUnit/'.$l->kodeUnit).'>'.$l->namaUnit.'</a></td>';
							}
							echo '<td class="text-center"><a href='.base_url('tiket/bacaLiByUnit/'.$l->kodeUnit).'>'.$l->openInfo.'</a></td>
							<td class="text-center"><a href='.base_url('tiket/bacaLiByUnit/'.$l->kodeUnit).'>'.$l->closeInfo.'</a></td>
							<td class="text-center"><a href='.base_url('tiket/bacaLiByUnit/'.$l->kodeUnit).'>'.$l->openPeng.'</a></td>
							<td class="text-center"><a href='.base_url('tiket/bacaLiByUnit/'.$l->kodeUnit).'>'.$l->closePeng.'</a></td>
							<td class="text-center"><a href='.base_url('tiket/bacaLiByUnit/'.$l->kodeUnit).'>'.($l->openInfo+$l->openPeng).'</a></td>
							<td class="text-center"><a href='.base_url('tiket/bacaLiByUnit/'.$l->kodeUnit).'>'.($l->closeInfo+$l->closePeng).'</a></td>
							<td class="text-center"><a href='.base_url('tiket/bacaLiByUnit/'.$l->kodeUnit).'>'.(($l->openInfo+$l->openPeng)+($l->closeInfo+$l->closePeng)).'</a></td>';
							$no++;
						}
					}
				?>
			</tbody>
		</table>
</div>
</div>
</div>
<div class="col-sm-6">
<div class="panel panel-default">
	<div class="panel-heading">
		<h4><strong>Order Unit Kerja</strong></h4>
	</div>
	<div class="panel-body">
	<table class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
		<tr class="info">
			<th class="text-center vert-align" rowspan="2">No</th>
			<th class="text-center  vert-align" rowspan="2">Nama Unit Kerja</th>
			<th class="text-center  vert-align" colspan="3">Status Tiket</th>		
		</tr>
		<tr class="info">
			<th class="text-center">Buka</th>
			<th class="text-center">Tutup</th>
			<th class="text-center">Total</th>
		</tr>
		</thead>
		<tbody>
		<?php
			if(!empty($departemen)){
				$no=1;
				foreach ($departemen as $row) {
					echo '<tr>';
					echo '<td class="text-center">'.$no.'</td>';
					echo '<td><a href='.base_url('tiket/orderByDept/'.$row->id).'>'.$row->namaDepartemen.'</a></td>';
					if($row->tiketOpen!=null){
						echo '<td class="text-center"><a href='.base_url('tiket/orderByDept/'.$row->id).'>'.$row->tiketOpen.'</a></td>';
					}else{
						echo '<td class="text-center"><a href='.base_url('tiket/orderByDept/'.$row->id).'>0</a></td>';
					}
					if($row->tiketClose!=null){
						echo '<td class="text-center"><a href='.base_url('tiket/orderByDept/'.$row->id).'>'.$row->tiketClose.'</a></td>';
					}else{
						echo '<td class="text-center"><a href='.base_url('tiket/orderByDept/'.$row->id).'>0</a></td>';
					}
					if($row->tiketClose!=null){
						echo '<td class="text-center"><a href='.base_url('tiket/orderByDept/'.$row->id).'>'.($row->tiketOpen+$row->tiketClose).'</a></td>';
					}else{
						echo '<td class="text-center"><a href='.base_url('tiket/orderByDept/'.$row->id).'>0</a></td>';
					}					
					echo '</tr>';
					$no++;
				}
			}
		?>
		</tbody>
	</table>
	</div>
</div>
</div>
<?php

?>
<div class="col-sm-6">
<div class="panel panel-default">
	<div class="panel-heading">
		<h4><strong>Tiket Order Saya</strong></h4>
	</div>
	<div class="panel-body">
	<div class="container-fluid">
	  <!-- <div class="row"> -->
	        <ul class="nav nav-tabs">
	          <li class="active">
	            <a href="#panel1" data-toggle="tab">Order Open</a>
	          </li>
	          <li>
	            <a href="#panel2" data-toggle="tab">Order Closed</a>
	          </li>
	        </ul>

	        <div class="tab-content">
	          <div class="tab-pane fade in active" id="panel1">
	             <br>
	            	<table id="example1" class="display compact" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>No Tiket</th>
								<th>Waktu Buat</th>
								<th>Dari</th>
								<th>SLA</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
						<?php
							if(!empty($orderOpen)){
								$no=1;
								foreach($orderOpen as $row) {
									echo '<tr>
									<td>'.$no.'</td>';
									echo '<td>'.anchor('tiket/bacaOrderFwd/'.$row->idOrder,$row->noTiket).'</td>';
									echo '<td>'.$row->waktuBuat.'</td>';
									echo '<td>'.$row->nama.'</td>';
									echo '<td>'.$row->namaSla.'</td>';
									echo '<td>'.$row->namaStatus.'</td>
									</tr>';
									$no++;
								}	
							}
						?>				
						</tbody>
					</table>
					<br> 
	          </div>
	          <div class="tab-pane fade" id="panel2">
	          	<br>
	            	<table id="example2" class="display compact" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>No Tiket</th>
								<th>Waktu Buat</th>
								<th>Dari</th>
								<th>SLA</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
						<?php
							if(!empty($orderClosed)){
								$no=1;
								foreach ($orderClosed as $row) {
									echo '<tr>
									<td>'.$no.'</td>';
									echo '<td>'.anchor('tiket/bacaOrderFwd/'.$row->idOrder,$row->noTiket).'</td>';
									echo '<td>'.$row->waktuBuat.'</td>';
									echo '<td>'.$row->nama.'</td>';
									echo '<td>'.$row->namaSla.'</td>';
									echo '<td>'.$row->namaStatus.'</td>
									</tr>';
									$no++;
								}	
							}
						?>				
						</tbody>
					</table>
				<br>
	          </div>
	      </div>
	   <!-- </div> -->
	</div>
	</div>
</div>
</div>