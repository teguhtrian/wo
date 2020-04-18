<select class="form-control" name="petugas" id="petugas">
<option value="0">-- Pilih Pegawai --</option>
<?php
	foreach ($petugas as $b) {
		echo '<option value="'.$b->nipp.'">'.$b->nama.'</option>';
	}
?>
</select>