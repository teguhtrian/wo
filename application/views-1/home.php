<head>
<script type="text/javascript">
$(function(){
	$("#example").dataTable({
		"responsive":true,
	    "ordering": false,
	    "info": false,
	    "searching":true,
	    "fixedColumns":true,
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
	    "info": false,
	    "searching":true,
	    "fixedColumns":true,
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
<h1>Home</h1>

<p>Selamat Datang, <?php $fullname = $this->session->userdata['nama'];
$role = $this->session->userdata['namaRole']; 
echo "$fullname.</p><p>Anda login sebagai <b>$role</b>. &nbsp &nbsp";?></p>
<!--
<p>Anda memiliki <?php echo $jumlah_tiket;?> tiket untuk diselesaikan.</p>
-->
<div class="panel panel-default">
	<div class="panel-heading">
		<h4><strong>Tiket Order Saya</strong></h4>
	</div>
	<div class="panel-body">
	<div class="container-fluid">
	  <div class="row">
	        <ul class="nav nav-tabs">
	          <li class="active">
	            <a href="#panel1" data-toggle="tab">Order Open</a>
	          </li>
	          <li>
	            <a href="#panel2" data-toggle="tab">Order Closed</a>
	          </li>
	        </ul>

	        <div class="tab-content">
	          <div class="tab-pane active" id="panel1">
	             <br>
	            	<table id="example" class="display compact nowrap" cellspacing="0" width="100%">
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
	            	<table id="example2" class="display compact nowrap" cellspacing="0" width="100%">
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

	   </div>
	</div>
</div>
</div>
</div>