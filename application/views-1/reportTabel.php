<head>
<script type="text/javascript">
	$(function(){
	    $("#example").dataTable({
	    "responsive":true,
	    "ordering": false,
	    "info": false,
	    "searching":false,
	    "fixedColumns":true,
	    //"lengthMenu":["10","15","All"],
	    "columnDefs":[	
	    	{ "width": "1", "targets":0 },
	    	{ "width": "20%", "targets":1 },
	    	{ "width": "20%", "targets":2 },
	    	{ "width": "20%", "targets":3 },
	    	{ "width": "20%", "targets":4 },
	    	{ "width": "20%", "targets":5 },
	    	{ "width": "20%", "targets":6 }
	    ],
	    //"scrollY": "100px",
    	"scrollX": false,
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
	<table id="example" class="display compact nowrap table-bordered" width="100%">
		<thead>
			<tr>
				<th>No</th>
				<th>No. Tiket</th>
				<th>Waktu Diteruskan</th>
				<th>Waktu Ditugaskan</th>
				<th>Waktu Dikerjakan</th>
				<th>Waktu Diverifikasi</th>
				<th>Waktu Ditutup</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if(!empty($report)){
					//echo 'ada isi boy';
					$no=1;
					$preNoTik=null;
					foreach ($report as $row) {
						echo '<tr>';
						echo $row->noTiket==$preNoTik?'<td></td>':'<td>'.$no.'</td>';
						//echo '<td>'.$no.'</td>';
						echo $row->noTiket==$preNoTik?'<td>&nbsp</td>':'<td>'.$row->noTiket.'</td>';
						//echo '<td>'.$row->noTiket.'</td>';
						if($row->idStatus==2){
							echo'<td>'.$row->waktuBuat.'</td>';
							echo'<td>&nbsp</td>';
							echo'<td>&nbsp</td>';
							echo'<td>&nbsp</td>';
							echo'<td>&nbsp</td>';
						}elseif($row->idStatus==3){
							echo'<td>&nbsp</td>';
							echo'<td>'.$row->waktuBuat.'</td>';
							echo'<td>&nbsp</td>';
							echo'<td>&nbsp</td>';
							echo'<td>&nbsp</td>';
						}elseif($row->idStatus==4){
							echo'<td>&nbsp</td>';
							echo'<td>&nbsp</td>';
							echo'<td>'.$row->waktuBuat.'</td>';
							echo'<td>&nbsp</td>';
							echo'<td>&nbsp</td>';
						}elseif($row->idStatus==5){
							echo'<td>&nbsp</td>';
							echo'<td>&nbsp</td>';
							echo'<td>&nbsp</td>';
							echo'<td>'.$row->waktuBuat.'</td>';
							echo'<td>&nbsp</td>';
						}elseif($row->idStatus==6){
							echo'<td>&nbsp</td>';
							echo'<td>&nbsp</td>';
							echo'<td>&nbsp</td>';
							echo'<td>&nbsp</td>';
							echo'<td>'.$row->waktuBuat.'</td>';
						}
						if($row->noTiket!=$preNoTik){
							$no++;
						}
						$preNoTik=$row->noTiket;
					}
				}
			?>
		</tbody>
	</table>
</body>