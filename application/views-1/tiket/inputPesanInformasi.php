<body>
<h3><strong>Pesan Informasi</strong></h3>
<?php echo form_open_multipart('tiket/pesanInformasi', array('onSubmit'=>'return validasi()', 'name'=>'formInfo'))?>
<div class="panel panel-default">
<div class="panel-heading">
	<strong>Tujuan Informasi</strong>
</div>
<div class="panel-body">
<table class="table">
<tr>
	<th width="150">Unit * :</th>
	<td>
	<div class="col-md-6">
	<select class="form-control" name="unit" id="unit" onchange="tampilDepartemen()">
	<option value="-1">-- Pilih Unit --</option>
	<?php
		foreach ($unit as $unit){
			echo '<option value="'.$unit->kodeUnit.'">'.$unit->namaUnit.'</option>';
		}
	?>
	</select>		
	</div>
	</td>
</tr>
<tr id="divisi" hidden>
	<th width="150">Divisi :</th>
	<td>
	<div class="col-md-6">
	<select class="form-control" name="departemen" id="departemen">
	<option value="0">-- Pilih Divisi --</option>
	</select>
	</div>
	</td>
</tr>
<!--
<tr>
	<th width="150">Kepada :</th>
	<td>
	<div class="col-md-6">
	<select class="form-control" name="kepala" id="kepala">
	<option value="0">-- Pilih Pegawai --</option>
	</select>
	</div>
	</td>
</tr>
-->
</table>
</div>
<div class="panel-heading">
	<strong>Detail Pesan Informasi: </strong>Silahkan deskripsikan Informasi Anda
</div>
<div class="panel-body">
<table class="table">
<tr>
	<th width="150">Subjek Informasi :</th>
	<td>
	<div class="col-md-6">
	<input type="text" class="form-control input-sm" name="subjek" id="subjek" width="200"></input>		
	</div>
	</td>	
</tr>
<tr>
	<th width="150">Detail Informasi :</th>
	<td>
	<div class="col-md-6">
	<textarea type="text" class="form-control input-sm" cols="10" rows="10" name="detail" id="detail"></textarea>
	</div>
	</td>	
</tr>
<tr>
	<th width="150">Tingkat Prioritas :</th>
	<td>
	<div class="col-md-6">
	<select class="form-control" name="prioritas" id="prioritas">
		<option value="0">-- Pilih Prioritas --</option>
		<?php
			foreach ($prioritas as $b) {
				echo '<option value="'.$b->id.'">'.$b->namaPrioritas.'</option>';
			}
		?>
	</select>
	</div>
	</td>
</tr>
<tr>
	<th width="150">Lampiran (opsional): </th> 
	<td>
	<div class="col-md-6">
		<?php echo $error;?>
		<input type="file" name="uploadFile" id="uploadFile" size="20"></input>
		</form>
	</div>
	</td>
</tr>
</table>
<button class="btn btn-primary" type="submit" name="submit">Kirim Tiket</button>
<button class="btn btn-primary" type="cancel" name="cancel">Batal</button>
</form>
</div>
</div>
<script type="text/javascript">

function tampilDepartemen(){
	//get var php string
	//var role= <?php echo $data='"'.$this->session->userdata('role').'"';?>;
	//alert(role);
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
		//$("#kepala").prop('selectedIndex',0);
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


function validasi(){
	/*
	var val=document.forms["formInfo"]["kepala"].value;
	if(val=='-1'){
		alert('Pilih Unit Tujuan !');
		return false;
	}*/
	//var kepala=$("#kepala").val();
	var subjek=$("#subjek").val();
	var detail=$("#detail").val();
	var prior=$("#prioritas").val();
	var file=$("#uploadFile")[0]; //lihat ukuran file dari array ke-0 (HTML DOM Object = document.getElementById('IdHTML'))

	if(subjek==''||subjek==null||detail==''||detail==null){
		alert('Lengkapi detail tiket anda');
		return false;
	}else if(prior=='0'){
		alert('Silahkan pilih tingkat prioritas');
		return false;
	}else if(file.files[0].size>'5000000'){
		//cek size file > 5MB?
		alert('File tidak boleh melebihi 5 MB');
		return false;
	}
}

</script>
</body>