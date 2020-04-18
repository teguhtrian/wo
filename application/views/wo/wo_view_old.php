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
        <th>No</th>
        <th>Work Order</th>
        <th>Jenis WO</th>
        <th>SOP</th>
        <th>SLA</th>
        <th>Departemen</th>
        <th>Unit</th>
        <th>Aksi</th>
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
              <td>'.anchor('wo/edit/'.$b->id,'Edit').' '.anchor('wo/delete/'.$b->id,'Delete').'</td>
    				</tr>';
        $no++;    	
    	}
    ?>
    </tbody>
  </table>
  <br><br>
</body>
</html>