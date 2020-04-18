<html>
<head>
  <script>
	  $(function(){
	    $("#example").dataTable();
	  })
  </script>
  <h2><strong>Data SOP</strong></h2>
</head>
<body>
<?php echo anchor('sop/tambah_sop','<span class="glyphicon glyphicon-plus"></span> Tambah SOP', array('class'=>'btn btn-primary'));?>
<br><br>
  <table id="example" class="table table-striped" width="100%">
    <thead>
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Nama SOP</th>
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
              <td>'.$b->namaSop.'</td>
    					<td>'.$b->namaDepartemen.'</td>
              <td>'.$b->namaUnit.'</td>
              <td>'.anchor('sop/edit/'.$b->id,'<span class="glyphicon glyphicon-pencil"></span>').'</td> 
              <td>'.anchor('sop/delete/'.$b->id,'<span class="glyphicon glyphicon-trash"></span>',array('onclick'=>"return confirm('Menghapus ".$b->namaSop."?')")).'</td>
    				</tr>';
        $no++;    	
    	}
    ?>
    </tbody>
  </table>
  <br><br>
</body>
</html>