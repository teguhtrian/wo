<body>
<h3><strong>Tiket Informasi</strong></h3>
<div class="panel panel-default">
<div class="panel-heading">
	<strong>Tiket Informasi dan Pilihan</strong>
</div>
<div class="panel-body">
<table class="table">
<tr>
	<th width="150">Unit * :</th>
	<td>
	<div class="col-xs-6">
	<select>
	<option value="-1">-- Pilih Unit --</option>
	</select>		
	</div>
	</td>
</tr>
<tr>
	<th width="150">Divisi / Bagian :</th>
	<td>
	<div class="col-xs-6">
	<select>
	<option value="-1">-- Pilih Bagian --</option>
	</select>
	</div>
	</td>
</tr>
<tr>
	<th width="150">Kepada :</th>
	<td>
	<div class="col-xs-6">
	<select>
	<option value="-1">-- Pilih Bagian --</option>
	</select>
	</div>
	</td>
</tr>
</table>
</div>
<div class="panel-heading">
	<strong>Detil Tiket Informasi: </strong>Silahkan deskripsikan Informasi Anda
</div>
<div class="panel-body">
<table class="table">
<tr>
	<th width="150">Subjek Informasi :</th>
	<td>
	<div class="col-xs-6">
	<input type="text" class="form-control input-sm" id="subjek" width="200"></input>		
	</div>
	</td>	
</tr>
<tr>
	<th width="150">Detail Informasi :</th>
	<td>
	<div class="col-xs-12">
	<textarea type="text" class="form-control input-sm" cols="10" rows="10" id="detail" width="200"></textarea>
	</div>
	</td>	
</tr>
<tr>
	<th width="150">Tingkat Prioritas :</th>
	<td>
	<div class="col-xs-6">
	<select class="dropdown">
	<option value="-1">-- Pilih Prioritas --</option>
	<option value="Rendah">Rendah</option>
	<option value="Normal">Normal</option>
	<option value="Tinggi">Tinggi</option>
	<option value="Emergency ">Emergency</option>
	</select>
	</div>
	</td>
</tr>
<tr>
	<th width="150">Lampiran: </th>
	<td>
	<div class="col-xs-6">
		<button>Pilih File</button> Nama file yg diupload
	</div>
	</td>
</tr>
</table>
<button class="btn btn-primary" type="submit" name="submit">Kirim Tiket</button>
<button class="btn btn-primary" type="cancel" name="cancel">Batal</button>
</div>
</div>
</body>