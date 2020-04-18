<html>
<head>
  <script>
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
    })
  </script>
  <h2><strong>Data Unit</strong></h2>
</head>
<body>
<?php echo anchor('unit/tambah_unit','<span class="glyphicon glyphicon-plus"></span> Tambah Unit',array('class'=>'btn btn-primary'));?>
<br><br>
  <table id="example" class="display" width="100%">
    <thead>
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Kode</th>
        <th rowspan="2">Nama</th>
        <th rowspan="2">Alamat</th>
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

    	foreach ($data as $b) {
    		echo '<tr>
    					<td>'.$no.'</td>
              <td>'.$b->kodeUnit.'</td>
    					<td>'.$b->namaUnit.'</td>
    					<td>'.$b->alamatUnit.'</td>
              <td>'.anchor('unit/edit/'.$b->id,'<span class="glyphicon glyphicon-pencil"></span>').'</td> 
              <td>'.anchor('unit/delete/'.$b->id,'<span class="glyphicon glyphicon-trash"></span>',array('onclick'=>"return confirm('Menghapus ".$b->namaUnit."?')")).'</td>
    				</tr>';
        $no++;    	
    	}
    ?>
    </tbody>
  </table>
  <br><br>
</body>
</html>