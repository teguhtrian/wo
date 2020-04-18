<head>
	<script type="text/javascript">
		function kembali(){
			window.history.back()
		}
	</script>
</head>
<body>
	<h4><strong>Tiket Pengaduan #000000</strong></h4>
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong>Tujuan Tiket Pengaduan</strong>
		</div>
		<div class="panel-body">
			<table width="940">
				<tr>
					<td width="50%">
					<table class="table table-striped">
						<tr>
							<th width="150">Unit :</th>
							<td>Nama Unit</td>
						</tr>
						<tr>
							<th>Kepada :</th>
							<td>Nama Kepala Cabang</td>
						</tr>
						<tr>
							<th>Pembuat Laporan :</th>
							<td>Nama Pembuat Laporan</td>
						</tr>					
					</table>
					</td>
				</tr>
			</table>
		</div>
		<div class="panel-heading">
			<strong>Detail Tiket Pengaduan</strong>
		</div>
		<div class="panel-body">
			<table width="940">
				<tr>
					<td width="50%">
					<table class="table table-striped">
						<tr>
							<th width="150">Dari :</th>
							<td>Nama Pembuat Tiket</td>
						</tr>
						<tr>
							<th>NPA :</th>
							<td>Nomor Pelanggan</td>
						</tr>
						<tr>
							<th>Nama Pelanggan :</th>
							<td>Nama Pelanggan sesuai NPA</td>
						</tr>
							<th>Alamat :</th>
							<td>Alamat Pengaduan</td>
						<tr>
							<th>Nama Pelapor :</th>
							<td>Nama Pelapor Pengaduan</td>
						</tr>
						<tr>
							<th>Jenis Gangguan :</th>
							<td>Jenis Gangguan Pengaduan</td>						
						</tr>						
					</table>
					</td>
				</tr>
			</table>
			<button class="btn btn-default" data-toggle="modal" data-target="#modal_form">Buat Tiket Order</button>
			<button class="btn btn-default" onclick="kembali()">Kembali</button>
		</div>
	</div>

<div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Pilih Bagian</h3>
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
				<button type="button" id="btnSave" onclick="" class="btn btn-primary">Buat Tiket</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>	
</body>