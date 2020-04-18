<select class="form-control" name="sop" id="sop">
<option value="0">-- Pilih SOP --</option>
<?php
	foreach ($sop as $b) {
		echo '<option value="'.$b->id.'">'.$b->namaSop.'</option>';
	}
?>
</select>