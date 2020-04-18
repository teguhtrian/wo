<html>
<head>
  <script>
	  $(function(){
	    $("#example").dataTable();
	  })
  </script>
  <h2><strong>Data SLA/SPM (Standard Pelayanan Minimum)</strong></h2>
</head>
<body>
<?php echo anchor('sla/tambah_sla','<span class="glyphicon glyphicon-plus"></span> Tambah SLA', array('class'=>'btn btn-primary'));?>
<br><br>
  <table id="example" class="table table-striped" width="100%">
    <thead>
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Nama SLA</th>
        <th rowspan="2">Nilai SLA</th>
        <th rowspan="2">Departemen</th>
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
              <td>'.$b->namaSla.'</td>
              <td>'.$b->nilaiSla.' detik</td>
              <td>'.$b->namaDepartemen.'</td>
              <td>'.$b->namaUnit.'</td>
              <td>'.anchor('sla/edit/'.$b->id,'<span class="glyphicon glyphicon-pencil"></span>').'</td> 
              <td>'.anchor('sla/delete/'.$b->id,'<span class="glyphicon glyphicon-trash"></span>',array('onclick'=>"return confirm('Menghapus ".$b->namaSla."?')")).'</td>
    				</tr>';
        $no++;    	
    	}
    ?>
    </tbody>
  </table>
  <br><br>
</body>
</html>