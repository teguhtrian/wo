<head>
<script type="text/javascript">
	$(function(){
	    $("#example").dataTable({
	    "responsive":true,
	    "ordering": false,
	    "info": false,
	    "searching":false,
	    "fixedColumns":true,
	    "lengthMenu":[3,5,10,"All"],
	    "columnDefs":[	
	    	{ "width": "1", "targets":0 },
	    	{ "width": "20%", "targets":1 },
	    	{ "width": "20%", "targets":2 },
	    	{ "width": "20%", "targets":3 },
	    	{ "width": "60%", "targets":4 }
	    ],
	    //"scrollY": "100px",
    	"scrollX": false,
        "language":{
          "sProcessing":   "Sedang memproses...",
          "sLengthMenu":   "Tampilkan _MENU_ entri",
          "sZeroRecords":  "Tidak ditemukan data yang sesuai",
          "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
          "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
          "sInfoPostFix":  "",
          "sSearch":       "Cari:",
          "sUrl":          "",
          "oPaginate": {
              "sFirst":    "Pertama",
              "sPrevious": "Sebelumnya",
              "sNext":     "Selanjutnya",
              "sLast":     "Terakhir"
          }
      	}});

	    $("#example2").dataTable({
	    "ordering": false,
	    "info": false,
	    "searching":false,
	    "fixedColumns":true,
	    "columnDefs":[	
	    	{ "width": "1%", "targets":0 },
	    	{ "width": "20%", "targets":1 },
	    	{ "width": "59%", "targets":2 },
	    	{ "width": "13%", "targets":3 },
	    	{ "width": "7%", "targets":4 }
	    ],
	    //"scrollY": "100px",
    	//"scrollX": false,
        "language":{
          "sProcessing":   "Sedang memproses...",
          "sLengthMenu":   "Tampilkan _MENU_ entri",
          "sZeroRecords":  "Tidak ditemukan data yang sesuai",
          "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
          "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
          "sInfoPostFix":  "",
          "sSearch":       "Cari:",
          "sUrl":          "",
          "oPaginate": {
              "sFirst":    "Pertama",
              "sPrevious": "Sebelumnya",
              "sNext":     "Selanjutnya",
              "sLast":     "Terakhir"
          }
      	}});
	});
</script>
</head>

<div class="panel panel-default">
<div class="panel-heading">
<center><h3><strong>Order #00000</strong></h3></center>
</div>
<div class="panel-body">
<strong><h4><strong>Detail Order</strong></h4></strong>
<table class="table table-condensed" width="100%">
	<tr class="">
		<td width="50%">
			<table class="table table-condensed" width="100%">
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
			<table class="table table-condensed" width="100%">
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
		<div class="btn-group">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ubahOrder">Ubah Status Order</button>
			<button type="button" class="btn btn-primary">Tambah Petugas</button>
			<button type="button" class="btn btn-primary">Tutup Order</button>
		</div>
<hr>

<!-- Modal -->
<div class="modal fade" id="ubahOrder" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Pilih Status Order</h3>
			</div>
			<div class="modal-body">
				Body
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<strong><h4><strong>Riwayat Order</strong></h4></strong>
			<table align="left" id="example" class="display compact nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
			        <th>No</th>
			        <th>Tanggal</th>
			        <th>Dari</th> 
			        <th>Kepada</th>
			        <th>Keterangan</th>	
				</tr>
			</thead>
			<tbody>
				<?php
					if(!empty($disposisi)){
						$no=1;
						foreach ($disposisi as $row) {
							echo '<tr>';
							echo '<td>'.$no.'</td>';
							echo '<td>'.$row->tgl.'<td>';
							echo '<td>'.$row->dari.'<td>';
							echo '<td>'.$row->kepada.'<td>';
							echo '<td>'.$row->keterangan.'<td>';
							echo '</tr>';
							$no++;
						}
					}
				?>
			</tbody>
			</table>
</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4><strong>Respon Order</strong></h4>
	</div>
	<div class="panel-body">
	<table id="example2" class="display" width="100%">
		<thead>
			<th>No</th>
			<th>Pengirim</th>
			<th>Pesan</th>
			<th>Lampiran</th>
			<th></th>
		</thead>
		<tbody>
		<?php
			if(!empty($respon)){
				$no=1;
				foreach ($respon as $row) {
					echo '<tr>';
					echo '<td>'.$no.'</td>';
					echo '<td>'.$row->pengirim.'<br>'.$row->tgl.'</td>';
					echo '<td>'.nl2br($row->pesan).'</td>';
					if(!empty($row->lampiran)){
						echo '<td><center><a href="'.base_url($row->lampiran).'"><img width="100%" height="100%" src="'.base_url($row->lampiran).'"><br></a></center></td>';
						echo '<td><a href="'.base_url('tiket/download_gbr/'.str_replace("/", "-", $row->lampiran)).'"><span class="glyphicon glyphicon-download-alt"></span></a> <a href="'.base_url('tiket/hapus_respon/'.$row->id_respon).'"><span class="glyphicon glyphicon-trash"></span></a></td>';
						echo '</tr>';
					}else{
						echo '<td><center>Kosong<center></td>';
						echo '<td><a href="'.base_url('tiket/hapus_respon/'.$row->id_respon).'"><span class="glyphicon glyphicon-trash"></span></a></td>';
						echo '</tr>';
					}
					$no++;
				}
			}
		?>
		</tbody>
	</table>
	</div>
</div>

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
							<?php //echo form_open_multipart('tiket/tambah_respon/'.str_replace("/", "-", $notiket), array('onSubmit'=>'return validasiRespon()','name'=>'formRespon'));?>
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