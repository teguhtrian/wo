	<h4><strong>Tiket Informasi <br> #<?php echo $data['noTiket'];?></strong></h4>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><strong>Tujuan Tiket Memo</strong></h4>
		</div>
		<div class="panel-body">
			<table class="table table-striped">
				<tr>
					<th width="150">Unit :</th>
					<td><?php echo $data['namaUnit'];?></td>
				</tr>
				<tr>
					<th>Kepada :</th>
					<td><?php echo $data['kepada'];?></td>
				</tr>
			</table>
		</div>
		<div class="panel-heading">
			<h4><strong>Detail Tiket Memo</strong></h4>
		</div>
		<div class="panel-body">
		<table class="table table-condensed" width="100%">
		<tr class="">
			<td width="50%">
				<table class="table table-condensed" width="100%">
				<tr>
					<th width="150">Status :</th>
					<td><?php echo $data['status'];?></td>
				</tr>
				<tr>
					<th>Pembuat Laporan :</th>
					<td><?php echo $data['dari']; ?></td>
				</tr>
				<tr>
					<th>Prioritas :</th>
					<td><?php echo $data['prioritas'];?></td>
				</tr>					
				</table>
			</td>
			<td>
				dudududu
			</td>
		</tr>
		</table><hr>
		<table class="table">
			<tr>
				<th>Subjek :</th>
				<td><?php echo $data['subjek'];?></td>
			</tr>
			<tr>
				<th>Pesan :</th>
				<td><p><?php echo nl2br($data['detail']);?></p></td>			
			</tr>
		</table>
			<div class="btn-group">
				<button class="btn btn-primary  btn-md" data-toggle="modal" data-target="#modal_form" <?php echo $this->session->userdata('role')!='kcab'?'style="display:none"':'';?>>Teruskan Sebagai Tiket Order</button>
				<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modal_form2" >Tutup Pesan Informasi</button>			
			</div>
			<button class="btn btn-danger" onclick="history.go(-1)">Kembali</button>
		</div>
	</div>

<div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Pilih Bagian</h3>
			</div>
			<div class="modal-body form">
			<?php echo form_open('tiket/tiket_undirOrder/'.$this->uri->segment(3),array('class'=>'form-horizontal', 'id'=>'form'));?>
					<input type="hidden" value="<?php echo $data['id'];?>" name="id"></input>
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Bagian :</label>
							<div class="col-md-9">
								<select class="form-control" name="departemen" id="departemen" onchange="tampilKbag()">
									<option value="-1">-- Pilih Bagian --</option>
									<?php
										foreach($bagian as $b){
											echo '<option value="'.$b->id_departemen.'">'.$b->nama_departemen.'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Pegawai :</label>
							<div class="col-md-9">
								<select class="form-control" name="kbag" id="kbag">
									<option value="-1">-- Pilih Pegawai --</option>
								</select>
							</div>
						</div>						
					</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id="submit" name="submit" class="btn btn-primary">Buat Tiket Order</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_form2" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Tutup Pesan Informasi</h3>
			</div>
			<div class="modal-body form">
			<?php echo form_open('tiket/tiket_undirOrder/'.$this->uri->segment(3),array('class'=>'form-horizontal', 'id'=>'form'));?>
					<input type="hidden" value="<?php echo $data['id'];?>" name="id"></input>
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Bagian :</label>
							<div class="col-md-9">
								<select class="form-control" name="departemen" id="departemen" onchange="tampilKbag()">
									<option value="-1">-- Pilih Bagian --</option>
									<?php
										foreach($bagian as $b){
											echo '<option value="'.$b->id_departemen.'">'.$b->nama_departemen.'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Pegawai :</label>
							<div class="col-md-9">
								<select class="form-control" name="kbag" id="kbag">
									<option value="-1">-- Pilih Pegawai --</option>
								</select>
							</div>
						</div>						
					</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id="submit" name="submit" class="btn btn-primary">Buat Tiket Order</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>

<script type="text/javascript">
//pilihan dengan role: kcab dan kdiv
function tampilKbag(){
	var role= <?php echo $role= '"'.$this->session->userdata('role').'"'?>;
	var idDept = $('#departemen').val();
	//alert(idDept);
	$.ajax({
		url:"<?php echo base_url();?>tiket/pilih_bagian/"+idDept+"",
		success: function(html){
			$("#kbag").html(html);
		},
		dataType:"html"
	});
}

</script>