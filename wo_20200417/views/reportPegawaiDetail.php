<body>
	<h2><strong>Report Per Pegawai dengan Detail Riwayat</strong></h2>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><strong>Detail Pilihan</strong></h4>
		</div>
		<?php echo form_open('laporan/cetakTiketDetail')?>
		<div class="panel-body">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-6">
						<label><h4><strong>Unit :</strong></h4></label>
						<select class="form-control" name="unit" <?php echo $this->session->userdata('role')=='sa'||$this->session->userdata('role')=='dir'?'':'disabled'?> id="unit">
							<option>-- Pilih Unit --</option>
							<?php
								if(!empty($unit)){
									foreach ($unit as $row) {
										if($this->session->userdata('kodeUnit')==$row->kodeUnit){
											echo '<option value="'.$row->kodeUnit.'" selected>'.$row->namaUnit.'</option>';
										}
									}
								}
							?>
						</select>
					</div>					
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label><h4><strong>Divisi / Bagian :</strong></h4></label>
						<select class="form-control" name="bagian" onchange="pilihPegawai()" id="departemen">
							<option value="0">-- Pilih Divisi/Bagian --</option>
							<option value="all">Semua</option>
							<?php
								if(!empty($departemen)){
									foreach ($departemen as $row) {
										echo '<option value="'.$row->id.'">'.$row->namaDepartemen.'</option>';
									}
								}
							?>
						</select>
					</div>						
				</div>
				<div class="row">
					<div class="col-sm-6">
						<label><h4><strong>Pegawai :</strong></h4></label>
						<select class="form-control" name="pegawai" id="pegawai">
							<option value="00">-- Pilih Pegawai --</option>
						</select>
					</div>						
				</div>
				<div class="row">
				<br>
					<div class="col-sm-6">
						<input class="btn btn-default" type="button" value="Lihat" onclick="tampilReportPegawai()" />
						<button class="btn btn-default" type="submit" value="Print">Print</button>
					</div>						
				</div>	
			</div>
		</div>
		<?php echo form_close();?>
		<div class="panel-heading">
			<h4><strong>Detail Report</strong></h4>
		</div>
		<div class="panel-body">
			<div id="report">
			</div>
		</div>
	</div>
</body>

<script type="text/javascript">
	function pilihPegawai(){
		var dept = $('#departemen').val();
		//alert(dept);
		if(dept!='all'){
			//alert(dept);
			$.ajax({
				url:"<?php echo base_url();?>tiket/pilihPegawai/"+dept+"",
				success: function(html){
					$("#pegawai").html(html);
				},
				dataType:"html"
			});
		}else{
			var unit = <?php echo $kodeUnit="'".$this->session->userdata('kodeUnit')."'"?>;
			//alert(unit);
			$.ajax({
				url:"<?php echo base_url();?>tiket/pilihPegawaiByUnit/"+unit,
				success: function(html){
					$("#pegawai").html(html);
				},
				dataType:"html"
			});			
		}

	}
/*
	function cetakpdf(){
		var nipp = $('#pegawai').val();
		$.ajax({
			url:"<?php echo base_url();?>report/cetakPdf/"+nipp+"",
			success: function(html){
				$("#report").html(html);
			},
			dataType:"html"
		});		
	}
*/
	function tampilReportPegawai(){
		//cek validasi
		//var val= validasi();
		//if(val==false){
		//	return false;
		//}

		var dept = $('#departemen').val();
		var nipp = $('#pegawai').val();
		//alert(nipp);
		
		$.ajax({
			url:"<?php echo base_url();?>report/reportDetailByNipp/"+nipp+"",
			success: function(html){
				$("#report").html(html);
			},
			dataType:"html"
		});
	}


	function validasi(){
		//alert('test');
		if($('#departemen').val()=='0'||$('#departemen').val()==''||$('#pegawai').val()=='0'||$('#pegawai').val()==''){
			alert('Lengkapi Detail Pilihan'); 
			return false;
		}
	}
</script>