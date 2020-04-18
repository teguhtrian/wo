<body>
<h3><strong>Pesan Pengaduan</strong></h3>
<?php echo form_open('tiket/tiket_pengaduan', array('onSubmit'=>'return validasi()', 'name'=>'formPeng'));?>
<div class="panel panel-default">
<div class="panel-heading">
	<strong>Data Laporan</strong>
</div>
<div class="panel-body">
<table class="table">
<tr>
	<th width="150">NPA :</th>
	<td>
	<div class="col-xs-6">
	<input type="text" class="form-control input-sm" name="npa" id="npa" width="200"></input>
	</td>
</tr>
<tr>
	<th width="150">Nama Pelanggan :</th>
	<td>
	<div class="col-xs-6">
	<input type="text" class="form-control input-sm" name="nama_pelanggan" id="nama_pelanggan" width="200"></input>
	</div>
	</td>
</tr>
<tr>
	<th width="150">Alamat :</th>
	<td>
	<div class="col-xs-6">
	<textarea type="text" class="form-control input-sm" name="alamat" id="alamat"></textarea>
	</div>
	</td>
</tr>
<tr>
	<th width="150">Tanggal Lapor :</th>
	<td>
	<div class="col-xs-6">
		<div class="form-group">
            <div class='input-group date' id='datetimepicker1'>
            	<input type='text' id='tanggal' class="form-control" />
                <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
			<!--<input type="text" name="tanggal" id="tanggal" placeholder="dd-mm-yyyy" class="form-control datepicker">-->
		</div>
	</td>
</tr>
<tr>
	<th width="150">Nama Pelapor :</th>
	<td>
	<div class="col-xs-6">
	<input type="text" class="form-control input-sm" id="nama_pelapor" width="200"></input>
	</td>
</tr>
</table>
</div>
<div class="panel-heading">
	<strong>Jenis Gangguan </strong>
</div>
<div class="panel-body">
<table class="table">
	<tr>
		<td class="col-md-2">
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="1">Air Mati</label>
		</div>
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="2">Air Kecil</label>
		</div>
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="3">Air Keruh</label>
		</div>
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="4">Air Berbau</label>
		</div>
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="5">Air Tidak Normal</label>
		</div>
		</td>

		<td class="col-md-2">
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="6">Pipa Dinas Bocor</label>
		</div>
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="7">Pipa Distribusi Bocor</label>
		</div>
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="8">Pipa Transmisi Bocor</label>
		</div>
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="9">Sekitar Meter/Kopling Bocor</label>
		</div>
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="10">Stop Kran Tidak Berfungsi</label>
		</div>
		</td>

		<td class="col-md-2">
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="11">Meter Mati</label>
		</div>
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="12">Meter Labil</label>
		</div>
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="13">Meter Ragu</label>
		</div>
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="14">Meter Hilang</label>
		</div>
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="15">Pindah Letak Meter</label>
		</div>
		</td>

		<td class="col-md-2">
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="16">Kaca Meter Kabur</label>
		</div>
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="17">Kaca Meter Pecah</label>
		</div>
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="18">Segel Meter/Kopling Putus</label>
		</div>
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="19">Stand Meter Tidak Dicatat</label>
		</div>
		<div class="radio">
			<label><input type="radio" name="jenis_g" value="20">Pengaman Meter Tidak Ada</label>
		</div>
		</td>
	</tr>
	<tr>
		<td class="col-md-2">
		<div class="radio">
			<label><input type="radio" id="rt" name="jenis_g" value="21">Lain-Lain</label>
			<input class="form-control" id="teks" type="text" name="jenis_g"></input>
		</div>
		</td>
	</tr>
</table>
<table class="table">
	<tr>
	<th width="150">Tingkat Prioritas :</th>
	<td>
	<div class="col-xs-6">
		<select class="form-control" id="id_pri">
		<option value="-1">-- Pilih Prioritas --</option>
		<option value="Rendah">Rendah</option>
		<option value="Normal">Normal</option>
		<option value="Tinggi">Tinggi</option>
		<option value="Emergency ">Emergency</option>
		</select>
	</div>
	</td>
</tr>
</table>
</div>
<div class="panel-heading"><strong>Diteruskan Kepada</strong></div>
<div class="panel-body">
<table class="table">
<tr>
	<th width="150">Unit * :</th>
	<td>
	<div class="col-xs-6">
	<select class="form-control" id="unit" onchange="tampilDepartemen()">
	<option value="-1">-- Pilih Unit --</option>
	<?php
		foreach($unit as $b){
			echo '<option value="'.$b->kodeUnit.'">'.$b->namaUnit.'</option>';
		}
	?>
	</select>		
	</div>
	</td>
</tr>
<tr id="divisi" hidden>
	<th width="150">Divisi / Bagian :</th>
	<td>
	<div class="col-xs-6">
	<select class="form-control" id="id_dept" onchange="tampilKdiv()">
	<option value="-1">-- Pilih Bagian --</option>
	</select>
	</div>
	</td>
</tr>
<tr>
	<th width="150">Kepada :</th>
	<td>
	<div class="col-xs-6">
	<select class="form-control" id="kepala">
	<option value="-1">-- Pilih Pegawai --</option>
	</select>
	</div>
	</td>
</tr>
</table>
<button class="btn btn-primary" type="submit" name="submit">Kirim Tiket</button>
<button class="btn btn-primary" type="cancel" name="cancel">Batal</button>
<button id="test" onclick="cekNilai()">testing</button>
</div>
</div>

<script type="text/javascript">

$(function(){
   $('#datetimepicker1').datetimepicker({
    	format: 'DD/MM/YYYY HH:mm',
    	//setDate: new Date(),
    	//autoclose: true
      });
});

function cekNilai(){
	var value=$("#tanggal").val();
	alert(value);
}

function tampilDepartemen(){
	var unit = $("#unit").val();
	if(unit != "00"){
		$("#kepala").prop('selectedIndex',0);
		$("#id_dept").prop('selectedIndex',0);
		$("#divisi").hide();
		$.ajax({
			url:"<?php echo base_url();?>tiket/pilih_kepala/"+unit+"",
			success: function(html){
				$("#kepala").html(html);
			},
			dataType:"html"
		});
	}else{
		$("#kepala").prop('selectedIndex',0);
		$("#divisi").show();
		$.ajax({
			url:"<?php echo base_url();?>tiket/pilih_divisi/"+unit+"",
			success: function(html){
				$("#id_dept").html(html);
			},
			dataType:"html"
		});
	}
}

function tampilKdiv(){
	var unit = $("#unit").val();
	var id_dept = $("#id_dept").val();

	$.ajax({
		url:"<?php echo base_url();?>tiket/pilih_kepala/"+unit+"/"+id_dept+"",
		success: function(html){
			$("#kepala").html(html);
		},
		dataType:"html"
	});
}
/*
	$(function(){
		$("#rt").click(function(){
			if($("#rt").prop('checked')==true){
				$("#teks").prop("hidden",true);
			}
			if($("#rt").prop('checked')==false){
				$("#teks").prop("hidden",false);
			}			
		});

		$("#test").click(function(){
			alert($("#rt").prop('checked'));
			alert($("#teks").attr());
		});		
	});
*/
</script>
</body>