<?php 
$role=$this->session->userdata('role');
echo form_open($role.'/tiket/edit',array('onload'=>'tes()', 'onSubmit'=>'return validasi()', 'name'=>'formInfo'));
?>
<input type="text" name="id_tiket" hidden="hidden" value="<?php echo $this->uri->segment(4);?>"></input>
<div class="panel panel-default">
<div class="panel-heading">
	<strong>Kirim Kepada</strong>
</div>
<div class="panel-body">
<table class="table">
<tr>
	<th width="150">Unit * :</th>
	<td>
	<div class="col-xs-6">
	<select class="form-control" name="unit" id="unit" onchange="tampilDepartemen()">
	<option value="-1">-- Pilih Unit --</option>
    <?php
        foreach($unit as $b){
            echo '<option value="'.$b->kode_unit.'" ';
            echo $record['kode_unit']==$b->kode_unit?'selected':'';
            echo '>'.$b->nama_unit.'</option>';
        }
    ?>
	</select>		
	</div>
	</td>
</tr>
<tr id="divisi" hidden>
	<th width="150">Divisi :</th>
	<td>
	<div class="col-xs-6">
	<select class="form-control" name="id_dept" id="id_dept" onchange="tampilKdiv()">
	<option value="-1">-- Pilih Divisi --</option>
	</select>
	</div>
	</td>
</tr>
<tr>
	<th width="150">Kepada :</th>
	<td>
	<div class="col-xs-6">
	<select class="form-control" name="kepala" id="kepala">
	<option value="-1">-- Pilih Pegawai --</option>
	</select>
	</div>
	</td>
</tr>
</table>
</div>
<div class="panel-heading">
	<strong>Detail Tiket Informasi: </strong>Silahkan deskripsikan Informasi Anda
</div>
<div class="panel-body">
<table class="table">
<tr>
	<th width="150">Subjek Informasi :</th>
	<td>
	<div class="col-xs-6">
	<input type="text" class="form-control input-sm" name="subjek" id="subjek" width="200" value="<?php echo $record['subjek']?>"></input>		
	</div>
	</td>	
</tr>
<tr>
	<th width="150">Detail Informasi :</th>
	<td>
	<div class="col-xs-12">
	<textarea type="text" class="form-control input-sm" cols="10" rows="10" name="detail" id="detail" width="200"><?php echo $record['detail']?></textarea>
	</div>
	</td>	
</tr>
<tr>
	<th width="150">Tingkat Prioritas :</th>
	<td>
	<div class="col-xs-6">
	<select class="form-control" name="id_pri" id="id_pri">
	<option value="-1" selected>-- Pilih Prioritas --</option>
	<option value="Rendah"<?php echo $record['prioritas']=='Rendah'?'selected':'';?>>Rendah</option>
	<option value="Normal"<?php echo $record['prioritas']=='Normal'?'selected':'';?>>Normal</option>
	<option value="Tinggi"<?php echo $record['prioritas']=='Tinggi'?'selected':'';?>>Tinggi</option>
	<option value="Emergency"<?php echo $record['prioritas']=='Emergency'?'selected':'';?>>Emergency</option>
	</select>
	</div>
	</td>
</tr>
<tr>
	<th width="150">Lampiran (opsional): </th> 
	<td>
	<div class="col-xs-6">
		<?php echo $error;?>

		<input type="file" name="userfile" size="20"></input>
	</div>
	</td>
</tr>
</table>
<button class="btn btn-primary" type="submit" name="submit">Kirim Tiket</button>
<input class="btn btn-primary" type="button" value="Kembali" onclick="history.go(-1);" name="kembali">
<?php echo form_close()?>
</div>
</div>

<button onclick="tes()">tekan saya</button>
<script type="text/javascript">

function tes(){
	var unit = <?php echo $record['kode_unit']?>;
	var id_dept = <?php echo $record['id_departemen']?>;
	var kepada = "<?php echo $record['kepada']?>";
	alert(kepada);
}

function init(){
	var unit = "<?php echo $record['kode_unit']?>";
	var id_dept = "<?php echo $record['id_departemen']?>";
	alert(unit);
	if(unit != "00"){
		//$("#kepala").prop('selectedIndex',0);
		//$("#id_dept").prop('selectedIndex',0);
		$("#divisi").hide();
		$.ajax({
			url:"<?php echo base_url();?>sa/tiket/pilih_kepala/"+unit+"/"+id_dept+"",
			success: function(html){
				$("#kepala").html(html);
			},
			dataType:"html"
		});
	}else{
		//$("#kepala").prop('selectedIndex',0);
		$("#divisi").show();
		$.ajax({
			url:"<?php echo base_url();?>sa/tiket/pilih_kepala/"+unit+"/"+id_dept+"",
			success: function(html){
				$("#kepala").html(html);
			},
			dataType:"html"
		});
	}
}

function tampilDepartemen(){
	var unit = $("#unit").val();
	if(unit != "00"){
		$("#kepala").prop('selectedIndex',0);
		$("#id_dept").prop('selectedIndex',0);
		$("#divisi").hide();
		$.ajax({
			url:"<?php echo base_url();?>sa/tiket/pilih_kepala/"+unit+"",
			success: function(html){
				$("#kepala").html(html);
			},
			dataType:"html"
		});
	}else{
		$("#kepala").prop('selectedIndex',0);
		$("#divisi").show();
		$.ajax({
			url:"<?php echo base_url();?>sa/tiket/pilih_divisi/"+unit+"",
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
		url:"<?php echo base_url();?>sa/tiket/pilih_kepala/"+unit+"/"+id_dept+"",
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
	var kepala=$("#kepala").val();
	var subjek=$("#subjek").val();
	var detail=$("#detail").val();
	var prior=$("#id_pri").val();

	if(kepala=='-1'){
		alert('Lengkapi tujuan tiket anda');
		return false;
	}else if(subjek==''||subjek==null||detail==''||detail==null){
		alert('Lengkapi detail surat anda');
		return false;
	}else if(prior=='-1'){
		alert('Silahkan pilih tingkat prioritas');
		return false;
	}
}

</script>
</body>