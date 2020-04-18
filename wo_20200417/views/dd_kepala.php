<select class="form-control" id="kepala">
<option value="-1">-- Pilih Pegawai --</option>
<?php
	foreach ($kepala as $kepala) {
		echo '<option value="'.$kepala->nipp.'">'.$kepala->nama.'</option>';
	}
?>
</select>