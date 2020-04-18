<select class="form-control" name="departemen" id="departemen">
<option value="-1">-- Pilih Departemen --</option>
<?php
	foreach ($departemen as $b) {
		echo '<option value="'.$b->id.'">'.$b->namaDepartemen.'</option>';
	}
?>
</select>