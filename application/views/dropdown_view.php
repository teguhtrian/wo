<script type="text/javascript" src="<?php echo base_url('asset/js/jquery-1.12.2.js');?>"></script>
<script type="text/javascript">

	function fungsiambildept(nilai){
		$.ajax({
			type:"POST",
			url:"<?php echo site_url('dropdown/ambil_dept')?>",
			data:"key="+nilai,
			success: function(result){
				$("#dept").html(result);
			}

			error:function(XMLHttpRequest){
				alert(XMLHttpRequest.responseText);
			}
		})
	};
</script>

<?php
	echo form_open('#');
	$js = 'onChange="fungsiambildept(this.value);"';
	echo form_dropdown('unit', $unit,'', $js);
	echo form_close();
?>

<pre>
	<div id="dept"></div>	
</pre>