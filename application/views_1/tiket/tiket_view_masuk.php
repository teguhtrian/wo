<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
	$(function(){
	    $("#example").dataTable({
        "columnDefs":[
          { "width": "10px", "targets": 0 },
          { "width": "40px", "targets": 1 },
          { "width": "100px", "targets": 2 },
          { "width": "70px", "targets": 3 },
          { "width": "70px", "targets": 4 },
          { "width": "70px", "targets": 5 }
          { "width": "70px", "targets": 5 }
          { "width": "70px", "targets": 5 }
          { "width": "70px", "targets": 5 }
        ],
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
	      $("#example4").dataTable({
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
<body>
 <div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="tabbable" id="tab1">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#panel1" data-toggle="tab">Tiket Informasi</a>
          </li>
          <li>
            <a href="#panel2" data-toggle="tab">Tiket Pengaduan</a>
          </li>
          <li>
            <a href="#panel3" data-toggle="tab">Tiket Order Terusan</a>
          </li>
          <li>
            <a href="#panel4" data-toggle="tab">Tiket Order Langsung</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="panel1">
          	<div class="form">
          	  <h3><strong>Tiket Informasi</strong></h3>
                <table id="example" class="display" width="100%">
                  <thead>
                    <tr>
                      <th rowspan="2">No</th>
                      <th rowspan="2">No Tiket</th>
                      <th rowspan="2">Dari</th>
                      <th rowspan="2">Subjek</th>
                      <th rowspan="2">Prioritas</th>
                      <th rowspan="2">Status</th>
                      <th rowspan="2">Tanggal Buat</th>
                      <th rowspan="2">Respon Terakhir</th>
                      <th colspan="2">Aksi</th>
                    </tr>
                    <tr>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $no = 1;
                    foreach ($info as $b) {
                      echo '<tr>
                            <td>'.$no.'</td>
                            <td>'.anchor('tiket/baca_info/'.$b->id,$b->no_tiket).'</td>
                            <td>'.$b->dari.'</td>
                            <td>'.$b->subjek.'</td>
                            <td>'.$b->prioritas.'</td>
                            <td>'.$b->status.'</td>
                            <td>'.$b->tgl_dibuat.'</td>
                            <td>'.$b->respon_terakhir.'</td>
                            <td>'.anchor('tiket/edit/'.$b->id,"<span class='glyphicon glyphicon-pencil'></span>").'</td>
                            <td>'.anchor('tiket/edit/'.$b->id,"<span class='glyphicon glyphicon-trash'></span>",array('onclick'=>"return confirm('Menghapus ".$b->no_tiket."?')")).'</td>
                          </tr>';
                          $no++;      
                    }
                  ?>
                  </tbody>
                </table>
          	</div>
          </div>
          <div class="tab-pane" id="panel2">
          	<div class="form">
          		<h3><strong>Tiket Pengaduan</strong></h3>
                <table id="example2" class="display" width="100%">
                  <thead>
                    <tr>
                      <th rowspan="2">No</th>
                      <th rowspan="2">No Tiket</th>
                      <th rowspan="2">Kepada</th>
                      <th rowspan="2">Jenis Gangguan</th>
                      <th rowspan="2">Prioritas</th>
                      <th rowspan="2">Status</th>
                      <th rowspan="2">Tanggal Dibuat</th>
                      <th rowspan="2">Respon Terakhir</th>
                      <th colspan="2">Aksi</th>
                    </tr>
                    <tr>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $no = 1;
                    foreach ($pengaduan as $b) {
                      echo '<tr>
                            <td>'.$no.'</td>
                            <td>'.anchor('tiket/baca_info/'.$b->id,$b->no_tiket).'</td>
                            <td>'.$b->kepada.'</td>
                            <td>'.$b->jenis_gangguan.'</td>
                            <td>'.$b->prioritas.'</td>
                            <td>'.$b->status.'</td>
                            <td>'.$b->tgl_dibuat.'</td>
                            <td>'.$b->respon_terakhir.'</td>
                            <td>'.anchor('tiket/edit/'.$b->id,"<span class='glyphicon glyphicon-pencil'></span>").'</td>
                            <td>'.anchor('tiket/delete/'.$b->id,"<span class='glyphicon glyphicon-trash'></span>",array('onclick'=>"return confirm('Menghapus ".$b->no_tiket."?')")).'</td>
                          </tr>';
                          $no++;      
                    }
                  ?>
                  </tbody>
                </table>
          	</div>
          </div>
          <div class="tab-pane" id="panel3">
            <div class="form">
              <h3><strong>Tiket Order Terusan</strong></h3>
                <table id="example3" class="display" width="100%">
                  <thead>
                   <tr>
                      <th rowspan="2">No</th>
                      <th rowspan="2">No Tiket</th>
                      <th rowspan="2">Dasar Perintah</th>
                      <th rowspan="2">Dari</th>
                      <th rowspan="2">Kepada</th>
                      <th rowspan="2">Petugas</th>
                      <th rowspan="2">Tanggal Dibuat</th>
                      <th rowspan="2">Tanggal Ditutup</th>
                      <th rowspan="2">Status Terkini</th>
                      <th rowspan="2">Respon Terakhir</th>
                      <th colspan="2">Aksi</th>
                    </tr>
                    <tr>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $no = 1;
                    foreach ($uorder as $b) {
                      echo '<tr>
                            <td>'.$no.'</td>
                            <td>'.anchor('tiket/baca_uorder_notiket/'.str_replace("/", "-", $b->no_tiket),$b->no_tiket).'</td>
                            <td>'.anchor('tiket/baca_ref_tiket/'.str_replace("/", "-", $b->ref_tiket),$b->ref_tiket).'</td>
                            <td>'.$b->dari.'</td>
                            <td>'.$b->kepada.'</td>
                            <td>'.$b->petugas.'</td>
                            <td>'.$b->tgl_buat.'</td>
                            <td>'.$b->tgl_tutup.'</td>
                            <td>'.$b->status_kini.'</td>
                            <td>'.$b->respon_akhir.'</td>
                            <td>'.anchor('tiket/edit/'.$b->id,"<span class='glyphicon glyphicon-pencil'></span>").'</td>
                            <td>'.anchor('tiket/delete/'.$b->id,"<span class='glyphicon glyphicon-trash'></span>",array('onclick'=>"return confirm('Menghapus ".$b->no_tiket."?')")).'</td>
                          </tr>';
                          $no++;      
                    }
                  ?>
                  </tbody>
                </table>
            </div>
          </div>
          <div class="tab-pane" id="panel4">
          	<div class="form">
          		<h3><strong>Tiket Order Langsung</strong></h3>
                <table id="example4" class="display" width="100%">
                  <thead>
                    <tr>
                      <th rowspan="2">No</th>
                      <th rowspan="2">No Tiket</th>
                      <th rowspan="2">Kepada</th>
                      <th rowspan="2">Work Order</th>
                      <th rowspan="2">Sla</th>
                      <th rowspan="2">Status</th>
                      <th rowspan="2">Tanggal Dibuat</th>
                      <th rowspan="2">Respon Terakhir</th>
                      <th colspan="2">Aksi</th>
                    </tr>
                    <tr>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $no = 1;
                    foreach ($d_order as $b) {
                      echo '<tr>
                            <td>'.$no.'</td>
                            <td>'.$b->no_tiket.'</td>
                            <td>'.$b->kepada.'</td>
                            <td>'.$b->workorder.'</td>
                            <td>'.$b->sla.'</td>
                            <td>'.$b->status.'</td>
                            <td>'.$b->tgl_dibuat.'</td>
                            <td>'.$b->respon_terakhir.'</td>
                            <td>'.anchor('tiket/edit/'.$b->id,"<span class='glyphicon glyphicon-pencil'></span>").'</td>
                            <td>'.anchor('tiket/delete/'.$b->id,"<span class='glyphicon glyphicon-trash'></span>",array('onclick'=>"return confirm('Menghapus ".$b->no_tiket."?')")).'</td>
                          </tr>';
                          $no++;      
                    }
                  ?>
                  </tbody>
                </table>
          	</div>
          </div>
        </div>
     </div>
    </div>
   </div>
 </div>
</body>
</html>