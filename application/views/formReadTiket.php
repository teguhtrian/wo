<head>
<script type="text/javascript">
	$(function(){
	    $("#example").dataTable({
	    //"responsive":true,
	    "ordering": false,
	    "info": false,
	    "searching":false,
	    "fixedColumns":true,
	    "columnDefs":[	
	    	{ "width": "1", "targets":0 },
	    	{ "width": "1", "targets":2 }
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

	    $("#example2").dataTable({
	    "ordering": false,
	    "info": false,
	    "searching":false,
	    "fixedColumns":true,
	    "columnDefs":[	
	    	{ "width": "1", "targets":0 },
	    	{ "width": "250px", "targets":1 },
	    	{ "width": "500px", "targets":2 }
	    ],
	    //"scrollY": "100px",
    	//"scrollX": false,
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
<div class="panel panel-default">
<div class="panel-heading">
<center><h3><strong>Tiket Order<br>#00000</strong></h3></center>
</div>
<div class="panel-body">
<strong><h3><strong>Detail Tiket</strong></h3></strong>
<table class="table" width="940">
	<tr class="">
		<td width="50%">
			<table class="">
				<tr>
					<th>Dari :</th>
					<td>Nama Kepala Cabang/Bagian/Pegawai</td>
				</tr>
				<tr>
					<th width="150">Kepada :</th>
					<td>Nama Kepala Cabang/Bagian/Pegawai</td>
				</tr>
				<tr>
					<th>Diteruskan ke :</th>
					<td>Nama Bagian</td>
				</tr>
				<tr>
					<th>Jenis SOP/WO :</th>
					<td>Nama Layanan SOP/WO</td>
				</tr>
			</table>
		</td>
		<td>
			<table class="">
				<tr>
					<th width="150">Dibuat Tgl :</th>
					<td>Tanggal Dibuat</td>
				</tr>
				<tr>
					<th>SLA Plan :</th>
					<td>Lama Waktu SLA</td>
				</tr>
				<tr>
					<th>Respon Terakhir :</th>
					<td>Tanggal Respon</td>
				</tr>
				<tr>
					<th>Tanggal Ditutup :</th>
					<td>Tanggal Tiket</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<hr>
<strong><h3><strong>History Order</strong></h3></strong>
<div class="col-md-3">
	sss
</div>
<table align="left" id="example" class="display compact nowrap" cellspacing="0" width="50%">
<thead>
	<tr>
        <th>No</th>
        <th>No Tiket</th>
        <th>Dari</th>
        <th>Subjek</th>	
	</tr>
</thead>
<tbody>
	<tr>
		<td>test</td>
		<td>test</td>
		<td>test</td>
		<td>test</td>
	</tr>
	<tr>
		<td>test</td>
		<td>test</td>
		<td>test</td>
		<td>test</td>
	</tr>
	<tr>
		<td>test</td>
		<td>test</td>
		<td>test</td>
		<td>test</td>
	</tr>
</tbody>
<tbody>
	<tr>
		<td></td>
	</tr>
</tbody>
</table>	
</div>
</div>

<div class="panel panel-default">
<div class="panel-heading">
	<h3><strong>Respon Order</strong></h3>
</div>
<div class="panel-body">
<table id="example2" class="display">
	<thead>
		<th>No</th>
		<th>Pengirim</th>
		<th>Pesan</th>
		<th>Lampiran</th>
	</thead>
	<tbody>
		<td>1</td>
		<td>Budi<br><?php echo date('d/m/Y H:i:s');?></td>
		<td>Pesan apa Bro!?</td>
		<td><button>Download</button></td>
	</tbody>
</table>
</div>
</div>