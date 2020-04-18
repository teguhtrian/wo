<?php
// var_dump($unit); echo '<br/>';
// var_dump($departemen); echo '<br/>';

?>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('template/datepicker/bootstrap-datepicker.css')?>">
	<script src="<?php echo base_url('template/datepicker/bootstrap-datepicker.js')?>"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body>
	<div class="row">
		
	</div>
<div class="col-lg-7">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3><strong>Cetak Absen Login</strong></h3>
		</div>
		<div class="panel-body">
			<?php echo form_open('laporan/cetakLogInOutPeriode', array('id' => 'myform','target' => '_blank'))?>
				<div class="row">
		        	<div class="col-lg-5">
		    			<div class="form-group">
		            	<label>Kantor/Unit</label>
		    				<select class="form-control" name="kocab" id="kocab" disabled>
		                        <option value="">-- Silahkan Pilih --</option>
		    					<?php
		    						foreach ($unit as $u) {
		    							echo '<option value="'.$u->kodeUnit.'" ';
		    							echo $this->session->userdata('kodeUnit')===$u->kodeUnit?'selected':'';
		    							echo '> '.$u->namaUnit.'</option>';
		    						}
		    					?>
		                    </select>
		                </div>
		        	</div>
		        	<div class="col-lg-7">
		    			<div class="form-group">
		            	<label>&nbsp;</label>
		    				<select class="form-control" name="dept" id="dept">
		    					<?php
		    						foreach ($unit as $u) {
		    							echo '<option value="'.$u->kodeUnit.'"> '.$u->namaUnit.'</option>';
		    						}
		    						foreach ($departemen as $d) {
		    							echo '<option value="'.$d->id.'"> '.$d->namaDepartemen.'</option>';
		    						}
		    					?>
		                    </select>
		                </div>
		        	</div>
		        </div>
				<!-- div class="row">
		        	<div class="col-lg-6">
		        	<label>Tanggal awal</label>
		        	<div class="form-group input-group">
						<input class="form-control" ttype="text" value="<?php echo date("Y-m-d");?>" id="datepicker" name="tglAwal" readonly>
						<span class="input-group-addon">
						<i class="fa fa-calendar-o"></i>
						</span>
		        	</div>
		        	</div>
		        	<div class='col-sm-6'>
		        		<label>Tanggal Akhir</label>
			            <div class="form-group input-group">
		    				<input class="form-control" ttype="text" value="<?php echo date("Y-m-d");?>" id="datepicker2" name="tglAkhir" readonly>
		    				<span class="input-group-addon">
		    				<i class="fa fa-calendar-o"></i>
		    				</span>
		            	</div>
			        </div>
		        </div> -->
		        <div class="row">
		        	<div class="col-lg-5">
		    			<div class="form-group">
			            	<label>Periode Tanggal</label>
			        		<input class="form-control" type="text" name="daterange" value="" placeholder="Pilih Tanggal"/>
			        	</div>
		        	</div>
		        </div>
		        <hr>
		        <div class="row">
		        	<div class="col-lg-6">
		    			<input class="btn btn-danger" type="reset" value="Cancel" onclick="window.location.reload()">
		        		<input class="btn btn-success" type="submit" value="Cetak" id="submit">
		        	</div>
		        </div>
	    	</form>
		</div>	
	</div>	
</div>

<script>
    $(function() {
		var d = new Date();

		var month = d.getMonth()+1;
		var day = d.getDate()+1;
		var day2 = (d.getDate()+1)-7;

		var output = d.getFullYear() + '-' +
		    ((''+month).length<2 ? '0' : '') + month + '-' +
		    ((''+day).length<2 ? '0' : '') + day;
		    
		var output2 = d.getFullYear() + '-' +
		    ((''+month).length<2 ? '0' : '') + month + '-' +
		    ((''+day2).length<2 ? '0' : '') + day2;

	  $('input[name="daterange"]').daterangepicker({
	        "startDate": output2,
		    "endDate": output,
		  	"maxSpan": {
		        "days": 7
		    },
		    "locale": {
		    	"format": 'YYYY-MM-DD'
		    },
	    opens: 'left'
	  }, function(start, end, label) {
	    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
	  });
	});
</script>
</body>