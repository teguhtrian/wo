<?php $role=$this->session->userdata('role');?>

<!DOCTYPE html>
<html>
<head>
<!--
<h3><strong>Report Order per Departemen</strong></h3>
<hr>
-->
<link type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet">
<link type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js"></script>
<!--
<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf"></script>
-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
 
<!--
<script type="text/javascript" src="cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
-->

<script type="text/javascript">
  $(function(){
      $("#example").dataTable({
        //"dom": 'T<"clear">lfrtip',
        //tableTools: {
        //  "sSwfPath": "media/swf/copy_csv_xls_pdf.swf"
        //},
        "dom": "Bfrtip",
        "lengthChange": true,
        "buttons": [
          "pdf","excel",
          //{
          //  "text": 'Click Me!',
          //  "action": function ( e, dt, button, config ) {
          //    alert('mission impossible');
              //window.location = '<?php echo base_url("home")?>';
          //  }
         // }
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
        }
      });
        $("#example2").dataTable({
          "dom": "Bfrtip",
          "buttons": [
              "pdf",
              "excel",{
                "extend":"pdfHtml5",
                "title":"Lapor Bro",
                "orientation":'landscape'
              }
              
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
        $("#example3").dataTable({
          "dom": "Bfrtip",
          "buttons": [
              "pdf","excel",
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
        $("#example4").dataTable({
          "dom": "Bfrtip",
          "buttons": [
              "pdf","excel",
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
    });   
</script>
</head>
<!--
<h4><strong><?php echo $namaDept['namaDepartemen'];?></strong></h4>
-->
<body>
<!--
<div class="container-fluid">
  <div class="row">
      <div class="form">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>Report Order Departemen</h3>
          </div>
          <div class="panel-body">
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Unit <span class="caret"></span></button>
                <ul class="dropdown-menu">
                <?php
                  if($this->session->userdata('role')=='staf'||$this->session->userdata('role')=='cs'){
                    foreach ($unit as $b) {
                      echo '<li><a href='.base_url('').'>'.$b->namaUnit.'</a></li>';
                    }
                  }else{

                  }
                ?>
                  <li><a href="#">HTML</a></li>
                  <li><a href="#">CSS</a></li>
                  <li><a href="#">JavaScript</a></li>
                </ul>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
-->
<h3><strong><?php echo $namaDept['namaDepartemen'];?></strong></h3>
<hr>
 <div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="tabbable" id="tab1">
        <ul class="nav nav-tabs">
          <li>
            <a href="#panel1" data-toggle="tab">Layanan Informasi</a>
          </li>
          <li class="active">
            <a href="#panel2" data-toggle="tab">Order Open</a>
          </li>
          <li>
            <a href="#panel3" data-toggle="tab">Order Closed</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane" id="panel1">
            <div class="form">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4><strong>Layanan Informasi</strong></h4>
              </div>
              <div class="panel-body">
                <table id="example" class="display table-bordered compact" cellspacing="0" width="100%">
                  <thead>
                    <th>No</th>
                    <th>No Tiket</th>
                    <th>Waktu</th>
                    <th>Dari</th>
                    <th>Subjek</th>
                    <th>Prioritas</th>
                    <th>Status</th>
                    <th> </th>
                  </thead>
                  <tbody>
                  <?php
                    if(!empty($informasi)){
                      $no=1;
                      foreach ($informasi as $row) {
                        echo '<tr>';
                        echo '<td>'.$no.'</td>';
                        echo '<td>'.anchor('tiket/bacaInfoById/'.$row->id,$row->noTiket).'</td>';
                        echo '<td>'.$row->waktuBuat.'</td>';
                        echo '<td>'.$row->dari.'</td>';
                        echo '<td>'.$row->subjek.'</td>';
                        echo '<td>'.$row->namaPrioritas.'</td>';
                        echo '<td>'.$row->namaJenisStatus.'</td>';
                        echo '<td><a href="'.base_url('tiket/hapus_respon/'.$row->id).'"><span class="glyphicon glyphicon-trash"></span></a></td>';
                        echo '</tr>';
                        $no++;
                      }
                    }
                  ?>
                  </tbody>                  
                </table>
              </div>
              <!--
              <div class="panel-heading">
                <h4><strong>Pesan Pengaduan</strong></h4>
              </div>
              <div class="panel-body">
                <table id="example2" class="display compact nowrap" cellspacing="0" width="100%">
                    <thead>
                      <th>No</th>
                      <th>Waktu</th>
                      <th>Dari</th>
                      <th>Gangguan</th>
                      <th>Prioritas</th>
                      <th>Status</th>
                      <th>Respon Akhir</th>
                      <th></th>
                    </thead>
                  <tbody>
                  <?php
                    if(!empty($pengaduan)){
                      $no=1;
                      foreach ($pengaduan as $row) {
                        echo '<tr>';
                        echo '<td>'.$no.'</td>';
                        echo '<td>'.anchor('tiket/baca_Info/'.$row->id,$row->noTiket).'</td>';
                        echo '<td>'.$row->waktuBuat.'</td>';
                        echo '<td>'.$row->dari.'</td>';
                        echo '<td>'.$row->subjek.'</td>';
                        echo '<td>'.$row->namaPrioritas.'</td>';
                        echo '<td>'.$row->namaJenisStatus.'</td>';
                        echo '<td><a href="'.base_url('tiket/hapus_respon/'.$row->id).'"><span class="glyphicon glyphicon-trash"></span></a></td>';
                        echo '</tr>';
                        $no++;
                      }
                    }
                  ?>
                  </tbody>                  
                </table>
              </div>
              -->
            </div>
            </div>
          </div>
          <div class="tab-pane active" id="panel2">
            <div class="form">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4><strong>Open Order</strong></h4>
                </div>
                <div class="panel-body">
                  <table id="example3" class="display table-bordered compact" cellspacing="0" width="100%">
                    <thead>
                      <th>No</th>
                      <th>No. Tiket</th>
                      <th>Dari</th>
                      <th>SOP</th>
                      <th>Workorder</th>
                      <th>SLA</th>
                      <th>Waktu Buat</th>
                      <th>Respon Terakhir</th>
                      <th>Status Terakhir</th>
                    </thead>
                    <tbody>
                      <?php
                        if(!empty($orderOpen)){
                          $no=1;
						  /*
                          foreach ($orderOpen as $row) {
                            echo '<tr>
                                    <td>'.$no.'</td>
                                    <td>'.anchor('tiket/bacaOrderFwd/'.$row->id,$row->noTiket).'</td>
                                    <td>'.anchor('tiket/reportUser/'.$row->nipp,$row->nama).'</td>
                                    <td>'.$row->namaSop.'</td>
                                    <td>'.$row->namaWo.'</td>
                                    <td>'.$row->namaSla.'</td>
                                    <td>'.$row->waktuBuat.'</td>
                                    <td>'.$row->responAkhir.'</td>
                                    <td>'.$row->namaStatus.'</td>
                                  </tr>';
                            $no++;
                          }
						  */
						  foreach ($orderOpen as $row) {
                            echo '<tr>
                                    <td>'.$no.'</td>
                                    <td>'.anchor('tiket/bacaOrderFwd/'.$row->id,$row->noTiket).'</td>
                                    <td>'.$row->nama.'</td>
                                    <td>'.$row->namaSop.'</td>
                                    <td>'.$row->namaWo.'</td>
                                    <td>'.$row->namaSla.'</td>
                                    <td>'.$row->waktuBuat.'</td>
                                    <td>'.$row->responAkhir.'</td>
                                    <td>'.$row->namaStatus.'</td>
                                  </tr>';
                            $no++;
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="panel3">
            <div class="form">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4><strong>Closed Order</strong></h4>
                </div>
                <div class="panel-body">
                  <table id="example4" class="display table-bordered compact" cellspacing="0" width="100%">
                    <thead>
                      <th>No</th>
                      <th>No. Tiket</th>
                      <th>Dari</th>
                      <th>SOP</th>
                      <th>Workorder</th>
                      <th>SLA</th>
                      <th>Waktu Buat</th>
                      <th>Respon Terakhir</th>
                      <th>Status Terakhir</th>
                    </thead>
                    <tbody>
                      <?php
                        if(!empty($orderClosed)){
                          $no=1;
						  /*
                          foreach ($orderClosed as $row) {
                            echo '<tr>
                                    <td>'.$no.'</td>
                                    <td>'.anchor('tiket/bacaOrderFwd/'.$row->id,$row->noTiket).'</td>
                                    <td>'.anchor('tiket/reportUser/'.$row->nipp,$row->nama).'</td>
                                    <td>'.$row->namaSop.'</td>
                                    <td>'.$row->namaWo.'</td>
                                    <td>'.$row->namaSla.'</td>
                                    <td>'.$row->waktuBuat.'</td>
                                    <td>'.$row->responAkhir.'</td>
                                    <td>'.$row->namaStatus.'</td>
                                  </tr>';
                            $no++;
                          }
						  */
						  foreach ($orderClosed as $row) {
                            echo '<tr>
                                    <td>'.$no.'</td>
                                    <td>'.anchor('tiket/bacaOrderFwd/'.$row->id,$row->noTiket).'</td>
                                    <td>'.$row->nama.'</td>
                                    <td>'.$row->namaSop.'</td>
                                    <td>'.$row->namaWo.'</td>
                                    <td>'.$row->namaSla.'</td>
                                    <td>'.$row->waktuBuat.'</td>
                                    <td>'.$row->responAkhir.'</td>
                                    <td>'.$row->namaStatus.'</td>
                                  </tr>';
                            $no++;
                          }
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
   </div>
 </div>
</body>
</html>