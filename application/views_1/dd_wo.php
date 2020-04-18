<select class="form-control" name="wo" id="wo">
<option value="0">-- Pilih Work Order --</option>
<?php
	foreach ($wo as $b) {
		echo '<option value="'.$b->id.'">'.$b->namaWo.'</option>';
	}
?>
</select>