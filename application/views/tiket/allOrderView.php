<?php $role=$this->session->userdata('role');?>
<!DOCTYPE html>
<html>
<head>
<!--
<h3><strong>Report Order per Departemen</strong></h3>
<hr>
-->
<script type="text/javascript">
  $(function(){
      $("#example").dataTable({
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
<!--
<h4><strong><?php echo $namaDept['namaDepartemen'];?></strong></h4>
-->
<body>
            <div class="form">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4><strong>Semua Order</strong></h4>
                </div>
                <div class="panel-body">
                  <table id="example4" class="display compact" cellspacing="0" width="100%">
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
                        if(!empty($order)){
                          $no=1;
                          foreach ($order as $row) {
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