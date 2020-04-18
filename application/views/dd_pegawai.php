<select class="form-control" name="pegawai" id="pegawai">
<option value="0">-- Pilih Pegawai --</option>
<?php
	foreach ($pegawai as $b) {
		echo '<option value="'.$b->nipp.'">'.$b->nama.'</option>';
	}
?>
</select>