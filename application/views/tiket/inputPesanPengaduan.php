<body>
<h3><strong>Pesan Pengaduan</strong></h3>
<?php echo form_open('tiket/pesanPengaduan', array('onSubmit'=>'return validasi()', 'name'=>'Pengaduan'));?>
<div class="panel panel-default">
<div class="panel-heading"><strong>Tujuan Pengaduan</strong></div>
<div class="panel-body">
<table class="table">
<tr>
	<th width="150">Unit * :</th>
	<td>
	<div class="col-md-6">
	<select class="form-control" id="unit" onchange="tampilDepartemen()" name="unit">
	<option value="0">-- Pilih Unit --</option>
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
	<th width="150">Divisi* :</th>
	<td>
	<div class="col-md-6">
	<select class="form-control" id="departemen" name="departemen">
	<option value="0">-- Pilih Divisi --</option>
	</select>
	</div>
	</td>
</tr>
</table>
</div>
<div class="panel-heading">
	<strong>Data Laporan</strong>
</div>
<div class="panel-body">
<table class="table">
<tr>
	<th width="150">NPA :</th>
	<td>
	<div class="col-md-6">
	<input type="text" class="form-control input-sm" name="npa" id="npa" width="200"></input>
	</td>
</tr>
<tr>
	<th width="150">Nama Pelanggan :</th>
	<td>
	<div class="col-md-6">
	<input type="text" class="form-control input-sm" name="namaPelanggan" id="namaPelanggan" width="200"></input>
	</div>
	</td>
</tr>
<tr>
	<th width="150">Alamat * :</th>
	<td>
	<div class="col-md-6">
	<textarea type="text" class="form-control input-sm" name="alamat" id="alamat"></textarea>
	</div>
	</td>
</tr>
<tr>
	<th width="150">Tanggal Lapor * :</th>
	<td>
	<div class="col-md-6">
		<div class="form-group">
            <div class='input-group date' id='datetimepicker1'>
            	<input type='text' name="waktu" id='waktu' class="form-control" />
                <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
			<!--<input type="text" name="tanggal" id="tanggal" placeholder="dd-mm-yyyy" class="form-control datepicker">-->
		</div>
	</td>
</tr>
<tr>
	<th width="150">Nama Pelapor * :</th>
	<td>
	<div class="col-md-6">
	<input type="text" class="form-control input-sm" id="namaPelapor" name="namaPelapor" width="200"></input>
	</td>
</tr>
<tr>
	<th width="150">Nomor Telp/Handphone :</th>
	<td>
	<div class="col-md-6">
	<input type="text" class="form-control input-sm" id="noHp" name="noHp" width="200"></input>
	</td>
</tr>
<tr>
	<th width="150">No Rumah Depan Rumah :</th>
	<td>
	<div class="col-md-6">
	<input type="text" class="form-control input-sm" id="noDepanRumah" name="noDepanRumah" width="200"></input>
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
	<th width="150">Subjek * :</th>
	<td>
	<div class="col-md-6">
	<select class="form-control" name="gangguan" id="gangguan">
		<option value="">-- Pilih Gangguan --</option>
		<?php
			foreach ($jenisGangguan as $b) {
				echo '<option value="'.$b->namaGangguan.'">'.$b->namaGangguan.'</option>';
			}
		?>
	</select>
	</td>
</tr>
<tr>
	<th width="150">Detail Gangguan * :</th>
	<td>
	<div class="col-md-6">
	<textarea class="form-control input-sm" name="detailGangguan" cols="10" rows="10"></textarea>
	</td>
</tr>
</table>
<table class="table">
	<tr>
	<th width="150">Tingkat Prioritas * :</th>
	<td>
	<div class="col-md-6">
		<select class="form-control" name="prioritas" id="prioritas">
		<option value="0">-- Pilih Prioritas --</option>
		<?php
			foreach ($prioritas as $row) {
				echo '<option value='.$row->id.'>'.$row->namaPrioritas.'</option>';
			}
		?>
		</select>
	</div>
	</td>
</tr>
</table>
<button class="btn btn-primary" type="submit" name="submit">Kirim Tiket</button>
<button class="btn btn-danger" type="cancel" name="cancel">Batal</button>
</div>
</div>

<script type="text/javascript">

$(function(){
   $('#datetimepicker1').datetimepicker({
    	format: 'YYYY-MM-DD HH:mm:ss',
    	//setDate: new Date(),
    	//autoclose: true
      });
});

function tampilDepartemen(){
	var unit = $("#unit").val();
	if(unit != "00"){
		$("#kepala").prop('selectedIndex',0);
		$("#departemen").prop('selectedIndex',0);
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
				$("#departemen").html(html);
			},
			dataType:"html"
		});
	}
}

function validasi(){
	if($("#unit").val()=="00"){
		if($("#departemen").val()=='0'||$("#alamat").val()==''||$("#namaPelanggan").val()==''||$("#waktu").val()==''||$("#gangguan").val()==''||$("#detailGangguan").val()==''||$("#prioritas").val()==''){
			alert('Silahkan melengkapi informasi yang memiliki tanda *');
			return false;
		}
	}else{
		if($("#alamat").val()==''||$("#namaPelanggan").val()==''||$("#waktu").val()==''||$("#gangguan").val()==''||$("#detailGangguan").val()==''||$("#prioritas").val()==''){
			alert('Silahkan melengkapi informasi yang memiliki tanda *');
			return false;
		}
	}
}

/*
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