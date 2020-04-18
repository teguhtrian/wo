<select class="form-control" name="subUnit" id="subUnit">
<option value="0">-- Pilih Divisi --</option>
<?php
	foreach ($divisi as $b) {
		echo '<option value="'.$b->kodeUnit.'">'.$b->namaUnit.'</option>';
	}
?>
</select>