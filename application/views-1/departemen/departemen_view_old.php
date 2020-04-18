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
  <h2><strong>Data Departemen</strong></h2>
</head>
<body>
<?php echo anchor('departemen/tambah_departemen','<span class="glyphicon glyphicon-plus"></span> Tambah Departemen', array('class'=>'btn btn-primary'));?> 
<br><br>
  <table id="example" class="display" width="100%">
    <thead>
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Nama Departemen</th>
        <th rowspan="2">Unit</th>
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
              <td>'.$b->namaDepartemen.'</td>
    					<td>'.$b->namaUnit.'</td>
              <td>'.anchor('departemen/edit/'.$b->id,"<span class='glyphicon glyphicon-pencil'></span>").'</td> 
              <td>'.anchor('departemen/delete/'.$b->id,'<span class="glyphicon glyphicon-trash"></span>',array('onclick'=>"return confirm('Menghapus ".$b->namaDepartemen."?')")).'</td>
    				</tr>';
        $no++;    	
    	}
    ?>
    </tbody>
  </table>
  <br><br>
</body>
</html>