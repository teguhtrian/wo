<html>
<head>
  <script>
	  $(function(){
	    $("#example").dataTable();
	  })
  </script>
  <h2><strong>Data Work Order</strong></h2>
</head>
<body>
<?php echo anchor('wo/tambah_wo','<span class="glyphicon glyphicon-plus"></span> Tambah WO', array('class'=>'btn btn-primary'));?>
<br><br>
  <table id="example" class="table table-striped" width="100%">
    <thead>
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Work Order</th>
        <th rowspan="2">Jenis WO</th>
        <th rowspan="2">SOP</th>
        <th rowspan="2">SLA</th>
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
              <td>'.$b->namaWo.'</td>
              <td>'.$b->jenisWo.'</td>
              <td>'.$b->namaSop.'</td>
              <td>'.$b->namaSla.'</td>
    					<td>'.$b->namaDepartemen.'</td>
              <td>'.$b->namaUnit.'</td>
              <td>'.anchor('wo/edit/'.$b->id,"<span class='glyphicon glyphicon-pencil'></span>").'</td> 
              <td>'.anchor('wo/delete/'.$b->id,'<span class="glyphicon glyphicon-trash"></span>',array('onclick'=>"return confirm('Menghapus ".$b->namaWo."?')")).'</td>
    				</tr>';
        $no++;    	
    	}
    ?>
    </tbody>
  </table>
  <br><br>
</body>
</html>