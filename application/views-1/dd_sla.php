<select class="form-control" name="sla" id="sla">
<option value="0">-- Pilih SLA --</option>
<?php
	foreach ($sla as $b) {
		echo '<option value="'.$b->id.'">'.$b->namaSla.'</option>';
	}
?>
</select>