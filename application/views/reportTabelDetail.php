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
				<th rowspan="2">No. Tiket</th>
				<th rowspan="2">Work Order</th>
				<th rowspan="2" width="65px">SLA</th>
				<th rowspan="2">Sumber Informasi</th>				
				<th rowspan="2">Aksi</th>
				<th rowspan="2">Waktu</th>
				<th colspan="2">Lama Waktu</th>
				<th rowspan="2">Selisih SLA</th>
			</tr>
			<tr>
				<th>Per Aksi</th>
				<th>Keseluruhan</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if(!empty($report)){
					//cek db
					$no=1;
					$preNoTik=null;
					$prePerson=null;
					$preTime=null;
					$begTime=null;
					$finTime=null;
					foreach ($report as $row) {
						echo '<tr>';
						echo $row->noTiket==$preNoTik?'<td>&nbsp</td>':'<td>'.$no.'</td>';
						echo $row->noTiket==$preNoTik?'<td>&nbsp</td>':'<td>'.anchor('tiket/bacaOrderFwd/'.$row->idOrder,$row->noTiket).'</td>';
						echo $row->noTiket==$preNoTik?'<td>&nbsp</td>':'<td>'.$row->namaWo.'</td>';
						echo $row->noTiket==$preNoTik?'<td>&nbsp</td>':'<td>'.$row->namaSla.'</td>';
						echo $row->nama==$prePerson&&$row->noTiket==$preNoTik?'<td>&nbsp</td>':'<td>'.$row->nama.'</td>';
						echo '<td>'.$row->keterangan.'</td>';
						echo '<td>'.$row->waktuBuat.'</td>';
						//cek waktu tiap aksi pada tiket yang sama
						if($row->noTiket==$preNoTik){
							$time1=new DateTime($preTime);
							$time2=new DateTime($row->waktuBuat);
							$interval=$time1->diff($time2);
							//print_r($interval);
							echo '<td>'.$interval->d.' hari, '.$interval->h.' jam '.$interval->i.' menit '.$interval->s.' detik</td>';
						}else{
							echo '<td>&nbsp</td>';
						}
						//cek keseluruhan waktu
						if($row->noTiket==$preNoTik){
							if($row->idStatus==4||$row->idStatus==5){
								$time1=new DateTime($begTime);
								$time2=new DateTime($row->waktuBuat);
								$interval=$time1->diff($time2);
								echo '<td>'.$interval->d.' hari, '.$interval->h.' jam '.$interval->i.' menit '.$interval->s.' detik</td>';	
							}else{
								echo '<td>&nbsp</td>';
							}							
						}else{
							$begTime=$row->waktuBuat;
							echo '<td>&nbsp</td>';
						}

						if($row->noTiket==$preNoTik){
							if($row->idStatus==4||$row->idStatus==5){
								$time1=new DateTime($begTime);
								$time2=new DateTime($row->waktuBuat);
								//$interval=$time1->diff($time2);
								//print_r((strtotime($row->waktuBuat)-strtotime($begTime))-($row->nilaiSla));
								//echo '<td>'.$interval->d.' hari, '.$interval->h.' jam '.$interval->i.' menit '.$interval->s.' detik</td>';
								$selisih=(strtotime($row->waktuBuat)-strtotime($begTime))-($row->nilaiSla);
								if($selisih==$row->nilaiSla){
									echo '<td> T = '.$selisih.'</td>';
								}elseif($selisih>$row->nilaiSla){
									echo '<td> T > '.$selisih.'</td>';
								}elseif($selisih<$row->nilaiSla){
									echo '<td> T < '.$selisih.'</td>';
								}
							}else{
								echo '<td>&nbsp</td>';
							}							
						}else{
							$begTime=$row->waktuBuat;
							echo '<td>&nbsp</td>';
						}						
						//tutup tabel
						echo '</tr>';
						//tambah no indeks jika no berubah
						if($row->noTiket!=$preNoTik){
							$no++;
						}
						//simpan notik sebelumnya
						$preNoTik=$row->noTiket;
						//cek nama sumber informasi
						if($row->nama!=$prePerson){
							$prePerson=$row->nama;
						}
						$preTime=$row->waktuBuat; //simpan waktu sebelum
					};
				}
/*
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
*/
			?>
		</tbody>
	</table>
</body>