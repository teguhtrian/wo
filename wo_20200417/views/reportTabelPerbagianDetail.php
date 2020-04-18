<head>
<script type="text/javascript">
	$(function(){
	    $("#example").dataTable({
	    "responsive":true,
	    "ordering": false,
	    "info": false,
	    "searching":false,
	    "fixedColumns":true,
	    "lengthMenu":["10","15","All"],
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
	<table class="table table-bordered" width="100%">
		<thead>
			<tr>
				<th rowspan="2">No</th>
				<th rowspan="2">Nama</th>
				<th rowspan="2">Tanggal</th>
				<th rowspan="2">Work Order</th>
				<th colspan="3">Volume</th>
				<th colspan="2">SLA</th>
			</tr>
			<tr>
				<th width="50px">Nama Item</th>
				<th>Jumlah</th>
				<th>Satuan</th>
				<th>Waktu Selesai</th>
				<th>Target</th>
			</tr>
		</thead>
		<tbody>
		<?php
			//print_r($report);die;
			if(!empty($report)){
				//parsing data query ke tabel
				//beri nilai default pada variabel awal
				$iterasi1=0;
				$iterasi2=0;
				$noUrut=1;
				$preNoUrut=null;
				$preName=null;
				$preDate=null;
				$preIdOrder=null;
				$preWo=null;
				$preDari=null;

				//print_r(count($report));die;
				//print_r($report[$iterasi1]);die;
				//buat perulangan sesuai jumlah array report
				while($iterasi1<count($report)) {
					//parsing objek pada masing-masing array report
					//print_r($report[$iterasi1]);die;
					//print_r(count($report[$iterasi1]));die;
					while($iterasi2<count($report[$iterasi1])){
						//print_r(count($report[$iterasi1]));
						//print_r($report[$iterasi1][$iterasi2]['dari']);die;
						$tanggal=date('d-M-Y', strtotime($report[$iterasi1][$iterasi2]['waktuBuat']));
						//BUKA ROW
						echo "<tr>";
						//NO URUT
						echo $report[$iterasi1][$iterasi2]['dari']==$preDari?'<td>&nbsp</td>':'<td>'.$noUrut.'</td>';
						//NAMA
						echo $report[$iterasi1][$iterasi2]['dari']==$preDari?'<td>&nbsp</td>':'<td>'.$report[$iterasi1][$iterasi2]['nama'].' '.$report[$iterasi1][$iterasi2]['dari'].'</td>';
						//TANGGAL
						echo $tanggal==$preDate?'<td>&nbsp</td>':'<td>'.$tanggal.'</td>';
						//WORK ORDER
						echo $report[$iterasi1][$iterasi2]['idOrder']==$preIdOrder && $tanggal==$preDate?'<td>&nbsp</td>':'<td>'.$report[$iterasi1][$iterasi2]['namaWo'].'</td>';
						//VOLUME
						//NAMA ITEM
						echo '<td>'.$report[$iterasi1][$iterasi2]['namaItem'].'</td>';
						//JUMLAH
						echo '<td>'.$report[$iterasi1][$iterasi2]['jumlah'].'</td>';
						//SATUAN
						echo '<td>'.$report[$iterasi1][$iterasi2]['namaSatuan'].'</td>';
						//SLA
						//LAMA WAKTU
						//echo $report[$iterasi1][$iterasi2]['idOrder']==$preIdOrder && $tanggal==$preDate?'<td>&nbsp</td>':'<td>'.$report[$iterasi1][$iterasi2]['jam'].' Jam '.$report[$iterasi1][$iterasi2]['menit'].' Menit'.'</td>';
						if($report[$iterasi1][$iterasi2]['idOrder']==$preIdOrder && $tanggal==$preDate){
						echo '<td></td>';
						}else{
							//$htmlContent.='<td>'.$report[$iterasi1][$iterasi2]['jam'].' Jam '.$report[$iterasi1][$iterasi2]['menit'].' Menit'.'</td>';
							
							$timeCreated=$report[$iterasi1][$iterasi2]['waktuBuat'];
							$timeClosed=$report[$iterasi1][$iterasi2]['waktuTutup'];
							$time1=new DateTime($timeCreated);
							$time2=new DateTime($timeClosed);
							$interval=$time1->diff($time2);
							echo '<td>'.$interval->d.' hari, '.$interval->h.' jam '.$interval->i.' menit '.$interval->s.' detik</td>';

						}
						//TARGET
						echo $report[$iterasi1][$iterasi2]['idOrder']==$preIdOrder && $tanggal==$preDate?'<td>&nbsp</td>':'<td>'.$report[$iterasi1][$iterasi2]['namaSla'].'</td>';
						//TUTUP ROW
						echo "</tr>";

						//simpan data sebelumnya
						$preIdOrder=$report[$iterasi1][$iterasi2]['idOrder'];
						$preWo=$report[$iterasi1][$iterasi2]['idWo'];
						$preDate=$tanggal;
						$preDari=$report[$iterasi1][$iterasi2]['dari'];
						$iterasi2++;
					}
					$noUrut++;
					$iterasi1++;
					$iterasi2=0;
				}
			}else{
				echo "Data Kosong";
			};
		?>
		</tbody>
	</table>
</body>