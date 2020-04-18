<head>
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
    });   
</script>
</head>
<body>
  <div class="form">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4><strong>Layanan Informasi</strong></h4>
      </div>
      <div class="panel-body">
      <h4><strong><?php echo $unit['namaUnit']?></strong></h4><hr>
      <table id="example" class="display compact" cellspacing="0" width="100%">
      <thead>
        <th>No</th>
        <th>Waktu Buat</th>
        <th>Nomor LI</th>
        <th>Dari</th>
        <th>Unit Kerja Asal</th>
        <th>Unit Kerja Tujuan</th>
        <th>Subjek</th>
        <th>Prioritas</th>
        <th>Status</th>
      </thead>
      <tbody>
      <?php
        if(!empty($li)){
          $no=1;
          foreach ($li as $row) {
            echo '<tr>
                  <td>'.$no.'</td>
                  <td>'.$row->waktuBuat.'</td>';
            if($row->jenisInformasi==1){
              echo '<td>'.anchor('tiket/bacaInfoById/'.$row->id,$row->noTiket).'</td>';
            }else{
              echo '<td>'.anchor('tiket/bacaPengaduanById/'.$row->id,$row->noTiket).'</td>';
            }
            //echo '<td>'.anchor('tiket/reportUser/'.$row->nipp,$row->dari).'</td>
            //<td>'.$row->unitAsal.'</td>';
			echo '<td>'.$row->dari.'</td>
            <td>'.$row->unitAsal.'</td>';
			
            if($row->kodeUnitTujuan=='00'){
              echo '<td>'.$row->namaDepartemen.'</td>';
            }else{
              echo '<td>'.$row->unitTujuan.'</td>';
            }
            echo '<td>'.$row->subjek.'</td>
            <td>'.$row->namaPrioritas.'</td>
            <td>'.$row->namaJenisStatus.'</td>
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
</body>