<body>
<h3><strong>Open Tiket Order</strong></h3>
<div class="panel panel-default">
<div class="panel-heading">
	<strong>Data Tiket</strong>
</div>
<div class="panel-body">
<table class="table">
<tr>
	<th width="150">Dasar Perintah :</th>
	<td>
	<div class="col-xs-6">
	Nama atau No Surat Memo/informasi/pengaduan
	</div>
	</td>
</tr>
<tr>
	<th width="150">Dari :</th>
	<td>
	<div class="col-xs-6">
	Nama Kepala Cabang
	</div>
	</td>
</tr>
<tr>
	<th width="150">Divisi / Bagian :</th>
	<td>
	<div class="col-xs-6">
	<select class="form-control" id="id_dept">
	<option value="-1">-- Pilih Bagian --</option>
	<?php
		foreach($dept as $b){
			echo '<option value="'.$b->id_dept.'">'.$b->nama_dept.'</option>';
		}
	?>
	</select>
	</div>
	</td>
</tr>
<tr>
	<th width="150">Kepada :</th>
	<td>
	<div class="col-xs-6">
	<select class="form-control" id="nipp_peg">
	<option value="-1">-- Pilih Pegawai --</option>
	<?php
		foreach($peg as $b){
			echo '<option value="'.$b->nipp.'">'.$b->nama_peg.'</option>';
		}
	?>
	</select>
	</div>
	</td>
</tr>
<tr>
	<th width="150">SOP :</th>
	<td>
	<div class="col-xs-6">
	<select class="form-control" id="id_sop">
	<option value="-1">-- Pilih SOP --</option>
	<?php
		foreach($sop as $b){
			echo '<option value="'.$b->id_sop.'">'.$b->nama_sop.'</option>';
		}
	?>
	</select>
	</div>
	</td>
</tr>
<tr>
	<th width="150">Work Order :</th>
	<td>
	<div class="col-xs-6">
	<select class="form-control" id="id_wo">
	<option value="-1">-- Pilih WO --</option>
	<?php
		foreach($wo as $b){
			echo '<option value="'.$b->id_wo.'">'.$b->nama_wo.'</option>';
		}
	?>
	</select>
	</div>
	</td>
</tr>
<tr>
	<th width="150">SLA :</th>
	<td>
	<div class="col-xs-6">
		<input class="form-control" id="nilaiSla" disabled=""></input>
	</div>
	</td>	
</tr>
</table>
</div>
<div class="panel-heading">
	<strong>Pesan</strong>
</div>
<div class="panel-body">
<table class="table">
<tr>
	<th width="150">Subjek Pesan :</th>
	<td>
	<div class="col-xs-6">
	<input type="text" class="form-control input-sm" id="subjek" width="200"></input>		
	</div>
	</td>	
</tr>
<tr>
	<th width="150">Detail Pesan :</th>
	<td>
	<div class="col-xs-12">
	<textarea type="text" class="form-control input-sm" cols="10" rows="10" id="detail" width="200"></textarea>
	</div>
	</td>	
</tr>
</table>
<button class="btn btn-primary" type="submit" name="submit">Buat Tiket</button>
<button class="btn btn-primary" type="cancel" name="cancel">Batal</button>
</div>
</div>
</div>
</body>