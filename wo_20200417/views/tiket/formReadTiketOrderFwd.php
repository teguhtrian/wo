<?php $notiket=$data['no_tiket']?>
<body>
	<div class="panel panel-default">
	<div class="panel-heading">
		<h3 align="center"><strong>Tiket Order<br>#<?php echo $data['no_tiket']?></strong></h3>
	</div>
	<div class="panel-body">
	<table class="table" width="940">
	<tr class="">
		<td width="50%">
			<table class="">
				<tr>
					<th>Dasar Perintah</th>
					<td><strong>:</strong> <?php echo anchor($this->session->userdata('role').'/tiket/baca_info_notiket/'.str_replace("/", "-", $data['ref_tiket']),$data['ref_tiket']) //lengkapin boy?></td>
				</tr>
				<tr>
					<th width="150">Dari</th>
					<td><strong>:</strong> <?php echo $data['dari']?></td>
				</tr>
				<tr>
					<th width="150">Kepada</th>
					<td><strong>:</strong> <?php echo $data['kepada']?></td>
				</tr>
				<tr>
					<th rowspan="2">Diteruskan ke</th>
					<td><strong>:</strong> <?php echo $data['petugas']?></td>
				</tr>
			</table>
		</td>
		<td>
			<table class="">
				<tr>
					<th width="150">Tanggal Buat</th>
					<td><strong>:</strong> <?php echo $data['tgl_buat']?></td>
				</tr>
				<tr>
					<th>Jenis SOP</th>
					<td><strong>:</strong> <?php echo $data['nama_sop']?></td>
				</tr>
				<tr>
					<th>Jenis Work Order</th>
					<td><strong>:</strong> <?php echo $data['nama_wo']?></td>
				</tr>
				<tr>
					<th>SLA Plan</th>
					<td><strong>:</strong> <?php echo $data['nama_sla']?></td>
				</tr>
				<tr>
					<th>Respon Terakhir</th>
					<td><strong>:</strong> <?php echo $data['respon_akhir']?></td>
				</tr>
				<tr>
					<th>Tanggal Ditutup</th>
					<td><strong>:</strong> <?php echo $data['tgl_tutup']?></td>
				</tr>
			</table>
		</td>
	</tr>
	</table>
		<strong>Status Tiket</strong><br>
		<table class="table table-bordered">
		<tr>
			<th width="100">Oleh :</th>
			<td width="100"><?php echo $data['dari']?></td>
			<td width="100"><?php echo $data['kepada']?></td>
			<td width="100"><?php echo $data['petugas']?></td>
		</tr>
		<tr>
			<th width="100">Status :</th>
			<td width="100"><?php echo $data['status_eks1']?></td>
			<td width="100"><?php echo $data['status_eks2']?></td>
			<td width="100"><?php echo $data['status_eks3']?></td>
		</tr>
		<tr>
			<th width="100">Tanggal :</th>
			<td width="100"><?php echo $data['tgl_close1']?></td>
			<td width="100"><?php echo $data['tgl_close2']?></td>
			<td width="100"><?php echo $data['tgl_close3']?></td>
		</tr>
		</table>
		<button class="btn btn-primary" data-toggle="modal" data-target="#modal_form" onclick="tampilPetugas()" <?php echo $this->session->userdata('role')!='kbag'?'style="display:none"':'';?>>Pilih Petugas dan Jenis WO</button>
	</div>
	</div>
	<h3 align="left"><strong>Respon Tiket :</strong></h3>
	<div class="panel panel-default">
	<?php 
		if(!empty($respon)){
			foreach($respon as $data){ ?>
				<div class="panel-heading">
					<table width="50%">
						<td width="150"><?php echo $data->tgl_buat?></td>
						<td>| Dibuat oleh: <?php echo $data->nama_dpn." ".$data->nama_blkg?></td>
					</table>
				</div>
				<div class="panel-body">
						<?php echo nl2br($data->komentar)?>
						<br>
						<?php 
							if($data->path_gbr==TRUE){
								$gambar=$data->path_gbr.$data->nama_gbr.$data->ext_gbr;
								echo "<br><br><strong>Lampiran:</strong><br><a href=".base_url($gambar)."><img src=".base_url($gambar)." width=\"100\" height=\"100\"></a><br><br>";
								echo "<a href=".base_url($this->session->userdata('role')."/tiket/download_gbr/".str_replace("/", "-", $gambar))."><button class=\"btn btn-default\">Download</button></a>";
							}
						?>
				</div>			
			<?php
			}
			echo '</div>';	
		}else{?>
			<div class="panel panel-default">
			<div class="panel-heading"></div>
			<div class="panel-body">
				Respon tidak ada			
			</div>
			</div>
		<?php	
		}
	?>
<br><br>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="tabbable" id="tab1">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#panel1" data-toggle="tab">Respon Tiket</a>
					</li>
					<li>
						<a href="#panel2" data-toggle="tab">Teruskan ke Bagian Lain</a>
					</li>
					<li>
						<a href="#panel3" data-toggle="tab">Assign ke Pegawai</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="panel1">
						<div class="form">
							<h3><strong>Respon Tiket</strong></h3><hr/>
							<div class="col-md-6">
							<?php echo form_open_multipart($this->session->userdata('role').'/tiket/tambah_respon/'.str_replace("/", "-", $notiket), array('onSubmit'=>'return validasiRespon()','name'=>'formRespon'));?>
							<div class="form-group">
								<label for="inputDetail">
									Pesan
								</label>
								<textarea class="form-control" name="pesan" id="pesan" type="text" cols="100" rows="10"></textarea>
							</div>
							<div class="form-group">
								<label for="inputFile">
									Upload File
								</label>
								<input name="uploadFile" id="uploadFile" type="file" onclick="notice()" />
								<?php
									echo $this->session->flashdata('error');
								?>
								*Foto yang melebihi 5 MB tidak akan disimpan oleh sistem
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="cb_close" value="yes" onclick="cekClose(this)">Closed Tiket</input>
								</label>
							</div>
							<div class="form-group" id="date" hidden>
							<label><strong>Waktu (Tanggal dan Jam):</strong></label>
					            <div class='input-group date' id='datetimepicker1'>
					            	<input type='text' name="tanggal" id='tanggal' class="form-control" />
					                <span class="input-group-addon">
					                <span class="glyphicon glyphicon-calendar"></span>
					                </span>
					            </div>
					        </div>
							<button type="submit" class="btn btn-primary">
								Submit
							</button>
							<button type="button" class="btn btn-danger">
								Cancel
							</button><br><br>
							<?php echo form_close();?>
							</div>
						</div>
					</div>
<!--
					<div class="tab-pane" id="panel2">
						<div class="form">
							<h3><strong>Teruskan Tiket</strong></h3><hr/>
							<div class="col-md-6">
							<?php echo form_open_multipart('tiket/addKomentar');?>
							<div class="form-group">
								<label for="inputSubjek">
									Pilih Unit
								</label>
								<select class="form-control" id="id_unit" required>
								<option value="-1">-- Pilih Unit --</option>
								<?php
									foreach($unit as $b){
										echo '<option value="'.$b->kode_unit.'">'.$b->nama_unit.'</option>';
									}
								?>
								</select>
							</div>
							<div class="form-group">
								<label for="inputDetail">
									Pilih Divisi / Bagian
								</label>
								<select class="form-control" id="id_dept">
								<option value="-1">-- Pilih Bagian --</option>
								<?php
									foreach($dept as $b){
										echo '<option value="'.$b->id_dept.'">'.$b->nama_dept.'</option>';
									}
								?>
								</select>
							</div>
							<div class="form-group">
								<label for="inputSubjek">
									Subjek Pesan
								</label>
								<input class="form-control" id="inputSubjek" type="text"></input>
							</div>
							<div class="form-group">
								<label for="inputDetail">
									Detail Pesan
								</label>
								<textarea class="form-control" id="inputDetail" type="text" cols="100" rows="10"></textarea>
							</div>							
							<div class="form-group">
								<label for="inputFile">
									Upload File
								</label>
								<input name="uploadFile" id="inputFile" type="file"/>
							</div><hr/>
							<button type="submit" class="btn btn-primary">
								Submit
							</button>
							<button type="button" class="btn btn-danger">
								Cancel
							</button>
							<?php echo form_close();?>
							</div>
						</div>
					</div>

					<div class="tab-pane" id="panel3">
						<div class="form">
							<h3><strong>Assign Tiket</strong></h3><hr/>
							<div class="col-md-6">
							<?php echo form_open_multipart('tiket/addKomentar');?>
							<div class="form-group">
								<label for="inputSubjek">
									Pilih Unit
								</label>
								<select class="form-control" id="id_unit" required>
								<option value="-1">-- Pilih Unit --</option>
								<?php
									foreach($unit as $b){
										echo '<option value="'.$b->kode_unit.'">'.$b->nama_unit.'</option>';
									}
								?>
								</select>
							</div>
							<div class="form-group">
								<label for="inputDetail">
									Pilih Divisi / Bagian
								</label>
								<select class="form-control" id="id_dept">
								<option value="-1">-- Pilih Bagian --</option>
								<?php
									foreach($dept as $b){
										echo '<option value="'.$b->id_dept.'">'.$b->nama_dept.'</option>';
									}
								?>
								</select>
							</div>
							<div class="form-group">
								<label for="inputDetail">
									Pilih Pegawai
								</label>
								<select class="form-control" id="id_dept">
								<option value="-1">-- Pilih Pegawai --</option>
								<?php
									foreach($pegt as $b){
										echo '<option value="'.$b->id_peg.'">'.$b->nama_peg.'</option>';
									}
								?>
								</select>
							</div>
							<div class="form-group">
								<label for="inputSubjek">
									Subjek Pesan
								</label>
								<input class="form-control" id="inputSubjek" type="text"></input>
							</div>
							<div class="form-group">
								<label for="inputDetail">
									Detail Pesan
								</label>
								<textarea class="form-control" id="inputDetail" type="text" cols="100" rows="10"></textarea>
							</div>							
							<div class="form-group">
								<label for="inputFile">
									Upload File
								</label>
								<input name="uploadFile" id="inputFile" type="file"/>
							</div><hr/>
							<button type="submit" class="btn btn-primary">
								Submit
							</button>
							<button type="button" class="btn btn-danger">
								Cancel
							</button>
							<?php echo form_close();?>
							</div>
						</div>
					</div>
				</div>
-->
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Pilih Detail WO</h3>
			</div>
			<div class="modal-body form">
				<?php echo form_open($this->session->userdata('role').'/tiket/perbarui_uorder/'.str_replace('/', '-', $notiket),array('onSubmit'=>'return validasi()','class'=>'form-horizontal', 'id'=>'form'));?>
				<input type="hidden" value="" name="id"></input>
				<div class="form-body">
					<div class="form-group">
						<label class="control-label col-md-3">Petugas :</label>
						<div class="col-md-9">
							<select class="form-control" name="petugas" id="petugas" onchange="tampilSOP()">
								<option value="0">-- Pilih Pegawai --</option>
								</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">SOP :</label>
						<div class="col-md-9">
							<select class="form-control" name="sop" id="sop" onchange="tampilWO()">
								<option value="0">-- Pilih SOP --</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Work Order :</label>
						<div class="col-md-9">
							<select class="form-control" name="wo" id="wo">
								<option value="0">-- Pilih Work Order --</option>
							</select>
						</div>
					</div>
					<div class="form">
					<div class="form-group">
						<label class="control-label col-md-3">Pesan :</label>
						<div class="col-md-9">
						<textarea class="form-control" name="pesan2" id="pesan2" type="text" cols="100" rows="10"></textarea>
						</div>
					</div>
					</div>											
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id="btnSave" class="btn btn-primary">Tugaskan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="cancelbtn()">Cancel</button>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>
</body>
<script type="text/javascript">
//pilihan dengan role: kcab dan kdiv

function notice(){
	alert("Foto tidak boleh melebihi 5 MB");
}

function cekClose(checkbox){
	var role=<?php echo $role="'".$this->session->userdata('role')."'"?>;
	if(checkbox.checked && role!='staf'){
		$("#date").show();
		//$("#tanggal").val('');
	}else{
		$("#date").hide();
		//$("#tanggal").val('');
	}
}

$(function(){
   $('#datetimepicker1').datetimepicker({
    	format: 'DD-MM-YYYY HH:mm:ss',
    	"defaultDate": new Date(),
    	//"autoclose": true
      });
});

function tampilPetugas(){
	$("#sop").prop('selectedIndex',0);
	$("#wo").prop('selectedIndex',0);
	$("#inputSubjek2").val("");
	$("#inputDetail2").val("");
	var idDept = <?php echo $this->session->userdata('id_departemen')?>;
	var role = <?php echo $role="'".$this->session->userdata('role')."'"?>;
	//alert(role);
	$.ajax({
		url:"<?php echo base_url();?>"+role+"/tiket/pilih_petugas/"+idDept,
		success: function(html){
			$("#petugas").html(html);
		},
		dataType:"html"
	})
}

function tampilSOP(){
	var idDept = <?php echo $this->session->userdata('id_departemen')?>;
	var role = <?php echo $role="'".$this->session->userdata('role')."'"?>;
	//alert(role);
	$.ajax({
		url:"<?php echo base_url();?>"+role+"/tiket/pilih_sop/"+idDept,
		success: function(html){
			$("#sop").html(html);
		},
		dataType:"html"
	})
}

function tampilWO(){
	var idsop = $('#sop').val();
	var role = <?php echo $role="'".$this->session->userdata('role')."'"?>;
	//alert(role);
	$.ajax({
		url:"<?php echo base_url();?>"+role+"/tiket/pilih_wo/"+idsop,
		success: function(html){
			$("#wo").html(html);
		},
		dataType:"html"
	})
}

function validasi(){
	var petugas=$("#petugas").val();
	var sop=$("#sop").val();
	var wo=$("#wo").val();
	var pesan=$("#pesan2").val();

	if(petugas=='0'){
		alert('Lengkapi pilihan petugas');
		return false;
	}else if(sop=='0'||sop==null||wo=='0'||wo==null){
		alert('Lengkapi detail Order anda');
		return false;
	}else if(pesan==''){
		alert('Lengkapi kolom pesan');
		return false;
	}
}

function validasiRespon(){
	var pesan=$('#pesan').val();
	if(pesan==''||pesan==null){
		alert('Silahkan mengisi pesan respon');
		return false;
	}
}

</script>