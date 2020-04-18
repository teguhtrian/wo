<body>
<h2>Tiket Baru</h2><hr/>
<?php echo form_open('tiket/tiket_baru');?>
<label><?php $fullname = $this->session->userdata['nama'];?>

<table class="table">
	<tr>
		<th width="500">Dari :</th>
		<td><?php echo $fullname;?></td>
	</tr>
	<tr>
		<th width="500">Ditugaskan kepada :</th>
		<td>
		<select name="nipp">
			<option value="-">-- Pilih Petugas --</option>
			<?php
			foreach ($pegawai->result() as $b) {
				echo '<option value="'.$b->nipp.'">'.$b->nama_dpn.' '.$b->nama_blkg.'</option>';
			}
			?>
		</select>
		</td>
	</tr>
	<tr>
		<th width="500">SOP :</th>
		<td>
		<select name="id_sop">
			<option value="-">-- Pilih SOP --</option>
		<?php
			//buat inputan ke db untuk SLAnya dulu bro!
		foreach ($sop as $b){
			echo '<option value="'.$b->id_sop.'">'.$b->nama_sop.'</option>';		
		}
		?>
		</select>
		</td>
	</tr>
	<tr>
		<th width="500">Perintah Tugas :</th>
		<td>
		<select name="id_sop">
			<option value="-">-- Pilih Perintah Tugas --</option>
		<?php
			//buat inputan ke db untuk SLAnya dulu bro!
		foreach ($wo as $b){
			echo '<option value="'.$b->id_wo.'">'.$b->nama_wo.'</option>';		
		}
		?>
		</select>			
		</td>
	</tr>
	<tr>
		<th width="500">Urgency (SLA) :</th>
		<td>
		<select name="id_">
			<option value="-">-- Pilih Urgency --</option>
		<?php
			//buat inputan ke db untuk SLAnya dulu bro!
		foreach ($sla as $b){
			echo '<option value="'.$b->id_sla.'">'.$b->nama_sla.'</option>';		
		}
		?>
		</select>
		</td>
	</tr>
	<tr>
		<th width="500"></th>
		<td></td>
	</tr>
</table>
<div class="col-md-05">
	<div class="form-group">
		<label>Subjek Tiket : </label>
		<input type="text" class="form-control" name="subjek_tiket"></input>
	</div>
</div>
<div class="col-md-05">
	<div class="form-group">
		<label>Detail Tiket : </label>
		<textarea type="text" class="form-control" name="detail_tiket"></textarea>
	</div>
</div>
<button class="btn btn-primary" type="submit" name="submit">Submit</button>
<button class="btn btn-primary" type="reset" name="reset">Reset</button>
</form>
</body>