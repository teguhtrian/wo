<head>
	
</head>
<body>
	<div class="panel panel-default">
	<div class="panel-heading">
		<h4><strong>Tiket Order #000000</strong><h4>
	</div>
	<div class="panel-body">
	<table class="table " width="940">
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
		<strong>Status Tiket</strong><br>
		<table class="table table-bordered">
		<tr>
			<th width="100">Oleh :</th>
			<td width="100">Eskalasi 1</td>
			<td width="100">Eskalasi 2</td>
			<td width="100">Eskalasi 3</td>
		</tr>
		<tr>
			<th width="100">Status :</th>
			<td width="100">Status 1</td>
			<td width="100">Status 2</td>
			<td width="100">Status 3</td>
		</tr>
		<tr>
			<th width="100">Tanggal :</th>
			<td width="100">Tanggal 1</td>
			<td width="100">Tanggal 2</td>
			<td width="100">Tanggal 3</td>
		</tr>
		</table>
		<button class="btn btn-default" data-toggle="modal" data-target="#modal_form">Assign Staf</button>
		<button class="btn btn-default" type="button" id="ab">Assign Staf 2</button>
	</div>
	</div>
	<h4><strong>Respon Tiket :</strong></h4>
	<div class="panel panel-default">
	<?php 
		if(!empty($komentar)){
			foreach($komentar as $data){ ?>
				<div class="panel-heading">
					<table width="50%">
						<td width="100"><?php echo $data->tanggal?></td>
						<td>| Dibuat oleh: <?php echo $data->fullname?></td>
					</table>
				</div>
				<div class="panel-body">
						<?php echo $data->isi?>
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
							<?php echo form_open_multipart('tiket/addKomentar');?>
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
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox"></input>Tutup Tiket
								</label>
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
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Assign Pegawai</h3>
			</div>
			<div class="modal-body form">
				<form action="#" id="form" class="form-horizontal">
					<input type="hidden" value="" name="id"></input>
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Bagian :</label>
							<div class="col-md-9">
								<select class="form-control" id="id_bagian">
									<option value="-1">-- Pilih Bagian --</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Pegawai :</label>
							<div class="col-md-9">
								<select class="form-control" id="nipp_pegawai">
									<option value="-1">-- Pilih Pegawai --</option>
								</select>
							</div>
						</div>						
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="" class="btn btn-primary">Assign</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>
</body>