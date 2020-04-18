<h3><strong>Input Order</strong></h3>
<h4><strong><?php echo $this->session->userdata('namaDepartemen');?></strong></h4><hr>
<?php echo form_open('tiket/orderBaruByPeg', array('onSubmit'=>'return valOrder()', 'name'=>'formInfo'))?>
<div class="panel panel-default">
<div class="panel-heading">
	<h4><strong>Detail Order</strong></h4>
</div>
<div class="panel-body">
	<div class="col-sm-12">
		<div class="col-sm-6">
		<h4><strong>Pilih Order</strong></h4>
				<label>SOP :</label><br>
				<select class="form-control" id="sop" name="sop" onchange="tampilWO();tampilSla()">
					<option value="0">-- Pilih SOP --</option>
					<?php
						$no=1;
						foreach ($sop as $row) {
							echo'
							<option value="'.$row->id.'">'.$row->namaSop.'</option>
							';
							$no++;
						}
					?>
				</select>
				<br><label>Work Order :</label><br>
				<select class="form-control" id="wo" name="wo">
					<option value="0">-- Pilih Work Order --</option>
				</select>
				<br><label>Sla :</label><br>
				<select class="form-control" id="sla" name="sla">
					<option value="0">-- Pilih SLA --</option>
				</select>
			<br>
		</div>
		<div class="col-sm-6">
			<label>Pesan (Opsional): </label><br>
			<textarea class="form-control" name="pesan" id="pesan" type="text" cols="100" rows="10"></textarea></textarea>
		</div>
	</div>
</div>
<div class="panel-heading">
	<h4><strong>Detail Tujuan</strong></h4>
</div>
<div class="panel-body">
<div class="col-sm-12">
	<div class="col-sm-6">
	<label>Unit :</label><br>
		<select class="form-control" name="unit" id="unit" onchange="tampilDepartemen()" disabled="">
			<option value="0">-- Pilih Unit --</option>';
			<?php
			foreach ($unit as $unit){
				if($this->session->userdata('kodeUnit')==$unit->kodeUnit){
				echo '<option value="'.$unit->kodeUnit.'" selected>'.$unit->namaUnit.'</option>';
				echo '<input name="unit" value="'.$unit->kodeUnit.'" hidden></input>';
				}
			}
			?>
		</select><br>
	<label>Divisi/Bagian :</label>
		<select class="form-control" name="dept" id="dept" onchange="tampilPeg()" disabled>
			<option value="0">-- Pilih Divisi/Bagian --</option>
			<?php
			foreach ($departemen as $b) {
				if($this->session->userdata('idDepartemen')==$b->id){
				echo '<option value="'.$b->idDepartemen.'" selected>'.$b->namaDepartemen.'</option>';
				echo '<input name="departemen" value="'.$b->id.'" hidden></input>';
			}
			}
			?>
		</select>		
	<br>
<hr>
	<label>Pegawai :</label>
	<select class="form-control" name="pegawai" disabled="">
		<option value="0">-- Pilih Petugas --</option>
		<?php
			foreach ($pegawai as $row) {
				if($this->session->userdata('nipp')==$row->nipp){
					echo '<option value="'.$row->nipp.'" selected>'.$row->nama.'</option>';
					echo '<input name="pegawai" value="'.$b->nipp.'" hidden></input>';
				}
			}
		?>
	</select>
	<br>
	<label>Diketahui Oleh :</label>
	<select class="form-control" name="atasan" disabled="">
		<?php
			echo '<option value="'.$atasan['nipp'].'" selected>'.$atasan['nama'].'</option>';
			echo '<input name="atasan" value="'.$atasan['nipp'].'" hidden></input>';
		?>
	</select>
	<br>
</div>	
</div>

	<hr><br>
	<button type="submit" id="submit" name="submit" class="btn btn-primary">Buat Order</button>
	<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
</div>
</div>
<?php echo form_close();?>

<script type="text/javascript">
	var countera=1;
	var counterb=1;
	var limit=5;

function resetPilihan(){
	$("#sop").prop('selectedIndex',0);
	$("#wo").prop('selectedIndex',0);
	$("#sla").prop('selectedIndex',0);
	$("#pegawai").prop('selectedIndex',0);
	$("#peg0").prop('selectedIndex',0);

	counterb=1;
	var loop=1;
	while(loop<5){
		//alert('apaajaboyeh');
		$("#peg-"+loop+"").hide();
		$("#peg"+loop+"").prop("disabled", true);
		$("#peg"+loop).prop('selectedIndex',0);
		loop++;
	}
}

function addPegawai(){
	if(counterb==limit){
		alert("Jumlah maksimum sebanyak 5");
	}else{
		//alert('jumlah '+counterb);
		$("#peg-"+counterb).show();
		$("#peg"+counterb).prop("disabled", false);
		counterb++;
	}
}

function addPetugas(kepada){
	if(counterb==limit){
		alert("Melebihi batas maksimum.");
	}else{
		var ptgs=document.createElement('tr');
		ptgs.innerHTML='<tr><th width="150">Kepada Petugas '+(counterb+1)+' :</th><td><div class="col-xs-6"><select class="form-control" name="petugas[]" id="petugas"><option value="-1">-- Pilih Pegawai --</option></select></div></td></tr>';
		document.getElementById(kepada).appendChild(ptgs);
		counterb++;
	}
}

function tampilDepartemen(){
	//get var php string
	//var role= <?php echo $data='"'.$this->session->userdata('role').'"';?>;
	//alert(role);
	var unit = $("#unit").val();
	//alert(unit);
	if(unit != "00"){
		$("#kepala").prop('selectedIndex',0);
		$("#dept").prop('selectedIndex',0);
		$("#divisi").hide();
		$("#bagian").show();
		$.ajax({
			//url:"<?php echo base_url();?>tiket/pilih_kepala/"+unit+"",
			//success: function(html){
			//	$("#kepala").html(html);
			url:"<?php echo base_url();?>departemen/pilih_dept/"+unit+"",
			success: function(html){
				$("#dept2").html(html);
			},
			dataType:"html"
		});
	}else{
		$("#kepala").prop('selectedIndex',0);
		$("#divisi").show();
		$("#bagian").hide();
		$.ajax({
			url:"<?php echo base_url();?>tiket/pilih_divisi/"+unit+"",
			success: function(html){
				$("#dept").html(html);
			},
			dataType:"html"
		});
	}
}

function tampilSla(){
	var idDept = <?php echo $role="'".$this->session->userdata('idDepartemen')."'"?>;
	//alert(idDept);
	$.ajax({
		url:"<?php echo base_url();?>tiket/pilihSlaByDept/"+idDept+"",
		success: function(html){
			$("#sla").html(html);
		},
		dataType:"html"
	})
}

function tampilWO(){
	var idsop = $('#sop').val();
	//alert(idsop);
	$.ajax({
		url:"<?php echo base_url();?>/tiket/pilih_wo/"+idsop+"",
		success: function(html){
			$("#wo").html(html);
		},
		dataType:"html"
	})
}

function valOrder(){
	var sop=$('#sop').val();
	var wo=$('#wo').val();
	var sla=$('#sla').val();
	/*
	var pegawai = [];
	for (i=0; i<5; i++) {
		if($("#peg"+i).val()!="0"){
			pegawai.push($("#peg"+i).val());
		}
	}

	//check duplicate nipp on entry process
	var peg_sort = pegawai.slice().sort();
	var results = [];
	for (var i=0; i<pegawai.length-1; i++) {
	    if (peg_sort[i + 1] == peg_sort[i]) {
	        results.push(peg_sort[i]);
	    }
	}
	//alert(results.length);//return false;

	//alert(pegawai);return false;
	*/
	if(sop=='0'||wo=='0'||sla=='0'){
		alert('Lengkapi detail order!');
		//resetPilihan();
		return false;
	}else if(pegawai=='0'||pegawai==''){
		alert('Silahkan pilih pegawai!');
		//resetPilihan();
		return false;
	}else if(results!=''){ //cek apakah hasil duplicate kosong?
		alert('Tidak dapat memilih pegawai yang sama!');
		//resetPilihan();
		return false;
	}
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
	var sop=$("#sop").val();
	var wo=$("#wo").val();
	var sla=$("#sla").val();

	if(kepala=='-1'){
		alert('Lengkapi tujuan tiket anda');
		return false;
	}else if(subjek==''||subjek==null||detail==''||detail==null){
		alert('Lengkapi detail tiket anda');
		return false;
	}else if(prior=='-1'){
		alert('Silahkan pilih tingkat prioritas');
		return false;
	}
}

</script>